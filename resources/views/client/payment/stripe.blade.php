@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Stripe Payment</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Income</a></li>
          <li class="breadcrumb-item"><a href="{{ route('add.fund.index') }}">Deposit Funds</a></li>
          <li class="breadcrumb-item active">Stripe Payment</li>
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
  <section id="shopping-cards">
    <div class="row justify-content-md-center">  
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
              <form method="POST" action="{{ URL::route('ipn.stripe') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="track" value="{{ $trx }}">
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
                        autofocus
                        required
                      />
                      <div class="form-control-position">
                        <i class="ft-credit-card"></i>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="timesheetinput2">CARD EXPIRATION DATE</label>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="position-relative has-icon-left">
            
                          <select name="cardExpiryMonth" class="form-control input-lg input-sz" required>
                             <option value="">Select Month</option>
                             <option value="1">January</option>
                             <option value="2">February</option>
                             <option value="3">March</option>
                             <option value="4">April</option>
                             <option value="5">May</option>
                             <option value="6">June</option>
                             <option value="7">July</option>
                             <option value="8">August</option>
                             <option value="9">September</option>
                             <option value="10">October</option>
                             <option value="11">November</option>
                             <option value="12">December</option>
                          </select>  
                        <!--  <div class="form-control-position">
                            <i class="la la-calendar"></i>
                          </div> -->
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="position-relative has-icon-left">
              
                          <select name="cardExpiryYear" class="form-control input-lg input-sz" required>
                             <option value="">Select Year</option>
                             <option value="2018">2018</option>
                             <option value="2019">2019</option>
                             <option value="2020">2020</option>
                             <option value="2021">2021</option>
                             <option value="2022">2022</option>
                             <option value="2023">2023</option>
                             <option value="2024">2024</option>
                             <option value="2025">2025</option>
                             <option value="2026">2026</option>
                             <option value="2027">2027</option>
                             <option value="2028">2028</option>
                             <option value="2029">2029</option>
                             <option value="2030">2030</option>
                          </select>
                        <!--  <input
                            type="tel"
                            class="form-control input-lg input-sz"
                            name="cardExpiry"
                            placeholder="MM / YYYY"
                            autocomplete="off"
                            required
                          />
                          <div class="form-control-position">
                            <i class="la la-briefcase"></i>
                          </div> -->
                        </div>
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

