<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lapangan extends Model
{
    protected $fillable = [
        'nama',
        'type',
        'harga'
    ];

    protected $table = 'lapangans';
    public function bookings()
    {
        return $this->hasMany(booking::class);
    }
}
