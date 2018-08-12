@extends('home')

@section('style')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/wizard.css') }}">

@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Deposit Funds</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Finance</a></li>
          <li class="breadcrumb-item"><a href="{{ route('add.fund.index') }}">Funds Deposit</a></li>
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
                  <h4 class="card-title">Deposit Funds via {{ $gate->name }}</h4>
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
                    <form action="{{ route('fund.deposit.pay') }}" id="form_deposit" method="post" class="steps-validation wizard-notification">
                       {{ csrf_field() }}
                      <!-- Step 1 -->
                      <h6>Step 1</h6>
                      <fieldset>
                        <br/>
                        <div class="row">
                          <div class="col-md-12 text-center">
                              <h3 style="font-weight: 500">Deposit Funds via {{ $gate->name }}</h3>
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
                                      <th>Min Deposit</th>
                                      <td>{{ $general->symbol }}{{ $gate->minamo }}</td>
                                   </tr>
                                   <tr>
                                      <th>Max Deposit</th>
                                      <td>{{ $general->symbol }}{{ $gate->maxamo }}</td>
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
                              <h3 style="font-weight: 500">Deposit Amount</h3>
                              <br/>
                          </div>
                        </div>  
                        <div class="row justify-content-center">  
                            <div class="col-6">
                               
                                <div class="form-group">
                                  <label for="firstName3">
                      
                                  </label>
                                  <input type="text" class="form-control required" id="inputAmountAdd" name="amount" placeholder="Amount to deposit to your balance">
                                  <input type="hidden" name="gateway" id="gateway" value="{{ $gate->id }}">
                                  <input type="hidden" name="minamo" id="minamo" value="{{ $gate->minamo }}">
                                  <input type="hidden" name="maxamo" id="maxamo" value="{{ $gate->maxamo }}">
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
                              <h3 style="font-weight: 500">Deposit Funds Preview</h3>
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
                                      <th>Amount Deposit</th>
                                      <td id="amount_deposit_preview"></td>
                                   </tr>
                                   <tr>
                                      <th>Charges</th>
                                      <td id="total_charges_preview"></td>
                                   </tr>
                                   <tr>
                                      <th>Total Payable Amount</th>
                                      <td class="total_payable_preview"></td>
                                   </tr>
                                   @if ($gate->id == 3 || $gate->id == 6 || $gate->id == 7 || $gate->id == 8)
                                   <tr>
                                      <th>In BTC</th>
                                      <td class="in_btc_preview"></td>
                                   </tr>
                                   @else
                                   @endif
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
                              <h3 style="font-weight: 500">Confirm Payment Details</h3>
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
                                      <th>Deposit Date</th>
                                      <td>Today</td>
                                   </tr>
                                   <tr>
                                      <th>Total Payable Amount</th>
                                      <td class="total_payable_preview"></td>
                                   </tr>
                                   @if ($gate->id == 3 || $gate->id == 6 || $gate->id == 7 || $gate->id == 8)
                                   <tr>
                                      <th>In BTC</th>
                                      <td class="in_btc_preview"></td>
                                   </tr>
                                   @else
                                   @endif
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
<script src="{{ URL::asset('app-assets/js/scripts/forms/wizard-steps.js') }}" type="text/javascript"></script>

@endsection