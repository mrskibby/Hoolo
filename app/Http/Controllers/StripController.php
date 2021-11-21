<?php

namespace App\Http\Controllers;


use App\FailedTranscations;
use App\Invoice;
use Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Crypt;
use Illuminate\Http\Request;
use Validator;

class StripController extends Controller
{

   

    public function stripayment(Request $request)
    {

        require_once 'price.php';
        $amount = round(Crypt::decrypt($request->amount), 2);
        

        $expiry = explode('/', $request->expiry);

        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'expiry' => 'required',
            'cvc' => 'required|max:3',
            'amount' => 'required',
        ]);

        $cart_table = Auth::user()->cart;
        $total = 0;

        $total = getcarttotal();

        $total = sprintf("%.2f",$total*$conversion_rate);

        if (round($request->actualtotal, 2) != $total) {

            notify()->error('Payment has been modifed !','Please try again !');
            return redirect(route('order.review'));

        }

        $inv_cus = Invoice::first();

        #Creating order ID
        $order_id = uniqid();

        $input = $request->all();

        if ($validator->passes()) {

            $input = array_except($input, array('_token'));

            $stripe = Stripe::make(env('STRIPE_SECRET'));

            if ($stripe == '' || $stripe == null) {
                notify()->error("Stripe Key Not Found Please Contact your Site Admin");
                return redirect(route('order.review'));
            }

            try {

                $month = (int) $expiry[0];
                $year = (int) $expiry[1];

                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('number'),
                        'exp_month' => $month,
                        'exp_year' => $year,
                        'cvc' => $request->get('cvc'),
                    ],
                ]);

                if (!isset($token['id'])) {
                    notify()->error('The Stripe Token was not generated correctly !');
                    return redirect(route('order.review'));
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $amount,
                    'description' => "Payment For Order $inv_cus->order_prefix $order_id",
                ]);

                if ($charge['status'] == 'succeeded') {
                    
                    $order_id = uniqid();
                    
                    $txn_id = $charge['id'];

                    $payment_status = 'yes';

                    $checkout = new PlaceOrderController;

                    return $checkout->placeorder($txn_id,'Stripe',$order_id,$payment_status);

                    
                } else {

                    $failedTranscations = new FailedTranscations;
                    $failedTranscations->txn_id = 'STRIPE_FAILED_' . str_random(5);
                    $failedTranscations->user_id = auth()->id();
                    $failedTranscations->save();
                    notify()->error('Payment failed');
                    return redirect(route('order.review'));
                }
            } catch (\Exception $e) {

                notify()->error($e->getMessage());
                $failedTranscations = new FailedTranscations;
                $failedTranscations->txn_id = 'STRIPE_FAILED_' . str_random(5);
                $failedTranscations->user_id = auth()->id();
                $failedTranscations->save();

                return redirect(route('order.review'));
            }
        }
        notify()->error("Card details are incomplete ! !");
        return redirect(route('order.review'));
    }

}
