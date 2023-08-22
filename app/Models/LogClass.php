<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogClass extends Model
{
    use HasFactory;

	protected $table  = 'tbl_log_class';

	protected $fillable  = [
		'jurusan_id',
		'JmlSiswaL',
		'JmlSiswap',
		'JmlKls',
		'JmlLKls',
		'JmPLKls',
		'JmlSiswaKls',
		'ThnAjaran',
	];
}
