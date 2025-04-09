@extends('dashboard.layouts.main')

@section('content')
    <div class="container px-4 py-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Kapasitas Daya</h1>
            <div class="flex items-center gap-4">
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

                <button data-modal-target="modal-tambah-kapasitas" data-modal-toggle="modal-tambah-kapasitas"
                    id="btn-modal-tambah-kapasitas"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2.5 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Data
                </button>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-gray-200">
            <div class="relative overflow-x-auto data-table-kapasitas">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 capitalize bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-medium">No</th>
                            <th class="px-6 py-4 font-medium">Batas Daya</th>
                            <th class="px-6 py-4 font-medium">Biaya Beban</th>
                            <th class="px-6 py-4 font-medium">Tarif/Kwh</th>
                            <th class="px-6 py-4 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kapasitas as $data)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $loop->iteration + ($kapasitas->currentPage() - 1) * $kapasitas->perPage() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ number_format($data->batas_daya, 0, ',', '.') }} VA
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Rp{{ number_format($data->biaya_beban, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Rp{{ number_format($data->tarif_kwh, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <button id="dropdownActionButton-{{ $data->id_kapasitas_daya }}"
                                            data-dropdown-toggle="dropdownAction-{{ $data->id_kapasitas_daya }}"
                                            class="inline-flex items-center p-1 text-gray-500 hover:bg-gray-100 rounded-full transition-colors">
                                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                    d="M12 6h.01M12 12h.01M12 18h.01" />
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Dropdown Action --}}
                                    <div id="dropdownAction-{{ $data->id_kapasitas_daya }}"
                                        class="z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44">
                                        <ul class="py-2 text-sm text-gray-700">
                                            <li>
                                                <button
                                                    class="w-full px-4 py-2 text-left hover:bg-gray-50 flex items-center gap-2 text-green-600"
                                                    data-modal-target="modal-edit-kapasitas-{{ $data->id_kapasitas_daya }}"
                                                    data-modal-toggle="modal-edit-kapasitas-{{ $data->id_kapasitas_daya }}">
                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    class="w-full px-4 py-2 text-left hover:bg-gray-50 flex items-center gap-2 text-red-600"
                                                    data-modal-target="popup-modal-delete-{{ $data->id_kapasitas_daya }}"
                                                    data-modal-toggle="popup-modal-delete-{{ $data->id_kapasitas_daya }}">
                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    {{-- Modal edit --}}
                                    @include(
                                        'dashboard.components.modals.pages.kapasitas.modal-edit-kapasitas',
                                        ['data' => $data]
                                    )

                                    {{-- Modal delete --}}
                                    @include(
                                        'dashboard.components.modals.pages.kapasitas.modal-delete-kapasitas',
                                        ['data' => $data]
                                    )
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
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data</h3>
                                        <p class="text-gray-500">Belum ada data kapasitas daya yang tersedia</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Pagination --}}
                @if ($kapasitas->total() > 10)
                    <div class="my-4 px-4">
                        {{ $kapasitas->links('pagination.tailwindcss-paginate') }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Modal Tambah --}}
        @include('dashboard.components.modals.pages.kapasitas.modal-tambah-kapasitas')
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formTambahKapasitas = document.getElementById('form-tambah-kapasitas');
            const btnCloseModal = document.getElementById('close-modal-tambah-kapasitas');
            const batasDaya = document.getElementById('batas_daya');
            const biayaBeban = document.getElementById('biaya_beban');
            const tarifKwh = document.getElementById('tarif');
            biayaBeban.disabled = true;

            // Fungsi ini untuk format formatRupiah
            const formatRupiah = (angka) => {
                if (!angka) return 'Rp0';
                return `Rp${new Intl.NumberFormat('id-ID').format(angka)}`;
            };

            // Fungsi ini untuk membersihkan format formatRupiah
            const cleanFormatRupiah = (value) => {
                if (!value) return '0';
                return value.replace(/[^\d,]/g, '').replace(',', '');
            }

            // Mau nentuin nilai kolom biaya beban
            const hitungBiayaBeban = () => {
                const batasDayaValue = parseInt(batasDaya.value) || 0;
                const tarifKwhValue = parseInt(cleanFormatRupiah(tarifKwh.value)) || 0;

                if (batasDayaValue > 0 && tarifKwhValue > 0) {
                    const biayaBebanValue = (40 * (batasDayaValue / 1000)) * tarifKwhValue;
                    biayaBeban.value = formatRupiah(biayaBebanValue);
                }
            };

            // Untuk input tarif
            tarifKwh.addEventListener('input', function(e) {
                let value = cleanFormatRupiah(e.target.value);
                if (value) {
                    e.target.value = formatRupiah(value);
                }
                hitungBiayaBeban();
            });

            batasDaya.addEventListener('input', hitungBiayaBeban);

            // Validasi untuk modal tambah
            const inputValidations = {
                'batas_daya': {
                    maxLength: 8,
                    pattern: /^[0-9]*$/,
                    message1: 'Hanya boleh di isi dengan angka',
                    message2: 'Maksimal 8 digit'
                },
                'tarif': {
                    maxLength: 15,
                    pattern: /^Rp[0-9.,]*$/,
                    message1: 'Hanya boleh di isi dengan angka',
                    message2: 'Maksimal 15 digit'
                }
            };

            // Validasi untuk modal edit
            const getInputValidationsModalEdit = (id_kapasitas) => ({
                [`batas_daya-${id_kapasitas}`]: {
                    maxLength: 8,
                    pattern: /^[0-9]*$/,
                    message1: 'Hanya boleh di isi dengan angka',
                    message2: 'Maksimal 8 digit'
                },
                [`tarif-${id_kapasitas}`]: {
                    maxLength: 15,
                    pattern: /^Rp[0-9.,]*$/,
                    message1: 'Hanya boleh di isi dengan angka',
                    message2: 'Maksimal 15 digit'
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

            Object.keys(inputValidations).forEach(idName => {
                const input = document.getElementById(idName);
                if (!input) return;

                input.addEventListener('input', function(e) {
                    const validation = inputValidations[idName];
                    const value = e.target.value;

                    if (value.length > validation.maxLength) {
                        e.target.value = value.slice(0, validation.maxLength);
                        showError(input, validation.message2);
                    } else if (value && !validation.pattern.test(value)) {
                        showError(input, validation.message1);
                    } else {
                        removeError(input);
                    }
                });
            });

            btnCloseModal.addEventListener('click', function() {
                formTambahKapasitas.reset();
            });

            // Event listener untuk form submit modal tambah data kapasitas
            formTambahKapasitas.addEventListener('submit', async function(e) {
                e.preventDefault();

                try {
                    const formData = {
                        batas_daya: parseInt(batasDaya.value),
                        biaya_beban: parseFloat(cleanFormatRupiah(biayaBeban.value)),
                        tarif_kwh: parseFloat(cleanFormatRupiah(tarifKwh.value))
                    };

                    const response = await fetch(
                        "{{ route('dashboard.kapasitas.create') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(formData)
                        }
                    );

                    const result = await response.json();

                    if (result.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: result.message || 'Data berhasil diupdate',
                            icon: 'success',
                        }).then(() => {
                            window.location.reload();
                            formTambahKapasitas.reset();
                        });
                    } else {
                        Swal.fire({
                            title: 'Informasi',
                            text: result.message || 'Ada masalah',
                            icon: 'info',
                        })
                    }
                } catch (error) {
                    console.log(error);
                }
            });

            // Untuk modal edit
            const handleEditModal = (id_kapasitas) => {
                const batasDaya = document.getElementById(`batas_daya-${id_kapasitas}`);
                const biayaBeban = document.getElementById(`biaya_beban-${id_kapasitas}`);
                const tarifKwh = document.getElementById(`tarif-${id_kapasitas}`);

                biayaBeban.disabled = true;

                const menghitungBiayaBeban = () => {
                    const batasDayaValue = parseInt(batasDaya.value) || 0;
                    const tarifKwhValue = parseInt(cleanFormatRupiah(tarifKwh.value)) || 0;

                    if (batasDayaValue > 0 && tarifKwhValue > 0) {
                        const biayaBebanValue = (40 * (batasDayaValue / 1000)) * tarifKwhValue;
                        biayaBeban.value = formatRupiah(parseFloat(biayaBebanValue));
                    }
                };

                const handleTarifInput = (e) => {
                    let value = cleanFormatRupiah(e.target.value);
                    if (value) {
                        e.target.value = formatRupiah(value);
                    }

                    // Menghitung biaya beban
                    menghitungBiayaBeban();
                };

                batasDaya.addEventListener('input', menghitungBiayaBeban);
                tarifKwh.addEventListener('input', handleTarifInput);

                if (id_kapasitas) {
                    const validations = getInputValidationsModalEdit(id_kapasitas);

                    Object.keys(validations).forEach(inputName => {
                        const input = document.getElementById(inputName);
                        if (!input) return;

                        input.addEventListener('input', function(e) {
                            const validation = validations[inputName];
                            const value = e.target.value;

                            // Khusus untuk field tarif, validasi dengan format Rupiah
                            if (inputName.includes('tarif')) {
                                const cleanValue = cleanFormatRupiah(value);
                                if (cleanValue.length > validation.maxLength) {
                                    showError(input, validation.message2);
                                } else if (cleanValue && !(/^[0-9]*$/).test(cleanValue)) {
                                    showError(input, validation.message1);
                                } else {
                                    removeError(input);
                                }
                            } else {
                                // Validasi normal untuk field lain
                                if (value.length > validation.maxLength) {
                                    e.target.value = value.slice(0, validation.maxLength);
                                    showError(input, validation.message2);
                                } else if (value && !validation.pattern.test(value)) {
                                    showError(input, validation.message1);
                                } else {
                                    removeError(input);
                                }
                            }
                        });

                        input.addEventListener('blur', function(e) {
                            const validation = validations[inputName];
                            const value = e.target.value;

                            if (inputName.includes('tarif')) {
                                const cleanValue = cleanFormatRupiah(value);
                                if (cleanValue && !(/^[0-9]*$/).test(cleanValue)) {
                                    showError(input, validation.message1);
                                }
                            } else if (value && !validation.pattern.test(value)) {
                                showError(input, validation.message2);
                            }
                        });
                    });
                }
            };

            // Event listener untuk form submit modal edit data kapasitas
            const closeModalEditKapasitas = (id_kapasitas_daya) => {
                const formEditKapasitas = document.getElementById(`form-edit-kapasitas-${id_kapasitas_daya}`);
                if (formEditKapasitas) {
                    formEditKapasitas.reset();
                }
            };

            // untuk menghandle tombol edit pada dropdown
            document.querySelectorAll('[data-modal-target^="modal-edit-kapasitas-"]').forEach(button => {
                button.addEventListener('click', function() {
                    const idKapasitas = this.getAttribute('data-modal-target').split('-').pop();
                    handleEditModal(idKapasitas);
                });
            });

            // Untuk menghandle tombol close pada modal edit
            document.querySelectorAll('[id^="close-modal-edit-kapasitas-"]').forEach(button => {
                button.addEventListener('click', function() {
                    const idKapasitas = this.getAttribute('id').split('-').pop();
                    closeModalEditKapasitas(idKapasitas);
                });
            });

            // Event listener untuk form submit modal edit data pemakaian
            document.querySelectorAll('[id^="form-edit-kapasitas-"]').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const idKapasitas = this.id.split('-').pop();
                    const batasDayaNilai = document.getElementById(`batas_daya-${idKapasitas}`);
                    const biayaBebanNilai = document.getElementById(
                        `biaya_beban-${idKapasitas}`);
                    const tarifKwhNilai = document.getElementById(`tarif_kwh-${idKapasitas}`);

                    // Validasi sebelum submit
                    if (!batasDayaNilai.value || !biayaBebanNilai.value || !tarifKwhNilai
                        .value) {
                        Swal.fire({
                            title: 'Peringatan',
                            text: 'Semua field harus di isi',
                            icon: 'warning',
                        });
                        return;
                    }

                    const batasDaya = parseInt(batasDayaNilai.value) || 0;
                    const biayaBeban = parseFloat(cleanFormatRupiah(biayaBebanNilai.value)) ||
                    0;
                    const tarifKwh = parseFloat(cleanFormatRupiah(tarifKwhNilai.value)) || 0;

                    if (batasDaya <= 0 || biayaBeban <= 0 || tarifKwh <= 0) {
                        Swal.fire({
                            title: 'Peringatan',
                            text: 'Semua nilai harus lebih dari 0',
                            icon: 'warning',
                        });
                        return;
                    }

                    const formData = {
                        batas_daya: batasDaya,
                        biaya_beban: biayaBeban,
                        tarif_kwh: tarifKwh
                    };

                    const formDataWithMethod = {
                        ...formData,
                        _method: 'PUT'
                    };

                    try {
                        const response = await fetch(
                            `{{ route('dashboard.kapasitas.update', '') }}/${idKapasitas}`, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
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
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengirim data',
                            icon: 'error',
                        });
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
                    search();
                }, 200);
            });

            $('#input-search').on('keydown', function(event) {
                if (event.keyCode === 13) {
                    $('#search-form').on('submit', function(e) {
                        e.preventDefault();
                        search();
                    });
                }
            });

            function search() {
                $.ajax({
                    url: '{{ route('dashboard.kapasitas') }}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        search: $('#input-search').val()
                    },
                    success: function(response) {
                        $('.data-table-kapasitas').html(response);
                        initFlowbite();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: 'Berhasil',
                text: '{{ Session::get('success') }}' || 'Data berhasil ditambahkan',
                icon: 'success'
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                title: 'Informasi',
                text: '{{ Session::get('error') }}' || 'Data gagal ditambahkan',
                icon: 'info'
            });
        </script>
    @endif
@endpush
