<?php

namespace App\Http\Controllers\Subs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubscriptionVoucher;
use Svg\Tag\Rect;
use Yajra\DataTables\Facades\DataTables;

class SellerCoupansController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SellerCoupansController
    |--------------------------------------------------------------------------
    |
    | Seller Subscription coupan controller to create seller subscription coupans.
    |
    */

    /**
     * @return view of coupans list
     */

    public function index(){

        $vouchers = SubscriptionVoucher::with('plan');

        if(request()->ajax()){
            return DataTables::of($vouchers)
              ->addIndexColumn()
              ->addColumn('link_by',function($row){
                    if($row->link_by == 'linktoplan'){
                        $html = '<p>Linked to plan:</p>';
                        $html .= '<p class="badge badge-primary"><b>'.$row->plan->name.'</b></p>';
                        return $html;
                    }else{
                        return __('Linked to All plans');
                    }
              })
              ->addColumn('status',function($row){
                    if($row->status == 1){
                        return '<span class="badge badge-success">Active</span>
                        ';
                    }else{
                        return '<span class="badge badge-danger">Deactive</span>
                        ';
                    }
              })
              ->editColumn('action','admin.subscription.coupans.action')
              ->rawColumns(['link_by','status','action'])
              ->make(true);
        }

        return view('admin.subscription.coupans.index');

    }

    /**
     * @return view to create coupans
     */

    public function create(){
        return view('admin.subscription.coupans.create');
    }

    /**
     * @return view to edit coupan
     */

    public function edit($id){
        $voucher = SubscriptionVoucher::find($id);
        return view('admin.subscription.coupans.edit',compact('voucher'));
    }

    /**
     * @return response success after storing coupans
     */

    public function store(Request $request){

        $request->validate([
            'code' => 'required|unique:subscription_vouchers,code'
        ]);

        $input = $request->all();

        if($request->link_by == 'linktoplan'){
            $input['plan_id'] = $request->plan_id;
        }else{
            $input['plan_id'] = NULL;
        }

        $input['status'] = $request->status ? 1 : 0;

        SubscriptionVoucher::create($input);

        notify()->success('Voucher created successfully !',$request->code);

        return redirect()->route('subscription-vouchers.index');

    }

    /**
     * @return response success after update coupans
     */

    public function update(Request $request,$id){

        $voucher = SubscriptionVoucher::find($id);

        $request->validate([
            'code' => 'required|unique:subscription_vouchers,code,'.$voucher->id
        ]);

        $input = $request->all();

        if($request->link_by == 'linktoplan'){
            $input['plan_id'] = $request->plan_id;
        }else{
            $input['plan_id'] = NULL;
        }

        $input['status'] = $request->status ? 1 : 0;

        $voucher->update($input);

        notify()->success('Voucher updated successfully !',$voucher->code);

        return redirect()->route('subscription-vouchers.index');
        
    }

    /**
     * @return response success after delete coupans
     */

    public function destroy($id){

        $voucher = SubscriptionVoucher::find($id);
        $voucher->delete();
        notify()->success('Voucher deleted successfully !');
        return redirect()->route('subscription-vouchers.index');

    }

}
