@props(['data_pemakaian'])
@if (isset($data_pemakaian))
    <div id="detail-modal-{{ $data_pemakaian->id_pemakaian }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Detail pembayaran
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="detail-modal-{{ $data_pemakaian->id_pemakaian }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                            d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                    </svg>
                                </button>
                                <button type="button" onclick="prosesPayment('{{ $data_pemakaian->id_pemakaian }}')"
                                    class="flex items-center justify-between flex-1 p-4 text-gray-800 border border-gray-200 rounded-md hover:bg-gray-100 transition-colors">
                                    <div>
                                        <div class="text-lg font-semibold">
                                            Non-Tunai
                                        </div>
                                        <div class="text-gray-500">E-wallet, Bank
                                        </div>
                                    </div>
                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
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
@endif
