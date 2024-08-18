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
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->float('score');
            $table->integer('number_correct');
            $table->integer('number_incorrect');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('test_id')->nullable()->constrained('tests')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->id();


            $table->timestamps();
        });
        Schema::create('questions', function (Blueprint $table) {
            $table->id();


            $table->timestamps();
        });
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            $table->timestamps();
        });

        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
        Schema::dropIfExists('results');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('exams');
    }
};
