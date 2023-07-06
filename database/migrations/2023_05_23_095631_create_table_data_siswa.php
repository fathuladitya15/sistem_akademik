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
			$table->string('nis');
			$table->string('jenis_kelamin');
			$table->string('tempat_lahir');
			$table->date('tanggal_lahir');
			$table->text('alamat');
			$table->string('nomer_telepon');
			$table->string('provinsi_code');
			$table->string('kota_code');
			$table->string('district_code');
			$table->string('villages_code');
			$table->string('status_kelengkapan')->nullable();
			$table->string('jalur_pendaftaran')->nullable();
			$table->string('jurusan_id');
			$table->string('jurusan_opsi_id');
			$table->string('kelas');
			$table->string('tahun_ajaran');
			$table->string('nilai_rata');
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
