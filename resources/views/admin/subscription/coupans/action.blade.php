<div class="dropdown">
  <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
  <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton3">
    
    
      <a class="dropdown-item"  title="Edit Voucher" @if(env('DEMO_LOCK')==0) href="{{ route('subscription-vouchers.edit',$id) }}" @else
      disabled="disabled" title="This operation is disabled in Demo !" @endif><i class="feather icon-edit mr-2"></i>{{ __("Edit")}}</a>
  

  
      <a class="dropdown-item" title="Delete ?" @if(env('DEMO_LOCK')==0) data-toggle="modal" data-target="#delete{{ $id }}" @else
      disabled="disabled" title="This operation is disabled in Demo !" @endif><i class="feather icon-delete mr-2"></i>{{ __("Delete")}}</a>
     
    </div>
</div>





<div id="delete{{ $id }}" class="delete-modal modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="delete-icon"></div>
      </div>
      <div class="modal-body text-center">
        <h4 class="modal-heading">Are You Sure ?</h4>
        <p>Do you really want to delete this subscription? This process cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <form method="post" action="{{ route('subscription-vouchers.destroy',$id) }}" class="pull-right">
            
            @csrf
            @method('DELETE')

          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>