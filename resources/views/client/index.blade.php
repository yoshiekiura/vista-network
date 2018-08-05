@extends('home')

@section('style')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

    $(document).ready(function() {

        $("#vista_trade").show();
        $("#alexa_trade").hide();

        $("input[name=trade]").change(function() {
      
            var value = $( 'input[name=trade]:checked' ).val();
            if(value == 'Alexa'){
                $("#vista_trade").hide();
                $("#alexa_trade").show();
            //    $("#alexa").addClass("active");               
            }else{
                $("#vista_trade").show();
                $("#alexa_trade").hide();
            //    $("#vista").addClass("active");
            }
        }); 

        $( '.buy_coin' ).on( 'submit', function(e) {
      
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var form = $(this);

            swal({
                title: "Confirm Purchase",
                text: "You are going to purchase coins!",
                icon: "warning",
                showCancelButton: true,
                buttons: {
                        cancel: {
                            text: "No, Cancel plz!",
                            value: null,
                            visible: true,
                            className: "btn-danger",
                            closeModal: false,
                        },
                        confirm: {
                            text: "Yes, I Confirm!",
                            value: true,
                            visible: true,
                            className: "btn-success",
                            closeModal: false
                        }
                }
            }).then(isConfirm => {
                if (isConfirm) {
                      $.ajax({
                      url: '/coins/buy',
                      type: 'POST',
                      dataType: 'json',
                      data: form.serialize(), 
                      success: function( result ) {

                          if(result.success == true){
                            swal("Success!", "Your have successfully purchased coins!", "success");
                            $('#vista_coins').val('');
                            $("#vista_total_price").val('');
                            $('#alexa_coins').val('');
                            $("#alexa_total_price").val('');
                            $(".usd_balance").html(result.balance);
                            $(".coin_balance").html(result.coin_balance);  
                          }else{
                            swal("Warning!", "Your do not have enough balance to purchase coins!", "error");
                            $('#vista_coins').val('');
                            $("#vista_total_price").val('');
                            $('#alexa_coins').val('');
                            $("#alexa_total_price").val('');
                          } 
                      },
                      error: function (data) {
                            swal("Error!", "Purchase not complete!", "error");
                      }
                });

                } else {
                    swal("Cancelled", "Your order is cancelled :)", "error");
                    exit();
                }
            });

        });

        $( '.sell_coin' ).on( 'submit', function(e) {
      
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var form = $(this);

            swal({
                title: "Confirm Sell",
                text: "You are going to sell coins!",
                icon: "warning",
                showCancelButton: true,
                buttons: {
                        cancel: {
                            text: "No, Cancel plz!",
                            value: null,
                            visible: true,
                            className: "btn-danger",
                            closeModal: false,
                        },
                        confirm: {
                            text: "Yes, I Confirm!",
                            value: true,
                            visible: true,
                            className: "btn-success",
                            closeModal: false
                        }
                }
            }).then(isConfirm => {
                if (isConfirm) {
                      $.ajax({
                      url: '/coins/sell',
                      type: 'POST',
                      dataType: 'json',
                      data: form.serialize(), 
                      success: function( result ) {
                          if(result.success == true){
                            swal("Success!", "Your have successfully sold coins!", "success");
                            $('#vista_sell_coins').val('');
                            $("#vista_sell_total_price").val('');
                        //    $('#alexa_coins').val('');
                        //    $("#alexa_total_price").val('');  
                            $(".usd_balance").html(result.balance);
                            $(".coin_balance").html(result.coin_balance);
                          }else{
                            swal("Warning!", "Coins exceeds Balance!", "warning");
                            $('#vista_sell_coins').val('');
                            $("#vista_sell_total_price").val('');
                          //  $('#alexa_coins').val('');
                          //  $("#alexa_total_price").val('');
                          } 
                      },
                      error: function (data) {
                            swal("Error!", "Purchase not complete!", "error");
                      }
                });

                } else {
                    swal("Cancelled", "Your order is cancelled :)", "error");
                    exit();
                }
            });

        });

    });

    function calculateVistaTotal() {

        var coin_price = $('#vista_buy_price').val();
        var coins_num = $('#vista_coins').val();
    
        if(coins_num == "" || coins_num < 0){
           swal("Warning!", "Please enter valid number of coins!", "warning");
           $("#vista_total_price").val(''); 
           return false;
        }else{
          var price = parseFloat(coin_price);
          var cn = parseFloat(coins_num);
          var total_price = price * cn;

          $("#vista_total_price").val(total_price);
        
          return true;
        }
        
    }

    function calculateVistaSellTotal() {

        var coin_price = $('#vista_sell_price').val();
        var coins_num = $('#vista_sell_coins').val();
    
        if(coins_num == "" || coins_num < 0){
           swal("Warning!", "Please enter valid number of coins!", "warning");
           $("#vista_sell_total_price").val(''); 
           return false;
        }else{
          var price = parseFloat(coin_price);
          var cn = parseFloat(coins_num);
          var total_price = price * cn;

          $("#vista_sell_total_price").val(total_price);
        
          return true;
        }
        
    }

    function calculateAlexaTotal() {

        var coin_price = $('#alexa_buy_price').val();
        var coins_num = $('#alexa_coins').val();
    
        if(coins_num == "" || coins_num < 0){
           swal("Warning!", "Please enter valid number of coins!", "warning");
           $("#alexa_total_price").val(''); 
           return false;
        }else{
          var price = parseFloat(coin_price);
          var cn = parseFloat(coins_num);
          var total_price = price * cn;

          $("#alexa_total_price").val(total_price);
        
          return true;
        }
        
    }

    function calculateAlexaSellTotal() {

        var coin_price = $('#alexa_sell_price').val();
        var coins_num = $('#alexa_sell_coins').val();
    
        if(coins_num == "" || coins_num < 0){
           swal("Warning!", "Please enter valid number of coins!", "warning");
           $("#alexa_sell_total_price").val(''); 
           return false;
        }else{
          var price = parseFloat(coin_price);
          var cn = parseFloat(coins_num);
          var total_price = price * cn;

          $("#alexa_sell_total_price").val(total_price);
        
          return true;
        }
        
    }

    
  </script>  
@endsection

@section('content')

<div class="content-header row"></div>
    <div class="content-body">
        <div id="crypto-stats-3" class="row">
          <div class="col-xl-3 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2">
                      <h1><i class="cc BTC info lighten-1 font-large-1" title="ETH"></i></h1>
                    </div>
                    <div class="col-5 pl-2">
                      <h4>VISTA</h4>
                      <h6 class="text-muted">Coin</h6>
                    </div>
                    <div class="col-5 text-right">
                      <h4>{{ number_format((float)$available_vista_coins, 2) }}</h4>
                      <h6 class="success darken-4">{{ $general->symbol }}{{ $vista_rate }}<!--<i class="la la-arrow-up"></i>--></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="eth-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2">
                      <h1><i class="cc BTC warning font-large-1" title="BTC"></i></h1>
                    </div>
                    <div class="col-5 pl-2">
                      <h4>ALEXA</h4>
                      <h6 class="text-muted">Coin</h6>
                    </div>
                    <div class="col-5 text-right">
                      <h4>{{ number_format((float)$available_alxa_coins, 2) }}</h4>
                      <h6 class="success darken-4">{{ $general->symbol }}{{ $alxa_rate }}<!--<i class="la la-arrow-up"></i>--></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="btc-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2">
                      <h1><i class="cc ETH danger font-large-1" title="XRP"></i></h1>
                    </div>
                    <div class="col-5 pl-2">
                      <h4>HP-LP</h4>
                      <h6 class="text-muted">Balance</h6>
                    </div>
                    <div class="col-5 text-right">
                      <h4>{{ $general->symbol }}{{ number_format((float)Auth::user()->hp_balance, 2) }}</h4>
                      <h6 class="danger">{{ $hp_commission }}% <!--<i class="la la-arrow-down"></i>--></h6>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="col-xl-3 col-12">
              <div class="card border-0">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body">
                        <h1>{{$general->symbol}}{{ number_format((float)Auth::user()->balance, 2) }}</h1>
                        <span class="text-muted">Total Balance</span>
                      </div>
                      <div class="align-self-center">
                        <i class="icon-wallet font-large-2 blue-grey lighten-3"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">

                  </div>  
                </div>
              </div>
            </div>
        </div>
        <!-- Candlestick Multi Level Control Chart --> 

        <!-- Trade History & Place Order -->
        <div class="row">
          <div class="col-12 col-xl-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Place Order</h4>
                <div class="heading-elements">
                  <h6 class="danger">Fee: 0.0%</h6>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <ul class="nav nav-tabs nav-underline no-hover-bg">
                    <li class="nav-item">
                      <a class="nav-link active" id="base-limit" data-toggle="tab" aria-controls="limit"
                      href="#limit" aria-expanded="true">Vista Coin</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="base-market" data-toggle="tab" aria-controls="market" href="#market"
                      aria-expanded="false">Alexa Coin</a>
                    </li>
                  </ul>
                  <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="limit" aria-expanded="true" aria-labelledby="base-limit">
                      <div class="row">
                        <div class="col-12 col-xl-6 border-right-blue-grey border-right-lighten-4 pr-2 p-0">
                          <div class="row my-2">
                            <div class="col-4">
                              <h5 class="text-bold-600 mb-0">Buy VISTA</h5>
                            </div>
                            <div class="col-8 text-right">
                              <p class="text-muted mb-0">USD Balance: <span class="usd_balance">{{ $general->symbol }}{{ number_format((float)Auth::user()->balance, 2) }}</span></p>
                            </div>
                          </div>
                          <meta name="csrf-token" content="{{ csrf_token() }}" /> 
                          <form class="form form-horizontal buy_coin" method="post">
                            <input type="hidden" name="coin_id" value="2">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-limit-buy-price">Price</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="rate" class="form-control" id="vista_buy_price" aria-describedby="basic-addon1" value="{{ $vista_rate }}" readonly>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-limit-buy-amount">Coins</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-bitcoin"></i>
                                      </span>
                                    </div>
                                    <input type="number" class="form-control" id="vista_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateVistaTotal()" step=".000001">
                                  </div>
                                </div>
                              </div>
                    
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-limit-buy-total">Total</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="total" class="form-control" id="vista_total_price" aria-describedby="basic-addon1" readonly placeholder="Total Price">
                                  </div>
                                </div>
                              </div>
                              <div class="form-actions pb-0">
                                <button type="submit" name="submit" class="btn round btn-success btn-block btn-glow"> Buy VISTA </button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="col-12 col-xl-6 pl-2 p-0">
                          <div class="row my-2">
                            <div class="col-4">
                              <h5 class="text-bold-600 mb-0">Sell VISTA</h5>
                            </div>
                            <div class="col-8 text-right">
                              <p class="text-muted mb-0">VISTA Balance: <span class="coin_balance">{{ number_format((float)$available_vista_coins, 2) }}</span></p>
                            </div>
                          </div>
                          <meta name="csrf-token" content="{{ csrf_token() }}" /> 
                          <form class="form form-horizontal sell_coin" method="post">
                            <input type="hidden" name="coin_id" value="2">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-price">Price</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="rate" class="form-control" id="vista_sell_price" aria-describedby="basic-addon1" value="{{ $vista_rate }}" readonly>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-limit-sell-amount">Coins</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-bitcoin"></i>
                                      </span>
                                    </div>
                                    <input type="number" class="form-control" id="vista_sell_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateVistaSellTotal()" step=".000001">
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-limit-sell-total">Total</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="total" class="form-control" id="vista_sell_total_price" aria-describedby="basic-addon1" readonly placeholder="Total Price">
                                  </div>
                                </div>
                              </div>
                              <div class="form-actions pb-0">
                                <button type="submit" class="btn round btn-danger btn-block btn-glow"> Sell VISTA </button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="market" aria-labelledby="base-market">
                      <div class="row">
                        <div class="col-12 col-xl-6 border-right-blue-grey border-right-lighten-4 pr-2 p-0">
                          <div class="row my-2">
                            <div class="col-4">
                              <h5 class="text-bold-600 mb-0">Buy ALEXA</h5>
                            </div>
                            <div class="col-8 text-right">
                              <p class="text-muted mb-0">USD Balance: <span class="usd_balance">{{ $general->symbol }}{{ number_format((float)Auth::user()->balance, 2) }}</span></p>
                            </div>
                          </div>
                          <meta name="csrf-token" content="{{ csrf_token() }}" />
                          <form class="form form-horizontal buy_coin" method="post">
                            <input type="hidden" name="coin_id" value="1">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-market-buy-price">Price</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="rate" id="alexa_buy_price" class="form-control" aria-describedby="basic-addon1" value="{{ $alxa_rate }}" readonly>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-market-buy-amount">Coins</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-bitcoin"></i>
                                      </span>
                                    </div>
                                    <input type="number" class="form-control" id="alexa_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateAlexaTotal()" step=".000001">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-limit-buy-total">Total</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="total" class="form-control" id="alexa_total_price" aria-describedby="basic-addon1" readonly placeholder="Total Price">
                                  </div>
                                </div>
                              </div>
                              <div class="form-actions pb-0">
                                <button type="submit" name="submit" class="btn round btn-success btn-block btn-glow"> Buy ALEXA </button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="col-12 col-xl-6 pl-2 p-0">
                          <div class="row my-2">
                            <div class="col-4">
                              <h5 class="text-bold-600 mb-0">Sell ALEXA</h5>
                            </div>
                            <div class="col-8 text-right">
                              <p class="text-muted mb-0">Alexa Balance: <span class="coin_balance">{{ number_format((float)$available_alxa_coins, 2)  }}</span></p>
                            </div>
                          </div>
                          <meta name="csrf-token" content="{{ csrf_token() }}" /> 
                          <form class="form form-horizontal sell_coin" method="post">
                            <input type="hidden" name="coin_id" value="1">
                            <div class="form-body">
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-price">Price</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="rate" id="alexa_sell_price" class="form-control" aria-describedby="basic-addon1" value="{{ $alxa_rate }}" readonly>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-market-sell-amount">Coins</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-bitcoin"></i>
                                      </span>
                                    </div>
                                    <input type="number" class="form-control" id="alexa_sell_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateAlexaSellTotal()" step=".000001">
                                  </div>
                                </div>
                              </div>
                            
                              <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="btc-limit-buy-total">Total</label>
                                <div class="col-md-9">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">
                                        <i class="la la-dollar"></i>
                                      </span>
                                    </div>
                                    <input type="text" name="total" class="form-control" id="alexa_sell_total_price" aria-describedby="basic-addon1" readonly placeholder="Total Price">
                                  </div>
                                </div>
                              </div>
                              <div class="form-actions pb-0">
                                <button type="submit" class="btn round btn-danger btn-block btn-glow"> Sell ALEXA </button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-4">
            @if($hashpower->isEmpty())
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Trade History</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn round btn-sm btn-outline-info active" id="vista">
                      <input type="radio" name="trade" value="Vista"> Vista
                    </label>
                    <label class="btn round btn-sm btn-outline-info" id="alexa">
                      <input type="radio" name="trade" value="Alexa"> Alexa
                    </label>
                  </div>
                </div>
              </div>
              <div class="card-content">
                <div class="table-responsive mt-1">      
                  <table class="table table-xs" id="vista_trade">
                    <thead>
                      <tr>
                        <th>Price($)</th>
                        <th>Amount</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!$vista_trade->isEmpty())
                        @foreach($vista_trade as $vista)
                        <tr>
                          @if($vista->amount < 0)
                            <td class="danger">{{ $vista->rate }}</td>
                          @else
                            <td class="success">{{ $vista->rate }}</td>
                          @endif
                          <td><i class="cc BTC-alt"></i> {{ abs($vista->amount) }}</td>
                          <td>{{ date("m.d.y", strtotime($vista->created_at)) }}</td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                            <td colspan="4">No Vista Coin Transaction Found!</td>
                        </tr>  
                      @endif  
                    </tbody>
                  </table>

                  <table class="table table-xs" id="alexa_trade">
                    <thead>
                      <tr>
                        <th>Price($)</th>
                        <th>Amount</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!$alexa_trade->isEmpty())
                        @foreach($alexa_trade as $alexa)
                        <tr>
                          @if($alexa->amount < 0)
                            <td class="danger">{{ $alexa->rate }}</td>
                          @else
                            <td class="success">{{ $alexa->rate }}</td>
                          @endif
                          <td><i class="cc BTC-alt"></i> {{ abs($alexa->amount) }}</td>
                          <td>{{ date("m.d.y", strtotime($alexa->created_at)) }}</td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                            <td colspan="4">No Alexa Coin Transaction Found!</td>
                        </tr>  
                      @endif  
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div> 
            @else
            <div class="card">
              <div class="card-head">
                <div class="card-header">
                  <h4 class="card-title">Hash Power Progress</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div id="task-pie-chart" class="height-400 echart-container"></div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>

        <!-- Slaes & Purchase Order -->
        <div class="row">
          <div class="col-12 col-xl-4">
            <div id="accordionCrypto" role="tablist" aria-multiselectable="true">
              <div class="card collapse-icon accordion-icon-rotate">
                <div id="heading31" class="card-header bg-info p-1 bg-lighten-1">
                  <a data-toggle="collapse" data-parent="#accordionCrypto" href="#accordionBTC" aria-expanded="true"
                  aria-controls="accordionBTC" class="card-title lead white">BTC</a>
                </div>
                <div id="accordionBTC" role="tabpanel" aria-labelledby="heading31" class="card-collapse collapse show"
                aria-expanded="true">
                  <div class="card-content">
                    <div class="card-body p-0">
                      <div class="media-list list-group">
                        <div class="list-group-item list-group-item-action media p-1">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">BTC/USD</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                      
                              <p class="text-bold-600 m-0">{{ $btcc_usd_euro->data->quotes->USD->price }}</p>
                              @if($btcc_usd_euro->data->quotes->USD->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $btcc_usd_euro->data->quotes->USD->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $btcc_usd_euro->data->quotes->USD->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $btcc_usd_euro->data->quotes->USD->volume_24h }} BTC</p> 
                            </span> 
                          </a>
                        </div>
                        <div class="list-group-item list-group-item-action media p-1 bg-info bg-lighten-5">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">BTC/EUR</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                              
                              <p class="text-bold-600 m-0">{{ $btcc_usd_euro->data->quotes->EUR->price }}</p>
                              @if($btcc_usd_euro->data->quotes->EUR->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $btcc_usd_euro->data->quotes->EUR->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $btcc_usd_euro->data->quotes->EUR->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $btcc_usd_euro->data->quotes->EUR->volume_24h }} BTC</p>
                            
                            </span>
                          </a>
                        </div>
                        <div class="list-group-item list-group-item-action media p-1 border-bottom-0">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">BTC/GBP</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                  
                              <p class="text-bold-600 m-0">{{ $btcc_gbp->data->quotes->GBP->price }}</p>
                              @if($btcc_gbp->data->quotes->GBP->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $btcc_gbp->data->quotes->GBP->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $btcc_gbp->data->quotes->GBP->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $btcc_gbp->data->quotes->GBP->volume_24h }} BTC</p> 
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="heading32" class="card-header bg-info p-1 bg-lighten-1 my-1">
                  <a data-toggle="collapse" data-parent="#accordionCrypto" href="#accordionETH" aria-expanded="false"
                  aria-controls="accordionETH" class="card-title lead white collapsed">ETH</a>
                </div>
                <div id="accordionETH" role="tabpanel" aria-labelledby="heading32" class="card-collapse collapse"
                aria-expanded="false">
                  <div class="card-content">
                    <div class="card-body p-0">
                      <div class="media-list list-group">
                        <div class="list-group-item list-group-item-action media p-1">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">ETH/USD</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                        
                              <p class="text-bold-600 m-0">{{ $ethh_usd_euro->data->quotes->USD->price }}</p>
                              @if($ethh_usd_euro->data->quotes->USD->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $ethh_usd_euro->data->quotes->USD->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $ethh_usd_euro->data->quotes->USD->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $ethh_usd_euro->data->quotes->USD->volume_24h }} ETH</p> 
                            </span>
                          </a>
                        </div>
                        <div class="list-group-item list-group-item-action media p-1">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">ETH/EUR</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                        
                              <p class="text-bold-600 m-0">{{ $ethh_usd_euro->data->quotes->EUR->price }}</p>
                              @if($ethh_usd_euro->data->quotes->EUR->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $ethh_usd_euro->data->quotes->EUR->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $ethh_usd_euro->data->quotes->EUR->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $ethh_usd_euro->data->quotes->EUR->volume_24h }} ETH</p> 
                            </span>
                          </a>
                        </div>
                        <div class="list-group-item list-group-item-action media p-1 border-bottom-0">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">ETH/GBP</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
          
                              <p class="text-bold-600 m-0">{{ $ethh_gbp->data->quotes->GBP->price }}</p>
                              @if($ethh_gbp->data->quotes->GBP->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $ethh_gbp->data->quotes->GBP->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $ethh_gbp->data->quotes->GBP->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $ethh_gbp->data->quotes->GBP->volume_24h }} ETH</p> 
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="heading33" class="card-header bg-info p-1 bg-lighten-1">
                  <a data-toggle="collapse" data-parent="#accordionCrypto" href="#accordionXRP" aria-expanded="false"
                  aria-controls="accordionXRP" class="card-title lead white collapsed">XRP</a>
                </div>
                <div id="accordionXRP" role="tabpanel" aria-labelledby="heading33" class="card-collapse collapse"
                aria-expanded="false">
                  <div class="card-content">
                    <div class="card-body p-0">
                      <div class="media-list list-group">
                        <div class="list-group-item list-group-item-action media p-1">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">XRP/USD</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                            
                              <p class="text-bold-600 m-0">{{ $xrpp_usd_euro->data->quotes->USD->price }}</p>
                              @if($xrpp_usd_euro->data->quotes->USD->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $xrpp_usd_euro->data->quotes->USD->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $xrpp_usd_euro->data->quotes->USD->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $xrpp_usd_euro->data->quotes->USD->volume_24h }} XRP</p> 
                            </span>
                          </a>
                        </div>
                        <div class="list-group-item list-group-item-action media p-1">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">XRP/EUR</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                    
                              <p class="text-bold-600 m-0">{{ $xrpp_usd_euro->data->quotes->EUR->price }}</p>
                              @if($xrpp_usd_euro->data->quotes->EUR->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $xrpp_usd_euro->data->quotes->EUR->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $xrpp_usd_euro->data->quotes->EUR->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $xrpp_usd_euro->data->quotes->EUR->volume_24h }} XRP</p> 
                            </span>
                          </a>
                        </div>
                        <div class="list-group-item list-group-item-action media p-1 border-bottom-0">
                          <a class="media-link" href="#">
                            <span class="media-left">
                              <p class="text-bold-600 m-0">XRP/GBP</p>
                              <p class="font-small-2 text-muted m-0">24h Change</p>
                              <p class="font-small-2 text-muted m-0">24h Volume</p>
                            </span>
                            <span class="media-body text-right">
                
                              <p class="text-bold-600 m-0">{{ $xrpp_gbp->data->quotes->GBP->price }}</p>
                              @if($xrpp_gbp->data->quotes->GBP->percent_change_24h >= 0)
                                <p class="font-small-2 text-muted m-0 success">{{ $xrpp_gbp->data->quotes->GBP->percent_change_24h }}%</p>
                              @else
                                <p class="font-small-2 text-muted m-0 danger">{{ $xrpp_gbp->data->quotes->GBP->percent_change_24h }}%</p>
                              @endif
                              <p class="font-small-2 text-muted m-0 text-bold-600">{{ $xrpp_gbp->data->quotes->GBP->volume_24h }} XRP</p> 
                            </span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">BTC/USD</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li class="text-center mr-4">
                      <h6 class="text-muted">Last price</h6>
                      <p class="text-bold-600 mb-0">$ <span id="last_price"></span></p>
                    </li>
                    <li class="text-center mr-4">
                      <h6 class="text-muted">Daily change</h6>
                      <p class="text-bold-600 mb-0">$ <span id="daily_change"></span></p>
                    </li>
                    <li class="text-center">
                      <h6 class="text-muted">24h volume</h6>
                      <p class="text-bold-600 mb-0"><i class="cc BTC-alt" title="BTC"></i> {{ $btcc_usd_euro->data->quotes->USD->volume_24h }} BTC</p>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div class="card-body pt-0">
                  <div id="btc-candlestick-control" class="height-350 echart-container"></div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        

        <!--/ Trade History & Place Order -->
        <!-- Sell Orders & Buy Order -->
    <!--    <div class="row match-height">
          <div class="col-12 col-xl-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Sell Order</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <p class="text-muted">Total BTC available: 6542.56585</p>
                </div>
              </div>
              <div class="card-content">
                <div class="table-responsive">
                  <table class="table table-de mb-0">
                    <thead>
                      <tr>
                        <th>Price per BTC</th>
                        <th>BTC Ammount</th>
                        <th>Total($)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="bg-success bg-lighten-5">
                        <td>10583.4</td>
                        <td><i class="cc BTC-alt"></i> 0.45000000</td>
                        <td>$ 4762.53</td>
                      </tr>
                      <tr>
                        <td>10583.5</td>
                        <td><i class="cc BTC-alt"></i> 0.04000000</td>
                        <td>$ 423.34</td>
                      </tr>
                      <tr>
                        <td>10583.7</td>
                        <td><i class="cc BTC-alt"></i> 0.25100000</td>
                        <td>$ 2656.51</td>
                      </tr>
                      <tr>
                        <td>10583.8</td>
                        <td><i class="cc BTC-alt"></i> 0.35000000</td>
                        <td>$ 3704.33</td>
                      </tr>
                      <tr>
                        <td>10595.7</td>
                        <td><i class="cc BTC-alt"></i> 0.30000000</td>
                        <td>$ 3178.71</td>
                      </tr>
                      <tr class="bg-danger bg-lighten-5">
                        <td>10599.5</td>
                        <td><i class="cc BTC-alt"></i> 0.02000000</td>
                        <td>$ 211.99</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Buy Order</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <p class="text-muted">Total USD available: 9065930.43</p>
                </div>
              </div>
              <div class="card-content">
                <div class="table-responsive">
                  <table class="table table-de mb-0">
                    <thead>
                      <tr>
                        <th>Price per BTC</th>
                        <th>BTC Ammount</th>
                        <th>Total($)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="bg-danger bg-lighten-5">
                        <td>10599.5</td>
                        <td><i class="cc BTC-alt"></i> 0.02000000</td>
                        <td>$ 211.99</td>
                      </tr>
                      <tr>
                        <td>10583.5</td>
                        <td><i class="cc BTC-alt"></i> 0.04000000</td>
                        <td>$ 423.34</td>
                      </tr>
                      <tr>
                        <td>10583.8</td>
                        <td><i class="cc BTC-alt"></i> 0.35000000</td>
                        <td>$ 3704.33</td>
                      </tr>
                      <tr>
                        <td>10595.7</td>
                        <td><i class="cc BTC-alt"></i> 0.30000000</td>
                        <td>$ 3178.71</td>
                      </tr>
                      <tr class="bg-danger bg-lighten-5">
                        <td>10583.7</td>
                        <td><i class="cc BTC-alt"></i> 0.25100000</td>
                        <td>$ 2656.51</td>
                      </tr>
                      <tr>
                        <td>10595.8</td>
                        <td><i class="cc BTC-alt"></i> 0.29697926</td>
                        <td>$ 3146.74</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <!--/ Sell Orders & Buy Order -->
        <!-- Active Orders -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Hash-Power Transactions</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <td>
                    <a href="{{ route('hp.history') }}"><button class="btn btn-sm round btn-info btn-glow"><i class="la la-check font-medium-1"></i> View All</button></a>
                  </td>
                </div>
              </div>
              <div class="card-content">
                <div class="table-responsive">
                  <table class="table table-de mb-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Transaction ID</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!$hashpower->isEmpty())
                        @foreach($hashpower as $hp)
                        <tr>
                          @php    

                              $dt = $hp->created_at;
                              $created_format = $dt->toFormattedDateString();

                          @endphp
                          <td>{{ $created_format }}</td>
                          <td class="success">Deposit</td>
                          <td><i class="la la-stop"></i> {{ $hp->transaction_id }}</td>
                          <td><i class="la la-sort"></i> {{ $hp->hashpower->title }}</td>
                          <td><i class="la la-usd"></i> {{ $hp->price }}</td>
                          <td><i class="la la-usd"></i> {{ $hp->total }}</td>
                          <td>
                            <button class="btn btn-sm round btn-outline-info hp_detail_alert"> View</button>
                          </td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="7">No HP-LP Transaction Found!</td>
                        </tr>  
                      @endif  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Active Orders -->
        
      </div>
      <br/><br/>  
@endsection

@section('script')

<script src="{{ URL::asset('app-assets/js/scripts/pages/project-summary-task.js') }}" type="text/javascript"></script>

@endsection