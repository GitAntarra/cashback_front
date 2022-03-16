@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users View')
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection
@section('content')
<!-- users view start -->
<section class="users-view">
  <!-- users view media object start -->
  <div class="row">
    <?php $data = (object) $detail_user;?>
    <div class="col-12 col-sm-7">
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{asset('images/portrait/small/avatar-s-26.jpg')}}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span>
            {{$data->name}}
          </span></h4>
          <span>Personal Number:</span>
          <span>{{$data->pernr}}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
      <!-- <a href="#" class="btn btn-sm mr-25 border"><i class="bx bx-envelope font-small-3"></i></a>
      <a href="#" class="btn btn-sm mr-25 border">Profile</a> -->
      <a href="{{asset('/page-users-edit?id=')}}{{$data->id}}" class="btn btn-sm btn-primary"><i class="bx bx-pencil"></i> Edit</a>
    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card col-6">
    <div class="card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-12">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td>Organization Unit:</td>
                  <td>{{$data->uker}}</td>
                </tr>
                <tr>
                  <td>Region:</td>
                  <td class="users-view-latest-activity">{{$data->region}}</td>
                </tr>
                <tr>
                  <td>Position:</td>
                  <td>{{$data->position}}</td>
                </tr>
                <tr>
                  <td>Division:</td>
                  <td class="users-view-role">{{$data->division}}</td>
                </tr>
                <tr>
                  <td>Uker:</td>
                  <td>{{$data->uker}}</td>
                </tr>
                <tr>
                  <td>Level:</td>
                  <td>{{$data->level}}</td>
                </tr>
                <tr>
                  <td>Branch:</td>
                  <td>{{$data->branch}}</td>
                </tr>
                <tr>
                  <td>Status:</td>
                  <td>
                    @if($data->status == "ACTIVED")
                    <span class="badge badge-light-success">{{$data->status}}</span>
                    @elseif($data->status == "SUSPEND")
                    <span class="badge badge-light-warning">{{$data->status}}</span>
                    @else
                    <span class="badge badge-light-danger">{{$data->status}}</span>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- <div class="col-12 col-md-8">
            <div class="table-responsive">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th>Module Permission</th>
                    <th>Read</th>
                    <th>Write</th>
                    <th>Create</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Users</td>
                    <td>Yes</td>
                    <td>No</td>
                    <td>No</td>
                    <td>Yes</td>
                  </tr>
                  <tr>
                    <td>Articles</td>
                    <td>No</td>
                    <td>Yes</td>
                    <td>No</td>
                    <td>Yes</td>
                  </tr>
                  <tr>
                    <td>Staff</td>
                    <td>Yes</td>
                    <td>Yes</td>
                    <td>No</td>
                    <td>No</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
</section>
<!-- users view ends -->
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
@endsection