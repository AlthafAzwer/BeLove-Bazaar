<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('auction_orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('auction_id');
        $table->unsignedBigInteger('buyer_id');
        $table->string('buyer_name');
        $table->text('buyer_address');
        $table->string('buyer_phone');
        $table->string('status')->default('Pending'); // Status: Pending, Shipped, Completed
        $table->timestamps();

        // Foreign keys
        $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
        $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
    });
}

};
