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
        Schema::create('private_message_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Add foreign key to users table
            $table->foreignId('private_message_id')->constrained('private_messages'); // Add foreign key to private_messages table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_message_user');
    }
};
