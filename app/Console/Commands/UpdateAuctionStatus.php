<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;

class UpdateAuctionStatus extends Command
{
    protected $signature = 'auction:update-status';
    protected $description = 'Update auction statuses to "completed" if the end time has passed';

    public function handle()
    {
        $now = now();
        $auctions = Auction::where('end_time', '<=', $now)
                           ->where('status', 'active') // Update only active auctions
                           ->get();

        foreach ($auctions as $auction) {
            $auction->status = 'completed';
            $auction->save();
        }

        $this->info('Auction statuses updated successfully.');
    }
}