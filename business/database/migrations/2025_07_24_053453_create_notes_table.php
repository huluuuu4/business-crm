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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            // Foreign key for the user who wrote the note
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Foreign key for the deal the note is attached to
            $table->foreignId('deal_id')->constrained()->onDelete('cascade');
            
            // The actual content of the note
            $table->text('body');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};