<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\DetailProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function index()
    {
        $bids = Bid::with(['user', 'product'])->get();
        return view('component.detailProduct', ['bids' => $bids]);
    }

    public function placeBid(Request $request, $id)
    {
        // Get product
        $product = DetailProduct::findOrFail($id);

        // Check if the authenticated user is the seller
        if (Auth::id() == $product->users_id) {
            return $this->redirectWithError($id, 'You cannot bid on your own product.');
        }

        // Validate the bid request
        $validator = Validator::make($request->all(), [
            'bid_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->redirectWithErrors($id, $validator->errors())->withInput();
        }

        // Check if there are any existing bids
        $currentBid = $product->bids()->latest('created_at')->first();

        // Compare the bid amount
        if ($currentBid && $request->input('bid_amount') <= $currentBid->bid_amount) {
            return $this->redirectWithError($id, 'Bid amount must be higher than the current bid.')->withInput();
        }

        // Check if the bid amount is higher than or equal to the initial price
        $initialPrice = $product->initial_price;
        if (!$currentBid && $request->input('bid_amount') < $initialPrice) {
            return $this->redirectWithError($id, 'Bid amount must be equal to or higher than the initial price.')->withInput();
        }

        // Create and save the new bid
        $bid = new Bid();
        $bid->user_id = auth()->id();
        $bid->product_id = $id;
        $bid->bid_amount = $request->input('bid_amount');
        $bid->save();

        return $this->redirectWithSuccess($id, 'Bid placed successfully!');
    }

    /**
     * Redirect back to the detailProduct route with an error message.
     */
    private function redirectWithError($id, $errorMessage)
    {
        return redirect()->route('detailProduct', compact('id'))->with('error', $errorMessage);
    }

    /**
     * Redirect back to the detailProduct route with validation errors.
     */
    private function redirectWithErrors($id, $errors)
    {
        return $this->redirectWithError($id, $errors->first());
    }

    /**
     * Redirect back to the detailProduct route with a success message.
     */
    private function redirectWithSuccess($id, $successMessage)
    {
        return redirect()->route('detailProduct', compact('id'))->with('success', $successMessage);
    }
}
