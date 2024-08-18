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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)->nullable();
            $table->float('price');
            $table->integer('page_number');
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');
            $table->text('description');
            $table->integer('quantity');
            $table->integer('book_activate_id');
            $table->timestamps('activated_at');
            $table->integer('activated_by')->nullable();
            $table->boolean('book_active');
            $table->foreignId('category_books_id')->nullable()->constrained('category_books')->onDelete('set null');
            $table->string('image', 255)->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
