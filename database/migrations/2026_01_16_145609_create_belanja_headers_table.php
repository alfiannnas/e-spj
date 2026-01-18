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
        Schema::create('belanja_headers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('program_id')->nullable();
            $table->bigInteger('kro_id')->nullable();
            $table->bigInteger('ro_id')->nullable();
            $table->bigInteger('komponen_id')->nullable();
            $table->string('nama_uraian');
            $table->string('kode_subkomponen')->nullable();
            $table->string('nama_subkomponen')->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->integer('jumlah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belanja_headers');
    }
};
