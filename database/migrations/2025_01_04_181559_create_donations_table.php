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
    Schema::create('donations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // User fulfilling the donation
        $table->unsignedBigInteger('charity_id'); // Charity receiving the donation
        $table->string('item_description');
        $table->integer('quantity');
        $table->string('delivery_preference'); // 'Pickup' or 'Delivery'
        $table->string('status')->default('Pending'); // 'Pending', 'Completed', 'Rejected'
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('donations');
}

};
