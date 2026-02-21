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
        Schema::create('monitoring_spjs', function (Blueprint $table) {
            $table->id();
            $table->date('submitted_at')->nullable();
            $table->date('activity_date')->nullable();
            $table->string('division')->nullable();
            $table->string('mak_number')->nullable();
            $table->string('activity_name')->nullable();
            $table->unsignedBigInteger('rab')->nullable();
            $table->unsignedBigInteger('realization')->nullable();
             // Approval flow
            $table->date('pelaksana_approved_at')->nullable();
            $table->date('tu_approved_at')->nullable();
            $table->date('ppk_approved_at')->nullable();
            $table->date('finance_approved_at')->nullable();
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_spjs');
    }
};
