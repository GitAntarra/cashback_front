@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','User Management')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection
@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
  <div class="users-list-table">
    <div class="card">
      <div class="card-content">
        <div class="card-header">
          <div class="col-7">
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                    <label class="pt-1">Region</label>
                  </div>  
                  <div class="col-md-9">
                    <fieldset class="form-group">
                      <select class="form-control" id="basicSelect">
                        <option>All Region</option>
                        <option>Blade Runner</option>
                        <option>Thor Ragnarok</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                    <label class="pt-1">Working Unit</label>
                  </div>  
                  <div class="col-md-9">
                    <fieldset class="form-group">
                      <select class="form-control" id="basicSelect">
                        <option>All Working Unit</option>
                        <option>Blade Runner</option>
                        <option>Thor Ragnarok</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                    <label class="pt-1">Status</label>
                  </div>  
                  <div class="col-md-9">
                    <fieldset class="form-group">
                      <select class="form-control" id="basicSelect">
                        <option>Active</option>
                        <option>Blade Runner</option>
                        <option>Thor Ragnarok</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                    <label class="pt-1">Keyword</label>
                  </div>  
                  <div class="col-md-9">
                    <input type="text" class="form-control" required
                        data-validation-required-message="This username field is required">
                  </div>
                </div>
              </div>
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                  </div>  
                  <div class="col-md-9">
                  <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1"><i class="bx bx-search"></i> Find</button>
                  <button type="submit" class="btn btn-success glow mr-sm-1 mb-1"><i class="bx bx-list-ul"></i> Show All</button>
                  <a href="{{asset('page-users-add')}}" class="btn btn-warning glow mr-sm-1 mb-1"><i class="bx bx-plus"></i> Add</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="user-list" class="table">
              <thead>
                <tr>
                    <th>PERNR</th>
                    <th>NAME</th>
                    <th>UKER</th>
                    <th>LEVEL</th>
                    <th>BRANCH</th>
                    <th>OFFICE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php if($users){ $userData = $users['data']; } ?>
                <tr>
                @if(!empty($userData) && isset($userData))
                @foreach ($userData as $row)
                  <td>{{$row['pernr']}}</td>
                  <td><a href="{{asset('/page-users-view?id=')}}{{$row['id']}}" data="{{$row['pernr']}}">{{$row['name']}}</a>
                  </td>
                  <td>{{$row['uker']}}</td>
                  <td>{{$row['level']}}</td>
                  <td>{{$row['branch']}}</td>
                  <td>{{$row['position']}}</td>
                  <td>
                    @if($row['status'] == "ACTIVED")
                    <span class="badge badge-light-success">{{$row['status']}}</span>
                    @elseif($row['status'] == "SUSPEND")
                    <span class="badge badge-light-warning">{{$row['status']}}</span>
                    @else
                    <span class="badge badge-light-danger">{{$row['status']}}</span>
                    @endif
                  </td>
                  <td><a href="{{asset('page-users-edit')}}"><i
                    class="bx bx-edit-alt"></i></a></td>
                    </tr>
                      @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <!-- datatable ends -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
@endsection
