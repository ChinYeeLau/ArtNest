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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('sender_id');
            $table->text('content');
            $table->boolean('is_deleted_by_user')->default(false);
            $table->boolean('is_deleted_by_vendor')->default(false);
            $table->timestamps();
             // Adding foreign keys
             $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
             $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
 
             // Adding indexes
             $table->index('chat_id');
             $table->index('sender_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
