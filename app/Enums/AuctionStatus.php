<?php

namespace App\Enums;

enum AuctionStatus: string{
    case ACTIVE = 'ACTIVE';
    case FINISHED = 'FINISHED';
    case CANCELLED = 'CANCELLED';
}