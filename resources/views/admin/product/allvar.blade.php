@extends('admin.layouts.master-soyuz')
@section('title','View  All Variants - ')
@section('body')
​
@component('admin.component.breadcumb',['thirdactive' => 'active'])
​
@slot('heading')
{{ __('View Variants') }}
@endslot
​
@slot('menu2')
{{ __("View Variants") }}
@endslot
​

​
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
  <a href="{{ url('admin/products') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
  </div>
</div>
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
​
​
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5>{{ __('View Variants') }}</h5>
        </div>
        <div class="card-body">
          
            <!-- table start -->
			<table class="width100 table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Variant Detail</th>
					<th>Pricing Details</th>
					<th>Added / Updated On</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
				@foreach($pro->subvariants as $key=> $sub)
				<tr>
					<td>
						<b># {{ $key+1 }}</b>
					</td>
					<td class="v-middle">
						<div class="row">
							<div class="col-md-3">

								@if(count($pro->subvariants)>0)

								@if(isset($sub->variantimages['main_image']))

								<img class="img-responsive img-circle" title="{{ $pro->name }}"
									src="{{ url('variantimages/thumbnails/'.$sub->variantimages['main_image']) }}"
									alt="{{ $sub->variantimages['main_image'] }}">


								@endif
								@else
								<img class="img-responsive img-circle" src="{{ asset('images/no-image.png') }}" alt="no-image.png">
								@endif
							</div>

							<div class="col-md-offset-1 col-md-6">
								<p><b>Variant Name:</b> {{ $pro->name }}
									(@foreach($sub->main_attr_value as $k => $getvar)

									{{-- Getting Attribute Names --}}
									@php
									$getattrname = App\ProductAttributes::where('id',$k)->first()->attr_name
									@endphp
									{{-- Getting Attribute Values --}}


									@php
									$getvalname = App\ProductValues::where('id',$getvar)->first();
									@endphp

									@if(strcasecmp($getvalname['values'], $getvalname['unit_value']) !=0 &&
									$getvalname->unit_value != null )

									@if($getvalname->proattr->attr_name == "Color" || $getvalname->proattr->attr_name ==
									"Colour" || $getvalname->proattr->attr_name == "color" ||
									$getvalname->proattr->attr_name == "colour")
									{{ $getvalname['values'] }}
									@else
									{{ $getvalname['values'] }}{{ $getvalname->unit_value }},
									@endif


									@else
									{{ $getvalname['values']}},
									@endif
									@endforeach)
								</p>



								<p><b>Additional Price: </b> {{ $sub->price }}</p>
								<p><b>Min Qty. For Order:</b> {{ $sub->min_order_qty }}</p>

								<p><b>Stock :</b> {{ $sub->stock }} | <b>Max Qty. For Order:</b>
									{{ $sub->max_order_qty }}</p>
							</div>

						</div>



					</td>
					<td class="v-middle">

						@if($pro->vender_offer_price !=null)
						<p>Discounted Price : <b>{{ $pro->offer_price }}</b></p>
						<p>Selling Price : <b>{{ $pro->price }}</b></p>
						@else
						<p>Selling Price : <b>{{ $pro->price }}</b></p>
						@endif

						<p>(<b>Incl. Admin Commission in this rate</b>)</p>
					</td>

					<td>
						<p> <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
							<span class="font-weight500">{{ date('M jS Y',strtotime($sub->created_at)) }},</span></p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i> <span
								class="font-weight500">{{ date('h:i A',strtotime($sub->created_at)) }}</span></p>

						<p class="greydashedborder"></p>

						<p>
							<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
							<span class="font-weight500">{{ date('M jS Y',strtotime($sub->updated_at)) }}</span>
						</p>

						<p><i class="fa fa-clock-o" aria-hidden="true"></i> <span
								class="font-weight500">{{ date('h:i A',strtotime($sub->updated_at)) }}</span></p>

					</td>

					<td class="v-middle">

					<!-- ----------------------- -->
					<div class="dropdown">
						<button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
						<div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
						<a target="_blank" title="View Variant" href="{{ $pro->getURL($sub) }}"
							class="dropdown-item">
							<i class="feather icon-eye mr-2"></i>{{ __("View") }}
						</a>
							<a class="dropdown-item" href="{{ route('edit.var',$sub->id) }}"><i class="feather icon-edit mr-2"></i>Edit</a>
							<a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#deletevar{{ $sub->id }}" >
								<i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
							</a>
						</div>
					</div>
					<!-- ----------------------- -->
					</td>


				</tr>
				@endforeach
			</tbody>
		</table>
			<!-- table end -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




@foreach($pro->subvariants as $key=> $sub)
<div id="deletevar{{ $sub->id }}" class="delete-modal modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="delete-icon"></div>
			</div>
			<div class="modal-body text-center">
				<h4 class="modal-heading">Are You Sure ?</h4>
				<p>Do you really want to delete this variant? This process cannot be undone.</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="{{ route('del.var',$sub->id) }}" class="pull-right">
					{{csrf_field()}}
					{{method_field("DELETE")}}
					<button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
					<button type="submit" class="btn btn-danger">Yes</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

  @endsection

<!-- css for image start -->
<style>
    .img-circle{
   height:80px;
   width:80px;
   border-radius:50%;
}
</style>
<!-- css for image end -->