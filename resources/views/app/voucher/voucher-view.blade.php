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
                  <div>
                    <small class="text-muted">Date Due :</small>
                    <span class="text-primary font-weight-bold">{{date('d-m-Y', strtotime($data['dueDate']))}}</span>
                  </div>
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
              <div class="col-3">
                <h6 class="invoice-from">Code</h6>
              </div>
              <div class="col-3">
                <b class="text-primary font-weight-bold">: <span class="badge badge-light-info">{{$data['code']}}</span></b>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Type</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['type']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Limit</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['limit']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Count</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['count']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Minimum Transaction</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: Rp. {{$data['minTransaction']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Maximum Potency</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: Rp. {{$data['maxPotency']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Main Feature</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['featuremain']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Sub Feature</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['featuresub']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Percent</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['percent']}} %</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Maximum Reedem</h6>
              </div>
              <div class="col-3">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['maxRedeem']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Description</h6>
              </div>
              <div class="col-12">
                <h6 class="text-primary font-weight-bold"><b> {{$data['description']}}</b></h6>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
    </div>
    <!-- invoice action  -->
    <div class="col-xl-3 col-md-4 col-12">
      <div class="card invoice-action-wrapper shadow-none border">
        <div class="card-body">
          <div class="invoice-action-btn">
            <button class="btn btn-light-primary btn-block showModalEdit" data-toggle="modal"
              data-target="#editVoucherModal" title="Edit Voucher">
              <span>Edit Voucher</span>
            </button>
          </div>
          <div class="invoice-action-btn pt-1">
            <button class="btn btn-danger btn-block">
              <i class='bx bx-trash'></i>
              <span>Delete voucher</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
      <form method="post" action="{{route('editVoucher.post')}}" id="form_input">
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
                  @foreach ($list_channel as $row)
                    <option value="{{$row['channel_id']}}" <?php if($data['channel']['channel_id'] == $row['channel_id']){ echo "selected"; } ?>> {{$row['channel_id']}}</option>
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
              <select name="idsubFeatureEdit" id="idsubFeatureEdit" class="custom-select" required>
                  @foreach ($list_feature as $row)
                  <option idmain="{{$row['id']}}" value="{{$row['feature_id']}}" <?php if($row['feature_id'] == $data['featuremain']){ echo "selected"; } ?>> {{$row['feature_id']}}</option>
                @endforeach
              </select>
              </div>
          </div>
        </div>
        <div class="col-12 pb-1">
          <div class="row">
              <div class="col-3">
                  <label>Deposit Account</label>
              </div>
              <div class="col-9">
              <select name="depositAccount" id="depositAccount" class="custom-select" required>
                  @foreach ($list_deposit as $row)
                  <option value="{{$row['account_number']}}" <?php if($row['account_number'] == $data['depositaccount']['account_number']){ echo "selected"; } ?>>{{$row['short_name']}} - {{$row['account_number']}}</option>
                @endforeach
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
                  <input required type="number" name="maxredeemperdayEdit" id="maxredeemperdayEdit"  class="touchspin" min="1" value="1">
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
        <button type="submit" class="btn btn-primary ml-1">
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