@extends('client.layouts.main')

@section('client-content')
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Cek tagihan listrik</h1>
        <p class="text-gray-600">Filter berdasarkan status, bulan, tahun, atau nama pelanggan untuk melihat rincian tagihan listrik Anda</p>
    </div>

    <!-- Search Section -->
    <div class="max-w-xl mx-auto mb-8">
        <form class="flex flex-col md:flex-row gap-4" action="{{ route('pelanggan') }}" method="GET">
            <div class="flex-1">
                <input type="text" placeholder="Search..." name="search" id="search"
                    value="{{ request()->input('search') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 placeholder:opacity-50"
                    required autofocus>
            </div>
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari
            </button>
        </form>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 max-w-5xl mx-auto data-table">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-200 capitalize">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                        No.
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                        No Kontrol
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                        Nama
                        Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                        Periode
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                        Pemakaian
                        (kWh)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                        Total Tagihan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($data_pelanggan->count() > 0)
                    @foreach ($data_pelanggan as $data)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $loop->iteration + ($data_pelanggan->currentPage() - 1) * $data_pelanggan->perPage() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                    {{ $data->pelanggan->no_kontrol }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $data->pelanggan->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ '0' . $data->bulan }} -
                                {{ $data->tahun }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $data->pelanggan->jenisPelanggan->kapasitasDaya->tarif_kwh }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ 'Rp' . number_format($data->biaya_beban_pemakai, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize {{ $data->status === 'lunas'
                                        ? 'bg-green-100 text-green-800'
                                        : ($data->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-700'
                                            : 'bg-red-100 text-red-800') }}">
                                    {{ $data->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">
                                    Data tidak ditemukan
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
        @if ($data_pelanggan->total() > 10)
            <div class="my-4 px-4">
                {{ $data_pelanggan->appends(['currentStatus' => $currentStatus])->links('pagination.tailwindcss-paginate') }}
            </div>
        @endif
    </div>
@endsection
@push('script')
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#search').on('input', performSearch);

        function performSearch() {
            $.ajax({
                url: '{{ route('pelanggan') }}',
                type: 'GET',
                data: {
                    search: $('#search').val()
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

