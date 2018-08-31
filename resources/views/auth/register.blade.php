@extends('layouts.app')

@section('content')
<section class="flexbox-container">
  <div class="col-12 d-flex align-items-center justify-content-center">
    <div class="col-md-6 col-12 box-shadow-2 p-0">
      <div class="card border-grey border-lighten-3 m-0"> 
        <div class="card-header border-0 pb-0">
          <div class="card-title text-center">
            <div class="">
                <br/>
                <a href="{{ url('/') }}"><img src="{{ URL::asset('assets/images/fontend_logo/logo.png') }}" alt="Vista Logo" style="width: 150px; height: 50px;"></a>
            </div>    
          </div>
          <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
            <span>Create Account</span>
          </h6>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form method="post" action="{{ route('register') }}" accept-charset="UTF-8">
              {{ csrf_field() }}
              <div class="row">
                
                <div class="col-12 col-sm-6 col-md-6 {{ $errors->has('referrer_id') ? ' has-error' : '' }}">
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control input-lg"
                    placeholder="Referrer Name" tabindex="1" id="ref_name" required autocomplete="off">
                    <div class="form-control-position">
                      <i class="ft-share-2"></i>
                    </div>
                    <div id="ref">

                    </div>
                    @if ($errors->has('referrer_id'))
                        <span class="help-block font-small-3 text-danger">
                        <strong>{{ $errors->first('referrer_id') }}</strong>
                    </span>
                    @endif
                  </fieldset>
                </div>
                
                <div class="col-12 col-sm-6 col-md-6">
                  <fieldset class="form-group position-relative has-icon-left">
                    <select class="form-control" id="position" name="position" required>
                        <option disabled selected>Select Position</option>
                        <option value="L">Left</option>
                        <option value="R">Right</option>
                    </select>
                    <div class="form-control-position">
                      <i class="ft-move"></i>
                    </div> 
                    <div id="ref_pos">

                    </div>
                    @if ($errors->has('position'))
                        <span class="help-block font-small-3 text-danger">
                        <strong>{{ $errors->first('position') }}</strong>
                    </span>
                    @endif
                  </fieldset>
                </div>
                
              </div>
              <div class="row">
                
                <div class="col-12 col-sm-6 col-md-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" required name="first_name" class="form-control input-lg"
                    placeholder="First Name" tabindex="3">
                    <div class="form-control-position">
                      <i class="ft-eye"></i>
                    </div>
                    @if ($errors->has('first_name'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                  </fieldset>
                </div>
                
                <div class="col-12 col-sm-6 col-md-6 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" required name="last_name" class="form-control input-lg"
                    placeholder="Last Name" tabindex="4">
                    <div class="form-control-position">
                      <i class="ft-eye"></i>
                    </div>
                    @if ($errors->has('last_name'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                  </fieldset>
                </div>

              </div>
              
              <div class="row">
                <div class="col-12 col-sm-6 col-md-6 {{ $errors->has('username') ? ' has-error' : '' }}">
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" required name="username" class="form-control input-lg"
                    placeholder="Username" tabindex="5" required data-validation-required-message="Please enter username.">
                    <div class="form-control-position">
                      <i class="la la-user"></i>
                    </div>
                    @if ($errors->has('username'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                    <div class="help-block font-small-3"></div>
                  </fieldset>

                </div>
                <div class="col-12 col-sm-6 col-md-6 {{ $errors->has('bitcoin_wallet') ? ' has-error' : '' }}">

                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" required name="bitcoin_wallet" class="form-control input-lg"
                    placeholder="Bitcoin Wallet Address" tabindex="6" required data-validation-required-message="Please enter bitcoin receiving wallet address.">
                    <div class="form-control-position">
                      <i class="la la-btc"></i>
                    </div>
                    @if ($errors->has('bitcoin_wallet'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('bitcoin_wallet') }}</strong>
                        </span>
                    @endif
                    <div class="help-block font-small-3"></div>
                  </fieldset>

                </div>
                
              </div>    

              <fieldset class="form-group position-relative has-icon-left">
                <input type="email" name="email" required class="form-control input-lg" placeholder="Email Address"
                tabindex="7" required data-validation-required-message="Please enter email address.">
                <div class="form-control-position">
                  <i class="ft-mail"></i>
                </div>
                <div class="help-block font-small-3"></div>
                @if ($errors->has('email'))
                    <span class="help-block font-small-3 text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </fieldset>
              
              <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" name="password" id="password" class="form-control input-lg"
                    placeholder="Password" tabindex="8" required>
                    <div class="form-control-position">
                      <i class="la la-key"></i>
                    </div>
                    <div class="help-block font-small-3"></div>
                    @if ($errors->has('password'))
                        <span class="help-block font-small-3 text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </fieldset>
                </div>

                <div class="col-12 col-sm-6 col-md-6">
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg"
                    placeholder="Confirm Password" tabindex="9" data-validation-matches-match="password"
                    data-validation-matches-message="Password & Confirm Password must be the same.">
                    <div class="form-control-position">
                      <i class="la la-key"></i>
                    </div>
                    <div class="help-block font-small-3"></div>
                  </fieldset>
                </div>
              </div>
              <div class="row mb-1">
                <div class="col-4 col-sm-3 col-md-3">
                  <fieldset>
                    <input type="checkbox" id="remember-me" class="chk-remember" name="agree" value="agree" required>
                    <label for="remember-me"> I Agree</label>
                  </fieldset>
                </div>
                <div class="col-8 col-sm-9 col-md-9">
                  <p class="font-small-3">By clicking Register, you agree to the <a style="color:#1ed81e;" href="{{url('terms')}}"> Terms</a> and<a style="color:#1ed81e;" href="{{url('policy')}}"> Policy</a>.</p>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                  <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-user"></i> Register</button>
                </div>
             <!--   <div class="col-12 col-sm-6 col-md-6">
                  <a href="{{url('login')}}" class="btn btn-danger btn-lg btn-block"><i class="ft-unlock"></i> Login</a>
                </div> -->
              </div>
              <br/>
              <p class="text-center">Already have an account ? <a href="{{ route('login') }}" class="card-link">Login</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('script')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('keyup','#ref_name',function() {
                var ref_id = $('#ref_name').val();
                var token = "{{csrf_token()}}";
                var postion = $('#position').val();

                $.ajax({
                    type: "POST",
                    url:"{{route('get.ref.id')}}",
                    data:{
                        'ref_id': ref_id ,
                        '_token' : token
                    },
                    success:function(data){
                        $("#ref").html(data);
                        if(postion ==null || postion =='L' || postion=='R'){
                            updateHand()
                        }
                    }
                });
            });

            $(document).on('change', '#position', function () {
                    updateHand();
            });
            function updateHand() {
                var pos = $('#position').val();
                var referrer_id = $('#referrer_id').val();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url:"{{route('get.user.position')}}",
                    data:{
                        'pos': pos ,
                        'referrer_id': referrer_id ,
                        '_token' : token
                    },
                    success:function(data){
                        $("#ref_pos").html(data);
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.form').find('input, textarea').on('keyup blur focus', function (e) {

                var $this = $(this),
                    label = $this.prev('label');

                if (e.type === 'keyup') {
                    if ($this.val() === '') {
                        label.removeClass('active highlight');
                    } else {
                        label.addClass('active highlight');
                    }
                } else if (e.type === 'blur') {
                    if( $this.val() === '' ) {
                        label.removeClass('active highlight');
                    } else {
                        label.removeClass('highlight');
                    }
                } else if (e.type === 'focus') {

                    if( $this.val() === '' ) {
                        label.removeClass('highlight');
                    }
                    else if( $this.val() !== '' ) {
                        label.addClass('highlight');
                    }
                }else {
                    label.addClass('active');
                }

            });
            $('.form').find('input, textarea').on('click blur focus', function (e) {

                var $this = $(this),
                    label = $this.prev('label');

                if (e.type === 'keyup') {
                    if ($this.val() === '') {
                        label.removeClass('active highlight');
                    } else {
                        label.addClass('active highlight');
                    }
                } else if (e.type === 'blur') {
                    if( $this.val() === '' ) {
                        label.removeClass('active highlight');
                    } else {
                        label.removeClass('highlight');
                    }
                } else if (e.type === 'focus') {

                    if( $this.val() === '' ) {
                        label.removeClass('highlight');
                    }
                    else if( $this.val() !== '' ) {
                        label.addClass('highlight');
                    }
                }else {
                    label.addClass('active');
                }

            });

            $('.tab a').on('click', function (e) {

                e.preventDefault();

                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');

                target = $(this).attr('href');

                $('.tab-content > div').not(target).hide();

                $(target).fadeIn(600);

            });
        });
    </script>
@endsection