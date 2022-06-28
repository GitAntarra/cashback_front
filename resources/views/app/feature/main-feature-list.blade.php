@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Feature')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/dragula.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/drag-and-drop.css')}}">
@endsection

@section('content')
<!-- table Transactions start -->
<section id="table-transactions">
  <div class="card">
    <form method="POST">
      @csrf
    <div class="card-header">
      <div class="row justify-content-end">
        <div class="col-lg-8 col-md-12 row">
          <div class="input-group">
            <form action="{{route('searhFeature.post')}}" method="POST">
            <input type="text" name="keyword" Placeholder="Search by feature name" class="form-control" value="{{($keyword) ? $keyword : '' }}">   
            <div class="input-group-append">
              <button name="findfeature" value="1" type="submit" class="btn btn-primary" title="Find"><i class="bx bx-search text-white"> Find</i></button>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModalform" title="Add Feature"><i class="bx bx-plus text-white">Add Feature</i></button>
            </div>
            </form>
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
                <th width="35%">Name</th>
                <th width="35%">Description</th>
                <th width="25%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $a = 1; ?>
                @if(!empty($data_feature) && isset($data_feature))
                @foreach($data_feature as $row)
                <tr>
                    <td>{{$number++}}</td>
                    <td>{{$row['feature_id']}}</td>
                    <td>{{$row['description']}}</td>
                    <td>
                        <a href="{{asset('/sub-feature?id=')}}{{$row['id']}}" class="btn btn-success btn-sm viewFeatureButton" title="View Feature"  idFeature="{{$row['id']}}"><i class="bx bx-show-alt"></i></a>
                        <button class="btn btn-primary btn-sm EditFeatureButton" title="Edit Feature"  idFeature="{{$row['id']}}"><i class="bx bx-edit-alt"></i></button>
                        <button class="btn btn-danger btn-sm confirmdel" idFeature="{{$row['id']}}" title="Delete Feature"><i class="bx bx-trash" id="deleteFeature"></i></button>
                    </td>
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
              <li class="paginate_button page-item previous <?php if($meta->hasPreviousPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_previous">
                  <a class="page-link" href="<?php echo asset('/main-feature').'?page='.$prevPage.'&take='.$take; ?>"><i class='bx bx-chevrons-left'></i>Prev</a>
              </li>
              <li class="paginate_button page-item next <?php if($meta->hasNextPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_next">
                  <a class="page-link" href="<?php echo asset('/main-feature').'?page='.$nextPage.'&take='.$take; ?>">Next<i class='bx bx-chevrons-right'></i></a>
              </li>
            </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>

<!--Edit Feature Modal -->
<div class="modal fade text-left" id="editModalForm" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Add Feature </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('edit-feature.post') }}" method="post">
          @csrf
        <input type="text" name="editFeature" id="editFeature" value="editFeature" hidden> 
        <input type="text" name="idFeature" id="idFeature" value="idFeature" class="form-control" hidden>
        <div class="col-12" id="formname">
          <label>Feature Name</label>
          <div class="form-group">
            <input name="featureName" id="featureName" type="text" placeholder="Feature Name" oninput="allow_alphabets(this)" title="Please Enter on Alphabet Only" class="form-control" required>
          </div>
        </div>
        
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Description</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
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

<!--Add Feature Modal -->
<div class="modal fade text-left" id="addModalform" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Add Feature </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('addFeature.post') }}" method="post">
          @csrf
        <input type="text" name="addFeature" id="addFeature" value="addFeature" hidden> 
        <div class="col-12" id="formname">
          <label>Feature Name</label>
          <div class="form-group">
                <input required class="form-control" name="featureName" id="featureName" type="text" placeholder="Feature Name" oninput="allow_alphabets(this)" title="Please Enter on Alphabet Only">
          </div>
        </div>
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Description</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
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
        textInput = textInput.replace(/[^A-Za-z]/gm, ""); 
        element.value = textInput.toUpperCase();
    }


  $(document).ready(function () {
    $('.EditFeatureButton').on('click', function (){
      
      let as = document.querySelector('.EditMenuButton');
      let idFeature = $(this).attr("idFeature");
      
      $.ajax({
        type: "GET",
        url : "{{asset('/view-feature')}}?id="+idFeature,
        success : function(data){
          $('#editModalForm').modal('show');
          $('#idFeature').val(data.id);
          $('#featureName').val(data.feature_id);
          $('#description').val(data.description);
        }
      });
      return false;
    });

  $('.confirmdel').on('click', function () {
        let idFeature = $(this).attr("idFeature");
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this Feature?",
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
              url   : "{{asset('/delete-feature')}}",
              data  : {
                  idFeature : idFeature,
              },
              success: function(response) {
                console.log(response);
                Swal.fire({
                  type: "success",
                  title: 'Deleted!',
                  text: 'Your file has been deleted.',
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
              text: 'Your Feature is safe :)',
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