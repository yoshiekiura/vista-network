@extends('master')
@section('site-title')
    Coin Withdraw
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
                                    <span class="caption-subject bold uppercase">Coins Withdraw</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Transaction Id</th>
                                        <th>Client Name</th>
                                        <th>Coin Name</th>
                                        <th class="text-center">Coins Qty</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                        <th>Transaction Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coins as $key => $data)
                                        <tr id="row1">
                                            <td> <b>{{$data->transaction_id}}</b></td>
                                            <td> {{$data->member->first_name}} {{$data->member->last_name}} </td>
                                            <td> {{$data->coin->name}} </td>
                                            <td class="text-center"><b>{{$data->number_of_coins}} </b></td>
                                            <td> {{$general->symbol}} {{$data->rate}}</td>
                                            <td> {{$general->symbol}} {{$data->amount}}</td>
                                            <td> {{$data->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{$coins->links()}}
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