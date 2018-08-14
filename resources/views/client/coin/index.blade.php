@extends('home')

@section('style')

  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

    $(document).ready(function() {

        $('#result_found_msg').hide();
        $('#result_found_alexa_msg').hide();

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

        $( '.transfer_coin' ).on( 'submit', function(e) {
      
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var form = $(this);
          
            swal({
                title: "Confirm Transfer",
                text: "You are going to transfer coins!",
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
                      url: '/coins/transfer',
                      type: 'POST',
                      dataType: 'json',
                      data: form.serialize(), 
                      success: function( result ) {
                      
                          if(result.success == 'username'){
                            swal("Warning!", "Username not Found!", "warning");
                            $('#vista_transfer_coins').val('');
                            $("#refname").val('');
                          }
                          if(result.success == true){
                            swal("Success!", "Your have successfully transfer coins!", "success");
                            $('#vista_transfer_coins').val('');
                            $(".usd_balance").html(result.balance);
                            $(".coin_balance").html(result.coin_balance);
                            $("#refname").val('');  
                          }
                          if(result.success == false){
                            swal("Warning!", "Coins exceeds Balance!", "warning");
                            $('#vista_transfer_coins').val('');
                            $("#refname").val('');
                          } 
                      },
                      error: function (data) {
                            swal("Error!", "Transfer not complete!", "error");
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

    function checkVistaTransfer() {

        var coin_price = $('#vista_transfer_price').val();
        var coins_num = $('#vista_transfer_coins').val();
        var ref_name = $('#refname').val();
    
        if(ref_name == "" || ref_name == null){
          swal("Warning!", "Please enter Username!", "warning"); 
          return false;
        }
        else if(coins_num == "" || coins_num < 0){
          swal("Warning!", "Please enter valid number of coins!", "warning"); 
          return false;
        }else{
          return true;
        }
        
    }

    function checkAlxaTransfer() {

        var coin_price = $('#alxa_transfer_price').val();
        var coins_num = $('#alxa_transfer_coins').val();
        var ref_name = $('#refname-a').val();
    
        if(ref_name == "" || ref_name == null){
          swal("Warning!", "Please enter Username!", "warning"); 
          return false;
        }
        else if(coins_num == "" || coins_num < 0){
          swal("Warning!", "Please enter valid number of coins!", "warning"); 
          return false;
        }else{
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

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Coins</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Coins</li>
        </ol>
      </div>
    </div>
  </div>
</div>

@if (Session::has('message'))
  <div class="alert bg-success alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> {{ Session::get('message') }}
  </div>
@endif

@if (Session::has('alert'))
  <div class="alert bg-warning alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Warning!</strong> {{ Session::get('alert') }}
  </div>
@endif

@if (count($errors) > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</b>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    </div>
@endif
        
<div class="content-body">

  <!-- Shopping cards section start -->
  <section id="shopping-cards">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body p-0">
              <div class="row">
              <!--  <div class="col-xl-12 col-md-12 p-2 pl-3"> -->
                    <div class="col-12 col-xl-12">
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
                              <a class="nav-link active" id="base-vista" data-toggle="tab" aria-controls="vista-coin"
                              href="#vista-coin" aria-expanded="true">Vista Coin</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="base-alexa" data-toggle="tab" aria-controls="alexa-coin" href="#alexa-coin" aria-expanded="false">Alexa Coin</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="base-transfer" data-toggle="tab" aria-controls="transfer-coin" href="#transfer-coin"
                              aria-expanded="false">Transfer Coins</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="base-stop-limit" data-toggle="tab" aria-controls="stop-limit"
                              href="#stop-limit" aria-expanded="false"></a>
                            </li>
                          </ul>
                          <div class="tab-content px-1 pt-1">
                            <!-- tab for vista coins -->
                            <div role="tabpanel" class="tab-pane active" id="vista-coin" aria-expanded="true" aria-labelledby="base-vista">
                              <div class="row">
                                <div class="col-12 col-xl-6 border-right-blue-grey border-right-lighten-4 pr-2 p-0">
                                  <div class="row my-2">
                                    <div class="col-4">
                                      <h5 class="text-bold-600 mb-0">Buy VISTA</h5>
                                    </div>
                                    <div class="col-8 text-right">
                                      <p class="text-muted mb-0">USD Balance: <span class="usd_balance">{{ $general->symbol }}{{ number_format((float)Auth::user()->balance, 2, '.', '') }}</span></p>
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
                                            <input type="number" class="form-control" id="vista_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateVistaTotal()" required step=".000001">
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
                                            <input type="number" class="form-control" id="vista_sell_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateVistaSellTotal()" required step=".000001">
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
                            <!-- tab for alexa coins -->
                            <div class="tab-pane" id="alexa-coin" aria-labelledby="base-alexa">
                              <div class="row">
                                <div class="col-12 col-xl-6 border-right-blue-grey border-right-lighten-4 pr-2 p-0">
                                  <div class="row my-2">
                                    <div class="col-4">
                                      <h5 class="text-bold-600 mb-0">Buy ALEXA</h5>
                                    </div>
                                    <div class="col-8 text-right">
                                      <p class="text-muted mb-0">USD Balance: <span class="usd_balance">{{ $general->symbol }}{{ number_format((float)Auth::user()->balance, 2, '.', '') }}</span></p>
                                    </div>
                                  </div>
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
                                            <input type="number" class="form-control" id="alexa_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateAlexaTotal()" required step=".000001">
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
                                      <p class="text-muted mb-0">ALEXA Balance: <span class="coin_balance">{{ number_format((float)$available_alxa_coins, 2) }}</span></p>
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
                                            <input type="number" class="form-control" id="alexa_sell_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="calculateAlexaSellTotal()" required step=".000001">
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
                            <!-- Coin Transfer Tab -->
                            <div role="tabpanel" class="tab-pane" id="transfer-coin" aria-expanded="true" aria-labelledby="base-transfer">
                              <div class="row">
                                <div class="col-12 col-xl-6 border-right-blue-grey border-right-lighten-4">
                                  <div class="row my-2">
                                    <div class="col-6">
                                      <h5 class="text-bold-600 mb-0">Transfer VISTA</h5>
                                    </div>
                                    <div class="col-6 text-right">
                                      <p class="text-muted mb-0">VISTA Balance: <span class="coin_balance">{{ number_format((float)$available_vista_coins, 2) }}</span></p>
                                    </div>
                                  </div>
                                  <meta name="csrf-token" content="{{ csrf_token() }}" /> 
                                  <form class="form form-horizontal transfer_coin" method="post">
                                    <input type="hidden" name="coin_id" value="2">
                                    <div class="form-body">
                                      <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="btc-limit-buy-price">Username</label>
                                        <div class="col-md-9">
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">
                                                <i class="la la-user"></i>
                                              </span>
                                            </div>
                                            <input type="text" name="username" class="form-control" id="refname" aria-describedby="basic-addon1" placeholder="USERNAME to Transfer" required>
                                            <input type="hidden" name="rate" id="vista_transfer_price" value="{{ $vista_rate }}">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group row" id="result_found_msg">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-9" id="result_found" style="font-weight: 800; color: green;">
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
                                            <input type="number" class="form-control" id="vista_transfer_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="checkVistaTransfer()" required step=".000001">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-actions pb-0">
                                        <button type="submit" name="submit" class="btn round btn-info btn-block btn-glow"> Transfer VISTA </button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="col-12 col-xl-6 pl-2 p-0">
                                  <div class="row my-2">
                                    <div class="col-6">
                                      <h5 class="text-bold-600 mb-0">Transfer ALEXA</h5>
                                    </div>
                                    <div class="col-6 text-right">
                                      <p class="text-muted mb-0">ALEXA Balance: <span class="coin_balance">{{ number_format((float)$available_alxa_coins, 2) }}</span></p>
                                    </div>
                                  </div>
                                  <meta name="csrf-token" content="{{ csrf_token() }}" /> 
                                  <form class="form form-horizontal transfer_coin" method="post">
                                    <input type="hidden" name="coin_id" value="1">
                                    <div class="form-body">
                                      <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="btc-limit-buy-price">Username</label>
                                        <div class="col-md-9">
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">
                                                <i class="la la-user"></i>
                                              </span>
                                            </div>
                                            <input type="text" name="username" class="form-control" id="refname-a" aria-describedby="basic-addon1" placeholder="USERNAME to Transfer" required>
                                            <input type="hidden" name="rate" id="alxa_transfer_price" value="{{ $alxa_rate }}">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group row" id="result_found_alexa_msg">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-9" id="result_found_alexa" style="font-weight: 800; color: green;">
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
                                            <input type="number" class="form-control" id="alxa_transfer_coins" aria-describedby="basic-addon1" placeholder="Number of Coins" name="coins" onBlur="checkAlxaTransfer()" required step=".000001">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-actions pb-0">
                                        <button type="submit" name="submit" class="btn round btn-info btn-block btn-glow"> Transfer ALEXA </button>
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
                
            <!--    </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </section>
  <!-- // Shopping cards section end -->      
</div>
<br/><br/>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $(document).on('blur','#refname',function() {
                var search_name = $('#refname').val();
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url:"{{route('get.user')}}",
                    data:{
                        'name': search_name ,
                        '_token' : token
                    },
                    success:function(data){
                      //  $("#resu").html(data);
                        if(data.status == 'warning'){
                           swal("Warning!", data.msg, "warning");  
                           $("#result_found").html('');
                        }
                        else if(data.status == 'danger'){
                           swal("Error!", data.msg, "error");  
                           $("#result_found").html('');
                        }
                        else if(data.status == 'success'){
                           swal("Success!", data.msg, "success");
                           $('#result_found_msg').show();
                           $("#result_found").html(data.transferer_id);  
                        }
                        else{
                           swal("Error!", 'Transaction Failed!', "error");
                        }
                        
                    }
                });
            });
            $(document).on('blur','#refname-a',function() {
                var search_name = $('#refname-a').val();
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url:"{{route('get.user')}}",
                    data:{
                        'name': search_name ,
                        '_token' : token
                    },
                    success:function(data){
                      //  $("#resu-a").html(data);
                        if(data.status == 'warning'){
                           swal("Warning!", data.msg, "warning");  
                           $("#result_found_alexa").html('');
                        }
                        else if(data.status == 'danger'){
                           swal("Error!", data.msg, "error");  
                           $("#result_found_alexa").html('');
                        }
                        else if(data.status == 'success'){
                           swal("Success!", data.msg, "success");
                           $('#result_found_alexa_msg').show();
                           $("#result_found_alexa").html(data.transferer_id);  
                        }
                        else{
                           swal("Error!", 'Transaction Failed!', "error");
                        }
                    }
                });
            });
        });
    </script>

@endsection