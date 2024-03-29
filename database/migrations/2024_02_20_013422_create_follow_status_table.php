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
        Schema::create('follow_status', function (Blueprint $table) {
            // followers are the people who follow me

            $table->unsignedBigInteger('follower_id');
            //   followings are the people who i follow

            $table->unsignedBigInteger('following_id');
            $table->foreign('follower_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->primary(['follower_id', 'following_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_status');
    }
};
