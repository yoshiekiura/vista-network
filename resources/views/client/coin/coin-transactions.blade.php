@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Coin Transactions</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Coin Transactions
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
                          <th>Transaction ID</th>
                          <th>Coin</th>
                          <th>Rate</th>
                          <th>QTY</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Purchase Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($coins as $key => $data)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $data->transaction_id }}</td>
                          <th>
                              @if($data->coin_id == 1)
                                <span class="primary">{{ $data->coin->name }}</span>
                              @else
                                <span class="danger">{{ $data->coin->name }}</span>
                              @endif
                          </th>
                          <td>{{ $general->symbol }}{{ $data->rate }}</td>
                          <td>{{ abs($data->number_of_coins) }}</td>
                          <td>{{ $general->symbol }}{{ abs($data->amount) }}</td>
                          <td>
                              @if($data->status == 1)
                                  <div class="badge badge-success round">
                                    <i class="la la-check-circle-o font-medium-2"></i>
                                    <span>Buy</span>
                                  </div>  
                              @elseif($data->status == 0)
                                  <div class="badge badge-danger round">
                                    <i class="la la-cart-arrow-down font-medium-2"></i>
                                    <span>Sell</span>
                                  </div>
                              @elseif($data->status == 2)
                                  <div class="badge badge-warning round">
                                    <i class="la la-refresh font-medium-2"></i>
                                    <span>Transfer</span>
                                  </div>
                              @endif
                          </td>
                          @php    

                              $dt = $data->created_at;
                              $created_format = $dt->toFormattedDateString();

                          @endphp
                          <td>{{ $created_format }}</td>
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
