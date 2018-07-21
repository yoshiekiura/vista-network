@extends('home')

@section('style')
  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

    function closeTicket() {

        var ticket = document.getElementById("ticket").value;
      
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

  </script>

@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">View Ticket</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">View Ticket
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>

@if (Session::has('message'))
  <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

@if (Session::has('alert'))
  <div class="alert alert-warning">{{ Session::get('alert') }}</div>
@endif

@if (count($errors) > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</b>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    </div>
@endif
        
<div class="content-body">

<section id="horizontal-form-layouts">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title" id="horz-layout-basic">Ticket Details</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
              <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              <li><a data-action="close"><i class="ft-x"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collpase show">
          <div class="card-body">
            <div class="card-text">
            
            </div>
            <form method="POST" action="{{ route('store.customer.reply', $ticket_object->ticket) }}" accept-charset="UTF-8">
              {{csrf_field()}}
              <div class="row">
                <div class="col-md-6">
                   <h4><b>Ticket #:</b> {{ $ticket_object->ticket }} </h4>
                   <h4><b>Ticket Subject:</b> {{ $ticket_object->subject }} </h4>
                   <h4><b>Status:</b> 
                      @if($ticket_object->status == 1)
                          <div class="badge border-warning warning round badge-border" id="open-hide">
                              <span>Open</span>
                              <i class="la la-folder-open font-medium-2"></i>
                          </div>
                      @elseif($ticket_object->status == 2)
                          <div class="badge border-success success round badge-border" id="solve-hide">
                              <span>Solved</span>
                              <i class="la la-check font-medium-2"></i>
                          </div>
                      @elseif($ticket_object->status == 3)
                          <div class="badge border-info info round badge-border" id="reply-hide">
                              <span>Customer Reply</span>
                              <i class="la la-info font-medium-2"></i>
                          </div>
                      @elseif($ticket_object->status == 9)
                          <div class="badge border-danger danger round badge-border" id="close-hide">
                              <span>Close</span>
                              <i class="la la-lock font-medium-2"></i>
                          </div>
                      @endif
                          <div class="badge border-danger danger round badge-border" id="close-show" style="display: none;">
                              <span>Close</span>
                              <i class="la la-lock font-medium-2"></i>
                          </div>
                   </h4>
                </div>
                <div class="col-md-6">
                  <p class="float-right">
                    <button type="button" id="close_ticket" onClick="closeTicket()" class="btn btn-danger round btn-min-width mr-1 mb-1">Close Ticket</button>
                    <input type="hidden" id="ticket" value="{{ $ticket_object->ticket }}">
                  </p>  
                </div>  
              </div>
              <hr/><br/>  
              <div class="form-body">
            
                @foreach($ticket_data as $data)  
                <div class="form-group row">
                  <div class="col-md-12">
                    @if($data->type == 1)
                        <h4><b style="color: #0e76a8">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</b> - <small>{{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }}</small></h4>
                        <br/>
                    @else
                        <h4><b style="color: #0e76a8">{{$general->web_title}}</b> - <small>{{ \Carbon\Carbon::parse($data->updated_at)->format('F dS, Y - h:i A') }}</small></h4>
                        <br/>
                    @endif
                    <p>
                        {!! $data->comment !!}
                    </p>  
                  </div>
                </div>
                @endforeach
                <hr/>

                <h4 class="form-section"><i class="ft-corner-up-left"></i> Reply</h4>

                <div class="form-group row {{ $errors->has('comment') ? ' has-error' : '' }}">
                  <div class="col-md-12">
                    <textarea class="form-control" name="comment" rows="5"></textarea>
                    @if ($errors->has('comment'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
      
              </div>
              <div class="form-actions text-center">
                <button type="submit" class="btn btn-primary">
                  <i class="la la-check-square-o"></i> Reply
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
</div>
<br/><br/>
@endsection
