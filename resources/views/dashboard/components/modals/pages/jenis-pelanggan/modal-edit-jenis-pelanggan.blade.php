@props(['data', 'dataKapasitas'])
@if (isset($data) || isset($dataKapasitas))
    <div id="modal-edit-jenis-pelanggan-{{ $data->id_jenis_pelanggan }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Data Kapasitas
                    </h3>
                    <button type="button" id="close-modal-edit-jenis-pelanggan-{{ $data->id_jenis_pelanggan }}"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="modal-edit-jenis-pelanggan-{{ $data->id_jenis_pelanggan }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <form id="form-edit-jenis-pelannggan-{{ $data->id_jenis_pelanggan }}" class="p-4 md:p-5" method="POST" action="{{ route('dashboard.jenis-pelanggan.update', $data->id_jenis_pelanggan) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-1">
                            <label for="kategori-{{ $data->id_jenis_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                            <input type="text" name="kategori" id="kategori-{{ $data->id_jenis_pelanggan }}" value="{{ old('kategori', $data->kategori) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div class="col-span-1">
                            <label for="golongan-{{ $data->id_jenis_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Golongan
                            </label>
                            <input type="text" name="golongan" id="golongan-{{ $data->id_jenis_pelanggan }}" value="{{ old('golongan', $data->golongan) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 uppercase">
                        </div>
                        <div class="col-span-1">
                            <label for="deskripsi-{{ $data->id_jenis_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Deskripsi
                            </label>
                            <input type="text" name="deskripsi" id="deskripsi-{{ $data->id_jenis_pelanggan }}" value="{{ old('deskripsi', $data->deskripsi) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div class="col-span-1">
                            <label for="kapasitas_daya_id-{{ $data->id_jenis_pelanggan }}"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Pilih Kapasitas
                            </label>
                            <select id="kapasitas_daya_id-{{ $data->id_jenis_pelanggan }}" name="kapasitas_daya_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @forelse ($dataKapasitas as $p)
                                    <option value="{{ $p->id_kapasitas_daya }}" {{ old('kapasitas_daya_id', $p->id_kapasitas_daya) == $data->kapasitas_daya_id ? 'selected' : '' }}>
                                        {{ $p->batas_daya . ' VA ' . ' \ ' . 'Rp' . number_format($p->tarif_kwh, 0, ',', '.') }}
                                    </option>
                                    @empty
                                    <option disabled class="cursor-not-allowed text-gray-400">Tidak ada data</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif
