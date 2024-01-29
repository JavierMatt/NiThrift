<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <!-- Styling font 'Poppins' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
    <title>Thrift Termurah sejagat raya</title>
</head>
<body>
    @include('component/message')
    <header class="navbar">
        <img src="{{ asset('/SourceIMG/Logo.png') }}" class="logo limit">
        <ul>
            <li class="li-1"><a class="link" href="#home">Home</a></li>
            <li class="li-2"><a class="link2" href="#women">Women</a></li>
            <li class="li-3"><a class="link3" href="#men">Men</a></li>
            <li class="bottom_line"></li>
        </ul>
        <div class="rightNav">
            
        

            {{-- <a class="cart" href="#selling"><img src="/SourceIMG/cart-shopping-solid.svg" class="logo"></a> --}}
            
            @if (Auth::check()) {{-- untuk cek Login -> True or False sehingga menampilkan informasi ketika sudah login --}}
                <a href="profileSettings/{{Auth::user()->id}}">
                    {{-- <img class="userProfile" src="{{ asset('photo') . '/' . Auth::user()->image }}"> --}}
                    <img class="userProfile" src="{{ asset(Auth::user()->image) }}">
                </a>
                <figcaption class="mx-3 my-auto" style="align-items: center;">{{  Auth::user()->firstName }}</figcaption>   
                <div class="vline"></div> {{-- untuk garis pembatas --}}
                <a href="{{ url('logout') }}">
                    <button type="button" class="btn btn-warning">Logout</button>
                </a>
            @endif
            @if (!Auth::check())
                <a href="{{ url('login') }}"><button type="button" class="btn btn-success">Login</button></a>
            @endif
        </div>
    </header>
    <div class = "container mt-2 mb-4 ml-3 mr-5">
    <h3>Add Product</h3>

<form method="POST" action="{{ route('storeproduct') }}">
    @csrf
    <div class="mb-3">
        <label for="product-name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="product-name" name="product-name"
            required>
    </div>

    <div class="mb-3">
        <label for="product-description" class="form-label">Product Description</label>
        <textarea class="form-control" id="product-description" name="product-description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="starting-price" class="form-label">Starting Price</label>
        <input type="number" min="0" class="form-control" id="starting-price"
            name="starting-price" required step="1000">
    </div>
    <div class="mb-3">
        <label for="product-image" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="product-image" name="product-image" >
    </div>
    <div class="mb-3">
        <label for="start-time" class="form-label">Start Time</label>
        <input type="datetime-local" class="form-control" id="start-time"
            name="start-time" required>
    </div>
    <div class="mb-3">
        <label for="end-time" class="form-label">End Time</label>
        <input type="datetime-local" class="form-control" id="end-time" name="end-time"
            required>
    </div>

    <button type="submit" class="btn btn-primary">Add Product</button>
</form>
</div>
    <footer class="foot">
        <div class="">
            <img class="logo" src="{{ asset('SourceIMG/Logo.png') }}">
            {{-- <p>Lorem ipsum dolor sit amet consectetur.</p> --}}
        </div>
        <div class="socmed">
            <p>Keep in touch with us!</p>
            <ul>
                <a href="https://www.instagram.com/irhaamzharfan/" target="_blank"><i class="fa-brands fa-instagram fa-xl" style="color: #000000;"></i></a>
                <a href="https://www.instagram.com/irhaamzharfan/" target="_blank"><i class="fa-brands fa-whatsapp fa-xl" style="color: #000000;"></i></a>
                <a href="https://www.instagram.com/irhaamzharfan/" target="_blank"><i class="fa-brands fa-tiktok fa-xl" style="color: #000000;"></i></a>
            </ul>
        </div>
        <div class="owner">
            <ul>
                NiThrift - Created &copy; 2023
            </ul>
        </div>
    </footer>

    <div class="label">
        <h3>Hubungi kami jika ingin barang terbaik dengan harga terbaik</h3>
    </div>

    <script src="{{ asset('js/highlight.js') }}"></script>
    <script src="https://kit.fontawesome.com/779f43f783.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <script src="{{ asset('js/landingPage.js') }}"></script>
    <script src="{{ asset('js/directToCategory.js') }}"></script>
</body>
</html>