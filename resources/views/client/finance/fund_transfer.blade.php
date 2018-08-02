@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Funds Transfer</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Funds Transfer
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

  <!-- Shopping cards section start -->
  <section id="shopping-cards">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body p-0">
              <div class="row">
              <!--  <div class="col-xl-12 col-md-12 p-2 pl-3"> -->
                  <div class="col-12 col-xl-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Transfer Funds</h4>
                        <div class="heading-elements">
                          <h6 class="danger">Fee: 3%</h6>
                        </div>
                      </div>
                      <div class="card-content">
                        <div class="card-body overflow-hidden row">                              
                          <div class="col-md-9 col-sm-12">
                            <div class="row match-height">
                              <div class="col-xl-12 col-md-12 col-12">

                                <div class="card bg-default border-lighten-2" style="border: 1px solid #98A488;">
                                  
                                  <div class="card-body">                
                                    <form action="{{ route('store.transfer.fund') }}" method="post">
                                    {{csrf_field()}}
                                      <div class="form-body">
                                        <div class="form-group">
                                          <label for="timesheetinput1">Beneficiary Username</label>
                                          <div class="position-relative has-icon-left">
                                            <input class="form-control" placeholder="Enter Username of Beneficiary" id="refname" type="text" required>
                                            <div class="form-control-position">
                                              <i class="ft-user"></i>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="timesheetinput2"></label>
                                            <div id="resu"></div>
                                        </div>
                                      
                                        <div class="form-group">
                                          <label>Amount</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">$</span>
                                            </div>
                                            <input class="form-control" placeholder="AMOUNT YOU WANT TO TRANSFER" name="amount" type="text" id="inputAmount" required>
                                            <div class="input-group-append">
                                              <span class="input-group-text">USD</span>
                                            </div>
                                          </div>
                                        </div>
                      
                                        <button type="submit" class="btn btn-primary">
                                          <i class="la la-check-square-o"></i> Transfer Now
                                        </button>
                                      </div>
                                    </form>    
                                  </div>
                              
                                </div>
       
                              </div>
                        
                            </div>  
                        
                          </div>
                          
                          <div class="col-md-3 col-sm-12">
                            <div class="media-list list-group">
                                <a href="#" class="list-group-item list-group-item-action media">
                                  <div class="media-left">
                                    <h4><b style="font-weight: 500;">Important Info</b></h4>
                                  </div>
                                  <div class="media-body">
                                  <!--  <h5 class="list-group-item-heading">Commission</h5> -->
                                    <br/>
                                    <br/>
                                    <span class="list-group-item-text">
                                      Share your Balance with other users.<br/><br/>
                                      Shared Balance will added to user's Account Balance.<br/><br/>
                                      Minimum 1 {{$general->currency}} Can be Transferred.<br/></br>
                                      <spam class="text-danger">3% Transfer Charge</spam> will Applied and transferred Fund will go to Secondary Balance.
                                    </span>
                                  </div>
                                </a>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                
            <!--    </div> -->
              </div>
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

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('input','#refname',function() {
                var search_name = $('#refname').val();
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url:"{{route('get.user')}}",
                    data:{
                        'name': search_name ,
                        '_token' : token
                    },
                    success:function(data){
//                      console.log(data);
                        $("#resu").html(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('keyup','#inputAmount',function() {
                var inputAmount = parseFloat($('#inputAmount').val());
                var token = "{{csrf_token()}}";

                $.ajax({
                    type: "POST",
                    url:"{{route('get.total.charge')}}",
                    data:{
                        'inputAmount': inputAmount ,
                        '_token' : token
                    },
                    success:function(data){
//                        console.log(data);
                        $("#showMessage").html(data);

                    }
                });

                $('#inputAmount').keyup(function(event){
                    var regex = /[0-9]|\./;
                    var text = $('#inputAmount').val();

                    if( !(regex.test(text))) {
                        $("#showMessage").html("<span style='color: red'>Invalid Amount</span>");
                    }
                });
            });
        });
    </script>
@endsection