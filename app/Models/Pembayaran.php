<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $guarded = ['id_pembayaran'];

    public function pemakaian()
    {
        return $this->belongsTo(Pemakaian::class, 'pemakaian_id', 'id_pemakaian');
    }

    protected $casts = [
        'tanggal_bayar' => 'date'
    ];

    public function getTanggalBayarFormattedAttribute()
    {
        return $this->tanggal_bayar ? $this->tanggal_bayar->format('d-m-Y') : null;
    }
}
