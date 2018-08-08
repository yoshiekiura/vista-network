@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">HP Commission</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Hash-Power Commission
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
        
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
                          <th>Commission</th>
                          <th>Amount</th>
                          <th>Description</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($hp_income as $key => $data)
                          <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$data->transaction_id}}</td>
                              <td>{{$data->commission_rate}} %</td>
                              <td>{{$general->symbol}}{{$data->commission_amount}}</td>
                              <td>
                                  @if($data->description == 'HP Daily Commission')
                                     <label class="text-info">{{$data->description}}</label>
                                  @else
                                     <label class="text-warning">{{$data->description}}</label>
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
