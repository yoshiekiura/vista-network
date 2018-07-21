@extends('master')
@section('site-title')
    Orders List
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
                                    <span class="caption-subject bold uppercase">View Orders</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Customer Name</th>
                                        <th>Payment Type</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th class="text-center">Status</th>
                                        <th>Purchase Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $key => $data)
                                        <tr id="row1">
                                            <td> <b>{{$data->order_id}}</b></td>
                                            <td> {{$data->member->first_name}} {{$data->member->last_name}} </td>
                                            <td>
                                                @php

                                                if($data->payment_type == "installement")
                                                    $paymentType = "Installment";
                                                else
                                                    $paymentType = "Full Payment";
                                                
                                                @endphp 
                                                {{ $paymentType }} 
                                            </td>
                                            <td>{{$data->product->title}} </td>
                                            <td> {{$data->qty}} </td>
                                            <td><b>{{$general->symbol}} {{$data->total}}</b></td>
                                            <td class="text-center">
                                                @if($data->status == 0)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($data->status == 1)
                                                    <span class="badge badge-success">Processing</span>
                                                @elseif($data->status == 2)
                                                    <span class="badge badge-primary">Delivered</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td> {{$data->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{$orders->links()}}
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