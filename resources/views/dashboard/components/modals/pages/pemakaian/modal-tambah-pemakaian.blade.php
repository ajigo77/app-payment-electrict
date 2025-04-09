@props(['bulan', 'pelanggan'])
<div id="modal-tambah-pemakaian" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Tambah Data Pemakaian
                </h3>
                <button type="button" id="close-modal-tambah-pemakaian"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="modal-tambah-pemakaian">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <form id="form-tambah-pemakaian" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="pelanggan_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih
                            Pelanggan</label>
                        <select id="pelanggan_id" name="pelanggan_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggan as $data)
                                <option value="{{ $data->id_pelanggan }}">{{ $data->nama }} -
                                    {{ $data->no_kontrol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="bulan" class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                        <select id="bulan" name="bulan" disabled
                            class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed capitalize">
                            @foreach ($bulan as $key => $value)
                                <option value="{{ $key + 1 }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                        <input type="text" name="tahun" id="tahun" disabled
                            class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed">
                    </div>
                    <div class="col-span-1">
                        <label for="meter_awal" class="block mb-2 text-sm font-medium text-gray-900">Meter
                            Awal</label>
                        <input type="text" name="meter_awal" id="meter_awal" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="meter_akhir" class="block mb-2 text-sm font-medium text-gray-900">Meter
                            Akhir</label>
                        <input type="text" name="meter_akhir" id="meter_akhir" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="jumlah_pakai" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                            Pakai</label>
                        <input type="text" name="jumlah_pakai" id="jumlah_pakai" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="biaya_pemakai" class="block mb-2 text-sm font-medium text-gray-900">
                            Biaya Pemakai
                        </label>
                        <input type="text" name="biaya_pemakai" id="biaya_pemakai" disabled
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="col-span-1">
                        <label for="biaya_beban_pemakai" class="block mb-2 text-sm font-medium text-gray-900">Biaya
                            Beban Pemakai</label>
                        <input type="text" name="biaya_beban_pemakai" id="biaya_beban_pemakai" disabled
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
