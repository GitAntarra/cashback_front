@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Pembukuan')
@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-header">
          <form method="POST" action="{{route('statuspembukuan.post')}}">
            @csrf
            <div class="row justify-content-end">
              <div class="col-lg-6 col-md-12 row">
                <div class="input-group">
                  <select class="custom-select" id="statusRedeem" name="statusRedeem" required>
                    <option value="SUCCESS" {{ ($status == 'SUCCESS') ? 'selected' : '' }}>SUCCESS</option>
                    <option value="NOTYET" {{ ($status == 'NOTYET') ? 'selected' : '' }}>NOT YET</option>
                    <option value="FAILED" {{ ($status == 'FAILED') ? 'selected' : '' }}>FAILED</option>
                  </select>       
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-search text-white"> Find</i></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="card-body">
          <!-- Table with outer spacing -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>CODE</th>
                  <th>CHANNEL</th>
                  <th>DEBIT ACCOUNT</th>
                  <th>CREDIT ACCOUNT</th>
                  <th>POTENCY</th>
                  <th>REDEEM</th>
                  <th>BOOKED</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @if(!empty($pembukuan) && isset($pembukuan))
                @foreach($pembukuan as $key => $row)
                <tr>
                  <td>{{$row['code']}}</td>
                  <td>{{$row['channel']}}</td>
                  <td>{{$row['debit_account']}}</td>
                  <td>{{$row['credit_account']}}</td>
                  <td>
                  <?php 
              echo "Rp " . number_format($row['potency'],0,',','.');
              ?>
                  </td>
                  <td><span class="badge badge-light-info">{{$row['statusRedeem']}}</span></td>
                  <td><?php if($row['statusBook'] == "SUCCESS") { ?><span class="badge badge-light-success">{{($row['statusBook'])}}</span> <?php }else if($row['statusBook']){ ?> <span class="badge badge-light-warning">{{$row['statusBook']}}</span> <?php }else{ ?> <span class="badge badge-light-danger">{{$row['statusBook']}} <?php } ?> </span></td>
                  <?php if($row['statusBook'] == "FAILED"){
                    ?>
                    <td>
                      <div class="row">
                      <button class="btn btn-primary btn-sm retrybutton" id="{{$row['id']}}" code="{{$row['code']}}">Retry</button>
                        <form action="{{route('statuspembukuan.post')}}" method="POST" class="pl-1">
                        @csrf
                          <input type="text" name="donePembukuan" id="donePembukuan" value="donePembukuan" hidden />
                          <input type="text" name="idTransactionDone" id="idTransactionDone" value="{{$row['id']}}" hidden/>
                          <input type="text" name="codeDone" id="codeDone" value="{{$row['code']}}" hidden/>
                          <button type="submit" class="btn btn-success btn-sm doneButton">Done</button>
                        </form>
                      </div>
                    
                    </td>
                    
                  <?php
                  }else{ ?>
                  <td></td>
                  <?php } ?>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="6" align="center">No Result Data!</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="row pt-5">
            <div class="col-sm-12 col-md-5">
              <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page {{$meta->page}} of {{$meta->pageCount}} | Total Data : {{$meta->itemCount}}</div>
            </div>
            <div class="col-sm-12 col-md-5">
              <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                <ul class="pagination">
                  <li class="paginate_button page-item previous {{ ($meta->hasPreviousPage == false) ? 'disabled' : '' }}" id="DataTables_Table_0_previous">
                      <a class="page-link" href="<?php echo asset('/list-pembukuan').'?page='.$prevPage; ?>"><i class='bx bx-chevrons-left'></i>Prev</a>
                  </li>
                  <li class="paginate_button page-item next {{ ($meta->hasNextPage == false) ? 'disabled' : '' }}" id="DataTables_Table_0_next">
                      <a class="page-link" href="<?php echo asset('/list-pembukuan').'?page='.$nextPage; ?>">Next<i class='bx bx-chevrons-right'></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-12 col-md-2 justify-content-end">
              <button class="btn btn-primary"> Excel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Add Feature Modal -->
<div class="modal fade text-left" id="retryModalform" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Retry </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{route('statuspembukuan.post')}}" method="post">
          @csrf
        <input type="text" name="retryPembukuan" id="retryPembukuan" value="retryPembukuan" hidden> 
        <input type="text" name="idTransactionRetry" id="idTransactionRetry" hidden/>
        <input type="text" name="codeRetry" id="codeRetry" hidden/>
        <input type="text" name="statusRedeem" id="statusRedeem" value="{{$status}}" hidden />
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Remark</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="remarkRetry" name="remarkRetry" rows="3" placeholder="Remark" require></textarea>
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
              <span class="d-none d-sm-block">Retry</span>
            </button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Basic Tables end -->

@endsection

@section('vendor-scripts')
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).ready(function () {
    $(`.retrybutton`).on('click', function(){
      let id = $(this).attr("id");
      let code = $(this).attr("code");

      console.log(id);
      console.log(code);


      $('#retryModalform').modal('show');
      $('#idTransactionRetry').val(id);
      $('#codeRetry').val(code);
    });
  });
</script>
@endsection