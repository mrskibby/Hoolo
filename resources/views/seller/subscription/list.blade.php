@extends('admin.layouts.sellermastersoyuz')
@section('title', 'My Subscriptions | ')
@section('body')

@component('seller.components.breadcumb',['secondactive' => 'active'])
@slot('heading')
   {{ __('My Subscriptions') }}
@endslot
@slot('menu1')
   {{ __('My Subscriptions') }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
    <a href="{{ url('/seller/plans') }}" class="btn btn-primary-rgba">
        <i class="feather icon-credit-card mr-2"></i> {{ __("Upgrade Plan")}}
     </a>
    </div>
</div>
  
@endslot


@endcomponent

<div class="contentbar">   
    @if ($errors->any())  
    <div class="alert alert-danger" role="alert">
    @foreach($errors->all() as $error)     
    <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="color:red;">&times;</span></button></p>
        @endforeach  
    </div>
    @endif             
    <!-- Start row -->
    <div class="row">
    
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">{{ __('My Subscriptions')}}</h5>
                </div>
                <div class="card-body">
                 
                    <div class="table-responsive">
                        <table id="datatable-button" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                              
                                <th>
                                    #
                                </th>
                                <th>
                                    {{__("Plan name")}}
                                </th>
                                <th>
                                    {{__("Amount")}}
                                </th>
                                <th>
                                    {{__("Transcation ID")}}
                                </th>
                                <th>
                                    {{__("Start date")}}
                                </th>
                                <th>
                                    {{__("End date")}}
                                </th>
                                <th>
                                    {{__("Status")}}
                                </th>
                           
                            </tr>
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
        var table = $('#datatable-button').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("seller.my.subscriptions") }}',
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
                    data: 'name',
                    name: 'plan.name'
                },
                {
                    data: 'amount',
                    name: 'seller_subscriptions.paid_amount'
                },
                {
                    data: 'txn_id',
                    name: 'seller_subscriptions.txn_id'
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
            ],
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            order: [
                [4, 'DESC']
            ]
        });

    });
</script>
@endsection
                 
  
               
  
          
              
              
             
              
             
            
                
              
    
                 
                

                
    
            
            
    
             
            
          





                                
 


