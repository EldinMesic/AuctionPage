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
        $auctions = Auction::where('status', 'ACTIVE')
                   ->with('creator')
                   ->get();
        return view('auctions.index', ['auctions' => $auctions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = [
            'Art and Collectibles',
            'Jewelry and Watches',
            'Electronics',
            'Home and Garden',
            'Fashion',
            'Toys and Hobbies',
            'Sports and Outdoors',
            'Books and Media',
            'Automotive',
            'Business and Industrial',
            'Coins and Currency',
            'Health and Beauty',
            'Tickets and Experiences',
            'Crafts and DIY',
            'Miscellaneous',
        ];

        return view('auctions.create',compact('categories'));
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
            'category' => 'required|in:Art and Collectibles,Jewelry and Watches,Electronics,Home and Garden,Fashion,Toys and Hobbies,Sports and Outdoors,Books and Media,Automotive,Business and Industrial,Coins and Currency,Health and Beauty,Tickets and Experiences,Crafts and DIY,Miscellaneous',
        ]);

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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:Art and Collectibles,Jewelry and Watches,Electronics,Home and Garden,Fashion,Toys and Hobbies,Sports and Outdoors,Books and Media,Automotive,Business and Industrial,Coins and Currency,Health and Beauty,Tickets and Experiences,Crafts and DIY,Miscellaneous',

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
