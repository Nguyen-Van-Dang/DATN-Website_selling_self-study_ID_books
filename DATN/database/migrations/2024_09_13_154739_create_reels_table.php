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
        Schema::create('reels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('reel_comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('reel_id')->nullable()->constrained('reels')->onDelete('cascade'); // Foreign key to reals table
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->text('content'); // Comment content
            $table->unsignedBigInteger('parent_id')->nullable(); // For threaded comments
            $table->foreign('parent_id')->references('id')->on('reel_comments')->onDelete('cascade'); // Recursive foreign key for parent comment
            $table->timestamps(); // Timestamps
            $table->boolean('is_show')->default(0);
        });
        Schema::create('reel_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reel_id')->constrained('reels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('reel_comments', function (Blueprint $table) {
            $table->dropForeign(['reel_id']);
            $table->dropForeign(['parent_id']);
        });

        Schema::dropIfExists('reel_likes');
        Schema::dropIfExists('reel_comments');
        Schema::dropIfExists('reels');
    }
};
