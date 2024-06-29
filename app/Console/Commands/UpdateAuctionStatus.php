<?php

namespace App\Console\Commands;

use App\Enums\AuctionStatus;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateAuctionStatus extends Command
{
    protected $signature = 'auction:update-status';
    protected $description = 'Update the status of active auctions whose end time has been reached';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();
        $auctions = Auction::where('status', AuctionStatus::ACTIVE)->get();

        foreach ($auctions as $auction) {
            if(Carbon::parse($auction->end_time) <= $now){
                $auction->status = AuctionStatus::FINISHED;
                $auction->save();
            }
        }
        
        $this->info('Auction statuses updated successfully.');
    }
}
