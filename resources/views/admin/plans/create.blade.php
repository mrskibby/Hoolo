@extends('admin.layouts.master-soyuz')
@section('title','Create a new plan | ')
@section('body')
​
@component('admin.component.breadcumb',['thirdactive' => 'active'])
​
@slot('heading')
{{ __('Plan') }}
@endslot
​
@slot('menu2')
{{ __("Add plan") }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
  <a href="{{ route('seller.subs.plans.index') }}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
  </div>
</div>
@endslot
​
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
​
​
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5>{{ __('Add Plan') }}</h5>
        </div>
        <div class="card-body">
          
          <!-- form start -->
          <form action="{{ route('seller.subs.plans.store') }}" class="form" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                       
                <!-- row start -->
                <div class="row">
                
                <!-- Plan Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Plan Name :') }} <span class="text-danger">*</span></label>
                        <input value="{{ old('name') }}" name="name" required type="text" class="form-control" placeholder="eg: Premium">
                    </div>
                </div>

                    <!-- Plan Price -->
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Plan Price : ') }} <span class="text-danger">*</span></label>
                       <div class="input-group">
                        <span class="input-group-text">
                            {{ $defaultCurrency->symbol }}
                        </span>
                        <input value="{{ old('price') }}" required type="number" name="price" min="1" step="0.01" class="form-control" placeholder="10">
                       </div>
                    </div>
                </div>

                    <!-- Description -->
                    <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Description') }} <span class="text-danger">*</span></label>
                        <textarea id="editor1" name="detail" class="@error('detail') is-invalid @enderror" placeholder="Please Enter Description" required="">{{ old('detail') }}</textarea>
                        @error('detail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Plan Price -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Plan validity :') }} <span class="text-danger">*</span></label>
                        <input value="{{ old('validity') }}" name="validity" min="1" required type="number" step="1" class="form-control" placeholder="eg: 1">
                        <small>
                            <i class="fa fa-question-circle"></i> Validity of your plan in numbers eg: 1 month, year, week day
                        </small>
                    </div>
                </div>

                <!-- Plan period -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Plan period :') }} <span class="text-danger">*</span></label>
                        <select required name="period" id="" class="form-control select2"
                            data-placeholder="Please select plan period">
                            <option value="">Please select plan period</option>
                            <option {{ old('period') == 'day' ? "checked" : "" }} value="day">Day</option>
                            <option {{ old('period') == 'week' ? "checked" : "" }} value="week">Week</option>
                            <option {{ old('period') == 'month' ? "checked" : "" }} value="month">Month</option>
                            <option {{ old('period') == 'year' ? "checked" : "" }} value="year">Year</option>
                        </select>
                    </div>
                </div>

                <!-- Plan Price -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark">{{ __('Product create/upload limit :') }} <span class="text-danger">*</span></label>
                        <input value="{{ old('product_create') }}" name="product_create" min="1" required type="number" step="1" class="form-control" placeholder="100">
                    </div>
                </div>

                    <!-- Status -->
                    <div class="form-group col-md-3">
                    <label class="text-dark" for="exampleInputDetails">{{ __('Enable CSV Product Upload :') }} </label><br>
                    <label class="switch">
                        <input {{ old('csv_product') ? "checked" : "" }} type="checkbox" name="csv_product" />
                        <span class="knob"></span>
                    </label>
                </div>

                <div class="form-group col-md-3">
                <div class="form-group">
                    <label class="text-dark">{{ __('Status :') }}</label>
                    <br>
                    <label class="switch">
                        <input {{ old('status') ? "checked" : ""}} type="checkbox" name="status" />
                        <span class="knob"></span>
                    </label>
                </div>
                </div>
                                
                <!-- create and close button -->
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="reset" class="btn btn-danger-rgba mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                        <button type="submit" class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                        {{ __("Create")}}</button>
                    </div>
                </div>

                </div><!-- row end -->
                                             
            </form>
            <!-- form end -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection