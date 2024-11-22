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
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['book_id', 'course_id']);
        });

        Schema::create('course_activation_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_activation_id')->constrained('course_activations')->onDelete('cascade');
            $table->string('activation_code', 16);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('activation_date')->nullable();
            $table->index(['activation_code', 'course_activation_id'], 'activation_code_course_activation_id_index');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_activation_codes');
        Schema::dropIfExists('course_activations');
    }
};
