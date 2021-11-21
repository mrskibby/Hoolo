@extends('admin.layouts.master-soyuz')
@section('title','Edit Mail Settings')
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Home') }}
@endslot

@slot('menu1')
{{ __("Mail Settings") }}
@endslot

@slot('menu2')
{{ __("Mail Settings") }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">
    <a title="Click to know more" href="#help" data-toggle="modal" class="btn btn-primary-rgba mr-2">
      <i class="feather icon-help-circle mr-2"></i> Help
    </a>
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
          <h5 class="box-title">{{ __('Edit') }} {{ __('Mail Settings') }}</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('mail.update') }}" method="POST">
            {{ csrf_field() }}
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="MAIL_FROM_NAME">Sender Name:</label>
                  <input type="text" placeholder="Enter sender name" name="MAIL_FROM_NAME"
                    value="{{ $env_files['MAIL_FROM_NAME'] }}" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"><label for="MAIL_DRIVER">Mail Driver: (ex. smtp,sendmail,mail)</label>
                  <input type="text" name="MAIL_DRIVER" value="{{ $env_files['MAIL_DRIVER'] }}" class="form-control">
                </div>
              </div>

              <div class=" col-md-6">
                <div class="form-group">
                  <label for="MAIL_DRIVER">Mail Address: (ex. user@info.com)</label>
                  <input type="text" name="MAIL_FROM_ADDRESS" value="{{ $env_files['MAIL_FROM_ADDRESS'] }}"
                    class="form-control">
                </div>
              </div>

              <div class=" col-md-6">
                <div class="form-group">
                  <label for="MAIL_HOST">Mail Host: (ex. smtp.gmail.com)</label>
                  <input placeholder="Enter mail host" type="text" name="MAIL_HOST"
                    value="{{ $env_files['MAIL_HOST'] }}" class="form-control">
                </div>
              </div>

              <div class=" col-md-6">
                <div class="form-group">
                  <label for="MAIL_PORT">Mail PORT: (ex. 467,587,2525) </label>
                  <input type="text" placeholder="Enter mail port" name="MAIL_PORT"
                    value="{{ $env_files['MAIL_PORT'] }}" class="form-control">
                </div>
              </div>

              <div class=" col-md-6">
                <div class="form-group">
                  <label for="MAIL_USERNAME">Mail Username: (info@gmail.com)</label>
                  <input placeholder="Enter mail Username" type="text" name="MAIL_USERNAME"
                    value="{{ $env_files['MAIL_USERNAME'] }}" class="form-control">
                </div>
              </div>

              <div class=" col-md-6">
                <div class="eyeCy">
                  <label for="MAIL_PASSWORD">Mail Password:</label>
                  <input type="password" value="{{ $env_files['MAIL_PASSWORD'] }}" name="MAIL_PASSWORD"
                    id="password-field" type="password" placeholder="Please Enter Mail Password" class="form-control">
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>


              </div>

              

              <div class="col-md-6">
                <div class="form-group">
                  <label for="MAIL_ENCRYPTION">Mail Encryption: (ex. TLS,SSL,OR Leave blank)</label>
                  <input placeholder="Enter mail encryption" type="text" value="{{ $env_files['MAIL_ENCRYPTION'] }}"
                    name="MAIL_ENCRYPTION" class="form-control">
                </div>

              </div>


            </div>
            <div class="form-group">
              <button @if(env('DEMO_LOCK')==0) type="submit" @else disabled title="This operation is disabled is demo !"
                @endif class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                Update</button>
              <a href="{{ url('admin/maileditor') }}" class="btn btn-info-rgba">
                <i class="feather icon-settings mr-2"></i> {{__("Configure Mail Templates")}}
              </a>
            </div>



          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Help ?</h4>
        <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <p>For Mail Detail Section: Enter the name with no spaces. Their are three Mail Drivers: <b>SMTP, Mail,
            sendmail, if SMTP is not working then check sendmail.</b></p>

        <blockquote>
          <ul>
            <li>Gmail SMTP setup settings:</li>
            <li>SMTP username: Your Gmail address.</li>
            <li>SMTP password: Your Gmail password. If Using Gmail then Use App Password. <a
                href="https://support.google.com/accounts/answer/185833?hl=en">Process of App Password</a>.</li>
            <li>SMTP server address: smtp.gmail.com.</li>
            <li>Gmail SMTP port (TLS): 587.</li>
            <li>SMTP port (SSL): 465.</li>
            <li>SMTP TLS/SSL required: yes.</li>
          </ul>

        </blockquote>

      </div>

    </div>
  </div>
</div>
@endsection