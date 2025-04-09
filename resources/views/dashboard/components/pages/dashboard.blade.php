@extends('dashboard.layouts.main')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div
            class="p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:-translate-y-2 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Admin</p>
                    <h3 class="text-2xl font-bold text-gray-700">{{ $adminCount }}</h3>
                </div>
                <div class="p-3 rounded-full bg-red-100">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Super Admin Card --}}
        <div
            class="p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:-translate-y-2 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Super Admin</p>
                    <h3 class="text-2xl font-bold text-gray-700">{{ $superAdminCount }}</h3>
                </div>
                <div class="p-3 rounded-full bg-blue-100">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Pelanggan Card --}}
        <div
            class="p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:-translate-y-2 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Pelanggan</p>
                    <h3 class="text-2xl font-bold text-gray-700">{{ $pelangganCount }}</h3>
                </div>
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Transaksi Hari Ini Card --}}
        <div
            class="p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:-translate-y-2 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Transaksi Hari Ini</p>
                    <h3 class="text-2xl font-bold text-gray-700">{{ $transaksiHariIni->count() ?? '0' }}</h3>
                </div>
                <div class="p-3 rounded-full bg-yellow-100">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full">
        <div class="bg-white p-4 rounded-lg border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <h2 class="text-md font-medium text-gray-700">Transaksi terbaru hari ini</h2>
                </div>
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
                            class="block p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 placeholder:opacity-50 w-full"
                            placeholder="Search..." />
                    </form>
                </div>
            </div>
            <div class="relative overflow-x-auto data-table-transaksi">
                <table class="w-full text-sm text-left text-gray-500 border border-gray-200">
                    <thead class="text-xs text-gray-700 capitalize bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 capitalize">No</th>
                            <th class="px-4 py-2 capitalize">ID Pel</th>
                            <th class="px-4 py-2 capitalize">Nama</th>
                            <th class="px-4 py-2 capitalize">Tarif/Daya</th>
                            <th class="px-4 py-2 capitalize">Bln/Thn</th>
                            <th class="px-4 py-2 capitalize">Jenis Pembayaran</th>
                            <th class="px-4 py-2 capitalize">Total</th>
                            <th class="px-4 py-2 capitalize">Status</th>
                            <th class="px-4 py-2 capitalize">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksiHariIni as $transaksi)
                            <tr>
                                <td class="px-4 py-2">
                                    {{ $loop->iteration + ($transaksiHariIni->currentPage() - 1) * $transaksiHariIni->perPage() }}
                                </td>
                                <td class="px-4 py-2 capitalize">
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                        {{ $transaksi->pemakaian->pelanggan->no_kontrol }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 capitalize">{{ $transaksi->pemakaian->pelanggan->nama }}</td>
                                <td class="px-4 py-2 capitalize">
                                    {{ $transaksi->pemakaian->pelanggan->jenisPelanggan->golongan }}/{{ $transaksi->pemakaian->pelanggan->jenisPelanggan->kapasitasDaya->batas_daya }}
                                    VA
                                </td>
                                <td class="px-4 py-2 capitalize">
                                    {{ $transaksi->pemakaian->bulan }}/{{ $transaksi->pemakaian->tahun }}</td>
                                <td class="px-4 py-2 capitalize">{{ $transaksi->jenis_pembayaran }}</td>
                                <td class="px-4 py-2 capitalize">
                                    {{ 'Rp' . number_format($transaksi->total_bayar, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 capitalize">
                                    <span
                                        class="{{ $transaksi->status === 'success' ? 'bg-green-100 text-green-800' : ($transaksi->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($transaksi->status === 'failed' || $transaksi->status === 'expired' || $transaksi->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }} text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                        {{ $transaksi->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <button id="dropdownActionButton-{{ $transaksi->id_pembayaran }}"
                                        data-dropdown-toggle="dropdownAction-{{ $transaksi->id_pembayaran }}"
                                        class="inline-flex items-center">
                                        <svg class="w-6 h-6 text-gray-800 p-1 rounded-full hover:bg-gray-100 hover:cursor-pointer"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                d="M12 6h.01M12 12h.01M12 18h.01" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div id="dropdownAction-{{ $transaksi->id_pembayaran }}"
                                        class="z-10 hidden absolute right-0 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                        <ul class="py-2 text-sm text-gray-700"
                                            aria-labelledby="dropdownActionButton-{{ $transaksi->id_pembayaran }}">
                                            <li>
                                                <button class="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                                    data-modal-target="popup-modal-delete-{{ $transaksi->id_pembayaran }}"
                                                    data-modal-toggle="popup-modal-delete-{{ $transaksi->id_pembayaran }}">
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
                                    {{-- Modal delete --}}
                                    @include('dashboard.components.modals.pages.dashboard.modal-delete-dashboard', ['data' => $transaksi])
                                </td>
                            @empty
                                <td colspan="9" class="px-4 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <h4 class="font-semibold text-md">Tidak ada data</h4>
                                        <p class="text-gray-500 text-sm">Belum ada data transaksi pada hari ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Pagination --}}
                @if ($transaksiHariIni->total() > 10)
                    <div class="my-4 px-4">
                        {{ $transaksiHariIni->links('pagination.tailwindcss-paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let timer;

        $(document).ready(function() {
            $('#input-search').on('input', function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    searchingData();
                }, 200);
            });
        });

        function searchingData() {
            $.ajax({
                url: '{{ route('dashboard') }}',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    search: $('#input-search').val()
                },
                success: function(response) {
                    $('.data-table-transaksi').html(response);
                    if (typeof initFlowbite === 'function') {
                        initFlowbite();
                    }
                }
            });
        }
    </script>
@endpush
