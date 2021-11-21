@extends('admin.layouts.master-soyuz')
@section('title','Edit Subcategory | ')
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Home') }}
@endslot

@slot('menu1')
{{ __("Subcategory") }}
@endslot

@slot('menu2')
{{ __("Edit Subcategory") }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">

    <a href="{{url('admin/subcategory')}}" class="btn btn-primary-rgba mr-2"><i
        class="feather icon-arrow-left mr-2"></i>Back</a>
  </div>
</div>
@endslot
@endcomponent

<div class="contentbar">
  <div class="row">

    <div class="col-lg-12">
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span></button></p>
        @endforeach
      </div>
      @endif
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title">Edit Subcategory</h5>
        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data"
            action="{{url('admin/subcategory/'.$cat->id)}}" data-parsley-validate
            class="form-horizontal form-label-left">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="form-group">
              <label class="control-label" for="first-name">
                Parent Category: <span class="required">*</span>
              </label>

              <select name="parent_cat" class="form-control select2 col-md-12">

                @foreach($parent as $p)
                <option {{ $p['id'] == $cat->category->id ? "selected" : "" }} value="{{$p->id}}">{{$p->title}}</option>
                @endforeach
              </select>
              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Choose Parent
                Category)</small>s


            </div>
            <div class="form-group">
              <label class="control-label" for="first-name">
                Subcategory: <span class="required">*</span>
              </label>

              <input placeholder="Please enter Subcategory name" type="text" id="first-name" name="title"
                value="{{$cat->title}}" class="form-control col-md-7 col-xs-12">


            </div>
            <div class="form-group">
              <label class="control-label" for="first-name"> Description: <span class="required">*</span>
              </label>

              <textarea cols="2" id="editor1" name="description" rows="5">
              {{ucfirst($cat->description)}}
             </textarea>
              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please enter
                description)</small>s


            </div>
            <div class="form-group">
              <label class="control-label" for="first-name">
                Icon:
              </label>

              <div class="input-group">
                <input type="text" class="form-control iconvalue" name="icon" value="{{ $cat->icon }}">
                <span class="input-group-append">
                  <button type="button" class="btnicon btn btn-outline-secondary" role="iconpicker"></button>
                </span>


              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="first-name"> Image: <span class="required"></span>
              </label>

              <div class="mb-3">
                @if(@file_get_contents('images/subcategory/'.$cat->image))
                <img class="img-fluid bg-primary-rgba rounded p-3" width="100px"
                  src=" {{url('images/subcategory/'.$cat->image)}}">
                @else
                <img title="{{ $cat->title }}" src="{{ Avatar::create($cat['title'])->toBase64() }}" />
                @endif
              </div>

              <div class="input-group">

                <input required readonly id="image" name="image" type="text"
                    class="form-control">
                <div class="input-group-append">
                    <span data-input="image"
                        class="bg-primary text-light midia-toggle input-group-text">Browse</span>
                </div>
              </div>

              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please choose image)</small>


            </div>
            <div class="form-group">
              <label class="control-label" for="first-name">
                Featured:
              </label>
              <br>
              <label class="switch">
                <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33"
                  {{$cat->featured ==1 ? "checked" : ""}}>
                <span class="knob"></span>
                <input type="hidden" name="featured" value="{{ $cat->featured }}" id="status3">

              </label>
              <br>
              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(If enabled than Subcategory
                will be Featured)</small>s

            </div>
            <div class="form-group">
              <label class="control-label" for="first-name">
                Status:<span class="required">*</span>
              </label>
              <br>
              <label class="switch">
                <input class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33"
                  {{$cat->status ==1 ? "checked" : ""}}>
                <span class="knob"></span>
                <input type="hidden" name="status" value="{{ $cat->status }}" id="status3">

              </label>
              <br>
              <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please choose status)</small>


            </div>
            <div class="form-group">
              <button @if(env('DEMO_LOCK')==0) type="reset" @else disabled title="This operation is disabled is demo !"
                @endif class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
              <button @if(env('DEMO_LOCK')==0) type="submit" @else disabled title="This operation is disabled is demo !"
                @endif class="btn btn-primary"><i class="fa fa-check-circle"></i>
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
@section('custom-script')
<script>
  $(".midia-toggle").midia({
    base_url: '{{ url('') }}',
    directory_name: 'subcategory'
  });
</script>
@endsection