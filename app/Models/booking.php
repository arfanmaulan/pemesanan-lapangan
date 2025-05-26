<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'slot_waktu_id',
        'metode_pembayaran_id',
        'tanggal_booking',
        'status_pembayaran', // unpaid, paid
        'status', // pending, confirmed, cancelled
        'catatan'
    ];
    protected $table = 'bookings';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lapangan()
    {
        return $this->belongsTo(lapangan::class);
    }
    public function slot_waktu()
    {
        return $this->belongsTo(slot_waktu::class);
    }
    public function metode_pembayaran()
    {
        return $this->belongsTo(metode_pembayaran::class);
    }
}
