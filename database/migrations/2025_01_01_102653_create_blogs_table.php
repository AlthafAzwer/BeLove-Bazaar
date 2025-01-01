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
    Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->string('image')->nullable(); // Store image path
        $table->string('video_link')->nullable(); // Store YouTube/Video link
        $table->timestamps();
    });
}

};
