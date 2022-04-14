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
            <button class="btn btn-light-primary btn-block" data-toggle="modal" title="Edit Voucher" data-target="#editVoucherModal">
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
      <form method="post" action="{{route('createvoucher.post')}}" id="form_input">
        @csrf
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>CODE</label>
                </div>
                <div class="col-9">
                <input type="text" name="editVoucher" id="editVoucher" value="editVoucher" hidden/>
                <input required class="form-control" name="vouchercodeEdit" id="vouchercodeEdit" placeholder="Voucher Code" type="text" onkeyup="
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
                  <select class="custom-select" name="typeEdit" id="typeEdit" required>
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
                <select name="channelEdit" id="channelEdit" class="custom-select" required>
                  <option value="">-- Choose Channel --</option>
                  
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
              <select name="idmainFeatureEdit" id="idmainFeatureEdit" class="custom-select" onchange="subFeatureSelect()" required>
                  <option value="">-- Choose Feature --</option>
                
              </select>
              </div>
          </div>
        </div>
        <div class="col-12 pb-1" id="formSubFeatureEdit">
          
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>QUOTA</label>
                </div>
                <div class="col-9">
                    <input required type="number" name="limitEdit" id="limitEdit" class="touchspin">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
          <div class="row">
            <div class="col-3">
                <label for="start_date">START DATE</label>
            </div>
            <div class="col-9">
              <input type="datetime-local" required name="startdateEdit" id="startdateEdit" class="form-control" min="<?= date("Y-m-dTH:i:s");?>" max="2022-11-16T21:25:33"/>
            </div>
          </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>DUE DATE</label>
                </div>
                <div class="col-9">
                <input required type="datetime-local" name="duedateEdit" id="duedateEdit" class="form-control" min="1">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>MINIMAL TRANSACTION</label>
                </div>
                <div class="col-9">
                    <input required type="text" name="mintransactionEdit" id="mintransactionEdit" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>MAXIMAL CASHBACK</label>
                </div>
                <div class="col-9">
                    <input required type="text" name="maxpotencyEdit" id="maxpotencyEdit" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>PERCENT</label>
                </div>
                <div class="col-9">
                <input required type="text" name="percentEdit" id="percentEdit" class="touchspin"  data-bts-postfix="%" />
                </div>
            </div>
        </div>
        <div class="col-12 pb-1">
            <div class="row">
                <div class="col-3">
                    <label>MAXIMAL REDEEM</label>
                </div>
                <div class="col-9">
                    <input required type="number" name="maxredeemEdit" id="maxredeemEdit" class="touchspin" min="1" value="1">
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