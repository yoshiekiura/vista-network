@extends('master')
@section('site-title')
    Pay Installment
@endsection
@section('style')
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-010">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</h4>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    </div>
                </div>        
            @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Referral Commission Details</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>User's Name:</th>
                                                <td>{{$user_first_name}}&nbsp;{{$user_last_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>User's Balance:</th>
                                                <td>{{$general->symbol}}{{$user_balance}}</td>
                                            </tr>
                                            @foreach($order as $data)
                                            <tr>
                                                <th>Order ID:</th>
                                                <td>{{$data->order_id}}</td>
                                            </tr>
                                            <tr>
                                                <th>Product Name:</th>
                                                <td>{{$data->product->title}}</td>
                                            </tr>

                                            <tr>
                                                <th>Product Price:</th>
                                                <td>{{$general->symbol}}{{$data->product_price}} </td>
                                            </tr>

                                            <tr>
                                                <th>Purchase Date</th>
                                                <td>  {{ date('g:ia \o\n l jS F Y', strtotime($data->created_at)) }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th>Referrer Id</th>
                                                <th>Referrer Name</th>
                                                <th>Money</th>
                                                <th>Alexa Coins</th>
                                                <th>Vista Coins</th>
                                            </tr>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($commissions as $comm)
                                            <tr>
                                                <td class="text-center">{{$comm->referrer_id}}</td>
                                                <td>{{$comm->memberc->first_name}}&nbsp;{{$comm->memberc->last_name}}</td>
                                                <td class="text-center">{{$general->symbol}}{{$comm->money_comm}}</td>
                                                <td class="text-center">{{$comm->alxa_coin_comm}}</td>
                                                <td class="text-center">{{$comm->vista_coin_comm}}</td>
                                            </tr>
                                            @endforeach    
                                        </table>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function disableBack() { window.history.forward() }

            window.onload = disableBack();
            window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        });
    </script>
@endsection