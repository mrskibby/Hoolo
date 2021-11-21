@extends('admin.layouts.master-soyuz')
@section('title','Completed Payments')
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])
@slot('heading')
{{ __('Completed Payouts') }}
@endslot
@slot('menu2')
{{ __("Completed Payouts") }}
@endslot

​
@endcomponent
<div class="contentbar">
  <div class="row">
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $error)
      <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      @endforeach
    </div>
    @endif
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title">{{ __('Completed Payouts') }}</h5>
        </div>
        <div class="card-body">
         <!-- main content start -->
            <table id="completedPayouts" class="width100 table table-striped table-bordered">
              <thead>
                <th>
                  #
                </th>
                <th>
                  Transfer TYPE
                </th>
                <th>
                  Order ID
                </th>
                <th>
                  Amount
                </th>
                <th>
                  Seller Details
                </th>
                <th>
                  Paid On
                </th>
                <th>
                  Action
                </th>
              </thead>

              <tbody>
                
              </tbody>
            </table>
            <!-- table to display page data end -->                
                   
                    <!-- main content end -->
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="trackmodal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
              <h5 class="modal-title" id="exampleStandardModalLabel">Track Payout Status</h5>
                <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div id="trackstatus">
            
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>


 
@endsection

@section('custom-script')
<script>
  var trackurl = {!! json_encode( url('/track/payput/status/') ) !!};
  var payouturl = {!! json_encode( route('seller.payout.complete') ) !!};
</script>
<script src="{{url('js/paymentscript.js')}}"></script>
@endsection

