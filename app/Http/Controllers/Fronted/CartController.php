<?php

namespace App\Http\Controllers\Fronted;


use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
  
        $product = Product::findOrFail($id);
        $exists = Cart::where('user_id',Auth::id())->where('product_id',$id)->first();
        $userid =  Auth::id();

        if (Auth::check()) {
            if (!$exists) {
                if ($product->discount_price == NULL) {
           
                    Cart::insert([
                        'name' => $request->product_name,
                        'qty' => $request->quantity,
                        'price' => $product->selling_price,
                        'weight' => 1,
                         
                            'image' => $product->product_thambnail,
                            'color' => $request->color,
                            'size' => $request->size ,
                            'user_id' => $userid,
                            'product_id'=>$id
                    ]);
        
           return response()->json(['success' => 'Successfully Added on Your Cart' ]);
        
                }else{
        
                    Cart::insert([
        
                        'name' => $request->product_name,
                        'qty' => $request->quantity,
                        'price' => $product->discount_price,
                        'weight' => 1,
                        'image' => $product->product_thambnail,
                            'color' => $request->color,
                            'size' => $request->size , 
                            'user_id' => $userid,
                            'product_id'=>$id
                    ]);
        
           return response()->json(['success' => 'Successfully Added on Your Cart' ]);
        
                }


            }else{
                return response()->json(['error' => 'This Product Has Already on Your Cart' ]);   
            }
            } else{
            return response()->json(['error' => 'At First Login Your Account' ]);

        }
        

    }// End Method


//      public function AddToCartDetails(Request $request, $id){

//         $product = Product::findOrFail($id);
//         $userid =  Auth::id();
//         if ($product->discount_price == NULL) {

//             Cart::insert([
//                 'name' => $request->product_name,
//                 'qty' => $request->quantity,
//                 'price' => $product->selling_price,
//                 'weight' => 1,
                 
//                     'image' => $product->product_thambnail,
//                     'color' => $request->color,
//                     'size' => $request->size ,
//                     'user_id' => $userid,
//                     'product_id'=>$id
                
//             ]);

//    return response()->json(['success' => 'Successfully Added on Your Cart' ]);

//         }else{

//             Cart::insert([

//                 'name' => $request->product_name,
//                 'qty' => $request->quantity,
//                 'price' => $product->discount_price,
//                 'weight' => 1,
//                 'image' => $product->product_thambnail,
//                     'color' => $request->color,
//                     'size' => $request->size , 
//                     'user_id' => $userid,
//                     'product_id'=>$id
               
//             ]);

//    return response()->json(['success' => 'Successfully Added on Your Cart' ]);

//         }

//     }// End Method


    public function AddMiniCart(){

        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $cartQty = $carts->count();
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
       
       
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal
        )
            

    );
    }// End Method



    public function RemoveMiniCart($rowId){
        Cart::findorfail($rowId)->delete();
        return response()->json(['success' => 'Product Remove From Cart']);

    }// End Method


    public function MyCart(){
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $cartQty = $carts->count();
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
        return view('frontend.mycart.view_mycart',compact('carts','cartQty','cartTotal'));

    }// End Method


    public function GetCartProduct(){
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $cartQty = $carts->count();
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));

    }// End Method


    public function CartRemove($rowId){
        
        Cart::findorfail($rowId)->delete();
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
           
           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round($cartTotal * $coupon->coupon_discount/100), 
                'total_amount' => round($cartTotal - $cartTotal * $coupon->coupon_discount/100 )
            ]); 
        }
        $notification = array(
            'message' => 'Successfully Remove From Cart',
            'alert-type' => 'success'
        );
        return redirect(url('mycart'))->with($notification); 
        

    }// End Method


    public function CartDecrement($rowId){
        $row = Cart::findorfail($rowId);
        $row->update([
            'qty' => $row->qty -1   
        ]);
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
           
           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round($cartTotal * $coupon->coupon_discount/100), 
                'total_amount' => round($cartTotal - $cartTotal * $coupon->coupon_discount/100 )
            ]); 
        }
        return response()->json('Decrement');
    }// End Method


     public function CartIncrement($rowId){
        $row = Cart::findorfail($rowId);
        $row->update([
            'qty' => $row->qty +1   
        ]);
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
           
           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round($cartTotal * $coupon->coupon_discount/100), 
                'total_amount' => round($cartTotal - $cartTotal * $coupon->coupon_discount/100 )
            ]); 
        }
        $notification = array(
            'message' => 'Successfully CartIncrement From Cart',
            'alert-type' => 'success'
        );
        return response()->json('Increment');

    }// End Method
    
    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->first();
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name, 
                'coupon_discount' => $coupon->coupon_discount, 
                'discount_amount' => round( $cartTotal* $coupon->coupon_discount/100), 
                'total_amount' => round( $cartTotal -  $cartTotal * $coupon->coupon_discount/100 )
            ]);

            return response()->json(array(
                'validity' => true,                
                'success' => 'Coupon Applied Successfully'

            ));


        } else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    }// End Method


    public function CouponCalculation(){
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $subtotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $subtotal+=$cartQtyrow * $cartPrice ;
        }
        if (Session::has('coupon')) {
            
            return response()->json(array(
             'subtotal' => $subtotal,
             'coupon_name' => session()->get('coupon')['coupon_name'],
             'coupon_discount' => session()->get('coupon')['coupon_discount'],
             'discount_amount' => session()->get('coupon')['discount_amount'],
             'total_amount' => session()->get('coupon')['total_amount'], 
            ));
        }else{
         
            return response()->json(array(
                'total' =>  $subtotal,
            ));
        } 
    }// End Method

    public function CouponRemove(){

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);

    }// End Method
    
    public function CheckoutCreate(){
        $carts = Cart::where('user_id',Auth::id())->latest()->get();
        $Total=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $Total+=$cartQtyrow * $cartPrice ;
        }   
        if (Auth::check()) {
           
            if ($Total > 0) { 

        $cartQty = Cart::count();
        $cartTotal = $Total;

        $divisions = ShipDivision::orderBy('division_name','ASC')->get();

        return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));

               
            }else{

            $notification = array(
            'message' => 'Shopping At list One Product',
            'alert-type' => 'error'
        );

        // return redirect()->to('/')->with($notification); 
        return redirect(url('/'))->with($notification); 
            }



        }else{

             $notification = array(
            'message' => 'You Need to Login First',
            'alert-type' => 'error'
        );

        return redirect(url('login'))->with($notification); 
        }




    }// End Method
}
