@extends('admin.layouts.master-soyuz')
@section('title','Invoice Setting |')
@section('body')
​
@component('admin.component.breadcumb',['fourthactive' => 'active'])
​
@slot('heading')
{{ __('Retured Orders') }}
@endslot
​
@slot('menu2')
	{{ __("Orders and Invoices") }}
@endslot

@slot('menu3')
	{{ __("Retured Orders") }}
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
						<h5 class="card-box">{{ __('Retured Orders') }}</h5>
					</div> 
				
				
					<div class="card-body">
						<ul class="nav nav-tabs custom-tab-line mb-3" id="defaultTabLine" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab-line" data-content="If order have only 1 item than its count in single canceled orders."  data-toggle="tab" href="#home-line" role="tab" aria-controls="home-line" aria-selected="true"><i class="feather icon-truck mr-2"></i>
									Return Completed @if($countC>0) <span class="badge">{{$countC}}@endif</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab-line" data-content="If order have more than 1 item than its count in Bulk canceled orders." data-toggle="tab" href="#profile-line" role="tab" aria-controls="profile-line" aria-selected="false"><i class="feather icon-truck mr-2"></i>
									Pending Returns @if($countP>0) <span class="badge">{{$countP}}@endif</a>
							</li>
							
						</ul>
						<div class="tab-content" id="defaultTabContentLine">
							<div class="tab-pane fade show active" id="home-line" role="tabpanel" aria-labelledby="home-tab-line">
								<div class="table-responsive">
									<table id="full_detail_table2" class="table table-striped table-bordered">
										<thead>
										
											<th>
												#
											</th>
											<th>
												Order ID
											</th>
											<th>
												Item
											</th>
											<th>
												Refunded Amount
											</th>
											<th>
												Refund Status
											</th>
				
										</thead>
										<tbody>
											@foreach($orders as $key=> $order)
									
												@if(isset($order->getorder->order) && $order->status != 'initiated')
												<tr>
													<td>
														{{ $key+1 }}
													</td>
													<td><b>#{{ $inv_cus->order_prefix.$order->getorder->order->order_id }}</b>
															<br>
															<small>
																<a title="View Refund Detail" href="{{  route('return.order.detail',$order->id)  }}">View Detail</a> 
															</small>
													</td>
													<td>
														@if(isset($order->getorder->variant))
															<b>
																{{$order->getorder->variant->products->name}} ({{ variantname($order->getorder->variant) }})
															</b>
														@endif

														@if(isset($order->getorder->simple_product))
															<b>
																{{$order->getorder->simple_product->product_name}}
															</b>
														@endif
															
													</td>
													<td>
														<i class="{{ $order->getorder->order->paid_in }}"></i>{{ $order->amount }}
													</td>
													<td>
														<label class="label label-success">
															{{ ucfirst($order->status) }}
														</label>
													</td>
												</tr>
												@endif
													
												
											@endforeach		
										</tbody>
									</table>                  
								</div><!-- table-responsive div end -->
							</div><!-- card body end -->
					
							<div class="tab-pane fade" id="profile-line" role="tabpanel" aria-labelledby="profile-tab-line">
		
								<div class="table-responsive">
									<table id="full_detail_table" class="w-100 table table-striped table-bordered">
										<thead>
											<th>
												#
											</th>
											<th>
												Order TYPE
											</th>
											<th>
												OrderID
											</th>
											<th>
												Pending Amount
											</th>
											<th>
												Requested By
											</th>
											<th>
												Requested on
											</th>
										</thead>
										
										<tbody>
											@foreach($orders as $key=> $order)
												@if(isset($order->getorder->order) && $order->status == 'initiated')
													<tr>
														<td>{{ $key+1 }}</td>
														<td>
															@if($order->getorder->order->payment_method != 'COD')
																<label class="label label-success">
																	PREPAID
																</label>
															@else
																<label class="label label-primary">
																	COD
																</label>
															@endif
														</td>
														<td><b>#{{ $inv_cus->order_prefix.$order->getorder->order->order_id }}</b>
															<br>
															<small>
																<a href="{{ route('return.order.show',$order->id) }}">UPDATE ORDER</a>
															</small>
														</td>
														<td>
															<i class="{{ $order->getorder->order->paid_in }}"></i>{{ $order->amount }}
														</td>
														<td>
															{{ $order->user->name }}
														</td>
														<td>
															{{date('d-M-Y | h:i A',strtotime($order->created_at))}}
														</td>
														
													</tr>
												@endif
											@endforeach
										</tbody>
									
									</table>                  
								</div>
							</div>
					</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('custom-script')
    <script>var baseUrl = "<?= url('/') ?>";</script>
	<script src="{{ url('js/order.js') }}"></script>
@endsection