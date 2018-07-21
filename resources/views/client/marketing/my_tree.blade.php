@extends('home')

@section('style')

<link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/jquery.toolbar.css') }}">

@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Binary Tree</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Binary Tree
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

  <!-- Search form-->
  <section id="search-website" class="card overflow-hidden">
    <div class="card-header">
      <h4 class="card-title">Website search results</h4>
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
      <div class="card-body pb-0">
        <form action="{{route('tree.username.search')}}" method="get">
        <div class="row justify-content-center">
          <div class="col-3">
            <fieldset class="form-group position-relative mb-0">
              <input type="text" name="username" class="form-control form-control-xl input-xl" id="iconLeft1" placeholder="USERNAME" required>
              <div class="form-control-position">
                <i class="ft-users font-medium-4"></i>
              </div>
            </fieldset>
          </div>
          <div class="col-3">
              <button type="submit" class="btn btn-info btn-lg btn-block"> SEARCH </button>
          </div>  
        </div>
        </form>
        <div style="margin-top:100px;"></div>
        <?php
          $root = \App\User::where('username', $treefor)->first();
          if($root->paid_status == 0){
              $paid = '<b class="btn btn-warning btn-block">FREE</b>';
          }else{
              $paid = '<b class="btn btn-primary btn-block">PAID</b>';
          }
        ?>
      </div>
      
      <!--Search Result-->
      <div id="search-results" class="card-body">
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <!--==================ROOT==================-->
            <div class="row row justify-content-center">
                <div class="col-6" >
                  <!--  <div class="user" style="text-align: center; margin: auto;"> -->
                    <div data-toolbar="set-03" style="border: 1px solid red;" class="btn-toolbar btn-toolbar-warning mx-auto" data-toolbar-style="warning"> 
                        @if($root->paid_status == 0)
                            <img src="{{asset('assets/user/user.png')}}" alt="**" style="width: 75px; height: 75px;">
                            <br/>
                        @else
                            <img src="{{asset('assets/user/paid_user.png')}}" alt="**" style="width: 75px; height: 75px;">
                            <br/>
                        @endif
                        {{$root->username}}
                     
                    </div> 
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Search form -->
  <div id="set-03-options" class="toolbar-icons hidden">
          <a href="#"><i class="la la-btc"></i></a>
          <a href="#"><i class="la la-eur"></i></a>
          <a href="#"><i class="la la-cny"></i></a>
        </div>      
</div>
<br/><br/>
@endsection

@section('script')

<script src="{{ URL::asset('app-assets/vendors/js/extensions/jquery.toolbar.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('app-assets/js/scripts/extensions/toolbar.js') }}" type="text/javascript"></script>
@endsection