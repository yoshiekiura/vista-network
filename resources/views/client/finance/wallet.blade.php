@extends('home')

@section('style')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Wallet</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Wallet</li>
        </ol>
      </div>
    </div>
  </div>
</div>

        
<div class="content-body">

  <!-- Content types section start -->
  <section id="shopping-cards">
    
    <div class="row">
      <div class="col-xl-6 col-md-6">
        <div class="card">
          <div class="card-content">
            <div class="media align-items-stretch">
              <div class="p-2 media-middle">
                <h1 class="success">{{$general->symbol}}{{ number_format((float)Auth::user()->balance, 2, '.', '') }}</h1>
              </div>
              <div class="media-body p-2">
                <h3>Total Balance</h3>
                <span>&nbsp;</span>
              </div>
              <div class="media-right bg-success p-2 media-middle rounded-right">
                <i class="icon-wallet font-large-2 text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 col-md-6">
        <div class="card overflow-hidden">
          <div class="card-content">
            <div class="card-body cleartfix">
              <div class="media align-items-stretch">
                <div class="align-self-center">
                  <i class="icon-grid info font-large-2 mr-2"></i>
                </div>
                <div class="media-body">
                  <h4>Bitcoin Wallet Address</h4>
                  <span class="text-warning">{{ isset(Auth::user()->bitcoin_wallet) ? Auth::user()->bitcoin_wallet : '' }}</span>
                </div>
                <div class="align-self-center">
                <!--  <h1>18,000</h1> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="row">
              <div class="col-lg-4 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                <div class="p-1 text-center">
                  <div>
                    <h3 class="display-4 blue-grey darken-1">{{ number_format((float)$available_vista_coins, 2) }}</h3>
                    <span class="blue-grey darken-1">VISTA COINS</span>
                  </div>
                  <br/>
                  <div class="card-content">
                <!--    <div id="morris-likes" style="height:75px;"></div> -->
                    <ul class="list-inline clearfix">
                      <li class="border-right-blue-grey border-right-lighten-2 pr-2">
                        <h1 class="success text-bold-400">$ {{ $vista_rate }}</h1>
                        <span class="blue-grey darken-1"> Rate</span>
                      </li>
                      <li class="pl-2">
                        <h1 class="success text-bold-400">$ {{ $vista_rate * $available_vista_coins }}</h1>
                        <span class="blue-grey darken-1">Net Worth</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                <div class="p-1 text-center">
                  <div>
                    <h3 class="display-4 blue-grey darken-1">{{ number_format((float)$available_alxa_coins, 2) }}</h3>
                    <span class="blue-grey darken-1">ALEXA COINS</span>
                  </div>
                  <br/>
                  <div class="card-content">
               <!--     <div id="morris-comments" style="height:75px;"></div> -->
                    <ul class="list-inline clearfix">
                      <li class="border-right-blue-grey border-right-lighten-2 pr-2">
                        <h1 class="warning text-bold-400">$ {{ $alxa_rate }}</h1>
                        <span class="blue-grey darken-1"> Rate</span>
                      </li>
                      <li class="pl-2">
                        <h1 class="warning text-bold-400">$ {{ $alxa_rate * $available_alxa_coins }}</h1>
                        <span class="blue-grey darken-1"> Net Worth</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                <div class="p-1 text-center">
                  <div>
                    <h3 class="display-4 blue-grey darken-1">$ {{ Auth::user()->hp_balance }}</h3>
                    <span class="blue-grey darken-1">HP BALANCE</span>
                  </div>
                  <br/>
                  <div class="card-content">
              <!--      <div id="morris-views" style="height:75px;"></div>  -->
                    <ul class="list-inline clearfix">
                      <li class="border-right-blue-grey border-right-lighten-2 pr-2">
                        <h1 class="danger text-bold-400">{{ $hp_comm }} %</h1>
                        <span class="blue-grey darken-1">Commission</span>
                      </li>
                      <li class="pl-2">
                        <h1 class="danger text-bold-400">$ 5000</h1>
                        <span class="blue-grey darken-1">1st Milestone</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
      
  </section>
  <!-- Content types section end -->      
</div>
<br/><br/>
@endsection

