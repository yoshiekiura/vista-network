<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BitBank,multipurpose,business,agency,modern,bootstrap,bootstrap template,responsive,html,css,unique,professional,onepage,creative,template,design,web design,crypto,bitcoin,currency">
    <meta name="author" content="Dreambuzz">

    <title>Vista Network - Client Portal</title>

    <link href="{{ URL::asset('front/img/assets/favicon2.png') }}" rel="icon" type="image/ico">

    <link href="{{ URL::asset('front/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/css/effects.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/css/backgrounds.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ URL::asset('front/fonts/FontAwesome/stylesheet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/fonts/Ion%20Icons/stylesheet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('front/fonts/ElegantThemes%20Icons/stylesheet.css') }}" rel="stylesheet" type="text/css">

</head>

<body>


    <!-- Start Preloader-->
 <!--   <div id="preloader">
        <div id="status">&nbsp;</div>
    </div> -->
    <!-- End Preloader-->


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
                        <a data-scroll href="#hero">Home</a>
                    </li>
                    <li>
                        <a data-scroll href="#services">Services</a>
                    </li>
                    <li>
                        <a data-scroll href="#about">About</a>
                    </li>

                    <li>
                        <a data-scroll href="#features">Features</a>
                    </li>

                    <li>
                        <a data-scroll href="#team">Team</a>
                    </li>
                    <li>
                        <a data-scroll href="#blog">Blog</a>
                    </li>
                    <li>
                        <a data-scroll href="#contact-form">Contact</a>
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
    <section id="hero" class="hero-main parallax ">
        <div class="hero-overlay">
            <div class="background-image">
                <img src="{{ asset('front/img/backgrounds/1526412134.jpg') }}" alt="Vista Network">
            </div>
        </div>
        <div class="hero-container container">
            <div class="hero-content">
                <div class="col-sm-12 m-auto text-center white fadeHero">
                    <h6 class="subheading" style="font-size: 16px;">Welcome to</h6>
                    <h2 class="h1-lg mb10 text-uppercase">Vista Network</h2>
                    <h5 class="lead h5-md mt30 mb20">Vista strives to build the strongest, fastest-growing, cryptocurrency network <br/> in the world backed by state-of-the-art hardware and software systems <br/> developed to provide speed, security, and reliability.</h5>
                    <a href="{{ route('register') }}" class="btn btn-default">Join Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start About Section -->
    <section id="services" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-auto text-center ">
                        <h2 class="f-xbold">Services we provide</h2>
                        <hr class="seperator">
                        <p style="font-size: 16px;">An overnight success ten years in the making, Cryptocurrency is as transformative as it is evolutionary. At last, 2018 is expected to be the year that Cryptocurrency goes mainstream for many businesses and the public. In speaking with many executives and entrepreneurs, we’ve noticed that the path towards Cryptocurrency enlightenment often hinges on corporate culture and specific marketplace conditions. Full Cryptocurrency integration often happens in stages, it’s an evolutionary process for companies and consumers alike. The time of the Blockchain has arrived.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md 3 col-sm-3">
                    <div class="service-box text-center active">
                        <div class="icon-box service-icon icon-lg">
                            <i class="icon ion-social-bitcoin" style="color: #ffffff;"></i>
                        </div>
                        <div class="service-inner">
                            <h4>Vista <span>Coin</span></h4>
                            <p>Buy Sell Transfer Vista Coins.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md 3 col-sm-3">
                    <div class="service-box text-center active">
                        <div class="icon-box service-icon icon-lg">
                            <i class="icon ion-social-bitcoin" style="color: #ffffff;"></i>
                        </div>
                        <div class="service-inner">
                            <h4>Alexa <span>Coin</span></h4>
                            <p>Buy Sell Transfer Alexa Coins.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md 3 col-sm-3">
                    <div class="service-box text-center active">
                        <div class="icon-box service-icon icon-lg">
                            <i class="icon ion-cube" style="color: #ffffff;"></i>
                        </div>
                        <div class="service-inner ">
                            <h4>HPLP <span>Program</span></h4>
                            <p>Hash Power Lay Away Program.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md 3 col-sm-3">
                    <div class="service-box text-center active">
                        <div class="icon-box service-icon icon-lg">
                            <i class="icon ion-flash-off" style="color: #ffffff;"></i>
                        </div>
                        <div class="service-inner ">
                            <h4>Mini <span>Miner</span></h4>
                            <p>Vista Mining will be an industry leading Cryptocurrency mining organization.</p>
                            <a href="#" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Service Section -->

    <!-- Start About Section -->
    <section id="about" class="pb60">
        <div class="col-md-6 col-sm-6 hidden-xs ">
            <div class="about-bg">
            
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="about-wrap">
                        <h5 class="subheading">About us</h5>
                        <h3>Secure &amp; Easy Way to Trade Bitcoin</h3>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Perspiciatis unde omnis iste natus error sit.</p>
                        <ul class="about-info-list">
                            <li><i class="icon ion-checkmark"></i> Trusted worldwide.</li>
                            <li><i class="icon ion-checkmark"></i> Securee Wallet service.</li>
                            <li><i class="icon ion-checkmark"></i> Clean Modern Design.</li>
                            <li><i class="icon ion-checkmark"></i> Bunch of Experts.</li>
                            <li><i class="icon ion-checkmark"></i> Lots Of Usefull Features.</li>
                        </ul>
                        
                        <a href="{{ route('register') }}" class="btn btn-primary ">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->

    <!-- Start HOw It Works Section -->
    <section id="howorks">
        <div class="bg-feature work-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="heading m-auto text-center ">
                            <h2 class="f-xbold" style="color: #ffffff;">How it Works</h2>
                            <hr class="seperator">
                            <p>With a belief that culture drives commerce, we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action. Our specialty of connecting brand, culture, and commerce has earned us a big reputation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="work-wrap ">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9 m-auto">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="work-inner-box">
                                    <div class="icon-box work-icon icon-lg">
                                        <img src="{{ URL::asset('front/img/icon/images.jpeg') }}" alt="" class="img-responsive">
                                    </div>
                                    <h4>create your wallet</h4>
                                    <p>Capitalise on low hanging fruit to identify a ballpark value added activity to beta test.</p>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3">
                                <div class="work-inner-box">
                                    <div class="icon-box work-icon icon-lg">
                                        <img src="{{ URL::asset('front/img/icon/payment.jpeg') }}" alt="" class="img-responsive">
                                    </div>
                                    <h4>make payments</h4>
                                    <p>Capitalise on low hanging fruit to identify a ballpark value added activity to beta test.</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="work-inner-box">
                                    <div class="icon-box work-icon icon-lg">
                                        <img src="{{ URL::asset('front/img/icon/exchange.png') }}" alt="" class="img-responsive">
                                    </div>
                                    <h4>Buy or Sell Coins</h4>
                                    <p>Capitalise on low hanging fruit to identify a ballpark value added activity to beta test.</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="work-inner-box">
                                    <div class="icon-box work-icon icon-lg">
                                        <img src="{{ URL::asset('front/img/icon/exchange.png') }}" alt="" class="img-responsive">
                                    </div>
                                    <h4>Buy or Sell Products</h4>
                                    <p>Capitalise on low hanging fruit to identify a ballpark value added activity to beta test.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End HOw It Works Section -->

    <!-- Start  Feature Section -->
    <section id="features" class="bg-gray section-padding">
        <div class="container">
            <div class="row">
                <div class="heading m-auto text-center ">
                    <h2 class="f-xbold">Why Choose Bitcoin</h2>
                    <hr class="seperator">
                    <p>With a belief that culture drives commerce, we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action. Our specialty of connecting brand, culture, and commerce has earned us a big reputation.</p>
                </div>
            </div>
            <div class="row mb50">
                <div class="col-md-4 col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <img src="{{ URL::asset('front/img/service/service-1.png') }}" alt="" class="img-responsive">
                        </div>
                        <div class="feature-inner">
                            <h4>Safe and Secure</h4>
                            <p>we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <img src="{{ URL::asset('front/img/service/service-2.png') }}" alt="" class="img-responsive">
                        </div>
                        <div class="feature-inner">
                            <h4>Make Payment</h4>
                            <p>we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <img src="{{ URL::asset('front/img/service/service-3.png') }}" alt="" class="img-responsive">
                        </div>
                        <div class="feature-inner">
                            <h4>Secure Wallet</h4>
                            <p>we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-4 col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <img src="{{ URL::asset('front/img/service/service-4.png') }}" alt="" class="img-responsive">
                        </div>
                        <div class="feature-inner">
                            <h4>Higher Availibilty</h4>
                            <p>we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <img src="{{ URL::asset('front/img/service/service-5.png') }}" alt="" class="img-responsive">
                        </div>
                        <div class="feature-inner">
                            <h4>Recurring Buying</h4>
                            <p>we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <img src="{{ URL::asset('front/img/service/service-6.png') }}" alt="" class="img-responsive">
                        </div>
                        <div class="feature-inner">
                            <h4>Instant Exchnage</h4>
                            <p>we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End  Feature Section -->
    
    <!-- Start Testimonial Section -->
    <!--
    <section id="parallax-contact" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="clients text-center">
                        <h3>Trusted Worldwide</h3>
                        <p>Get latest testimonial update</p>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-8 m-auto clients-wrap">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="client-logo">
                                <img src="{{ URL::asset('front/img/partner/partner1.png') }}" alt="" class="img-responsive center-block">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="client-logo">
                               <img src="{{ URL::asset('front/img/partner/partner2.png') }}" alt="" class="img-responsive center-block">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-26">
                            <div class="client-logo">
                                <img src="{{ URL::asset('front/img/partner/partner3.png') }}" alt="" class="img-responsive center-block">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="client-logo">
                                <img src="{{ URL::asset('front/img/partner/partner2.png') }}" alt="" class="img-responsive center-block">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
               <div class="col-md-9 m-auto">
                <div class="carousel slide" id="testimonial-carousel" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="testimonial-wrap">
                                        <p>Beatae fugit fugiat aperiam odio aliquid obcaecati ad, cupiditate sequi repudiandae necessitatibus minus debitis officia maxime id sint deserunt, quia quis mollitia.</p>
                                        
                                        <img src="img/about/tm2.jpg" alt="" class="img-responsive">
                                        <div class="client-info">
                                            <h4>Nikol Tin</h4>
                                            <p>Senior Consutant ,Softcorner INc</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="testimonial-wrap">
                                        <p>Beatae fugit fugiat aperiam odio aliquid obcaecati ad, cupiditate sequi repudiandae necessitatibus minus debitis officia maxime id sint deserunt, quia quis mollitia.</p>
                                        
                                        <img src="img/about/tm3.jpg" alt="" class="img-responsive">
                                        <div class="client-info">
                                            <h4>Martin Guptil</h4>
                                            <p>Consutant ,Softcorner INc</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="item">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="testimonial-wrap">
                                        <p>Beatae fugit fugiat aperiam odio aliquid obcaecati ad, cupiditate sequi repudiandae necessitatibus minus debitis officia maxime id sint deserunt, quia quis mollitia.</p>
                                        
                                        <img src="img/about/tm4.jpg" alt="" class="img-responsive">
                                        <div class="client-info">
                                            <h4>Nikol Tin</h4>
                                            <p>Senior Consutant ,Softcorner INc</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="testimonial-wrap">
                                        <p>Beatae fugit fugiat aperiam odio aliquid obcaecati ad, cupiditate sequi repudiandae necessitatibus minus debitis officia maxime id sint deserunt, quia quis mollitia.</p>
                                        
                                        <img src="img/about/tm.jpg" alt="" class="img-responsive">
                                        <div class="client-info">
                                            <h4>Martin Guptil</h4>
                                            <p>Consutant ,Softcorner INc</p>
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
    </section> -->
    <!-- End Testimonial Section -->
    
    <!-- Start parallax Section -->
    <section id="parallax">
       <div class="overlay-bg"></div>
        <div class="container">
            <div class="col-sm-8 text-center m-auto pt100 pb100 border-top">
                <div class="white text-center parallax-info">
                    <h4 class="mb10 lspacing">Give Us A Call</h4>
                    <h1>+1 92-126-386</h1>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius eum dolor, vel blanditiis obcaecati inventore eos, distinctio molestiae ad veritatis dicta, sed corporis doloremque animi necessitatibus! Ratione totam nemo ea.</p>

                    <ul class="social-icons fadeIn">
                        <li><a href="#"><i class="fa fa-facebook white"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter white"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram white"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus white"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance white"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble white"></i></a></li>
                    </ul>
                    <h6>we don't <span class="highlight">enclose</span> your information with anyone.</h6>
                </div>
            </div>
        </div>
    </section>
    <!-- End Parallax Section --> 
    
    <!-- Start Price chart Section --> 
    <section id="price" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <div class="heading m-auto text-center ">
                        <h2 class="f-xbold">Updated Price rate</h2>
                        <hr class="seperator">
                        <p>With a belief that culture drives commerce, we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action. Our specialty of connecting brand, culture, and commerce has earned us a big reputation.</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
               <div class="col-md-6">
                   <div class="price-chart-img">
                       <img src="{{ URL::asset('front/img/about/chart.jpg') }}" alt="" class="img-responsive">
                   </div>
               </div>
                <div class="col-md-6 col-sm-6">
                    <div class="price-chart">
                        
                    <table class="table table-striped table-hover text-left">
                        <thead>
                        <tr>
                            <th>Cryptocurrency</th>
                            <th>Price</th>
                            <th>24h % Change</th>
                            <th>24h Volume (coin)</th>
                            <th>Supply</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/1.png') }}" class="currency-icon" alt="">Bitcoin</td>
                            <td>9,290.06 $</td>
                            <td class="up">14.44%</td>
                            <td>218,087 BTC</td>
                            <td>923,629</td>
                        </tr>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/2.png') }}" class="currency-icon" alt="">Ethereum</td>
                            <td>407.13 $</td>
                            <td class="up">16.17%</td>
                            <td>1,223,367 ETH</td>
                            <td>663,133</td>
                        </tr>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/3.png') }}" class="currency-icon" alt="">Exchange Union</td>
                            <td>7.47 $</td>
                            <td class="down">-1.09%</td>
                            <td>3,352 XUC</td>
                            <td>427,132</td>
                        </tr>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/4.png') }}" class="currency-icon" alt="">Ripple</td>
                            <td>0.22 $</td>
                            <td class="up">20.80%</td>
                            <td>211,418,299 XRP</td>
                            <td>719,280</td>
                        </tr>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/5.png') }}" class="currency-icon" alt="">Veritaseum</td>
                            <td>84.22 $</td>
                            <td class="down">-14.56%</td>
                            <td>36 VERI </td>
                            <td>218,887</td>
                        </tr>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/6.png') }}" class="currency-icon" alt="">DigitalCash</td>
                            <td>709.31 $</td>
                            <td class="down">-1.18%</td>
                            <td>125,361 DASH</td>
                            <td>427,132</td>
                        </tr>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/7.png') }}" class="currency-icon" alt="">Monero</td>
                            <td>78.97 $</td>
                            <td class="up">20.55%   </td>
                            <td>2,281,288 LTC</td>
                            <td>719,280</td>
                        </tr>
                        <tr>
                            <td><img src="{{ URL::asset('front/img/coin/8.png') }}" class="currency-icon" alt=""> Litecoin</td>
                            <td>156.32 $</td>
                            <td class="up">1.18%</td>
                            <td>255,226 XMR</td>
                            <td>218,887</td>
                        </tr>
                        </tbody>
                    </table>
                
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Price Chart Section -->
     
     <!-- Start Counter Section --> 
     <section id="counter-wrap">
         <div class="container">
             <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-project-complete">
                        <i class="icon ion-thumbsup"></i>
                        <h3>project complete</h3>
                        <h2 class="counter-num">1200</h2>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-project-complete">
                        <i class="icon ion-ios-people"></i>
                        <h3>Happy Clients</h3>
                        <h2 class="counter-num">1000</h2>

                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-project-complete">
                        <i class="icon ion-android-globe"></i>
                        <h3>Line of Work</h3>
                        <h2 class="counter-num">56090</h2>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-project-complete">
                        <i class="fa fa-angellist"></i>
                        <h3>Awards won</h3>
                        <h2 class="counter-num">31</h2>
                    </div>
                </div>
             </div>
         </div>
     </section>
     <!-- End Counter Section --> 
    
     <!-- Start Team Section -->
     <!--
     <section id="team" class="section-padding ">
         <div class="container">
             <div class="row">
                  <div class="col-md-12">
                     <div class="heading m-auto text-center ">
                        <h2 class="f-xbold">Excellent Team Workers</h2>
                        <hr class="seperator">
                        <p>With a belief that culture drives commerce, we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action. Our specialty of connecting brand, culture, and commerce has earned us a big reputation.</p>
                    </div>
                </div>
             </div>
             
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{ URL::asset('front/img/team/img-1.jpg') }}" alt="Team image">
                        </div>
                        <h3 class="title">Williamson</h3>
                        <span class="post">Web Developer</span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-google-plus"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{ URL::asset('front/img/team/img-2.jpg') }}" alt="Team image">
                        </div>
                        <h3 class="title">Kristiana</h3>
                        <span class="post">Web Designer</span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-google-plus"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{ URL::asset('front/img/team/img-3.jpg') }}" alt="Team image">
                        </div>
                        <h3 class="title">Williamson</h3>
                        <span class="post">Web Developer</span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-google-plus"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="our-team">
                        <div class="pic">
                            <img src="{{ URL::asset('front/img/team/img-4.jpg') }}" alt="Team image">
                        </div>
                        <h3 class="title">Kristiana</h3>
                        <span class="post">Web Designer</span>
                        <ul class="social">
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-google-plus"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
         </div>
     </section> 
        -->
     <!-- End Team Section --> 
     
     <!-- Start Blog Section -->
     <!-- 
     <section id="blog" class="section-padding bg-gray">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="heading m-auto text-center ">
                        <h2 class="f-xbold">Recent Blog Update</h2>
                        <hr class="seperator">
                        <p>With a belief that culture drives commerce, we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action. Our specialty of connecting brand, culture, and commerce has earned us a big reputation.</p>
                    </div>
                </div>
             </div>
             
             <div class="row">
                 <div class="col-md-4 col-sm-4">
                     <div class="blog-single">
                         <img src="{{ URL::asset('front/img/blog/blog_1.jpg') }}" alt="" class="img-responsive">
                         <div class="blog-inner">
                             <a href="#"><h4>Make a profitable busines with us...</h4></a>
                             <ul class="list-inline blog-info">
                                 <li><a href="#"><i class="fa fa-user"></i> Mike</a></li>
                                 <li><a href="#"><i class="fa fa-calendar"></i>17 jan 2018</a></li>
                                 <li><a href="#"><i class="fa fa-comments"></i> 5</a></li>
                                 <li><a href="#"><i class="fa fa-heart"></i> 20</a></li>
                                 <li><a href="#"><i class="fa fa-share"></i> 8 </a></li>
                             </ul>
                             <p>Perspiciatis maxime illo officiis modi, quasi molestiae molestias reiciendis repellendus, quaerat, expedita ea eveniet omnis illum accusantium. Adipisci eos vel, rem harum!</p>
                             <a href="#" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                             
                         </div>
                     </div>
                 </div>
                 
                 <div class="col-md-4 col-sm-4">
                     <div class="blog-single">
                         <img src="{{ URL::asset('front/img/blog/blog_2.jpg') }}" alt="" class="img-responsive">
                         <div class="blog-inner">
                             <a href="#"><h4>Bitcoin crytpcurrency is now popular ...</h4></a>
                             <ul class="list-inline blog-info">
                                 <li><a href="#"><i class="fa fa-user"></i> Mike</a></li>
                                 <li><a href="#"><i class="fa fa-calendar"></i>17 jan 2018</a></li>
                                 <li><a href="#"><i class="fa fa-comments"></i> 5</a></li>
                                 <li><a href="#"><i class="fa fa-heart"></i> 20</a></li>
                                 <li><a href="#"><i class="fa fa-share"></i> 8 </a></li>
                             </ul>
                            
                             <p>Perspiciatis maxime illo officiis modi, quasi molestiae molestias reiciendis repellendus, quaerat, expedita ea eveniet omnis illum accusantium. Adipisci eos vel, rem harum!</p>
                             <a href="#" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                             
                         </div>
                     </div>
                 </div>
                 
                 <div class="col-md-4 col-sm-4">
                     <div class="blog-single">
                         <img src="{{ URL::asset('front/img/blog/blog_3.jpg') }}" alt="" class="img-responsive">
                         <div class="blog-inner">
                             <a href="#"><h4>How to grow Your business...</h4></a>
                             <ul class="list-inline blog-info">
                                 <li><a href="#"><i class="fa fa-user"></i> Mike</a></li>
                                 <li><a href="#"><i class="fa fa-calendar"></i>17 jan 2018</a></li>
                                 <li><a href="#"><i class="fa fa-comments"></i> 5</a></li>
                                 <li><a href="#"><i class="fa fa-heart"></i> 20</a></li>
                                 <li><a href="#"><i class="fa fa-share"></i> 8 </a></li>
                             </ul>
                            
                             <p>Perspiciatis maxime illo officiis modi, quasi molestiae molestias reiciendis repellendus, quaerat, expedita ea eveniet omnis illum accusantium. Adipisci eos vel, rem harum!</p>
                             <a href="#" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
        -->
     <!-- End Blog Section -->  
     
     <!-- Start Faq Section -->  
     <section id="faq" class="pt120">
         <div class="container">
           <div class="row">
                 <div class="col-md-12">
                     <div class="heading m-auto text-center ">
                        <h5 class="subheading">Have any Question on Mind ?</h5>
                        <h2 class="f-xbold">Frequently Asked Questions</h2>
                        <hr class="seperator">
                    </div>
                </div>
             </div>
             
             
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        How It Works ?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        How To create a Wallet?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        What do you need to do a business?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  <!-- COl end --> 
                
                <div class="col-md-6">
                   <img src="{{ URL::asset('front/img/about/faq2.png') }}" alt="" class="img-responsive">
               </div>
            </div>
         </div>
     </section>
     <!-- End Faq Section --> 
    
     <!-- Start Contact Section -->
    <section id="contact-form" class="bg-gray">
        <div class="container pt100 pb100">
            <div class="heading m-auto text-center mb30">
                <h2 class="f-xbold">Contact Us</h2>
                <hr class="seperator">
                <h4 class="subheading">Lets collaborate</h4>
                <p>With a belief that culture drives commerce, we leverage shared values and ideals to inform strategy and design, creating experiences that inspire life and inspire action. Our specialty of connecting brand, culture, and commerce has earned us a big reputation.</p>
            </div>


            <div class="col-md-8 col-sm-8 m-auto">
                <form action="form-process.php" method="POST" name="contact" id="contact" novalidate>
                    <div class="text-center">
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" id="name" size="30" placeholder="Your Name *" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" id="email" size="30" placeholder="Your Email *" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="tel" name="phone" id="phone" size="30" placeholder="Your Phone">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="subject" id="subject" size="30" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" cols="40" rows="6" placeholder="Your Message... *" required></textarea>
                        </div>
                        <!-- Google reCAPTCHA -->

                        <!-- honeypot -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-hero">Send Message</button>
                        </div>
                    </div>
                </form>
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
                        <h4>GLobal Price</h4>
                        
                        <ul>
                           <li><a href="#">Average Bitcoin Price</a></li>
                            <li><a href="#">API Documentation</a></li>
                            <li><a href="#">API Statics</a></li>
                            <li><a href="#">Currency Market</a></li>
                            <li><a href="#">Unlimited API request</a></li>
                            <li><a href="#">Bitcoin Price report 2016</a></li>
                        </ul>
                    </div>
                </div> 
                
                <div class="col-md-2 col-sm-6">
                    <div class="widget news-widget">
                        <h4>Bitcoin Price API</h4>
                        
                        <ul>
                            <li><a href="#">Currency Market</a></li>
                            <li><a href="#">Unlimited API request</a></li>
                            <li><a href="#">Bitcoin Price report 2016</a></li>
                            <li><a href="#">Average Bitcoin Price</a></li>
                            <li><a href="#">API Documentation</a></li>
                            <li><a href="#">API Statics</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
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
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="widget contact-widget">
                        <h4>Contact Us</h4>
                        
                        <ul class="footer-contact">
                            <li><i class="fa fa-map-marker"></i>Linkin Park,Malbourne ,USA </li>
                            <li><i class="fa fa-phone"></i> <span>+39-32523112</span></li>
                            <li><i class="fa fa-envelope-o"></i> <span>bitbank@email.com</span></li>
                        </ul>
                        
                        <ul class="list-inline">
                            <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-instagram"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-tumblr"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-rss"></i></a></li>
                            <li><a href="#"><i class="icon ion-social-vimeo"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="copy ">Bitcoin is unstabe source of statics income over virtual world. <br> All copyright Reserved to <span>BitBank</span> 2018</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer section    -->
 
    <!-- Start Back To Top -->
    <a data-scroll id="back-to-top" href="#hero"><i class="icon ion-chevron-up"></i></a>
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