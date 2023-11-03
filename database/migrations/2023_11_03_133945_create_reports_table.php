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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporter');
            $table->unsignedBigInteger('reported_reply');
            $table->unsignedBigInteger('reported_thread');
            $table->text('reason');
            $table->timestamps();

            // Define foreign key constraints if needed
            $table->foreign('reporter')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('reported_reply')->references('id')->on('replies')->onDelete('CASCADE');
            $table->foreign('reported_thread')->references('id')->on('threads')->onDelete('CASCADE');
            // Add more foreign key constraints if the reported item relates to other tables (e.g., posts, comments).

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
