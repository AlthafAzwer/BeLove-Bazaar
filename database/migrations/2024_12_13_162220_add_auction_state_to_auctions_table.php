<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuctionStateToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->string('auction_state')->default('pending'); // pending, active, completed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->dropColumn('auction_state');
        });
    }
}
