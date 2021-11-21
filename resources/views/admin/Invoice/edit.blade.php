@extends('admin.layouts.master-soyuz')
@section('title','Edit Invoice Setting')
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Home') }}
@endslot

@slot('menu1')
{{ __("Invoice Setting") }}
@endslot

@slot('menu2')
{{ __("Invoice Setting") }}
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
          <h5 class="box-title">{{ __('Edit') }} {{ __('Invoice Setting') }}</h5>
        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data" action="{{url('admin/invoice/')}}"
            data-parsley-validate class="form-horizontal form-label-left">
            {{csrf_field()}}

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    Order Prefix:
                  </label>

                  <input type="text" name="order_prefix" value="{{$Invoice->order_prefix ?? ''}}"
                    class="form-control col-md-12">
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Enter Order
                    Prefix)</small>

                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    Invoice Prefix:
                  </label>


                  <input type="text" id="first-name" name="prefix" value="{{$Invoice->prefix ?? ''}}"
                    class="form-control col-md-12">
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Enter
                    Prefix)</small>

                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    Invoice Postfix:
                  </label>


                  <input type="text" id="first-name" name="postfix" value="{{$Invoice->postfix ?? ''}}"
                    class="form-control col-md-12">
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Enter
                    Postfix)</small>

                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    Invoice No. Start From:
                  </label>


                  <input type="text" id="first-name" name="inv_start" value="{{$Invoice->inv_start ?? ''}}"
                    class="form-control col-md-12">
                  <br>

                </div>
              </div>

              <div class="col-md-12  p-3 mb-2 bg-info-rgba rounded text-info">
                <i class="fa fa-info-circle mr-1"></i>Note
                <ul>
                  <li> Invoice No. is That Like From Where you want to Start Your Invoice No.</li>
                  <li>If your <b>Prefix:</b> ABC, <b>Postfix:</b> XYZ or <b>Invoice No. Start From
                      :</b> 001</li>
                  <li>Than your first Invoice no. will be:
                    <b>ABC001XYZ</b>
                    <br>
                  </li>
                </ul>

              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    COD Prefix:
                  </label>


                  <input type="text" id="first-name" name="cod_prefix" value="{{$Invoice->cod_prefix ?? ''}}"
                    class="form-control col-md-12">
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Enter COD
                    Prefix)</small>


                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    COD Postfix:
                  </label>


                  <input type="text" id="first-name" name="cod_postfix" value="{{$Invoice->cod_postfix ?? ''}}"
                    class="form-control col-md-12">
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Please Enter COD
                    Prefix)</small>


                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    Terms:
                  </label>


                  <textarea name="terms" class="editor form-control" rows="5"
                    cols="30">{!!$Invoice->terms ?? ''!!}</textarea>
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(Enter terms which display
                    on
                    invoice bottom)</small>


                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="first-name">
                    Seal:
                  </label>


                  <div class="input-group mb-3">

                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>


                    <div class="custom-file">

                      <input type="file" name="seal" class="inputfile inputfile-1" id="first-name"
                        aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                  </div>
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(It will display on
                    Invoice at
                    bottom right)</small>

                </div>
              </div>

              <div class="col-md-6">
                <div class="well">
                  @php
                  $seal = @file_get_contents(public_path().'/images/seal/'.$Invoice->seal);
                  @endphp
                  @if($seal)
                  <p><b>Preview:</b></p>
                  <img class="bg-primary-rgba pro-img" src="{{ url('images/seal/'.$Invoice->seal) }}"
                    title="Current Seal" alt="{{ $Invoice->seal }}" />
                  @else
                  <p>No Image Found !</p>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-12" for="first-name">
                    Sign:
                  </label>
                  <div class="input-group mb-3">
  
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
  
  
                    <div class="custom-file">
  
                      <input type="file" name="sign" class="inputfile inputfile-1" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                  </div>
                  <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>(It will display on Invoice
                    at
                    bottom left)</small>
  
                </div>
              </div>
  
              <div class="col-md-6">
                <div class="well">
                  @php
                  $sign = @file_get_contents(public_path().'/images/sign/'.$Invoice->sign);
                  @endphp
                  @if($sign)
                  <p><b>Preview:</b></p>
                  <img class="pro-img" src="{{ url('images/sign/'.$Invoice->sign) }}" title="Current Seal"
                    alt="{{ $Invoice->sign }}" />
                  @else
                  <p>No Image Found !</p>
                  @endif
                </div>
              </div>
  

            </div>


        </div>

        <div class="ln_solid"></div>
        <div class="form-group col-md-12">
          <button @if(env('DEMO_LOCK')==0) type="reset" @else disabled title="This operation is disabled is demo !"
            @endif class="btn btn-danger-rgba"><i class="fa fa-ban"></i> Reset</button>
          <button @if(env('DEMO_LOCK')==0) type="submit" @else disabled title="This operation is disabled is demo !"
            @endif class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
            Update</button>
        </div>
        <div class="clear-both"></div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection