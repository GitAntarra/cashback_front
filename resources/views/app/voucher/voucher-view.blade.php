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
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['channel']['channel_id']}}</b></h6>
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
                      <h6 class="text-primary font-weight-bold"><b>: {{$data['channel']['channel_id']}}</b></h6>
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
                <h6 class="invoice-from">Deposit Account</h6>
              </div>
              <div class="col-9">
                <h6 class="text-primary font-weight-bold"><b>: {{$data['depositaccount']['account_number']}} - {{$data['depositaccount']['short_name']}}</b></h6>
              </div>
              <div class="col-3">
                <h6 class="invoice-from">Description</h6>
              </div>
              <div class="col-9">
                <p class="text-primary">: {{$data['description']}}</p>
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
            <button class="btn btn-light-primary btn-block showModalEdit" data-toggle="modal"
              data-target="#editVoucherModal" title="Edit Voucher">
              <span>Edit Voucher</span>
            </button>
          </div>
          <div class="invoice-action-btn pt-1">
            <form action="{{route('editVoucher.post')}}?id={{$data['id']}}" method="POST">
            @csrf
            <input type="text" name="statusVoucher" id="statusVoucher" value="{{$data['status']}}" hidden />
            <button type="submit" name="approveVoucher" value="1" class="btn btn-success btn-block approval">
              <i class='bx bx-check'></i>
              <span>Approve</span>
            </button>
            <button type="button" name="rejectVoucher" value="1" class="btn btn-danger btn-block reject">
              <i class='bx bx-x'></i>
              <span>Reject</span>
            </button>
            </form>
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
      <form method="post" action="{{route('editVoucher.post')}}?id={{$data['id']}}" id="form_input">
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
                    <label>CHECKER</label>
                </div>
                <div class="col-9">
                <select name="checkerEdit" id="checkerEdit" class="custom-select" required>
                    <option value="tes">checker</option>
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
                <select name="signerEdit" id="signerEdit" class="custom-select" required>
                    <option value="tes">signer</option>
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
<script type="text/javascript">
  
  $('.approval').on('click', function () {
    alert({{$data['description']}});
      //   let idFeature = $(this).attr("idFeature");
      //   Swal.fire({
      //     title: 'Are you sure?',
      //     text: "You want to delete this Feature?",
      //     type: 'warning',
      //     showCancelButton: true,
      //     confirmButtonColor: '#3085d6',
      //     cancelButtonColor: '#d33',
      //     confirmButtonText: 'Yes, delete it!',
      //     confirmButtonClass: 'btn btn-warning',
      //     cancelButtonClass: 'btn btn-danger ml-1',
      //     buttonsStyling: false,
      //   }).then(function (result) {
      //     if (result.value) {
      //       $.ajax({
      //         type  : "GET",
      //         url   : "{{asset('/delete-feature')}}",
      //         data  : {
      //             idFeature : idFeature,
      //         },
      //         success: function(response) {
      //           console.log(response);
      //           Swal.fire({
      //             type: "success",
      //             title: 'Deleted!',
      //             text: 'Your file has been deleted.',
      //             confirmButtonClass: 'btn btn-success',
      //           }).then((w) =>{
      //               location.reload(true);
      //           });
      //         },
      //         failure: function (response) {
      //             swal(
      //             "Internal Error",
      //             "Oops, your note was not saved.", // had a missing comma
      //             "error"
      //             )
      //         }
      //       });
      //     }
      //     else if (result.dismiss === Swal.DismissReason.cancel) {
      //       Swal.fire({
      //         title: 'Cancelled',
      //         text: 'Your Feature is safe :)',
      //         type: 'error',
      //         confirmButtonClass: 'btn btn-success',
      //       })
      //     }
      //   });
      // });
    });
  

  showsubFeature();

  function showsubFeature(){
    let idmain = $('#mainFeatureEdit').find('option:selected').attr('idmain');
    console.log(idmain);
    $.ajax({
      type : "GET",
      url  : "{{asset('/getsubFeature')}}?id="+idmain,
      success : function(data){
        console.log(data);
          $('#formSubFeature').empty();
          if(data.length !== 0){

            var html = `<div class="row">
                <div class="col-3">
                    <label>SUB FEssATURE</label>
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