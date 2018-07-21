<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Crypto Dashboard - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin
    Dashboard
  </title>
  <link rel="apple-touch-icon" href="{{ URL::asset('app-assets/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('app-assets/images/ico/favicon.ico') }}">
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
        <!--    <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>
              <ul class="mega-dropdown-menu dropdown-menu row">
                <li class="col-md-2">
                  <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-newspaper-o"></i> News</h6>
                  <div id="mega-menu-carousel-example">
                    <div>
                      <img class="rounded img-fluid mb-1" src="{{ URL::asset('app-assets/images/slider/slider-2.png') }}"
                      alt="First slide"><a class="news-title mb-0" href="#">Poster Frame PSD</a>
                      <p class="news-content">
                        <span class="font-small-2">January 26, 2018</span>
                      </p>
                    </div>
                  </div>
                </li>
                <li class="col-md-3">
                  <h6 class="dropdown-menu-header text-uppercase"><i class="la la-random"></i> Drill down menu</h6>
                  <ul class="drilldown-menu">
                    <li class="menu-list">
                      <ul>
                        <li>
                          <a class="dropdown-item" href="layout-2-columns.html"><i class="ft-file"></i> Page layouts & Templates</a>
                        </li>
                        <li><a href="#"><i class="ft-align-left"></i> Multi level menu</a>
                          <ul>
                            <li><a class="dropdown-item" href="#"><i class="la la-bookmark-o"></i>  Second level</a></li>
                            <li><a href="#"><i class="la la-lemon-o"></i> Second level menu</a>
                              <ul>
                                <li><a class="dropdown-item" href="#"><i class="la la-heart-o"></i>  Third level</a></li>
                                <li><a class="dropdown-item" href="#"><i class="la la-file-o"></i> Third level</a></li>
                                <li><a class="dropdown-item" href="#"><i class="la la-trash-o"></i> Third level</a></li>
                                <li><a class="dropdown-item" href="#"><i class="la la-clock-o"></i> Third level</a></li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="la la-hdd-o"></i> Second level, third link</a></li>
                            <li><a class="dropdown-item" href="#"><i class="la la-floppy-o"></i> Second level, fourth link</a></li>
                          </ul>
                        </li>
                        <li>
                          <a class="dropdown-item" href="color-palette-primary.html"><i class="ft-camera"></i> Color palette system</a>
                        </li>
                        <li><a class="dropdown-item" href="sk-2-columns.html"><i class="ft-edit"></i> Page starter kit</a></li>
                        <li><a class="dropdown-item" href="changelog.html"><i class="ft-minimize-2"></i> Change log</a></li>
                        <li>
                          <a class="dropdown-item" href="https://pixinvent.ticksy.com/"><i class="la la-life-ring"></i> Customer support center</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="col-md-3">
                  <h6 class="dropdown-menu-header text-uppercase"><i class="la la-list-ul"></i> Accordion</h6>
                  <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                    <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                      <div class="card-header p-0 pb-2 border-0" id="headingOne" role="tab"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionOne"
                        aria-expanded="true" aria-controls="accordionOne">Accordion Item #1</a></div>
                      <div class="card-collapse collapse show" id="accordionOne" role="tabpanel" aria-labelledby="headingOne"
                      aria-expanded="true">
                        <div class="card-content">
                          <p class="accordion-text text-small-3">Caramels dessert chocolate cake pastry jujubes bonbon.
                            Jelly wafer jelly beans. Caramels chocolate cake liquorice
                            cake wafer jelly beans croissant apple pie.</p>
                        </div>
                      </div>
                      <div class="card-header p-0 pb-2 border-0" id="headingTwo" role="tab"><a class="collapsed" data-toggle="collapse" data-parent="#accordionWrap"
                        href="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">Accordion Item #2</a></div>
                      <div class="card-collapse collapse" id="accordionTwo" role="tabpanel" aria-labelledby="headingTwo"
                      aria-expanded="false">
                        <div class="card-content">
                          <p class="accordion-text">Sugar plum bear claw oat cake chocolate jelly tiramisu
                            dessert pie. Tiramisu macaroon muffin jelly marshmallow
                            cake. Pastry oat cake chupa chups.</p>
                        </div>
                      </div>
                      <div class="card-header p-0 pb-2 border-0" id="headingThree" role="tab"><a class="collapsed" data-toggle="collapse" data-parent="#accordionWrap"
                        href="#accordionThree" aria-expanded="false" aria-controls="accordionThree">Accordion Item #3</a></div>
                      <div class="card-collapse collapse" id="accordionThree" role="tabpanel" aria-labelledby="headingThree"
                      aria-expanded="false">
                        <div class="card-content">
                          <p class="accordion-text">Candy cupcake sugar plum oat cake wafer marzipan jujubes
                            lollipop macaroon. Cake dragée jujubes donut chocolate
                            bar chocolate cake cupcake chocolate topping.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="col-md-4">
                  <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-envelope-o"></i> Contact Us</h6>
                  <form class="form form-horizontal">
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputName1">Name</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <input class="form-control" type="text" id="inputName1" placeholder="John Doe">
                            <div class="form-control-position pl-1"><i class="la la-user"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputEmail1">Email</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <input class="form-control" type="email" id="inputEmail1" placeholder="john@example.com">
                            <div class="form-control-position pl-1"><i class="la la-envelope-o"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputMessage1">Message</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <textarea class="form-control" id="inputMessage1" rows="2" placeholder="Simple Textarea"></textarea>
                            <div class="form-control-position pl-1"><i class="la la-commenting-o"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 mb-1">
                          <button class="btn btn-info float-right" type="button"><i class="la la-paper-plane-o"></i> Send </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </li>
              </ul>
            </li> -->
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
            <div class="alert alert-danger mb-2">{{ Session::get('alert') }}</div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-success mb-2">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success mb-2">{{ Session::get('success') }}</div>
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
                            <form class="form" action="{{route('sendemailver')}}" method="POST">
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
                            <form class="form" action="{{route('emailverify') }}" method="POST">
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
