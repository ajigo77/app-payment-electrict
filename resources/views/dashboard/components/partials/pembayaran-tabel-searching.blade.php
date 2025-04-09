<table class="w-full text-sm text-left rtl:text-right text-gray-500 border border-gray-200">
    <thead class="text-xs text-gray-700 capitalize bg-gray-200">
        <tr>
            <th scope="col" class="px-6 py-3">No.</th>
            <th scope="col" class="px-6 py-3">ID Pelanggan</th>
            <th scope="col" class="px-6 py-3">Nama Lengkap</th>
            <th scope="col" class="px-6 py-3">Alamat</th>
            <th scope="col" class="px-6 py-3">Periode BL/TH</th>
            <th scope="col" class="px-6 py-3">Stand Meter</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if ($pemakaian->count() > 0)
            @foreach ($pemakaian as $data_pemakaian)
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4">
                        {{ $loop->iteration + ($pemakaian->currentPage() - 1) * $pemakaian->perPage() }}
                    </td>
                    <th class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                            {{ $data_pemakaian->pelanggan->no_kontrol }}
                        </span>
                    </th>
                    <td class="px-6 py-4 capitalize">{{ $data_pemakaian->pelanggan->nama }}</td>
                    <td class="px-6 py-4 capitalize">{{ $data_pemakaian->pelanggan->alamat }}</td>
                    <td class="px-6 py-4 capitalize">
                        {{ '0' . $data_pemakaian->bulan }}
                        -
                        {{ $data_pemakaian->tahun }}
                    </td>
                    <td class="px-6 py-4 capitalize">
                        {{ str_replace('.', '', $data_pemakaian->meter_awal) }}
                        -
                        {{ str_replace('.', '', $data_pemakaian->meter_akhir) }}
                    </td>
                    <td class="px-6 py-4 capitalize">
                        <span
                            class="text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm capitalize
                                                {{ $data_pemakaian->status === 'lunas'
                                                    ? 'bg-green-100 text-green-600'
                                                    : ($data_pemakaian->status === 'pending'
                                                        ? 'bg-yellow-100 text-yellow-600'
                                                        : ($data_pemakaian->status === 'belum bayar'
                                                            ? 'bg-blue-100 text-blue-600'
                                                            : 'bg-red-100 text-red-600')) }}">
                            {{ $data_pemakaian->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="relative">
                            <button id="dropdownActionButton-{{ $data_pemakaian->id_pemakaian }}"
                                data-dropdown-toggle="dropdownAction-{{ $data_pemakaian->id_pemakaian }}"
                                class="inline-flex items-center">
                                <svg class="w-6 h-6 text-gray-800 p-1 rounded-full hover:bg-gray-100 hover:cursor-pointer"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M12 6h.01M12 12h.01M12 18h.01" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownAction-{{ $data_pemakaian->id_pemakaian }}"
                                class="z-10 hidden absolute right-0 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700"
                                    aria-labelledby="dropdownActionButton-{{ $data_pemakaian->id_pemakaian }}">
                                    <li>
                                        <button class="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                            data-modal-target="detail-modal-{{ $data_pemakaian->id_pemakaian }}"
                                            data-modal-toggle="detail-modal-{{ $data_pemakaian->id_pemakaian }}">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-green-600" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3" />
                                                </svg>
                                                Cek Detail
                                            </span>
                                        </button>
                                    </li>
                                    @if ($data_pemakaian->status === 'lunas')
                                        <li>
                                            <button class="block w-full px-4 py-2 text-left hover:bg-gray-100">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 text-red-600 mr-2" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                    </svg>
                                                    Hapus
                                                </span>
                                            </button>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <!-- Main modal untuk detail pemakaian -->
                            <div id="detail-modal-{{ $data_pemakaian->id_pemakaian }}" tabindex="-1"
                                aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-4xl max-h-full">
                                    <!-- Ubah max-width jadi lebih lebar -->
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                            <h3 class="text-lg font-semibold text-gray-900">Detail
                                                Pemakaian</h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-toggle="detail-modal-{{ $data_pemakaian->id_pemakaian }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <!-- Grid untuk informasi detail dalam 2 kolom -->
                                            <div class="grid md:grid-cols-2 gap-6">
                                                <!-- Kolom kiri -->
                                                <div class="space-y-4">
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            ID Pelanggan
                                                        </div>
                                                        <div class="text-sm text-gray-900">
                                                            <span
                                                                class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-blue-100 text-blue-600">
                                                                {{ $data_pemakaian->pelanggan->no_kontrol }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">Nama
                                                            Lengkap</div>
                                                        <div class="text-sm text-gray-900 capitalize">
                                                            {{ $data_pemakaian->pelanggan->nama }}</div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Alamat</div>
                                                        <div class="text-sm text-gray-900 capitalize">
                                                            {{ $data_pemakaian->pelanggan->alamat }}</div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Telepon</div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ $data_pemakaian->pelanggan->telpon }}</div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Kategori</div>
                                                        <div class="text-sm text-gray-900 capitalize">
                                                            {{ $data_pemakaian->pelanggan->jenisPelanggan->kategori }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Kolom kanan -->
                                                <div class="space-y-4">
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Golongan</div>
                                                        <div class="text-sm text-gray-900 capitalize">
                                                            {{ $data_pemakaian->pelanggan->jenisPelanggan->golongan }}
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Tarif/Kwh</div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ 'Rp' . number_format($data_pemakaian->pelanggan->jenisPelanggan->kapasitasDaya->tarif_kwh, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Periode</div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ $data_pemakaian->bulan }} -
                                                            {{ $data_pemakaian->tahun }}</div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Stand Meter</div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ str_replace('.', '', $data_pemakaian->meter_awal) }}
                                                            -
                                                            {{ str_replace('.', '', $data_pemakaian->meter_akhir) }}
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 border-b pb-2">
                                                        <div class="text-sm font-medium text-gray-500">
                                                            Total biaya</div>
                                                        <div class="text-sm text-gray-900">
                                                            {{ 'Rp' . number_format($data_pemakaian->biaya_pemakai, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="mt-6 pt-4">
                                                <div class="flex items-center justify-between">
                                                    <div class="text-sm font-medium text-gray-500">
                                                        Status
                                                    </div>
                                                    <span
                                                        class="text-xs font-medium px-2.5 py-0.5 rounded-sm capitalize
                                                                        {{ $data_pemakaian->status === 'lunas'
                                                                            ? 'bg-green-100 text-green-600'
                                                                            : ($data_pemakaian->status === 'pending'
                                                                                ? 'bg-yellow-100 text-yellow-600'
                                                                                : ($data_pemakaian->status === 'belum bayar'
                                                                                    ? 'bg-blue-100 text-blue-600'
                                                                                    : 'bg-red-100 text-red-600')) }}">
                                                        {{ $data_pemakaian->status }}
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Metode Pembayaran -->
                                            @if ($data_pemakaian->status !== 'lunas')
                                                <div class="mt-6">
                                                    <p class="text-gray-500 mb-4">Pilih metode pembayaran
                                                    </p>
                                                    <div class="flex flex-col sm:flex-row gap-4">
                                                        <button type="button"
                                                            onclick="print('{{ App\Helpers\HashIdHelper::encode($data_pemakaian->id_pemakaian) }}')"
                                                            class="flex items-center justify-between flex-1 p-4 text-gray-800 border border-gray-200 rounded-md hover:bg-gray-100 transition-colors">
                                                            <div>
                                                                <div class="text-lg font-semibold">Cash
                                                                </div>
                                                                <div class="text-gray-500">Tunai</div>
                                                            </div>
                                                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-width="2"
                                                                    d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                            </svg>
                                                        </button>
                                                        <button type="button"
                                                            onclick="prosesPayment('{{ $data_pemakaian->id_pemakaian }}')"
                                                            class="flex items-center justify-between flex-1 p-4 text-gray-800 border border-gray-200 rounded-md hover:bg-gray-100 transition-colors">
                                                            <div>
                                                                <div class="text-lg font-semibold">
                                                                    Non-Tunai
                                                                </div>
                                                                <div class="text-gray-500">E-wallet, Bank
                                                                </div>
                                                            </div>
                                                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <!-- Kondisi dimana didalam tabel tidak ada data -->
            <tr>
                <td colspan="8" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Data tidak ditemukan
                        </h3>
                        <p class="text-gray-500">
                            Silakan mencoba lagi dengan nilai filter yang
                            berbeda
                        </p>
                    </div>
                </td>
            </tr>
        @endif
    </tbody>
</table>
{{-- Pagination --}}
@if ($pemakaian->total() > 10)
    <div class="my-4 px-4">
        {{ $pemakaian->appends(['status' => $currentStatus])->links('pagination.tailwindcss-paginate') }}
    </div>
@endif
