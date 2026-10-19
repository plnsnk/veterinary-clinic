<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\services\cartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function add($id)
   {
       $cs = new cartService();
     $result=  $cs->add($id);
   //    $result = ['success' => true,'cartCount' => '99', 'message' => 'все сломалось'];
    //   return response()->json($result);
      return back();
   }
   public function plus(Request $request, $id)
        {

            $user = Auth::user();
            $cartItem = $user->cart()->where('product_id', $id)->first();
            if ($cartItem) {
                $user->cart()->updateExistingPivot($id, [
                    'quantity' => $cartItem->pivot->quantity + 1
                ]);
            }

            return back();
        }
        public function minus($id)
        {
            $cs = new CartService();
            $cs->minus($id);
            return back();
        }
        public function delete($id)
        {
            $cs = new CartService();
            $cs->delete($id);
            return back();
        }
        public function clear()
        {
            $cs = new CartService();
            $cs->clear();
            return back();
        }


}