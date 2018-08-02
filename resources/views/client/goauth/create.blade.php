@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Two Factor Authentication</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Two Factor Authentication</li>
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
        <!-- Search form-->
        <section id="search-website" class="card overflow-hidden">
          <div class="card-header">
            <h4 class="card-title">Security 2 Steps</h4>
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
          <div class="card-content">
            
            <!--Search Result-->
            <div id="search-results" class="card-body">
              <div class="row">
                <div class="col-12 col-md-8">
                  
                  <div class="row match-height">
                    <div class="col-xl-12 col-md-12">
                    
                    @if(Auth::user()->tauth == '1')  
                      <div class="card border-primary">
                        <div class="card-header">
                          <h4 class="card-title">Two Factor Authenticator</h4>
                        </div>
                        <div class="card-content">
                          <div class="card-body">
                            <fieldset>
                              <div class="input-group">
                                <input type="text" class="form-control btn-lg" value="{{$prevcode}}" placeholder="Code" aria-describedby="button-addon2" id="code" readonly>
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="button">Copy</button>
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div class="card-body">
                            <p class="card-text text-center">
                              <img src="{{$qrCodeUrl}}">
                            </p>
                          </div>
                        </div>
                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                          <button class="btn btn-danger btn-min-width btn-glow btn-block mr-1 mb-1" type="button" data-toggle="modal" data-target="#disableModal">Disable Two Factor Authenticator</button>
                        </div>
                      </div>
                    @else  
                      <div class="card border-primary">
                        <div class="card-header">
                          <h4 class="card-title">Two Factor Authenticator</h4>
                        </div>
                        <div class="card-content">
                          <div class="card-body">
                            <fieldset>
                              <div class="input-group">
                                <input type="text" class="form-control btn-lg" value="{{$prevcode}}" placeholder="Code" aria-describedby="button-addon2" id="code" readonly>
                                <div class="input-group-append">
                                  <button class="btn btn-primary" id="copybtn" type="button">Copy</button>
                                </div>
                              </div>
                            </fieldset>
                          </div>
                          <div class="card-body">
                            <p class="card-text text-center">
                              <img src="{{$qrCodeUrl}}">
                            </p>
                          </div>
                        </div>
                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                          <button class="btn btn-primary btn-min-width btn-glow btn-block mr-1 mb-1" type="button" data-toggle="modal" data-target="#enableModal">Enable Two Factor Authenticator</button>
                        </div>
                      </div>
                    @endif  
                    </div>
                  </div>

                </div>
                <div class="col-12 col-md-4">
                  <div class="card border-grey border-lighten-2">
                    <div class="card-body px-0">
                      <h4 class="card-title">Google Authenticator</h4>
                      <h4 class="card-title">Use Google Authenticator To Scan The QR Code Or Use The Code</h4>
                      <p class="card-text font-medium-2">
                        Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device.
                      </p>                      
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Search form -->
      </div>
      <br/><br/>
      
      <script type="text/javascript">
          document.getElementById("copybtn").onclick = function()
          {
              document.getElementById('code').select();
              document.execCommand('copy');
          }
      </script>
      <!-- Modal -->
      <div class="modal fade text-left" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34"
      aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel34">Verify your OTP to Disable</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form>
              <div class="modal-body">
                <form action="{{route('disable.2fa')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" class="form-control" name="code" placeholder="Enter Google Authenticator Code">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Verify</button>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal"
                value="close">
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade text-left" id="enableModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34"
      aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="myModalLabel34">Verify your OTP</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form>
              <div class="modal-body">
                <form action="{{route('go2fa.create')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="key" value="{{$secret}}">
                        <input type="text" class="form-control" name="code" placeholder="Enter Google Authenticator Code">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Verify</button>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <input type="reset" class="btn btn-outline-secondary" data-dismiss="modal"
                value="close">
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection

