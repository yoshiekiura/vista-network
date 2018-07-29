@extends('layouts.app')

@section('content')

    <section class="flexbox-container">
      <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">

        @if (Session::has('message'))
          <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

        @if (Session::has('alert'))
          <div class="alert alert-danger">{{ Session::get('alert') }}</div>
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
            
          <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header border-0">
              <div class="card-title text-center">
                <div class="p-1">
                  <img src="{{ URL::asset('assets/images/fontend_logo/logo.png') }}" alt="Vista Logo" style="width: 150px; height: 50px;">
                </div>
              </div>
              
            </div>
            <div class="card-content">
              <div class="card-body">
                <form class="form-horizontal form-simple" method="post" action="{{ route('reset.passw') }}" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <input type="hidden" name="token" value="{{ $reset->token }}">
                  <fieldset class="form-group position-relative has-icon-left mb-0 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control form-control-lg input-lg" name="email" id="email" tabindex="1" value="{{ $reset->email }}" required autofocus readonly>
                    @if ($errors->has('email'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <div class="form-control-position">
                      <i class="ft-at-sign"></i>
                    </div>
                  </fieldset>
                  <br/>
                  <fieldset class="form-group position-relative has-icon-left mb-0 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control form-control-lg input-lg" name="password" id="password" tabindex="1" placeholder="New Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div class="form-control-position">
                      <i class="ft-lock"></i>
                    </div>
                  </fieldset>
                  <br/>
                  <fieldset class="form-group position-relative has-icon-left mb-0 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" class="form-control form-control-lg input-lg" name="password_confirmation" id="password-confirm" tabindex="1" placeholder="Confirm Password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                    <div class="form-control-position">
                      <i class="ft-lock"></i>
                    </div>
                  </fieldset>
                  <br/>
                  <button type="submit" class="btn btn-info btn-block"><i class="ft-lock"></i> Reset Password</button>
                </form>
              </div>
            </div>
            <div class="card-footer">
              <div class="">
              <!--  <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>  -->
                <p class="float-sm-right text-center m-0"><a href="{{ route('login') }}" class="card-link">Back</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

