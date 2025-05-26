<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slot_waktu extends Model
{
    protected $fillable = [
        'waktu_mulai',
        'waktu_selesai'
    ];

    protected $table = 'slot_waktus';
    public function bookings()
    {
        return $this->hasMany(booking::class);
    }
}
