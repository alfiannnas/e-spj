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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            $table->string('kode')->unique();          // Kode aset
            $table->string('nama');                    // Nama aset
            $table->string('nup')->nullable();         // Nomor Urut Pendaftaran
            $table->integer('jumlah')->default(1);    // Jumlah aset
            $table->string('satuan');                  // Unit (unit, buah, set, dll)
            $table->string('merk_tipe')->nullable();   // Merk / Tipe
            $table->date('tgl_perolehan');             // Tanggal perolehan
            $table->string('kondisi');                 // Baik / Rusak Ringan / Rusak Berat
            $table->string('penanggung_jawab');        // PJ aset
            $table->string('status');                  // Digunakan / Disimpan / Dihapus

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
