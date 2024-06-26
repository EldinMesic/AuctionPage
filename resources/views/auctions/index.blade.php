@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">All Auctions</h1>

    <div class="row">
        <div class="col-md-12">
            @foreach ($auctions as $auction)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $auction->item_name }}</h5>
                        <p class="card-text"><strong>Starting Price:</strong> ${{ number_format($auction->starting_price, 2) }}</p>
                        <p class="card-text"><strong>Buyout Price:</strong> ${{ number_format($auction->buyout_price, 2) }}</p>
                        <p class="card-text"><strong>End Time:</strong> {{ \Carbon\Carbon::parse($auction->end_time)->format('d-m-Y H:i') }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ $auction->status }}</p>
                        <p class="card-text">{{ $auction->item_description }}</p>
                        @if ($auction->photo)
                            <img src="{{ asset('storage/photos/' . $auction->photo) }}" alt="{{ $auction->item_name }}" class="img-fluid">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection