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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)->nullable();
            $table->text('description');
            $table->string('created_by', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->foreignId('lecture_id')->nullable()->constrained('lectures')->onDelete('set null');
            $table->string('created_by', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
