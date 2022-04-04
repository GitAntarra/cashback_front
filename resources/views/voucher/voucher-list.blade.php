@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','List Feature')
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
            <input type="text" Placeholder="Search" class="form-control">   
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary" title="Find"><i class="bx bx-search text-white"> Find</i></button>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModalform" title="Add Feature"><i class="bx bx-plus text-white">Add Voucher</i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <div class="card-body">
      <div class="row">
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card border-info bg-transparent">
            <div class="card-content">
              <div class="row">
                <div class="col-lg-4 ">
                  <div class="row">
                    <div class="col-12 text-center justify-content-center">
                      <h2 class="">30%</h2>
                    </div>
                    <div class="col-12 text-center">
                      <span class="badge badge-light-primary">CODE123</span>
                    </div>
                    <div class="col-12 text-center p-1">
                      <label for="">BRIMO</label>
                    </div>
                  </div>
                
                </div>
                <div class="col-lg-8 col-md-12">
                  <div class="row pt-1 ">
                    <div class="col-md-5 p-0 m-0 profile-widget-name"> Limit  </div>
                    <div class="col-md-7 text-left m-0 p-0">: 3 </div>
                    <div class="col-md-5 p-0 m-0 profile-widget-name"> Min Transaction  </div>
                    <div class="col-md-7 text-left m-0 p-0">: 50.000 </div>
                    <div class="col-md-5 p-0 m-0 profile-widget-name"> Max Redeem </div>
                    <div class="col-md-7 text-left m-0 p-0">: 3 </div>
                    <div class="col-md-5 p-0 m-0 profile-widget-name"> Code  </div>
                    <div class="col-md-7 text-left m-0 p-0">: CODE123 </div>
                    <div class="col-md-5 p-0 m-0 profile-widget-name"> Due Date  </div>
                    <div class="col-md-7 text-left m-0 p-0">: 21 April 2022 </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="row pt-5">
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
          <label>Nama Feature </label>
          <div class="form-group">
            <input name="featureName" id="featureName" type="text" placeholder="Feature Name" class="form-control" require>
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
          <label>Nama Feature </label>
          <div class="form-group">
            <input name="featureName" id="featureName" type="text" placeholder="Feature Name" class="form-control" require>
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

  $(document).ready(function () {
    $('.EditFeatureButton').on('click', function (){
      
      let as = document.querySelector('.EditMenuButton');
      let idFeature = $(this).attr("idFeature");
      
      $.ajax({
        type: "GET",
        url : "{{asset('/view-feature')}}?id="+idFeature,
        success : function(data){
          $('#editModalForm').modal('show');
          $('#idFeature').val(data.id)
          $('#featureName').val(data.feature_id);
          $('#description').val(data.description);
        }
      });
      return false;
    });
    
    $('.prev').on('click', function (){
      alert("123");
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