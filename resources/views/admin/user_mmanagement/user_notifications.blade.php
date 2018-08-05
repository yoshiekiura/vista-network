@extends('master')
@section('site-title')
    Send Notification
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-chambray">
                        <div class="portlet-title">
                            <div class="caption uppercase bold">
                                <i class="fa fa-envelope"></i>  Send notification to {{$user->first_name}} {{$user->last_name}}
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form action="{{route('send.notification.user', $user->id)}}" method="post">
                                {{csrf_field()}}
                                <div class="row uppercase">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong>Subject</strong></label>
                                            <div class="col-md-12">
                                                <input class="form-control" name="subject"  type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- row -->
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong>Message</strong></label>
                                            <div class="col-md-12">
                                                <textarea name="message" rows="5" class="form-control"></textarea>
                                                <small>Maximum 500 characters...</small>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- row -->
                                <br><br>
                                <div class="row uppercase">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn blue-chambray btn-block"> SEND NOTIFICATION </button>
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

