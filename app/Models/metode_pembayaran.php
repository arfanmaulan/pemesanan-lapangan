<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class metode_pembayaran extends Model
{
    protected $fillable = [
        'nama_metode'
    ];

    protected $table = 'metode_pembayarans';
    public function bookings()
    {
        return $this->hasMany(booking::class);
    }
}
