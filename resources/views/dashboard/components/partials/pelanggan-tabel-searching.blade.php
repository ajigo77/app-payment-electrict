<table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 capitalize bg-gray-100">
        <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Nama</th>
            <th class="px-4 py-3">No Kontrol</th>
            <th class="px-4 py-3">Alamat</th>
            <th class="px-4 py-3">Telepon</th>
            <th class="px-4 py-3">Jenis Pelanggan</th>
            <th class="px-4 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pelanggan as $data_pelanggan)
            <tr class="divide-y divide-gray-200 w-full hover:bg-gray-50">
                <td class="px-4 py-3 capitalize">
                    {{ $loop->iteration + ($pelanggan->currentPage() - 1) * $pelanggan->perPage() }}</td>
                <td class="px-4 py-3 capitalize">{{ $data_pelanggan->nama }}</td>
                <td class="px-4 py-3 capitalize">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                        {{ $data_pelanggan->no_kontrol }}
                    </span>
                </td>
                <td class="px-4 py-3 capitalize">{{ $data_pelanggan->alamat }}</td>
                <td class="px-4 py-3 capitalize">
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                        {{ $data_pelanggan->telpon }}
                    </span>
                </td>
                <td class="px-4 py-3 capitalize">
                    {{ $data_pelanggan->jenisPelanggan->kategori }}/
                    {{ $data_pelanggan->jenisPelanggan->golongan }}/
                    {{ $data_pelanggan->jenisPelanggan->kapasitasDaya->batas_daya . ' VA' }}
                </td>
                <td class="px-4 py-3">
                    <div class="flex justify-center gap-2">
                        <button id="dropdownActionButton-{{ $data_pelanggan->id_pelanggan }}"
                            data-dropdown-toggle="dropdownAction-{{ $data_pelanggan->id_pelanggan }}"
                            class="inline-flex items-center">
                            <svg class="w-6 h-6 text-gray-800 p-1 rounded-full hover:bg-gray-100 hover:cursor-pointer"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M12 6h.01M12 12h.01M12 18h.01" />
                            </svg>
                        </button>
                    </div>

                    {{-- Dropdown Action --}}
                    <div id="dropdownAction-{{ $data_pelanggan->id_pelanggan }}"
                        class="z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700 px-2">
                            <li>
                                <button class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                    data-modal-target="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}"
                                    data-modal-toggle="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                        Edit
                                    </span>
                                </button>
                            </li>
                            <li>
                                <button class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                    data-modal-target="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}"
                                    data-modal-toggle="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}">
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

                    {{-- Modal Edit --}}
                    <div id="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}" tabindex="-1"
                        aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Edit Pelanggan
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-toggle="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form class="p-4 md:p-5" id="form-edit-pelanggan"
                                    action="{{ route('dashboard.pelanggan.update', $data_pelanggan->id_pelanggan) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label for="nama-{{ $data_pelanggan->id_pelanggan }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Nama
                                                Lengkap</label>
                                            <input type="text" name="nama"
                                                id="nama-{{ $data_pelanggan->id_pelanggan }}"
                                                value="{{ old('nama', $data_pelanggan->nama) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 capitalize">
                                        </div>
                                        <div class="col-span-1">
                                            <label for="no_kontrol-{{ $data_pelanggan->id_pelanggan }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">No
                                                Kontrol</label>
                                            <input type="text" name="no_kontrol"
                                                id="no_kontrol-{{ $data_pelanggan->id_pelanggan }}"
                                                value="{{ old('no_kontrol', $data_pelanggan->no_kontrol) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 capitalize">
                                        </div>
                                        <div class="col-span-2 md:col-span-1">
                                            <label for="telpon-{{ $data_pelanggan->id_pelanggan }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Telepon</label>
                                            <input type="text" name="telpon"
                                                id="telpon-{{ $data_pelanggan->id_pelanggan }}"
                                                value="{{ old('telpon', $data_pelanggan->telpon) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 capitalize">
                                        </div>
                                        <div class="col-span-2 md:col-span-1">
                                            <label for="jenis_pelanggan_{{ $data_pelanggan->id_pelanggan }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Jenis
                                                Pelanggan</label>
                                            <select id="jenis_pelanggan_{{ $data_pelanggan->id_pelanggan }}"
                                                name="jenis_pelanggan_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 capitalize">
                                                @foreach ($jenisPelanggan as $data_jenis_pelanggan)
                                                    <option value="{{ $data_jenis_pelanggan->id_jenis_pelanggan }}"
                                                        {{ old('jenis_pelanggan_id', $data_pelanggan->jenis_pelanggan_id) == $data_jenis_pelanggan->id_jenis_pelanggan ? 'selected' : '' }}>
                                                        {{ $data_jenis_pelanggan->kategori }}/
                                                        {{ $data_jenis_pelanggan->golongan }}/
                                                        {{ $data_jenis_pelanggan->kapasitasDaya->batas_daya . ' VA' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="alamat-{{ $data_pelanggan->id_pelanggan }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                                            <textarea name="alamat" id="alamat-{{ $data_pelanggan->id_pelanggan }}" rows="3"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 capitalize">{{ old('alamat', $data_pelanggan->alamat) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Simpan perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Delete --}}
                    <div id="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow-sm">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                                        Apakah anda yakin ingin menghapus pelanggan ini?
                                    </h3>
                                    <div class="inline-flex gap-6 w-full items-center justify-center">
                                        <form
                                            action="{{ route('dashboard.pelanggan.delete', $data_pelanggan->id_pelanggan) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                data-modal-hide="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}"
                                                type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya, Hapus
                                            </button>
                                        </form>
                                        <button
                                            data-modal-hide="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}"
                                            type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <!-- Kondisi dimana didalam tabel tidak ada data -->
            <tr>
                <td colspan="7" class="px-6 py-16 text-center">
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
@if ($pelanggan->total() > 10)
    <div class="my-4 px-4">
        {{ $pelanggan->links('pagination.tailwindcss-paginate') }}
    </div>
@endif
