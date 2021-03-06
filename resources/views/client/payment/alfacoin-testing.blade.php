@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Alfacoin Payment</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Income</a></li>
          <li class="breadcrumb-item"><a href="{{ route('add.fund.index') }}">Deposit Funds</a></li>
          <li class="breadcrumb-item active">AlfaCoin Payment</li>
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
    <section id="horizontal-form-layouts">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="horz-layout-card-center">Deposit Funds {{$general->cur}}</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    
                  </div>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                    <div class="card-text">
                      
                      <h3>Deposit Funds <span style="color:red">{{ $result_final->id }} </span> </h3>

                      <form action="https://www.alfacoins.com/invoice/5b87081822a2d" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $result_final->id }}">
                        <input type="hidden" name="payerName" value="{{ $payerName }}">
                        <input type="hidden" name="payerEmail" value="{{ $payerEmail }}">
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="projectinput1">Send this exact amount of:</label>
                                <input type="text" id="coin_amount" class="form-control" value="{{ $result_final->coin_amount }}" name="coin_amount" readonly>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="projectinput2">to Bitcoin Address</label>
                                <input type="text" id="address" class="form-control" value="{{  $result_final->address }}" name="address" readonly>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-9">
                              <table style="width: 100%;" cellpadding="5">
                                <tr>
                                    <th>Order ID:</th>
                                    <td>{{ $result_final->id }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>Deposit Funds</td>
                                </tr>
                                <tr>
                                    <th>Amount:</th>
                                    <td>{{ $result_final->coin_amount }} BTC</td>
                                </tr>
                                <tr>
                                    <th>Merchant name:</th>
                                    <td>Vista.Network</td>
                                </tr>
                                <tr>
                                    <th>Site:</th>
                                    <td>vista.network</td>
                                </tr>  
                              </table>  
                           </div> 
                           <div class="col-md-3">
                              <iframe src="{{ $result_final->iframe }}">
                                <p>Your browser does not support iframes.</p>
                              </iframe>
                           </div>
                        </div>
                        <div class="form-actions">
                          <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Submit
                          </button>
                        </div>  
                      </form>

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

