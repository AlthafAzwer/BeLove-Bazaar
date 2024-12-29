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
    Schema::table('orders', function (Blueprint $table) {
        $table->foreignId('auction_id')->nullable()->constrained('auctions')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('auction_id');
    });
}

};
