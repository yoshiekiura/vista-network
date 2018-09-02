@extends('master')
@section('site-title')
    Funds Transfer Log
@endsection

@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">Funds Transfer Log</h3>
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
                                    <th> Id </th>
                                    <th> Giver </th>
                                    <th> Receiver </th>
                                    <th> Amount </th>
                                    <th> Charges </th>
                                    <th> Status </th>
                                    <th> Requested On</th>
                                    <th> Processed On</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transfer as $key=>$data)
                                    <tr class="@if($data->status == 3) danger @elseif($data->status == 1) success @else warning @endif">

                                        <td >{{$data->transaction_id}}</td>
                                        <td>
                                            <p><a href="{{route('user.view', $data->giver->id)}}">{{$data->giver->first_name}}&nbsp;{{$data->giver->last_name}} </a> 
                                            </p>
                                            <p>{{$data->giver->email}}</p>
                                        </td>
                                        <td>
                                            <p><a href="{{route('user.view', $data->receiver->id)}}">{{$data->receiver->first_name}}&nbsp;{{$data->receiver->last_name}} </a> 
                                            </p>
                                            <p>{{$data->receiver->email}}</p>
                                        </td>
                                        <td>{{$data->amount}} {{$general->symbol}}</td>
                                        <td>{{$data->charges}} {{$general->symbol}}</td>
                                        <td>
                                            @if($data->status == 0)
                                                <span class="badge badge-pill badge-warning">Pending</span>
                                            @elseif($data->status == 1)
                                                <span class="badge badge-pill badge-success">Transfer</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Refunded</span>
                                            @endif
                                        </td>
                                        <td>{{date('g:ia \o\n l jS F Y', strtotime($data->created_at))}}</td>
                                        <td>{{date('g:ia \o\n l jS F Y', strtotime($data->updated_at))}}</td>
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