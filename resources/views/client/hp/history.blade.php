@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">HP Transactions</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">HP Transactions
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
            <!-- Active Orders -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">HP Transactions</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <td>
                  <button class="btn btn-sm round btn-danger btn-glow"><i class="la la-sort font-medium-1"></i> HP Balance: {{ $general->symbol }}{{ Auth::user()->hp_balance }}</button>
              </td>
            </div>
          </div>
          <div class="card-content">
            <div class="table-responsive">
              <table class="table table-de mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Transaction ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Deposit Date</th>
                  </tr>
                </thead>
                <tbody>
                @if(!$hashpower->isEmpty())  
                  @foreach($hashpower as $key => $data)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $data->transaction_id }}</td>
                      <td><a href="{{ route('hp.user.index') }}">{{ $data->hashproduct->title }}</a></td>
                      <td>{{ $general->symbol }}{{ $data->price }}</td>
                      <td>{{ $general->symbol }}{{ $data->total }}</td>
                      <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F dS, Y') }}</td>
                    </tr>
                    @endforeach
                @else
                  <tr>
                      <td colspan="6">No HP-LP Transaction Found!</td>
                  </tr>  
                @endif      
                </tbody>
                <tfoot>
                  <tr>
                      <td colspan="8" class="text-center">{{ $hashpower->links() }}</td>
                  </tr>  
                </tfoot>  
              </table>
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
