@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">My Orders</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">My Orders
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
        
<div class="content-body">

  <!-- Shopping cards section start -->
  <section id="shopping-cards">
            <!-- Active Orders -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Order Status</h4>
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
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Payment</th>
                    <th>QTY</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Order Date</th>
                  </tr>
                </thead>
                <tbody>
                @if(!$orders->isEmpty())  
                  @foreach($orders as $key => $data)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$data->order_id}}</td>
                      <td><a href="{{route('view.detail', $data->product->id)}}">{{$data->product->title}}</a></td>
                      <td>
                          @if($data->payment_type == "pay_full")
                              <span class="success">Full Payment</span>
                          @else
                              <span class="danger">Installments</span>
                          @endif
                      </td>
                      <td>{{$data->qty}}</td>
                      <td>{{$general->symbol}}{{$data->total}}</td>
                      <td>
                          @if($data->status == 0)
                              <div class="badge badge-info round">
                                <i class="la la-clock-o font-medium-2"></i>
                                <span>Pending</span>
                              </div>  
                          @elseif($data->status == 1)
                              <div class="badge badge-warning round">
                                <i class="la la-recycle font-medium-2"></i>
                                <span>Processing</span>
                              </div>
                          @elseif($data->status == 3)
                              <div class="badge badge-danger round">
                                <i class="la la-remove font-medium-2"></i>
                                <span>Rejected</span>
                              </div>
                          @else
                              <div class="badge badge-success round">
                                <i class="la la-check font-medium-2"></i>
                                <span>Delivered</span>
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
                @else
                  <tr>
                      <td colspan="8">No Transaction Found!</td>  
                  </tr>
                @endif    
                </tbody>
                <tfoot>
                  <tr>
                      <td colspan="8" class="text-center">{{ $orders->links() }}</td>
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
