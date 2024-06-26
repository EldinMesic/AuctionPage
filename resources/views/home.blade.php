@extends('layouts.app')

@section('content')
<style>
        .grid-item {
            border: 1px solid #ccc;
            text-align: center;
            padding: 20px;
            height: 100%;
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            transition: background-color 0.3s ease;
        }

        .grid-item:hover {
            background-color: #f0f0f0; 
            cursor: pointer;
        }
    </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          
                <h1 class="mb-4">Browse by category!</h1>

                <div class="container">
                    <div class="row m-2">
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Art and Collectibles</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Jewelry and Watches</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Electronics</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Home and Garden</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Fashion</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Toys and Hobbies</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Sports and Outdoors</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Books and Media</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Automotive</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Business and Industrial</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Coins and Currency</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Health and Beauty</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row m-2">
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Tickets and Experiences</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Crafts and DIY</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="grid-item">
                                <h3>Miscellaneous</h3>
                            </div>
                        </div>
                    </div>
                </div>


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
