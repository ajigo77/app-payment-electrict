<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $guarded = ['id_pelanggan'];

    public function jenisPelanggan()
    {
        return $this->belongsTo(JenisPelanggan::class, 'jenis_pelanggan_id', 'id_jenis_pelanggan');
    }

    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class, 'pelanggan_id', 'id_pelanggan');
    }
}
