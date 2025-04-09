<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function getBiayaBeban($id_pelanggan)
{
    $pelanggan = Pelanggan::with(['jenisPelanggan.kapasitasDaya'])
        ->findOrFail($id_pelanggan);

    return response()->json([
        'biaya_beban' => $pelanggan->jenisPelanggan->kapasitasDaya->biaya_beban,
        'tarif_kwh' => $pelanggan->jenisPelanggan->kapasitasDaya->tarif_kwh
    ]);
}
}
