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
        Schema::table('chat_rooms', function (Blueprint $table) {
            // Add a foreign key column to reference the banned user
            $table->unsignedBigInteger('banned_user_id')->nullable();

            // Create a foreign key constraint to the 'users' table
            $table->foreign('banned_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null'); // You can choose the appropriate action on deletion

            // Additional columns or modifications can be added here if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
