@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Dashboard')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard">
    <div class="row">
        <div class="col-12">
            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
            <!-- user profile nav tabs profile start -->
                <div class="card">
                    <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <?php $user = Session::get('set_userdata'); ?>
                                <div class="col-12 col-sm-2 text-center mb-1 mb-sm-0">
                                    <img src="{{ $user['foto'] }}" class="rounded"
                                    alt="group image" height="120" width="120" />
                                </div>
                                <div class="col-12 col-sm-10">
                                    <div class="profile-widget-description pb-0">
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Name  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['name'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Personal Number  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['pernr'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Organization Unit  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['brdesc'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Region  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['region'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Posision  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['position'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Division  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['division'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Uker  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['uker'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Level  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['level'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Branch  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['branch'] ?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection

