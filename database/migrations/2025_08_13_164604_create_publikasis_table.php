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
        Schema::create('publikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();  // Menambahkan foreign key untuk user_id
            $table->foreignId('tahun_akademik_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('pengajuan_id')->constrained()->cascadeOnDelete();  // Menghubungkan dengan tabel pengajuan
            $table->string('upload_laporan')->nullable();
            $table->string('link_dokumentasi')->nullable();
            $table->string('link_publikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publikasis');
    }
};
