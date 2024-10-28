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
            $table->text('description');
            $table->integer('quantity');
            $table->timestamp('activated_at')->nullable();
            $table->integer('activated_by')->nullable();
            $table->boolean('book_active');
            $table->integer('book_activate_id');
            $table->string('image', 255)->nullable();
            $table->foreignId('course_id')->nullable()->constrained('courses')->onDelete('set null');
            $table->foreignId('book_categories_id')->nullable()->constrained('book_categories')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->softDeletes();
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
