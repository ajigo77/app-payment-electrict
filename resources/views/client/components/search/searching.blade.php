<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-200 capitalize">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                No.
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                No Kontrol
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                Nama
                Pelanggan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                Periode
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                Pemakaian
                (kWh)
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                Total Tagihan
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                Status
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @if ($data_pelanggan->count() > 0)
            @foreach ($data_pelanggan as $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $loop->iteration + ($data_pelanggan->currentPage() - 1) * $data_pelanggan->perPage() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                            {{ $data->pelanggan->no_kontrol }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->pelanggan->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ '0' . $data->bulan }} -
                        {{ $data->tahun }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $data->pelanggan->jenisPelanggan->kapasitasDaya->tarif_kwh }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ 'Rp' . number_format($data->biaya_beban_pemakai, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize {{ $data->status === 'lunas'
                                ? 'bg-green-100 text-green-800'
                                : ($data->status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-red-100 text-red-800') }}">
                            {{ $data->status }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            Data tidak ditemukan
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
@if ($data_pelanggan->total() > 10)
    <div class="my-4 px-4">
        {{ $data_pelanggan->appends(['search' => $currentStatus])->links('pagination.tailwindcss-paginate') }}
    </div>
@endif
