@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Voucher List')
{{-- vendor style --}}
@section('vendors-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
@endsection
{{-- page style --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-voucher.css')}}">
@endsection
@section('content')
<!-- invoice list -->
<section class="invoice-list-wrapper">
  <!-- create invoice button-->
  <div class="invoice-create-btn mb-1">
    <!-- <a href="{{asset('app-invoice-add')}}" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true"
      >Create Voucher</a> -->
    <button type="button" class="btn btn-primary glow" data-toggle="modal"
              data-target="#exampleModalScrollable">
              <i class="bx bx-plus"></i>
              Create Voucher
            </button>

            <!--scrolling content Modal -->
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Create Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="bx bx-x"></i>
                    </button>
                  </div>
                  <form method="post" action="{{route('createvoucher.post')}}" id="form_input">
                    @csrf
                  <div class="modal-body">
                    <div class="col-12 pb-1">
                        <div class="row">
                            <div class="col-3">
                                <label>CODE</label>
                            </div>
                            <div class="col-9">
                            <input require class="form-control" name="vouchercode" id="vouchercode" placeholder="Voucher Code" type="text" onkeyup="
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
                            <input require type="text" name="type" id="type" value="CASHBACK" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-1">
                        <div class="row">
                            <div class="col-3">
                                <label>LIMIT</label>
                            </div>
                            <div class="col-9">
                                <input require type="number" name="limit" id="limit" class="touchspin">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-1">
                        <div class="row">
                            <div class="col-3">
                                <label>DUE DATE</label>
                            </div>
                            <div class="col-9">
                            <input require type="date" name="duedate" id="duedate" class="form-control" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-1">
                        <div class="row">
                            <div class="col-3">
                                <label>MINIMAL TRANSACTION</label>
                            </div>
                            <div class="col-9">
                                <input require type="text" name="mintransaction" id="mintransaction" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-1">
                        <div class="row">
                            <div class="col-3">
                                <label>MAXIMAL POTENCY</label>
                            </div>
                            <div class="col-9">
                                <input require type="text" name="maxpotency" id="maxpotency" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-1">
                        <div class="row">
                            <div class="col-3">
                                <label>PERCENT</label>
                            </div>
                            <div class="col-9">
                            <input require type="text" name="percent" id="percent" class="touchspin"  data-bts-postfix="%" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-1">
                        <div class="row">
                            <div class="col-3">
                                <label>MAXIMAL REDEEM</label>
                            </div>
                            <div class="col-9">
                                <input require type="number" name="maxredeem" id="maxredeem" class="touchspin">
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
                  </div>
                  </form>
                </div>
              </div>
            </div>
  </div>

  <!-- Options and filter dropdown button-->
  <div class="action-dropdown-btn d-none">
    <div class="dropdown invoice-options">
      <button
        class="btn border dropdown-toggle mr-2"
        type="button"
        id="invoice-options-btn"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        Options
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-options-btn">
        <a class="dropdown-item" href="#">Delete</a>
        <a class="dropdown-item" href="#">Edit</a>
        <a class="dropdown-item" href="#">View</a>
        <a class="dropdown-item" href="#">Send</a>
      </div>
      <div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th>
            <span class="align-middle">Code</span>
          </th>
          <th>Type</th>
          <th>Date</th>
          <th>Limit</th>
          <th>Min</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $voucherData = $list_voucher['data']; ?>
        @if(isset($voucherData) && !empty($voucherData))
        @foreach($voucherData as $row)
        <tr>
            <td></td>
            <td></td>
            <td><a href="{{asset('app-invoice-view')}}">{{$row['code']}}</a></td>
            <td><span>{{$row['type']}}</span></td>
            <td><span>{{date('d-m-Y', strtotime($row['dueDate']))}}</span></td>
            <td><span>{{$row['limit']}}</span></td>
            <td><span>Rp. {{$row['minTransaction']}}</span></td>
            <td><span class="badge badge-light-success badge-pill">ACTIVE</span></td>
            <td>
            <div class="invoice-action">
              <a href="{{asset('app-invoice-view')}}" class="invoice-action-view mr-1">
                <i class="bx bx-show-alt"></i>
              </a>
              <a href="{{asset('app-invoice-edit')}}" class="invoice-action-edit cursor-pointer">
                <i class="bx bx-edit"></i>
              </a>
            </div>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</section>
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