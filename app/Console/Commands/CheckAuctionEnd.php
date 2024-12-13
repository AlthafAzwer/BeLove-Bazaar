<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckAuctionEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:check-end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for auctions that have ended, update their auction_state, and mark the winner if applicable';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Starting CheckAuctionEnd command.");

        // Fetch all auctions where the end time has passed and the auction_state is still pending
        $endedAuctions = Auction::where('end_time', '<=', Carbon::now())
            ->where('auction_state', 'pending') // Ensure only pending auctions are processed
            ->get();

        if ($endedAuctions->isEmpty()) {
            Log::info("No auctions to process.");
            $this->info('No auctions to process.');
            return 0;
        }

        foreach ($endedAuctions as $auction) {
            Log::info("Processing auction ID: {$auction->id}");

            // Mark the auction as completed
            $auction->auction_state = 'completed';
            $auction->save();

            // Find the highest bid for this auction
            $highestBid = $auction->bids()->orderBy('bid_amount', 'desc')->first();

            if ($highestBid) {
                // Mark the highest bid as the winning bid
                $highestBid->status = 'won';
                $highestBid->save();

                Log::info("Auction ID: {$auction->id} - Winning bid ID: {$highestBid->id} marked as won.");
            } else {
                Log::info("Auction ID: {$auction->id} - No bids found.");
            }
        }

        $this->info('Auction end check completed successfully.');
        Log::info("CheckAuctionEnd command completed.");
        return 0;
    }
}
