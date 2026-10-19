<?php

namespace App\services;
use App\Models\Product;
use App\Models\User;
//use App\services\cartService;
use Illuminate\Support\Facades\Auth;


class cartService
{
    public function add($id, $quantity = 1)
    {
        $prod_exict = Product::findOrFail($id);
        $cart=Auth::user()->cart();
        $prod = $cart->where('product_id', $id)->first();
        if($prod){
            $quant_current = $prod->pivot->quantity;
            $cart->updateExistingPivot($id, ['quantity'=>$quant_current+ $quantity]);
            $result =  ['success' => true, 'cartCount' => cartService::count()['count'],
                'message' => '', 'count' => $quant_current+ $quantity, 'cartSum' => CartService::count()['sum']];
            return $result;
        }
        else {
            $cart->attach($id, ['quantity' => $quantity]);
            return ['status' => true, 'quantity' => $quantity];
        }
//        Auth::user()->cart()->attach($id, ['quantity' => $quantity]);
//        return true;
    }

    public function minus($id)
    {
        $cart=Auth::user()->cart();
        $prod = $cart->where('product_id', $id)->first();
        $quant_current = 0;
        if($prod){
            $quant_current = $prod->pivot->quantity;
            if($quant_current > 1 ) {
                $cart->updateExistingPivot($id, ['quantity' => $quant_current - 1 ]);
            }
            else {
                $cart->detach($id);
            }
            $result = ['status' => true, 'quantity' => $quant_current - 1, 'cartCount' => cartService::count()['count'], ];
            return $result;
        }
        Auth::user()->cart()->attach($id, ['quantity' => $quant_current - 1]);
        return back();
    }
    public function delete($id)
    {
        $cart=Auth::user()->cart();
        $prod = $cart->where('product_id', $id)->first();
        if($prod){
                $cart->detach($id);
        }
        return back();
    }
    public function clear()
    {
        $cart = Auth::user()->cart();
        $cart->detach($cart->get());
        $result = ['status' => true];
        return $result;
    }
    static function count()
    {
        $cart = Auth::user()->cart();
        $sum = $count = 0 ;
        foreach ($cart->get() as $item) {
           $sum +=  $item->price * $item->pivot->quantity;
           $count += $item->pivot->quantity;
        }
        return ['count' => $count, 'sum' => $sum];
    }


}
