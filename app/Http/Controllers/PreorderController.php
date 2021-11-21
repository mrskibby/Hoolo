<?php

namespace App\Http\Controllers;

use App\InvoiceDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PreorderController extends Controller
{
    public function payment(Request $request,$id){

        if ($request->hasValidSignature()) {

            $order = InvoiceDownload::findOrfail($id);

            if($order->type == 'pre_order'){
                
                Session::put('inv_preorder',$order->id);

                Session::save();

                if($order->order->payment_method == 'Instamojo'){

                    $instamojo = new InstamojoController;

                    return $instamojo->payment($order_id = $order->order->order_id,$amount = round($order->remaning_amount,2),$name = $order->order->user->name,$email = $order->order->user->email,$phone = $order->order->user->mobile,$purpose = "Preorder remaining payment",$error = url('/'));
                }

                if($order->order->payment_method == 'Paypal'){

                    $paypal = new PaymentController;

                    return $paypal->payWithpaypal($order_id = $order->order->order_id,$amount = round($order->remaning_amount,2),$name = $order->order->user->name,$email = $order->order->user->email,$phone = $order->order->user->mobile,$purpose = "Preorder remaining payment",$error = url('/'));
                }

                if($order->order->payment_method == 'Paytm'){

                    $paytm = new PaytmController;

                    return $paytm->payProcess($order_id = $order->order->order_id,$amount = round($order->remaning_amount,2),$name = $order->order->user->name,$email = $order->order->user->email,$phone = $order->order->user->mobile,$purpose = "Preorder remaining payment",$error = url('/'));
                }

                if($order->order->payment_method == 'Cashfree'){


                    $cf = new CashfreeController;

                    return $cf->pay($order_id = $order->order->order_id.'_pre',$amount = round($order->remaning_amount,2),$name = $order->order->user->name,$email = $order->order->user->email,$phone = $order->order->user->mobile,$purpose = "Preorder remaining payment",url('/'));
                }

                if($order->order->payment_method == 'PayU'){


                    $payment = new PayuController;

                    return $payment->payment($order_id = $order->order->order_id.'_pre',$amount = round($order->remaning_amount,2),$name = $order->order->user->name,$email = $order->order->user->email,$phone = $order->order->user->mobile,$purpose = "Preorder remaining payment",url('/'));
                }

            }else{
                notify()->error(__('The order is not preorder !'));
                return redirect('/');
            }

        }else{
            notify()->error(__('Payment link has been expired !'));
            return redirect('/');
        }

    }

    public function completePreorder($invoice,$txn_id){
        
        $order = InvoiceDownload::findOrfail($invoice);

        $order->price           = $order->price + (($order->remaning_amount - $order->rem_tax_amount) / $order->qty);
        
        $order->igst            = ($order->tax_amount * $order->qty) + ($order->rem_tax_amount);
        $order->tax_amount      = $order->tax_amount + ($order->rem_tax_amount/$order->qty);

        if($order->sgst != ''){
            $order->sgst        = ($order->tax_amount*$order->qty) / 2;
            $order->cgst        = ($order->tax_amount*$order->qty) / 2;
        }

        $order->type            = __("order");
       

        $order->order()->update([
            'transaction_id' => $txn_id,
            'tax_amount'     => $order->order->tax_amount + $order->rem_tax_amount,
            'order_total'    => $order->order->order_total + $order->remaning_amount
        ]);

        $order->remaning_amount = 0;
        $order->rem_tax_amount  = 0;
        $order->save();

        session()->forget('inv_preorder');
        session()->forget('order_id');
        session()->forget('error_url');

        $status = 'Order #'.$order->order['order_id']. 'payment successfully !';

        notify()->success("$status");

        return redirect()->route('order.done', ['orderid' => $order->order->order_id]);

    }
}
