<?php

namespace App\Http\Controllers\Front;

use Session;
use Throwable;
use Stripe\Stripe;
use App\Models\Cart;
use Omnipay\Omnipay;
use App\Models\Payment;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{


    public function stripe(){
        if(Session::has('order_id')){
            return view('front.stripe.stripe');
        }else{
            return redirect('cart');
        }
    }
    public function pay(Request $request){
        try{
            $stripe_amount=(Session::get('grand_total')*100);
            $response=$this->gateway->purchase(array(
                'amount'=>$stripe_amount,
                'currency'=>'myr',
                'returnURL'=>url('success'),
                'cancelURL'=>url('error')
                ))->send();
                if($response->isRedirect()){
                    $response->redirect();
                }else{
                    return $response->getMessage();
                }
        }catch(Throwable $th){
            return $th->getMessage();
        }
    }
    public function success(Request $request){
        if(!Session::has('order_id')){
            return redirect('cart');
        }
        if($request->input('paymentId')&&$request->input('PayerID')){
         $transaction=$this->gateway->completePurchase(array(
            'payer_id'=>$request->input('PayerID'),
            'transactionReference'=>$request->input('paymentId')

         ));
            $response=$transaction->send();
            if ($response->isSuccessful()){
                $arr=$response->getData();
                $payment=new Payment;
                 $payment->order_id= Session::get('order_id');
                 $payment->user_id= Auth::user()->id;
                 $payment->payment_id=$arr['id'];
                 $payment->payer_id=$arr['payer']['payer_info']['payer_id'];
                 $payment->payer_email=$arr['payer']['payer_info']['email'];
                 $payment->amount=$arr['transactions'][0]['amount']['total'];
                 $payment->currency=env('PAYPAL_CURRENCY');
                 $payment->payment_status=$arr['state'];
                 $payment->save();
                // return"Payment is Successful.Your transaction is ". $arr['id'];
                //Update the order
                $order_id=Session::get('order_id');
                //update order status to paid
                Order::where('id',$order_id)->update(['order_status'=>'Paid']);
                $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
                // Send order email
             $email = Auth::user()->email;
             $messageData = [
                 'email' => $email,
                 'name' => Auth::user()->name,
                 'order_id' => $order_id,
                 'orderDetails' => $orderDetails
             ];
             Mail::send('emails.order', $messageData, function($message) use ($email) {
                 $message->to($email)->subject('Order Placed - ArtNest.online');
             });
              //reduce stock 
              foreach($orderDetails['orders_products'] as $key =>$order){
                $getProductStock=ProductsAttribute::getProductStock($order['product_id'],$order['product_size']);
                $newStock= $getProductStock-$order['product_qty'];
                ProductsAttribute::where(['product_id'=>$order['product_id'],'size'=>$order['product_size']])->update(['stock'=>$newStock]);
              }
             
              //empty cart
             Cart::where('user_id',Auth::user()->id)->delete();
             return view('front.stripe.success');

            }else{
                return $response->getMessage();
            }

        }else{
            return"Payment Declined!";
        }
    }
    public function error(){
        //return"User declined the payment";
        return view('front.stripe.fail');

         }
}
   

