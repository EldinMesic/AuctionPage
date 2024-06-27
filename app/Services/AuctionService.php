<?php

namespace App\Services;

use App\Models\Auction;
use Illuminate\Support\Facades\Auth;

class AuctionService
{
    public function getAuctionView($auction_id)
    {
        $auction = Auction::find($auction_id);
        $isCreator = $auction->creator() == Auth::user();
        $highestBid = $auction->bids()->orderByDesc('amount')->first();
        $isBidLeader = $highestBid && $highestBid->user() == Auth::user();

        return view('auctions.show')
            ->with('auction', $auction)
            ->with('is_creator', $isCreator)
            ->with('highest_bid', $highestBid)
            ->with('is_bid_leader', $isBidLeader);
    }
}