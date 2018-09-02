@extends('master')
@section('site-title')
    Transfer Fund Request
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
                                    <span class="caption-subject bold uppercase">Funds Transfer Requests</span>

                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Transfer Id</th>
                                            <th>Giver Name</th>
                                            <th>Receiver Name</th>
                                            <th>Amount</th>
                                            <th>Charges</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($funds as $key=> $data)
                                            <tr id="row1">
                                                <td> <b>{{$data->transaction_id}}</b></td>
                                                <td> {{$data->giver->first_name}}&nbsp;{{$data->giver->last_name}} </td>
                                                <td> {{$data->receiver->first_name}}&nbsp;{{$data->receiver->last_name}}</td>
                                                <td><b>${{$data->amount}} </b></td>
                                                <td> ${{$data->charges}}</td>
                                                <td>
                                                    @if($data->status == 0)
                                                        <span class="badge badge-pill badge-warning" style="color: black">Pending</span>
                                                        @elseif($data->status == 1)
                                                        <span class="badge badge-pill badge-success" style="color: black">Transfer</span>
                                                        @else
                                                        <span class="badge badge-pill badge-danger" style="color: black">Refunded</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <table border="0">
                                                        <tr>
                                                            <td>
                                                                <form method="post" action="{{ route('funds.transfer.store') }}">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="data_id" value="{{ $data->id }}">
                                                                    <input type="hidden" name="giver_id" value="{{ $data->giver_id }}">
                                                                    <input type="hidden" name="receiver_id" value="{{ $data->receiver_id }}">
                                                                    <input type="hidden" name="trans_id" value="{{$data->transaction_id}}">
                                                                    <button type="submit" name="submit" class="btn dark">Transfer</button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <a class="btn dark" href="{{route('funds.refunds.store', $data->id)}}">Refund </a>
                                                            </td>
                                                        </tr>    
                                                    </table>        
                                                <!--    <a class="btn dark" href="{{route('funds.transfer.store', $data->id)}}">Transfer </a> -->
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            {{$funds->links()}}
                                        </div>
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