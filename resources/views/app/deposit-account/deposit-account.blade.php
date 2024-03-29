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
<style>
.loader {
  border: 15px solid #f3f3f3;
  border-radius: 50%;
  border-top: 15px solid #3498db;
  width: 2px;
  height: 20px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="deposit-account">
  <!-- Marketing Campaigns Starts -->
  <div class="card marketing-campaigns">
    <div class="card-header">
        <form method="GET" action="{{route('searhDepositAccount.post')}}">
            @csrf
            <div class="row justify-content-end">
              <div class="col-lg-10 col-md-12 row">
                <div class="input-group">
                  <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search by account number or account name" {{($keyword) ? 'value='.$keyword : '' }}>      
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
              <th>Account Name</th>
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
            <td align="left" id="balance{{$key}}">
              <button style="height:10px; width:10px;" title="View Balance" class="btn updatebalance" id="test{{$key}}" data-id="{{$row['account_number']}}" index="{{$key}}" data-remark="{{$row['remark']}}"><i class="btn bx bx-show-alt"></i></button>
              <p class="tet{{$key}}"  index="{{$key}}" ></p>
              <!-- <?php 
              echo "Rp " . number_format($row['balance'],2,',','.');
              ?> -->
            </td>
            <td>
              {{date('d-m-Y H:i:s', strtotime($row['updated_at']))}}
            </td>
          </tr>
          @endforeach
          @else
          <td colspan="6" align="center">No Result Data!</td>
          @endif
        </tbody>
      </table>
      <!-- table ends -->
    </div>
    @if(!empty($meta) && isset($meta))
    @if($meta->itemCount != 0)
    <div class="row p-2 pt-5">
      <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page  of {{$meta->page}} | {{$meta->pageCount}} Total Data : {{$meta->itemCount}}</div>
      </div>
      <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
          <ul class="pagination">
            <li class="paginate_button page-item previous <?php if($meta->hasPreviousPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_previous">
                <a class="page-link" href="<?php echo asset('/deposit-account?page=').$prevPage.'&keyword='.$keyword; ?>"><i class='bx bx-chevrons-left'></i> Prev</a>
            </li>
            <li class="paginate_button page-item next <?php if($meta->hasNextPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_next">
                <a class="page-link" href="<?php echo asset('/deposit-account?page=').$nextPage.'&keyword='.$keyword; ?>">Next<i class='bx bx-chevrons-right'></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    @endif
    @endif
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
            <input name="accountNumber" id="accountNumber" pattern='.{15}' oninvalid="setCustomValidity('Please enter 15 digits.')" oninput="allow_number(this)" title="Please Enter on Number Only" type="text" placeholder="Account Number (15 Digits)" class="form-control" required>
          </div>
        </div>
        <div class="col-12" id="formurl">
            <div class="form-group">
                <label>Remark</label>
                <fieldset class="form-group">
                    <textarea class="form-control" id="remark" name="remark" rows="3" placeholder="Remark (10 characters or more)" minlength="10" required></textarea>
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

  function allow_number(element){
      let textInput = element.value;
      textInput = textInput.replace(/[^0-9]/gm, ""); 
      element.value = textInput;
  }

  $(document).ready(function () {
    $(`.updatebalance`).on('click', function(){
      let t = $(this).attr("data-id");
      let ta = $(this).attr("data-remark");
      let index = $(this).attr("index");

      $(`#balance${index}`).empty();
      $(`#balance${index}`).append('<div class="loader"></div>');
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
          console.log("sqd");
          if(data.AVAILABLE_BAL){
            $(`.tet${index}`).text(formatRupiah(data.AVAILABLE_BAL));
            $(`#test${index}`).hide();
          }else{
            $(`.tet${index}`).text("Undefined");
            $(`#test${index}`).hide();
            console.log("123");
          }
          $(`.tet${index}`).text(formatRupiah("123"));
          $(`.tet${index}`).text(formatRupiah(data.AVAILABLE_BAL));
          $(`#test${index}`).hide();
        },
        error: function (error) {
            $(`#balance${index}`).empty();
            $(`#balance${index}`).text("Undefined");
            toastr.warning("ESB Error","Cashback");
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

