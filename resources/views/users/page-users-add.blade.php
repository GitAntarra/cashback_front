@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Users Edit')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
@endsection

{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

@section('content')
<!-- users edit start -->
<section class="users-edit">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <div class="tab-content">
          <div class="col-12 col-sm-6">
            <ul class="nav nav-tabs mb-2" role="tablist">
              <li class="nav-item">
                  <div class="row">
                  <i class="bx bx-group mr-25"></i><h5>Add User</h5>
                  </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="tab-content">
            <form class="form_input" action="{{ route('adduser.post')}}"  method="post" id="input_form">
            @csrf
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <div class="controls">
                                <label>Personal Number</label>
                                <fieldset>
                                <div class="input-group">
                                  <input type="text" maxlength="8" id="pernr" name="pernr" class="form-control" data-validation-required-message="This Personal Number field is required" placeholder="Recipient's Personal Number" aria-describedby="button-addon2">
                                  <div class="input-group-append" id="button-addon2">
                                    <button class="btn btn-primary" type="button" value="cari" id="btn_cari">Find</button>
                                  </div>
                                </div>
                              </fieldset>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <label>Brilian Name</label>
                                <input type="text" name="name" id="name" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <label>Unit Code</label>
                                <input type="text" name="unit_code" id="unit_code" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <label>Unit Work</label>
                                <input type="text" name="ukerdesc" id="ukerdesc" class="form-control" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label>Region Code</label>
                            <input type="text" name="region_code" id="region_code" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                        <label>Regional Name</label>
                            <input type="text" name="region_name" id="region_name" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                        <label>Branch</label>
                            <input type="text" name="branch" id="branch" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" id="level" name="level" required>
                              @foreach ($opt_level as $key => $value) 
                              <option value="{{ $key }}" {{ ( $key == $selectedLevel) ? 'selected' : '' }}>  
                                {{ $value }}  
                              </option> 
                               @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" id="btn_submit"><i class="bx bx-check"></i> Submit</button>
                        <button type="button" class="btn btn-danger" id="back_info"><i class="bx bx-x"></i> Back</button>
                    </div>
                </div>
            </form>
            <!-- users edit account form ends -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users edit ends -->
@endsection



{{-- vendor scripts --}}
@section('vendor-scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

		$('#btn_cari').click(function(e) {
			e.preventDefault();
			if($(this).attr("value")=="cari"){
				var pn = $("#pernr").val();
        $.ajax({
					url: "{{ route('getEmployee.post')}}",
					data: {
						pernr: pn
					},
					type: 'post',
					dataType: "JSON",
					beforeSend:function(){
						$('#ajax-loader').show();
					},
					success:function(res){
						$('#ajax-loader').hide();
						console.log(res.error)
						if(!res.error){
							$("#pernr").val(res.pernr);
							$("#pernr").attr('readonly', true);
							$("#name").val(res.name);
							$("#unit_code").val(res.uker);
							$("#ukerdesc").val(res.uker);
							$("#region_code").val(res.region_code);
							$("#branch").val(res.branch);
							$("#region_name").val(res.region_name);
							$("#btn_cari").attr('disabled', true);
							$("#back_info").text('Cancel');
						}else{
							alert(res.msg);
						}
					}
				});
			}

		});

    // $("#btn_submit").off().click(function(){
    //   var pn = $("#pernr").val();
    //   var level = $("#level").val();
    //   var status = $("#status").val();
    //   var desc = "TEST DESC";
		// 	$.ajax({
    //     type: "post",
    //     url: "/users/register"
    //     // url: "{{ route('adduser.post')}}",
    //     data: {
    //       pernr : pn,
    //       level : level,
    //       status : status,
    //       description : desc
    //     },
    //     beforeSend:function(){
		// 			$('#ajax-loader').show();
		// 		},
		// 		success:function(response){
		// 			$('#ajax-loader').hide();
		// 			$('.main-content').html(response);
    //       toastr.success('babbaba','wwwww');
		// 		},
    //     error:function(err){
    //       console.log(err)
    //       toastr.error('babbaba','wwwww');
    //     }
    //   });
		// });

    $("#back_info").off().click(function(){
			var text = $("#back_info").text();

			if(text == 'Cancel'){
				$("#pernr").val('');
				$("#name").val('');
				$("#unit_code").val('');
				$("#ukerdesc").val('');
				$("#region_code").val('');
				$("#branch").val('');
				$("#region_name").val('');
				$("#level").val('');
				// $('#input_form')[0].reset();
				$("#pernr").attr('readonly', false);
				$("#btn_cari").attr('disabled', false);
				$("#back_info").text('Back');
			}else{
				history.go(-1);
			}
		});


	});
</script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
<script src="{{asset('js/scripts/navs/navs.js')}}"></script>
@endsection
