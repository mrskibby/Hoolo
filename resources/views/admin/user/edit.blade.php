@extends('admin.layouts.master-soyuz')
@section('title',"Edit User - $user->name |")
@section('body')
 
@component('admin.component.breadcumb',['secondactive' => 'active'])
@slot('heading')
   {{ __('Edit User') }}
@endslot
@slot('menu1')
   {{ __('Edit User') }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
    <a href="{{route('users.index')}}" class="btn btn-primary-rgba"><i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>

  </div>
</div>
@endslot


@endcomponent

<div class="contentbar">
  @if ($errors->any())  
  <div class="alert alert-danger" role="alert">
  @foreach($errors->all() as $error)     
  <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true" style="color:red;">&times;</span></button></p>
      @endforeach  
  </div>
  @endif
                          
                        
  <div class="row">
    <div class="col-lg-9">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="card-title">{{ __('Edit Profile') }}</h5>
        </div>
        <div class="card-body">
          <form method="post" enctype="multipart/form-data" action="{{url('admin/users/'.$user->id)}}">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="row">
      
              <div class="col-md-6">
                <div class="form-group">
                  <label>Username: <span class="required">*</span></label>
                  <input type="text" class="form-control" placeholder="Enter username" name="name" value="{{$user->name}}">
                  <small class="text-muted"><i class="fa fa-question-circle"></i> It will display the username eg.
                    John</small>
                </div>
              </div>
      
              <div class="col-md-6">
                <div class="form-group">
                  <label>Useremail: <span class="required">*</span></label>
                  <input placeholder="Please enter email" type="email" name="email" value="{{$user->email}} "
                    class="form-control">
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Enter valid email address with @
                    symbol</small>
                </div>
              </div>
      
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    Mobile: <span class="required">*</span>
                  </label>
                  <div class="row no-gutter">
                    <div class="col-md-12">
                      <div class="input-group">
                
                        <input required pattern="[0-9]+" title="Invalid mobile no." placeholder="1" type="text"
                          name="phonecode" value="{{$user->phonecode}}" class="col-md-2 form-control">
                          <input required pattern="[0-9]+" title="Invalid mobile no." placeholder="Please enter mobile no." type="text"
                            name="mobile" value="{{$user->mobile}}" class="col-md-10 form-control">
                         
                        </div>
                        <small class="pull-right text-muted"><i class="fa fa-question-circle"></i> Enter valid mobile no. eg.
                          7894561230</small>
                     </div>
                  </div>
                        
                  </div>
                </div>
                        
             
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone:</label>
                  <input pattern="[0-9]+" title="Invalid Phone no." placeholder="Please enter phone no." type="text"
                    name="phone" value="{{$user->phone}}" class="form-control">
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Enter valid phone no. eg.
                    0141-123456</small>
                </div>
              </div>
      
              <div class="col-md-4">
                <div class="form-group">
      
                  <label>
                    Country:
                  </label>
      
                  <select data-placeholder="Please select country" name="country_id" class="form-control select2" id="country_id">
                    
                    <option value="">Please Choose</option>
                    @foreach($country as $c)
                           
                      <option {{ $user->country_id ==  $c->id ? "selected" : "" }} value="{{$c->id}}" >
                        {{$c->nicename}}
                      </option>
      
                    @endforeach
                  </select>
      
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Please select country</small>
      
                </div>
              </div>
      
              <div class="col-md-4">
                <div class="form-group">
                  <label>
                    State:
                  </label>
      
                  <select data-placeholder="Please select state" required name="state_id" class="form-control select2" id="upload_id">
                    <option value="">Please choose</option>
                    @foreach($states as $c)
                    <option value="{{$c->id}}" {{ $c->id == $user->state_id ? 'selected="selected"' : '' }}>
                      {{$c->name}}
                    </option>
                    @endforeach
                  </select>
      
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Please select state</small>
      
                </div>
              </div>
      
              <div class="col-md-4">
                <div class="form-group">
                  <label for="first-name">
                    City:
                  </label>
                  <select data-placeholder="Please select city" name="city_id" id="city_id" class="form-control select2">
                    <option value="">Please Choose</option>
                    @foreach($citys as $c)
                    <option value="{{$c->id}}" {{ $c->id == $user->city_id ? 'selected' : '' }}>
                      {{$c->name}}
                    </option>
                    @endforeach
                  </select>
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Please select city</small>
                </div>
              </div>
      
      
              <div class="col-md-6">
                <div class="form-group">
                  <label>Website:</label>
                  <input placeholder="http://" type="text" id="first-name" name="website" value="{{$user->website}}"
                    class="form-control">
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Optional field ( You can leave it blank
                    )</small>
                </div>
              </div>
      
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    User Role: <span class="required">*</span>
                  </label>
                  <select name="role" class="form-control select2">
                    @foreach($roles as $role)
                      <option {{ $user->getRoleNames()->contains($role->name) ? 'selected' : "" }}  value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Select user type eg. (Admin,Seller or
                    Customer)</small>
                </div>
              </div>
      
              <div class="col-md-6">
                <label for="first-name">Choose Image:</label>
                <div class="input-group ">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    
                  </div>
                  
                </div>
                <small class="text-muted"><i class="fa fa-question-circle"></i> Please select user profile picture</small>
               
                
              </div>
      
              
      
              @if(env('ENABLE_SELLER_SUBS_SYSTEM') == 1)
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Select seller plan:</label>
                    <select name="seller_plan" class="form-control select2" data-placeholder="Please select plan" >
                      <option value="">Please select seller plan</option>
                      @foreach ($plans as $plan)
                          <option {{ $user->activeSubscription && $user->activeSubscription->plan->id == $plan->id ? "selected" : "" }} value="{{ $plan->id }}"> {{ $plan->name }} ({{ $defCurrency->currency->symbol.$plan->price }})</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              @endif
      
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status:</label><br>
                  <label class="switch">
                    <input class="slider" type="checkbox" <?php echo ($user->status=='1')?'checked':'' ?> id="toggle-event3">
                    <span class="knob"></span>
                  </label><br>
                  <input type="hidden" name="status" value="{{$user->status}}" id="status3">
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Please select user status</small>
                </div>
              </div>
            
            
      
              @if($wallet_system == 1 )
              @if(isset($user->wallet))
              <div class="col-md-3">
                <div class="form-group">

                  <label>Wallet:</label>
                  <label>Status:</label><br>
                  <label class="switch">
                    <input class="slider" name="wallet_status" type="checkbox"<?php echo ($user->wallet->status=='1')?'checked':'' ?> id="wallet">
                    <span class="knob"></span>
                  </label><br>
                 
                  <small class="text-muted"><i class="fa fa-question-circle"></i> Please select wallet status</small>
                </div>
              </div>
              @endif
              @endif
      
              <div class="col-md-12 form-group">
      
                <h6>
                  <label><input type="checkbox" name="is_pass_change" class="is_pass_change" /> {{__("Change password ?")}}</label>
                </h6>
               
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="eyeCy">
                        <label for="password">Enter Password:</label>
                        <input disabled id="password" type="password" class="passwordbox form-control" placeholder="Enter password"
                          name="password" />
      
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                      </div>
                    </div>
      
                  </div>
      
      
                  <div class="col-md-6">
      
                    <div class="form-group">
                      <div class="eyeCy">
                        <label for="confirm">Confirm Password:</label>
                        <input disabled id="confirm_password" type="password" class="passwordbox form-control"
                          placeholder="Re-enter password for confirmation" name="password_confirmation" />
      
                        <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                      </div>
      
                      <span class="required">{{$errors->first('password_confirmation')}}</span>
                    </div>
      
      
      
      
                  </div>
      
      
      
                </div>
              </div>
      
            </div>


            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
            <button @if(env('DEMO_LOCK')==0) type="submit" title="Click to save user details" @else
              title="This action is disabled in demo !" disabled="disabled" @endif  class="btn btn-primary"><i class="fa fa-check-circle"></i>
            {{ __("Update")}}</button>
            
           
            
          </form>
        </div>
      </div>
    </div>
  
      <div class="col-lg-3">
        <div class="card m-b-30">
          <div class="user-slider">
            <div class="user-slider-item">
                <div class="card-body text-center">
                  <span>
                    @if($user->image !="")
                    <img title="{{ $user->name }}" id="preview1" src="{{url('images/user/'.$user->image)}}" class="img-circle rounded mx-auto d-block">
                    @else
                    <img id="preview1" class="img-circle rounded mx-auto d-block" title="{{ $user->name }}"
                      src="{{ Avatar::create($user->name)->toBase64() }}" />
                    @endif
                  </span>
                    <h5 class="mt-2">{{ $user->name }}</h5>
                    <p>{{ $user->store['name'] ?? '' }}</p>
                    <p> <i class="feather icon-map-pin"></i> @if(!isset($user->country))
                      {{__("Location not updated")}}
                    @else
                     {{ isset($user->city) ? $user->city->name : "" }}
                     {{ isset($user->state) ? $user->state->name : "" }}
                     {{ isset($user->country) ? $user->country->nicename : "" }}
                    @endif
                   </p>

                    
                </div>
                <div class="card-footer text-center">
                    <div class="row">
                        <div class="col-6 border-right">
                            <h5>{{ count($user->products) }}</h5>
                            <p class="my-2">TOTAL PRODUCTS</p>
                        </div>
                        <div class="col-6">
                            <h5>{{ $user->purchaseorder->count() }}</h5>
                            <p class="my-2">TOTAL PURCHASE</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
                  
               
  
  @endsection
  @section('custom-script')
      <script src="{{ url("js/ajaxlocationlist.js") }}"></script>
  @endsection
                 
  
               
  
          
              
              
             
              
             
            
                
              
    
                 
                

                
    
            
            
    
             
            
          





                                
 


