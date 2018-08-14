@extends('home')

@section('style')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/wizard.css') }}">

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
          <li class="breadcrumb-item"><a href="javascript:;">Finance</a></li>
          <li class="breadcrumb-item"><a href="{{ route('add.fund.index') }}">Withdraw Deposit</a></li>
          <li class="breadcrumb-item active">{{ $gate->name }}</li>
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

      <section id="validation">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Withdraw Funds via {{ $gate->name }}</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                    <form action="{{ route('fund.withdraw.pay') }}" id="withdraw_form_money" method="post" class="withdraw_preview_validation wizard-notification">
                       {{ csrf_field() }}
                      <!-- Step 1 -->
                      <h6>Step 1</h6>
                      <fieldset>
                        <br/>
                        <div class="row">
                          <div class="col-md-12 text-center">
                              <h3 style="font-weight: 500">Withdraw Funds via {{ $gate->name }}</h3>
                              <br/>
                          </div>
                        </div>  
                        <div class="row justify-content-center">  
                            <div class="col-6">
                               <table class="table table-bordered">
                                 <tbody>
                                   <tr>
                                      <th style="width: 50%;">Payment Gateway</th>
                                      <td style="width: 50%;">{{ $gate->name }}</td>
                                   </tr>
                                   <tr>
                                      <th>Charges Fix</th>
                                      <td>{{ $general->symbol }}{{ $gate->chargefx }}</td>
                                   </tr>
                                   <tr>
                                      <th>Charges Percentage</th>
                                      <td>{{ $gate->chargepc }} %</td>
                                   </tr>
                                   <tr>
                                      <th>Min Withdraw</th>
                                      <td>{{ $general->symbol }}{{ $gate->min_amo }}</td>
                                   </tr>
                                   <tr>
                                      <th>Max Withdraw</th>
                                      <td>{{ $general->symbol }}{{ $gate->max_amo }}</td>
                                   </tr>
                                   <tr>
                                      <th>Processing Day</th>
                                      <td>{{ $gate->processing_day }}</td>
                                   </tr>
                                  </tbody>  
                               </table> 
                            </div>
                          </div>
                      </fieldset>
                      <!-- Step 2 -->
                      <h6>Step 2</h6>
                      <fieldset>
                        <br/>
                        <div class="row">
                          <div class="col-md-12 text-center">
                              <h3 style="font-weight: 500">Withdraw Amount</h3>
                              <br/>
                          </div>
                        </div>  
                        <div class="row justify-content-center">  
                            <div class="col-6">
                               
                                <div class="form-group">
                                  <label for="firstName3">
                      
                                  </label>
                                  <input type="text" name="withdraw_amount" id="withdraw_amount" class="form-control" placeholder="Enter amount you want to withdraw" required>
                                  <input type="hidden" name="withdraw_gateway" id="withdraw_gateway" value="{{ $gate->id }}">
                                  <input type="hidden" name="withdraw_charges" id="withdraw_charges" value="">
                                  <input type="hidden" name="withdraw_total_amount" id="withdraw_total_amount" value="">

                                </div>
                            </div>
                        </div>      
                      </fieldset>
                      <!-- Step 3 -->
                      <h6>Step 3</h6>
                      <fieldset>
                        <br/>
                        <div class="row">
                          <div class="col-md-12 text-center">
                              <h3 style="font-weight: 500">Withdraw Funds Preview</h3>
                              <br/>
                          </div>
                        </div>  
                        <div class="row justify-content-center">  
                            <div class="col-6">
                               <table class="table table-bordered">
                                 <tbody>
                                   <tr>
                                      <th style="width: 50%;">Payment Gateway</th>
                                      <td style="width: 50%;">
                                        {{ $gate->name }}
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>Amount</th>
                                      <td id="amount_withdraw_preview"></td>
                                   </tr>
                                   <tr>
                                      <th>Charges</th>
                                      <td id="total_withdraw_charges_preview"></td>
                                   </tr>
                                   <tr>
                                      <th>Total Amount</th>
                                      <td class="total_withdraw_preview"></td>
                                   </tr>
                                  </tbody>  
                               </table> 
                            </div>
                          </div>
                      </fieldset>
                      <h6>Step 4</h6>
                      <fieldset>
                        <br/>
                        <div class="row">
                          <div class="col-md-12 text-center">
                              <h3 style="font-weight: 500">Confirm Withdraw Details</h3>
                              <br/>
                          </div>
                        </div>  
                        <div class="row justify-content-center">  
                            <div class="col-6">                 
                                <input type="hidden" name="trx_preview" id="trx_preview" value="">
                                <table class="table table-bordered">
                                 <tbody>
                                   <tr>
                                      <th style="width: 50%;">Payment Gateway</th>
                                      <td style="width: 50%;">
                                        {{ $gate->name }}
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>Payee Name</th>
                                      <td>{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}</td>
                                   </tr>
                                   <tr>
                                      <th>Withdraw Date</th>
                                      <td>Today</td>
                                   </tr>
                                   <tr>
                                      <th>Total Amount</th>
                                      <td class="total_withdraw_preview"></td>
                                   </tr>
                                  </tbody>  
                               </table>
                            </div>
                          </div>
                      </fieldset>
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

@section('script')

<script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"
  type="text/javascript"></script>
<script src="{{ URL::asset('app-assets/vendors/js/extensions/jquery.steps.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('app-assets/js/scripts/forms/wizard-withdraw-funds-steps.js') }}" type="text/javascript"></script>

@endsection