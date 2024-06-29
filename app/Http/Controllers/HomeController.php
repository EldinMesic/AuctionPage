<?php

namespace App\Http\Controllers;
use App\Enums\AuctionCategory;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Enums\AuctionStatus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = [];
        foreach (AuctionCategory::cases() as $category) {
            $count = Auction::where('status', AuctionStatus::ACTIVE)->where('category', $category)->count();
            $categories[] = [
                'name' => $category->value,
                'count' => $count
            ];
        }
        return view('home', compact('categories'));
    }
}
