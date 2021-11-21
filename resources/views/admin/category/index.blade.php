@extends('admin.layouts.master-soyuz')
@section('title','All Categories')
@section('body')
@component('admin.component.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
   {{ __('All Categories') }}
@endslot

@slot('menu1')
   {{ __('Categories') }}
@endslot

@slot('button')

<div class="col-md-6">
    <div class="widgetbar">
        <a data-toggle="modal" data-target="#importcategories" role="button" class="btn btn-success-rgba mr-2">
          <i class="feather icon-file-text mr-2"></i> {{__("Import Categories")}}
        </a>
        <a  href="{{url('admin/category/create')}} " class="btn btn-primary-rgba mr-2">
            <i class="feather icon-plus mr-2"></i> {{__("Add Category")}}
        </a>
    </div>  
                          
</div>
@endslot
@endcomponent
<div class="contentbar"> 
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title"> All Categories</h5>
                </div>
                 <div class="card-body ml-1 mr-1">
                  <div class="row">
                    <div class="col-md-12 p-2 mb-2 bg-success text-white rounded">
                        <i class="fa fa-info-circle"></i> Note:
                        <ul>
                            <li>Drag and Drop to sort the categories</li>
                            
                        </ul>
                    </div>
                </div>
                <table id="full_detail_table" class="cattable w-100 table table-bordered table-striped">
                  <thead>
                    <tr class="table-heading-row">
                      <th>#</th>
                      <th>Category ID</th>
                      <th>Image</th>
                      <th>Detail</th>
                      <th>Icon</th>
                      <th>Status</th>
                      <th>Featured</th>
                      <th>Added/ Updated on</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($category as $key => $cat)
                    <tr class="row1" data-id="{{$cat->id}}">
                      <td>{{ ++$key }}</td>
                      <td> <b>{{ $cat->id }}</b> </td>
                      <td>
                        @if($cat->image != '' && file_exists(public_path().'/images/category/'.$cat->image) )
            
                        <img class="pro-img mr-2" align="left" src="{{url('images/category/'.$cat->image)}}"
                          title="{{ $cat->title }}">
            
                        @else
                        <img class="pro-img mr-2" align="left" title="{{ $cat->title }}"
                          src="{{ Avatar::create($cat->title)->toBase64() }}" />
            
                        @endif
                      </td>
                      <td>
                        
                        <p><b>Name: </b><span class="font-weight500">{{$cat->title}}</span></p>
                        <p><b>Description: </b><span class="text-justify font-weight500">{{substr(strip_tags($cat->description), 0, 100)}}{{strlen(strip_tags(
                           $cat->description))>100 ? '...' : ""}}</span></p>
                      </td>
            
                      <td>
                        <p class="font-size-18"><i class="fa {{$cat->icon}}"></i></p>
                      </td>
            
                      <td>
                        @can('category.edit')
                        <form method="POST" action="{{ route('cat.quick.update',$cat->id) }}">
                          {{ csrf_field() }}
                          <button @if(env('DEMO_LOCK')==0) type="submit" @else title="This operation is disabled in demo !"
                            disabled="" @endif class="btn btn-sm btn-rounded {{ $cat->status ==1 ? 'btn-success-rgba' : 'btn-danger-rgba' }}">
                            {{ $cat->status==1 ? 'Active' : 'Deactive' }}
                          </button>
                        </form>
                        @endcan
                      </td>
                      <td>
                        @can('category.edit')
                        <form method="POST" action="{{ route('cat.featured.quick.update',$cat->id) }}">
                          {{ csrf_field() }}
                          <button @if(env('DEMO_LOCK')==0) type="submit" @else title="This operation is disabled in demo !"
                            disabled="" @endif class="btn btn-sm btn-rounded {{ $cat->featured ==1 ? 'btn-success-rgba' : 'btn-danger-rgba' }}">
                            {{ $cat->featured==1 ? 'Yes' : 'No' }}
                          </button>
                        </form>
                        @endcan
                      </td>
                      <td>
                        <p> <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                          <span class="font-weight500">{{ date('M jS Y',strtotime($cat->created_at)) }}</span></p>
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i>
                          <span class="font-weight500">{{ date('h:i A',strtotime($cat->created_at)) }}</span></p>
            
                        <p class="greydashedborder"></p>
            
                        <p>
                          <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                          <span class="font-weight500">{{ date('M jS Y',strtotime($cat->updated_at)) }}</span>
                        </p>
            
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i>
                          <span class="font-weight500">{{ date('h:i A',strtotime($cat->updated_at)) }}</span></p>
            
                      </td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                          <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                            @can('category.edit')
                              <a class="dropdown-item" href="{{url('admin/category/'.$cat->id.'/edit')}}"><i class="feather icon-edit mr-2"></i>Edit</a>
                              @endcan
          
                              @can('category.delete')
                              <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ $cat->id }}" >
                                <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                            </a>
                              @endcan
                          </div>
                      </div>
                      <div class="modal fade bd-example-modal-sm" id="delete{{$cat->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleSmallModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <h4>{{ __('Are You Sure ?')}}</h4>
                                        <p>{{ __('Do you really want to delete')}}? {{ __('This process cannot be undone.')}}</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="post" action="{{url('admin/category/'.$cat->id)}}" class="pull-right">
                                        {{csrf_field()}}
                                        {{method_field("DELETE")}}
                                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                            </div>
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

<div class="modal fade" id="importcategories" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleStandardModalLabel">{{__("Bulk Import Categories")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- main content start -->
        <a href="{{ url('files/Category.xlsx') }}" class="btn btn-md btn-success"> Download Example xls/csv
          File</a>
        <hr>
        <form action="{{ url('/import/categories') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <div class="form-group col-md-12">
              <label for="file">Choose your xls/csv File :</label>
              <!-- ------------ -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01" required>
                  <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
                @if ($errors->has('file'))
                <span class="invalid-feedback text-danger" role="alert">
                  <strong>{{ $errors->first('file') }}</strong>
                </span>
                @endif
                <p></p>
              </div>
              <!-- ------------- -->
              <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Import</button>
            </div>

          </div>

        </form>

        <div class="box box-danger">
          <div class="box-header with-border">
            <div class="box-title">Instructions</div>
          </div>

          <div class="box-body">
            <p><b>Follow the instructions carefully before importing the file.</b></p>
            <p>The columns of the file should be in the following order.</p>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Column No</th>
                  <th>Column Name</th>
                  <th>Required</th>
                  <th>Description</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>1</td>
                  <td><b>name</b></td>
                  <td><b>Yes</b></td>
                  <td>Enter category name</td>
                </tr>

                <tr>
                  <td>2</td>
                  <td> <b>status</b> </td>
                  <td><b>Yes</b></td>
                  <td>Category status (1 = active, 0 = deactive)</b> .</td>
                </tr>
                

                <tr>
                  <td>3</td>
                  <td> <b>image</b> </td>
                  <td><b>No</b></td>
                  <td>Name your image eg: example.jpg <b>(Image must be already put in public/images/category/) folder )</b> .</td>
                </tr>

                <tr>
                  <td>4</td>
                  <td> <b>icon</b> </td>
                  <td><b>No</b></td>
                  <td>Icon class name eg: fa-book.</b> .</td>
                </tr>

                <tr>
                  <td>5</td>
                  <td> <b>description</b> </td>
                  <td><b>No</b></td>
                  <td><b>Description of your category.</b></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td> <b>featured</b> </td>
                  <td><b>No</b></td>
                  <td><b>Set category to be featured 1 = Yes , 0 = No.</b></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
        <!-- main content end -->
      </div>

    </div>
  </div>
</div>

<!-- /page content -->
@endsection
@section('custom-script')
<script>
  var url = {!!json_encode(url('reposition/category')) !!};
</script>
<script src="{{ url('js/category.js') }}"></script>
@endsection
