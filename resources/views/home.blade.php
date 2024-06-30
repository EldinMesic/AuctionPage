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

                <div class="container mb-5">
                    @foreach(array_chunk($categories, 3) as $chunk)
                        <div class="row m-2">
                            @foreach($chunk as $singleCategory)
                                <div class="col-md-4">
                                    <div class="grid-item" onclick="submitForm(this)">
                                        <button type="submit" value="{{ $singleCategory['name'] }}">
                                            {{ $singleCategory['name']}} ({{ $singleCategory['count']}})
                                        </button>
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

<script>
    function submitForm(element) {

        var category = element.querySelector('button').value;
        var sortBy = 'created_at';
        var order = 'desc'

        var url = new URL('{{ route('home.auctions') }}');
        url.searchParams.append('category', category);
        url.searchParams.append('sortBy', sortBy);
        url.searchParams.append('order', order);

        window.location.href = url.toString();
    }
</script>

@endsection
