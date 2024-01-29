<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    
    <!-- Styling font 'Poppins' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header class="navbar">
        <img src="/SourceIMG/Logo.png" class="logo">
        <ul>
            <li><a href="#home"><a href="{{ url('/') }}">Home</a></a></li>
            <li><a href="#women">Women</a></li>
            <li><a href="#men">Men</a></li>
        </ul>
        <a href="{{ url('logout') }}"><button type="button" class="btn btn-warning p-2">Logout</button></a>
    </header>
    @foreach ($user as $data)
    <div class="container-profile">
        <div class="page1">
            <form action="{{ route('updateProfile', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' name="photo" id="photo"/>
                            <label for="photo"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('{{ asset($data->image) }}');"></div>
                            <figure class="text-center my-3">
                                <figcaption>{{ $data->firstName }}</figcaption>
                            </figure>
                        </div>
                    </div>

                    <div class="container-sm text-center">
                        <div class="btn btn-danger py-2 m-2">
                            <a href="{{ route('deleteImage', $data->id) }}">Delete</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-2 m-2">save</button>
                    </div>
                </div>
            </form>
            
            <div class="dataUser">
                <div class="partOfData">
                    <b>Email&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;</b>
                    <p>{{ $data->email }}</p>
                </div>
                <div class="partOfData">
                    <b>Phone Number&emsp;:&emsp;</b>
                        <p>{{ $data->phone }}</p>
                    </div>
                    <div class="partOfData">
                        <p><b>Date Of Birth&emsp;&emsp;:&emsp;</b></p>
                        <p></p>
                    </div>
                </div>
            </div>
            
            <div class="page2">
                <h2>Settings</h2>
                @include('component.message')
                <!-- untuk list di bagian Settings (PersonalProfile, User Location, etc) -->
                <div class="list">
                    <ul>
                        <li id="list">Personal Profile</li>
                        <li id="list2">User Location</li>
                        <li id="list3">Change Password & Email</li>
                    </ul>
                </div>
                <hr style="color: whitesmoke;">
                
                <form action="{{ route('updateProfile', $data->id)}}" method="POST">
                {{-- <form action="profileSettings/update/{{ $data->id }}" method="POST"> --}}
                    @csrf
                    <div class="personalProfile-container">
                        <div class="detailProfile px-5">
                            <h4>First Name</h4>
                            <input type="text" class="form-control ps-3 " name="fname" placeholder="Enter Your First Name" value="{{ $data->firstName }}" disabled>
                            <h4>Last Name</h4>
                            <input type="text" class="form-control ps-3 " name="lname" placeholder="Enter Last Name" value="{{ $data->lastName }}" disabled>
                            <h4>Phone Number</h4>
                            <input type="text" class="form-control ps-3 shadow" name="phone" placeholder="Enter Your Phone Number"  value="{{ $data->phone }}">
                            <h4>BirthDay</h4>
                            <input type="date" class="form-control ps-3 shadow" name="" id="">
                            <button type="submit" class="btn btn-success d-grid p-2 m-3">Save Changes</button>                                                                                           
                        </div>
                    </div>
                </form>
                        <!-- Ini container untuk User Location Detail -->
                <form action="{{ route('updateProfile', $data->id)}}" method="POST"> 
                    @csrf
                    <div class="userLocation-container px-5 hide">
                        <div class="detailProfile">
                            <h4>Address</h4>
                            <input type="text" class="form-control ps-3 shadow" name="address" placeholder="Enter Your Address">
                            <h4>Province</h4>
                            <input type="text" class="form-control ps-3 shadow" name="province" placeholder="Enter Your Province"  value="{{ $data->province }}">
                            <h4>City</h4>
                            <input type="text" class="form-control ps-3 shadow" name="city" placeholder="Enter Your City"  value="{{ $data->city }}">
                            <h4>Postal Code</h4>
                            <input type="text" class="form-control ps-3 shadow" name="postcalCode" placeholder="Enter Your Postal Code"  value="{{ $data->postcalCode }}">
                            <button type="submit" class="btn btn-success d-grid p-2 m-3">Save Changes</button>
                        </div>
                    </div>
                </form>

                <form action="{{ route('updateProfile', $data->id)}}" method="POST">   
                    @csrf 
                    <!-- Ini Container untuk Change Password -->
                    <div class="changePass-container px-5 hide">
                        <div class="detailProfile">
                            <h4>Email</h4>
                            <input type="email" class="form-control ps-3" name="email" placeholder="Enter Your Email"  value="{{ $data->email }}" disabled>
                            <h4>Password</h4>
                            <input type="password" class="form-control ps-3" name="password" placeholder="Enter Your Password">
                            <h4>Confirm Password</h4>
                            <input type="password" class="form-control ps-3" name="password" placeholder="Enter Your Confirm Password">
                            <button type="submit" class="btn btn-success d-grid p-2 m-3" onclick="alert('ur data will be posted.')">Save Changes</button>
                            {{-- <button class="save btn2" type="submit" onclick="alert('ur data will be updated.')">Save Changes</button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

    <footer class="foot">
        <div class="">
            <img class="logo" src="{{ asset('SourceIMG/Logo.png') }}">
            {{-- <p>Lorem ipsum dolor sit amet consectetur.</p> --}}
        </div>
        <div class="socmed">
            <p>Keep in touch with us!</p>
            <ul>
                <a href="https://www.instagram.com/irhaamzharfan/"><i class="fa-brands fa-instagram fa-xl" style="color: #000000;"></i></a>
                <a href="https://www.instagram.com/irhaamzharfan/"><i class="fa-brands fa-whatsapp fa-xl" style="color: #000000;"></i></a>
                <a href="https://www.instagram.com/irhaamzharfan/"><i class="fa-brands fa-tiktok fa-xl" style="color: #000000;"></i></a>
            </ul>
        </div>
        <div class="owner">
            <ul>
                NiThrift - Created &copy; 2023
            </ul>
            {{-- <ul>
                <li>Irham Zharfan - 2502007880</li>
                <li>Evelyn Chrisyla Valentina - 2502028336</li>
                <li>Jedith Almando Istian - 2502016922</li>
                <li>Theofilus Jonathan - 2540117533</li>
                <li>Farrel Alexander Tjan - 2502013744</li>
            </ul> --}}
        </div>
    </footer>
    
    <div class="label">
        <h3>Hubungi kami jika ingin barang terbaik dengan harga terbaik</h3>
    </div>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="https://kit.fontawesome.com/779f43f783.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
</body>
</html>