@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Auction') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auctions.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="item_name" class="form-label">{{ __('Item Name') }}</label>
                            <input id="item_name" type="text" class="form-control @error('item_name') is-invalid @enderror" name="item_name" value="{{ old('item_name') }}" required autofocus>
                            @error('item_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="item_description" class="form-label">{{ __('Item Description') }}</label>
                            <textarea id="item_description" class="form-control @error('item_description') is-invalid @enderror" name="item_description" required>{{ old('item_description') }}</textarea>
                            @error('item_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="form-label">{{ __('End Time') }}</label>
                            <input id="end_time" type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required>
                            @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="starting_price" class="form-label">{{ __('Starting Price') }}</label>
                            <input id="starting_price" type="number" step="0.01" class="form-control @error('starting_price') is-invalid @enderror" name="starting_price" value="{{ old('starting_price') }}" required>
                            @error('starting_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="buyout_price" class="form-label">{{ __('Buyout Price') }}</label>
                            <input id="buyout_price" type="number" step="0.01" class="form-control @error('buyout_price') is-invalid @enderror" name="buyout_price" value="{{ old('buyout_price') }}">
                            @error('buyout_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('Category') }}</label>
                            <select id="category" class="form-select @error('category') is-invalid @enderror" name="category" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">{{ __('Upload Photo') }}</label>
                            <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="photo/*">
                            @error('photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Create Auction') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection