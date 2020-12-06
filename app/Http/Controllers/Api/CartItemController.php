<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Karigor\Helpers\CustomHelper;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class CartItemController extends ApiController
{

    private $cartItemValidatorRules =  [
        'cart_id' => 'required|exists:carts,id',
        'product_id' => 'required|exists:products,id',
        'qty' => 'required|numeric|gt:0'
    ];



    public function __construct()
    {
        $this->middleware('jwt');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $customHelper = new CustomHelper();
        $validator = $customHelper->validateInput(
            $request->only('cart_id', 'product_id', 'qty'),
            $this->cartItemValidatorRules
        );
        if ($validator) return $validator;

        $cartId = $request->cart_id;
        $productId = $request->product_id;
        $qty = $request->qty;
        $product = Product::find($productId);
        $vendor = Product::getVendor($productId);
        $cartItem = CartItem::updateOrCreate(['cart_id' => $cartId, 'product_id' => $productId], [
            'cart_id' => $cartId,
            'product_id' => $productId,
            'qty' => $qty,
            'vendor_id' => $vendor->id,
            'base_price' => $product->price,
            'final_price' => ($product->price - ($product->discount_percent / 100) * $product->price) * $qty,
            'discount_amount' => ($product->discount_percent / 100) * $product->price * $qty,
            'discount_percent' => $product->discount_percent

        ]);

        $this->updateCartWithCartItem($cartId); //update cart

        return $cartItem->fresh();
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
        $customHelper = new CustomHelper();
        $validator = $customHelper->validateInput(
            $request->only('qty'),
            ['qty' => 'required|numeric|gt:0']
        );
        if ($validator) return $validator;

        $cartItem = CartItem::find($id);
        $productId = $cartItem->product_id;
        $product = Product::find($productId);
        if (!$cartItem)
            return $this->respondNotFound('cart item not found');
        $qty = $request->qty;
        $cartItem->qty = $qty;
        $cartItem->final_price = ($product->price - ($product->discount_percent / 100) * $product->price) * $qty;
        $cartItem->discount_amount =  ($product->discount_percent / 100) * $product->price * $qty;

        try{
            $cartItem->save();
        }catch(Exception $e){
            return $this->respondInternalError($e->getMessage());
        }

        $this->updateCartWithCartItem($cartItem->cart_id);
        return $cartItem;
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
        $cartItem = CartItem::find($id);
        if(!$cartItem)
           return $this->respondNotFound('cart item not found');
        $result = $cartItem->delete();
        $this->updateCartWithCartItem($cartItem->cart_id);
        return $result;
    }

    //call this function to update the cart when cart items are updated
    public function updateCartWithCartItem($cartId)
    {

        $cart = Cart::with('items')->where('id', $cartId)->first();
        $itemsCount = 0;
        $itemsQty = 0;
        $substotal = 0;
        $substotalWithDiscount = 0;
        $grandTotal = 0;
        $itemsWeight = 0;

        foreach ($cart->items as $item) {
            $itemsCount++;
            $itemsQty = $itemsQty + $item->qty;
            $substotal = $substotal + $item->base_price * $item->qty;
            $substotalWithDiscount = $substotalWithDiscount
                + ($item->base_price - ($item->discount_percent / 100)
                    * $item->base_price) * $item->qty;
            $grandTotal = $grandTotal + $item->final_price;
            $itemsWeight = $itemsWeight + $item->weight;
        }

        $cart->subtotal = $substotal;
        $cart->subtotal_with_discount = $substotalWithDiscount;
        $cart->grand_total = $grandTotal; //need to check if coupon code exists
        $cart->items_weight = $itemsWeight;
        $cart->items_count = $itemsCount;
        $cart->items_qty = $itemsQty;
        $cart->save();
        return $cart;
    }
}
