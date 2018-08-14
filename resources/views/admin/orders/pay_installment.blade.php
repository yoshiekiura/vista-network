@extends('master')
@section('site-title')
    Pay Installment
@endsection
@section('style')
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
            @if (Session::has('error'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    </div>
                </div>        
            @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Installment Detail</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>User's Name:</th>
                                                <td>{{$user_first_name}}&nbsp;{{$user_last_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>User's Balance:</th>
                                                <td>{{$general->symbol}}{{$user_balance}}</td>
                                            </tr>
                                            @foreach($installment as $data)
                                            <tr>
                                                <th>Order ID:</th>
                                                <td>{{$data->order_id}}</td>
                                            </tr>
                                            <tr>
                                                <th>Product Name:</th>
                                                <td>{{$data->product_name}}</td>
                                            </tr>

                                            <tr>
                                                <th>Product Price:</th>
                                                <td>{{$general->symbol}}{{$data->product_price}} </td>
                                            </tr>

                                            <tr>
                                                <th>Advance:</th>
                                                <td>{{$general->symbol}}{{$data->advance_payment}} </td>
                                            </tr>

                                            <tr>
                                                <th>Total Installments:</th>
                                                <td>{{$data->duration}} </td>
                                            </tr>

                                            <tr>
                                                <th>Paid Installments:</th>
                                                <td>{{$data->paid_install}} </td>
                                            </tr>

                                            <tr>
                                                <th>Remaining Amount:</th>
                                                @php
                                                    $remaining_amount = $data->product_price - $data->advance_payment - $paid_amount;
                                                @endphp
                                                <td>
                                                    @if($remaining_amount <= 0)
                                                        {{$general->symbol}}0 
                                                    @else
                                                        {{$general->symbol}}{{$remaining_amount}}
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Purchase Date</th>
                                                <td>  {{ date('g:ia \o\n l jS F Y', strtotime($data->created_at)) }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Payment</th>
                                                <th>Due Date</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($schedule as $sc)
                                            <tr>
                                                <td class="text-center">{{$i++}}</td>
                                                <td>{{$general->symbol}}{{$sc->payment_amount}}</td>
                                                <td>{{$sc->due_date}}</td>
                                                <td class="text-center">
                                                    @if($sc->status == 0)
                                                        <span class="badge badge-danger">UnPaid</span>
                                                    @else
                                                        <span class="badge badge-success">Paid</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $currentDate = Carbon\Carbon::today()->toDateString();
                                                        $today = strtotime($currentDate);
                                                        $dueDate = strtotime($sc->due_date);    
                                                    @endphp
                                                    @if($today >= $dueDate)
                                                        <form id="payInstallment" method="post" action="{{ route('pay.installment', $sc->id) }}">
                                                            <input name="_method" type="hidden" value="PUT">
                                                            <input type="hidden" id="order_id" name="order_id" value="{{$sc->order_id}}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            @if($sc->status == 0)
                                                            <input type="submit" name="submit" class="btn blue btn-xs" value="PAY">
                                                            @else
                                                            @endif
                                                        </form>
                                                    @else
                                                    @endif 
                                                </td>
                                            </tr>
                                            @endforeach    
                                        </table>   
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