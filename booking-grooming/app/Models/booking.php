<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_hewan',
        'jenis_hewan',
        'usia',
        'pemilik',
        'nomor_telepon',
        'tanggal_booking',
        'jam_booking'
    ];
}
