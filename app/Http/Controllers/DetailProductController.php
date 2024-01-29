<?php

namespace App\Http\Controllers;

use App\Models\DetailProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailProductController extends Controller
{
    public function index()
    {
        $data = DetailProduct::all();
        return view('component.highlightProduct', ['product' => $data]);
    }

    public function detailProduct($id){
        $product = DetailProduct::find($id)->get();
        if($product){
            return view('component.detailProducts', ['product' => $product]);
        }else {
            return redirect('/')->withErrors('not found');
        }
    }


    public function uploadPage(){
        // check if isLogin = TRUE, dapat upload product
        if(Auth::check()){
            $user = User::where('id', Auth::user()->id)->get();
            return view('component.updateProduct', ['user' => $user]);
        }
        else{
            // if isLogin = FALSE, harus login terlebih dahulu
            return view('loginPage');
        }
    }

    public function uploadRequest(Request $request, $id){
        $data = new DetailProduct();
        $seller = User::where('id', $id)->first();
        
        $photo = $request->file('photoProduct');

        if($request->hasFile('photoProduct')){
            $request->validate([ 'photoProduct' =>'required|mimes:png,jpg,jpeg' ]);
            $path = 'photoProduct';

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
            // $data->save();
        }

        // cek tiap field apakah menerima input dari user atau tidak, if True -> update to db
        if($request->has('itemName')){
            $data->name = $request->input('itemName');
        }
        if($request->has('itemSize')){
            $data->size = $request->input('itemSize');
        }
        if($request->has('itemPrice')){
            $data->price = $request->input('itemPrice');
        }
        if($request->has('itemCondition')){
            $data->condition = $request->input('itemCondition');
        }
        if($request->has('itemCategory')){
            $data->category = $request->input('itemCategory');
        }

        $data->users_id = $id;
        $data->location = $seller->province . ", " . $seller->postcalCode;
        $data->sellerName = $seller->firstName . " " . $seller->lastName;
        $data->sellerNumber = $seller->phone;
        dump($data);
        
        $data->save();

        return redirect('/')->with('success', 'Data berhasil diperbarui');
    }
}
