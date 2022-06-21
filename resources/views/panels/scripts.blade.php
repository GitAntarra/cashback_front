
    <!-- BEGIN: Vendor JS-->
    <script>
        var assetBaseUrl = "{{ asset('') }}";
    </script>
    <script src="{{asset('vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
    <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('assets/select2/js/select2.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @yield('vendor-scripts')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    @if($configData['mainLayoutType'] == 'vertical-menu')
    <script src="{{asset('js/scripts/configs/vertical-menu-light.js')}}"></script>
    @else
    <script src="{{asset('js/scripts/configs/horizontal-menu.js')}}"></script>
    @endif
    <script src="{{asset('js/core/app-menu.js')}}"></script>
    <script src="{{asset('js/core/app.js')}}"></script>
    <script src="{{asset('js/scripts/components.js')}}"></script>
    <script src="{{asset('js/scripts/footer.js')}}"></script>
    <script src="{{asset('js/scripts/customizer.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script>
        let tipe = $(".jstoast").attr('id');
        let message = $(".jstoast").attr('val');
        if(tipe){
            if(tipe == "message"){
                toastr.info(message,"Cashback");
            }else if(tipe == "info"){
                toastr.info(message,"Cashback");
            }else if(tipe == "success"){
                toastr.success(message,"Cashback");
            }else if(tipe == "warning"){
                toastr.warning(message,"Cashback");
            }else if(tipe == "error"){
                toastr.error(message,"Cashback");
            }else if(tipe == "show"){
                toastr.show(message,"Cashback");
            }           
        }

    </script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @yield('page-scripts')
    <!-- END: Page JS-->
