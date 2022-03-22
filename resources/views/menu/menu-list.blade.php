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
  <div class="users-list-table">
    <div class="card">
      <div class="card-content">
        <div class="card-header">
          <div class="row justify-content-end">
            <div class="col-lg-8 col-md-12 row">
              <div class="input-group"> 
                <select class="custom-select" id="levelSelected" name="level" required>
                  @foreach ($opt_type as $key => $value)
                      <option value="{{ $key }}" {{ ( $key == $selectedType) ? 'selected' : '' }}> 
                          {{ $value }} 
                      </option>
                  @endforeach    
                </select>       
                <div class="input-group-append">
                  <button type="submit" class="btn btn-primary" title="Find"><i class="bx bx-search text-white"></i> Find</button>
                  <button type="button" class="btn btn-success" title="Add Menu" data-toggle="modal" data-target="#addModalform"><i class="bx bx-plus text-white"></i> Add Menu</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="user-list" class="table nowrap scroll-horizontal-vertical">
              <thead>
                <tr>
                    <th width="30%">TYPE</th>
                    <th width="45%">NAME</th>
                    <th width="25%">ACTION</th>
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
                      <a href="{{route('detailMenu')}}?data={{$row['id']}}" class="detail_main" data="{{$row['id']}}"> {{$row['name']}} </a>
                      @endif
                      @if($row['type'] != "OPTION")
                      <p data="{{$row['id']}}"> {{$row['name']}} </p>
                      @endif
                  </td>
                  <td>
                    <button class="btn btn-primary" title="Edit Menu"><i class="bx bx-edit-alt" idMenu="{{$row['id']}}" type="$row['type']" data-toggle="modal" data-target="#editModalform"></i></button>
                    <button class="btn btn-danger" title="Delete Menu"><i class="bx bx-trash" id="deleteMenu" idMenu="{{$row['id']}}" type="$row['type']"></i></button>
                  </td>
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

<!--Add Menu Modal -->
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
            <select name="typeMenu" id="typeMenu" class="custom-select" onchange="typeSelect()" require>
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

<!--Edit Modal -->
<div class="modal fade text-left" id="editModalform" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Edit Menu </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('editMenu.post') }}" name="editmenu" method="post">
          @csrf
        <input type="text" value="editmenu" id="editmenu" name="editmenu" hidden require>
        <input type="text" value="typeMenu" id="typeMenu" name="typeMenu" hidden require>
        <input type="text" value="idMenu" id="idMenu" name="idMenu" hidden require>
        <div class="col-12" id="formname">
          <label>Nama Menu </label>
          <div class="form-group">
            <input name="menuName" id="menuName" type="text" value="Nama Menu" class="form-control" require>
          </div>
        </div>
        <div class="col-12" id="formurl">
        <label>Url Menu </label>
          <div class="form-group">
            <input name="urlMenu" id="urlMenu" type="text" value="Url Menu" class="form-control" require>
          </div>
        </div>
        <div class="col-12" id="formlng">
        <label>I18n Menu </label>
          <div class="form-group">
            <input name="lngMenu" id="lngMenu" type="text" value="l18n Menu" class="form-control" require>
          </div>
        </div>
        <div class="col-12" id="formicon">
        <label>Icon Menu </label>
          <div class="form-group">
            <input name="iconMenu" id="iconMenu" type="text" value="Icon Menu" class="form-control" require>
          </div>
        </div>
        <div class="col-12" id="formtag">
          <label>Custom Tag Menu </label>
          <div class="form-group">
            <input name="customTag" id="customTag" type="text" value="Custom Tag Menu" class="form-control" require>
          </div>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Save</span>
            </button>
      </form>
      </div>
    </div>
  </div>
</div>

@endsection


{{-- vendor scripts --}}
@section('vendor-scripts')
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $(".detail_main").click(function() {
    //     var x = document.getElementById('main_menu');
    //     var y = document.getElementById('option_menu');
    //     let datas = $(this).attr('data');
    //     $.ajax({
    //         url:"{{ route('getOption.post') }}",
    //         type: 'POST',
    //         data:{
    //             data:datas,
    //         },
    //         success: function(res){
    //             $("#panBody").html(res);
    //             if (x.style.display == 'none') {
    //                 x.style.display = 'block';
    //                 y.style.display = 'none';
                    
    //             } else {
    //                 x.style.display = 'none';
    //                 y.style.display = 'block';
    //             }
    //         },
    //         error: function(err){
    //             console.log(err);
    //         }
    //     });
    // });

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
