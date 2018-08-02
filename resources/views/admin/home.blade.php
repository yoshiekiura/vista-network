@extends('master')
@section('site-title')
    Admin DashBoard | Vista Network
@endsection
@section('style')
    <style>
        .visual{
            color: #f7f6ff;
        }
        .pranto{
            margin-bottom: 5px;
        }
        
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
                @if (count($errors) > 0)
                    <div class="row">
                        <div class="col-md-06">
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
            <h3 class="page-title">Admin Dashboard
                <small>dashboard & statistics</small>
            </h3>
        @if (Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @endif
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box dark">
                <div class="portlet-title">
                    <div class="caption uppercase bold"><i class="fa fa-user"></i> User Panel</div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="pranto pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\User::count()}}">0</span>
                                    </div>
                                    <div class="desc"> Total Users </div>
                                </div>
                                <a class="more" href="{{url('admin/users')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-user-times"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\User::where('status', 0)->count()}}">0</span>
                                    </div>
                                    <div class="desc">Deactive User</div>
                                </div>
                                <a class="more" href="{{route('index.deactive.user')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green-meadow">
                                <div class="visual">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\User::where('paid_status', 1)->count()}}">0</span>
                                    </div>
                                    <div class="desc">Total Paid User</div>
                                </div>
                                <a class="more" href="{{route('paid.user.index')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="far fa-user-circle"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\User::where('paid_status', 0)->count()}}">0</span>
                                    </div>
                                    <div class="desc">Total Free User</div>
                                </div>
                                <a class="more" href="{{route('free.user.index')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box dark">
                <div class="portlet-title">
                    <div class="caption uppercase bold"><i class="fas fa-filter"></i> Fund Panel</div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple-sharp">
                                <div class="visual">
                                    <i class="fas fa-money-bill-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ number_format(\App\User::sum('balance'),2)}}">0 </span> {{$general->symbol}}
                                    </div>
                                    
                                    <div class="desc"> All Users Balance</div>
                                </div>
                                <a class="more" href="{{url('admin/users')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow-gold ">
                                <div class="visual">
                                    <i class="far fa-credit-card"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\Deposit::where('status', 1)->sum('amount')}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Total Add Fund</div>
                                </div>
                                <a class="more" href="{{route('index.deposit.user')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red-soft ">
                                <div class="visual">
                                    <i class="fas fa-retweet"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\WithdrawTrasection::where('status', 1)->sum('amount')}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Total Withdraw</div>
                                </div>
                                <a class="more" href="{{url('admin/withdraw/log')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat grey-mint ">
                                <div class="visual">
                                    <i class="fas fa-lock-open"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ number_format(\App\Transaction::where('type', 10)->sum('amount')) }}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Admin Generated</div>
                                </div>
                                <a class="more" href="{{route('admin.generate.view')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red-pink ">
                                <div class="visual">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{abs(\App\Transaction::where('type', 11)->sum('amount'))}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Admin Subtract</div>
                                </div>
                                <a class="more" href="{{route('admin.subtract.view')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue-chambray">
                                <div class="visual">
                                    <i class="fas fa-stopwatch"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\Income::where('type', 'B')->sum('amount')}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Total Binary Amount</div>
                                </div>
                                <a class="more" href="{{url('admin/match')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green-seagreen ">
                                <div class="visual">
                                    <i class="fas fa-link"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\Income::where('type', 'R')->sum('amount')}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Total Referral Amount</div>
                                </div>
                                <a class="more" href="{{route('ref.amount.total')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red-thunderbird  ">
                                <div class="visual">
                                    <i class="fas fa-spinner"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\WithdrawTrasection::where('status', 0)->count()}}">0</span>
                                    </div>
                                    <div class="desc">Withdraw Requests</div>
                                </div>
                                <a class="more" href="{{ url('admin/withdraw/requests') }}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>


                    </div>

                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box dark">
                <div class="portlet-title">
                    <div class="caption uppercase bold"><i class="far fa-money-bill-alt"></i> Admin Income Panel</div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat dark  ">
                                <div class="visual">
                                    <i class="fas fa-money-bill-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\Transaction::where('type', 2)->sum('charge')}}">0 </span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Total Withdraw Charge</div>
                                </div>
                                <a class="more" href="{{url('admin/withdraw/log')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue-sharp ">
                                <div class="visual">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\Transaction::where('type', 3)->sum('charge')}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Total Transfer Charge</div>
                                </div>
                                <a class="more" href="{{route('index.transfer.user')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green-seagreen">
                                <div class="visual">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{abs(\App\Transaction::where('type', 2)->sum('amount'))}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Total Upgrade Charge</div>
                                </div>
                                <a class="more" href="{{route('paid.user.index')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

                        <div class="pranto col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat grey-gallery">
                                <div class="visual">
                                    <i class="fas fa-plus-square"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{\App\Deposit::where('status', 1)->sum('trx_charge')}}">0</span> {{$general->symbol}}
                                    </div>
                                    <div class="desc">Add Fund Charge</div>
                                </div>
                                <a class="more" href="{{url('admin/add/fund/user')}}"> View more
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
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

