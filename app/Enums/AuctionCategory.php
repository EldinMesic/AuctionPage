<?php

namespace App\Enums;

enum AuctionCategory: string{
    case ART_AND_COLLECTIBLES = 'Art and Collectibles';
    case JEWELRY_AND_WATCHES = 'Jewelry and Watches';
    case ELECTRONICS = 'Electronics';
    case HOME_AND_GARDEN = 'Home and Garden';
    case FASHION = 'Fashion';
    case TOYS_AND_HOBBIES = 'Toys and Hobbies';
    case SPORTS_AND_OUTDOORS = 'Sports and Outdoors';
    case BOOKS_AND_MEDIA = 'Books and Media';
    case AUTOMOTIVE = 'Automotive';
    case BUSINESS_AND_INDUSTRIAL = 'Business and Industrial';
    case COINS_AND_CURRENCY = 'Coins and Currency';
    case HEALTH_AND_BEAUTY = 'Health and Beauty';
    case TICKETS_AND_EXPERIENCES = 'Tickets and Experiences';
    case CRAFTS_AND_DIY = 'Crafts and DIY';
    case MISCELLANEOUS = 'Miscellaneous';

}