@extends('home')

@section('style')
  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

    $(document).ready(function() {

        $( '.deposit_hp' ).on( 'submit', function(e) {
      
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var form = $(this);

            swal({
                title: "Confirm Deposit",
                text: "You are going to deposit in your HP wallet!",
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
                      url: '/hash-power/deposit',
                      type: 'POST',
                      dataType: 'json',
                      data: form.serialize(), 
                      success: function( result ) {
                          if(result == false){
                            swal("Warning!", "Your do not have enough balance!", "error");
                          }else{
                            swal("Success!", "Your have successfully deposit in your HP Wallet!", "success");
                            var remain_bal = 5000 - result;
                            $('#hp_bal').html(result);
                            $('#remain_bal').html(remain_bal);
                          } 
                      },
                      error: function (data) {
                            swal("Error!", "Transaction not complete!", "error");
                      }
                });

                } else {
                    swal("Cancelled", "Your transaction is cancelled :)", "error");
                    exit();
                }
            });

        });
    });

</script>    
@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Hash Power</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Hash Power</li>
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

  <!-- Content types section start -->
  <section id="invoice-summary">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Hash Power / LP (Lay-Away Program)</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
        <div class="heading-elements">
          <div class="dropdown">
            <button class="btn btn-sm round btn-danger btn-glow"><i class="la la-sort font-medium-1"></i> HP Balance: {{ $general->symbol }}<span id="hp_bal">{{ Auth::user()->hp_balance }}</span></button>
            <button class="btn btn-sm round btn-primary btn-glow"><i class="la la-sort font-medium-1"></i> 1st Milestone Remaining Balance: {{ $general->symbol }}<span id="remain_bal">{{ 5000 - Auth::user()->hp_balance }}</span></button>
          </div>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body overflow-hidden row">
                                      
          <div class="col-md-9 col-sm-12">
            @foreach($product->chunk(3) as $chunk)
            <div class="row match-height">
              @foreach($chunk as $data)
              <div class="col-xl-4 col-md-6 col-12">
              <meta name="csrf-token" content="{{ csrf_token() }}" /> 
              <form class="form form-horizontal deposit_hp" method="post">

                <div class="card bg-default border-pink border-lighten-2">
                  <div class="text-center">
                    <div class="card-body">
                        @php $i = 0; @endphp
                        @foreach($data->product as $key => $image)
                            <img src="{{ asset('assets/images/hash/'.$image->image) }}" class="rounded-circle  height-150" alt="HP Images">
                        @php $i++; @endphp
                        @endforeach
                    </div>
                    <div class="card-body">
                      <h4 class="card-title text-dark">{{ $data->title }}</h4>
                      <h6 class="card-subtitle text-muted">Price: {{ $general->symbol }}{{ $data->price }}</h6>

                      <input type="hidden" name="hp_product_id" value="{{ $data->id }}">
                      <input type="hidden" name="hp_product_price" value="{{ $data->price }}">
                    
                    </div>
                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1">Deposit</button>    
                    </div>
                  </div>
                </div>
               </form> 
              </div>
              @endforeach
            </div>  
            @endforeach  
          </div>
          
          <div class="col-md-3 col-sm-12">
            <div class="media-list list-group">
                <a href="#" class="list-group-item list-group-item-action media">
                  <div class="media-left">
                    <h4><b style="font-weight: 500;">{{ $hp_comm }}% Commission</b></h4>
                  </div>
                  <div class="media-body">
                  <!--  <h5 class="list-group-item-heading">Commission</h5> -->
                    <br/>
                    <br/>
                    <span class="list-group-item-text">
                      {{ $hp_comm }}% daily referral commission 7 days a week.
                    </span>
                  </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action media">
                  <div class="media-left">
                    <h4><b style="font-weight: 500;">{{ $hp_bonus }}% Fast Miner Bonus</b></h4>
                  </div>
                  <div class="media-body">
                  <!--  <h5 class="list-group-item-heading">Commission</h5> -->
                    <br/>
                    <br/>
                    <span class="list-group-item-text">
                      Paid once only to sponsor/referrer on purchase of new package.
                    </span>
                  </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action media">
                  <div class="media-left">
                    <h4><b style="font-weight: 500;">$5,000 HashPower</b></h4>
                  </div>
                  <div class="media-body">
                    <br/>
                    <br/>
                    <span class="list-group-item-text">
                      Client gets 1 Multi Miner free.<br/><br/>
                      His introducer also gets 1 Multi Miner free.<br/><br/>
                      Clients get daily returns of 0.25% - 2.5% 7 days a week on the $5000 Hash Power.<br/>
                    </span>
                  </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action media">
                  <div class="media-left">
                    <h4><b style="font-weight: 500;">$10,000 Hash Power</b></h4>
                  </div>
                  <div class="media-body">
                    <br/>
                    <br/>
                    <span class="list-group-item-text">
                      Client gets 3 Multi Miner free.<br/><br/>
                      His introducer also gets 1 Multi Miner free.<br/><br/>
                      Clients get daily returns of 0.25% - 2.5% 7 days a week on the $10000 Hash Power.
                    </span>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="row justify-content-center align-self-center">
                {{ $product->links() }}
          </div>  
        </div>
      </div>
    </div>
  </section>
  <!-- Content types section end -->      
</div>
<br/><br/>
@endsection

