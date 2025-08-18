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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_kegiatan');
            $table->date('tgl_awal');
            $table->date('tgl_selesai');
            $table->string('jam_kegiatan');
            $table->string('waktu_selesai');
            $table->text('deskripsi_kegiatan')->nullable();
            $table->text('perlengkapan')->nullable();
            $table->text('link_zoom')->nullable();
            $table->string('unit_kegiatan');
            // $table->string('pic');
            $table->string('status')->default('pending');
            $table->string('tempat_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
