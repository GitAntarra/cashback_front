@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Invoice')
{{-- styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
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
                <span class="badge badge-light-info">#{{$data['code']}}</span>
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
                <h6 class="text-primary font-weight-bold"><b>: {{$data['code']}}</b></h6>
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
            <a href="{{asset('app-invoice-edit')}}" class="btn btn-light-primary btn-block">
              <span>Edit Voucher</span>
            </a>
          </div>
          <div class="invoice-action-btn">
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
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
@endsection