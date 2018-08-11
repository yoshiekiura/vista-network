@extends('master')
@section('site-title')
    User Management
@endsection
@section('style')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="col-md-12">
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
                <div class="col-md-12">

                    <div class="portlet box grey-mint">
                        <div class="portlet-title">
                            <div class="caption uppercase bold">
                                <i class="fas fa-money-bill-alt"></i> CURRENT COINS BALANCE</div>
                        </div>
                        <div class="portlet-body uppercase text-center">
                            <h3>CURRENT BALANCE OF <strong>{{$user->first_name}} {{$user->last_name}}</strong></h3>
                            <h1><strong>Alexa: {{ $alxa_coin_balance }} </strong></h1>
                            <h1><strong>Vista: {{ $vista_coin_balance }} </strong></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="portlet box grey-mint">
                        <div class="portlet-title">
                            <div class="caption uppercase bold">
                                <i class="fa fa-cog"></i>   add / substruct balance to Sab demo
                            </div>
                        </div>
                        <div class="portlet-body">

                            <form action="{{route('user.coins.balance.update', $user->id)}}" method="post" novalidate>
                                {{csrf_field()}}
                                <div class="row uppercase">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong>OPERATION</strong></label>
                                            <div class="col-md-12">
                                                 <input data-toggle="toggle" checked data-onstyle="success" data-offstyle="danger" data-on="Add Coins" data-off="subtract Coins"  data-width="100%" type="checkbox" name="operation">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong>COIN</strong></label>
                                            <div class="col-md-12">
                                                 <select name="coin" class="form-control">
                                                    @foreach($coins as $coin)
                                                    <option value="{{ $coin->id }}">{{ $coin->name }}</option>
                                                    @endforeach
                                                 </select>   
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong>Amount</strong></label>
                                            <div class="col-md-12">
                                                <div class="input-group mb15">
                                                    <input class="form-control" name="amount" type="number" required step=".000001">
                                                    <span class="input-group-addon">Coins</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- row -->
                                <br><br>
                                <div class="row uppercase">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn grey-mint btn-lg btn-block"> SUBMIT </button>
                                    </div>
                                </div><!-- row -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
