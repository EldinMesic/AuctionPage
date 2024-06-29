<?php

namespace App\Http\Controllers;

use App\Enums\AuctionStatus;
use App\Models\Auction;
use App\Models\Bid;
use App\Services\AuctionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $amount = (float) $request->amount;
        $auction = Auction::find($request->auction_id);
        
        if($auction->status !== AuctionStatus::ACTIVE){
            return redirect()->back()->with('error', 'This bid is already over or cancelled.');
        }else if($auction->end_time <= Carbon::now()){
            $auction->status = AuctionStatus::FINISHED;
            $auction->save();
            return redirect()->back()->with('error', 'This bid is already over.');
        }

        $highestBid = $auction->bids()->orderByDesc('amount')->first();

        if($amount < $auction->starting_price && $auction->bids()->count() === 0){
            return redirect()->back()->with('error', 'Your bet is lower then the starting price.');
        }
        if($highestBid != null && $highestBid->amount >= $amount){
            return redirect()->back()->with('error', 'Your bet is lower then the current highest bet.');
        }
        if($amount > $auction->buyout_price){
            return redirect()->back()->with('error', 'Your bet is higher than the buyout price: '.number_format($auction->buyout_price, 2).'$');
        }
        
        try {
            $bid = Bid::create([
                'user_id' => Auth::id(),
                'auction_id' => $auction->id,
                'amount' => $amount
            ]);

            $auction->bids()->save($bid);

            if($amount >= $auction->buyout_price){
                $auction->status = AuctionStatus::FINISHED;
                $auction->save();
                return redirect()->route('auctions.show', ['auction' => $auction])->with('success', 'Item bought successfully');    
            }else{
                return redirect()->route('auctions.show', ['auction' => $auction])->with('success', 'Bid placed successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to place bid. Please try again.');
        }
    }
}