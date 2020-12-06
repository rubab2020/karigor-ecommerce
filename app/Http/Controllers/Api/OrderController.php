<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDeliveryAddress;
use Exception;

class OrderController extends Controller
{
    //



    private $deliveryCharge = 60;


    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function getDeliveryCharge(Request $request)
    {
        return $this->deliveryCharge;
    }

    public function placeOrder(Request $request)
    {

        $user = auth('api')->user();
        $userId = $user->id;
        $cart = Cart::where('user_id', $userId)->where('is_active', true)->first();
        $newOrder = new Order();
        $newOrder->user_id = $userId;
        $newOrder->cart_id = $cart->id;
        $newOrder->grand_total = $cart->grand_total + $this->deliveryCharge;
        $newOrder->subtotal = $cart->subtotal;
        $newOrder->subtotal_with_discount = $cart->subtotal_with_discount;
        $newOrder->customer_note = $request->order_note;
        $newOrder->delivery_charge = $this->deliveryCharge;

        try {
            $orderResult = $newOrder->save();
        } catch (Exception $e) {
            throw $e;
        }

        if ($orderResult) {
            $newOrderDeliveryAddress = new OrderDeliveryAddress();
            $newOrderDeliveryAddress->order_id = $newOrder->id;
            $newOrderDeliveryAddress->name = $request->name;
            $newOrderDeliveryAddress->address = $request->address;
            $newOrderDeliveryAddress->city = $request->city;
            $newOrderDeliveryAddress->district = $request->district;
            $newOrderDeliveryAddress->appartment = $request->appartment;
            $newOrderDeliveryAddress->phone = $request->phone;
            $newOrderDeliveryAddress->email = $request->email;
            $newOrderDeliveryAddress->zipcode = $request->zip;
            try {
                $newOrderDeliveryAddressResult = $newOrderDeliveryAddress->save();
            } catch (Exception $e) {
                throw $e;
            }

            try{
                $cart = Cart::where('user_id', $userId)->where('is_active', true)->first();
                $cart->is_active = 0;
                $cart->save();
            }catch(Exception $e){
                
            }

            return response()->json(['message' => 'Order placed successfully']);
        }
        
    }
}
