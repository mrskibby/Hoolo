<?php

namespace App\Http\Controllers;


use App\ManualPaymentMethod;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Image;


class ManualPaymentGatewayController extends Controller
{
    public function getindex()
    {
        abort_if(!auth()->user()->can('manual-payment.view'),403,'User does not have the right permissions.');
        $methods = ManualPaymentMethod::orderBy('id', 'DESC')->get();
        return view('admin.manualpayment.index', compact('methods'));
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('manual-payment.create'),403,'User does not have the right permissions.');

        $request->validate([
            'payment_name' => 'required|string|max:50|unique:manual_payment_methods,payment_name',
            'description' => 'required|max:5000'
        ]);

        $newmethod = new ManualPaymentMethod;
        $input = array_filter($request->all());

        if (!is_dir(public_path() . '/images/manual_payment')) {
            mkdir(public_path() . '/images/manual_payment');
        }

        if ($request->thumbnail != null) {

            if(!str_contains($request->thumbnail, '.png') && !str_contains($request->thumbnail, '.jpg') && !str_contains($request->thumbnail, '.jpeg') && !str_contains($request->thumbnail, '.webp') && !str_contains($request->thumbnail, '.gif')){
                    
                return back()->withInput()->withErrors([
                    'thumbnail' => 'Invalid image type for payment gateway thumbnail'
                ]);

            }

            $input['thumbnail'] = $request->thumbnail;
        }

        $input['status'] = isset($request->status) ? 1 : 0;

        $newmethod->create($input);

        notify()->success('Payment method added !', $request->payment_name);
        return back();

    }

    public function update(Request $request, $id)
    {

        abort_if(!auth()->user()->can('manual-payment.edit'),403,'User does not have the right permissions.');

        $method = ManualPaymentMethod::find($id);

        if (!$method) {
            notify()->error('Payment method not found !', 404);
            return back();
        }

        $request->validate([
            'payment_name' => 'required|string|max:50|unique:manual_payment_methods,payment_name,' . $method->id,
            'description' => 'required|max:5000',
            'thumbnail' => 'mimes:jpg,jpeg,png,webp,bmp',
        ]);

        $input = array_filter($request->all());

        if ($request->thumbnail != null) {

            if(!str_contains($request->thumbnail, '.png') && !str_contains($request->thumbnail, '.jpg') && !str_contains($request->thumbnail, '.jpeg') && !str_contains($request->thumbnail, '.webp') && !str_contains($request->thumbnail, '.gif')){
                    
                return back()->withInput()->withErrors([
                    'thumbnail' => 'Invalid image type for payment gateway thumbnail'
                ]);

            }

            $input['thumbnail'] = $request->thumbnail;
        }

        $input['status'] = isset($request->status) ? 1 : 0;

        $method->update($input);

        notify()->success('Payment method updated !', $request->payment_name);
        return back();

    }

    public function delete($id)
    {
        abort_if(!auth()->user()->can('manual-payment.delete'),403,'User does not have the right permissions.');

        $method = ManualPaymentMethod::find($id);

        if (!$method) {
            notify()->error('Payment method not found !', 404);
            return back();
        }

        if ($method->thumbnail != '' && file_exists(public_path() . '/images/manual_payment/' . $method->thumbnail)) {
            unlink(public_path() . '/images/manual_payment/' . $method->thumbnail);
        }

        notify()->success("Payment method deleted", $method->payment_name);

        $method->delete();

        return back();
    }

    public function checkout(Request $request, $token)
    {
        require_once 'price.php';

        $validator = Validator::make($request->all(), [
            'purchase_proof' => 'required|mimes:jpg,jpeg,png,webp,bmp',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors());
            $sentfromlastpage = 0;
            return view('front.checkout', compact('sentfromlastpage', 'conversion_rate'));
        }

        $cart_table = Auth::user()->cart;
        $total = 0;

        foreach ($cart_table as $cart) {

            if ($cart->product->tax_r != null && $cart->product->tax == 0) {

                if ($cart->ori_offer_price != 0) {
                    //get per product tax amount
                    $p = 100;
                    $taxrate_db = $cart->product->tax_r;
                    $vp = $p + $taxrate_db;
                    $taxAmnt = $cart->product->offer_price / $vp * $taxrate_db;
                    $taxAmnt = sprintf("%.2f", $taxAmnt);
                    $price = ($cart->ori_offer_price - $taxAmnt) * $cart->qty;

                } else {

                    $p = 100;
                    $taxrate_db = $cart->product->tax_r;
                    $vp = $p + $taxrate_db;
                    $taxAmnt = $cart->product->price / $vp * $taxrate_db;

                    $taxAmnt = sprintf("%.2f", $taxAmnt);

                    $price = ($cart->ori_price - $taxAmnt) * $cart->qty;
                }

            } else {

                if ($cart->semi_total != 0) {

                    $price = $cart->semi_total;

                } else {

                    $price = $cart->price_total;

                }
            }

            $total = $total + $price;

        }

        $total = round($total * $conversion_rate, 2);

        if (round($request->actualtotal, 2) != round($total, 2)) {

            require_once 'price.php';
            $sentfromlastpage = 0;
            Session::put('from-pay-page', 'yes');
            Session::put('page-reloaded', 'yes');
            return redirect()->action('CheckoutController@add');

        }

        $txn_id = str_random(8);
        $payment_method = ucfirst($request->payvia);

        $payment_status = 'no';

        $checkout = new PlaceOrderController;

        return $checkout->placeorder($txn_id,$payment_method,session()->get('order_id'),$payment_status,NULL,$request->purchase_proof);
       

      
    }
}
