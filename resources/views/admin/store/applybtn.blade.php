<form action="{{ route('store.acp.quick.update',$id) }}" method="POST">
  {{csrf_field()}}
  <button @if(env('DEMO_LOCK') == 0) type="submit" @else disabled="" title="This action is disabled in demo!" @endif class="btn btn-rounded {{ $apply_vender == 1 ? 'btn-success-rgba' : 'btn-danger-rgba' }}">
    {{ $apply_vender == 1 ? 'Yes' : 'No' }}
  </button>
</form> 