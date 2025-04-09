@extends('dashboard.layouts.main')

@section('content')
    <div class="min-h-screen bg-white py-6">
        <div class="max-w-8xl mx-auto">
            <!-- Header Section -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Pembayaran Listrik</h1>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
                <div class="flex flex-col md:flex-row gap-6">
                    {{-- Stats Cards --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 mr-4">
                                    <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
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
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
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

                    {{-- Form Filter --}}
                    <form class="flex gap-4 items-end flex-1" id="form-filter-pembayaran">
                        <!-- No Kontrol -->
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="no-kontrol">No Kontrol</label>
                            <div class="relative">
                                <input type="text" id="no-kontrol"
                                    class="w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 placeholder:opacity-50"
                                    placeholder="Masukan nomor kontrol">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="status">Status</label>
                            <select id="status"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 opacity-50">
                                <option value="semua" selected>Semua</option>
                                <option value="belum bayar">Belum bayar</option>
                                <option value="lunas">Lunas</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kondisi dimana didalam tabel ada data -->
            <div class="relative overflow-x-auto sm:rounded-lg data-table">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 border border-gray-200">
                    <thead class="text-xs text-gray-700 capitalize bg-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">No.</th>
                            <th scope="col" class="px-6 py-3">ID Pelanggan</th>
                            <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3">Alamat</th>
                            <th scope="col" class="px-6 py-3">Periode BL/TH</th>
                            <th scope="col" class="px-6 py-3">Stand Meter</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pemakaian->count() > 0)
                            @foreach ($pemakaian as $data_pemakaian)
                                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $loop->iteration + ($pemakaian->currentPage() - 1) * $pemakaian->perPage() }}
                                    </td>
                                    <th class="px-6 py-4">
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                            {{ $data_pemakaian->pelanggan->no_kontrol }}
                                        </span>
                                    </th>
                                    <td class="px-6 py-4 capitalize">{{ $data_pemakaian->pelanggan->nama }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $data_pemakaian->pelanggan->alamat }}</td>
                                    <td class="px-6 py-4 capitalize">
                                        {{ '0' . $data_pemakaian->bulan }}
                                        -
                                        {{ $data_pemakaian->tahun }}
                                    </td>
                                    <td class="px-6 py-4 capitalize">
                                        {{ str_replace('.', '', $data_pemakaian->meter_awal) }}
                                        -
                                        {{ str_replace('.', '', $data_pemakaian->meter_akhir) }}
                                    </td>
                                    <td class="px-6 py-4 capitalize">
                                        <span
                                            class="text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm capitalize
                                                {{ $data_pemakaian->status === 'lunas'
                                                    ? 'bg-green-100 text-green-600'
                                                    : ($data_pemakaian->status === 'pending'
                                                        ? 'bg-yellow-100 text-yellow-600'
                                                        : ($data_pemakaian->status === 'belum bayar'
                                                            ? 'bg-blue-100 text-blue-600'
                                                            : 'bg-red-100 text-red-600')) }}">
                                            {{ $data_pemakaian->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="relative">
                                            <button id="dropdownActionButton-{{ $data_pemakaian->id_pemakaian }}"
                                                data-dropdown-toggle="dropdownAction-{{ $data_pemakaian->id_pemakaian }}"
                                                class="inline-flex items-center">
                                                <svg class="w-6 h-6 text-gray-800 p-1 rounded-full hover:bg-gray-100 hover:cursor-pointer"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                        d="M12 6h.01M12 12h.01M12 18h.01" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="dropdownAction-{{ $data_pemakaian->id_pemakaian }}"
                                                class="z-10 hidden absolute right-0 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                                <ul class="py-2 text-sm text-gray-700"
                                                    aria-labelledby="dropdownActionButton-{{ $data_pemakaian->id_pemakaian }}">
                                                    <li>
                                                        <button class="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                                            data-modal-target="detail-modal-{{ $data_pemakaian->id_pemakaian }}"
                                                            data-modal-toggle="detail-modal-{{ $data_pemakaian->id_pemakaian }}">
                                                            <span class="flex items-center">
                                                                <svg class="w-4 h-4 mr-2 text-green-600"
                                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3" />
                                                                </svg>
                                                                Cek Detail
                                                            </span>
                                                        </button>
                                                    </li>
                                                    @if ($data_pemakaian->status === 'lunas')
                                                        <li>
                                                            <button
                                                                class="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                                                data-modal-target="popup-modal-delete-{{ $data_pemakaian->id_pembayaran }}"
                                                                data-modal-toggle="popup-modal-delete-{{ $data_pemakaian->id_pembayaran }}">
                                                                <span class="flex items-center">
                                                                    <svg class="w-4 h-4 text-red-600 mr-2"
                                                                        aria-hidden="true"
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
                                        </div>

                                        {{-- Modal Delete --}}
                                        @include('dashboard.components.modals.pages.pembayaran.modal-delete-pembayaran',['data_pemakaian' => $data_pemakaian])

                                        <!-- Main modal untuk detail pemakaian -->
                                        @include('dashboard.components.modals.pages.pembayaran.modal-detail-pembayaran',['data_pemakaian' => $data_pemakaian])
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <!-- Kondisi dimana didalam tabel tidak ada data -->
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Data tidak ditemukan
                                        </h3>
                                        <p class="text-gray-500">
                                            Silakan mencoba lagi dengan nilai filter yang
                                            berbeda
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{-- Pagination --}}
                @if ($pemakaian->total() > 10)
                    <div class="my-4 px-4">
                        {{ $pemakaian->appends(['status' => $currentStatus])->links('pagination.tailwindcss-paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function prosesPayment(id_pemakaian) {
            fetch(`{{ route('proses.payment', '') }}/${id_pemakaian}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        Swal.fire({
                            title: "Ups...",
                            text: data.message,
                            icon: "error"
                        });
                        return;
                    }

                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            Swal.fire({
                                title: "Sukses",
                                text: "Transaksi anda telah berhasil diproses",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        },
                        onPending: function(result) {
                            Swal.fire({
                                title: "Informasi",
                                text: "Silahkan selesaikan pembayaran anda",
                                icon: "warning"
                            });
                        },
                        onError: function(result) {
                            Swal.fire({
                                title: "Ups...",
                                text: "Terjadi kesalahan dalam proses pembayaran",
                                icon: "error"
                            });
                        },
                        onClose: function() {
                            Swal.fire({
                                title: "Informasi",
                                text: "Anda telah menutup halaman pembayaran",
                                icon: "info"
                            });
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: "Ups...",
                        text: "Terjadi kesalahan saat memproses pembayaran",
                        icon: "error"
                    });
                });
        }

        function print(hashedId) {
            window.location.href = `/print-pembayaran?id_pemakaian=${hashedId}`;
        }
    </script>

    @if (Session::has('error'))
        <script>
            Swal.fire({
                title: "Informasi",
                text: "{{ Session::get('error') }}",
                icon: "info"
            });
        </script>
    @endif

    <script>
        let typingTimer;

        // Filter live searching
        $('#no-kontrol, #status').on('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                performSearch();
            }, 200);
        });

        $('.terapkan-filter').on('click', performSearch);

        function performSearch() {
            $.ajax({
                url: '{{ route('dashboard.users') }}',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    no_kontrol: $('#no-kontrol').val(),
                    status: $('#status').val()
                },
                success: function(response) {
                    $('.data-table').html(response);
                    initFlowbite();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endpush
