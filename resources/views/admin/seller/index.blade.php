@extends('admin.layouts.master-soyuz')
@section('title','Seller Payments | ')
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])
@slot('heading')
{{ __(' Seller Due Payouts') }}
@endslot
@slot('menu2')
{{ __(" Seller Due Payouts") }}
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
          <h5 class="box-title">{{ __(' Seller Due Payouts') }}</h5>
        </div>
        <div class="card-body">
         <!-- main content start -->
		 <table id="payouttable" class="width100 table table-bordered table-striped">
      		<thead>
      			<th>#</th>
      			<th>Order TYPE</th>
      			<th>Order ID</th>
      			<th>Order Amount</th>
      			<th>Seller Details</th>
      			<th>Action</th>
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
@endsection

@section('custom-script')
<script>
  var url = {!! json_encode(route('seller.payouts.index')) !!};
</script>
<script src="{{ url('js/payindex.js') }}"></script>
@endsection

