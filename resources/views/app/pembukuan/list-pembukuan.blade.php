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
          <div class="col-7">
            <form action="{{route('statuspembukuan.post')}}" method="POST">
              @csrf
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                    <label class="pt-1">CHANNEL</label>
                  </div>
                  <div class="col-md-9">
                    <fieldset class="form-group">
                      <select class="form-control" name="channelopt" id="channelopt">
                        @if(isset($channel) && !empty($channel))
                          <option value="{{$channel}}">{{$channel}}</option>
                        @endif
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
                      <select class="custom-select" name="statusRedeem" id="statusRedeem">
                        <option value="SUCCESS" {{ ($status == 'SUCCESS') ? 'selected' : '' }}>SUCCESS</option>
                        <option value="NOTYET" {{ ($status == 'NOTYET') ? 'selected' : '' }}>NOT YET</option>
                        <option value="FAILED" {{ ($status == 'FAILED') ? 'selected' : '' }}>FAILED</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="col-12 pt-1">
                <div class="row">
                  <div class="col-md-3">
                    <label class="pt-1">Deposit Account</label>
                  </div>  
                  <div class="col-md-9">
                  <fieldset class="form-group">
                      <select class="form-control" name="debit_account" id="debit_account">
                        @if(isset($debit_account) && !empty($debit_account))
                          <option value="{{$debit_account}}">{{$debit_account}}</option>
                        @endif
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
                  <button type="submit" class="btn btn-primary"><i class="bx bx-search text-white"> Find</i></button>
                  <button type="submit" name="downloadexcel" value="1" class="btn btn-success"><i class="bx bx-spreadsheet text-white"> Excel</i></button>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Table with outer spacing -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>CODE</th>
                  <th>CHANNEL</th>
                  <th>ID TRANSAKSI</th>
                  <th>DEPOSIT ACCOUNT</th>
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
                  <td>{{$row['id']}}</td>
                  <td>{{$row['debit_account']}}</td>
                  <td>{{$row['credit_account']}}</td>
                  <td>
                  <?php 
                  echo "Rp " . number_format($row['potency'],0,',','.');
                  ?>
                  </td>
                  <td><span class="badge badge-light-info">{{$row['statusBook']}}</span></td>
                  <td><?php if($row['statusBook'] == "SUCCESS") { ?><span class="badge badge-light-success">{{($row['statusBook'])}}</span> <?php }else if($row['statusBook']){ ?> <span class="badge badge-light-warning">{{$row['statusBook']}}</span> <?php }else{ ?> <span class="badge badge-light-danger">{{$row['statusBook']}} <?php } ?> </span></td>
                  <?php if($row['statusBook'] == "FAILED"){
                    ?>
                    <td>
                      <div class="row">
                        <button class="btn btn-primary btn-sm retrybutton" id="{{$row['id']}}" code="{{$row['code']}}">Retry</button>
                        <form action="{{route('statuspembukuan.post')}}" method="POST" class="pl-1">
                          @csrf
                          <input type="text" name="statusRedeem" value="FAILED" hidden />
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
                  <td colspan="9" align="center">No Result Data!</td>
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
                  <li class="paginate_button page-item previous {{ ($meta->hasPreviousPage == false) ? 'disabled' : '' }}" id="DataTables_Table_0_previous">
                      <a class="page-link" href="<?php echo asset('/list-pembukuan').'?page='.$prevPage; ?>"><i class='bx bx-chevrons-left'></i>Prev</a>
                  </li>
                  <li class="paginate_button page-item next {{ ($meta->hasNextPage == false) ? 'disabled' : '' }}" id="DataTables_Table_0_next">
                      <a class="page-link" href="<?php echo asset('/list-pembukuan').'?page='.$nextPage; ?>">Next<i class='bx bx-chevrons-right'></i></a>
                  </li>
                </ul>
              </div>
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
        <input type="text" name="statusRedeem" value="FAILED" hidden />
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


      $('#retryModalform').modal('show');
      $('#idTransactionRetry').val(id);
      $('#codeRetry').val(code);
    });

    // $('#downloadexcel').on('click', function(){
      // alert("123");

      // $.ajax({
      //     url: "{{asset('/testdownload')}}",
      //     contentType: "json",
      //     cache: false,
      //     method: "GET",
      //     xhr: function() {
      //         var xhr = new XMLHttpRequest();
      //         xhr.onreadystatechange = function() {
      //             if (xhr.readyState == 2) {
      //               xhr.responseType = "blob";
      //               if (xhr.status == 200) {
      //                 } else {
      //                     xhr.responseType = "text";
      //                 }
      //             }
      //         };
      //         return xhr;
      //     },
      //     success: function(data) {
      //       // console.log(data);
      //         var blob = new Blob([data], {
      //             type: ""
      //         });
      //         var isIE = false || !!document.documentMode;
      //         // console.log(isIE);
      //         if (isIE) {
      //           console.log("123");
      //             window.navigator.msSaveBlob(blob, "test.xlsx");
      //         } else {
      //           console.log("321");
      //             var url = window.URL || window.webkitURL;
      //             link = url.createObjectURL(blob);
      //             var a = $("<a />");
      //             a.attr("download", "download.xlsx");
      //             a.attr("href", link);
      //             $("body").append(a);
      //             a[0].click();
      //             $("body").remove(a);
      //         }
      //     }
      // });

      // $.ajax({
      //   method: 'GET',
      //   url: "{{asset('/testdownload')}}",
      //   // dataType: 'json',
      //   success: function (data) {
      //       console.log(data);
      //       var blob = new Blob([data], {type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"});

      //       // saveAs(blob,"sadsadas.xlsx");
      //       window.navigator.msSaveBlob(blob, "test.xlsx");
      //   },
      //   error: function(err){
          
      //     console.log(err);
      //   }
      // });
    // });

  });

  $('#select2').select2({});
  $.fn.select2.defaults.set( "theme", "bootstrap");
  

  $('#channelopt').select2(
    {
    width: '100%',
    placeholder: 'Search for a Channel',
    minimumInputLength: 1,
    allowClear: true,
		ajax: {
      method : "GET",
      url: "{{asset('/get-channelopt')}}",
      dataType: "JSON", 
      data: function (params) {
        console.log(params.term);
        return {
          channelopt: params.term
        };
      },
      processResults: function (data, params) {
        console.log(data)
        return {
          results: data
        };
      },
    cache: true,
  }
	});

  $('#debit_account').select2(
    {
    width: '100%',
    placeholder: 'Search for a Debit Account',
    minimumInputLength: 1,
    allowClear: true,
		ajax: {
      method : "GET",
      url: "{{asset('/get-depositaccount')}}",
      dataType: "JSON", 
      data: function (params) {
        console.log(params.term);
        return {
          keyword: params.term
        };
      },
      processResults: function (data, params) {
        console.log(data)
        return {
          results: data
        };
      },
    cache: true,
  }
	});
</script>
@endsection