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
        Schema::create('belanja_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('belanja_header_id');
            $table->bigInteger('akun_id');
            $table->string('nama_item');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belanja_items');
    }
};
