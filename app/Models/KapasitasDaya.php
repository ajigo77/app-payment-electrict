<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasDaya extends Model
{
    use HasFactory;

    protected $table = 'kapasitas_daya';
    protected $primaryKey = 'id_kapasitas_daya';
    protected $guarded = ['id_kapasitas_daya'];

    public function jenisPelanggan()
    {
        return $this->hasOne(JenisPelanggan::class, 'kapasitas_daya_id', 'id_kapasitas_daya');
    }
}
