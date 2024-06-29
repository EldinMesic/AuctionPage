<?php

namespace App\Http\Controllers;

use App\Enums\AuctionCategory;
use App\Enums\AuctionStatus;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AuctionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auctions = Auction::where('status', AuctionStatus::ACTIVE)
                   ->with('creator')
                   ->get();
        return view('auctions.index', ['auctions' => $auctions]);
    }
    /**
     * Display a listing of the resource.
     */
    public function filteredIndex(Request $request)
    {

        $categories = [];
        foreach (AuctionCategory::cases() as $category) {
            $count = Auction::where('status', AuctionStatus::ACTIVE)->where('category', $category)->count();
            $categories[] = [
                'name' => $category->value,
                'count' => $count
            ];
        }

        $auctions = Auction::where('status', AuctionStatus::ACTIVE)
                    //->where('creator_id', '!=', Auth::id()) COMMENTED FOR TESTING
                    ->where('category', $request->category)
                    ->with('creator')
                    ->get();
       
        return view('home', [
            'auctions' => $auctions,
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function myAuctions(){

        $userId = Auth::id();

        $auctions = Auction::where('creator_id', $userId)
                    ->with('creator')
                    ->with('bids')
                    ->get();         

        return view("auctions.index", ['auctions' => $auctions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auctions.create', ['categories' => AuctionCategory::cases()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'end_time' => 'required|date',
            'starting_price' => 'required|numeric',
            'buyout_price' => 'nullable|numeric',
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => [Rule::enum(AuctionCategory::class)]
        ]);
        if(Carbon::parse($request->end_time) <= Carbon::now()){
            return redirect()->back()->with('error', 'End time cannot be in the past');
        }

        $auction = $request->all();
        $auction['creator_id'] = Auth::id();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('public/photos');
            $auction['photo'] = basename($path);
        }

        Auction::create($auction);
        
        return redirect()->route('home')->with('success', 'Auction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auction $auction)
    {
        $is_creator = $auction->creator() == Auth::user();
        $highest_bid = $auction->highestBid();
        $is_bid_leader = $highest_bid && $highest_bid->user() == Auth::user();

        $is_active = $auction->status === AuctionStatus::ACTIVE;
        $is_cancelled = $auction->status === AuctionStatus::CANCELLED;

        if($is_active && Carbon::parse($auction->end_time) <= Carbon::now()){
            $is_active = false;

            $auction->status = AuctionStatus::FINISHED;
            $auction->save();
        }

        return view('auctions.show')
            ->with('auction', $auction)
            ->with('is_creator', $is_creator)
            ->with('highest_bid', $highest_bid)
            ->with('is_bid_leader', $is_bid_leader)
            ->with('is_active', $is_active)
            ->with('is_cancelled', $is_cancelled);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auction $auction)
    {
        return view('auctions.edit', ['auction' => $auction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auction $auction)
    {
        $request->validate([
            'status' => [Rule::enum(AuctionStatus::class)]
        ]);

        $auction->status = $request->status;
        $auction->save();

        return redirect()->route('auctions.show')->with('success', 'Auction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auction $auction)
    {
        $auction->delete();

        return redirect()->route('home')->with('success', 'Auction deleted successfully.');
    }
}
