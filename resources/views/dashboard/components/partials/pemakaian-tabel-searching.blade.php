<table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 capitalize bg-gray-50">
        <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Periode</th>
            <th class="px-4 py-3">Meter Awal</th>
            <th class="px-4 py-3">Meter Akhir</th>
            <th class="px-4 py-3">Jumlah Pakai</th>
            <th class="px-4 py-3">Biaya Beban</th>
            <th class="px-4 py-3">Biaya Pemakaian</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse ($pemakaian as $data)
            <tr class="hover:bg-gray-50 capitalize">
                <td class="px-4 py-3">
                    {{ $loop->iteration + ($pemakaian->currentPage() - 1) * $pemakaian->perPage() }}</td>
                <td class="px-4 py-3">{{ $data->bulan }}/{{ $data->tahun }}</td>
                <td class="px-4 py-3">{{ number_format($data->meter_awal, 0, ',', '.') }}</td>
                <td class="px-4 py-3">{{ number_format($data->meter_akhir, 0, ',', '.') }}</td>
                <td class="px-4 py-3">{{ $data->jumlah_pakai }}</td>
                <td class="px-4 py-3">Rp {{ number_format($data->biaya_beban_pemakai, 0, ',', '.') }}</td>
                <td class="px-4 py-3">Rp {{ number_format($data->biaya_pemakai, 0, ',', '.') }}</td>
                <td class="px-4 py-3">
                    <span
                        class="{{ $data->status === 'lunas'
                            ? 'bg-green-100 text-green-600'
                            : ($data->status === 'pending'
                                ? 'bg-yellow-100 text-yellow-600'
                                : ($data->status === 'belum bayar'
                                    ? 'bg-blue-100 text-blue-600'
                                    : 'bg-red-100 text-red-600')) }} text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                        {{ $data->status }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex justify-center gap-2">
                        <button id="dropdownActionButton-{{ $data->id_pemakaian }}"
                            data-dropdown-toggle="dropdownAction-{{ $data->id_pemakaian }}"
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
                    <div id="dropdownAction-{{ $data->id_pemakaian }}"
                        class="z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700 px-2">
                            <li>
                                <button class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                    data-modal-target="modal-edit-pemakaian-{{ $data->id_pemakaian }}"
                                    data-modal-toggle="modal-edit-pemakaian-{{ $data->id_pemakaian }}">
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
                                    data-modal-target="modal-delete-pemakaian-{{ $data->id_pemakaian }}"
                                    data-modal-toggle="modal-delete-pemakaian-{{ $data->id_pemakaian }}">
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

                    {{-- Modal Delete --}}
                    <div id="modal-delete-pemakaian-{{ $data->id_pemakaian }}" tabindex="-1"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow-sm">
                                <button type="button"
                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="modal-delete-pemakaian-{{ $data->id_pemakaian }}">
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
                                        <form action="{{ route('dashboard.pelanggan.delete', $data->id_pemakaian) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button data-modal-hide="modal-delete-pemakaian-{{ $data->id_pemakaian }}"
                                                type="submit"
                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya, Hapus
                                            </button>
                                        </form>
                                        <button data-modal-hide="modal-delete-pemakaian-{{ $data->id_pemakaian }}"
                                            type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Edit --}}
                    @php
                        $bulan = [
                            'januari',
                            'februari',
                            'maret',
                            'april',
                            'mei',
                            'juni',
                            'juli',
                            'agustus',
                            'september',
                            'oktober',
                            'november',
                            'desember',
                        ];
                    @endphp
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
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </div>
                                <form id="form-edit-pemakaian-{{ $data->id_pemakaian }}" class="p-4 md:p-5">
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <input type="hidden" name="pelanggan_id"
                                            id="pelanggan-id-{{ $data->id_pemakaian }}"
                                            value="{{ $data->id_pemakaian }}">
                                        <input type="hidden" name="status" id="status-{{ $data->id_pemakaian }}"
                                            value="{{ $data->status }}">
                                        <div class="col-span-1">
                                            <label for="bulan-{{ $data->id_pemakaian }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                                            <select id="bulan-{{ $data->id_pemakaian }}" name="bulan"
                                                class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed capitalize">
                                                @foreach ($bulan as $key => $value)
                                                    <option value="{{ $key + 1 }}"
                                                        {{ $key + 1 == $data->bulan ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-span-1">
                                            <label for="tahun-{{ $data->id_pemakaian }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                                            <input type="text" name="tahun"
                                                id="tahun-{{ $data->id_pemakaian }}"
                                                value="{{ old('tahun', $data->tahun) }}"
                                                class="bg-gray-100 border border-gray-300 text-gray-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed">
                                        </div>
                                        <div class="col-span-1">
                                            <label for="meter_awal-{{ $data->id_pemakaian }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Meter
                                                Awal</label>
                                            <input type="text" name="meter_awal"
                                                id="meter_awal-{{ $data->id_pemakaian }}"
                                                value="{{ old('meter_awal', $data->meter_awal) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </div>
                                        <div class="col-span-1">
                                            <label for="meter_akhir-{{ $data->id_pemakaian }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Meter
                                                Akhir</label>
                                            <input type="text" name="meter_akhir"
                                                id="meter_akhir-{{ $data->id_pemakaian }}"
                                                value="{{ old('meter_akhir', $data->meter_akhir) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </div>
                                        <div class="col-span-1">
                                            <label for="jumlah_pakai-{{ $data->id_pemakaian }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                                                Pakai</label>
                                            <input type="text" name="jumlah_pakai"
                                                id="jumlah_pakai-{{ $data->id_pemakaian }}"
                                                value="{{ old('jumlah_pakai', $data->jumlah_pakai) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </div>
                                        <div class="col-span-1">
                                            <label for="biaya_pemakai-{{ $data->id_pemakaian }}"
                                                class="block mb-2 text-sm font-medium text-gray-900">
                                                Biaya Pemakai
                                            </label>
                                            <input type="text" name="biaya_pemakai"
                                                id="biaya_pemakai-{{ $data->id_pemakaian }}"
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
                </td>
            </tr>
        @empty
            <!-- Kondisi dimana didalam tabel tidak ada data -->
            <tr>
                <td colspan="9" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            Tidak ada data
                        </h3>
                        <p class="text-gray-500">
                            Mungkin belum memiliki data pemakaian
                        </p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
{{-- Pagination --}}
@if ($pemakaian->total() > 10)
    <div class="my-4 px-4">
        {{ $pemakaian->links('pagination.tailwindcss-paginate') }}
    </div>
@endif
