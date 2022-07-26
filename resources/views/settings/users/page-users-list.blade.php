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
            <form action="{{route('searchUser.post')}}" method="GET">
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                    <label class="pt-1">LEVEL</label>
                  </div>  
                  <div class="col-md-9">
                    <fieldset class="form-group">
                      <select class="custom-select" name="level" id="basicSelect">
                        @foreach($opt_level as $key => $value)
                          <option value="{{$key}}" {{($value == $level) ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
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
                      <select class="custom-select" name="status" id="status">
                        @foreach ($status as $key => $value)
                          <option value="{{$key}}" {{($key == $status_filter) ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
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
                    <input type="text" class="form-control" name="keyword" id="keyword" value="{{ ($keyword) ? $keyword : '' }}">
                  </div>
                </div>
              </div>
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                  </div>  
                  <div class="col-md-9">
                  <button type="submit" name="finduser" value="1" title="Find User" class="btn btn-primary glow mr-sm-1 mb-1"><i class="bx bx-search"></i> Find</button>
                  <button type="submit" name="showAlluser" value="1" title="Show All User" class="btn btn-success glow mr-sm-1 mb-1"><i class="bx bx-list-ul"></i> Show All</button>
                  <a href="{{asset('page-users-add')}}" title="Add User" class="btn btn-warning glow mr-sm-1 mb-1"><i class="bx bx-plus"></i> Add</a>
                  </div>
                </div>
              </div>
              </form>
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
                @if(!empty($userData) && isset($userData))
                @foreach ($userData as $row)
                  @if($row['pernr'] != $data_user['pernr'])
                <tr>
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
                  <td>
                    <a class="btn btn-primary" title="Edit User" href="{{asset('/page-users-edit?id=')}}{{$row['id']}}"><i
                    class="bx bx-edit-alt"></i></a></td>
                </tr>
                @endif
                @endforeach
                @else
                <tr>
                  <td colspan="8" align="center">
                  No Result Data!
                  </td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="row pt-5">
        <div class="col-sm-12 col-md-5">
          <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page {{$meta->page}} of {{$meta->pageCount}} | Total Data : {{$meta->itemCount}}</div>
        </div>
        <div class="col-sm-12 col-md-7">
          <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
            <ul class="pagination">
              <li class="paginate_button page-item previous <?php if($meta->hasPreviousPage != 1){ echo "disabled"; } ?>" id="DataTables_Table_0_previous">
                  <a class="page-link" href="<?php echo asset('/user-management').'?page='.$prevPage.'&level='.$level.'&status='.$status_filter.'&keyword='.$keyword; ?>"><i class='bx bx-chevrons-left'></i>Prev</a>
              </li>
              <li class="paginate_button page-item next <?php if($meta->hasNextPage != 1){ echo "disabled"; } ?>" id="DataTables_Table_0_next">
                  <a class="page-link" href="<?php echo asset('/user-management').'?page='.$nextPage.'&level='.$level.'&status='.$status_filter.'&keyword='.$keyword;; ?>">Next<i class='bx bx-chevrons-right'></i></a>
              </li>
            </ul>
          </div>
        </div>
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
