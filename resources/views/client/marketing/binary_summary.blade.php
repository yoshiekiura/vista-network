@extends('home')

@section('style')
    <style>
        /*Now the CSS*/
        div,ul,li {margin: 0; padding: 0;}

        .tree ul
        {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
        }

        .tree li
        {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }
        .tree li::before, .tree li::after
        {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%; height: 20px;
        }
        .tree li::after
        {
            right: auto; left: 50%;
            border-left: 1px solid #ccc;
        }
        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }
        .tree li:only-child{ padding-top: 0;}
        .tree li:first-child::before, .tree li:last-child::after{
            border: 0 none;
        }
        .tree li:last-child::before{
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }
        .tree li:first-child::after{
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        /*Time to add downward connectors from parents*/
        .tree ul ul::before{
            content: '';
            position: absolute; top: 0; left: 50%;
            border-left: 1px solid #ccc;
            width: 0; height: 20px;
        }

        .tree li a{
            border: 1px solid #ccc;
            padding: 2px 80px;
            text-decoration: none;
            color: #666;
            font-family: verdana, tahoma;
            font-size: 20px;
            display: inline-block;
            border-radius: 5px;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }
        .tree li a:hover, .tree li a:hover+ul li a {
            background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
        }
        /*Connector styles on hover*/
        .tree li a:hover+ul li::after,
        .tree li a:hover+ul li::before,
        .tree li a:hover+ul::before,
        .tree li a:hover+ul ul::before{
            border-color:  #94a0b4;
        }

    </style>

@endsection
@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Binary Summary</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
          </li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Binary Summary
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
      <h4 class="card-title">Binary Summary</h4>
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
        <div class="row justify-content-center">
            <div class="col-9">
              <div class="card border-primary border-3 text-center"> 
                <div class="card-header">
                  <h1 class="primary text-bold-600">Your Current BV</h1>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul> 
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                     <div class="tree d-flex justify-content-center">
                        <ul>
                            <li>
                                <a href="#">{{Auth::user()->username}}</a>
                                <ul>
                                    <li>
                                        <a href="#"><b>LEFT SIDE</b> :{{$cbv->left_bv}}</a>
                                    </li>
                                    <li>
                                        <a href="#"><b>RIGHT SIDE</b> :{{$cbv->right_bv}}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  
      </div>

      <div class="card-body pb-0">
        <div class="row justify-content-center">
            <div class="col-9">
              <div class="card border-primary border-3 text-center"> 
                <div class="card-header">
                  <h1 class="primary text-bold-600">PAID Member On Your Tree</h1>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul> 
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                     <div class="tree d-flex justify-content-center">
                          <ul>
                              <li>
                                  <a href="#">{{Auth::user()->username}}</a>
                                  <ul>
                                      <li>
                                          <a href="#"><b>LEFT SIDE</b> :{{$cbv->left_paid}}</a>
                                      </li>
                                      <li>
                                          <a href="#"><b>RIGHT SIDE</b> :{{$cbv->right_paid}}</a>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  
      </div>

      <div class="card-body pb-0">
        <div class="row justify-content-center">
            <div class="col-9">
              <div class="card border-primary border-3 text-center"> 
                <div class="card-header">
                  <h1 class="primary text-bold-600">FREE Member On Your Tree</h1>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul> 
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                     <div class="tree d-flex justify-content-center">
                          <ul>
                              <li>
                                  <a href="#">{{Auth::user()->username}}</a>
                                  <ul>
                                      <li>
                                          <a href="#"><b>LEFT SIDE</b> :{{$cbv->left_free}}</a>
                                      </li>
                                      <li>
                                          <a href="#"><b>RIGHT SIDE</b> :{{$cbv->right_free}}</a>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  
      </div>

    </div>
  </section>
      
</div>
<br/><br/>
@endsection

