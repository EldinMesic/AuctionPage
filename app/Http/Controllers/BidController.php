<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Services\AuctionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    protected $auctionService;
    public function __construct(AuctionService $auctionService)
    {
        $this->auctionService = $auctionService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $amount = $request->amount;
        $auction = $request->auction;
        
        $highestBid = $auction->bids()->orderByDesc('value')->first();

        if($highestBid > $amount){
            return redirect()->back()->with('error', 'Your bet is lower then the current highest bet.');
        }
        
        try {
            $bid = Bid::create([
                'user_id' => Auth::id(),
                'auction_id' => $auction->id,
                'amount' => $amount
            ]);
            $auction->bids()->save($bid);
            
            return $this->auctionService->getAuctionView($auction->id)->with('success', 'Bid placed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to place bid. Please try again.');
        }
    }
}