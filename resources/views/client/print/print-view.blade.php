<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Pembayaran Tagihan Listrik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-mono text-sm p-4">
    <div class="max-w-md max-h-screen mx-auto justify-center items-center flex flex-col border border-gray-300 p-3 rounded-md">
        <!-- Header -->
        <div class="text-center mb-4">
            <h2 class="text-lg font-bold">STRUK PEMBAYARAN TAGIHAN LISTRIK</h2>
        </div>

        <div class="border-t border-dashed border-gray-400"></div>

        <!-- Content -->
        <div class="space-y-2 my-4">
            <div class="flex justify-between">
                <span>ID PEL: {{ $pembayaran->pemakaian->pelanggan->no_kontrol ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>NAMA: {{ $pembayaran->pemakaian->pelanggan->nama_lengkap ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>TARIF/DAYA: {{ $pembayaran->pemakaian->pelanggan->jenisPelanggan->kapasitasDaya->batas_daya ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>TGL/JAM: {{ $pembayaran->tanggal_bayar_formatted ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>BL/TH: {{ str_pad($pembayaran->pemakaian->bulan, 2, '0', STR_PAD_LEFT) }}/{{ $pembayaran->pemakaian->tahun ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>STAND METER: {{ $pembayaran->pemakaian->meter_awal ?? '-' }}-{{ $pembayaran->pemakaian->meter_akhir ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>NO REF: {{ $pembayaran->no_ref ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span>TOTAL BAYAR: Rp{{ number_format($pembayaran->pemakaian->biaya_pemakai, 0, ',', '.') ?? '-' }}</span>
            </div>
        </div>

        <div class="border-t border-dashed border-gray-400"></div>

        <!-- Total -->
        <div class="my-4">
            <div class="flex justify-between font-bold">
                <span>TOTAL BAYAR</span>
                <span>: Rp{{ number_format($pembayaran->pemakaian->biaya_pemakai, 0, ',', '.') ?? '-' }}</span>
            </div>
        </div>

        <div class="border-t border-dashed border-gray-400"></div>

        <!-- Footer -->
        <div class="text-center text-xs space-y-2 mt-4 uppercase">
            <p>PLN menyatakan struk ini sebagai bukti pembayaran yang sah</p>
            <p>Terima kasih</p>
        </div>

        <div class="flex flex-col w-full justify-center items-center gap-6">
            <button onclick="window.print()" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded mx-auto block print:hidden">
            Print
        </button>
        <a href="{{ route('dashboard.users') }}" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded mx-auto block print:hidden">
            Kembali
        </a>
        </div>
    </div>

    <style>
        @media print {
            @page {
                margin: 0;
                size: 80mm 297mm;
            }

            body {
                margin: 10px;
            }
        }
    </style>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });
        </script>
    @endif
</body>
</html>
