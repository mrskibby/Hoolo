@extends('admin.layouts.master-soyuz')
@section('title','Pincode List of '. $country->nicename.' | ')
@section('body')
@component('admin.component.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
{{ __('All Cities') }}
@endslot

@slot('menu1')
{{ __('Cities') }}
@endslot

@slot('button')
<div class="col-md-6">
  <a href="{{ route('admin.desti') }}" class="float-right btn btn-primary-rgba mr-2"><i
      class="feather icon-arrow-left mr-2"></i>Back</a>
</div>
@endslot
@endcomponent
<div class="contentbar">
  <div class="row">

    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="box-title"> All Country</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="" class="data-table table table-hover">
              <thead>
                <tr class="table-heading-row">

                  <th>ID</th>
                  <th>City </th>
                  <th>State </th>
                  <th>Pincode </th>

                </tr>
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
<script>
  var baseUrl = @json(url('/'));
</script>
<script src="{{ url('js/pincode.js') }}"></script>
<script>
  var url = @json(route('country.list.pincode', $country->id));
</script>
<script src="{{ url('js/pincode2.js') }}"></script>
@endsection