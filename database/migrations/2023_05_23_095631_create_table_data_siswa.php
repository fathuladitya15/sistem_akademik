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
			$table->foreignId('user_id')->constrained('users');
			$table->string('nis');
			$table->string('jenis_kelamin');
			$table->string('tempat_lahir')->nullable();
			$table->date('tanggal_lahir');
			$table->text('alamat');
			$table->string('nomer_telepon');
			$table->string('provinsi_code')->nullable();
			$table->string('kota_code')->nullable();
			$table->string('district_code')->nullable();
			$table->string('villages_code')->nullable();
			$table->string('status_kelengkapan')->nullable();
			$table->string('jalur_pendaftaran')->nullable();
			$table->foreignId('jurusan_id')->nullable()->constrained('tbl_jurusan');
			$table->foreignId('jurusan_opsi_id')->nullable()->constrained('tbl_jurusan');
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
