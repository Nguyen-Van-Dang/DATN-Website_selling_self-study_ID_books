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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id'); // Người theo dõi
            $table->unsignedBigInteger('following_id'); // Người được theo dõi
            $table->timestamps();
            
            // Thiết lập khóa ngoại
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
            
            // Đảm bảo một người chỉ follow người khác một lần
            $table->unique(['follower_id', 'following_id']);
        });
        
    }
    
    public function down()
    {
        Schema::dropIfExists('follows');
    }
    
};
