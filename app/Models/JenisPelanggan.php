<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelanggan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pelanggan';
    protected $primaryKey = 'id_jenis_pelanggan';
    protected $guarded = ['id_jenis_pelanggan'];

    public function kapasitasDaya()
    {
        return $this->belongsTo(KapasitasDaya::class, 'kapasitas_daya_id', 'id_kapasitas_daya');
    }

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'jenis_pelanggan_id', 'id_jenis_pelanggan');
    }
}
