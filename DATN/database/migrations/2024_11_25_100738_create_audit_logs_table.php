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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model'); // user, book, course
            $table->unsignedBigInteger('model_id'); // ID của đối tượng
            $table->string('action'); // approve, reject
            $table->unsignedBigInteger('admin_id'); // ID người kiểm duyệt
            $table->timestamp('created_at')->useCurrent();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
