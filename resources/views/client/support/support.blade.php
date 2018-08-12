@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Customer Support Tickets</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Tickets</li>
        </ol>
      </div>
    </div>
  </div>
</div>
        
<div class="content-body">

  <!-- Shopping cards section start -->
  <section id="shopping-cards">
            <!-- Active Orders -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">My Tickets</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">            
                <a href="{{ route('add.new.ticket') }}"><button type="button" class="btn btn-sm round btn-danger btn-glow">New Ticket</button></a>
            </div>
          </div>
          <div class="card-content">
            <div class="table-responsive">
              <table class="table table-de mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Ticket ID</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @if(!$all_ticket->isEmpty())
                  @foreach($all_ticket as $key=>$data)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$data->ticket}}</td>
                      <td><b>{{$data->subject}}</b></td>
                      @php    

                          $dt = $data->created_at;
                          $created_format = $dt->toFormattedDateString();

                      @endphp
                      <td>
                          @if($data->status == 1 || $data->status == 3)
                              <div class="badge badge-success round">
                            <!--    <i class="la la-clock-o font-medium-2"></i> -->
                                <span>Open</span>
                              </div>
                          @elseif($data->status == 9)
                              <div class="badge badge-danger round">
                          <!--      <i class="la la-lock font-medium-2"></i> -->
                                <span>Closed</span>
                              </div>
                          @elseif($data->status == 2)
                              <div class="badge badge-info round">
                          <!--      <i class="la la-check font-medium-2"></i> -->
                                <span>Admin Reply</span>
                              </div>    
                          @endif
                      </td>
                      <td>{{ $created_format }}</td>
                      <td><a href="{{route('ticket.customer.reply', $data->ticket )}}"><button class="btn btn-primary btn-sm">Details</button></a></td>
                  </tr>
                  @endforeach
                @else
                    <tr>
                      <td colspan='6'>No Ticket Found!</td> 
                    </tr>  
                @endif  
                </tbody>
                <tfoot>
                  <tr>
                      <td colspan="8" class="text-center">{{ $all_ticket->links() }}</td>
                  </tr>  
                </tfoot>  
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </section>
  <!-- // Shopping cards section end -->      
</div>
<br/><br/>
@endsection
