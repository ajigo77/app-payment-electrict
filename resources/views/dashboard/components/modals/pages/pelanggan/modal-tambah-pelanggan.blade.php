@props(['jenisPelanggan'])
<div id="modal-tambah-pelanggan" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Pelanggan Baru
                </h3>
                <button type="button" id="close-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="modal-tambah-pelanggan">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('dashboard.pelanggan.create') }}" method="POST"
                id="form-modal-tambah-pelanggan">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="@error('nama')
                                        border border-red-600 text-red-600 focus:ring-red-600 focus:border-red-600
                                    @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            required>
                        @error('nama')
                            <span class="text-red-600 text-[10px] font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="no_kontrol" class="block mb-2 text-sm font-medium text-gray-900">No
                            Kontrol</label>
                        <input type="text" name="no_kontrol" id="no_kontrol" value="{{ old('no_kontrol') }}"
                            class="@error('no_kontrol')
                                        border border-red-600 text-red-600 focus:ring-red-600 focus:border-red-600
                                    @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            required>
                        @error('no_kontrol')
                            <span class="text-red-600 text-[10px] font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="@error('alamat')
                                        border border-red-600 text-red-600 focus:ring-red-600 focus:border-red-600
                                    @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="text-red-600 text-[10px] font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="telpon" class="block mb-2 text-sm font-medium text-gray-900">Telepon</label>
                        <input type="text" name="telpon" id="telpon" value="{{ old('telpon') }}"
                            class="@error('telpon')
                                        border border-red-600 text-red-600 focus:ring-red-600 focus:border-red-600
                                    @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            required>
                        @error('telpon')
                            <span class="text-red-600 text-[10px] font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label for="jenis_pelanggan" class="block mb-2 text-sm font-medium text-gray-900">Jenis
                            Pelanggan</label>
                        <select id="jenis_pelanggan_id" name="jenis_pelanggan_id"
                            class="@error('jenis_pelanggan_id')
                                        border border-red-600 text-red-600 focus:ring-red-600 focus:border-red-600
                                    @enderror border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 capitalize">
                            <option value="" selected disabled>Pilih Jenis Pelanggan</option>
                            @foreach ($jenisPelanggan as $data_jenis_pelanggan)
                                <option value="{{ $data_jenis_pelanggan->id_jenis_pelanggan }}"
                                    {{ old('jenis_pelanggan_id') == $data_jenis_pelanggan->id_jenis_pelanggan ? 'selected' : '' }}>
                                    {{ $data_jenis_pelanggan->kategori }}/
                                    {{ $data_jenis_pelanggan->golongan }}/
                                    {{ $data_jenis_pelanggan->kapasitasDaya->batas_daya . ' VA' }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_pelanggan_id')
                            <span class="text-red-600 text-[10px] font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
