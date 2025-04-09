<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = 'pemakaian';
    protected $primaryKey = 'id_pemakaian';
    protected $guarded = ['id_pelanggan'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id_pelanggan');
    }

    public function getMeterAwalAttribute($value)
    {
        return str_replace('.', '', $value);
    }

    public function getMeterAkhirAttribute($value)
    {
        return str_replace('.', '', $value);
    }
}
