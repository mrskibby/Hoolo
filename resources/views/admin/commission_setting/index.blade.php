@extends('admin.layouts.master-soyuz')
@section('title','Commission List Per Category')
@section('body')
@component('admin.component.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
{{ __('Commission List Per Category') }}
@endslot

@slot('menu1')
{{ __('Commission') }}
@endslot


  
@endcomponent
<div class="contentbar">
  <div class="row">

    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title"> Commission</h5>
        </div>
      
          
       
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="p-1 mb-2 bg-success text-white rounded">
                <i class="fa fa-info-circle"></i> Note:
                <ul>
                  <li>If you enable commission by per category than in side menu you can see a new commission menu where you can create commission for each category and define rates too.</li>                    
                </ul>
              </div>
            </div>
        </div>
          <div class="table-responsive">
            <table id="full_detail_table" class="table table-hover table-bordered">
              <thead>
                <tr class="table-heading-row">
                  <th>ID</th>
                  <th>Rate</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($commission_settings as $key=> $commission)

                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>@if($commission->type != 'c') {{$commission->rate}}
                    {{ $commission->p_type == 'f' ? "Fix Amount" : "%" }} @else Linked to category (check rate under
                    commision menu for each category)@endif </td>
                  <td>
                    @if($commission->type == 'c')
                    {{'Category'}}
                    @elseif($commission->type == 'flat')
                    {{'Flat For All'}}
                    @endif
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                      <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                    <a title="Edit Commission setting" class="dropdown-item" href="{{url('admin/commission_setting/'.$commission->id.'/edit')}}"><i class="feather icon-edit mr-2"></i>Edit</a>
                    </div>
                  </div>
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
@endsection
 