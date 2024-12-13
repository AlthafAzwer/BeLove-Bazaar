<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Command to display an inspiring quote
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Command to check and update auction statuses
Artisan::command('auction:check-end', function () {
    Artisan::call('auction:check-end'); // Execute the auction:check-end command
})->describe('Check for auctions that have ended and update their auction_state');

// Optional: Schedule this manually for testing
// Note: Regular scheduling should go in the `config/schedule.php` or `Task Scheduling`.
