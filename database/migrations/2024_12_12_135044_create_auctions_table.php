<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table
            $table->string('category');
            $table->string('title');
            $table->string('condition'); // e.g., 'New' or 'Used'
            $table->string('location');
            $table->text('description');
            $table->decimal('start_bid', 10, 2); // Initial bid amount
            $table->decimal('max_bid', 10, 2); // Maximum allowed bid
            $table->integer('duration'); // Duration in hours/days
            $table->json('images')->nullable(); // Store image paths as JSON
            $table->string('contact_info');
            $table->string('status')->default('pending'); // e.g., 'pending', 'approved', 'rejected'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions');
    }
}
