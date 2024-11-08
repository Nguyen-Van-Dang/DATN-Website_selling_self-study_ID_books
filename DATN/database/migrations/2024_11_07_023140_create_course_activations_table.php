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
        Schema::create('course_activations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('activation_code', 255);
            $table->timestamp('activation_date')->nullable();
            $table->unique(['book_id', 'course_id', 'activation_code']);

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['book_id', 'course_id']);
            $table->unique('activation_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_activations');
    }
};
