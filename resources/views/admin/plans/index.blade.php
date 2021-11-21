@extends('admin.layouts.master-soyuz')
@section('title','Plans | ')
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])
@slot('heading')
{{ __('Plans') }}
@endslot
@slot('menu2')
{{ __("Plans") }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
  <a href="{{ route('seller.subs.plans.create') }}" class="float-right btn btn-primary-rgba mr-2"><i class="feather icon-plus mr-2"></i>{{ __('Add Plan') }}</a>
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
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title">{{ __('Plans') }}</h5>
        </div>
        <div class="card-body ml-2">
         <!-- main content start -->
         <div class="table-responsive">
                        <!-- table to display faq start -->
                        <table id="datatable-buttons1" class="table table-striped table-bordered">

                          <thead>
                            <th>#</th>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Price") }}</th>
                            <th>{{ __("Period") }}</th>
                            <th>{{ __("Features") }}</th>
                            <th>{{ __("Status") }}</th>
                            <th>{{ __("Action") }}</th>
                          </thead>
​
                        <tbody>
                 
                        </tbody>

                        </table>                  
                        <!-- table to display page data end -->                
                    </div><!-- table-responsive div end -->
                    <!-- main content end -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-script')
<script>
    $(function () {
        "use strict";
        var table = $('#datatable-buttons1').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("seller.subs.plans.index") }}',
            language: {
                searchPlaceholder: "Search in plans..."
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'seller_plans.id',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'name',
                    name: 'seller_plans.name'
                },
                {
                    data: 'price',
                    name: 'seller_plans.price'
                },
                {
                    data: 'period',
                    name: 'seller_plans.validity'
                },
                {
                    data: 'features',
                    name: 'features',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'status',
                    name: 'seller_plans.status',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable : false
                },
            ],
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            order: [
                [0, 'DESC']
            ]
        });

    });
</script>
@endsection

