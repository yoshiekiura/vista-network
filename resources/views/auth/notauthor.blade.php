<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Vista Network | Authorization
  </title>
  <link rel="apple-touch-icon" href="{{ URL::asset('app-assets/images/ico/apple-icon-120.png') }}">
  <link href="{{ URL::asset('front/img/assets/favicon2.png') }}" rel="shortcut icon" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/vendors.css') }}">
  <!-- END VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/sweetalert.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/app.css') }}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/colors/palette-gradient.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/cryptocoins/cryptocoins.css') }}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
  <!-- END Custom CSS-->
  
</head>

<body class="horizontal-layout horizontal-menu horizontal-menu-padding 2-columns   menu-expanded"
data-open="click" data-menu="horizontal-menu" data-col="2-columns">

<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{ route('home') }}">
              <img alt="Vista Logo" src="{{ URL::asset('assets/images/fontend_logo/logo.png') }}" style="width: 120px; height: 45px; margin-top: -8px;">
          <!--    <h3 class="brand-text">Modern Admin</h3> -->
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container container center-layout">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
              <div class="search-input">
                <input class="input" type="text" placeholder="Explore Modern...">
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700">{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}</span>
                </span>
                <span class="avatar avatar-online">
                  @if(Auth::user()->image == "")
                  <img src="{{ URL::asset('app-assets/images/portrait/small/avatar-s-19.png') }}" alt="avatar"><i></i>
                  @else
                  @php
                    $image = Auth::user()->image;
                  @endphp
                  <img src="{{ URL::asset('assets/images/user_profile_pic/'.$image) }}" alt="avatar"><i></i>
                  @endif
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="app-content container center-layout mt-2">
    <div class="content-wrapper">

        @if (Session::has('alert'))
            <div class="alert bg-danger alert-dismissible mb-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Oh snap!</strong> {{ Session::get('alert') }}
            </div>
        @endif
        @if (Session::has('message'))
            <div class="alert bg-success alert-dismissible mb-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Well done!</strong> {{ Session::get('message') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert bg-success alert-dismissible mb-2" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Well done!</strong> {{ Session::get('success') }}
            </div>
        @endif    

        <div class="content-body">
            <section id="basic-examples">

                @if (Auth::user()->status != '1')
                    <div class="bs-callout-danger callout-border-left callout-transparent mt-1 p-1" style="background-color: #ffffff;">
                        <h4 class="danger">Oh Snap!</h4>
                        <p>Your account is Deactivated.</p>
                    </div>
                    <br/>

                @elseif(Auth::user()->emailv != '1')
                <div class="row">
                    <div class="col-xl-6 col-md-12 col-sm-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <h4 class="card-title">Please verify your Email</h4>
                            <h6 class="card-subtitle text-muted">Your Email</h6>
                          </div>
                          <div class="card-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <h3>{{Auth::user()->email}}</h3>
                                </div>    
                            </div>    
                            <form class="form" action="{{ route('sendemailver') }}" method="POST">
                              {{csrf_field()}}  
                              <div class="form-actions center">
                                <button type="submit" class="btn btn-block btn-warning">Send Verification Code</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <h4 class="card-title">Verify Code</h4>
                          </div>
                          <div class="card-body">
                            <form class="form" action="{{ route('emailverify') }}" method="POST">
                              {{csrf_field()}}
                              <div class="form-body">
                                <div class="form-group">
                                  <label for="donationinput1" class="sr-only">Name</label>
                                  <input type="text" class="form-control" name="code" placeholder="Enter Verification Code" required>
                                </div>
                              </div>
                              <div class="form-actions center">
                                <button type="submit" class="btn btn-block btn-primary">Verify</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @elseif(Auth::user()->smsv != '1')
                <div class="row">
                    <div class="col-xl-6 col-md-12 col-sm-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <h4 class="card-title">Please verify your Mobile</h4>
                            <h6 class="card-subtitle text-muted">Your Mobile</h6>
                          </div>
                          <div class="card-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <h3>{{Auth::user()->mobile}}</h3>
                                </div>    
                            </div>    
                            <form class="form" action="{{route('sendsmsver')}}" method="POST">
                              {{csrf_field()}}  
                              <div class="form-actions center">
                                <button type="submit" class="btn btn-block btn-warning">Send Verification Code</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <h4 class="card-title">Verify Code</h4>
                          </div>
                          <div class="card-body">
                            <form class="form" action="{{route('smsverify') }}" method="POST">
                              {{csrf_field()}}
                              <div class="form-body">
                                <div class="form-group">
                                  <label for="donationinput1" class="sr-only">Name</label>
                                  <input type="text" class="form-control"  name="code" placeholder="Enter Verification Code" required>
                                </div>
                              </div>
                              <div class="form-actions center">
                                <button type="submit" class="btn btn-block btn-primary">Verify</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @elseif(Auth::user()->tfver != '1')
                <div class="row justify-content-center">
                    <div class="col-6">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <h4 class="card-title">Verify Google Authenticator Code</h4>
                          </div>
                          <div class="card-body">
                            <form class="form" action="{{route('go2fa.verify') }}" method="POST">
                              {{csrf_field()}}
                              <div class="form-body">
                                <div class="form-group">
                                  <label for="donationinput1" class="sr-only">Name</label>
                                  <input type="text" class="form-control" name="code" required placeholder="Enter Google Authenticator Code">
                                </div>
                              </div>
                              <div class="form-actions center">
                                <button type="submit" class="btn btn-block btn-primary">Verify</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endif    
            </section>
        </div>

    </div>
  </div>

  <footer class="footer footer-transparent footer-light navbar-shadow fixed-bottom">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 container center-layout">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="http://vista.network"
        target="_blank">Vista Network </a>, All rights reserved. </span>
    <!--  <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span> -->
    </p>
  </footer>              

    <!-- BEGIN VENDOR JS-->
  <script src="{{ URL::asset('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
  <script src="{{ URL::asset('app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script> 
  <script src="{{ URL::asset('app-assets/vendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script> 
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{ URL::asset('app-assets/js/scripts/pages/dashboard-crypto.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/scripts/extensions/sweet-alerts.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/scripts/tables/datatables/datatable-styling.js') }}"
  type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->

</body>
</html>
