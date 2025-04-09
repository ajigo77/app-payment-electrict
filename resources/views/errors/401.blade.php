@extends('client.layouts.error-layout')

@section('status-title', '401 - Tidak Diotorisasi')
@section('illustration-src', asset('ilustration-errors/401.png'))
@section('status-heading', 'Autentikasi Diperlukan')
@section('status-message', 'Silakan login untuk mengakses halaman atau sumber daya ini.')

@section('action-buttons')
    <a href="{{ route('auth.login') }}"
        class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">
        Login
    </a>
    <a href="{{ route('pelanggan') }}"
        class="inline-block bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-300">
        Beranda
    </a>
@endsection

@section('debug-info')
    <div class="flex p-4 mb-4 text-sm text-red-600 rounded-lg bg-red-50" role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Danger</span>
        <div>
            <span class="font-medium">Informasi Debug:</span>
            <ul class="mt-1.5 list-disc list-inside">
                <li>
                    <p>Attempted URL: {{ request()->fullUrl() }}</p>
                </li>
                <li>
                    <p>Authentication Status: Not Authenticated</p>
                </li>
            </ul>
        </div>
    </div>
@endsection
