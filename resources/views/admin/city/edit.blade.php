@extends('admin.layouts.master-soyuz')
@section('title','Edit City')
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Home') }}
@endslot

@slot('menu1')
{{ __("City") }}
@endslot

@slot('menu2')
{{ __("Edit City") }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">

  <a href="{{url('admin/city')}}" class="btn btn-primary mr-2"><i
      class="feather icon-arrow-left mr-2"></i>Back</a>
</div>
</div>
@endslot
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
          <h5 class="box-title">Edit City</h5>
        </div>
        <div class="card-body ml-2">
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/city/'.$city->id)}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
        {{ method_field('PUT') }}
          <div class="form-group">
            <label class="control-label col-md-12" for="first-name">
              City <span class="required">*</span>
            </label>
            <div class="col-md-12">
              <input type="text" id="first-name" name="city_name" value=" {{$city->city_name}} " class="form-control select2  col-md-12">
            <p class="txt-desc">Please Enter City </p>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-md-12" for="first-name">
              State
            </label>
            <div class="col-md-12">
              <select name="state_id" class="form-control select2 col-md-12">
              
                @foreach($state as $states)
                    <option value="{{$states->id}}">{{$states->state}}</option>
                @endforeach
              </select>
              <p class="txt-desc">Please Chooce State </p>
            </div>
          </div>
          <div class="box-footer">
            <div class="form-group">
              <button @if(env('DEMO_LOCK')==0) type="reset"  @else disabled title="This operation is disabled is demo !" @endif  class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
              <button @if(env('DEMO_LOCK')==0)  type="submit" @else disabled title="This operation is disabled is demo !" @endif  class="btn btn-primary"><i class="fa fa-check-circle"></i>
                  Update</button>
          </div>
          <div class="clear-both"></div>
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
