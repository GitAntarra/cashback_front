@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users Edit')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

@section('content')
<!-- users edit start -->
<section class="users-edit">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <?php $data = (object) $detail_user;?>
        <ul class="nav nav-tabs mb-2" role="tablist">
          <li class="nav-item">
              <a class="d-flex align-items-center active" id="account-tab" data-toggle="tab"
                   aria-controls="account" role="tab" aria-selected="true">
                  <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Edit User</span>
              </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
            <!-- users edit media object start -->
            <div class="media mb-2">
                <a class="mr-2" href="#">
                    <img src="{{$data->foto}}" alt="users avatar"
                        class="users-avatar-shadow rounded-circle" height="64" width="64">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$data->name}}</h4>
                    <div class="col-12 px-0 d-flex">
                        <span class="d-none d-sm-block">PN : {{$data->pernr}}</span>
                    </div>
                </div>
            </div>
            <!-- users edit media object ends -->
            <!-- users edit account form start -->
            <form class="form_input" action="{{route('edituser.post')}}" method="post" id="input_form">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-6">
                    <div class="form-group" hidden>
                            <div class="controls">
                                <label>Unit Work</label>
                                <input type="text" value="{{$data->id}}" name="id" id="id" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <label>Unit Work</label>
                                <input type="text" value="{{$data->uker}}" name="ukerdesc" id="ukerdesc" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Region Code</label>
                            <input type="text" value="{{$data->region}}" name="region_code" id="region_code" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Regional Name</label>
                            <input type="text" value="{{$data->rgdesc}}" name="region_name" id="region_name" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <input type="text" value="{{$data->branch}}" name="branch" id="branch" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="custom-select" id="level" name="level" required>
                              @foreach ($opt_level as $key => $value) 
                              <option value="{{ $key }}" {{ ( $key == $selectedLevel) ? 'selected' : '' }}>  
                                {{ $value }}  
                              </option> 
                               @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="custom-select" id="status" name="status" required>
                              @foreach ($opt_status as $key => $value) 
                              <option value="{{ $key }}" {{ ( $key == $selectedStatus) ? 'selected' : '' }}>  
                                {{ $value }}  
                              </option> 
                               @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <fieldset class="form-group">
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description" required>{{$data->description}}</textarea>
                </fieldset>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Simpan</button>
                        <a href="{{asset('/user-management')}}" type="reset" class="btn btn-light">Cancel</a>
                    </div>
                </div>
            </form>
            <!-- users edit account form ends -->
          </div>
      </div>
    </div>
  </div>
</section>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
<script src="{{asset('js/scripts/navs/navs.js')}}"></script>
@endsection