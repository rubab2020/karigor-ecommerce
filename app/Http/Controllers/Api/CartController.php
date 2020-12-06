<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends ApiController
{

    public function __construct()
    {
        $this->middleware('jwt');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = auth('api')->user();
        $userId = $user->id;
        $cart = Cart::where('user_id', $userId)->where('is_active', true)->with('items.product')->first();
        if ($cart) {
            $cart->items = $cart->items->map(function ($item, $key) {
                $item->product->image_bg = Product::getPhotoUrl($item->product->image_bg);
                return $item;
            });
        } else {
            $cart = $this->store($request); //if no cart exists, create one and return
            return $cart;
        }
        return $cart;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * this method will return an active user cart if user has no cart
     */
    public function store(Request $request)
    {
        //
        $user = auth('api')->user();
        $userId = $user->id;
        $cart = Cart::firstOrCreate(['user_id' => $userId, 'is_active' => true]);
        $cart = $cart->fresh();  // to retrieve the whole model after creation 
        return $cart;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
