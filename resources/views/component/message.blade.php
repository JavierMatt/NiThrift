@if ($errors->any())
    {{--untuk kasih interval waktu dia popUp --}}
    <div class="alert alert-danger" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::get('success'))
    <div class="alert alert-success m-3 mx-auto text-center w-50" x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"> 
        {{ Session::get('success') }}
    </div>
@endif