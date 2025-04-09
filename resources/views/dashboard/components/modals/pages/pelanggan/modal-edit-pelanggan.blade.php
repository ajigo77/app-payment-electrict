@props(['data_pelanggan'])
@if (isset($data_pelanggan))
    <div id="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Edit Pelanggan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="form-edit-pelanggan"
                    action="{{ route('dashboard.pelanggan.update', $data_pelanggan->id_pelanggan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-1">
                            <label for="nama-{{ $data_pelanggan->id_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Lengkap</label>
                            <input type="text" name="nama" id="nama-{{ $data_pelanggan->id_pelanggan }}"
                                value="{{ old('nama', $data_pelanggan->nama) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 capitalize">
                        </div>
                        <div class="col-span-1">
                            <label for="no_kontrol-{{ $data_pelanggan->id_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">No
                                Kontrol</label>
                            <input type="text" name="no_kontrol" id="no_kontrol-{{ $data_pelanggan->id_pelanggan }}"
                                value="{{ old('no_kontrol', $data_pelanggan->no_kontrol) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 capitalize">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="telpon-{{ $data_pelanggan->id_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">Telepon</label>
                            <input type="text" name="telpon" id="telpon-{{ $data_pelanggan->id_pelanggan }}"
                                value="{{ old('telpon', $data_pelanggan->telpon) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 capitalize">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label for="jenis_pelanggan_{{ $data_pelanggan->id_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">Jenis
                                Pelanggan</label>
                            <select id="jenis_pelanggan_{{ $data_pelanggan->id_pelanggan }}" name="jenis_pelanggan_id"
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
@endif
