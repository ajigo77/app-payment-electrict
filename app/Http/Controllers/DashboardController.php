<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;
use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\JenisPelanggan;
use App\Models\KapasitasDaya;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $adminCount = User::where('role', 'admin')->count() ?? '0';
        $superAdminCount = User::where('role', 'super_admin')->count() ?? '0';
        $pelangganCount = Pelanggan::count() ?? '0';
        $query = Pembayaran::with(['pemakaian.pelanggan.jenisPelanggan.kapasitasDaya']);

        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('no_ref', 'LIKE', $searchTerm)
                    ->orWhere('total_bayar', 'LIKE', $searchTerm)
                    ->orWhere('status', 'LIKE', $searchTerm)
                    ->orWhere('tanggal_bayar', 'LIKE', $searchTerm)
                    ->orWhere('jenis_pembayaran', 'LIKE', $searchTerm)
                    ->orWhereHas('pemakaian.pelanggan', function ($q) use ($searchTerm) {
                        $q->where('nama', 'LIKE', $searchTerm)->orWhere('no_kontrol', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('pemakaian.pelanggan.jenisPelanggan', function ($q) use ($searchTerm) {
                        $q->where('golongan', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('pemakaian.pelanggan.jenisPelanggan.kapasitasDaya', function ($q) use ($searchTerm) {
                        $q->where('batas_daya', 'LIKE', $searchTerm);
                    });
            });
        }

        $transaksiHariIni = $query->whereDate('created_at', today())->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('dashboard.components.partials.transaksi-tabel-searching', [
                'adminCount' => $adminCount,
                'superAdminCount' => $superAdminCount,
                'pelangganCount' => $pelangganCount,
                'transaksiHariIni' => $transaksiHariIni,
                'title' => 'dashboard',
            ])->render();
        }

        return view('dashboard.components.pages.dashboard', [
            'adminCount' => $adminCount,
            'superAdminCount' => $superAdminCount,
            'pelangganCount' => $pelangganCount,
            'transaksiHariIni' => $transaksiHariIni,
            'title' => 'dashboard',
        ]);
    }

    public function pembayaranView(Request $request)
    {
        $query = Pemakaian::with(['pelanggan.jenisPelanggan.kapasitasDaya']);
        $currentStatus = $request->status;

        // Filter no_kontrol
        if ($request->no_kontrol) {
            $query->whereHas('pelanggan', function ($q) use ($request) {
                $q->where('no_kontrol', 'like', '%' . $request->no_kontrol . '%');
            });
        }

        // Filter status
        if ($request->status && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $pemakaian = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $belumBayar =
            Pemakaian::with(['pelanggan.jenisPelanggan.kapasitasDaya'])
                ->where('status', 'belum bayar')
                ->count() ?? '0';
        $lunas =
            Pemakaian::with(['pelanggan.jenisPelanggan.kapasitasDaya'])
                ->where('status', 'lunas')
                ->count() ?? '0';

        if ($request->ajax()) {
            return view('dashboard.components.partials.pembayaran-tabel-searching', [
                'title' => 'pembayaran',
                'pemakaian' => $pemakaian,
                'currentStatus' => $currentStatus,
                'belumBayar' => $belumBayar,
                'lunas' => $lunas,
            ])->render();
        }

        return view('dashboard.components.pages.pembayaran', [
            'title' => 'pembayaran',
            'pemakaian' => $pemakaian,
            'currentStatus' => $currentStatus,
            'belumBayar' => $belumBayar,
            'lunas' => $lunas,
        ]);
    }

    public function pelangganView(Request $request)
    {
        $query = Pelanggan::with(['jenisPelanggan.kapasitasDaya']);
        $jenisPelanggan = JenisPelanggan::with('kapasitasDaya')->get();

        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'LIKE', $searchTerm)
                    ->orWhere('no_kontrol', 'LIKE', $searchTerm)
                    ->orWhere('alamat', 'LIKE', $searchTerm)
                    ->orWhere('telpon', 'LIKE', $searchTerm)
                    ->orWhereHas('jenisPelanggan', function ($q) use ($searchTerm) {
                        $q->where('kategori', 'LIKE', $searchTerm)
                            ->orWhere('golongan', 'LIKE', $searchTerm)
                            ->orWhereHas('kapasitasDaya', function ($q) use ($searchTerm) {
                                $q->where('batas_daya', 'LIKE', $searchTerm);
                            });
                    });
            });
        }

        $pelanggan = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('dashboard.components.partials.pelanggan-tabel-searching', [
                'title' => 'pelanggan',
                'pelanggan' => $pelanggan,
                'jenisPelanggan' => $jenisPelanggan,
            ])->render();
        }

        return view('dashboard.components.pages.pelanggan', [
            'title' => 'pelanggan',
            'pelanggan' => $pelanggan,
            'jenisPelanggan' => $jenisPelanggan,
        ]);
    }

    public function createDataPelanggan(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string|max:50',
                'no_kontrol' => 'required|numeric|unique:pelanggan,no_kontrol|digits_between:1,20',
                'alamat' => 'required',
                'telpon' => 'required|numeric|digits_between:1,20',
                'jenis_pelanggan_id' => 'required|exists:jenis_pelanggan,id_jenis_pelanggan',
            ],
            [
                'nama.required' => 'Tidak boleh kosong',
                'nama.string' => 'Tidak boleh mengandung angka',
                'nama.max' => 'Maksimal 50 karakter',
                'no_kontrol.required' => 'Tidak boleh kosong',
                'no_kontrol.numeric' => 'Harus berupa numeric',
                'no_kontrol.unique' => 'Nomor kontrol sudah terdaftar',
                'no_kontrol.digits_between' => 'Maksimal 20 digit',
                'alamat.required' => 'Tidak boleh kosong',
                'telpon.required' => 'Tidak boleh kosong',
                'telpon.numeric' => 'Harus berupa numberik',
                'jenis_pelanggan_id.required' => 'Tidak boleh kosong',
                'jenis_pelanggan_id.exists' => 'Data tidak ada',
            ],
        );

        $pelanggan = Pelanggan::create($validated);

        if ($pelanggan) {
            return redirect()->route('dashboard.pelanggan')->with('success', 'Pelanggan berhasil ditambahkan');
        }

        return back()->withInput();
    }

    public function updateDataPelanggan(Request $request, $id_pelanggan)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string|max:50',
                'no_kontrol' => 'required|numeric|digits_between:1,20',
                'alamat' => 'required',
                'telpon' => 'required|numeric',
                'jenis_pelanggan_id' => 'required|exists:jenis_pelanggan,id_jenis_pelanggan',
            ],
            [
                'nama.required' => 'Tidak boleh kosong',
                'nama.string' => 'Tidak boleh mengandung angka',
                'nama.max' => 'Maksimal 50 karakter',
                'no_kontrol.required' => 'Tidak boleh kosong',
                'no_kontrol.numeric' => 'Harus berupa numeric',
                'no_kontrol.digits_between' => 'Maksimal 20 digit',
                'alamat.required' => 'Tidak boleh kosong',
                'telpon.required' => 'Tidak boleh kosong',
                'telpon.numeric' => 'Harus berupa numberik',
                'jenis_pelanggan_id.required' => 'Tidak boleh kosong',
                'jenis_pelanggan_id.exists' => 'Data tidak ada',
            ],
        );

        $data = [
            'nama' => $validated['nama'],
            'no_kontrol' => $validated['no_kontrol'],
            'alamat' => $validated['alamat'],
            'telpon' => $validated['telpon'],
            'jenis_pelanggan_id' => $validated['jenis_pelanggan_id'],
        ];

        $update_pelanggan = Pelanggan::findOrFail($id_pelanggan);

        $update_pelanggan->update($data);

        if ($update_pelanggan) {
            return redirect()->route('dashboard.pelanggan')->with('success', 'Data pelanggan berhasil diperbarui');
        }

        return back()->withInput();
    }

    public function deletePelanggan($id_pelanggan)
    {
        $delete_pelanggan = Pelanggan::findOrFail($id_pelanggan);

        if (!$delete_pelanggan) {
            return redirect()->route('dashboard.petugas')->with('error', 'User tidak dapat ditemukan');
        }

        $delete_pelanggan->delete();

        return redirect()->route('dashboard.pelanggan')->with('success', 'Pelanggan berhasil dihapus');
    }

    public function pemakaianView(Request $request)
    {
        $query = Pemakaian::with(['pelanggan.jenisPelanggan.kapasitasDaya']);
        $belumBayar = Pemakaian::where('status', 'belum bayar')->count() ?? '0';
        $lunas = Pemakaian::where('status', 'lunas')->count() ?? '0';
        $pelanggan = Pelanggan::all();

        if ($request->search) {
            $formatSearch = '%' . $request->search . '%';
            $query->where(function ($q) use ($formatSearch) {
                $q->where('tahun', 'LIKE', $formatSearch)->orWhere('bulan', 'LIKE', $formatSearch)->orWhere('meter_awal', 'LIKE', $formatSearch)->orWhere('meter_akhir', 'LIKE', $formatSearch)->orWhere('jumlah_pakai', 'LIKE', $formatSearch)->orWhere('biaya_beban_pemakai', 'LIKE', $formatSearch)->orWhere('biaya_pemakai', 'LIKE', $formatSearch)->orWhere('status', 'LIKE', $formatSearch);
            });
        }

        $pemakaian = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('dashboard.components.partials.pemakaian-tabel-searching', [
                'title' => 'pemakaian',
                'pemakaian' => $pemakaian,
                'belumBayar' => $belumBayar,
                'lunas' => $lunas,
                'pelanggan' => $pelanggan,
            ])->render();
        }

        return view('dashboard.components.pages.pemakaian', [
            'title' => 'pemakaian',
            'pemakaian' => $pemakaian,
            'belumBayar' => $belumBayar,
            'lunas' => $lunas,
            'pelanggan' => $pelanggan,
        ]);
    }

    public function createPemakaian(Request $request)
    {
        // Log::info('Request:', $request->all());
        try {
            $validatedData = $request->validate(
                [
                    'pelanggan_id' => 'required|exists:pelanggan,id_pelanggan',
                    'tahun' => 'required|integer',
                    'bulan' => 'required|integer|between:1,12',
                    'meter_awal' => 'required|numeric',
                    'meter_akhir' => 'required|numeric|gt:meter_awal',
                    'jumlah_pakai' => 'required|integer',
                    'biaya_beban_pemakai' => 'required|numeric',
                    'biaya_pemakai' => 'required|numeric',
                ],
                [
                    'pelanggan_id.required' => 'Tidak boleh kosong',
                    'pelanggan_id.exists' => 'Tidak ada data yang tersedia',
                    'tahun.required' => 'Tidak boleh kosong',
                    'tahun.integer' => 'Data Tidak sesuai',
                    'bulan.required' => 'Tidak boleh kosong',
                    'bulan.integer' => 'Data tidak sesuai',
                    'bulan.between' => 'Tidak termasuk 1 - 12 bulan',
                    'meter_awal.required' => 'Tidak boleh kosong',
                    'meter_awal.numeric' => 'Data tidak sesuai',
                    'meter_akhir.required' => 'Tidak boleh kosong',
                    'meter_akhir.numeric' => 'Data tidak sesuai',
                    'jumlah_pakai.required' => 'Tidak boleh kosong',
                    'jumlah_pakai.integer' => 'Data tidak sesuai',
                    'biaya_beban_pemakai.required' => 'Tidak boleh kosong',
                    'biaya_beban_pemakai.numeric' => 'Data tidak sesuai',
                    'biaya_pemakai.required' => 'Tidak boleh kosong',
                    'biaya_pemakai.numeric' => 'Data tidak sesuai',
                ],
            );

            $validatedData['status'] = 'pending';

            $pemakaian = Pemakaian::create($validatedData);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data pemakaian pelanggan berhasil ditambahkan',
                    'data' => $pemakaian,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal menambahkan data pemakaian',
                    'error' => $e->getMessage(),
                ],
                400,
            );
        }
    }

    public function updatePemakaian(Request $request, $id_pemakaian)
    {
        // Log::info($request->all());
        try {
            $validatedData = $request->validate(
                [
                    'pelanggan_id' => 'required|exists:pelanggan,id_pelanggan',
                    'tahun' => 'required|integer',
                    'bulan' => 'required|integer|between:1,12',
                    'meter_awal' => 'required|numeric',
                    'meter_akhir' => 'required|numeric|gt:meter_awal',
                    'jumlah_pakai' => 'required|integer',
                    'biaya_beban_pemakai' => 'required|numeric',
                    'biaya_pemakai' => 'required|numeric',
                ],
                [
                    'pelanggan_id.required' => 'Tidak boleh kosong',
                    'pelanggan_id.exists' => 'Tidak ada data yang tersedia',
                    'tahun.required' => 'Tidak boleh kosong',
                    'tahun.integer' => 'Data Tidak sesuai',
                    'bulan.required' => 'Tidak boleh kosong',
                    'bulan.integer' => 'Data tidak sesuai',
                    'bulan.between' => 'Tidak termasuk 1 - 12 bulan',
                    'meter_awal.required' => 'Tidak boleh kosong',
                    'meter_awal.numeric' => 'Data tidak sesuai',
                    'meter_akhir.required' => 'Tidak boleh kosong',
                    'meter_akhir.numeric' => 'Data tidak sesuai',
                    'jumlah_pakai.required' => 'Tidak boleh kosong',
                    'jumlah_pakai.integer' => 'Data tidak sesuai',
                    'biaya_beban_pemakai.required' => 'Tidak boleh kosong',
                    'biaya_beban_pemakai.numeric' => 'Data tidak sesuai',
                    'biaya_pemakai.required' => 'Tidak boleh kosong',
                    'biaya_pemakai.numeric' => 'Data tidak sesuai',
                ],
            );

            if ($request->status !== 'lunas') {
                $validatedData['status'] = $request->status;
                Pemakaian::findOrFail($id_pemakaian)->update($validatedData);
            } else {
                return response()->json(['success' => false, 'message' => 'Status yang sudah lunas tidak dapat diperbarui'], 400);
            }

            return response()->json(['success' => true, 'message' => 'Perubahan data berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal menambahkan data pemakaian',
                    'error' => $e->getMessage(),
                ],
                400,
            );
        }
    }

    public function deletePemakaian(Pemakaian $id_pemakaian)
    {
        // Log::info($id_pemakaian);

        if ($id_pemakaian->status !== 'lunas') {
            return redirect()->route('dashboard.pemakaian')->with('error', 'Data pemakaian tidak dapat dihapus karena statusnya belum lunas');
        }

        $id_pemakaian->delete();
        return redirect()->route('dashboard.pemakaian')->with('success', 'Data pemakaian berhasil dihapus');
    }

    public function kapasitasView(Request $request)
    {
        $query = KapasitasDaya::query();

        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('batas_daya', 'LIKE', $searchTerm)->orWhere('biaya_beban', 'LIKE', $searchTerm)->orWhere('tarif_kwh', 'LIKE', $searchTerm);
            });
        }

        $kapasitas = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('dashboard.components.partials.kapasitas-tabel-searching', [
                'title' => 'kapasitas',
                'kapasitas' => $kapasitas,
            ])->render();
        }

        return view('dashboard.components.pages.kapasitas', [
            'title' => 'kapasitas',
            'kapasitas' => $kapasitas,
        ]);
    }

    public function createKapasitas(Request $request)
    {
        try {
            Log::info($request->all());
            $validatedData = $request->validate(
                [
                    'batas_daya' => 'required|integer',
                    'biaya_beban' => 'required|numeric',
                    'tarif_kwh' => 'required|numeric',
                ],
                [
                    'batas_daya.required' => 'Tidak boleh kosong',
                    'batas_daya.integer' => 'Harus berupa angka',
                    'biaya_beban.required' => 'Tidak boleh kosong',
                    'biaya_beban.numeric' => 'Harus berupa angka',
                    'tarif_kwh.required' => 'Tidak boleh kosong',
                    'tarif_kwh.numeric' => 'Harus berupa angka',
                ],
            );
            Log::info('Validated data:', $validatedData);
            KapasitasDaya::create($validatedData);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data kapasitas daya berhasil ditambahkan',
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal menambahkan data kapasitas',
                    'error' => $e->getMessage(),
                ],
                400,
            );
        }
    }

    public function updateKapasitas(Request $request, KapasitasDaya $kapasitas)
    {
        try {
            Log::info('Raw request data:', $request->all());

            // Validasi data
            $validatedData = $request->validate(
                [
                    'batas_daya' => 'required|integer|min:1',
                    'biaya_beban' => 'required|numeric|min:0',
                    'tarif_kwh' => 'required|numeric|min:0',
                ],
                [
                    'batas_daya.required' => 'Batas daya tidak boleh kosong',
                    'batas_daya.integer' => 'Batas daya harus berupa angka bulat',
                    'batas_daya.min' => 'Batas daya minimal 1',
                    'biaya_beban.required' => 'Biaya beban tidak boleh kosong',
                    'biaya_beban.numeric' => 'Biaya beban harus berupa angka',
                    'biaya_beban.min' => 'Biaya beban minimal 0',
                    'tarif_kwh.required' => 'Tarif KWH tidak boleh kosong',
                    'tarif_kwh.numeric' => 'Tarif KWH harus berupa angka',
                    'tarif_kwh.min' => 'Tarif KWH minimal 0',
                ],
            );

            Log::info('Validated data:', $validatedData);

            if (!$kapasitas) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Data kapasitas tidak dapat ditemukan',
                    ],
                    404,
                );
            }

            $kapasitas->update($validatedData);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data kapasitas daya berhasil diperbarui',
                ],
                200,
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            // error validasi
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors(),
                ],
                422,
            );
        } catch (\Exception $e) {
            // error yang lainnnya
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Gagal memperbarui data kapasitas',
                    'error' => $e->getMessage(),
                ],
                400,
            );
        }
    }

    public function deleteKapasitas(KapasitasDaya $kapasitas)
    {
        if ($kapasitas->id_kapasitas_daya) {
            $kapasitas->delete();
            return redirect()->route('dashboard.kapasitas')->with('success', 'Data kapasitas daya berhasil dihapus');
        }

        return redirect()->route('dashboard.kapasitas')->with('error', 'Data kapasitas daya tidak ditemukan');
    }

    public function jenisPelangganView(Request $request)
    {
        $query = JenisPelanggan::query();
        $dataKapasitas = KapasitasDaya::all();

        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('kategori', 'LIKE', $searchTerm)->orWhere('golongan', 'LIKE', $searchTerm)->orWhere('deskripsi', 'LIKE', $searchTerm);
            });
        }

        $jenisPelanggan = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('dashboard.components.partials.jenis-pelanggan-tabel-searching', [
                'title' => 'jenis_pelanggan',
                'jenisPelanggan' => $jenisPelanggan,
                'dataKapasitas' => $dataKapasitas,
            ])->render();
        }

        return view('dashboard.components.pages.jenis-pelanggan', [
            'title' => 'jenis_pelanggan',
            'jenisPelanggan' => $jenisPelanggan,
            'dataKapasitas' => $dataKapasitas,
        ]);
    }

    public function createJenisPelanggan(Request $request)
    {
        try {
            // Log::info('Request data jenis pelanggan:', $request->all());

            $validatedData = $request->validate(
                [
                    'kategori' => 'required|in:subsidi,non-subsidi',
                    'golongan' => ['required', 'in:R1,R2,R3,B1,B2,B3,S1,S2,S3,P1,P2,P3,I1,I2,I3'],
                    'kapasitas_daya_id' => 'required|exists:kapasitas_daya,id_kapasitas_daya',
                    'deskripsi' => 'required|string|max:255',
                ],
                [
                    'kategori.required' => 'Tidak boleh kosong',
                    'kategori.in' => 'Kategori harus berupa subsidi atau non-subsidi',
                    'golongan.required' => 'Tidak boleh kosong',
                    'golongan.in' => 'Golongan tidak valid',
                    'kapasitas_daya_id.required' => 'Tidak boleh kosong',
                    'kapasitas_daya_id.exists' => 'Data tidak ditemukan',
                    'deskripsi.required' => 'Tidak boleh kosong',
                    'deskripsi.string' => 'Harus berupa teks',
                    'deskripsi.max' => 'Deskripsi terlalu panjang',
                ],
            );

            // Log::info('Validated data jenis pelanggan:', $validatedData);

            JenisPelanggan::create($validatedData);

            return redirect()->route('dashboard.jenis.pelanggan')->with('success', 'Data berhasil ditambahkan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('dashboard.jenis.pelanggan')->with('error', 'Validasi Gagal');
        } catch (\Exception $e) {
            Log::error('Error jenis pelanggan:', ['message' => $e->getMessage()]);

            return redirect()->route('dashboard.jenis.pelanggan')->with('error', $e->getMessage());
        }
    }

    public function updateJenisPelanggan(Request $request, JenisPelanggan $id_jenis_pelanggan) {
        try {
            Log::info('Request data jenis pelanggan:', $request->all());

            $validatedData = $request->validate(
                [
                    'kategori' => 'required|in:subsidi,non-subsidi',
                    'golongan' => ['required', 'in:R1,R2,R3,B1,B2,B3,S1,S2,S3,P1,P2,P3,I1,I2,I3'],
                    'kapasitas_daya_id' => 'required|exists:kapasitas_daya,id_kapasitas_daya',
                    'deskripsi' => 'required|string|max:255',
                ],
                [
                    'kategori.required' => 'Tidak boleh kosong',
                    'kategori.in' => 'Kategori harus berupa subsidi atau non-subsidi',
                    'golongan.required' => 'Tidak boleh kosong',
                    'golongan.in' => 'Golongan tidak valid',
                    'kapasitas_daya_id.required' => 'Tidak boleh kosong',
                    'kapasitas_daya_id.exists' => 'Data tidak ditemukan',
                    'deskripsi.required' => 'Tidak boleh kosong',
                    'deskripsi.string' => 'Harus berupa teks',
                    'deskripsi.max' => 'Deskripsi terlalu panjang',
                ],
            );

            if(!$id_jenis_pelanggan){
                return redirect()->route('dashboard.jenis.pelanggan')->with('error', 'Data jenis pelanggan tidak dapat ditemukan');
            }

            $id_jenis_pelanggan->update($validatedData);
            return redirect()->route('dashboard.jenis.pelanggan')->with('success', 'Data berhasil ditambahkan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('dashboard.jenis.pelanggan')->with('error', 'Validasi Gagal');
        } catch (\Exception $e) {
            Log::error('Error creating jenis pelanggan:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return redirect()->route('dashboard.jenis.pelanggan')->with('error', $e->getMessage());
        }
    }

    public function deleteJenisPelanggan(JenisPelanggan $data){
        if ($data->id_jenis_pelanggan) {
            $data->delete();
            return redirect()->route('dashboard.jenis.pelanggan')->with('success', 'Data berhasil dihapus');
        }

        return redirect()->route('dashboard.jenis.pelanggan')->with('error', 'Data ini tidak ditemukan');
    }
}
