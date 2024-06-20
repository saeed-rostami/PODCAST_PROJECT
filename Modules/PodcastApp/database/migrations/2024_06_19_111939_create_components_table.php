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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->foreignId("type_id")
                ->references("id")
                ->on("types")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->enum("content_type", ["PODCAST", "EPISODE"]);
            $table->string("key")->unique();
            $table->string("display_key")->unique();
            $table->string("class")->unique();
            $table->string("url")->nullable();
            $table->string("cover")->nullable();
            $table->tinyInteger("sort_order");
            $table->boolean("is_active")->default(1);
            $table->json("metas")->nullable();
            $table->boolean("is_premium")->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
