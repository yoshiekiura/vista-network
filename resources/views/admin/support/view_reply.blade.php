@extends('master')
@section('site-title')
    View Ticket
@endsection
@section('style')
<style>
    fieldset
    {
        border: 1px solid #ddd !important;
        margin: 0;
        xmin-width: 0;
        padding: 10px;
        position: relative;
        border-radius:4px;
        background-color:#f5f5f5;
        padding-left:10px!important;
    }

    legend
    {
        font-size:14px;
        font-weight:bold;
        margin-bottom: 0px;
        width: 35%;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px 5px 5px 10px;
        background-color: #ffffff;
    }
</style>
  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

    function closeTicket() {

        var ticket = document.getElementById("ticket").value;
        $('#close_ticket').fadeOut(4000);

        $.ajax({

            url: '/comment/close/'+ticket,
            type: 'GET',
            success: function( result ) {

              console.log(result);
                if(result.success == true){
                    swal("Success!", "Ticket closed, But you can start again any time.", "success");
                    $("#open-hide").hide();
                    $("#solve-hide").hide();
                    $("#reply-hide").hide();
                    $("#close-hide").hide();
                    $("#close-show").show();

                }else{
                    swal("Error!", "Ticket can't closed due to some technical error!", "error");
                }
            }

        }); 

    }

    function openTicket() {

        var ticket = document.getElementById("ticket").value;
        $('#open_ticket').fadeOut(4000);

        $.ajax({

            url: '/comment/reopen/'+ticket,
            type: 'GET',
            success: function( result ) {

                if(result.success == true){
                    swal("Success!", "Ticket Reopen, But you can close again any time.", "success");
                    $("#solve-hide").hide();
                    $("#reply-hide").hide();
                    $("#close-hide").hide();
                    $("#open-hide").hide();
                    $("#solve-show").show();
                    
                }else{
                    swal("Error!", "Ticket can't closed due to some technical error!", "error");
                }
            }

        }); 

    }

  </script>

@endsection
@section('main-content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-06">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <!-- BEGIN PAGE HEADER-->
            @if(Session::has('msg'))
                <script>
                    $(document).ready(function(){
                        swal("{{Session::get('msg')}}","", "success");
                    });
                </script>
        @endif
                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-edit"></i> {{$ticket_object->subject}} -  #{{$ticket_object->ticket}}
                            </div>
                            <div class="tools">
                                @if($ticket_object->status == 1)
                                    <span class="label label-default"> Open</span>
                                @elseif($ticket_object->status == 2)
                                    <span class="label label-success">  Answered </span>
                                @elseif($ticket_object->status == 3)
                                    <span class="label label-info"> Customer Reply </span>
                                @elseif($ticket_object->status == 9)
                                    <span class="label label-danger">  Close </span>
                                @endif

                                &nbsp; 
                                @if($ticket_object->status == 9)
                                  <button type="button" id="open_ticket" onClick="openTicket()" class="btn btn-success">Reopen Ticket</button>
                                @else
                                  <button type="button" id="close_ticket" onClick="closeTicket()" class="btn btn-danger">Close Ticket</button>
                                @endif
                                <input type="hidden" id="ticket" value="{{ $ticket_object->ticket }}">

                            </div>
                        </div>

                        <div class="portlet-body form">

                            <form method="POST" action="{{route('store.admin.reply', $ticket_object->ticket)}}" accept-charset="UTF-8" class="form-horizontal form-bordered">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        @foreach($ticket_data as $data)
                                        <div class="panel-body">
                                            <fieldset class="col-md-12">
                                                @if($data->type == 1)
                                                    <legend><span style="color: #0e76a8">{{$ticket_object->user_member->first_name}}</span> , <small>{{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }}</small></legend>
                                                 @else
                                                    <legend><span style="color: #0e76a8">{{Auth::guard('admin')->user()->name}}</span> , <small>{{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }}</small></legend>
                                                @endif
                                                <div class="panel panel-danger">
                                                    <div class="panel-body">
                                                        <p>{!! $data->comment !!}</p>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <div class="clearfix"></div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label class="col-md-12 bold">Reply: </label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="comment" rows="10"></textarea>
                                        </div>
                                    </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn purple col-md-12"><i class="fa fa-check"></i> Post</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection