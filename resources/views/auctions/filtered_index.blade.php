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
    #sortBy:hover{
        background-color: #f0f0f0; 
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    #order:hover{
        background-color: #f0f0f0; 
        transition: background-color 0.3s ease;
    }

</style>

<div class="d-flex justify-content-center">
    <h1>Category: {{ $category }}</h1>
</div>

<div class="row justify-content-center">
    <div class="col-md-4 justify-content-start">
        <div class="form-group">
            <label for="sortBy">Sort By:</label>
            <select id="sortBy" class="form-control">
                @foreach(['created_at' => 'Created At',
                        'starting_price' => 'Starting Price',
                        'buyout_price' => 'Buyout Price',
                        'end_time' => 'End Time',
                        'item_name' => 'Item Name',
                        'item_description' => 'Item Description'] as $key => $value)
                    <option value="{{ $key }}" @if(request()->sortBy === $key) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4 d-flex justify-content-end">
        <div class="form-group ml-auto">
            <label for="order">Order:</label>
            @if(request()->order === 'desc')
            <button class="form-control" name="order" id="order" value="asc" selected onclick="sortAuctions()">Descending</button>
            @else
            <button class="form-control" name="order" id="order" value="desc" selected onclick="sortAuctions()">Ascending</button>
            @endif 
        </div>
    </div>
</div>

@foreach ($auctions as $auction)
<div class="row mt-2">
    <div class="col-md-12 d-flex justify-content-center">
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
                                        @if ($auction->bids()->count() === 0)
                                        <p class="card-text fs-2">${{ number_format($auction->starting_price, 2) }}</p>
                                        @else
                                        <p class="card-text fs-2">${{ number_format($auction->highestBid()->amount, 2) }}</p> 
                                        @endif             
                                </div>
                            </div>
                        <button>
            </div>
        
    </div>
</div>

<script>
    function sortAuctions() {
        var category = @json($category);
        var sortBy = document.getElementById('sortBy').value;
        var order = document.getElementById('order').value;

        var url = new URL('{{ route('home.auctions') }}');
        url.searchParams.append('category', category);
        url.searchParams.append('sortBy', sortBy);
        url.searchParams.append('order', order);

        window.location.href = url.toString();
    }

    document.getElementById('sortBy').addEventListener('change', sortAuctions);
</script>
@endforeach