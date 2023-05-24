<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_data_siswa', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id');
			$table->integer('nis');
			$table->string('jenis_kelamin');
			$table->string('tempat_lahir');
			$table->date('tanggal_lahir');
			$table->text('alamat');
			$table->integer('nomer_telepon');
			$table->text('hobby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_data_siswa');
    }
};
