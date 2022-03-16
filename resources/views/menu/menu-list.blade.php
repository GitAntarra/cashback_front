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
          <button type="button" class="btn btn-primary add-task-btn btn-block my-1" data-toggle="modal" data-target="#addModalform">
            <i class="bx bx-plus"></i>
            <span>Tambah Menu</span>
          </button>
          <!--scrolling content Modal -->
          <div class="modal fade text-left" id="addModalform" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle">Add Menu </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('addMenu.post') }}" name="addmenu" method="post">
                    @csrf
                  <div class="col-12" id="formtype">
                    <input type="text" value="addMenu" name="addmenu" id="addmenu" hidden>
                    <label>Type</label>
                    <div class="form-group">
                      <select name="typeMenu" id="typeMenu" class="form-control" onchange="typeSelect()" require>
                        <option value="HEADER">HEADER</option>
                        <option value="MAIN">MAIN</option>
                        <option value="OPTION">OPTION</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12" id="formname">
                    <label>Nama Menu </label>
                    <div class="form-group">
                      <input name="menuName" id="menuName" type="text" placeholder="Nama Menu" class="form-control" require>
                    </div>
                  </div>
                  <div class="col-12" id="formurl">
                  </div>
                  <div class="col-12" id="formlng">
                  </div>
                  <div class="col-12" id="formicon">
                  </div>
                  <div class="col-12" id="formtag">
                  </div>
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                      </button>
                      <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Add</span>
                      </button>
                </form>
                </div>
              </div>
            </div>
          </div>
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
          <div class="col-12">
            <div class="row justify-content-between">
              <div class="col-md-2 col-sm-12 form-group">
                <a href="" class="btn btn-primary"><i class="bx bx-arrow-back"></i> Back</a>
              </div>
              <div class="col-md-2 col-sm-12 form-group">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSecondModalform">
                  <i class="bx bx-plus"></i>
                  <span>Add Menu</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Modal Form-->
          <div class="modal fade text-left" id="addSecondModalform" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle">Add Menu </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('addMenu.post') }}" name="addmenusec" value="addmenusec" method="post">
                    @csrf
                  <div class="col-12" id="formname">
                    <label>Nama Menu </label>
                    <div class="form-group">
                      <input name="menuNameSec" id="menuNameSec" type="text" placeholder="Nama Menu" class="form-control" require>
                    </div>
                  </div>
                  <div class="col-12" id="formurl">
                    <label>Url</label>
                    <div class="form-group"><input name="urlMenuSec" id="urlMenuSec" type="text" placeholder="Url Menu" class="form-control" require></div>
                  </div>
                  <div class="col-12" id="formlng">
                    <label>Il8n Menu</label>
                    <div class="form-group"><input name="lngMenuSec" id="lngMenuSec" type="text" placeholder="Il8n Menu" class="form-control" require></div>
                  </div>
                  <div class="col-12" id="formicon">
                    <label>Icon</label>
                    <div class="form-group"><input name="iconMenuSec" id="iconMenuSec" type="text" placeholder="Icon Menu" class="form-control" require></div>
                  </div>
                  <div class="col-12" id="formtag">
                    <label>Tag Custom</label>
                    <div class="form-group"><input name="tagMenuSec" id="tagMenuSec" type="text" placeholder="Tag Custom" class="form-control" require></div>
                  </div>
                </div>
                <div class="modal-footer">
                      <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                      </button>
                      <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Add</span>
                      </button>
                </form>
                </div>
              </div>
            </div>
          </div>


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

    function typeSelect(){
      let type = $('#typeMenu').val();
      if(type == "MAIN"){
        $("#formurl").empty();
        $("#formicon").empty();
        $("#formlng").empty();
        $('#formtag').empty();
        let urlElem = `<label>Url</label><div class="form-group"><input name="urlMenu" id="urlMenu" type="text" placeholder="Url Menu" class="form-control" require></div>`;
        let iconElem =`<label>Icon</label><div class="form-group"><input name="iconMenu" id="iconMenu" type="text" placeholder="Icon Menu" class="form-control" require></div>`;
        let tagElem =`<label>Tag Custom</label><div class="form-group"><input name="tagMenu" id="tagMenu" type="text" placeholder="Tag Custom" class="form-control" require></div>`;
        let lngElem =`<label>Il8n Menu</label><div class="form-group"><input name="lngMenu" id="lngMenu" type="text" placeholder="Il8n Menu" class="form-control" require></div>`;
        $("#formurl").append(urlElem);
        $("#formicon").append(iconElem);
        $("#formtag").append(tagElem);
        $("#formlng").append(lngElem);
      }else if(type == "OPTION"){
        $("#formurl").empty();
        $("#formicon").empty();
        $("#formlng").empty();
        $('#formtag').empty();
        let iconElem =`<label>Icon </label><div class="form-group"><input name="iconMenu" id="iconMenu" type="text" placeholder="Icon Menu" class="form-control" require></div>`;
        let lngElem =`<label>Il8n </label><div class="form-group"><input name="lngMenu" id="lngMenu" type="text" placeholder="Il8n Menu" class="form-control" require></div>`;
        $("#formlng").append(lngElem);
        $("#formicon").append(iconElem);
      }else{
        $("#formurl").empty();
        $("#formicon").empty();
        $("#formlng").empty();
        $('#formtag').empty();
      }
    }
</script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
@endsection
