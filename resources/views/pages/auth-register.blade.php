@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Register Page')
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- register section starts -->
<section class="row flexbox-container">
  <div class="col-xl-8 col-10">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- register section left -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">Sign Up</h4>
              </div>
            </div>
            <div class="card-content">
              <div class="card-body">
                <form >
                  @csrf
                    <div class="form-group mb-50">
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

                    <div class="form-group mb-50">
                      <label>Brilian Name</label>
                      <input type="text" name="name" id="name" class="form-control" readonly />
                    </div>
                    <div class="form-group mb-50">
                      <label>Unit Work</label>
                      <input type="text" name="unit_work" id="unit_work" class="form-control" readonly />
                    </div>
                    <div class="form-group mb-50">
                      <label>Region Code</label>
                      <input type="text" name="reg_code" id="reg_code" class="form-control" readonly />
                    </div>
                    <div class="form-group mb-50">
                      <label>Regional Name</label>
                      <input type="text" name="reg_name" id="reg_name" class="form-control" readonly />
                    </div>
                    <div class="form-group mb-50">
                      <label>Branch</label>
                      <input type="text" name="branch" id="branch" class="form-control" readonly />
                    </div>
                    <a href="{{asset('/')}}" class="btn btn-primary glow position-relative w-100">SIGN UP<i
                      id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                    </a>
                </form>
                <hr>
                <div class="text-center"><small class="mr-25">Already have an account?</small>
                  <a href="{{asset('auth-login')}}"><small>Sign in</small> </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- image section right -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
            <img class="img-fluid" src="{{asset('images/pages/register.png')}}" alt="branding logo">
        </div>
      </div>
    </div>
  </div>
</section>

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
							$("#unit_work").val(res.uker);
							$("#reg_code").val(res.region_code);
							$("#branch").val(res.branch);
							$("#reg_name").val(res.region_name);
							$("#btn_cari").attr('disabled', true);
							$("#back_info").text('Cancel');
						}else{
							alert(res.msg);
						}
					}
				});
			}

		});
    
	});
</script>
<!-- register section endss -->
@endsection