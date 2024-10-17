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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 255)->nullable();
            $table->string('image_url', length: 255)->nullable();
            $table->string('phone', length: 10)->nullable();
            $table->string('email', length: 255)->unique();
            $table->string('password', length: 255);
            $table->integer('loginType')->default(1)->nullable();
            $table->string('token', length: 10)->nullable();
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
