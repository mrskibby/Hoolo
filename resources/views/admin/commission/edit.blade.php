@extends('admin.layouts.master-soyuz')
@section('title','Edit Commision')
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Home') }}
@endslot

@slot('menu1')
{{ __("Commision") }}
@endslot

@slot('menu2')
{{ __("Edit Commision") }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">

  <a href="{{url('admin/commission/')}}" class="btn btn-primary-rgba mr-2"><i
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
          <h5 class="box-title">Edit Commision</h5>
        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/commission/'.$commission->id)}}" data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{ method_field('PUT') }}
          <div class="form-group">
            <label class="control-label" for="first-name">
              Category <span class="required">*</span>
            </label>
           
              <select name="category_id" class="form-control select2 col-md-12" id="country_id">
              <option value="0">Please Choose</option>
                @foreach($category as $cat)
               <option value="{{$cat->id}}" {{ $commission->category_id == $cat->id ? 'selected="selected"' : '' }}>
                  {{$cat->title}}
                </option>
                @endforeach
              </select>
              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Choose Category)</small>

          
          </div>
          <div class="form-group">
            <label class="control-label" for="first-name">
              Rate <span class="required">*</span>
            </label>
            
          
              <input placeholder="Please enter commission rate" type="text" id="first-name" name="rate" value="{{$commission->rate}}" class="form-control col-md-12">
              
         
          </div>
          <div class="form-group">
            <label class="control-label" for="first-name">
              Type <span class="required">*</span>
            </label>
            
           
              <select name="type" class="form-control select2 col-md-12">
                <option value="p" <?php echo ($commission->type=='p')?'selected':'' ?>>Percentage</option>
                <option value="f" <?php echo ($commission->type=='f')?'selected':'' ?>>Fix Amount</option>
              </select>
              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Choose Type)</small>

           
          </div>
           <div class="form-group">
            <label class="control-label" for="first-name">
              Status <span class="required">*</span>
            </label>
            <br>
             <label class="switch">
              <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33" {{$commission->status ==1 ? "checked" : ""}} >
              <span class="knob"></span>
              <input type="hidden" name="status" value="{{ $commission->status }}" id="status3">

            </label>
            <br>
            <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Choose Image for blog post)</small>
            </div>
    
          
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
