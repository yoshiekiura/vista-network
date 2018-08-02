@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Referral Commission</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Referral Commission
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

  <!-- Shopping cards section start -->
  <section id="shopping-cards">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-xl-12 col-md-12 p-2 pl-3">
                    <table class="table table-striped table-bordered bootstrap-3">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Amount</th>
                          <th>Vista Coins</th>
                          <th>Alexa Coins</th>
                          <th>Description</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($ref_commission as $key => $data)
                          <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$general->symbol}}{{$data->money_comm}}</td>
                              <td>{{$data->alxa_coin_comm . ' alexa coins'}}</td>
                              <td>{{$data->vista_coin_comm . ' vista coins'}}</td>
                              <td>{{$data->description}}</td>
                              <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F dS, Y - h:i A') }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
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
