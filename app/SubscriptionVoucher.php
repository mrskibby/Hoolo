<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionVoucher extends Model
{
    protected $fillable = [
        'code','distype','amount','link_by','dis_applytype','plan_id','maxusage','expirydate'
    ];

    public function plan()
    {
        return $this->belongsTo('App\SellerPlans','plan_id','id');
    }
}
