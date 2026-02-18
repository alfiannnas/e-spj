<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    use SoftDeletes;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('satuan_kerja');
            $table->date('tanggal_sp');
            $table->string('nama_pejabat_penandatangan');
            $table->string('nama_penyedia');
            $table->string('nama_paket_pengadaan');
            $table->string('sumber_dana');
            $table->bigInteger('nilai_kontrak');
            $table->date('waktu_pelaksanaan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
