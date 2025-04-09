@extends('dashboard.layouts.main')

@section('content')
    <div class="container px-4 py-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Pelanggan</h1>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 opacity-50" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
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

                <button data-modal-target="modal-tambah-pelanggan" data-modal-toggle="modal-tambah-pelanggan"
                    id="btn-modal-tambah-pelanggan"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2.5 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Pelanggan
                </button>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-lg overflow-hidden border border-gray-100">
            <div class="relative overflow-x-auto data-table-pelanggan">
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
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                        {{ $data_pelanggan->no_kontrol }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 capitalize">{{ $data_pelanggan->alamat }}</td>
                                <td class="px-4 py-3 capitalize">
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
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
                                                <button
                                                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                                    data-modal-target="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}"
                                                    data-modal-toggle="modal-edit-pelanggan-{{ $data_pelanggan->id_pelanggan }}">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-green-600" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                        </svg>
                                                        Edit
                                                    </span>
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                                    data-modal-target="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}"
                                                    data-modal-toggle="popup-modal-delete-{{ $data_pelanggan->id_pelanggan }}">
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
                                        </ul>
                                    </div>

                                    {{-- Modal Edit --}}
                                    @include('dashboard.components.modals.pages.pelanggan.modal-edit-pelanggan', ['data_pelanggan' => $data_pelanggan])

                                    {{-- Modal Delete --}}
                                    @include('dashboard.components.modals.pages.pelanggan.modal-delete-pelanggan', ['data_pelanggan' => $data_pelanggan])
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
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                                            Tidak ada data
                                        </h3>
                                        <p class="text-gray-500">
                                            Mungkin belum memiliki data pelanggan
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
            </div>
        </div>

        <!-- Modal Tambah Pelanggan -->
        @include('dashboard.components.modals.pages.pelanggan.modal-tambah-pelanggan', ['jenisPelanggan' => $jenisPelanggan])
    </div>
@endsection
@push('script')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            })
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                title: "Informasi",
                text: "{{ Session::get('error') }}",
                icon: "info"
            })
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalTambah = document.getElementById('modal-tambah-pelanggan');
            const formTambah = document.getElementById('form-modal-tambah-pelanggan');
            const closeModal = document.getElementById('close-modal');

            const inputValidations = {
                'nama': {
                    maxLength: 50,
                    pattern: /^[a-zA-Z\s]*$/,
                    message: 'Hanya boleh huruf dan spasi, maksimal 50 karakter'
                },
                'no_kontrol': {
                    maxLength: 20,
                    pattern: /^[0-9+]*$/,
                    message: 'Hanya boleh angka dan maksimal 20 karakter'
                },
                'alamat': {
                    maxLength: 255,
                    message: 'Maksimal 255 karakter'
                },
                'telpon': {
                    maxLength: 15,
                    pattern: /^[0-9+]*$/,
                    message: 'Hanya boleh angka, simbol + dan maksimal 15 karakter'
                }
            };

            // Validasi untuk modal edit
            function resetForm(form) {
                form.reset();
                form.querySelectorAll('input, textarea, select').forEach(element => {
                    element.classList.remove('border-red-600');

                    const errorSpan = element.parentElement.querySelector('.validation-error');
                    if (errorSpan) errorSpan.remove();
                });
            }

            closeModal.addEventListener('click', () => resetForm(formTambah));

            function showError(element, message) {
                element.classList.add('border', 'border-red-600', 'text-red-600', 'focus:ring-red-600',
                    'focus:border-red-600');

                const existingError = element.parentElement.querySelector('.validation-error');
                if (existingError) existingError.remove();

                const errorSpan = document.createElement('span');
                errorSpan.className = 'validation-error text-red-600 text-[10px] font-medium';
                errorSpan.textContent = message;

                element.parentElement.appendChild(errorSpan);
            }

            function removeError(element) {
                element.classList.remove('border', 'border-red-600', 'text-red-600', 'focus:ring-red-600',
                    'focus:border-red-600');
                const errorSpan = element.parentElement.querySelector('.validation-error');
                if (errorSpan) errorSpan.remove();
            }

            formTambah.querySelectorAll('input, textarea').forEach(input => {
                const validation = inputValidations[input.name];
                if (!validation) return;

                input.addEventListener('input', function(e) {
                    const value = e.target.value;

                    if (value.length > validation.maxLength) {
                        e.target.value = value.slice(0, validation.maxLength);
                        showError(input, validation.message);
                        return;
                    }

                    if (validation.pattern && !validation.pattern.test(value)) {
                        showError(input, validation.message);
                        return;
                    }

                    removeError(input);
                });
            });

            formTambah.addEventListener('submit', function(e) {
                const telponInput = this.querySelector('[name="telpon"]');
                if (telponInput && telponInput.value.startsWith('0')) {
                    telponInput.value = '+62' + telponInput.value.substring(1);
                }
            });

            const btnTambahPelanggan = document.getElementById('btn-modal-tambah-pelanggan');
            if (btnTambahPelanggan) {
                btnTambahPelanggan.addEventListener('click', function() {
                    resetForm(formTambah);
                });
            }

            // Validasi untuk modal edit
            function applyFormValidation(form) {
                form.querySelectorAll('input, textarea').forEach(input => {
                    const validation = inputValidations[input.name];
                    if (!validation) return;

                    input.addEventListener('input', function(e) {
                        const value = e.target.value;

                        if (value.length > validation.maxLength) {
                            e.target.value = value.slice(0, validation.maxLength);
                            showError(input, validation.message);
                            return;
                        }

                        if (validation.pattern && !validation.pattern.test(value)) {
                            showError(input, validation.message);
                            return;
                        }

                        removeError(input);
                    });
                });

                form.addEventListener('submit', function(e) {
                    const telponInput = this.querySelector('[name="telpon"]');
                    if (telponInput && telponInput.value.startsWith('0')) {
                        telponInput.value = '+62' + telponInput.value.substring(1);
                    }
                });
            }

            document.querySelectorAll('[id^="modal-edit-pelanggan-"]').forEach(modalEdit => {
                const pelangganId = modalEdit.id.split('-').pop();
                const formEdit = modalEdit.querySelector('#form-edit-pelanggan');
                const closeEditBtn = modalEdit.querySelector(
                    '[data-modal-toggle^="modal-edit-pelanggan-"]');

                if (formEdit && closeEditBtn) {
                    closeEditBtn.addEventListener('click', () => resetForm(formEdit));
                    applyFormValidation(formEdit);
                }
            });

            // Handle modal tambah dan edit
            @if ($errors->any())
                const modalInstance = new Modal(modalTambah);
                modalInstance.show();
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            let searchTimer;

            // Ketika mengetik di input search
            $('#input-search').on('input', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function() {
                    performSearch();
                }, 200);
            });

            // Ketika menekan tombol enter
            $('#input-search').on('keydown', function(event) {
                if(event.keyCode === 13){
                    $('#search-form').on('submit', function(e) {
                        e.preventDefault();
                        performSearch();
                    });
                }
            });

            // Fungsi untuk melakukan pencarian
            function performSearch() {
                $.ajax({
                    url: '{{ route('dashboard.pelanggan') }}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        search: $('#input-search').val()
                    },
                    success: function(response) {
                        $('.data-table-pelanggan').html(response);
                        if (typeof initFlowbite === 'function') {
                            initFlowbite();
                        }
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
