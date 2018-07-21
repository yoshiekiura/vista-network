@extends('master')
@section('site-title')
    Coins Balances
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
                                    Coins Balances
                                </div>
                                <div class="tools"> </div>
                            </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Client Name</th>
                                                <th>Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($user as $key => $data)
                                                <tr id="row1">
                                                    <td> {{$data->first_name}} {{$data->last_name}}</td>
                                                    <td> {{$data->email}}</td>
                                                </tr>
                                            @endforeach       
                                            </tbody>
                                            </table>    
                                        </td>
                                        <td>
                                            <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Alexa Coins</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($alxa_coins as $key => $data)
                                                <tr id="row1">
                                                    <td class="text-center"> {{$data->sum}}</td>
                                                </tr>
                                            @endforeach    
                                            </tbody>
                                        </table>    
                                        </td>
                                        <td>
                                            <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Vista Coins</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vista_coins as $key => $data)
                                                <tr id="row1">
                                                    <td class="text-center"> {{$data->sum}}</td>
                                                </tr>
                                            @endforeach    
                                            </tbody>
                                        </table>    
                                        </td>
                                    </tr>
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