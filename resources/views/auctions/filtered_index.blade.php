<style>
    .photo-size{
        width: auto;
        height: 250px;
        object-fit: cover; 
    }

    .card button {
        background: none;
        border: none;
        outline: none;
        text-align: center;
        padding: 0;
    }

    .card:hover {
        background-color: #f0f0f0; 
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

</style>
<div class="row">
    <div class="col-md-12 d-flex justify-content-center">
        @foreach ($auctions as $auction)
            <div class="card mb-3 w-75">
                        <button onclick="window.location='{{ route('auctions.show', ['auction' => $auction]) }}'">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h1 class="card-title fw-bold">{{ $auction->item_name }}</h1>
                                </div>
                            
                                <div class="d-flex flex-row justify-content-center">
                                    <div>
                                        @if ($auction->photo)
                                        <img src="{{ asset('storage/photos/' . $auction->photo) }}" alt="{{ $auction->item_name }}" class="img-fluid photo-size">
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex flex-row me-2 justify-content-center mt-2">
                                        <p class="card-text text-secondary fw-bold me-2 mb-0">ENDING</p>
                                        <p class="fw-bold mb-0"> {{ \Carbon\Carbon::parse($auction->end_time)->format('d-m-Y H:i') }} </p>
                                </div>

                                <div class="d-flex justify-content-center">
                                        <p class="card-text fs-2">${{ number_format($auction->starting_price, 2) }}</p>              
                                </div>
                            </div>
                        <button>
            </div>
        @endforeach
    </div>
</div>