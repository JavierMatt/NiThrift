<header class="navbar">
    <img src="{{ asset('/SourceIMG/Logo.png') }}" class="logo limit me-5">
    <ul class="margin-left-4">
        <li class="li-1"><a class="link" href="{{ url('/') }}">Home</a></li> 
        <li class="li-2"><a class="link2" href="#women">Women</a></li>
        <li class="li-3"><a class="link3" href="#men">Men</a></li>
        <li class="li-3"><a class="link3" href="{{ route('uploadProduct') }}">Sell</a></li>
        <li class="bottom_line"></li>
    </ul>
    <div class="rightNav">

        {{-- <a class="cart" href="#selling"><img src="/SourceIMG/cart-shopping-solid.svg" class="logo"></a> --}}
        
        @if (Auth::check()) {{-- untuk cek Login -> True or False sehingga menampilkan informasi ketika sudah login --}}
            <a class=" rounded-pill border border-secondary p-2 shadow ms-n7" href="{{ route('profileSettings', Auth::user()->id) }}" style="display: flex; flex-direction:row">
                {{-- <img class="userProfile" src="{{ asset('photo') . '/' . Auth::user()->image }}"> --}}
                <img class="userProfile" src="{{ asset(Auth::user()->image) }}">
                <figcaption class="my-auto" style="align-items: center;">
                    <b>{{  Auth::user()->firstName }}</b>
                </figcaption>   
            </a>
            <div class="vline"></div> {{-- untuk garis pembatas --}}
            <a href="{{ url('logout') }}">
                <button type="button" class="btn btn-warning rounded-pill px-4 py-2 shadow">Logout</button>
            </a>
        @endif
        @if (!Auth::check())
            <a href="{{ url('login') }}"><button type="button" class="btn btn-success">Login</button></a>
        @endif
    </div>
</header>

{{-- {DetailProducts}
    <header class="navbar">
        <img src="/SourceIMG/Logo.png" class="logo">
        <ul>
            <li><a href="#home"><a href="{{ url('/') }}">Home</a></a></li>
            <li><a href="#women">Women</a></li>
            <li><a href="#men">Men</a></li>
        </ul>
        dibawah ini untuk cek sedang diposisi login/logout
        <div class="rightNav">

            <a class="cart" href="#selling"><img src="/SourceIMG/cart-shopping-solid.svg" class="logo"></a>
            <div class="vline"></div> -> untuk garis pembatas
            dibawah ini untuk cek sedang diposisi login/logout
            @if (Auth::check())
                 @foreach ($userHasLogin as $users)
                    <figcaption class="me-2 my-auto" style="align-items: center;"><a href="{{ url('profileSettings') }}">{{ $users }}</a></figcaption>   
                @endforeach
                <a href="{{ url('logout') }}"><button type="button" class="btn btn-warning">Logout</button></a>
            @endif
            @if (!Auth::check())
                <a href="{{ url('login') }}"><button type="button" class="btn btn-success">Login</button></a>
            @endif
        </div>  
    </header>
--}}
