@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Detail Voucher')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/dragula.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/drag-and-drop.css')}}">
@endsection
@section('content')
    <!-- app invoice View Page -->
<section class="invoice-view-wrapper">
  <div class="row">
    <!-- invoice view page -->
    <div class="col-xl-9 col-md-8 col-12">
      <div class="card invoice-print-area">
        <div class="card-content">
          <div class="card-body pb-0 mx-25">
            <!-- header section -->
            <div class="row">
              <div class="col-xl-4 col-md-12">
              <a href="{{asset('/list-voucher')}}" class="btn btn-primary"><i class="bx bx-left-arrow-alt"></i> Back</a>
              </div>
              <div class="col-xl-8 col-md-12">
                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                  <!-- <div>
                    <small class="text-muted">Date Due :</small>
                    <span class="text-primary font-weight-bold">{{date('d-m-Y', strtotime($data['dueDate']))}}</span>
                  </div> -->
                  @if($data['status'] == 'APPROVED')
                  <div class="custom-control custom-switch custom-control-inline mb-1">
                    <input type="checkbox" class="custom-control-input" {{($data['isActive'] == 'ACTIVE') ? 'checked' : ''}} id="stsActive" idvoucher="{{$data['id']}}">
                    <label class="custom-control-label mr-1" for="stsActive">
                    </label>
                    <span>Active</span>
                  </div>
                  @endif
                </div>
              </div>
            </div>
            <!-- logo and title -->
            <div class="row my-3">
              <div class="col-6">
                <h4 class="text-primary">Voucher {{$data['type']}}</h4>
              </div>
              <div class="col-6 d-flex justify-content-end">
                <img src="{{asset('images/pages/sugar_logo.png')}}" alt="logo" height="55" width="164">
              </div>
            </div>
            <hr>
            <!-- invoice address and contact -->
            <div class="row invoice-info">
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Code</h6>
                    </div>
                    <div class="col-6">
                      <b class="text-primary font-weight-bold">: <span class="badge badge-light-info">{{$data['code']}}</span></b>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Main Feature</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['featuremain']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Type</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['type']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Sub Feature</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['featuresub']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Limit</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['limit']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Channel</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['channel'] ? $data['channel']['channel_id'] : null}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Count</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['count']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Deposit Account</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['depositaccount'] ? $data['depositaccount']['account_number'] : null}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Minimum Transaction</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: Rp. {{$data['minTransaction']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Maximum Reedem</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['maxRedeem']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Maximum Potency</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: Rp. {{$data['maxPotency']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Redeem per Day</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['maxDayRedeem']}}</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Percent</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['percent']}} %</b></h6>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row">
                    <div class="col-6">
                      <h6 class="invoice-from">Status</h6>
                    </div>
                    <div class="col-6">
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['status']}}</b></h6>
                    </div>
                  </div>
                </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-3">
                <h6 class="invoice-from">Maker</h6>
              </div>
              <div class="col-9">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['maker'] ? $data['maker']['pernr'] ." - ".
                   $data['maker']['name'] : null}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Checker</h6>
              </div>
              <div class="col-9">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['checker'] ? $data['checker']['pernr'] ." - ".
                   $data['checker']['name'] : null}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Signer</h6>
              </div>
              <div class="col-9">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['signer'] ? $data['signer']['pernr'] ." - ".
                   $data['signer']['name'] : null}}</b></h6>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-3">
                <h6 class="invoice-from">Deposit Account</h6>
              </div>
              <div class="col-9">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['depositaccount'] ? $data['depositaccount']['account_number'] ." - ". $data['depositaccount']['short_name'] : null}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Description</h6>
              </div>
              <div class="col-9">
                <p class="text-primary">: {{$data['description']}}</p>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Progress</h6>
              </div>
              <div class="col-9">
                <p class="text-primary" style="white-space: pre-line">: {{$data['status_msg']}}</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- invoice action  -->
    <div class="col-xl-3 col-md-4 col-12">
      <div class="card invoice-action-wrapper shadow-none border">
        <div class="card-body">
          <div class="invoice-action-btn">
            @if($sess_user['level'] == 'SUPERADMIN' || $sess_user['level'] == 'MAKER')
            <button class="btn btn-light-primary btn-block showModalEdit" data-toggle="modal"
              data-target="#editVoucherModal" title="Edit Voucher">
              <span>Edit Voucher</span>
            </button>
            @else
            <span class="badge badge-light-{{($data['status'] == 'REJECTED') ? 'danger' : 'info'}} btn-block">{{$data['status']}}</span>
            @endif
          </div>
          <div class="invoice-action-btn pt-1">

            @if(($sess_user['level'] == 'CHECKER' && ($data['status'] == 'CREATED' || $data['status'] == 'UPDATED')) || ($sess_user['level'] == 'SIGNER' && $data['status'] == 'CHECKED'))
            <input type="text" name="statusVoucher" id="statusVoucher" value="{{$data['status']}}" hidden />
            <button type="button" onclick="approve_btn('{{$data['id']}}')" title="Approve Voucher" class="btn btn-success btn-block">
              <i class='bx bx-check'></i>
              <span>Approve</span>
            </button>
            <button type="button" onclick="reject_btn('{{$data['id']}}')" title="Approve Voucher" class="btn btn-danger btn-block">
              <i class='bx bx-x'></i>
              <span>Reject</span>
            </button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--scrolling content Approval Modal Voucher-->
<div class="modal fade text-left" id="ApproveModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">You want to Accept this Voucher?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('approveVoucher.post')}}" id="form_input">
        @csrf
        <input type="text" value="" id="idapprove" name="idapprove" hidden />
        <div class="col-12 pb-1">
          <fieldset class="form-group">
              <textarea class="form-control" id="remarkApproval" name="msg" rows="3" placeholder="Minimum 10 Characters"></textarea>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>
        <button type="submit" name="ApproveVoucher" value="1" class="btn btn-success ml-1">
          <i class="bx bx-check d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Approve</span>
        </button>
      </form>
      </div>
    </div>
  </div>
</div>

<!--scrolling content Reject Modal Voucher-->
<div class="modal fade text-left" id="RejectModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">You want to Reject this Voucher?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('rejectVoucher.post')}}" id="form_input">
        @csrf
        <input type="text" value="" id="idreject" name="idreject" hidden />
        <div class="col-12 pb-1">
          <fieldset class="form-group">
              <textarea class="form-control" name="msg" rows="3" placeholder="Minimum 10 Characters"></textarea>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>
        <button type="submit" name="ApproveVoucher" value="1" class="btn btn-success ml-1">
          <i class="bx bx-check d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Reject</span>
        </button>
      </form>
      </div>
    </div>
  </div>
</div>


<!--scrolling content Edit Modal Voucher-->
<div class="modal fade text-left" id="editVoucherModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Voucher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{route('updateVoucher.post')}}?id={{$data['id']}}" id="form_edit">
        @csrf
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>CODE</label>
                </div>
                <div class="col-9">
                <input type="text" name="editVoucher" id="editVoucher" value="editVoucher" hidden/>
                <input required class="form-control" disabled name="vouchercodeEdit" id="vouchercodeEdit"  value="{{$data['code']}}" type="text" onkeyup="
                var start = this.selectionStart;
                var end = this.selectionEnd;
                this.value = this.value.toUpperCase();
                this.setSelectionRange(start, end);
                ">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>TYPE</label>
                </div>
                <div class="col-9">
                  <select class="custom-select" name="typeEdit" id="typeEdit" selected="{{$data['type']}}" required>
                    <option value="CASHBACK" <?php if($data['type'] == "CASHBACK"){ echo "selected"; } ?>>CASHBACK</option>
                    <option value="DISCOUNT" <?php if($data['type'] == "DISCOUNT"){ echo "selected"; } ?>>DISCOUNT</option>
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
                <select name="channelEdit" id="channelEdit" class="custom-select" required>
                  <?php 
                    if(isset($row['channel_id'])){
                      $selected = $data['channel']['channel_id'] == $row['channel_id'] ? true : false;
                    }else{
                      $selected = false;
                    }
                  ?>
                  @foreach ($list_channel as $row)
                    <option value="{{$row['channel_id']}}" {{ $selected ? selected : null }}> {{$row['channel_id']}}</option>
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
              <select name="mainFeatureEdit" onchange="showsubFeature()" id="mainFeatureEdit" class="custom-select test" required>
                  @foreach ($list_feature as $row)
                  <option idmain="{{$row['id']}}" value="{{$row['feature_id']}}" <?php if($row['feature_id'] == $data['featuremain']){ echo "selected"; } ?>> {{$row['feature_id']}}</option>
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
              <select name="depositAccountEdit" id="depositAccountEdit" class="custom-select" required>
                  @if(isset($data['depositaccount']['account_number']) && !empty($data['depositaccount']['account_number'])) 
                  <option value="{{$data['depositaccount']['account_number']}}">{{$data['depositaccount']['account_number']}} - {{$data['depositaccount']['short_name']}}</option>
                  @endif
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
                    <input required type="number" value="{{$data['limit']}}" name="limitEdit" id="limitEdit" class="touchspin">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>DUE DATE</label>
                </div>
                <div class="col-9">
                <input required type="datetime-local" name="duedateEdit" id="duedateEdit" value="{{date('Y-m-d\TH:i', strtotime($data['dueDate']))}}" class="form-control" min="1">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>MINIMAL TRANSACTION</label>
                </div>
                <div class="col-9">
                    <input required type="text" name="mintransactionEdit" id="mintransactionEdit" value="{{$data['minTransaction']}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>MAXIMAL CASHBACK</label>
                </div>
                <div class="col-9">
                    <input required type="text" name="maxpotencyEdit" id="maxpotencyEdit" value="{{$data['maxPotency']}}" class="form-control">
                </div>
            </div>
        </div>
          <div class="col-12 pb-1">
            <div class="row">
              <div class="col-3">
                  <label>PERCENT</label>
              </div>
              <div class="col-9">
              <input required type="text" name="percentEdit" id="percentEdit" class="touchspin" value="{{$data['percent']}}" data-bts-postfix="%" />
              </div>
            </div>
          </div>
          <div class="col-12 pb-1">
            <div class="row">
              <div class="col-3">
                  <label>MAXIMAL REDEEM</label>
              </div>
              <div class="col-3">
                  <input required type="number" name="maxredeemEdit" id="maxredeemEdit" value="{{$data['maxRedeem']}}" class="touchspin" min="1" value="1">
              </div>
              <div class="col-3">
                  <label>REDEEM PER DAY</label>
              </div>
              <div class="col-3">
                  <input required type="number" name="maxredeemperdayEdit" id="maxredeemperdayEdit"  class="touchspin" min="1" value="{{$data['maxDayRedeem']}}">
              </div>
            </div>
          </div>
          <div class="col-12 pb-1">
            <div class="form-group row">
              <div class="col-3">
                  <label>CHECKER</label>
              </div>
              <div class="col-9">
                  <select name="checkerpnEdit" id="checkerpnEdit" class="form-control" required>
                    @if(isset($data['checker']['pernr']) && !empty($data['checker']['pernr']))
                      <option value="{{$data['checker']['pernr']}}">{{$data['checker']['pernr']}} - {{$data['checker']['name']}}</option>
                    @endif
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
                  <select name="signerpnEdit" id="signerpnEdit" class="form-control" required>
                    @if(isset($data['signer']['pernr']) && !empty($data['signer']['pernr']))
                      <option value="{{$data['signer']['pernr']}}">{{$data['signer']['pernr']}} - {{$data['signer']['name']}}</option>
                    @endif
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
                    <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3" placeholder="Description">{{$data['description']}}</textarea>
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
        <button id="submit_edit" value="2" type="submit" class="btn btn-primary ml-1">
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

  function approve_btn(id){
    $('#idapprove').val(id);
    $('#ApproveModal').modal().show();
  }
  function reject_btn(id){
    $('#idreject').val(id);
    $('#RejectModal').modal().show();
  }

$.fn.select2.defaults.set( "theme", "bootstrap" );


$('#depositAccountEdit').select2(
    {
    width: '100%',
    dropdownParent: $("#editVoucherModal"),
    placeholder: 'Search for a Debit Account',
    minimumInputLength: 1,
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
        console.log(data);
        return {
          results: data
        };
      },
    cache: true,
  }
	});

$('#signerpnEdit').select2({
  width: '100%',
  dropdownParent: $("#editVoucherModal"),
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
      console.log(data);
      return {
        results: data.result
      };
    },
  cache: true,
}
});

$('#checkerpnEdit').select2({
  width: '100%',
  dropdownParent: $("#editVoucherModal"),
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
      console.log(data);
      return {
        results: data.result
      };
    },
  cache: true,
}
});

  $("#stsActive").click(function(e) {
    let idvoucher = $(this).attr("idvoucher");
    console.log(idvoucher);
    // $.ajax({
    //   type: "GET",
    //   url : 
    // });
  });

  showsubFeature();

  function showsubFeature(){
    let idmain = $('#mainFeatureEdit').find('option:selected').attr('idmain');
    $.ajax({
      type : "GET",
      url  : "{{asset('/getsubFeature')}}?id="+idmain,
      success : function(res){
        console.log(res);
          let data = res.data;
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

  $("#form_edit").submit(function(e) {
    var nilai = $("#submit_edit").val();
    if (nilai == "2") {
      e.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to Edit voucher?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Edit it!',
        confirmButtonClass: 'btn btn-warning',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false,
      }).then(function (result) {
        if (result.value) {
          $("#submit_edit").val('1');
          $("#form_edit").submit();
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            title: 'Cancelled',
            text: 'Edit Voucher has been cancelled :)',
            type: 'error',
            confirmButtonClass: 'btn btn-success',
          })
        }
      });
    }
  });
  
</script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>  
<script src="{{asset('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-voucher.js')}}"></script>
<script src="{{asset('js/scripts/forms/number-input.js')}}"></script>
@endsection