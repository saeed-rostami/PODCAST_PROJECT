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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->references("id")
                ->on("users")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId("category_id")
                ->references("id")
                ->on("categories")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string("title")->unique();
            $table->text("description")->nullable();
            $table->tinyInteger("status")->default(1);
            $table->string("cover")->nullable();
            $table->boolean('allow_comment');
            $table->enum('financial_status' , ["FREE" , "PREMIUM"])
            ->default("FREE");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
