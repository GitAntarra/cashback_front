@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','List Sub Feature')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/dragula.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/drag-and-drop.css')}}">
@endsection

@section('content')
<?php $user = Session::get('set_userdata'); ?>
<!-- table Transactions start -->
<section id="table-transactions">
  <div class="card">
    <form method="GET" action="{{route('searchSubFeature.post')}}?id={{$main_featureid}}">
    <div class="card-header pl-0">
      <div class="row justify-content-end">
        <div class="col-lg-4 p-0">
          <a href="{{asset('/main-feature')}}" class="btn btn-primary"><i class="bx bx-left-arrow-alt"></i> Back</a>
        </div>
        <div class="col-lg-8 col-md-12 row">
          <div class="input-group">
            <input type="text" name="id" id="id" value="{{$main_featureid}}" hidden>
            <input type="text" name="keyword" id="keyword" value="{{($keyword) ? $keyword : '' }}" Placeholder="Search by subfeature name" class="form-control">   
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary"><i class="bx bx-search text-white"> Find</i></button>
              @if($user['level'] == 'SUPERADMIN' || $user['level'] == 'MAKER')
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModalform"><i class="bx bx-plus text-white">Add Sub Feature</i></button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr>
                <th width="5%">No. </th>
                <th width="25%">Name</th>
                <th width="30%">Description</th>
                @if($user['level'] == 'SUPERADMIN' ||$user['level']== 'MAKER')
                <th width="20%">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              <?php $a=1; ?>
              @if(!empty($data_subfeature) && isset($data_subfeature))
              @foreach($data_subfeature as $row)
              <tr>
                <td>{{$a++}}</td>
                <td>{{$row['feature_id']}}</td>
                <td>{{$row['description']}}</td>
                @if($user['level'] == 'SUPERADMIN' || $user['level'] == 'MAKER')
                <td>
                  <button class="btn btn-primary btn-sm EditFeatureButton" title="Edit Feature"  idFeature="{{$row['id']}}"><i class="bx bx-edit-alt"></i></button>
                  <button class="btn btn-danger btn-sm confirmdel" idFeature="{{$row['id']}}" title="Delete Feature"><i class="bx bx-trash" id="deleteFeature"></i></button>
                </td>
                @endif
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" align="center"><span>No Result Data</span></td>
              </tr>
              @endif
            </tbody>
        </table>
      </div>
      <div class="row pt-5">
          <div class="col-sm-12 col-md-5">
            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page {{$page}} of {{$meta->pageCount}} | Total Data : {{$meta->itemCount}}</div>
          </div>
          <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
            <ul class="pagination">
              <li class="paginate_button page-item previous <?php if($meta->hasPreviousPage == null){ echo "disabled"; } ?>" id="DataTables_Table_0_previous">
                  <a class="page-link" href="<?php echo asset('/sub-feature').'?id='.$main_featureid.'&page='.$prevPage.'&take='.$take.'&keyword='.$keyword; ?>"><i class='bx bx-chevrons-left'></i>Prev</a>
              </li>
              <li class="paginate_button page-item next <?php if($meta->hasNextPage == null){ echo "disabled"; } ?>" id="DataTables_Table_0_next">
                  <a class="page-link" href="<?php echo asset('/sub-feature').'?id='.$main_featureid.'&page='.$nextPage.'&take='.$take.'&keyword='.$keyword; ?>">Next<i class='bx bx-chevrons-right'></i></a>
              </li>
            </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>

<!--Add Sub Feature Modal -->
<div class="modal fade text-left" id="addModalform" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Add Sub Feature </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('addsubFeature.post') }}" method="post">
          @csrf
        <input type="text" name="addsubFeature" id="addsubFeature" value="addsubFeature" hidden> 
        <input type="text" name="idmainFeature" id="idmainFeature" value="{{$main_featureid}}" hidden>
        <div class="col-12" id="formname">
          <label>Sub Feature Name </label>
          <div class="form-group">
            <input name="subfeatureName" id="subfeatureName" type="text" placeholder="Sub Feature Name" class="form-control" oninput="allow_alphabets(this)" title="Please Enter on Alphabet Only" class="form-control" required>
          </div>
        </div>
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Description</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="description" minlength="10" maxlength="150" name="description" rows="3" placeholder="Description (10 - 150 characters)" required></textarea>
                </fieldset>
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
              <span class="d-none d-sm-block">Add</span>
            </button>
      </form>
      </div>
    </div>
  </div>
</div>

<!--Edit Feature Modal -->
<div class="modal fade text-left" id="editModalForm" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Edit Feature </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('edit-subfeature.post') }}" method="post">
          @csrf
        <input type="text" name="editsubFeature" id="editsubFeature" value="editsubFeature" hidden> 
        <input type="text" name="idFeatureEdit" id="idFeatureEdit" value="idFeatureEdit" class="form-control" hidden>
        <input type="text" name="idmainFeatureEdit" id="idmainFeatureEdit" value="{{$main_featureid}}" hidden>
        <div class="col-12" id="formname">
          <label>Nama Feature </label>
          <div class="form-group">
            <input name="featureNameEdit" id="featureNameEdit" type="text" placeholder="Feature Name" class="form-control" oninput="allow_alphabets(this)" title="Please Enter on Alphabet Only" class="form-control" required>
          </div>
        </div>
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Description</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3" minlength="10" maxlength="150" placeholder="Description (10 - 150 characters)" required></textarea>
                </fieldset>
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

  function allow_alphabets(element){
    let textInput = element.value;
    textInput = textInput.replace(/[^A-Za-z0-9 ]/gm, ""); 
    element.value = textInput.toUpperCase();
  }

  $(document).ready(function () {
    $('.EditFeatureButton').on('click', function (){
      
      let as = document.querySelector('.EditMenuButton');
      let idFeature = $(this).attr("idFeature");
      
      $.ajax({
        type: "GET",
        url : "{{asset('/view-subfeature')}}?id="+idFeature,
        success : function(data){
          console.log(data.description); 
          $('#editModalForm').modal('show');
          $('#idFeatureEdit').val(data.id);
          $('#featureFeeEdit').val(data.fee);
          $('#featureNameEdit').val(data.feature_id);
          $('#descriptionEdit').val(data.description);
        }
      });
      return false;
    });

    $('.confirmdel').on('click', function () {
      let idFeature = $(this).attr("idFeature");
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this Subfeature?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        confirmButtonClass: 'btn btn-warning',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            type  : "GET",
            url   : "{{asset('/delete-subfeature')}}",
            data  : {
              idsubFeature : idFeature,
            },
            success: function(response) {
              Swal.fire({
                type: "success",
                title: 'Deleted!',
                text: 'Your Subfeature has been deleted.',
                confirmButtonClass: 'btn btn-success',
              }).then((w) =>{
                  location.reload(true);
              });
            },
            failure: function (response) {
                swal(
                "Internal Error",
                "Oops, your note was not saved.", // had a missing comma
                "error"
                )
            }
          });
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: 'Cancelled',
            text: 'Your Subfeature is safe :)',
            type: 'error',
            confirmButtonClass: 'btn btn-success',
          })
        }
      });
      
    });
  });
</script>
<script src="{{asset('vendors/js/extensions/dragula.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/extensions/drag-drop.js')}}"></script>
@endsection