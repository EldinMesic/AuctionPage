@extends('layouts.app')

@section('content')
<style>
    .grid-item {
        border: 1px solid #ccc;
        text-align: center;
        padding: 20px;
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        transition: background-color 0.3s ease;
        height: 100%;
    }

    .grid-item:hover {
        background-color: #f0f0f0; 
        cursor: pointer;
    }

    .grid-item form {
        display: flex;
        width: 100%;
        height: 100%;
    }

    .grid-item button {
        background: none;
        border: none;
        outline: none;
        text-align: center;
        padding: 0;
    }

    .grid-item button:focus {
        outline: none;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          
                <h1 class="mb-4">Browse by category!</h1>

                <div class="container">
                    @php
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
                            'Miscellaneous'
                        ];
                    @endphp

                    @foreach(array_chunk($categories, 3) as $chunk)
                        <div class="row m-2">
                            @foreach($chunk as $category)
                                <div class="col-md-4">
                                    <div class="grid-item">
                                        <form class="d-flex justify-content-center" method="POST" action="{{ route('home.auctions') }}">
                                            @csrf
                                            <button type="submit" name="category" value="{{ $category }}">
                                                {{ $category }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                @if (!empty($auctions) && $auctions->count())
                    @include('auctions.filtered_index')    
                @endif

                <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
           
        </div>
    </div>
</div>

@endsection
