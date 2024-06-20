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
        Schema::create('component_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId("component_id")
                ->references("id")
                ->on("components")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->morphs("item");
            $table->string("url")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_items');
    }
};
