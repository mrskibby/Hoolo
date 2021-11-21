@extends('admin.layouts.master-soyuz')
@section('title',"Create New Store |")
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])
@slot('heading')
   {{ __('Create New Store') }}
@endslot

@slot('menu1')
   {{ __('Store') }}
@endslot
@slot('menu2')
   {{ __('Create New Store') }}
@endslot


@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
    <a href=" {{url('admin/stores')}} " class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>

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
          <h5>{{ __('Add Store') }}</h5>
        </div>
        <div class="card-body">
          <form action="{{route('stores.store')}}" class="form" method="POST" novalidate enctype="multipart/form-data">
              @csrf
              <div class="row">
                    <div class="col-md-4">
                          <div class="form-group">
                              <label class="text-dark">{{ __('admin.storeOwner') }} : <span class="text-danger">*</span></label>
                                <select class="select2 form-control" name="user_id" required>
                                  <option value="">Please Choose Store Owner</option>
                                  @foreach($users as $user)
                                    <optgroup label="{{ $user->email }}">
                                    <option {{ old('user_id') == $user->id ? 'selected' : ""}} value="{{$user->id}}"> {{$user->name}}</option>
                                    </optgroup>
                                  @endforeach
                                </select>
                                <small>
                                <i class="fa fa-question-circle"></i> {{ __('admin.chooseStoreOwner') }}
                                </small>
                          </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('Store Name :') }} <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('name') }}" autofocus="" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Enter Page Name') }}" name="name" required="">
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.enterStoreName') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- email -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('Business Email :') }} <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('email') }}" autofocus="" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Please enter buisness email') }}" name="email" required="">
                            <small>
                              <i class="fa fa-question-circle"></i> {{ __('admin.storeEmail') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- VAT/GSTIN No: -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('VAT/GSTIN No :') }} </label>
                            <input type="text" value="{{ old('vat_no') }}" autofocus="" class="form-control @error('vat_no') is-invalid @enderror" placeholder="{{ __('Please enter your GSTIN/VAT No.') }}" name="vat_no">
                            <small>
                              <i class="fa fa-question-circle"></i> {{ __('admin.storeEmail') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('Phone :') }} </label>
                            <input pattern="[0-9]+" title="Invalid phone no." placeholder="Please enter phone no." type="text" id="first-name" name="phone" value="{{ old('phone') }}" class="form-control">
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.phoneno') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- Mobile -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('Mobile :') }} <span class="text-danger">*</span></label>
                            <input pattern="[0-9]+" title="Invalid mobile no." placeholder="Please enter mobile no." type="text" id="first-name" name="mobile" class="form-control" value="{{ old('mobile') }}">
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.mobileno') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- Store Address -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('Store Address :') }} <span class="text-danger">*</span></label>
                            <textarea class="form-control" required name="address" id="address" cols="30" rows="5">
                            {{ old('address') }}
                            </textarea>
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.address') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- Country -->
                    <div class="col-md-4">
                      <div class="form-group">
                          <label class="text-dark">{{ __('admin.Country') }} : <span class="text-danger">*</span></label>
                          <select data-placeholder="{{ __('admin.selectcountry') }}" name="country_id" id="country_id" class="form-control select2 col-md-7 col-xs-12">
                            <option value="0">Please Choose</option>
                            @foreach($countrys as $country)
                            <?php
                              $iso3 = $country->country;
            
                              $country_name = DB::table('allcountry')->
                              where('iso3',$iso3)->first();
            
                                ?>
                            <option {{ old('country_id') == $country_name->id ? 'selected' : "" }} value="{{$country_name->id}} ">{{ $country_name->nicename }}</option>
                            @endforeach
                          </select>
                          <small>
                            <i class="fa fa-question-circle"></i> {{ __('admin.selectcountry') }}
                          </small>
                      </div>
                    </div>
                    
                    <!-- state -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('admin.selectstate') }} : <span class="text-danger">*</span></label>
                            <select data-placeholder="{{ __('admin.selectstate') }}" required name="state_id" id="upload_id" class="select2 form-control">

                              <option value="">Please Choose</option>
                                
                            </select>
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.selectstate') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- city -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('admin.City') }} : <span class="text-danger">*</span></label>
                            <select data-placeholder="{{ __('admin.selectcity') }}" required name="city_id" id="city_id" class="select2 form-control">
                              <option value="">Please Choose</option>
                             
                            </select>
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.selectcity') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- pincode -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('admin.pincode') }} :</label>
                            <input pattern="[0-9]+" title="Invalid pincode/zipcode" placeholder="{{ __('admin.enterpincode') }}" type="text" id="first-name" name="pin_code" class="form-control" value="{{ old('pin_code') }}">
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.enterpincode') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- choosePayout -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-dark">{{ __('admin.choosePayout') }} :</label>
                            <select class="select2 form-control" name="preferd" id="preferd" required>
                              <option value="">{{ __('admin.preferPayout') }}</option>
                              <option {{ old('preferd') == 'paypal' ? 'selected' : "" }} value="paypal">{{ __('Paypal') }}</option>
                              <option {{ old('preferd') == 'paytm' ? 'selected' : "" }} value="paytm">{{ __('Paytm') }}</option>
                              <option {{ old('preferd') == 'bank' ? 'selected' : "" }} value="bank">{{ __('Bank Transfer') }}</option>
                            </select>
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.preferPayout') }}
                            </small>
                        </div>
                    </div>
                    
                    <!-- paypalemail -->
                    <div class="col-md-4">
                      <div class="form-group">
                          <label class="text-dark">{{__('admin.paypalemail')}} :</label>
                            <input value="{{ old('paypal_email') }}" type="text" class="form-control" class="form-control" name="paypal_email" placeholder="eg:seller@paypal.com">
                            <small class="text-muted">
                              <i class="fa fa-question-circle"></i> {{ __('admin.enterpaypalemail') }}
                            </small>
                      </div>
                    </div>
                    
                    <!-- AccountName -->
                    <div class="col-md-4">
                      <div class="form-group">
                          <label class="text-dark">{{ __('staticwords.AccountName') }} :</label>
                          <input class="form-control" type="text" name="account_name" value="{{ old('account_name') }}"
                          placeholder="{{ __('staticwords.PleaseEnterAccountName') }}"> <span
                          class="required">{{$errors->first('bank_name')}}</span>
                      </div>
                    </div>
                    
                    <!-- AccountNumber -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-dark">{{ __('staticwords.AccountNumber') }}</label>
                        <input class="form-control" pattern="[0-9]+" title="Invalid account no." type="text"  name="account"
                          value="{{ old('account') }}" placeholder="{{ __('staticwords.PleaseEnterAccountNumber') }}"> <span
                          class="required">{{$errors->first('account')}}</span>
                      </div>
                    </div>
                    
                    <!-- BankName -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-dark"> {{ __('staticwords.BankName') }} :</label>
                        <input class="form-control"  type="text" name="bank_name" value="{{ old('bank_name') }}"
                          placeholder="{{ __('staticwords.PleaseEnterBankName') }}"> <span
                          class="required">{{$errors->first('bank_name')}}</span>
                      </div>
                    </div>
                    
                    <!-- IFSC Code -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-dark"> {{ __('IFSC Code') }} :</label>
                        <input class="form-control"  type="text" name="ifsc" value="{{ old('ifsc') }}"
                          placeholder="{{ __('staticwords.PleaseEnterIFSCCode') }}"> <span
                          class="required">{{$errors->first('ifsc')}}</span>
                      </div>
                    </div>
                    
                    <!-- BranchAddress -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-dark">{{ __('staticwords.BranchAddress') }} : </label>
                        <input class="form-control"  type="text" id="first-name" name="branch" placeholder="Please Enter Branch Address"
                          value="{{ old('branch') }}">
                        <span class="required">{{$errors->first('branch')}}</span>
                      </div>
                    </div>
                    
                    <!-- paypalemail -->
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="text-dark"> {{__("admin.PaytmMobileNo")}} : ({{ __('admin.IndiaApplicable') }})</label>
                          <input value="{{ old('paytem_mobile') }}" type="text" class="form-control" class="form-control" name="paytem_mobile" placeholder="eg:7894561230">
                          <small class="text-muted">
                            <i class="fa fa-question-circle"></i> {{ __('admin.enterPaytmMobileNo') }}
                          </small>
                        </div>
                    </div>
                    
                    <!-- Logo -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="text-dark">{{ __('admin.Logo') }} :</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                          </div>
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" name="store_logo" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                          </div>
                        </div>
                        <small class="text-muted">
                          <i class="fa fa-question-circle"></i> {{ __('admin.selectStoreLogo') }}
                        </small>
                      </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-dark">{{ __('Status') }} </label><br>
                        <label class="switch">
                          <input class="slider" type="checkbox" name="status" checked />
                          <span class="knob"></span>
                        </label>
                        <br>
                        <small>{{ __('(Toggle the store status.)') }}</small>
                      </div>
                    </div>
                    
                    <!-- Verified Store -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-dark">{{ __('Verified Store :') }}</label><br>
                        <label class="switch">
                          <input {{ old('verified_store') ? "checked" : "" }} type="checkbox" name="verified_store">
                          <span class="knob"></span>
                        </label>
                        <br>
                        <small>{{ __('(On The Product detail page if store is verified than it will add') }} <i class="fa fa-check-circle text-green"></i> {{ __('Symbol next to the store name.)') }}</small>
                      </div>
                    </div>
                                  
                    <!-- create and close button -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                            {{ __("Create")}}</button>
                        </div>
                    </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
                        

@endsection

@section('custom-script')
<script>
  var baseUrl = "<?= url('/') ?>";
</script>
<script src="{{ url('js/ajaxlocationlist.js') }}"></script>
@endsection