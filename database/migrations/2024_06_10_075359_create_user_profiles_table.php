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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->references("id")
                ->on("users")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->boolean("active")->default(1);
            $table->boolean("donate")->default(1);
            $table->string("donate_text")->default("Buy me a Coffee");
            $table->boolean("monetized")->default(0);
            $table->string("avatar")->nullable();
            $table->timestamp("birthday")->nullable();
            $table->enum("gender", ["MALE", "FEMALE", "OTHER"])
                ->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
