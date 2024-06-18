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
        Schema::create('episode_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tag_id")
                ->references("id")
                ->on("tags")
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
        Schema::dropIfExists('episode_tags');
    }
};
