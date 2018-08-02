@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Change Password</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Change Password
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
    <section id="striped-label-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            
            <div class="card-content collapse show">
              <div class="card-body">
                <div class="card-text"></div>
                <form method="post" action="{{ route('change.password.user') }}">
                  {{ csrf_field() }}
                  <input type="hidden" name="id" value="{{Auth::user()->id}}">
                  <div class="form-body">
                    <h4 class="form-section"><i class="la la-clipboard"></i> Password</h4>
                    <div class="form-group row {{ $errors->has('passwordold') ? ' has-error' : '' }}">
                      <label class="col-md-3 label-control text-right" for="projectinput5">Current Password</label>
                      <div class="col-md-9">
                        <input type="password" class="form-control" placeholder="Current Password" name="passwordold" required>
                        @if ($errors->has('passwordold'))
                          <span class="help-block">
                            <strong>{{ $errors->first('passwordold') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                      <label class="col-md-3 label-control text-right" for="projectinput6">New Password</label>
                      <div class="col-md-9">
                        <input type="password" class="form-control" placeholder="New Password"  name="password" required>
                        @if ($errors->has('password'))
                          <span class="help-block">
                             <strong>{{ $errors->first('password') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                      <label class="col-md-3 label-control text-right" for="projectinput7">Confirm Password</label>
                      <div class="col-md-9">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                          <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-actions text-center">
                    <button type="submit" class="btn btn-primary">
                      <i class="la la-check"></i> Save
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

