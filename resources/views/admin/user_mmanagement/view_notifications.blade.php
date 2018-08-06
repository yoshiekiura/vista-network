@extends('master')
@section('site-title')
    User Notifications
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
                                <div class="caption uppercase bold"><i class="fa fa-user"></i> Client Details </div>
                            </div>
                            <div class="portlet-body">
                               <div class="row">
                                   <div class="col-md-12">
                                       <h2 class="bold">{{ $user->first_name}}&nbsp;{{ $user->last_name}} </h2>
                                       <h4>{{ $user->email }} </h4>
                                   </div>
                               </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Client Notifications</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Read</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notification as $key => $data)
                                        <tr id="row1">
                                            <td> {{ $key+1}}</td>
                                            <td> {{ $data->subject }} </td>
                                            <td> {!! $data->message !!}</td>
                                            <td>
                                                @if($data->status == 0)
                                                    <span class="text-danger">Unread</span>
                                                @else
                                                    <span class="text-success">Read</span>
                                                @endif 
                                            </td>
                                            <td> {{ \Carbon\Carbon::parse($data->created_at)->format('F dS, Y - h:i A') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{ $notification->links() }}
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