@extends('master')
@section('site-title')
    Coins Log
@endsection

@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Coin Log</h3>
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

                                </div>
                                <div class="tools"> </div>
                            </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Transaction Id </th>
                                    <th> User </th>
                                    <th> Coin Name </th>
                                    <th> Coins </th>
                                    <th> Rate </th>
                                    <th> Total </th>
                                    <th> Requested On</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($coins as $key=>$data)
                                    <tr class="@if($data->status == 3) danger @elseif($data->status == 1) success @else warning @endif">

                                        <td >{{$data->transaction_id}}</td>
                                        <td>
                                            <p><a href="{{route('user.view', $data->member->id)}}">{{$data->member->first_name}} {{$data->member->last_name}}</a> </p>
                                            <p>{{$data->member->email}}</p>
                                        </td>
                                        <td>{{$data->coin->name}}</td>
                                        <td>{{$data->number_of_coins}}</td>
                                        <td>{{$data->rate}} {{$general->symbol}}</td>
                                        <td>{{$data->amount}} {{$general->symbol}}</td>
                                        <td>{{date('g:ia \o\n l jS F Y', strtotime($data->created_at))}}</td>
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