@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Customer Support Tickets</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">New Ticket
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
          <h4 class="card-title" id="horz-layout-basic">New Ticket</h4>
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
            <form method="POST" action="{{route('ticket.store')}}" accept-charset="UTF-8">
              {{csrf_field()}}
              <div class="form-body">
                <h4 class="form-section"><i class="ft-clipboard"></i> Create New Ticket</h4>
                <div class="form-group row">
                  <label class="col-md-3 label-control text-right" for="projectinput5">Subject</label>
                  <div class="col-md-9">
                    <input type="text" id="projectinput5" class="form-control" name="subject" placeholder="Subject" required>
                  </div>
                </div>
      
                <div class="form-group row">
                  <label class="col-md-3 label-control text-right" for="projectinput9">Message</label>
                  <div class="col-md-9">
                    <textarea id="projectinput9" rows="12" class="form-control" name="detail" placeholder="Type your message here.." required></textarea>
                  </div>
                </div>
              </div>
              <div class="form-actions text-center">
                <button type="submit" class="btn btn-primary">
                  <i class="la la-check-square-o"></i> Save
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
