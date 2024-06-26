<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

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

}
