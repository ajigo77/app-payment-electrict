<table class="w-full text-sm text-left text-gray-500 border border-gray-200">
    <thead class="text-xs text-gray-700 capitalize bg-gray-100">
        <tr>
            <th class="px-4 py-2 capitalize">No</th>
            <th class="px-4 py-2 capitalize">ID Pel</th>
            <th class="px-4 py-2 capitalize">Nama</th>
            <th class="px-4 py-2 capitalize">Tarif/Daya</th>
            <th class="px-4 py-2 capitalize">Bln/Thn</th>
            <th class="px-4 py-2 capitalize">Jenis Pembayaran</th>
            <th class="px-4 py-2 capitalize">Total</th>
            <th class="px-4 py-2 capitalize">Status</th>
            <th class="px-4 py-2 capitalize">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transaksiHariIni as $transaksi)
            <tr>
                <td class="px-4 py-2">
                    {{ $loop->iteration + ($transaksiHariIni->currentPage() - 1) * $transaksiHariIni->perPage() }}
                </td>
                <td class="px-4 py-2 capitalize">
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                        {{ $transaksi->pemakaian->pelanggan->no_kontrol }}
                    </span>
                </td>
                <td class="px-4 py-2 capitalize">{{ $transaksi->pemakaian->pelanggan->nama }}</td>
                <td class="px-4 py-2 capitalize">
                    {{ $transaksi->pemakaian->pelanggan->jenisPelanggan->golongan }}/{{ $transaksi->pemakaian->pelanggan->jenisPelanggan->kapasitasDaya->batas_daya }}
                    VA
                </td>
                <td class="px-4 py-2 capitalize">
                    {{ $transaksi->pemakaian->bulan }}/{{ $transaksi->pemakaian->tahun }}</td>
                <td class="px-4 py-2 capitalize">{{ $transaksi->jenis_pembayaran }}</td>
                <td class="px-4 py-2 capitalize">
                    {{ 'Rp' . number_format($transaksi->total_bayar, 0, ',', '.') }}
                </td>
                <td class="px-4 py-2 capitalize">
                    <span
                        class="{{ $transaksi->status === 'success' ? 'bg-green-100 text-green-800' : ($transaksi->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($transaksi->status === 'failed' || $transaksi->status === 'expired' || $transaksi->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }} text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                        {{ $transaksi->status }}
                    </span>
                </td>
                <td class="px-4 py-2">
                    <button id="dropdownActionButton-{{ $transaksi->id_pembayaran }}"
                        data-dropdown-toggle="dropdownAction-{{ $transaksi->id_pembayaran }}"
                        class="inline-flex items-center">
                        <svg class="w-6 h-6 text-gray-800 p-1 rounded-full hover:bg-gray-100 hover:cursor-pointer"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M12 6h.01M12 12h.01M12 18h.01" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownAction-{{ $transaksi->id_pembayaran }}"
                        class="z-10 hidden absolute right-0 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700"
                            aria-labelledby="dropdownActionButton-{{ $transaksi->id_pembayaran }}">
                            <li>
                                <button class="block w-full px-4 py-2 text-left hover:bg-gray-100">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 text-red-600 mr-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                        Hapus
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <!-- Kondisi dimana didalam tabel tidak ada data -->
            <tr>
                <td colspan="9" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Data tidak ditemukan
                        </h3>
                        <p class="text-gray-500">
                            Silakan coba lagi dengan keyword yang lain
                        </p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
{{-- Pagination --}}
@if ($transaksiHariIni->total() > 10)
    <div class="my-4 px-4">
        {{ $transaksiHariIni->links('pagination.tailwindcss-paginate') }}
    </div>
@endif
