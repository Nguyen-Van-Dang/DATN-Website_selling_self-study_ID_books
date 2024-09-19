<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comment_reels', function (Blueprint $table) {
            $table->id('comment_reel_id'); // Primary key
            $table->foreignId('reel_id')->nullable()->constrained('reels')->onDelete('cascade'); // Foreign key to reals table
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->text('content'); // Comment content
            $table->unsignedBigInteger('parent_id')->nullable(); // For threaded comments
            $table->foreign('parent_id')->references('comment_reel_id')->on('comment_reels')->onDelete('cascade'); // Recursive foreign key for parent comment
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('comment_reels');
    }
};
