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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            
            // Link to the customers table
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            
            $table->string('name'); // e.g., "ACME Corp - Annual Subscription"
            $table->decimal('value', 10, 2); // The monetary value of the deal
            
            // The sales pipeline stage
            $table->enum('stage', [
                'Lead',
                'Contacted',
                'Demo Scheduled',
                'Proposal Sent',
                'Won',
                'Lost'
            ])->default('Lead');

            $table->date('expected_close_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};