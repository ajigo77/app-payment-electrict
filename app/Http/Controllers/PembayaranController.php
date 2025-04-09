<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use App\Helpers\HashIdHelper;

class PembayaranController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function prosesPayment($id_pemakaian)
    {
        try {
            $pemakaian = Pemakaian::with(['pelanggan.jenisPelanggan.kapasitasDaya'])->findOrFail($id_pemakaian);

            $existingPembayaran = Pembayaran::where('pemakaian_id', $id_pemakaian)->where('status', 'pending')->first();

            if ($existingPembayaran) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => "Pembayaran untuk ID Pelanggan {$pemakaian->pelanggan->no_kontrol} masih dalam pending",
                    ],
                    400,
                );
            }

            if ($pemakaian->status === 'lunas') {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => "ID Pelanggan {$pemakaian->pelanggan->no_kontrol} sudah melakukan pembayaran di bulan ini",
                    ],
                    400,
                );
            }

            $gross_amount = (int) ceil($pemakaian->biaya_pemakai);

            $customer_details = [
                'first_name' => $pemakaian->pelanggan->nama,
                'phone' => $pemakaian->pelanggan->telpon,
                'address' => $pemakaian->pelanggan->alamat,
            ];

            $item_details = [
                [
                    'id' => $pemakaian->id_pemakaian,
                    'price' => $gross_amount,
                    'quantity' => 1,
                    'name' => "Tagihan Listrik - {$pemakaian->pelanggan->no_kontrol}",
                    'category' => $pemakaian->pelanggan->jenisPelanggan->kategori . ' \ ' . $pemakaian->pelanggan->jenisPelanggan->golongan,
                    'merchant_name' => config('midtrans.merchantId'),
                ],
            ];

            $params = [
                'transaction_details' => [
                    'order_id' => $pemakaian->id_pemakaian,
                    'gross_amount' => $gross_amount,
                ],
                'customer_details' => $customer_details,
                'item_details' => $item_details,
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Ini akan membuat 1 record pada tabel pembayaran jika snap_token ada
            if ($snapToken) {
                Pembayaran::create([
                    'pemakaian_id' => $pemakaian->id_pemakaian,
                    'no_ref' => now()->format('YmdHis'),
                    'snap_token' => $snapToken,
                    'jenis_pembayaran' => 'non-tunai',
                    'total_bayar' => $gross_amount,
                    'status' => 'pending',
                    'tanggal_bayar' => null,
                ]);

                $pemakaian->update(['status' => 'pending']);
            } else {
                Log::info('Gagal membuat snap token');
            }

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function printPembayaran(Request $request)
    {
        try {
            // Decode hash ID menjadi ID asli
            $id = HashIdHelper::decode($request->id_pemakaian);
            $pemakaian = Pemakaian::with(['pelanggan.jenisPelanggan.kapasitasDaya'])->findOrFail($id);

            if (!$id) {
                return view('errors.404');
            }

            // Cek status pembayaran
            if ($pemakaian->status === 'lunas') {
                return back()->with('error', 'ID Pelanggan ' . $pemakaian->pelanggan->no_kontrol . ' sudah melakukan pembayaran di bulan ini');
            } else {
                $pembayaran = Pembayaran::create([
                    'pemakaian_id' => $pemakaian->id_pemakaian,
                    'no_ref' => now()->format('YmdHis'),
                    'snap_token' => null,
                    'jenis_pembayaran' => 'cash',
                    'tanggal_bayar' => now()->format('d-m-Y'),
                    'status' => 'success',
                ]);

                // Load relasi
                $pembayaran->load('pemakaian.pelanggan.jenisPelanggan.kapasitasDaya');

                // status pemakaian menjadi lunas
                $pemakaian->update(['status' => 'lunas']);
            }
            $data = [
                'pembayaran' => $pembayaran
            ];

            return view('client.print.print-view', $data)->with('success', 'Pembayaran berhasil');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
