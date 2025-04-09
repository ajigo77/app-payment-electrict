@props(['data'])
<div id="modal-edit-pemakaian-{{ $data->id_pemakaian }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Edit Pemakaian
                </h3>
                <button type="button" id="close-modal-edit-pemakaian-{{ $data->id_pemakaian }}"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="modal-edit-pemakaian-{{ $data->id_pemakaian }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <form id="form-edit-pemakaian-{{ $data->id_pemakaian }}" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <input type="hidden" name="pelanggan_id" id="pelanggan-id-{{ $data->id_pemakaian }}"
                        value="{{ $data->id_pemakaian }}">
                    <input type="hidden" name="status" id="status-{{ $data->id_pemakaian }}"
                        value="{{ $data->status }}">
                    <div class="col-span-1">
                        <label for="bulan-{{ $data->id_pemakaian }}"
                            class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                        <select id="bulan-{{ $data->id_pemakaian }}" name="bulan"
                            class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed capitalize">
                            @foreach ($bulan as $key => $value)
                                <option value="{{ $key + 1 }}" {{ $key + 1 == $data->bulan ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="tahun-{{ $data->id_pemakaian }}"
                            class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                        <input type="text" name="tahun" id="tahun-{{ $data->id_pemakaian }}"
                            value="{{ old('tahun', $data->tahun) }}"
                            class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed">
                    </div>
                    <div class="col-span-1">
                        <label for="meter_awal-{{ $data->id_pemakaian }}"
                            class="block mb-2 text-sm font-medium text-gray-900">Meter
                            Awal</label>
                        <input type="text" name="meter_awal" id="meter_awal-{{ $data->id_pemakaian }}"
                            value="{{ old('meter_awal', $data->meter_awal) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="meter_akhir-{{ $data->id_pemakaian }}"
                            class="block mb-2 text-sm font-medium text-gray-900">Meter
                            Akhir</label>
                        <input type="text" name="meter_akhir" id="meter_akhir-{{ $data->id_pemakaian }}"
                            value="{{ old('meter_akhir', $data->meter_akhir) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="jumlah_pakai-{{ $data->id_pemakaian }}"
                            class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                            Pakai</label>
                        <input type="text" name="jumlah_pakai" id="jumlah_pakai-{{ $data->id_pemakaian }}"
                            value="{{ old('jumlah_pakai', $data->jumlah_pakai) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="biaya_pemakai-{{ $data->id_pemakaian }}"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Biaya Pemakai
                        </label>
                        <input type="text" name="biaya_pemakai" id="biaya_pemakai-{{ $data->id_pemakaian }}"
                            value="{{ old('biaya_pemakai', $data->biaya_pemakai) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="biaya_beban_pemakai-{{ $data->id_pemakaian }}"
                            class="block mb-2 text-sm font-medium text-gray-900">Biaya
                            Beban Pemakai</label>
                        <input type="text" name="biaya_beban_pemakai"
                            id="biaya_beban_pemakai-{{ $data->id_pemakaian }}"
                            value="{{ old('biaya_beban_pemakai', $data->biaya_beban_pemakai) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
