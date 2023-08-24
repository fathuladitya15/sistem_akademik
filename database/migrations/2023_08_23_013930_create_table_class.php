<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('table_class', function (Blueprint $table) {
            $table->id();
			$table->string('table_data_siswa_id');
			$table->string('jurusan_id');
			$table->string('tingkatan');
			$table->string('table_kelas_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_class');
    }
};
