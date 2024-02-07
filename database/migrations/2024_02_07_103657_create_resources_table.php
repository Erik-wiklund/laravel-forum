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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->string('category');
            $table->string('title');
            $table->text('description');
            $table->decimal('version', 8, 2); // Adjust precision and scale as needed
            $table->string('tag_line');
            $table->string('format'); // Column for storing file format
            $table->string('url')->nullable(); // Column for additional URL, allowing NULL values
            $table->string('image')->nullable(); // Column for storing image path, allowing NULL values

            $table->foreign('created_by')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
