<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Karigor\Helpers\EncodeHelper;
use App\Karigor\Transformers\ProductsTransformer;
use App\Karigor\Transformers\ProductDetailsTransformer;
use App\Models\Wishlist;
use Exception;
use Illuminate\Support\Facades\Validator;

class WishlistController extends ApiController
{

    public function __construct(EncodeHelper $encodeHelper)
    {
        $this->middleware('jwt');
    }

    public function store(Request $request)
    {

        $error = $this->validateInput($request->only('product_id'), ['product_id' => 'required']);
        if ($error) return $error;

        $user = auth('api')->user();
        $userId = $user->id;
        $productId = $request->product_id;
        $product = Product::find($productId); //check if product with exists with this product id
        if (!$product)
            return response()->json(['message' => 'This product is not available'], 400);
        try {
            $item = new Wishlist();
            $item->user_id = $userId;
            $item->product_id = $productId;
            $item->save();
            return $this->respondCreatingResource('Successfully saved wishlist item');
        } catch (Exception $e) {
            return $this->respondWithError('Failed to save wishlist item');
        }
    }

    public function remove(Request $request)
    {
        try {
            Wishlist::where('id', $request->id)->delete();
            return $this->respondWithSuccess('Wishlist item deleted successfully');
        } catch (Exception $e) {
            return $this->respondWithError('Failed to remove wishlist item');
        }
    }

    public function getUserWishlist(Request $request)
    {
        $userId = auth('api')->user()->id;
        $wishlistItems = Wishlist::where('user_id',$userId)->with('product')->get();
        return $wishlistItems;
        
    }

    public function validateInput($data, $rules = [])
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        return null;
    }
}
