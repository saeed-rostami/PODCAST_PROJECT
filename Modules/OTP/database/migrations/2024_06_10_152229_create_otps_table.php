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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();
            $table->morphs( 'user' );
            $table->string( 'mobile' , 15 )->nullable();
            $table->string( 'email'  )->nullable();
            $table->integer( 'otp' )->nullable();
            $table->timestamp( 'otp_expire_at' )->nullable();
            $table->enum("type", ["login" , "register" , "forgot_password"])
                ->nullable()
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};
