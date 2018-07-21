@extends('master')
@section('site-title')
    Installments
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
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">View Installments</span>
                                </div>
                                <div class="tools"> </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Product</th>
                                        <th>Total<br/>Installment</th>
                                        <th>Paid<br/>Installment</th>
                                        <th>Installment<br/>Per Month</th>
                                        <th>Remaining<br/>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($installment as $key => $data)
                                        <tr>
                                            <td><b>{{$data->order_id}}</b></td>
                                            <td>{{$data->product_name}}</td>
                                            <td>{{$data->duration}}</td>
                                            <td>{{$data->paid_install}}</td>
                                            <td>{{$general->symbol}}{{$data->installment}}</td>
                                            @php
                                                $remaining_amount = $data->product_price - $data->advance_payment - $data->paid_amount;
                                            @endphp
                                            <td>
                                                @if($remaining_amount <= 0)
                                                    {{$general->symbol}}0 
                                                @else
                                                    {{$general->symbol}}{{$remaining_amount}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->paid_install == $data->duration)
                                                    <span class="badge badge-success">Complete</span>
                                                @else
                                                    <span class="badge badge-warning">In Progress</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('installment.details', $data->order_id) }}" class="btn blue btn-xs">Pay Installment</a></td> 
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