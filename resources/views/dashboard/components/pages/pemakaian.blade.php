@extends('dashboard.layouts.main')

@section('content')
    <div class="container px-4 py-6">
        {{-- Header & Stats --}}
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Data Pemakaian Listrik</h1>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 3v4c0 .6-.4 1-1 1H5m4 8h6m-6-4h6m4-8v16c0 .6-.4 1-1 1H6a1 1 0 0 1-1-1V8c0-.4.1-.6.3-.8l4-4c.2-.2.4-.3.7-.3h8c.6 0 1 .4 1 1Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Sudah Lunas</p>
                            <p class="text-xl font-semibold">{{ $lunas }} Pelanggan</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 mr-4">
                            <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 13v2m0 4h.01M12 3c4.2 0 7.5 2 7.5 4.5S16.2 12 12 12s-7.5-2-7.5-4.5S7.8 3 12 3ZM3 19c0-2.5 3.3-4.5 7.5-4.5s7.5 2 7.5 4.5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Belum Bayar</p>
                            <p class="text-xl font-semibold">{{ $belumBayar }} Pelanggan</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-4 justify-between">
                <button id="btn-modal-tambah-pemakaian" data-modal-target="modal-tambah-pemakaian"
                    data-modal-toggle="modal-tambah-pemakaian"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Pemakaian
                </button>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 opacity-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <form id="search-form" class="m-0">
                        <input type="search" id="input-search"
                            class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 placeholder:opacity-50"
                            placeholder="Search..." />
                    </form>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-lg border border-gray-100 overflow-hidden">
            <div class="relative overflow-x-auto data-table-pemakaian">
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
                                            @if ($data->status !== 'lunas')
                                                <li>
                                                    <button
                                                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                                        data-modal-target="modal-edit-pemakaian-{{ $data->id_pemakaian }}"
                                                        data-modal-toggle="modal-edit-pemakaian-{{ $data->id_pemakaian }}">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-2 text-green-600" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                            </svg>
                                                            Edit
                                                        </span>
                                                    </button>
                                                </li>
                                            @endif
                                            @if ($data->status === 'lunas')
                                                <li>
                                                    <button
                                                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                                        data-modal-target="modal-delete-pemakaian-{{ $data->id_pemakaian }}"
                                                        data-modal-toggle="modal-delete-pemakaian-{{ $data->id_pemakaian }}">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 text-red-600 mr-2" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                            </svg>
                                                            Hapus
                                                        </span>
                                                    </button>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    {{-- Array Bulan --}}
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

                                    {{-- Modal Delete --}}
                                    @include('dashboard.components.modals.pages.pemakaian.modal-delete-pemakaian', ['data' => $data])

                                    {{-- Modal Edit --}}
                                    @include('dashboard.components.modals.pages.pemakaian.modal-edit-pemakaian', ['data' => $data])
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
            </div>
        </div>

        {{-- Modal Tambah --}}
        @include('dashboard.components.modals.pages.pemakaian.modal-tambah-pemakaian', ['bulan' => $bulan, 'pelanggan' => $pelanggan])
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const pelangganSelect = document.getElementById('pelanggan_id');
            const formInputs = document.querySelectorAll(
                '#form-tambah-pemakaian input, #form-tambah-pemakaian select:not(#pelanggan_id)');
            const meterAwalInput = document.getElementById('meter_awal');
            const meterAkhirInput = document.getElementById('meter_akhir');
            const jumlahPakaiInput = document.getElementById('jumlah_pakai');
            const biayaBebanPemakaiInput = document.getElementById('biaya_beban_pemakai');
            const biayaPemakaiInput = document.getElementById('biaya_pemakai');

            const toggleDisabledStyling = (element, isDisabled) => {
                if (isDisabled) {
                    element.classList.add('bg-gray-100', 'text-gray-400', 'cursor-not-allowed');
                    element.classList.remove('bg-gray-50', 'text-gray-900');
                } else {
                    element.classList.remove('bg-gray-100', 'text-gray-400', 'cursor-not-allowed');
                    element.classList.add('bg-gray-50', 'text-gray-900');
                }
            };

            // Fungsi ini untuk format formatRupiah
            const formatRupiah = (angka) => {
                // console.log(angka);
                return `Rp${new Intl.NumberFormat('id-ID').format(angka)}`;
            };

            // Fungsi ini untuk membersihkan format formatRupiah
            const cleanFormatRupiah = (value) => {
                return value.replace(/[^\d,]/g, '').replace(',', '');
            }

            formInputs.forEach(input => {
                toggleDisabledStyling(input, true);
            });

            pelangganSelect.addEventListener('change', async function() {
                const isSelected = this.value !== '';
                formInputs.forEach(input => {
                    input.disabled = !isSelected;
                    toggleDisabledStyling(input, !isSelected);
                });

                if (isSelected) {
                    try {
                        const response = await fetch(`/api/pelanggan/${this.value}`);
                        const data = await response.json();

                        console.log(data);

                        biayaBebanPemakaiInput.value = formatRupiah(parseFloat(data.biaya_beban));
                        biayaBebanPemakaiInput.readOnly = true;

                        biayaBebanPemakaiInput.dataset.tarifKwh = parseFloat(data.tarif_kwh);
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            });

            const hitungJumlahPakai = () => {
                const meterAwal = parseInt(meterAwalInput.value) || 0;
                const meterAkhir = parseInt(meterAkhirInput.value) || 0;

                if (meterAkhir >= meterAwal) {
                    const jumlahPakai = meterAkhir - meterAwal;
                    jumlahPakaiInput.value = jumlahPakai;

                    const tarifKwh = parseFloat(biayaBebanPemakaiInput.dataset.tarifKwh) || 0.00;
                    const biayaPemakai = jumlahPakai * tarifKwh;

                    biayaPemakaiInput.value = formatRupiah(parseInt(biayaPemakai));
                }
            };

            meterAwalInput.addEventListener('input', hitungJumlahPakai);
            meterAkhirInput.addEventListener('input', hitungJumlahPakai);

            jumlahPakaiInput.readOnly = true;
            biayaPemakaiInput.readOnly = true;

            toggleDisabledStyling(jumlahPakaiInput, true);
            toggleDisabledStyling(biayaPemakaiInput, true);

            // Membuat validasi untuk modal tambah data pemakaian dengan membuat object
            const inputValidations = {
                'tahun': {
                    maxLength: 4,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                },
                'meter_awal': {
                    maxLength: 10,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                },
                'meter_akhir': {
                    maxLength: 10,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                },
                'jumlah_pakai': {
                    maxLength: 10,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di  dengan angka'
                },
                'biaya_beban': {
                    maxLength: 15,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                }
            };

            // Membuat validasi untuk modal edit data pemakaian dengan membuat object
            const getInputValidationsModalEdit = (id) => ({
                [`tahun-${id}`]: {
                    maxLength: 4,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                },
                [`meter_awal-${id}`]: {
                    maxLength: 10,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                },
                [`meter_akhir-${id}`]: {
                    maxLength: 10,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                },
                [`jumlah_pakai-${id}`]: {
                    maxLength: 10,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di  dengan angka'
                },
                [`biaya_beban-${id}`]: {
                    maxLength: 15,
                    pattern: /^[0-9]*$/,
                    message: 'Hanya boleh di isi dengan angka'
                }
            });

            function showError(element, message) {
                removeError(element);

                element.classList.add('border', 'border-red-600', 'text-red-600', 'focus:ring-red-600',
                    'focus:border-red-600');

                const errorDiv = document.createElement('span');
                errorDiv.className = 'text-red-500 text-xs mt-1 error-message';
                errorDiv.textContent = message;

                element.parentNode.appendChild(errorDiv);
            }

            function removeError(element) {
                element.classList.remove('border', 'border-red-600', 'text-red-600', 'focus:ring-red-600',
                    'focus:border-red-600');
                const errorMessage = element.parentNode.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.remove();
                }
            }

            // event listener untuk setiap input pada modal tambah data pemakaian
            Object.keys(inputValidations).forEach(inputName => {
                const input = document.getElementById(inputName);
                if (!input) return;

                input.addEventListener('input', function(e) {
                    const validation = inputValidations[inputName];
                    const value = e.target.value;

                    // Validasi length
                    if (value.length > validation.maxLength) {
                        e.target.value = value.slice(0, validation.maxLength);
                    }

                    // Validasi pattern
                    if (value && !validation.pattern.test(value)) {
                        showError(input, validation.message);
                    } else {
                        removeError(input);
                    }
                });

                input.addEventListener('blur', function(e) {
                    const validation = inputValidations[inputName];
                    const value = e.target.value;

                    if (value && !validation.pattern.test(value)) {
                        showError(input, validation.message);
                    }
                });
            });

            const form = document.querySelector('#form-tambah-pemakaian');
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = {
                    pelanggan_id: pelangganSelect.value,
                    tahun: document.getElementById('tahun').value,
                    bulan: document.getElementById('bulan').value,
                    meter_awal: parseInt(meterAwalInput.value),
                    meter_akhir: parseInt(meterAkhirInput.value),
                    jumlah_pakai: parseInt(jumlahPakaiInput.value),
                    biaya_beban_pemakai: parseInt(cleanFormatRupiah(biayaBebanPemakaiInput.value)),
                    biaya_pemakai: parseInt(cleanFormatRupiah(biayaPemakaiInput.value))
                };

                Object.keys(inputValidations).forEach(inputName => {
                    const input = document.getElementById(inputName);
                    if (!input) return;

                    const validation = inputValidations[inputName];
                    const value = input.value;
                    let hasError = false;

                    if (value && !validation.pattern.test(value)) {
                        showError(input, validation.message);
                        hasError = true;
                    }

                    if (hasError) {
                        e.preventDefault();
                        return;
                    }
                });

                try {
                    const response = await fetch('{{ route('dashboard.pemakaian.create') }}', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        // Mengkonversi data form dari object ke JSON
                        body: JSON.stringify(formData)
                    });

                    const result = await response.json();

                    if (result.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: result.message || 'Data berhasil disimpan',
                            icon: 'success',
                        }).then(() => {
                            window.location.reload();
                            form.reset();
                        });
                    } else {
                        Swal.fire({
                            title: 'Informasi',
                            text: result.message || 'Ada masalah',
                            icon: 'info',
                        })
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });

            // Ketika tombol close modal tambah pemakaian di klik
            const closeModalTambah = document.getElementById('close-modal-tambah-pemakaian');
            closeModalTambah.addEventListener('click', function() {
                form.reset();
                formInputs.forEach(input => {
                    input.disabled = true;
                    toggleDisabledStyling(input, true);
                });
            });

            // Untuk modal edit
            const handleEditModal = (id_pemakaian) => {
                const biayaPemakai = document.getElementById(`biaya_pemakai-${id_pemakaian}`);
                const biayaBebanPemakai = document.getElementById(`biaya_beban_pemakai-${id_pemakaian}`);
                const tahun = document.getElementById(`tahun-${id_pemakaian}`);
                const bulan = document.getElementById(`bulan-${id_pemakaian}`);

                // Untuk menghapus styling disabled
                toggleDisabledStyling(tahun, false);
                toggleDisabledStyling(bulan, false);

                if (biayaPemakai && biayaBebanPemakai) {
                    // Format awal
                    const biayaPemakaiNilai = parseFloat(biayaPemakai.value) || 0.00;
                    const biayaBebanPemakaiNilai = parseFloat(biayaBebanPemakai.value) || 0.00;

                    biayaPemakai.value = formatRupiah(biayaPemakaiNilai);
                    biayaBebanPemakai.value = formatRupiah(biayaBebanPemakaiNilai);

                    // Event listener untuk format saat kolom input biaya pemakai diisi
                    biayaPemakai.addEventListener('input', function(event) {
                        let value = event.target.value.replace(/[^\d]/g, '');
                        event.target.value = formatRupiah(parseInt(value) || 0);
                    });

                    // Event listener untuk format saat kolom input biaya beban pemakai diisi
                    biayaBebanPemakai.addEventListener('input', function(event) {
                        let value = event.target.value.replace(/[^\d]/g, '');
                        event.target.value = formatRupiah(parseInt(value) || 0);
                    });
                }

                if (id_pemakaian) {
                    const validations = getInputValidationsModalEdit(id_pemakaian);

                    Object.keys(validations).forEach(inputName => {
                        const input = document.getElementById(inputName);
                        if (!input) return;

                        input.addEventListener('input', function(e) {
                            const validation = validations[inputName];
                            const value = e.target.value;

                            // Validasi length
                            if (value.length > validation.maxLength) {
                                e.target.value = value.slice(0, validation.maxLength);
                            }

                            // Validasi pattern
                            if (value && !validation.pattern.test(value)) {
                                showError(input, validation.message);
                            } else {
                                removeError(input);
                            }
                        });

                        input.addEventListener('blur', function(e) {
                            const validation = validations[inputName];
                            const value = e.target.value;

                            if (value && !validation.pattern.test(value)) {
                                showError(input, validation.message);
                            }
                        });
                    });
                }
            };

            const closeModalEditPemakaian = (id_pemakaian) => {
                const formEditPemakaian = document.getElementById(`form-edit-pemakaian-${id_pemakaian}`);
                if (formEditPemakaian) {
                    formEditPemakaian.reset();
                }
            };

            // untuk menghandle tombol edit pada dropdown
            document.querySelectorAll('[data-modal-target^="modal-edit-pemakaian-"]').forEach(button => {
                button.addEventListener('click', function() {
                    const idPemakaian = this.getAttribute('data-modal-target').split('-').pop();
                    handleEditModal(idPemakaian);
                });
            });

            // Untuk menghandle tombol close pada modal edit
            document.querySelectorAll('[id^="close-modal-edit-pemakaian-"]').forEach(button => {
                button.addEventListener('click', function() {
                    const idPemakaian = this.getAttribute('id').split('-').pop();
                    closeModalEditPemakaian(idPemakaian);
                });
            });

            // Event listener untuk form submit modal edit data pemakaian
            document.querySelectorAll('[id^="form-edit-pemakaian-"]').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const idPemakaian = this.id.split('-').pop();
                    const biayaPemakai = document.getElementById(
                        `biaya_pemakai-${idPemakaian}`);
                    const biayaBebanPemakai = document.getElementById(
                        `biaya_beban_pemakai-${idPemakaian}`);

                    // Bersihkan format Rupiah sebelum submit
                    if (biayaPemakai) {
                        biayaPemakai.value = cleanFormatRupiah(biayaPemakai.value);
                    }
                    if (biayaBebanPemakai) {
                        biayaBebanPemakai.value = cleanFormatRupiah(biayaBebanPemakai.value);
                    }

                    const formData = {
                        pelanggan_id: parseInt(document.getElementById(`pelanggan-id-${idPemakaian}`)
                            .value),
                        tahun: parseInt(document.getElementById(`tahun-${idPemakaian}`).value),
                        bulan: parseInt(document.getElementById(`bulan-${idPemakaian}`).value),
                        meter_awal: parseInt(document.getElementById(
                            `meter_awal-${idPemakaian}`).value),
                        meter_akhir: parseInt(document.getElementById(
                            `meter_akhir-${idPemakaian}`).value),
                        jumlah_pakai: parseInt(document.getElementById(
                            `jumlah_pakai-${idPemakaian}`).value),
                        biaya_beban_pemakai: parseFloat(cleanFormatRupiah(biayaBebanPemakai
                            .value)),
                        biaya_pemakai: parseFloat(cleanFormatRupiah(biayaPemakai.value)),
                        status: document.getElementById(`status-${idPemakaian}`).value
                    };

                    const formDataWithMethod = {
                        ...formData,
                        _method: 'PUT'
                    };

                    try {
                        const response = await fetch(
                            `{{ route('dashboard.pemakaian.update', '') }}/${idPemakaian}`, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                // Mengkonversi data form dari object ke JSON
                                body: JSON.stringify(formDataWithMethod)
                            });

                        const result = await response.json();

                        if (result.success) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: result.message || 'Data berhasil diupdate',
                                icon: 'success',
                            }).then(() => {
                                window.location.reload();
                                form.reset();
                            });
                        } else {
                            Swal.fire({
                                title: 'Informasi',
                                text: result.message || 'Ada masalah',
                                icon: 'info',
                            })
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let searchTimer;

            // Ketika mengetik di input search
            $('#input-search').on('input', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function() {
                    searchData();
                }, 200);
            });

            // Ketika menekan tombol enter
            $('#input-search').on('keydown', function(event) {
                if (event.keyCode === 13) {
                    $('#search-form').on('submit', function(e) {
                        e.preventDefault();
                        searchData();
                    });
                }
            });

            function searchData() {
                $.ajax({
                    url: '{{ route('dashboard.pemakaian') }}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        search: $('#input-search').val()
                    },
                    success: function(response) {
                        $('.data-table-pemakaian').html(response);
                        initFlowbite();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
    @if (Session::has("error"))
        <script>
            Swal.fire({
                title: 'Informasi',
                text: '{{ Session::get("error") }}',
                icon: 'info',
            })
        </script>
    @endif
    @if (Session::has("success"))
        <script>
            Swal.fire({
                title: 'Berhasil',
                text: '{{ Session::get("success") }}',
                icon: 'success',
            })
        </script>
    @endif
@endpush
