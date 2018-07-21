@extends('master')
@section('site-title')
    View Commission
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">View Commissions</span>
                                </div>
                            
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $key => $data)
                                        <tr>
                                            <td><b>{{$data->order_id}}</b></td>
                                            <td>{{$data->member->first_name}} {{$data->member->last_name}}</td>
                                            <td>{{$data->product->title}}</td>
                                            <td>{{$general->symbol}}{{$data->product_price}}</td>
                                            <td>{{$data->created_at}}</td>
                                            <td><a href="{{ route('commission.details', $data->order_id) }}" class="btn blue btn-xs">Commission Details</a></td> 
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