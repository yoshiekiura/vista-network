@extends('home')

@section('style')
  <script src="{{ asset('app-assets/js/core/libraries/jquery.min.js') }}" ></script>
  <script>

  /*    $(document).ready(function() {
 
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

      });  */

  </script>    

@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Withdraw Funds</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Income</a></li>
          <li class="breadcrumb-item active">Withdraw Funds</li>
        </ol>
      </div>
    </div>
  </div>
</div>

@if (Session::has('message'))
  <div class="alert bg-success alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> {{ Session::get('message') }}
  </div>
@endif

@if (Session::has('alert'))
  <div class="alert bg-warning alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Warning!</strong> {{ Session::get('alert') }}
  </div>
@endif

@if (Session::has('success'))
  <div class="alert bg-success alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> {{ Session::get('success') }}
  </div>
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
              <a href="{{ route('fund.withdraw.preview', ['id' => $gate->id]) }}">
                <button class="btn btn-info btn-min-width btn-glow btn-block mr-1 mb-1" type="button" data-toggle="modal" data-target="#buyModal{{$gate->id}}">Select {{ $gate->name }}</button>
              </a>
            </div>
          </div>
        </div>
      </div>

      @endforeach
    </div>
      
  </section>
  <!-- Content types section end -->      
</div>
<br/><br/>

@endsection

