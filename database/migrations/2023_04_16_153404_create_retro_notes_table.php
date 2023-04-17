<?php

use App\Models\RetroUser;
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
        Schema::create('retro_notes', function (Blueprint $table) {
            $table->id();
            $table->longText('content')->nullable(false);
            $table->enum('retro_column', [
                'wentWell',
                'toImprove',
                'toDiscuss',
            ])->nullable(false);
            $table->bigInteger('retro_session_id')->nullable(false);
            $table->foreign('retro_session_id')->references('id')->on('retro_sessions');
            $table->bigInteger('retro_user_id')->nullable(false);
            $table->foreign('retro_user_id')->references('id')->on('retro_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retro_notes');
    }
};
