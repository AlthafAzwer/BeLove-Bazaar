<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;

class EndAuctionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Detect auctions that have ended and process them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch auctions where end_time has passed and status is still active
        $auctions = Auction::where('end_time', '<', now())
            ->where('status', 'active')
            ->get();

        foreach ($auctions as $auction) {
            DB::transaction(function () use ($auction) {
                // Find the highest bid
                $winningBid = Bid::where('auction_id', $auction->id)
                    ->orderBy('bid_amount', 'desc')
                    ->first();

                // Mark the auction as completed
                $auction->update(['status' => 'completed']);

                // Update bid statuses
                $bids = Bid::where('auction_id', $auction->id)->get();
                foreach ($bids as $bid) {
                    if ($winningBid && $bid->id === $winningBid->id) {
                        $bid->update(['status' => 'won']);
                    } else {
                        $bid->update(['status' => 'lost']);
                    }
                }
            });
        }

        $this->info('Auctions ending process completed.');
        return 0;
    }
}
