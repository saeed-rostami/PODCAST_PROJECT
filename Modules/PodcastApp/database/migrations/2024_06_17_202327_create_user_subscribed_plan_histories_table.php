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
        Schema::create('user_subscribed_plan_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("plan_id")
                ->references("id")
                ->on("subscription_plans")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId("user_id")
                ->references("id")
                ->on("users")
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamp("start_at");
            $table->timestamp("expire_at");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscribed_plan_histories');
    }
};
