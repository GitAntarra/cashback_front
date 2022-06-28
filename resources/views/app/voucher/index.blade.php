@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Voucher')
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
            <form action="{{route('searchVoucher.post')}}" method="POST">
              @csrf
            <input type="text" name="keyword" id="keyword" value="{{$keys}}" Placeholder="Search by voucher code" class="form-control">
            <select name="stsApproved" id="stsApproved" class="custom-select">
              @foreach($sts_approved as $key=>$row)
                <option value="{{$key}}" {{($sts_aprv == $key) ? 'selected' : ''}}>{{$row}}</option>
              @endforeach
            </select>
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary" title="Find"><i class="bx bx-search text-white"> Find</i></button>
            </form>
              @if($sess_user['level'] == 'SUPERADMIN' || $sess_user['level'] == 'MAKER')
              <button type="button" class="btn btn-info" data-toggle="modal"
              data-target="#addVoucherModal" title="Add Feature"><i class="bx bx-plus text-white">Add Voucher</i></button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <div class="card-body">
      <style>
        .vouchercard:hover{
          background-color: rgba(240, 240, 240); opacity:0.8;
        }
      </style>
      <div class="row">
        @if(!empty($list_voucher) && isset($list_voucher))
        @foreach($list_voucher as $row)
        <div class="col-xl-3 col-sm-6 col-12">
          <a href="{{asset('/view-voucher?id=')}}{{$row['id']}}" >
          <div class="card border-info vouchercard">
            <div class="card-content">
              <div class="row no-gutters">
                <div class="col-md-12 col-lg-3">
                  <img src="{{asset('images/banner/banner-35.jpg')}}" class="h-100 w-100 rounded-left">
                </div>
                <div class="col-md-12 col-lg-9 pb-0">
                  <div class="card-body p-1">
                    <div class="row">
                      <div class="col-12">
                        <span class="badge badge-light-info">{{$row['code']}}</span>
                      </div>
                      <div class="col-12">
                        <span>{{$row['type']}} {{$row['percent']}} %</span>
                      </div>
                      <div class="col-12">
                        <p>s/d : {{date('d-m-Y', strtotime($row['dueDate']))}}</p>
                      </div>
                      <div class="col-12">
                        <p class="p-0">{{$row['featuremain']}}</p>
                      </div>
                      <div class="col-12">
                        <span class="badge badge-light-<?php if($row['status'] == 'APPROVED'){ echo 'success'; }elseif($row['status'] == 'REJECTED'){ echo 'danger';}else{ echo 'warning'; } ?>">{{$row['status']}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
        @endforeach
        @else
        <div class="col-xl-12 col-sm-12 col-12 text-center">
          <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">No Result Data</div>
        </div>
        @endif
      </div>
      <div class="row pt-5">
        <div class="col-sm-12 col-md-5">
          <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Page {{$meta->page}} of {{$meta->pageCount}}  | Total Data : {{$meta->itemCount }}</div>
        </div>
        <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
          <ul class="pagination">
            <li class="paginate_button page-item previous <?php if($meta->hasPreviousPage == false ){ echo "disabled"; } ?>" id="DataTables_Table_0_previous">
                <a class="page-link" href="{{asset('/list-voucher?page=')}}{{$prevPage}}"><i class='bx bx-chevrons-left'></i>Prev</a>
            </li>
            <li class="paginate_button page-item next <?php if($meta->hasNextPage == false){ echo "disabled"; } ?>" id="DataTables_Table_0_next">
                <a class="page-link" href="{{asset('/list-voucher?page=')}}{{$nextPage}}">Next<i class='bx bx-chevrons-right'></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!--scrolling content Add Modal Voucher-->
<div class="modal fade text-left" id="addVoucherModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Create Voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('createvoucher.post')}}" id="form_input">
        @csrf
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>CODE</label>
                </div>
                <div class="col-9">
                <input type="text" name="createVoucher" id="createVoucher" value="createVoucher" hidden/>
                <input required class="form-control" name="vouchercode" id="vouchercode" placeholder="Voucher Code" type="text" oninput="allow_alphabets(this)" title="Please Enter on Alphabet Only" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>TYPE</label>
                </div>
                <div class="col-9">
                  <select class="custom-select" name="type" id="type" required>
                    <option value="">-- Choose Type --</option>
                    <option value="CASHBACK">CASHBACK</option>
                    <option value="DISCOUNT">DISCOUNT</option>
                  </select>
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>CHANNEL</label>
                </div>
                <div class="col-9">
                <select name="channel" id="channel" class="custom-select" required>
                  <option value="">-- Choose Channel --</option>
                  @foreach ($list_channel as $row)
                    <option value="{{$row['channel_id']}}">{{$row['channel_id']}}</option>
                  @endforeach
                </select>
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
          <div class="row">
              <div class="col-3">
                  <label>MAIN FEATURE</label>
              </div>
              <div class="col-9">
              <select name="idmainFeature" id="idmainFeature" class="custom-select" onchange="subFeatureSelect()" required>
                  <option value="">-- Choose Feature --</option>
                @foreach ($list_feature as $row)
                  <option idmain="{{$row['id']}}" value="{{$row['feature_id']}}">{{$row['feature_id']}}</option>
                @endforeach
              </select>
              </div>
          </div>
        </div>
        <div class="col-12 pb-1" id="formSubFeature">
          
        </div>
        <div class="col-12 pb-1">
          <div class="row">
              <div class="col-3">
                  <label>Deposit Account</label>
              </div>
              <div class="col-9">
                <select name="depositAccount" id="depositAccount" class="form-control" required>
              </select>
              </div>
          </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>QUOTA</label>
                </div>
                <div class="col-9">
                    <input required type="number" name="limit" id="limit" class="touchspin">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>END DATE</label>
                </div>
                <div class="col-9">
                <input required type="datetime-local" name="duedate" id="duedate" class="form-control" min="1">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>MINIMAL TRANSACTION</label>
                </div>
                <div class="col-9">
                    <input required type="text" name="mintransaction" id="mintransaction" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>MAXIMAL CASHBACK</label>
                </div>
                <div class="col-9">
                    <input required type="text" name="maxpotency" id="maxpotency" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>PERCENT</label>
                </div>
                <div class="col-9">
                <input required type="text" name="percent" id="percent" class="touchspin"  data-bts-postfix="%" />
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
          <div class="row">
              <div class="col-3">
                  <label>MAXIMAL REDEEM</label>
              </div>
              <div class="col-3">
                  <input required type="number" name="maxredeem" id="maxredeem" class="touchspin" min="1" value="1">
              </div>
              <div class="col-3">
                  <label>REDEEM PER DAY</label>
              </div>
              <div class="col-3">
                  <input required type="number" name="maxredeemperday" id="maxredeemperday" class="touchspin" min="1" value="1">
              </div>
          </div>
        </div>
        
        <div class="col-12 pb-1">
            <div class="form-group row">
              <div class="col-3">
                  <label>CHECKER</label>
              </div>
              <div class="col-9">
                  <select name="checkerpn" id="checkerpn" class="form-control" required>
                  </select>
              </div>
            </div>
        </div>
          <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>SIGNER</label>
                </div>
                <div class="col-9">
                  <select name="signerpn" id="signerpn" class="custom-select" required>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-12 pb-1">
            <div class="row">
              <div class="col-3">
                  <label>Description</label>
              </div>
              <div class="col-9">
                <fieldset class="form-group">
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"> </textarea>
                </fieldset>
              </div>
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
          <span class="d-none d-sm-block">Create</span>
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

  var mintrans = document.getElementById("mintransaction");
  
  mintrans.addEventListener("keyup", function(e) {
    mintrans.value = formatMinTrans(this.value, "Rp. ");
  });

  function allow_alphabets(element){
    let textInput = element.value;
    textInput = textInput.replace(/[^A-Za-z]/gm, ""); 
    element.value = textInput.toUpperCase();
  }

  /* Format Tanggal*/
  function myFunction() {
    var x = document.getElementById("startdate").min = "2006-05-05T16:15:23";
  }

  function subFeatureSelect(){
    var idFeature = $('#idmainFeature option:selected').attr('idmain');

    $.ajax({
      type : "GET",
      url  : "{{asset('/getsubFeature')}}?id="+idFeature,
      success : function(res){
          let data = res.data
          $('#formSubFeature').empty();
          if(data.length !== 0){

            var html = `<div class="row">
                <div class="col-3">
                    <label>SUB FEATURE</label>
                </div>
                <div class="col-9" id="optionSelect" required>
                  <select name="idsubFeatureoption" id="idsubFeaturepotion" class="custom-select">
                  </select>
                </div>
            </div>`;

            $("#formSubFeature").append(html);

            for(let i=0; i<data.length;i++){
              let id = data[i]['id'];
              let featid = data[i]['feature_id'];
              $('#idsubFeaturepotion').append('<option value="'+ featid +'">' + featid + '</option>');
            }
          }
        }
    });
  }
  

  $.fn.select2.defaults.set( "theme", "bootstrap" );

  $('#depositAccount').select2(
    {
    width: '100%',
    dropdownParent: $("#addVoucherModal"),
    placeholder: 'Search for a Debit Account',
    minimumInputLength: 1,
    allowClear: true,
		ajax: {
      method : "GET",
      url: "{{asset('/get-depositaccount')}}",
      dataType: "JSON", 
      data: function (params) {
        return {
          keyword: params.term
        };
      },
      processResults: function (data, params) {
        return {
          results: data
        };
      },
    cache: true,
  }
	});

  $('#signerpn').select2({
    width: '100%',
    dropdownParent: $("#addVoucherModal"),
    placeholder: 'Search for a Signer',
    minimumInputLength: 5,
		ajax: {
      method : "GET",
      url: "{{asset('/get-signer')}}",
      dataType: "JSON", 
      data: function (params) {
        return {
          signerpn: params.term
        };
      },
      processResults: function (data, params) {
        return {
          results: data.result
        };
      },
    cache: true,
  }
	});
  
  $('#checkerpn').select2({
    width: '100%',
    dropdownParent: $("#addVoucherModal"),
    placeholder: 'Search for a Checker',
    minimumInputLength: 5,
		ajax: {
      method : "GET",
      url: "{{asset('/get-checker')}}",
      dataType: "JSON", 
      data: function (params) {
        return {
          search: params.term
        };
      },
      processResults: function (data, params) {
        return {
          results: data.result
        };
      },
    cache: true,
  }
	});
  


  /* Fungsi formatMinTrans */
  function formatMinTrans(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      mintrans = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? "." : "";
      mintrans += separator + ribuan.join(".");
    }

    mintrans = split[1] != undefined ? mintrans + "," + split[1] : mintrans;
    return prefix == undefined ? mintrans : mintrans ? "Rp. " + mintrans : "";
  }

  /* Fungsi formatMaxPotency */
  var maxpotency = document.getElementById("maxpotency");

  maxpotency.addEventListener("keyup", function(e){
    maxpotency.value = formatMaxPotency(this.value, "Rp. ");
  });

  function formatMaxPotency(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split         = number_string.split(","),
        sisa          = split[0].length % 3,
        maxpotency    = split[0].substr(0, sisa),
        ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
    if(ribuan){
      separator = sisa ? "." : "";
      maxpotency += separator + ribuan.join(".");
    }

    maxpotency = split[1] != undefined ? maxpotency + "," + split[1] : maxpotency;
    return prefix == undefined ? maxpotency : maxpotency ? "Rp. " + maxpotency : "";

  }

    function validate() {
        // check if input is bigger than 3
        var value = document.getElementById('signerpn').value;
        if (value.length == 3) {
        alert("123");
        }
    }

  
</script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>  
<script src="{{asset('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-voucher.js')}}"></script>
<script src="{{asset('js/scripts/forms/number-input.js')}}"></script>
@endsection