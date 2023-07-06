<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

	protected $table = 'tbl_jurusan';

	protected $fillable = ['nama_jurusan','deskripsi_jurusan','singkatan_jurusan'];
}
