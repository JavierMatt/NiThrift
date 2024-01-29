<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Input;

// use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
       return view('loginPage');
    }

    public function login(Request $request){
        Session::flash('email',$request->email);
    
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            $userid = Auth::user()->id;
            return redirect('/')->with('success', 'Hi! '. Auth::user()->firstName . " " . Auth::user()->lastName)->with('userid', compact('userid'));
        } else {
            return redirect('login')->withErrors('incorrect email or password');
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/')->with('success','Log Out success');
    }

    public function toRegister(){
        return view('registerPage');
    }

    public function register(Request $request){
        Session::flash('fname',$request->fname);
        Session::flash('lname',$request->lname);
        Session::flash('phone',$request->phone);
        Session::flash('email',$request->email);
        Session::flash('province',$request->province);
        Session::flash('city',$request->city);
        Session::flash('postcode',$request->postcode);

        $request->validate([
            'fname' => 'required',
            'lname'=> 'required',
            'phone'=> 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'province' => 'required'
        ], [
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',
            'email.unique' => 'email already used'
        ]);

        $newData = [
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'province' => $request->province,
            'city' => $request->city,
            'postcalCode' => $request->postcode
        ];

        User::create($newData);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            $userid = Auth::user()->id;
            return redirect('/')->with('success', 'Hi! '. Auth::user()->firstName . " " . Auth::user()->lastName)->with('userid', compact('userid'));
            // return view('landingPage', ['user' => $userHasLogin])->with('success', 'Hi! '. Auth::user()->firstName . ' ' . Auth::user()->lastName);
        } else {
            return redirect('login')->withErrors('incorrect email or password');
        }
    }

    // Function untuk setting detail profile dari user
    public function profileSettings($id){
        $dataUpdate = User::where('id', $id)->get();
        return view('profileSettings', ['user' => $dataUpdate]);        
    }    

    // Untuk POST method ketika update data dari detail User
    public function updateProfileSettings(Request $request, $id){
        $data = User::findorfail($id);
        
        // request file foto dari [profileSettings.blade.php] di validate untuk extensionnya
        $photo = $request->file('photo');
        
        // Cek condition apakah data foto di db == NULL
        if($request->hasFile('photo')){
            $request->validate([ 'photo' =>'required|mimes:png,jpg,jpeg' ]);
            $path = 'photo';

            if ($data->image) {
                // jika TRUE (file exists) -> maka penamaannya akan menimpa nama file lama, mencegah duplicate data.
                $photoName = ($data->image);
            } else {
                // Jika FALSE (file doesn't exists) -> maka penamaan baru : [id-firstName].jpg/jpeg/png 
                $photoExtension = $photo->extension();
                $photoName = $path . "/" . $id . "-" . $data->firstName . "." . $photoExtension;
            }
            
            $photo->move(public_path($path), $photoName);
            $data->image = $photoName;
            $data->save();
        }

        // cek tiap field apakah menerima input dari user atau tidak, if True -> update to db
        if($request->has('phone')){
            $data->phone = $request->input('phone');
        }
        if($request->has('province')){
            $data->province = $request->input('province');
        }
        if($request->has('city')){
            $data->city = $request->input('city');
        }
        if($request->has('postcalCode')){
            $data->postcalCode = $request->input('postcalCode');
        }
        $data->save();
        return redirect('/')->with('success', 'Data berhasil diperbarui');
        
    }

    public function destroy($id){
        User::where('id', $id)->delete();
    }

    public function destroyImage($id){
        $data = User::where('id', $id)->first();
        File::delete(public_path('photo'). '/' . $data->image);
        $data->update(['image' => null]); # --> delete data image dari db (null)

        return redirect()->back();
    }
    
}
