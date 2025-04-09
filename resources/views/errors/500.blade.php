@extends('client.layouts.error-layout')

@section('status-title', '500 - Kesalahan Server')
@section('illustration-src', asset('ilustration-errors/500.png'))
@section('status-heading', 'Kesalahan Server Internal')
@section('status-message', 'Terjadi masalah di sisi server. Tim teknis kami sedang menangani situasi ini.')

@section('action-buttons')
    <a href="{{ route('pelanggan') }}"
        class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">
        Kembali ke Beranda
    </a>
    <button onclick="window.location.reload()"
        class="inline-block bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300">
        Muat Ulang
    </button>
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
                    <p>Error Occurred At: {{ now() }}</p>
                </li>
                <li>
                    <p>Request Method: {{ request()->method() }}</p>
                </li>
                <li>
                    <p>Request URL: {{ request()->fullUrl() }}</p>
                </li>
            </ul>
        </div>
    </div>
@endsection
