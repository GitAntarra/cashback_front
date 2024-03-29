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
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
            <!-- user profile nav tabs profile start -->
                <div class="card ">
                    <div class="card-header text-white bg-primary bg-lighten-1 pt-0 pb-0">
                        <b><i class="bx bx-user pt-1 pb-1"></i> PROFIL PENGGUNA</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="row justify-content-flex-start">
                                <?php $user = Session::get('set_userdata'); ?>
                                <div class="col-3 col-sm-3 text-center mb-1 mb-sm-0">
                                    <img src="{{ $user['foto'] }}" class="rounded"
                                    alt="group image" height="120" width="120" />
                                </div>
                                <div class="col-8 col-sm-8">
                                    <div class="profile-widget-description pb-0">
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Name  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: {{$user['name']}} </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Personal Number  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['pernr'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Region  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['region'] ?> - {{$user['brdesc']}}</div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Office  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['branch'] ?> - {{$user['brdesc']}}({{$user['uker']}})</div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Position  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['position'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Division  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['division'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Uker  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['department'] ?> </div>
                                        </div>
                                        <div class="row p-0 m-0">
                                            <div class="col-md-2 p-0 m-0 profile-widget-name"> Level  </div>
                                            <div class="col-md-10 text-left m-0 p-0">: <?= $user['level'] ?> </div>
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
        @if($user['level'] == 'SUPERADMIN')
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card bg-primary bg-lighten-1">
                <div class="card-content">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-12 d-flex align-items-center justify-content-center p-1">
                    <img src="{{asset('images/elements/user.png')}}" height="258px" class="card-img img-fluid"
                        alt="user.png">
                    </div>
                    <div class="col-lg-8 col-md-12">
                    <div class="card-body text-center p-2">
                        <h4 class="card-title white mb-0">USER</h4>
                        <p class="card-text white mb-0">{{($data['userCount']) ? $data['userCount'] : 0}}<br> Active User</p>
                        <a href="{{asset('/user-management')}}" class="btn btn-secondary pt-0 pb-0"><i class="bx bx-show-alt"></i> View</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endif
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card bg-warning bg-lighten-1">
                <div class="card-content">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-12 d-flex align-items-center justify-content-center p-1">
                    <img src="{{asset('images/elements/voucher.png')}}" class="card-img img-fluid"
                        alt="apple-lap.png">
                    </div>
                    <div class="col-lg-8 col-md-12">
                    <div class="card-body text-center p-2">
                        <h4 class="card-title white mb-0">VOUCHER</h4>
                        <p class="card-text white mb-0">{{($data['voucherCount']) ? $data['voucherCount'] : 0}}<br>  {{($user['level'] == 'CHECKER' || $user['level'] == 'SIGNER') ? 'Voucher Requested' : 'Active Voucher'}} </p>
                        <a href="{{asset('/list-voucher')}}" class="btn btn-secondary pt-0 pb-0"><i class="bx bx-show-alt"></i> View</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card bg-success bg-lighten-1">
                <div class="card-content">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-12 d-flex align-items-center justify-content-center p-1">
                    <img src="{{asset('images/elements/bullhorn.png')}}" height="258px" class="card-img img-fluid"
                        alt="apple-lap.png">
                    </div>
                    <div class="col-lg-8 col-md-12">
                    <div class="card-body text-center p-2">
                        <h4 class="card-title white mb-0">CHANNEL</h4>
                        <p class="card-text white mb-0">{{($data['channelCount']) ? $data['channelCount'] : 0}}<br>  Active Channel</p>
                        <a href="{{asset('/list-channel')}}" class="btn btn-secondary pt-0 pb-0"><i class="bx bx-show-alt"></i> View</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card bg-danger bg-lighten-1">
                <div class="card-content">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-12 d-flex align-items-center justify-content-center p-1">
                    <img src="{{asset('images/elements/team-work.png')}}" class="card-img img-fluid"
                        alt="apple-lap.png">
                    </div>
                    <div class="col-lg-8 col-md-12">
                    <div class="card-body text-center p-2">
                        <h4 class="card-title white mb-0">FEATURE</h4>
                        <p class="card-text white mb-0">{{($data['featureCount']) ? $data['featureCount'] : 0}}<br>  Active Voucher</p>
                        <a href="{{asset('/main-feature')}}" class="btn btn-secondary  pt-0 pb-0"><i class="bx bx-show-alt"></i> View</a>
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

