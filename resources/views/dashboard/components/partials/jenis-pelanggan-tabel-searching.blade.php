<table class="w-full text-sm text-left">
    <thead class="text-xs text-gray-700 capitalize bg-gray-100">
        <tr>
            <th class="px-6 py-4 font-medium">No</th>
            <th class="px-6 py-4 font-medium">Kategori</th>
            <th class="px-6 py-4 font-medium">Golongan</th>
            <th class="px-6 py-4 font-medium">Deskripsi</th>
            <th class="px-6 py-4 font-medium text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jenisPelanggan as $data)
            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $loop->iteration + ($jenisPelanggan->currentPage() - 1) * $jenisPelanggan->perPage() }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="{{ $data->kategori === 'non-subsidi' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }} text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm capitalize">
                        {{ $data->kategori }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $data->golongan }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="line-clamp-1" title="{{ $data->deskripsi }}">
                        {{ \Illuminate\Support\Str::limit($data->deskripsi, 50, '...') }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center gap-2">
                        <button id="dropdownActionButton-{{ $data->id_jenis_pelanggan }}"
                            data-dropdown-toggle="dropdownAction-{{ $data->id_jenis_pelanggan }}"
                            class="inline-flex items-center p-1 text-gray-500 hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M12 6h.01M12 12h.01M12 18h.01" />
                            </svg>
                        </button>
                    </div>

                    {{-- Dropdown Action --}}
                    <div id="dropdownAction-{{ $data->id_jenis_pelanggan }}"
                        class="z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44">
                        <ul class="py-2 text-sm text-gray-700">
                            <li>
                                <button
                                    class="w-full px-4 py-2 text-left hover:bg-gray-50 flex items-center gap-2 text-green-600"
                                    data-modal-target="modal-edit-kapasitas-{{ $data->id_jenis_pelanggan }}"
                                    data-modal-toggle="modal-edit-kapasitas-{{ $data->id_jenis_pelanggan }}">
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
                                    data-modal-target="popup-modal-delete-{{ $data->id_jenis_pelanggan }}"
                                    data-modal-toggle="popup-modal-delete-{{ $data->id_jenis_pelanggan }}">
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
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Data tidak ditemukan</h3>
                        <p class="text-gray-500">Coba cari lagi dengan keyword yang lain</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
