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
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('sub_category_id');
            $table->timestamps();
            $table->text('content');
            $table->foreignId('created_by')->constrained('users'); // Change 'user_id' to 'created_by'
            $table->unsignedBigInteger('last_poster_id')->default(DB::raw('created_by')); // Set default to created_by
            $table->foreign('last_poster_id')->references('id')->on('users');
        
            // Define the foreign key constraint for sub_category_id
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread');
    }
};
