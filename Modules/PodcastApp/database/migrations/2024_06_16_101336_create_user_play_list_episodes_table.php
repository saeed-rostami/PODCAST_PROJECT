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
        Schema::create('user_play_list_episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("playlist_id")
                ->references("id")
                ->on("user_play_lists")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId("episode_id")
                ->references("id")
                ->on("episodes")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_play_list_episodes');
    }
};
