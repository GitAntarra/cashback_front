@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Deposit Account')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection
@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="deposit-account">
  <!-- Marketing Campaigns Starts -->
  <div class="card marketing-campaigns">
    <div class="card-header">
        <form method="POST" action="{{route('searhDepositAccount.post')}}">
            @csrf
            <div class="row justify-content-end">
              <div class="col-lg-10 col-md-12 row">
                <div class="input-group">
                  <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search..." {{($keyword) ? 'value='.$keyword : '' }}>      
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-search text-white"> Find</i></button>
                    <button type="button" class="btn btn-success"><i class="bx bx-plus text-white" data-toggle="modal"
              data-target="#addModalform" title="Add Deposit Account"> Add</i></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
      <!-- <h4 class="card-title">Deposit Account</h4>
      <button class="btn btn-sm btn-primary glow mt-md-2 mb-1" data-toggle="modal" data-target="#addModalform" title="Add Deposit Account">Add Deposit Account</button> -->
    </div>
    <div class="table-responsive">
      <!-- table start -->
      <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">
        <thead>
          <tr>
              <th>Account Number</th>
              <th>Short Number</th>
              <th>Account Currency</th>
              <th>Remark</th>
              <th>Balance</th>
              <th>Last Update</th>
              <!-- <th class="text-center">Action</th> -->
          </tr>
        </thead>
        <tbody>
          @if(!empty($data_deposit) && isset($data_deposit))
          @foreach($data_deposit as $key => $row)
          <tr>
            <td class="py-1 line-ellipsis">
                {{$row['account_number']}}
            </td>
            <td class="py-1">
                {{$row['short_name']}}
            </td>
            <td class="py-1" align="center">
                {{$row['account_currency']}}
            </td>
            <td>
              {{$row['remark']}}
            </td>
            <td align="left">
              <button style="height:10px; width:10px;" class="btn updatebalance" id="test{{$key}}" data-id="{{$row['account_number']}}" index="{{$key}}" data-remark="{{$row['remark']}}"><i class="btn bx bx-show-alt"></i></button>
              <p class="tet{{$key}}"  index="{{$key}}" ></p>
              <!-- <?php 
              echo "Rp " . number_format($row['balance'],2,',','.');
              ?> -->
            </td>
            <td>
              {{date('d-m-Y H:i:s', strtotime($row['updated_at']))}}
            </td>
            <!-- <td class="text-center py-1">
              <div class="dropdown">
                  <span
                  class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                  <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                  <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                  </div>
              </div>
            </td> -->
          </tr>
          @endforeach
          @else
          <td colspan="6" align="center">No Result Data!</td>
          @endif
        </tbody>
      </table>
      <!-- table ends -->
    </div>
    <div class="row p-2 pt-5">
      <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page  of {{$meta->page}} | {{$meta->pageCount}} Total Data : {{$meta->itemCount}}</div>
      </div>
      <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
          <ul class="pagination">
            <li class="paginate_button page-item previous <?php if($meta->hasPreviousPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_previous">
                <a class="page-link" href="<?php echo asset('/deposit-account?page=').$prevPage; ?>"><i class='bx bx-chevrons-left'></i> Prev</a>
            </li>
            <li class="paginate_button page-item next <?php if($meta->hasNextPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_next">
                <a class="page-link" href="<?php echo asset('/deposit-account?page=').$nextPage; ?>">Next<i class='bx bx-chevrons-right'></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Add Feature Modal -->
<div class="modal fade text-left" id="addModalform" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="exampleModalScrollableTitle">Add Deposit Account </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
      </div>
      <div class="modal-body">
      <form action="{{route('addDeposit.post')}}" method="post">
          @csrf
        <input type="text" name="addDeposit" id="addDeposit" value="addDeposit" hidden> 
        <div class="col-12" id="formname">
          <label>Account Number </label>
          <div class="form-group">
            <input name="accountNumber" id="accountNumber" pattern='.{15}' type="text" placeholder="Account Number (15 Digits)" class="form-control" require>
          </div>
        </div>
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Remark</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="remark" name="remark" rows="3" placeholder="Remark"></textarea>
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

@section('vendor-scripts')
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  const formatRupiah = (money) => {
    return new Intl.NumberFormat('id-ID',
      { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 }
    ).format(money);
  }

  $(document).ready(function () {
    $(`.updatebalance`).on('click', function(){
      let t = $(this).attr("data-id");
      let ta = $(this).attr("data-remark");
      let index = $(this).attr("index");

      console.log(t);
      console.log(ta);

      $.ajax({
        type: "POST",
        url : "{{route('editdeposit.post')}}",
        data : {
          accountEdit : t,
          remarkEdit : ta
        },
        success : function(data){
          console.log(data.AVAILABLE_BAL);
          if(data.AVAILABLE_BAL){
            $(`.tet${index}`).text(formatRupiah(data.AVAILABLE_BAL));
            $(`#test${index}`).hide();
          }else{
            $(`.tet${index}`).text("Undifned");
            $(`#test${index}`).hide();
            console.log("123");
          }
          
        }
      });
      
      


    });
  });

</script>
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection

