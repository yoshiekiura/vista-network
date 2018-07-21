@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Stripe Payment</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Deposit Funds</a>
          </li>
          <li class="breadcrumb-item active">Stripe Payment
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>

@if (Session::has('message'))
  <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

@if (Session::has('alert'))
  <div class="alert alert-warning">{{ Session::get('alert') }}</div>
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
  <section id="shopping-cards">
    <div class="row match-height">  
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="basic-layout-icons">Stripe Payment</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
              <div class="card-text">
                
              </div>
              <form role="form" id="payment-form" method="POST" action="{{ route('ipn.stripe')}}">
              {{csrf_field()}}
                <div class="form-body">
                  <div class="form-group">
                    <label for="timesheetinput1">CARD NUMBER</label>
                    <div class="position-relative has-icon-left">
                      <input
                        type="tel"
                        class="form-control input-lg"
                        name="cardNumber"
                        placeholder="Valid Card Number"
                        autocomplete="off"
                        required autofocus
                      />
                      <div class="form-control-position">
                        <i class="ft-user"></i>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="timesheetinput2">EXPIRATION DATE</label>
                    <div class="position-relative has-icon-left">
          
                      <input
                        type="tel"
                        class="form-control input-lg input-sz"
                        name="cardExpiry"
                        placeholder="MM / YYYY"
                        autocomplete="off"
                        required
                      />
                      <div class="form-control-position">
                        <i class="la la-briefcase"></i>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="timesheetinput3">CVC CODE</label>
                    <div class="position-relative has-icon-left">
                      <input
                        type="tel"
                        class="form-control input-lg input-sz"
                        name="cardCVC"
                        placeholder="CVC"
                        autocomplete="off"
                        required
                      />
                      <div class="form-control-position">
                        <i class="ft-message-square"></i>
                      </div>
                    </div>
                  </div>
              
                </div>
                <div class="form-actions right">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Pay Now
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </section>
</div>
<br/><br/>
<script type="text/javascript" src="{{ asset('assets/user/stripe/payvalid.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/user/stripe/paymin.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('assets/user/stripe/payform.js') }}"></script>    
@endsection

