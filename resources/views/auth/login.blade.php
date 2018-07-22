@extends('layouts.app')

@section('content')

    <section class="flexbox-container">
      <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
          <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header border-0">
              <div class="card-title text-center">
                <div class="p-1">
                  <img src="{{ URL::asset('assets/images/fontend_logo/logo.png') }}" alt="Vista Logo" style="width: 150px; height: 50px;">
                </div>
              </div>
              <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                <span>Login with Vista</span>
              </h6>
            </div>
            <div class="card-content">
              <div class="card-body">
                <form class="form-horizontal form-simple" method="post" action="{{ route('login') }}" accept-charset="UTF-8">
                  {{ csrf_field() }}
                  <fieldset class="form-group position-relative has-icon-left mb-0">
                    <input type="text" class="form-control form-control-lg input-lg" name="username" id="user-name" placeholder="Your Username" tabindex="1" required data-validation-required-message="Please enter your username.">
                    @if ($errors->has('username'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                    <div class="form-control-position">
                      <i class="ft-user"></i>
                    </div>
                  </fieldset>
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control form-control-lg input-lg" id="password" name="password" placeholder="Enter Password" tabindex="2" required data-validation-required-message="Please enter valid passwords.">
                    @if ($errors->has('password'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div class="form-control-position">
                      <i class="la la-key"></i>
                    </div>
                  </fieldset>
                  <div class="form-group row">
                    <div class="col-md-6 col-12 text-center text-md-left">
                      <fieldset>
                        <input type="checkbox" id="remember-me" class="chk-remember">
                        <label for="remember-me"> Remember Me</label>
                      </fieldset>
                    </div>
                    <div class="col-md-6 col-12 text-center text-md-right"><a href="{{ url('password/reset') }}" class="card-link">Forgot Password?</a></div>
                  </div>
                  <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                </form>
              </div>
            </div>
            <div class="card-footer">
              <div class="">
              <!--  <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>  -->
                <p class="float-sm-right text-center m-0">New to Vista Network? <a href="{{url('register')}}" class="card-link">Sign Up</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
@endsection
