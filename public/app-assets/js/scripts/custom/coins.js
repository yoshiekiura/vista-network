
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

                          if(result.status == true){
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
                            swal("Error!", "Coins purchase technical error!", "error");
                      }
                });

                } else {
                    swal("Cancelled", "You have cancelled the order :)", "error");
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
                          if(result.status == true){
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
                            swal("Error!", "Coins withdraw technical error!", "error");
                      }
                });

                } else {
                    swal("Cancelled", "You have cancelled the order :)", "error");
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

    