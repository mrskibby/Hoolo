@extends('admin.layouts.master-soyuz')
@section('title','All Subscriptions | ')
@section('body')

@component('admin.component.breadcumb',['secondactive' => 'active'])
@slot('heading')
   {{ __('All Subscriptions') }}
@endslot
@slot('menu1')
   {{ __('All Subscriptions') }}
@endslot




@endcomponent

<div class="contentbar">   

  <div class="row">
  
      <div class="col-lg-12">
          <div class="card m-b-30">
              <div class="card-header">
               
                    <h5 class="card-title"> {{__("All Subscriptions")}}</h5>
                 
                 
                 
                  
              </div>
              
              <div class="card-body">
               
                  <div class="table-responsive">
                    <table id="subs_list" class="table table-bordered">
                        <thead>
                            <th>
                                #
                            </th>
                            <th>
                                Plan name
                            </th>
                            <th>
                                Transcation ID
                            </th>
                            <th>
                                Method
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                User
                            </th>
                            <th>
                                Start date
                            </th>
                            <th>
                                End date
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
            ajax: '{{ route("seller.subs.listofsubs") }}',
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
                    data: 'plan_name',
                    name: 'plan.name'
                },
                {
                    data: 'txn_id',
                    name: 'seller_subscriptions.txn_id'
                },
                {
                    data: 'method',
                    name: 'seller_subscriptions.method'
                },
                {
                    data: 'amount',
                    name: 'seller_subscriptions.paid_amount'
                },
                {
                    data: 'user',
                    name: 'user.name'
                },
                {
                    data: 'start_date',
                    name: 'seller_subscriptions.start_date'
                },
                {
                    data: 'end_date',
                    name: 'seller_subscriptions.end_date'
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
                    
    
                  
          
                  
    
    
          
                  
    
    
                  
                  
                
    
                
                                      


          

            
          
              




            

            
            
            
  
                 
  
               
  
          
    
             
            

          


