@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Notifications</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Notifications
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
        
<div class="content-body">

    <section id="basic-callouts">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Notifications</h4>
              <a class="heading-elements-toggle"><i class="la la-ellipsis font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                  <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collapse show">
              <div class="card-body">
                @foreach($notification as $no)
                <div class="bs-callout-primary callout-border-left mt-1 p-1">
                  <strong>{{ $no->subject }}</strong>
                  <p>{!! $no->message !!}</p>
                  @php    
                      $dt = $no->created_at;
                      $created_format = $dt->toFormattedDateString();
                  @endphp
                  <p>
                      {{ $created_format }}
                  </p>
                </div>
                <br/>
                @endforeach
              </div>
              <div class="card-footer">
                  {{ $notification->links() }}
              </div>  
            </div>
          </div>
        </div>
      </div>
    </section>
        
</div>
<br/><br/>
@endsection
