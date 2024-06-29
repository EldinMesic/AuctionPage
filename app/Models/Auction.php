<?php

namespace App\Models;

use App\Enums\AuctionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => AuctionStatus::class,
    ];

    protected $fillable = [
        'creator_id',
        'end_time',
        'starting_price',
        'buyout_price',
        'item_name',
        'item_description',
        'category',
        'photo',
        'status',
    ];

    public function bids(){
        return $this->hasMany(Bid::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, 'bids')->withPivot('amount');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function highestBid(){
        return $this->bids()->orderByDesc('amount')->first();
    }

}
