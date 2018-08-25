@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Thank you</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Finance</a></li>
          <li class="breadcrumb-item"><a href="{{ route('request.users_management.index') }}">Funds Deposit</a></li>
          <li class="breadcrumb-item active">Thank you</li>
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
    <!--native-font-stack -->
    <section id="global-settings" class="card">
      <div class="card-header">
        <h4 class="card-title">Funds Deposit Request Complete</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            <li><a data-action="close"><i class="ft-x"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="card-text">
            <h3 class="text-success">Funds Deposit ({{ $trx }})</h3>
            <p>You have successfully transfered funds from your {{ $gateway_name }} account to Vista Network account.</p>
              <p>
                The following transaction has been debited from your account.<br/>
                <b>Transaction Details</b><br/><br/>
                Payment Gateway: <b>{{ $gateway_name }}</b><br/>
                Amount: <b>${{ $usd_amount }}</b><br/>
                Transaction ID: <b>{{ $trx }}</b><br/>
                Date: <b>{{ $date }}</b>
              </p>
            <p><small>You can continue by clicking one of the links below:</small></p>
            <ul>
              <li><a href="{{ route('home') }}">Dashboard</a></li>
              <li><a href="{{ route('user.shopping.history') }}">View your Orders</a></li>
              <li><a href="{{ route('hp.user.index') }}">Hash Power Lay Away Program</a></li>
              <li><a href="{{ route('coins.index') }}">Buy/Sell Coins</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
</div>

<br/><br/>
@endsection
