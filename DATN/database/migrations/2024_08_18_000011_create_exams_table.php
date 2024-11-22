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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');

            $table->timestamps();
        });

        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question', 255);
            $table->foreignId('exam_id')->nullable()->constrained('exams')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('exam_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer', 255)->nullable(false);
            $table->boolean('is_correct')->default(false);
            $table->foreignId('question_id')->constrained('exam_questions')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            $table->integer('score')->default(0);
            $table->integer('correct_amount')->default(0);
            $table->integer('incorrect_amount')->default(0);
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });


        Schema::create('exam_user_answers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('answer_id')->nullable()->constrained('exam_answers')->onDelete('cascade');
            $table->foreignId('result_id')->nullable()->constrained('exam_results')->onDelete('cascade');
            $table->foreignId('question_id')->nullable()->constrained('exam_questions')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
        Schema::dropIfExists('exam_questions');
        Schema::dropIfExists('exam_answers');
        Schema::dropIfExists('exam_user_answers');
        Schema::dropIfExists('exam_results');
    }
};
