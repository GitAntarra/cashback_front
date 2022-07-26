@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Channel')
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
<?php $user = Session::get('set_userdata'); ?>
<section id="table-transactions">
  <div class="card">
    <form action="{{route('searchChannel.post')}}" method="GET">
    <div class="card-header pl-0">
      <div class="row justify-content-end">
        <div class="col-lg-3 p-0">
          <input type="number" class="currentPage" id="currentPage" name="currentPage" value="{{$page}}" hidden>
        </div>
        <div class="col-lg-8 col-md-12 row">
          <div class="input-group">
            <input type="text" Placeholder="Search by channel name" name="keyword" id="keyword" value="{{$key}}" class="form-control">   
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary"><i class="bx bx-search text-white"> Find</i></button>
              @if($user['level'] == 'SUPERADMIN' || $user['level'] == 'MAKER')
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addModalform" title="Add Feature"><i class="bx bx-plus text-white">Add Channel</i></button>
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
                <th width="20%">Channel Name</th>
                <th width="20%">Channel Key</th>
                <th width="15%">Description</th>
                <th width="20%">Status</th>
                @if($user['level'] == 'SUPERADMIN' || $user['level'] == 'MAKER')
                <th width="20%">Action</th>
                @endif
                </tr>
            </thead>
            <tbody>
                @if(!empty($data_channel) && isset($data_channel))
                @foreach($data_channel as $row)
                <tr>
                    <td>{{$number++}}</td>
                    <td>{{$row['channel_id']}}</td>
                    <td>{{$row['channel_key']}}</td>
                    <td>{{$row['description']}}</td>
                    <td>
                      @if($row['status'] == "ACTIVE")
                      <span class="badge badge-light-success">{{$row['status']}}</span>
                      @elseif($row['status'] == "SUSPEND")
                      <span class="badge badge-light-warning">{{$row['status']}}</span>
                      @else
                      <span class="badge badge-light-danger">{{$row['status']}}</span>
                      @endif
                    </td>
                    @if($user['level'] == 'SUPERADMIN' || $user['level'] == 'MAKER')
                    <td>
                        <!-- <a href="{{asset('/sub-feature?id=')}}{{$row['channel_id']}}" class="btn btn-success btn-sm viewFeatureButton" title="View Feature"  idFeature="{{$row['channel_id']}}"><i class="bx bx-show-alt"></i></a> -->
                        <button class="btn btn-primary btn-sm EditChannelButton" title="Edit Feature"  idChannel="{{$row['channel_id']}}"><i class="bx bx-edit-alt"></i></button>
                        <button class="btn btn-danger btn-sm confirmdel" idChannel="{{$row['channel_id']}}" title="Delete Feature"><i class="bx bx-trash" id="deleteFeature"></i></button>
                    </td>
                    @endif
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="6" align="center"><span>No Result Data</span></td>
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
                  <a class="page-link" href="<?php echo asset('/list-channel').'?page='.$prevPage.'&take='.$take.'&keyword='.$key; ?>"><i class='bx bx-chevrons-left'></i>Prev</a>
              </li>
              <li class="paginate_button page-item next <?php if($meta->hasNextPage == false) { echo "disabled"; }?>" id="DataTables_Table_0_next">
                  <a class="page-link" href="<?php echo asset('/list-channel').'?page='.$nextPage.'&take='.$take.'&keyword='.$key; ?>">Next<i class='bx bx-chevrons-right'></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@if($user['level'] == 'SUPERADMIN' || $user['level'] == 'MAKER')

<!--Add Channel Modal -->
<div class="modal fade text-left" id="addModalform" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Add Channel </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('add-channel.post') }}" method="post">
          @csrf
        <input type="text" name="addChannel" id="addChannel" value="addChannel" hidden> 
        <div class="col-12" id="formname">
          <label>Channel ID</label>
          <div class="form-group">
            <input name="channelIdAdd" id="channelIdAdd" type="text" placeholder="Channel ID" class="form-control" oninput="allow_alphabets(this)" title="Please Enter on Alphabet Only" required>
          </div>
        </div>
        <div class="col-12" id="formname">
          <label>Channel Key </label>
          <div class="input-group">
            <input name="channelKeyAdd" id="channelKeyAdd" type="text" placeholder="Channel Key" class="form-control" required>
            <div class="input-group-append">
              <button type="button" title="Generate Key" onclick="generateKey(10)" class="btn btn-primary"><i class="bx bx-key text-white"> </i></button>
            </div>
          </div>
        </div>
        <div class="col-12" id="formname">
          <label>Status</label>
          <div class="form-group">
            <select name="statusAdd" id="statusAdd" class="custom-select">
              <option value="ACTIVE"> ACTIVE </option>
              <option value="SUSPEND"> SUSPEND </option>            
            </select>
          </div>
        </div>
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Description</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="descriptionAdd" name="descriptionAdd" rows="3" placeholder="Description" reuired></textarea>
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

<!--Edit Channel Modal -->
<div class="modal fade text-left" id="editModalForm" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Edit Channel </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('edit-channel.post') }}" method="post">
          @csrf
        <input type="text" name="editChannel" id="editChannel" value="editChannel" hidden> 
        <div class="col-12" id="formname">
          <label>Channel ID</label>
          <div class="form-group">
            <input name="channelIdEdit" id="channelIdEdit" type="text" placeholder="Channel ID" class="form-control" readonly>
          </div>
        </div>
        <div class="col-12" id="formname">
          <label>Channel Key </label>
          <div class="input-group">
            <input name="channelKeyEdit" id="channelKeyEdit" type="text" placeholder="Channel Key" class="form-control" required>
            <div class="input-group-append">
              <button type="button" title="Generate Key" onclick="generateKey(12)" class="btn btn-primary"><i class="bx bx-key text-white"> </i></button>
            </div>
          </div>
        </div>
        <div class="col-12" id="formname">
          <label>Status</label>
          <div class="form-group">
            <select name="statusEdit" id="statusEdit" class="custom-select">
              <option value="ACTIVE"> ACTIVE </option>
              <option value="SUSPEND"> SUSPEND </option>           
            </select>
          </div>
        </div>
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Description</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3" placeholder="Description"></textarea>
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
@endif
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

  function generateKey(length) {

      let result = ' ';
      const charactersLength = characters.length;
      for ( let i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }

      console.log(result);
      $('#channelKeyAdd').val(result);
      $('#channelKeyEdit').val(result);
  }


  function allow_alphabets(element){
    let textInput = element.value;
    textInput = textInput.replace(/[^A-Za-z0-9 ]/gm, ""); 
    element.value = textInput.toUpperCase();
  }

  $(document).ready(function () {
    $('.EditChannelButton').on('click', function (){
      
      let idChannel = $(this).attr("idChannel");
      console.log(idChannel);
      
      $.ajax({
        type: "GET",
        url : "{{asset('/view-channel')}}?id="+idChannel,
        success : function(data){
          console.log(data.status);
          console.log(data.description);
          $('#editModalForm').modal('show');
          $('#channelIdEdit').val(data.channel_id)
          $('#channelKeyEdit').val(data.channel_key);
          $('#statusEdit').val(data.status);
          $('#descriptionEdit').val(data.description);
        }
      });
      return false;
    });

  $('.confirmdel').on('click', function () {
        let idChannel = $(this).attr("idChannel");
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this Channel?",
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
              url   : "{{asset('/delete-channel')}}",
              data  : {
                  idChannel : idChannel,
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
              text: 'Your Channel is safe :)',
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