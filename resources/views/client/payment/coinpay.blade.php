@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Coin Payment</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Deposit Funds</a>
          </li>
          <li class="breadcrumb-item active">Coin Payment
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
    <section id="horizontal-form-layouts">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="horz-layout-card-center">Confirm Buy {{$general->cur}}</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    
                  </div>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                    <div class="card-text">
                      
                      <div class="text-center">
                        <h1><img src="{{ asset('assets/images/logo/fsdf.png') }}" width="100px">{{$amon}}
                            <i class="fa fa-exchange"></i> <i class="fa fa-bitcoin"></i>{{ $bcoin }}</h1>

                        <b style="color: red;"> Minimum 3 Confirmation Required to Credited Your Account.<br/>(It May Take Upto 2 to 24 Hours)</b>
                        <br/>
                        <p>{!! $form !!}</p>
                      </div>    

                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section> 
</div>       
<br/><br/>
@endsection

