<div class="dropdown">
    <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
    <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
        
        <a class="dropdown-item" href="{{ route('seller.subs.plans.edit',$unique_id) }}"><i class="feather icon-edit mr-2"></i>Edit</a>
        <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete1{{ $unique_id }}" ><i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>                               
      </div>
</div>
<!-- delete Modal start -->

<div class="modal fade bd-example-modal-sm" id="delete1{{ $unique_id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleSmallModalLabel">Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <h4 class="modal-heading">Are You Sure ?</h4>
              <p>Do you really want to delete this plan <b>{{ $name }}</b> ? By clicking <b>YES</b> subscriptions if any related to this plans also will be deleted ! This process cannot be undone.</p>
          </div>
          <div class="modal-footer">
              <form method="post" action="{{ route('seller.subs.plans.destroy',$unique_id) }}" class="pull-right">
              @csrf
            @method('DELETE')
                  <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-primary">Yes</button>
              </form>
          </div>
      </div>
  </div>
</div>

<!-- delete Model ended -->