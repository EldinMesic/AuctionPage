<div class="row">
    <div class="col-md-12 d-flex justify-content-center">
        @foreach ($auctions as $auction)
            <div class="card mb-3 w-75">
                <div class="card-body">
                    <h1 class="card-title fw-bold">{{ $auction->item_name }}</h1>
                        <div class="d-flex flex-row">

                            <div class="d-flex flex-column me-2">
                                <p class="card-text text-secondary fw-bold">AUCTION ID</p>
                                <p class="fw-bold">#{{ $auction->id }} </p>
                            </div>

                            <div class="d-flex flex-column me-2">
                                <p class="card-text text-secondary fw-bold">CREATED BY</p>
                                <p class="fw-bold"> {{ $auction->creator->name }} </p>
                            </div>

                            <div class="d-flex flex-column me-2">
                                <p class="card-text text-secondary fw-bold">ENDING</p>
                                <p class="fw-bold"> {{ \Carbon\Carbon::parse($auction->end_time)->format('d-m-Y H:i') }} </p>
                            </div>

                        </div>

                        <div class="d-flex flex-row">
                            <div>
                                @if ($auction->photo)
                                <img src="{{ asset('storage/photos/' . $auction->photo) }}" alt="{{ $auction->item_name }}" class="img-fluid photo-size">
                                @endif
                            </div>

                            <div class="ms-5">
                                <p class="card-text fs-2">Starting Price: ${{ number_format($auction->starting_price, 2) }}</p>
                                <p class="card-text fs-2">Buyout Price: ${{ number_format($auction->buyout_price, 2) }}</p>
                                
                                @if (Auth::id() != $auction->creator_id)
                                <div class="d-flex flex-row">
                                    <div class="input-group mb-3 w-50">
                                        <span class="input-group-text bg-body-secondary">€</span>
                                        <input type="text" class="form-control w-25">
                                    </div>
                                    <button type="submit" class="btn btn-secondary ms-2 h-25">Bid</button>
                                </div>
                                @endif
                                
                            </div>
                       
                        </div>
                    
                    <div class="d-flex flex-column mt-2">
                                <p class="card-text fw-bold">AUCTION DESCRIPTION</p>
                                <p> {{ $auction->item_description }} </p>
                    </div>

                    @if (Auth::id() == $auction->creator_id)
                    <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>