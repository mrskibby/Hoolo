@extends("admin.layouts.sellermastersoyuz")
@section('title','Your Orders')
@section('body')

@component('seller.components.breadcumb',['secondactive' => 'active'])
@slot('heading')
{{ __('Your Orders') }}
@endslot
@slot('menu1')
{{ __('Your Orders') }}
@endslot



@endcomponent

<div class="contentbar">


  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="card-title">{{ __('Your Orders') }}</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-12">
              <div class="box box-default box-body">
                {!! $sellerorders->container() !!}
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="card-title">{{ __('All Orders') }}</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="full_detail_table" class="table table-striped table-bordered">
              <thead>
                <th>#</th>
                <th>Order Type</th>
                <th>Order ID</th>
                <th>Total Qty</th>
                <th>Total Amount</th>
                <th>#</th>
              </thead>


              <tbody>


                @foreach($emptyOrder as $orderkey=> $o)

                @php
                $x = App\InvoiceDownload::where('order_id','=',$o->id)->where('vender_id',Auth::user()->id)->get();

                $total = 0;

                foreach ($x as $key => $value) {
                $total = $total+$value->qty * ($value->price +
                $value->tax_amount)+$value->gift_charge+$value->shipping+$value->handlingcharge;
                }
                @endphp
                <tr>
                  <td>{{ ++$orderkey }}</td>
                  <td>
                    @if($o->payment_method !='COD')
                    <label class="badge badge-pill badge-success">PREPAID</label>
                    @else
                    <label class="badge badge-pill badge-primary">COD</label>
                    @endif
                  </td>
                  <td>{{ $inv_cus->order_prefix.$o->order_id }}
                    <p></p>
                    <small><a title="View Order" href="{{ route('seller.view.order',$o->order_id) }}">View
                        Order</a></small> |
                    <small><a title="Edit Order" href="{{ route('seller.order.edit',$o->order_id) }}">Edit
                        Order</a></small>
                  </td>
                  <td>{{ $x->sum('qty') }}</td>
                  <td> <i class="{{ $o->paid_in }}"></i>@infloat($total)
                  </td>

                  <td>
                    <a title="Print Order" href="{{ route('seller.print.order',$o->id) }}" class="btn btn-primary-rgba">
                      <i class="fa fa-print"></i>
                    </a>
                  </td>
                </tr>
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
<script src="{{ url('front/vendor/js/highcharts.js') }}" charset="utf-8"></script>
<script>
  $(".btn-box-tool").on('click',function () {
    $(this).toggleClass('btn-plus');
    $(".box-default").slideToggle();
  });
</script>

{!! $sellerorders->script() !!}
@endsection