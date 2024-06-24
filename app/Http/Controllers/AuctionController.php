<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auctions = Auction::where('status', 'RUNNING')->get();
        return view('auctions.index', ['auctions' => $auctions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auctions.create');
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
        ]);

        $auction = $request->all();
        $auction['creator_id'] == Auth::id();

        Auction::create($auction);

        return redirect()->route('home')->with('success', 'Auction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auction $auction)
    {
        return view('auctions.show', ['auction' => $auction]);
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
            'end_time' => 'required|date',
            'starting_price' => 'required|numeric',
            'buyout_price' => 'nullable|numeric',
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
        ]);

        $auction->update($request->all());

        return redirect()->route('home')->with('success', 'Auction updated successfully.');
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
