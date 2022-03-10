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
<section class="users-list-wrapper" id="main_menu">
  <div class="row">
    <div class="col-3">
      <div class="todo-app-menu">
        <div class="form-group text-center add-task">
          <!-- new task button -->
          <button type="button" class="btn btn-primary add-task-btn btn-block my-1">
            <i class="bx bx-plus"></i>
            <span>Tambah Menu</span>
          </button>
        </div>
        <!-- sidebar list start -->
          <form class="form_filter" action="" id="form_filter" method="post">
        <div class="sidebar-menu-list">
          <!-- <div class="list-group">
            <a href="#" class="list-group-item border-0 active">
              <span class="fonticon-wrap mr-50">
                <i class="livicon-evo"
                  data-options="name: list.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent;"></i>
              </span>
              <span> All</span>
            </a>
          </div> -->
          <!-- <label class="filter-label mt-2 mb-1 pt-25">Filters</label> -->
          <div class="list-group">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" id="type" name="type" required>
                  @foreach ($opt_type as $key => $value) 
                  <option value="{{ $key }}" {{ ( $key == $selectedType) ? 'selected' : '' }}>  
                    {{ $value }}  
                  </option> 
                  @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="form-group text-center add-task">
          <!-- new task button -->
          <button type="submit" name="filter_menu" class="btn btn-success add-task-btn btn-block my-1">
            <i class="bx bx-search"></i>
            <span>Find</span>
          </button>
        </div>
          </form>
        <!-- sidebar list end -->
      </div>
    </div>
    <div class="col-9">
      <div class="users-list-table">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <!-- datatable start -->
              <div class="table-responsive">
                <table id="user-list" class="table nowrap scroll-horizontal-vertical">
                  <thead>
                    <tr>
                        <th>TYPE</th>
                        <th>NAME</th>
                        <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($menus){ $userMenu = $menus; } ?>
                    <tr>
                    @if(!empty($userMenu) && isset($userMenu))
                    @foreach ($userMenu as $row)
                      <td>{{$row['type']}}</td>
                      <td>
                          @if($row['type'] == "OPTION")
                          <a href="#" class="detail_main" data="{{$row['id']}}"> {{$row['name']}} </a>
                          @endif
                          @if($row['type'] != "OPTION")
                          <p data="{{$row['id']}}"> {{$row['name']}} </p>
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
    </div>
  </div>
</section>
<!-- users list ends -->

<section class="users-list-wrapper" id="option_menu" style="display:none">
  <div class="users-list-table">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
            <a href="" class="btn btn-primary"><i class="bx bx-arrow-back"></i> Back</a>
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="user-list" class="table">
              <thead>
                <tr>
                    <th>TYPE</th>
                    <th>NAME</th>
                    <th>ACTION</th>
                </tr>
              </thead>
              <tbody id="panBody">

              </tbody>
            </table>
          </div>
          <!-- datatable ends -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection


{{-- vendor scripts --}}
@section('vendor-scripts')
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".detail_main").click(function() {
        var x = document.getElementById('main_menu');
        var y = document.getElementById('option_menu');
        let datas = $(this).attr('data');
        $.ajax({
            url:"{{ route('getOption.post') }}",
            type: 'POST',
            data:{
                data:datas,
            },
            success: function(res){
                $("#panBody").html(res);
                if (x.style.display == 'none') {
                    x.style.display = 'block';
                    y.style.display = 'none';
                    
                } else {
                    x.style.display = 'none';
                    y.style.display = 'block';
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    });
</script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
@endsection
