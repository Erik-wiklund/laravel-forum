<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('private_messages', function (Blueprint $table) {
            $table->id();
            $table->json('participants'); // Store user IDs in JSON format
            $table->string('subject');
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            // Add the 'created_by' column as a foreign key to 'users' table
            $table->foreignId('created_by')->constrained('users'); // Change 'user_id' to 'created_by'
            $table->unsignedBigInteger('last_poster_id')->default(DB::raw('created_by')); // Set default to created_by
            $table->foreign('last_poster_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_messages');
    }
};
