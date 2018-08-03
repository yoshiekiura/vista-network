@extends('master')
@section('site-title')
    HP/LP Transactions
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
                                    <span class="caption-subject bold uppercase">HP/LP Transactions</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Transaction Id</th>
                                        <th>Client Name</th>
                                        <th>Product</th>
                                        <th class="text-center">Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th>Transaction Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($hashpower as $key => $data)
                                        <tr id="row1">
                                            <td> <b>{{$data->transaction_id}}</b></td>
                                            <td> {{$data->memberrr->first_name}} {{$data->memberrr->last_name}}</td>
                                            <td> {{$data->hashpower->title}} </td>
                                            <td class="text-center"><b>{{$data->qty}} </b></td>
                                            <td> {{$general->symbol}} {{$data->price}}</td>
                                            <td> {{$general->symbol}} {{$data->total}}</td>
                                            <td> {{$data->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{$hashpower->links()}}
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