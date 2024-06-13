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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("season_id")
                ->references("id")
                ->on("seasons")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string("title");
            $table->longText("description")->nullable();
            $table->boolean('allow_comment');
            $table->boolean('allow_share');
            $table->string( 'cover');
            $table->timestamp('publish_at');
            $table->timestamp('published_at')->nullable();
            $table->tinyInteger("status")->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
