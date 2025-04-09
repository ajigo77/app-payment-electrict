@props(['data'])
@if (isset($data))
    <div id="modal-edit-kapasitas-{{ $data->id_kapasitas_daya }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Edit Data Kapasitas
                    </h3>
                    <button type="button" id="close-modal-edit-kapasitas-{{ $data->id_kapasitas_daya }}"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="modal-edit-kapasitas-{{ $data->id_kapasitas_daya }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <form id="form-edit-kapasitas-{{ $data->id_kapasitas_daya }}" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-1">
                            <label for="batas_daya-{{ $data->id_kapasitas_daya }}"
                                class="block mb-2 text-sm font-medium text-gray-900">Batas Daya</label>
                            <input type="text" name="batas_daya" id="batas_daya-{{ $data->id_kapasitas_daya }}" value="{{ old('batas_daya', $data->batas_daya) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div class="col-span-1">
                            <label for="biaya_beban-{{ $data->id_kapasitas_daya }}"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Biaya Beban
                            </label>
                            <input type="text" name="biaya_beban" id="biaya_beban-{{ $data->id_kapasitas_daya }}" value="{{ old('biaya_beban', 'Rp' . number_format($data->biaya_beban, 0, ',', '.')) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div class="col-span-1">
                            <label for="tarif-{{ $data->id_kapasitas_daya }}"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                Tarif/kwh
                            </label>
                            <input type="text" name="tarif_kwh" id="tarif_kwh-{{ $data->id_kapasitas_daya }}" value="{{ old('tarif_kwh', 'Rp' . number_format($data->tarif_kwh, 0, ',', '.')) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
