<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Reference to orders table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Reference to products table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to users table
            $table->integer('rating'); // Rating field
            $table->text('review')->nullable(); // Review text
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
