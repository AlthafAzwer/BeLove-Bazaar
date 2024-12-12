<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharityRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_requests', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->string('name'); // Charity name
            $table->string('address'); // Charity address
            $table->string('phone'); // Phone number
            $table->string('logo'); // Path to the logo image
            $table->string('certification'); // Path to the certification file
            $table->text('description'); // Description of the charity's needs
            $table->integer('quantity'); // Quantity of requested items
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Request status
            $table->text('rejection_reason')->nullable(); // Reason for rejection (if rejected)
            $table->timestamps(); // Created_at and Updated_at

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charity_requests');
    }
}
