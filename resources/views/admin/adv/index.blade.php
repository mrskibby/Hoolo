@extends('admin.layouts.master-soyuz')
@section('title','Advertisements')
@section('body')
@component('admin.component.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
   {{ __('Advertisements') }}
@endslot

@slot('menu1')
   {{ __('Advertisements') }}
@endslot

@slot('button')
<div class="col-md-6">
  @can('advertisements.create')
    <div class="widgetbar">
      <a href="{{ route('adv.create') }}"  class="btn btn-primary-rgba mr-2"><i class="feather icon-plus mr-2"></i>Create New Ad</a>
        </div> 
    @endcan                       
</div>
@endslot
@endcomponent
<div class="contentbar"> 
    <div class="row">
      <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title">All Advertisements</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="adTable" class="width100 table table-bordered table-striped">
                      <thead>
          
                        <th>
                          #
                        </th>
                        <th>
                          Layout
                        </th> 
                        <th>
                            Position
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
          
                      <tbody>
                        
                      </tbody>
                   </table>
                  </div>
                </div>
            </div>
      </div>
    </div>
</div>
@endsection
@section('custom-script')
 <script>var advindexurl = "<?=route('adv.index')?>"</script>
 <script src="{{ url('js/layoutadvertise.js') }}"></script>
@endsection
