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
        Schema::create('retro_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('retro_session_id')->nullable(false);
            $table->foreign('retro_session_id')->references('id')->on('retro_sessions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retro_users');
    }
};