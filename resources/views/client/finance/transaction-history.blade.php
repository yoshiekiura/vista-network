@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Fund Transactions</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Finance</a></li>
          <li class="breadcrumb-item active">Transactions</li>
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
            <!-- Active Orders -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Fund Transactions</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <td>
                
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
                    <th>Transacted On</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Charge</th>
                    <th>Status</th>
                    <th>Post Balance</th>
                  </tr>
                </thead>
                <tbody>
                @if(!$trans->isEmpty())  
                  @foreach($trans as $key => $data)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td><b>{{$data->trans_id}}</b></td>
                      <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F dS, Y') }}</td>
                      <td>{{$data->description}}</td>
                      <td>
                          @if($data->amount < 0)
                            <span class="danger">-${{ abs($data->amount) }}</span>
                          @else
                            <span class="success">${{ $data->amount }}</span>
                          @endif
                      </td>
                      <td>
                          @if($data->charge)
                            ${{$data->charge}}
                          @else

                          @endif
                      </td>
                      <td>
                          @if($data->type == 2)
                              <div class="badge badge-success round">
                                <i class="la la-check-circle-o font-medium-2"></i>
                                <span>Deposit</span>
                              </div>  
                          @elseif($data->type == 3)
                              <div class="badge badge-danger round">
                                <i class="la la-cart-arrow-down font-medium-2"></i>
                                <span>Withdraw</span>
                              </div>
                          @elseif($data->type == 8)
                              <div class="badge badge-info round">
                                <i class="la la-refresh font-medium-2"></i>
                                <span>Transfer</span>
                              </div>
                          @elseif($data->type == 14)
                              <div class="badge badge-primary round">
                                <i class="la la-money font-medium-2"></i>
                                <span>Funds Received</span>
                              </div>
                          @endif
                      </td>
                      <td>${{ number_format((float)$data->new_balance, 2, '.', '') }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                      <td colspan="8">No Transaction Found!</td>
                  </tr>  
                @endif    
                </tbody>
                <tfoot>
                  <tr>
                      <td colspan="8" class="text-center">{{ $trans->links() }}</td>
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
