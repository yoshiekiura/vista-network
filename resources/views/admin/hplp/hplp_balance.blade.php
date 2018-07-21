@extends('master')
@section('site-title')
    HP/LP Balances
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
                                    <span class="caption-subject bold uppercase">HP/LP Balances</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Daily Comission</th>
                                        <th>HP Balance</th>
                                        <th class="text-center">Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($hp_balance as $key => $data)
                                        <tr id="row1">
                                            <td> {{$data->first_name}} {{$data->last_name}}</td>
                                            <td><b>{{$data->email}}</b></td>
                                            <td> {{$comission}} %</td>
                                            <td> {{$general->symbol}} {{$data->hp_balance}}</td>
                                            <td class="text-center">
                                                @if($data->hp_balance == 0.00)
                                                    <span class="badge badge-danger">Inactive</span>
                                                @else
                                                    <span class="badge badge-success">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn blue btn-block" href="#">View Detail</a> 
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{$hp_balance->links()}}
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