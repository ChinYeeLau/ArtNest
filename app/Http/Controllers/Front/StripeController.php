<?php

namespace App\Http\Controllers\Front;

use Session;
use Throwable;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductsAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Import the Mail facade

class StripeController extends Controller
{
    public function stripe()
    {
        if (Session::has('order_id')) {
            return view('front.stripe.stripe');
        } else {
            return redirect('cart');
        }
    }

    public function stripePay(Request $request)
    {
        try {
            // Set Stripe API key
            Stripe::setApiKey(env('STRIPE_TEST_SK'));
    
            // Create a customer

            $customer = Customer::create([
                "address" => [
                    "line1" => Session::get('order_address'),
                    "postal_code" => Session::get('order_postcode'),
                    "city" => Session::get('order_state'),
                    "state" => Session::get('order_state'),
                    "country" => "MY",
                ],
                "email" => Auth::user()->email,
                "name" => Auth::user()->name,
                "source" => $request->stripeToken
            ]);
          
            // Charge the customer
            $grand_total = Session::get('grand_total'); // Get the grand total from the session
            $fee = $grand_total * 0.03+1; 
            $tax=$fee*0.06;
            $total_amount = $grand_total + $fee+$tax; // Add the fee to the grand total
            
            // Convert the total amount to the smallest currency unit (cents for MYR)
            $orderId=Session::get('order_id');
            $stripe_amount = round($total_amount * 100);          
              $charge = Charge::create([
                "amount" => $stripe_amount,
                "currency" => "myr",
                "customer" => $customer->id,
                "description" => "Order ID  $orderId",
                "shipping" => [
                    "name" => Auth::user()->name,
                    "address" => [
                        "line1" => Session::get('order_address'),
                        "postal_code" => Session::get('order_postcode'),
                        "city" => Session::get('state'),
                        "state" => Session::get('order_state'),
                        "country" => "Malaysia",
                    ],
                ]
            ]);
    
            if ($charge->status == 'succeeded') {
                // Payment was successful
                return view('front.stripe.success');
            } else {
                // Payment failed
                return view('front.stripe.fail');
            }
        } catch (\Throwable $th) {
            // Handle any errors that occurred during payment
            return view('front.stripe.fail');
        }
    }
    
    public function success(Charge $charge)
{
    if($request->input('paymentId')&&$request->input('CustomerID')){
        $transaction=$this->gateway->completePurchase(array(
           'customer_id'=>$request->input('CustomerID'),
           'transactionReference'=>$request->input('paymentId')

        ));
           $response=$transaction->send();
           if ($response->isSuccessful()){
               $arr=$response->getData();
               $payment=new Payment;
                $payment->order_id= Session::get('order_id');
                $payment->user_id= Auth::user()->id;
                $payment->payment_id=$arr['id'];
                $payment->payer_id=$arr['customer']['customer_info']['customer_id'];
                $payment->payer_email=$arr['customer']['customer_info']['email'];
                $payment->amount=$arr['transactions'][0]['amount']['total'];
                $payment->currency='MYR';
                $payment->payment_status=$arr['state'];
                $payment->save();
            // Handle successful payment
            // Update the order status
            $order_id = Session::get('order_id');
            Order::where('id', $order_id)->update(['order_status' => 'Paid']);

            // Send order email
            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
            $email = Auth::user()->email;
            $messageData = [
                'email' => $email,
                'name' => Auth::user()->name,
                'order_id' => $order_id,
                'orderDetails' => $orderDetails
            ];
            Mail::send('emails.order', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Order Placed - ArtNest.online');
            });

            // Reduce stock
            foreach ($orderDetails['orders_products'] as $key => $order) {
                $getProductStock = ProductsAttribute::getProductStock($order['product_id'], $order['product_size']);
                $newStock = $getProductStock - $order['product_qty'];
                ProductsAttribute::where(['product_id' => $order['product_id'], 'size' => $order['product_size']])->update(['stock' => $newStock]);
            
            }
        

            // Empty cart
            Cart::where('user_id', Auth::user()->id)->delete();

            // Redirect to success page
            return view('front.stripe.success');
    }
        } else {
            // Handle unsuccessful payment
            return redirect()->route('payment.error')->with('error', $response->getMessage());
        }
    
}


    public function error()
    {
        return view('front.stripe.fail');
    }
}

