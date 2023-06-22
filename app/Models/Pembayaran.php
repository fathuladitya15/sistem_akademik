<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

	protected $table = 'Pembayaran';

	protected $fillable = ['user_id','kode_pembayaran','nominal_pembayaran','status_pembayaran','detail_pembayaran'];
}
