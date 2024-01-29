@extends('landingPage')

@section('updateProduct')
    
    <div class="container">
        <div class="paymentDetail box">
            <h1>Upload Your Item</h1>
            <h5>Item -> Detail -> Finish</h5>
            <hr>
            <div class="upload-product">
                <div class="photoProduct">
                    @foreach ($user as $u)
                        
                    <form action="{{ route('uploadRequest', $u->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="photoProduct" id="photoProduct">
                        <div class="shadow" id="imgPreview"></div> {{-- container untuk upload image si product --}}
                        <label for="photoProduct"></label>
                    </div>
                    <div class="detailProduct">
                        <div class="userLocation-container px-5 hide">
                            <div class="detail-item">
                                <h4>Name Item</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemName" placeholder="Enter Name Item">
                                <h4>Size</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemSize" placeholder="Enter Size Item"  value="">
                                <h4>Price</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemPrice" placeholder="Enter Price Item"  value="">
                                <h4>Condition</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemCondition" placeholder="Enter Condition Item"  value="">
                                <div class="grid">
                                    <p class="btn btn-dark shadow d-grid">Next--></p>
                                </div>
                            </div>
                            <div class="detail-item-2" style="display: none">
                                <h4>Item Location</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemLocation" placeholder="Enter Your Item Location" value="{{ $u->province . ", " . $u->postcalCode }}" disabled>
                                <h4>Owner Name</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemOwner" placeholder="Enter Owner Name"  value="{{ $u->firstName . " " . $u->lastName }}" disabled>
                                <h4>Phone Number</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemPhone" placeholder="Enter Owner Phone Number"  value="{{ $u->phone }}" disabled>
                                <h4>Description</h4>
                                <input type="text" class="form-control ps-3 my-3 shadow" name="itemCategory" placeholder="Enter Item Category (Men / Women)"  value="">
                                <div class="d-grid">
                                    <button type="submit" class=" btn btn-success shadow">Upload Product</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/uploadProduct.js') }}"></script>
@endsection