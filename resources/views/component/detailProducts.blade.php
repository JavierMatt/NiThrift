@extends('landingPage')

@section('content')

    <div class="container">
        @foreach ($product as $item)
            <div class="photoProduct box">
                <img class="dimage" src="{{ asset($item->image) }}">
            </div>
            <div class="paymentDetail box">
                <h1 style="text-align: center; font-weight: 900;">{{ $item->name }}</h1>
                <div class="itemDetail">
                    <p>Size: {{ $item->size }}</p>
                    <p>Condition: {{ $item->condition }}</p>
                    <p>Item Location: {{ $item->location }}</p>
                </div>
                <div class="itemDetail">
                    <h4 style="margin-bottom: 2vh;">Payment Summary</h4>
                    <div class="info">
                        <p>Product Price</p>
                        <p>Rp. {{ $item->price }}</p>
                    </div>
                  
                    @php
                        $highestBid = $item->bids->sortByDesc('bid_amount')->first();
                        $highestBidderName = optional($highestBid)->user->firstName;
                    @endphp
                    @if ($highestBid)
                        <p>Highest Bidder: {{ $highestBidderName }}</p>
                        <p>Highest Bid Amount: Rp. {{ $highestBid->bid_amount }}</p>
                    @else
                        <p>No bids yet</p>
                    @endif
                </div>
                <h4 style="margin: 2vh 0vh;">Seller Number</h4>
                <div class="detailSeller">
                    <div class="phoneNum">
                        <p>{{ $item->sellerName }}</p>
                        <p>{{ $item->sellerNumber }}</p>
                    </div>
                    <div class="buyMe">
                        <form method="post" action="{{ route('placeBid', ['id' => $item->id]) }}">
                            @csrf
                            <label for="bid_amount">Bid Amount:</label>
                            <input type="number" name="bid_amount" id="bid_amount" required>
                            <button type="submit">Place Bid</button>
                        </form>
                    </div>
                </div>
                <!-- Display success message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Display error messages -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    <div class="description">
        <h1 style="font-weight: 950; margin-bottom: 2vh;">Description</h1>
        <p>
            {{ $item->description }}
        </p>
    </div>
    <script src="{{ asset('js/detailProduct.js') }}"></script>
@endsection
