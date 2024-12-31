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
        Schema::create('send_messages', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->timestamps();
        });

        Schema::create('message_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('send_messages')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_user');
        Schema::dropIfExists('send_messages');
    }
};
