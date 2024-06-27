<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/home', [AuctionController::class, 'filteredIndex'])->name('home.auctions');

    Route::post('/auctions/bid', [BidController::class, 'store'])->name('bid.store');

    Route::get('/myAuctions', [AuctionController::class, 'myAuctions'])->name('myAuctions');
    
    Route::resource('auctions', AuctionController::class);
    /* RESOURCE HANDLES ALL OF THESE ROUTES
    GET	        /auctions	                index	    auctions.index
    GET	        /auctions/create	        create	    auctions.create
    POST	    /auctions	                store	    auctions.store
    GET	        /auctions/{auction}	        show	    auctions.show
    GET	        /auctions/{auction}/edit	edit	    auctions.edit
    PUT/PATCH   /auctions/{auction}	        update	    auctions.update
    DELETE	    /auctions/{auction}	        destroy	    auctions.destroy */

    
    
});


