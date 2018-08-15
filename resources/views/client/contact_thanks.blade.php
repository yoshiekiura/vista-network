<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vista Network">
    <meta name="author" content="Vibetron">

    <title>Vista Network - Client Portal</title>

    <link href="{{ URL::asset('front/img/assets/favicon2.png') }}" rel="icon" type="image/ico">

    <link href="{{ URL::asset('front/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/css/effects.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/css/backgrounds.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ URL::asset('front/fonts/FontAwesome/stylesheet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/fonts/Ion_Icons/stylesheet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/fonts/ElegantThemes_Icons/stylesheet.css') }}" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Start Header Section -->
    <nav class="navbar navbar-default transparent-white navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-main-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-bar"></span>
                    <span class="icon-bar middle-bar"></span>
                    <span class="icon-bar bottom-bar"></span>
                </button>
                <a data-scroll href="{{ url('/') }}" class="navbar-brand">
                    <!-- <img src="{{ URL::asset('front/img/assets/logo-light.png') }}" class="logo-light" alt="#">
                    <img src="{{ URL::asset('front/img/assets/logo-dark.png') }}" class="logo-dark" alt="#"> -->
                    <img alt="Vista Logo" src="{{ URL::asset('assets/images/fontend_logo/logo.png') }}">
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a data-scroll href="{{ url('/') }}">Home</a>
                    </li>
                    @if (Route::has('login'))
                    @auth
                    <li>
                        <a href="{{ url('/home') }}">Dashboard</a>
                    </li>    
                    @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header Section -->

    <!-- Start Hero Section -->
    <section id="contact-page" class="page-wrap contact">
        <div class="hero-container container">
            <div class="hero-content">
                <div class="col-sm-12 m-auto text-center white">
                    <h3 class="h1-md mb10 text-uppercase">Contact Us</h3>
                    <h4 class="subheading"><a data-scroll href="{{ url('/') }}">Home</a> / contact</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start Contact Section -->
    <section id="contact-form" >
        <div class="container pt100 pb100">
            <div class="heading m-auto text-center mb30">
                <h2 class="f-xbold">Thanks</h2>
                <hr class="seperator">
                <h4 class="text-success">Your message has sent successfully.</h4>
                <br/>
                <p class="text-justify">Thanks for writing us. We'll do our best to get you a reply in short order. We've also just automatically sent you a copy of your message, so you'll have that to refer back to, if needed.</p>
            </div>
        </div>
    </section>
    <!-- End Contact Section -->
     
    <!-- Start Footer section    -->
<footer id="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="widget footer-widget">
                        <h4>We accept</h4>
                        <ul class="list-inline coin-widget">
                            <li><a href="#"><i class="fa  fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa  fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa  fa-cc-amex"></i></a></li>
                            <li><a href="#"><i class="fa  fa-cc-stripe"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-6">
                    <div class="widget news-widget">
                        <h4>Vista Menu</h4>
                        
                        <ul>
                            <li><a data-scroll href="#hero">Home</a></li>
                            <li><a data-scroll href="#services">Services</a></li>
                            <li><a data-scroll href="#about">About</a></li>
                            <li><a data-scroll href="#features">Features</a></li>
                            <li><a data-scroll href="#faq">FAQ</a></li>
                            <li><a data-scroll href="#contact-form">Contact Us</a></li>
                        </ul>
                    </div>
                </div> 
                
                <div class="col-md-2 col-sm-6">
                    <div class="widget news-widget">
                        <h4>Client Resources</h4>
                        
                        <ul>
                            <li><a href="{{ route('login') }}">My Wallet</a></li>
                            <li><a href="{{ route('login') }}">Open Support Ticket</a></li>
                            <li><a href="{{ route('login') }}">Buy Products</a></li>
                            <li><a href="{{ route('login') }}">Buy Coins</a></li>
                            <li><a href="{{ route('login') }}">Buy Mini Miner</a></li>
                            <li><a href="{{ route('login') }}">Hash Power</a></li>
                        </ul>
                    </div>
                </div>
            <!--    <div class="col-md-2 col-sm-6">
                    <div class="widget news-widget">
                        <h4>Custom Index Price</h4>
                        
                        <ul>
                            <li><a href="#">Currency Market</a></li>
                            <li><a href="#">Unlimited API request</a></li>
                            <li><a href="#">Bitcoin Price report 2016</a></li>
                            <li><a href="#">Average Bitcoin Price</a></li>
                            <li><a href="#">API Documentation</a></li>
                            <li><a href="#">API Statics</a></li>
                        </ul>
                    </div>
                </div> -->
                
                <div class="col-md-5 col-sm-6">
                    <div class="widget contact-widget">
                        <h4>Contact Us</h4>
                        
                        <ul class="footer-contact">
                            @foreach($general as $gen)
                            <li><i class="fa fa-map-marker"></i>{{ $gen->address }} </li>
                            <li><i class="fa fa-phone"></i> <span>{{ '+1 ' . $gen->mobile }}</span></li>
                            <li><i class="fa fa-envelope-o"></i> <span>{{ $gen->email }}</span></li>
                            @endforeach
                        </ul>
                        
                        <ul class="list-inline">
                            <li><a href="https://www.facebook.com/vistanetworklive"><i class="icon ion-social-facebook"></i></a></li>
                            <li><a href="https://twitter.com/vistanetworkus"><i class="icon ion-social-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/vistanetworkus/"><i class="icon ion-social-instagram"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCXyM4uK1xfwrFf_X6jneFCQ"><i class="icon ion-social-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="copy ">All Copyright Reserved to <span>Vista Network</span> 2018</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer section    -->
 
    <!-- Start Back To Top -->
    <a data-scroll id="back-to-top" href="#contact-page"><i class="icon ion-chevron-up"></i></a>
    <!-- End Back To Top -->


    <!--   JQUERY FILES     -->
    <script src="{{ URL::asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('front/js/waypoint.min.js') }}"></script>
    <script src="{{ URL::asset('front/js/counterup.min.js') }}"></script>
    <script src="{{ URL::asset('front/js/plugins.js') }}"></script>
    <script src="{{ URL::asset('front/js/scripts.js') }}"></script>
</body>

</html>