@extends('dashboard.layouts.main')

@section('content')
    <div class="container px-4 py-6">
        <!-- Header Section -->
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Daftar Petugas</h1>
            <button data-modal-target="tambah-petugas-modal" data-modal-toggle="tambah-petugas-modal"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Tambah Petugas
            </button>
        </div>

        <!-- Table Section -->
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 border border-gray-200">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3">No.</th>
                        <th scope="col" class="px-4 py-3">Nama Lengkap</th>
                        <th scope="col" class="px-4 py-3">Email</th>
                        <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td class="px-4 py-3 capitalize">{{ $user->nama_lengkap }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <button id="dropdownActionButton-{{ $user->id_user }}"
                                        data-dropdown-toggle="dropdownAction-{{ $user->id_user }}"
                                        class="inline-flex items-center">
                                        <svg class="w-6 h-6 text-gray-800 p-1 rounded-full hover:bg-gray-100 hover:cursor-pointer"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                d="M12 6h.01M12 12h.01M12 18h.01" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Dropdown menu -->
                                <div id="dropdownAction-{{ $user->id_user }}"
                                    class="z-10 hidden absolute right-0 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul class="py-2 text-sm text-gray-700 px-2"
                                        aria-labelledby="dropdownActionButton-{{ $user->id_user }}">
                                        <li>
                                            <button class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                                data-modal-target="popup-modal-edit-{{ $user->id_user }}"
                                                data-modal-toggle="popup-modal-edit-{{ $user->id_user }}">
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
                                            <button class="block w-full px-4 py-2 text-left hover:bg-gray-100 rounded-md"
                                                data-modal-target="popup-modal-delete-{{ $user->id_user }}"
                                                data-modal-toggle="popup-modal-delete-{{ $user->id_user }}">
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

                                {{-- Modal Delete --}}
                                @include('dashboard.components.modals.pages.petugas.modal-delete-petugas', [
                                    'user' => $user,
                                ])

                                {{-- Modal Edit --}}
                                @include('dashboard.components.modals.pages.petugas.modal-edit-petugas', [
                                    'user' => $user,
                                ])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="text-gray-500">Belum ada data petugas</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Pagination --}}
            @if ($users->total() > 10)
                <div class="my-4 px-4">
                    {{ $users->links('pagination.tailwindcss-paginate') }}
                </div>
            @endif
        </div>

        <!-- Modal Tambah Petugas -->
        @include('dashboard.components.modals.pages.petugas.modal-tambah-petugas')
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
            @if ($errors->any())
                const modal = document.getElementById('tambah-petugas-modal');
                if (modal) {
                    const modalInstance = new Modal(modal);
                    modalInstance.show();
                }
            @endif
        });

        document.querySelector('[data-modal-target="tambah-petugas-modal"]').addEventListener('click', function() {
            const form = document.getElementById('tambahPetugasForm');
            form.reset();
        });
    </script>
@endpush
