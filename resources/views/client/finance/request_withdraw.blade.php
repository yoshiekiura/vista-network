@extends('home')

@section('style')
  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

      $(document).ready(function() {
 
          $( '.withdraw_fund' ).on( 'submit', function(e) {
           
              $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            
              e.preventDefault();

              var form = $(this);
        
              $.ajax({
                    url: '/withdraw/preview',
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(), 
                    success: function( result ) {
                        if(result.success == false){
                        //  $("#buyModal"+id).modal('hide');
                          swal("Alert!", "There is something wrong!", "warning");  
                        }
                        else{  
                        //  swal("success!", "Withdraw Success!", "success");
                          $("#preview").modal('show');
                          $("#preview_data").html(result.html);
                          $("#buyModal"+result.success).modal('hide');
                        }
                    },
                    error: function (data) {
                        //  $("#buyModal"+id).modal('hide');
                          swal("Error!", "Transaction not complete!", "error");
                    }
              });
          });

      });

  </script>    

@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Withdraw Funds</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Withdraw Funds
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

  <!-- Content types section start -->
  <section id="shopping-cards">
    
    <div class="row match-height">
      @foreach($gates as $gate)
      
      <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <h4 class="card-title">{{ $gate->name }}</h4>
              <img class="img-fluid my-1" src="{{ asset('assets/images/withdraw') }}/{{ $gate->image }}" alt="Payment Gateway">
            </div>
            <div class="card-footer text-muted">
              <button class="btn btn-info btn-min-width btn-glow btn-block mr-1 mb-1" type="button" data-toggle="modal" data-target="#buyModal{{$gate->id}}">Select {{ $gate->name }}</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade text-left" id="buyModal{{$gate->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel9"
      aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info white">
              <h4 class="modal-title white" id="myModalLabel9"><i class="la la-tree"></i> Withdraw Funds via {{ $gate->name }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <form method="POST" class="withdraw_fund">
            <div class="modal-body">
              <h5><i class="la la-angle-double-right"></i> <b>Fee:</b> <span class="text-danger">{{ $gate->chargefx }}{{ $general->symbol }} and {{ $gate->chargepc }}%</span></h5>
              <h5><i class="la la-angle-double-right"></i> <b>Processing Days:</b> {{$gate->processing_day}} days</h5>
              <h5><i class="la la-angle-double-right"></i> <b>Minimum Amount:</b> 10{{ $general->symbol }}</h5>
              <p>
                <input type="hidden" name="gateway" class="gateway" value="{{ $gate->id }}">
                <fieldset>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">{{ $general->symbol }}</span>
                    </div>
                    <input type="text" name="amount" id="amount" class="form-control amount" placeholder="Enter amount you want to withdraw | Minimum {{$gate->min_amo}} {{$general->currency}}" aria-describedby="basic-addon1" required>
                  </div>
                </fieldset>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-outline-success">Preview Request</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      @endforeach
    </div>
      
  </section>
  <!-- Content types section end -->      
</div>
<br/><br/>
<!-- Modal -->
<div class="modal fade text-left" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel9"
aria-hidden="true">
  <div class="modal-dialog" role="document">
  <!--  <meta name="csrf-token" content="{{ csrf_token() }}" /> --> 
    <form action="{{route('confirm.withdraw.store')}}" method="post">
    {{csrf_field()}}  
    <div class="modal-content">
      <div class="modal-header bg-info white">
        <h4 class="modal-title white" id="myModalLabel9"><i class="la la-tree"></i> Withdraw Preview</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="preview_data">
          </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cancel</button> 
        <button type="submit" name="submit" class="btn btn-outline-success">Confirm Withdraw</button> 
      </div>
    </div>
    </form> 
  </div>
</div>
@endsection

