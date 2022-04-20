@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Bootstrap Tables')
@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-header">
          <form method="POST" action="{{ route('statuspembukuan.post') }}">
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
                  <th>REDEEM</th>
                  <th>BOOKED</th>
                </tr>
              </thead>
              <tbody>
                @if(!empty($pembukuan) && isset($pembukuan))
                @foreach($pembukuan as $row)
                <tr>
                  <td>{{$row['code']}}</td>
                  <td>{{$row['channel']}}</td>
                  <td>{{$row['debit_account']}}</td>
                  <td>{{$row['credit_account']}}</td>
                  <td><span class="badge badge-light-info">{{$row['statusRedeem']}}</span></td>
                  <td><?php if($row['statusBook'] == "SUCCESS") { ?><span class="badge badge-light-success">{{($row['statusBook'])}}</span> <?php }else if($row['statusBook']){ ?> <span class="badge badge-light-warning">{{$row['statusBook']}}</span> <?php }else{ ?> <span class="badge badge-light-danger">{{$row['statusBook']}} <?php } ?> </span></td>
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
<!-- Basic Tables end -->

@endsection