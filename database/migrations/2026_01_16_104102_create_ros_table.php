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
        Schema::create('ros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kro_id')->nullable();
            $table->string('kode_ro')->unique();
            $table->string('nama_ro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ros');
    }
};
