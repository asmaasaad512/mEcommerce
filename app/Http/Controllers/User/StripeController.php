<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCompleteNotification;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){
        
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{

            $carts = Cart::where('user_id',Auth::id())->latest()->get();$cartTotal=0;
            $cartTotal=0;
            foreach( $carts as $cart){
                $cartQtyrow =$cart->qty ;
                $cartPrice =$cart->price;
                $cartTotal+=$cartQtyrow * $cartPrice ;
            }
            $total_amount = $cartTotal;
        }
        \Stripe\Stripe::setApiKey('pk_test_51NaRtfLNqr1IoooMp5aVzE35H9vzCIGmhlZF0fxAiYbdPgIU8sS1mdgzsX4wZV4vKsiyD49Rg0hsJaWHdY2HqOXA00Qqq0fsys');
        
      
 
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
          'amount' => $total_amount*100,
          'currency' => 'usd',
          'description' => 'Easy Mulit Vendor Shop',
          'source' => $token,
          'metadata' => ['order_id' => uniqid()],
        ]);

        //dd($charge);

      
    }

//         $order_id = Order::insertGetId([
//             'user_id' => Auth::id(),
//             'division_id' => $request->division_id,
//             'district_id' => $request->district_id,
//             'state_id' => $request->state_id,
//             'name' => $request->name,
//             'email' => $request->email,
//             'phone' => $request->phone,
//             'adress' => $request->address,
//             'post_code' => $request->post_code,
//             'notes' => $request->notes,

//             'payment_type' => $charge->payment_method,
//             'payment_method' => 'Stripe',
//             'transaction_id' => $charge->balance_transaction,
//             'currency' => $charge->currency,
//             'amount' => $total_amount,
//             'order_number' => $charge->metadata->order_id,

//             'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
//             'order_date' => Carbon::now()->format('d F Y'),
//             'order_month' => Carbon::now()->format('F'),
//             'order_year' => Carbon::now()->format('Y'), 
//             'status' => 'pending',
//             'created_at' => Carbon::now(),  

//         ]);

//         // Start Send Email

//         $invoice = Order::findOrFail($order_id);

//         $data = [

//             'invoice_no' => $invoice->invoice_no,
//             'amount' => $total_amount,
//             'name' => $invoice->name,
//             'email' => $invoice->email,

//         ];

//         Mail::to($request->email)->send(new OrderMail($data));

//         // End Send Email 


//         $carts = Cart::content();
//         foreach($carts as $cart){

//             OrderItem::insert([
//                 'order_id' => $order_id,
//                 'product_id' => $cart->id,
//                 'vendor_id' => $cart->options->vendor,
//                 'color' => $cart->options->color,
//                 'size' => $cart->options->size,
//                 'qty' => $cart->qty,
//                 'price' => $cart->price,
//                 'created_at' =>Carbon::now(),

//             ]);

//         } // End Foreach

//         if (Session::has('coupon')) {
//            Session::forget('coupon');
//         }

//         Cart::destroy();

//         $notification = array(
//             'message' => 'Your Order Place Successfully',
//             'alert-type' => 'success'
//         );

//         return redirect()->route('dashboard')->with($notification); 



//     }// End Method 




//     public function CashOrder(Request $request){

//         if(Session::has('coupon')){
//             $total_amount = Session::get('coupon')['total_amount'];
//         }else{
//             $total_amount = round(Cart::total());
//         }

        
//         $order_id = Order::insertGetId([
//             'user_id' => Auth::id(),
//             'division_id' => $request->division_id,
//             'district_id' => $request->district_id,
//             'state_id' => $request->state_id,
//             'name' => $request->name,
//             'email' => $request->email,
//             'phone' => $request->phone,
//             'adress' => $request->address,
//             'post_code' => $request->post_code,
//             'notes' => $request->notes,

//             'payment_type' => 'Cash On Delivery',
//             'payment_method' => 'Cash On Delivery',
            
//             'currency' => 'Usd',
//             'amount' => $total_amount,
            

//             'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
//             'order_date' => Carbon::now()->format('d F Y'),
//             'order_month' => Carbon::now()->format('F'),
//             'order_year' => Carbon::now()->format('Y'), 
//             'status' => 'pending',
//             'created_at' => Carbon::now(),  

//         ]);



//   // Start Send Email

//         $invoice = Order::findOrFail($order_id);

//         $data = [

//             'invoice_no' => $invoice->invoice_no,
//             'amount' => $total_amount,
//             'name' => $invoice->name,
//             'email' => $invoice->email,

//         ];

//         Mail::to($request->email)->send(new OrderMail($data));

//         // End Send Email 



//         $carts = Cart::content();
//         foreach($carts as $cart){
            
//             OrderItem::insert([
//                 'order_id' => $order_id,
//                 'product_id' => $cart->id,
//                 'vendor_id' => $cart->options->vendor,
//                 'color' => $cart->options->color,
//                 'size' => $cart->options->size,
//                 'qty' => $cart->qty,
//                 'price' => $cart->price,
//                 'created_at' =>Carbon::now(),

//             ]);

//         } // End Foreach

//         if (Session::has('coupon')) {
//            Session::forget('coupon');
//         }

//         Cart::destroy();

//         $notification = array(
//             'message' => 'Your Order Place Successfully',
//             'alert-type' => 'success'
//         );

//         return redirect()->route('dashboard')->with($notification); 



//     }// End Method 

public function CashOrder(Request $request){
    $users=User::where('role','admin')->get();
    if(Session::has('coupon')){
        $total_amount = Session::get('coupon')['total_amount'];
    }else{
        $carts = Cart::where('user_id',Auth::id())->latest()->get();$cartTotal=0;
        $cartTotal=0;
        foreach( $carts as $cart){
            $cartQtyrow =$cart->qty ;
            $cartPrice =$cart->price;
            $cartTotal+=$cartQtyrow * $cartPrice ;
        }
      
        $total_amount = $cartTotal;
    }

    
    $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'division_id' => $request->division_id,
        'district_id' => $request->district_id,
        'state_id' => $request->state_id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'adress' => $request->address,
        'post_code' => $request->post_code,
        'notes' => $request->notes,

        'payment_type' => 'Cash On Delivery',
        'payment_method' => 'Cash On Delivery',
        
        'currency' => 'Usd',
        'amount' => $total_amount,
        

        'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
        'order_date' => Carbon::now()->format('d F Y'),
        'order_month' => Carbon::now()->format('F'),
        'order_year' => Carbon::now()->format('Y'), 
        'status' => 'pending',
        'created_at' => Carbon::now(),  

    ]);

 

// Start Send Email

    $invoice = Order::findOrFail($order_id);

    $data = [

        'invoice_no' => $invoice->invoice_no,
        'amount' => $total_amount,
        'name' => $invoice->name,
        'email' => $invoice->email,

    ];

    // Mail::to($request->email)->send(new OrderMail($data));

    //End Send Email 



    $carts = Cart::where('user_id',Auth::id())->latest()->get();
    foreach($carts as $cart){
        
        OrderItem::insert([
            'order_id' => $order_id,
            'product_id' => $cart->product_id,
            'vendor_id' => $cart->product->vendor_id,
            'color' => $cart->color,
            'size' => $cart->size,
            'qty' => $cart->qty,
            'price' => $cart->price,
            'created_at' =>Carbon::now(),

        ]);

    } // End Foreach

    if (Session::has('coupon')) {
       Session::forget('coupon');
    }
    $carts = Cart::where('user_id',Auth::id())->latest()->get();
    foreach($carts as $cart){
        Cart::destroy($cart->id);

    }
    

    $notification = array(
        'message' => 'Your Order  Successfully',
        'alert-type' => 'success'
    );
    Notification::send($users, new OrderCompleteNotification($request->name));
    return redirect(url('dashboard'))->with($notification); 



}// End Method 



}
