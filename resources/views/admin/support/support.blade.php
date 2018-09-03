@extends('master')
@section('site-title')
    Vista Tickets
@endsection
@section('main-content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            @if(Session::has('msg'))
                <script>
                    $(document).ready(function(){
                        swal("{{Session::get('msg')}}","", "success");
                    });
                </script>
        @endif
        <!-- BEGIN PAGE TITLE-->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-th"></i>All Tickets List
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="awards">
                                <thead>
                                <tr>
                                    <th> Ticket Id </th>
                                    <th> Customer Name </th>
                                    <th> Subject </th>
                                    <th> Raised Time </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $all_ticket as $key=>$data)
                                <tr>
                                    <td>{{$data->ticket}}</td>
                                    <td><b>{{$data->user_member->first_name}} {{$data->user_member->last_name}}</b></td>
                                    <td><b>{{$data->subject}}</b></td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F dS, Y - h:i A') }}</td>
                                    <td class="text-center">
                                        @if($data->status == 1)
                                            <span class="badge badge-pill badge-warning">Open</span>
                                        @elseif($data->status == 2)
                                            <span class="badge badge-pill badge-success">Answered</span>
                                        @elseif($data->status == 3)
                                            <span class="badge badge-pill badge-info">Customer Reply</span>
                                        @elseif($data->status == 9)
                                            <span class="badge badge-pill badge-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn blue-madison" href="{{route('ticket.admin.reply', $data->ticket )}}">View</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {{$all_ticket->links()}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection