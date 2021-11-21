@extends('admin.layouts.master-soyuz')
@section('title','All Vouchers | ')
@section('body')

@component('admin.component.breadcumb',['secondactive' => 'active'])
@slot('heading')
   {{ __('All Vouchers ') }}
@endslot
@slot('menu1')
   {{ __('All Vouchers ') }}
@endslot
@slot('button')
<div class="col-md-6">
    <div class="widgetbar">
      @can('users.create')
      <a href="{{ route("subscription-vouchers.create") }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i> {{ __("Create new voucher") }}</a>
      @endcan
      
    </div>
</div>
@endslot



@endcomponent

<div class="contentbar">   

  <div class="row">
  
      <div class="col-lg-12">
          <div class="card m-b-30">
              <div class="card-header">
               
                    <h5 class="card-title"> {{__("All Vouchers ")}}</h5>
                 
                 
                 
                  
              </div>
              
              <div class="card-body">
               
                  <div class="table-responsive">
                    <table id="subs_list" class="table table-bordered">
                        <thead>
                            <th>
                                #
                            </th>
                            <th>
                                Voucher Code
                            </th>
                            <th>
                                Link By
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Discount apply type
                            </th>
                            <th>
                                Max usage
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Action
                            </th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End col -->
</div>

@endsection     
                        
@section('custom-script')
<script>
    $(function () {
        "use strict";
        var table = $('#subs_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("subscription-vouchers.index") }}',
            language: {
                searchPlaceholder: "Search in list..."
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'code',
                    name: 'subscription_vouchers.code'
                },
                {
                    data: 'link_by',
                    name: 'subscription_vouchers.link_by'
                },
                {
                    data: 'amount',
                    name: 'subscription_vouchers.amount'
                },
                {
                    data: 'dis_applytype',
                    name: 'subscription_vouchers.dis_applytype'
                },
                {
                    data: 'maxusage',
                    name: 'subscription_vouchers.maxusage'
                },
                {
                    data: 'status',
                    name: 'seller_subscriptions.status',
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
                [7, 'DESC']
            ]
        });

    });
</script>
@endsection    
                    
    
                  
          
                  
    
    
          
                  
    
    
                  
                  
                
    
                
                                      


          

            
          
              




            

            
            
            
  
                 
  
               
  
          
    
             
            

          


