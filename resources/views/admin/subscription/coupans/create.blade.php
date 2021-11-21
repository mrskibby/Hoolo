@extends('admin.layouts.master-soyuz')
@section('title',__("Create new voucher |"))
@section('body')

@component('admin.component.breadcumb',['secondactive' => 'active'])
@slot('heading')
{{ __('Create new voucher ') }}
@endslot
@slot('menu1')
{{ __('Create new voucher ') }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
    <a href="{{ route('subscription-vouchers.index') }}" class="btn btn-primary-rgba"><i
        class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>

  </div>
</div>
@endslot


@endcomponent

<div class="contentbar">
  


  <div class="row">
    <div class="col-lg-12">
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span></button></p>
        @endforeach
      </div>
      @endif
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="card-title">{{ __('Create new voucher ') }}</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('subscription-vouchers.store') }}" method="POST">
            @csrf
            <div class="row">

              <div class="form-group col-md-6">
                <label> {{__("Voucher code:")}} <span class="required">*</span></label>
                <input required="" type="text" class="form-control" name="code" value="{{ old('code') }}">
              </div>
              <div class="form-group col-md-6">
                <label> {{__("Discount type:")}} <span class="required">*</span></label>

                <select required name="distype" id="distype" class="form-control select2">

                  <option {{ old('distype') == 'fix' ? "selected" : "" }} value="fix">
                    {{__('Fixed')}}
                  </option>
                  <option {{ old('distype') == 'per' ? "selected" : "" }} value="per">
                    {{__("% Percentage")}}
                  </option>

                </select>

              </div>
              <div class="form-group col-md-6">
                <label> {{__("Discount apply type:")}} <span class="required">*</span></label>

                <select required="" name="dis_applytype" id="dis_applytype" class="form-control">

                  <option {{ old('dis_applytype') == 'fixed' ? "selected" : "" }} value="fixed">
                    {{__("Fixed Discount")}} </option>
                  <option {{ old('dis_applytype') == 'upto' ? "selected" : "" }} value="upto"> {{__("Up to")}} </option>

                </select>

              </div>
              <div class="form-group col-md-6">
                <label> {{__("Amount:")}} <span class="required">*</span></label>
                <input required="" type="text" class="form-control" name="amount" value="{{ old('amount') }}">

              </div>
              <div class="form-group col-md-6">
                <label> {{{__("Linked to:")}}} <span class="required">*</span></label>

                <select required="" name="link_by" id="link_by" class="form-control select2">

                  <option {{ old('link_by') == 'allplans' ? "selected" : "" }} value="allplans">
                    {{__("Applicable on all plans")}}
                  </option>
                  <option {{ old('link_by') == 'linktoplan' ? "selected" : "" }} value="linktoplan">
                    {{__("Link to Plan")}}
                  </option>

                </select>

              </div>

              <div id="plans" class="hide form-group col-md-6">
                <label> {{__("Select Plan:")}} <span class="required">*</span> </label>
                <br>
                <select name="plan_id" class="select2 form-control select2">
                  @foreach(App\SellerPlans::where('status','1')->get() as $plan)

                  <option {{ old('plan_id') == $plan->id ? "selected" : "" }} value="{{ $plan->id }}">
                    {{ $plan['name'] }}</option>

                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-6">
                <label> {{__("Max Usage Limit: ")}} <span class="required">*</span></label>
                <input value="{{ old('maxusage') }}" required="" type="text" min="1" class="form-control limit"
                  name="maxusage">
              </div>


              <div class="form-group col-md-6">
                <label> {{__("Expiry Date:")}} </label>
                <div class="input-group">

                  <input value="{{ date('Y-m-d',strtotime(old('expirydate'))) }}" required="" id="default-date"
                    type="text" class="form-control" name="expirydate">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="feather icon-calendar"></i></span>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label> {{ __("Status :") }} </label>
                <br>
                <label class="switch">
                  <input id="status" type="checkbox" name="status" {{ old('status') ? "checked" : "" }}>
                  <span class="knob"></span>
                </label>
              </div>


            </div>

            <div class="box-footer">
              <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
              <button class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                {{ __("Create")}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('custom-script')
<script>
  "use Strict";

  $("#link_by").on('change', function () {

    var val = $("#link_by").val();

    if (val == 'linktoplan') {

      $('#plans').show();

    } else {

      $('#plans').hide();

    }


  });
</script>
@endsection