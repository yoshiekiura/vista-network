@extends('home')

@section('style')
  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

      $(document).ready(function() {

          $(".installment_plan").hide();
          $("#payment_installment").hide();
          $('#advance').attr("disabled","disabled");
          $('#installment').attr("disabled","disabled");
          $('#duration').attr("disabled","disabled");

          $("input[name='payment']").click(function() {
              var pay = $(this).val();
              var qty = $('#prodQty').val();
              var qqty = parseInt(qty);

              if(pay == 'installement'){
                  $(".installment_plan").fadeIn(1000);
                  $("#payment_installment").show();
                  $("#payment_full").hide()
                  $("#payment_type").val(pay);
                  $('#prodQty').attr("readonly", true);
                  $('#advance').removeAttr("disabled");
                  $('#installment').removeAttr("disabled");
                  $('#duration').removeAttr("disabled");    
              }else{
                  $(".installment_plan").fadeOut(1000);
                  $("#payment_installment").hide();
                  $("#payment_full").show()
                  $("#payment_type").val(pay);
                  $('#advance').attr("disabled","disabled");
                  $('#installment').attr("disabled","disabled");
                  $('#duration').attr("disabled","disabled");
                  $('#prodQty').removeAttr("readonly");
              }
          
          });

          $("#prodQty").on('change keyup', function(){

              var qty = $('#prodQty').val();
              var qqty = parseInt(qty);
              var prodPrice = $('#prodPrice').val();
              var pprodPrice = parseInt(prodPrice);
              var newPrice = qqty * pprodPrice;

              $(".newPrice").html("<span>$" + newPrice + "</span>");
              $("#product_quantity").val(qqty);
              $("#product_quantity_display").html(qqty);
              
          });

           
        /*  $( '.purchase_product' ).on( 'submit', function(e) {
           
              $("#loader").show();

              $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            
              e.preventDefault();

              var form = $(this);
        
              $.ajax({
                    url: '/product/buy',
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(), 
                    success: function( result ) {
                        $("#info").modal('hide');
                        if(result == 'full'){
                          swal("Purchase Complete!", "Your order will deliver within 2 to 3 business days!", "success");
                        }
                        if(result == 'installment') {
                          swal("Purchase Complete!", "Your order will deliver when all installments will complete!", "success");
                        }
                        if(result == 'balance') {
                          swal("Warning!", "You do not have sufficient balance to purchase this product!", "warning");
                        }
                    },
                    error: function (data) {
                          $("#info").modal('hide');
                          swal("Error!", "Purchase not complete!", "error");
                    }
              });
          }); */

      }); 

      function Accept(dat){

          var terms = $('.terms').is(':checked');
          if(terms === true){
            $("#info").fadeOut(3000);
            return true;
          }else{
              swal("Warning!", "Please accept terms and condition!", "warning");
              return false;
          }
      }

  </script>    

@endsection
@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Product Details</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Product Details
          </li>
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

@if (Session::has('success'))
  <div class="alert bg-success alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> {{ Session::get('success') }}
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
                <div class="col-xl-6 col-md-12 p-2 pl-3">
                  <div class="">
                    <h2>{{$product->title}}</h2>
                    <div class="rating warning mb-1">
                      <i class="la la-star"></i>
                      <i class="la la-star"></i>
                      <i class="la la-star"></i>
                      <i class="la la-star"></i>
                      <i class="la la-star-half-o"></i> 1290 review
                    </div>
                    <p>{!! $product->description !!}</p>
                  </div>
                  <h2 class="py-2">{{$general->symbol}}{{$product->price}}</h2>
                  <p>
                      <input type="radio" name="payment" checked value="pay_full"> Pay in Full
                      @if($product->duration != 0)
                          <input type="radio" name="payment" value="installement"> Pay with Payments Plan
                      @endif
                  </p>
                  <p class="installment_plan card-content">
                      <table class="table table-striped installment_plan">
                          <tr>
                              <th>ADVANCE <br/><h4>{{ '$'.$product->advance }}</h4></th>
                              <th>INSTALLMENT <br/>
                                  @php
                                      $ipm = $product->price - $product->advance;
                                      if($product->duration == 0){
                                          $ipm = $ipm/1;
                                      }else{
                                          $ipm = $ipm/$product->duration;
                                      } 
                                  @endphp
                                  <h4>{{ '$' . ceil($ipm) }}</h4>
                              </th>
                              <th>DURATION <br/><h4>{{ $product->duration }} Months</h4></th>
                          </tr>    
                      </table>       
                  </p>
                  <p id="abc">
                      <table class="table table-bordered">
                          <tr>
                              <th>Product</th>
                              <th>Quanity</th>
                              <th>Price</th>
                              <th>Total</th>
                          </tr>    
                          <tr>
                              <td style="font-weight: 100;">{{$product->title}}</td>
                              <td style="font-weight: 100;">
                                  <input type="number" name="qty" id="prodQty" value="1" style="width: 50px; text-align: center;">
                                  <input type="hidden" id="prodPrice" name="prodPrice" value="{{$product->price}}">
                              </td>
                              <td style="font-weight: 100;">{{ '$' . $product->price}}</td>
                              <td style="font-weight: 100;" class="newPrice">{{ '$' . $product->price}}</td>
                          </tr>    
                      </table>
                  </p>
                  <button type="button" class="btn btn-warning btn-block btn-glow text-uppercase p-1" data-toggle="modal" data-backdrop="false" data-target="#info">Purchase</button>
                </div>
                <div class="col-xl-6 col-md-12 p-0">
                  <div class="row">
                    <div class="col-8 mx-auto">
                      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          @php $i = 0; @endphp
                             @foreach($product->product as $key => $image)
                              <div class="carousel-item @if($key == $i[0]) active @endif" style="margin-top: 30px;">
                                <img class="d-block w-100" src="{{ asset('assets/images/product/'.$image->image) }}" class="img-fluid"  />
                              </div>
                                @php $i++; @endphp
                            @endforeach
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
    <!--  <div class="col-xl-4 col-lg-6">
        <div class="card">
          <div class="card-content">
            <div class="card-body text-center bg-default p-0">
              
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </section>
  <!-- // Shopping cards section end -->      
</div>
<!-- Modal -->
<div class="modal fade text-left" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel11"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
    <!--  <div class="modal-header bg-info white">
        <h4 class="modal-title white" id="myModalLabel11">Confirm Purchase</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <div class="alert round bg-info alert-icon-left alert-arrow-left alert-dismissible mb-2"
                        role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
            <button type="button" class="close" data-dismiss="alert">
            </button>
            <strong>Thanks!</strong> for your exclusive {{ $product->title }} purchase.
        </div>
        <h5>Purchase Details</h5>
        <table class="table table-sm" id="payment_full">
          <tr>
              <th>Product</th>
              <td>
                  {{ $product->title }}
              </td>
          </tr>
          <tr>
              <th>Price</th>
              <td>
                  {{ $general->symbol }}{{ $product->price }}
              </td>
          </tr>
          <tr>
              <th>Quantity</th>
              <td>
                  <span id="product_quantity_display">1</span>
              </td>
          </tr>
          <tr>
              <th>Total</th>
              <td class="newPrice">
                  {{ $general->symbol }}{{ $product->price }}
              </td>
          </tr>
          <tr>
              <td colspan="2">
                <input type="checkbox" name="terms" class="terms"> I have read and accept <a href="#">terms</a> & <a href="#">conditions</a>.
              </td>
          </tr>  
        </table>
        <table class="table table-sm" id="payment_installment">
          <tr>
              <th>Product</th>
              <td>
                  {{ $product->title }}
              </td>
          </tr>
          <tr>
              <th>Price</th>
              <td>
                  {{ $general->symbol }}{{ $product->price }}
              </td>
          </tr>
          <tr>
              <th>Advance</th>
              <td>
                  {{ $general->symbol }}{{ $product->advance }}
              </td>
          </tr>
          <tr>
              <th>Total Installments</th>
              <td>
                  {{ $product->duration }}
              </td>
          </tr>
          <tr>
              <th>Installment per Month</th>
              <td>
                  {{ $general->symbol }}{{ ceil($ipm) }}
              </td>
          </tr>
          <tr>
              <td colspan="2">
                <input type="checkbox" name="terms" class="terms"> I have read and accept <a href="#">terms</a> & <a href="#">conditions</a>.
              </td>
          </tr>  
        </table>  

        <div class="d-flex justify-content-end">
      <!--    <meta name="csrf-token" content="{{ csrf_token() }}" />  -->
          <form class="purchase_product" role="form" method="post" action="{{ route('buy.product') }}"> 
          {{ csrf_field() }}
          <input type="hidden" name="advance" id="advance" value="{{ $product->advance }}">
          <input type="hidden" name="installment" id="installment" value="{{ ceil($ipm) }}">
          <input type="hidden" name="duration" id="duration" value="{{ $product->duration }}">
          <input type="hidden" name="payment_type" id="payment_type" value="pay_full">
          <input type="hidden" name="product_quantity" id="product_quantity" value="1">
          <input type="hidden" name="product" id="product" value="{{ $product->id }}">
          
          <button type="button" class="btn grey btn-outline-secondary" id="close" data-dismiss="modal">Close</button>
          @if(Auth::user()->balance > $product->price)
          <button type="submit" name="product" value="{{ $product->id }}" id="confirm" class="btn btn-outline-info" onClick="return Accept(this);">Confirm</button>
          @else
            <a href="#" class="btn btn-outline-primary">Add Fund</a>
          @endif
          </form>
        </div>  
      </div> 
    </div>
  </div>
</div>
<br/><br/>

@endsection

@section('script')

<script>
  $(document).ready(function(){
      $('#custom-icon').on('click',function(){
        swal("Payment Complete!", "Your order will deliver on your shipping address within 2 to 3 business days!", "success");
      });
  });
</script> 

@endsection