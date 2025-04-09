<table class="w-full text-sm text-left">
    <thead class="text-xs text-gray-700 capitalize bg-gray-100">
        <tr>
            <th class="px-6 py-4 font-medium">No</th>
            <th class="px-6 py-4 font-medium">Batas Daya</th>
            <th class="px-6 py-4 font-medium">Biaya Beban</th>
            <th class="px-6 py-4 font-medium">Tarif/Kwh</th>
            <th class="px-6 py-4 font-medium text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kapasitas as $data)
            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $loop->iteration + ($kapasitas->currentPage() - 1) * $kapasitas->perPage() }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ number_format($data->batas_daya, 0, ',', '.') }} VA
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    Rp{{ number_format($data->biaya_beban, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    Rp{{ number_format($data->tarif_kwh, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center gap-2">
                        <button id="dropdownActionButton-{{ $data->id_kapasitas_daya }}"
                            data-dropdown-toggle="dropdownAction-{{ $data->id_kapasitas_daya }}"
                            class="inline-flex items-center p-1 text-gray-500 hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M12 6h.01M12 12h.01M12 18h.01" />
                            </svg>
                        </button>
                    </div>

                    {{-- Dropdown Action --}}
                    <div id="dropdownAction-{{ $data->id_kapasitas_daya }}"
                        class="z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44">
                        <ul class="py-2 text-sm text-gray-700">
                            <li>
                                <button
                                    class="w-full px-4 py-2 text-left hover:bg-gray-50 flex items-center gap-2 text-green-600"
                                    data-modal-target="modal-edit-pelanggan-{{ $data->id_kapasitas_daya }}"
                                    data-modal-toggle="modal-edit-pelanggan-{{ $data->id_kapasitas_daya }}">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                    Edit
                                </button>
                            </li>
                            <li>
                                <button
                                    class="w-full px-4 py-2 text-left hover:bg-gray-50 flex items-center gap-2 text-red-600"
                                    data-modal-target="popup-modal-delete-{{ $data->id_kapasitas_daya }}"
                                    data-modal-toggle="popup-modal-delete-{{ $data->id_kapasitas_daya }}">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                    Hapus
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data</h3>
                        <p class="text-gray-500">Belum ada data kapasitas daya yang tersedia</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
{{-- Pagination --}}
@if ($kapasitas->total() > 10)
    <div class="my-4 px-4">
        {{ $kapasitas->links('pagination.tailwindcss-paginate') }}
    </div>
@endif
