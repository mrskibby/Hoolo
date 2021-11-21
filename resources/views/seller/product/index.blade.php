
@extends("admin.layouts.sellermaster")
@section('title','All Products |')
@section('body')

@component('seller.components.breadcumb',['secondactive' => 'active'])
@slot('heading')
   {{ __('All Products') }}
@endslot
@slot('menu1')
   {{ __('All Products') }}
@endslot


@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
    @if(env('ENABLE_SELLER_SUBS_SYSTEM') == 1)

 
    @if(getPlanStatus() == 1 && ((auth()->user()->products()->count() + auth()->user()->store->simple_products->count()) + auth()->user()->store->simple_products->count()) < auth()->user()->activeSubscription->plan->product_create)
     
     <div class="form-inline pull-right">
       @if(auth()->user()->activeSubscription->plan->csv_product == 1)
       <a title="Import products" href="{{ route('seller.import.product') }}" class="btn btn-success-rgba mr-2"><i class="feather icon-download mr-1"></i> Import Products</a>
       @endif
       
       <a href="{{ url('seller/products/create') }}" class="btn btn-primary-rgba mr-2"><i class="feather icon-plus mr-2"></i>Add Product</a>
     </div>
     

     @endif

   @else

   
   <div class="form-inline pull-right">
     <a title="Import products" href="{{ route('seller.import.product') }}" class="btn btn-success-rgba mr-2"><i class="feather icon-download mr-1"></i> Import Products</a>
     <a href="{{ url('seller/products/create') }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>  Add Product</a>
   </div>

   @endif

   <a href="{{ route("trash.variant.products") }}" class="btn btn-danger-rgba mr-2">
     <i class="feather icon-trash-2 mr-1"></i> {{__("Trash") }}
   </a>

  </div>
</div>
@endslot

@endcomponent

<div class="contentbar">   
             
  <!-- Start row -->
  <div class="row">
  
      <div class="col-lg-12">
          <div class="card m-b-30">
              <div class="card-header">
                  <h5 class="card-title">{{ __('All Products')}}</h5>
              </div>
              
              <div class="card-body">
                <form id="bulk_delete_form" method="POST" action="{{ route('seller.pro.bulk.delete') }}" class="pull-left form-inline">
                  @csrf
                  
                  <div class="form-group ml-2 mb-2">
                    <select required name="action" id="action" class="form-control">
                      <option value="">Please select action</option>
                      <option value="deleted">Delete selected</option>
                      <option value="deactivated">Deactive selected</option>
                      <option value="activated">Active selected</option>
                    </select>
                    <button type="submit" class="btn btn-secondary ml-2">Apply</button>
                  </div>
                  
                 
        
                  
                </form>
                  <div class="table-responsive">
                      <table id="sellerproductTable" class="table table-striped table-bordered">
                        <thead>
                          <th>
                            <div class="inline">
                              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all"/>
                              <label for="checkboxAll" class="material-checkbox"></label>
                            </div>
                          
                          </th>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Image
                          </th>
          
                          <th>
                            Product Detail
                          </th>
          
                          <th>
                            Price ({{ $defCurrency->currency->code }})
                          </th>
          
                          <th>
                            Categories & More
                          </th>
          
                          <th>
                            Status
                          </th>
                          <th>
                            Add / Update on
                          </th>
          
                          <th>
                            Actions
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

      var table = $('#sellerproductTable').DataTable({
          processing: true,
          serverSide: true,
          searching: true,
          stateSave: true,
          ajax: "{{ route('my.products.index') }}",
          columns: [
              
              {data : 'checkbox', name : 'checkbox', searchable : false,orderable : false},
              {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable : false, orderable : false},
              {data : 'image', name : 'image',searchable : false, orderable : false},
              {data : 'name', name : 'products.name'},
              {data : 'price', name : 'price'},
              {data : 'catdtl', name : 'category.title'},
              {data : 'status', name : 'products.status',searchable : false},
              {data : 'created_at', name : 'products.created_at'},
              {data : 'action', name : 'action', searchable : false,orderable : false}
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print','colvis'
          ],
          order : [
            [7,'DESC']
          ]
      });
      
  });

  

   $('#sellerproductTable').on('click', '.ptl', function (e) { 
        var id = $(this).data('proid');
        
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type : 'POST',
          data : { productid : $(this).data('proid') },
          datatype : 'html',
          url  : '{{ route('add.price.product') }}',
          success : function(response){
              $('#priceDetail'+id).modal('show');
              $('#pricecontent'+id).html('');
              $('#pricecontent'+id).html(response.body);
          }
      });

    });
    
</script>
@endsection                  
                  
                    
    
                  
          
                  
    
    
          
                  
    
    
                  
                  
                
    
                
                                      


          

            
          
              




            

            
            
            
  
                 
  
               
  
          
    
             
            

          


