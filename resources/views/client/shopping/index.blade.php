@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">Products</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Products</li>
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
  <section id="content-types">
    @foreach($product->chunk(3) as $chunk)
    <div class="row match-height">
      @foreach($chunk as $data)
    <!--  <div class="col-xl-3 col-md-3 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <h4 class="card-title">{{$data->title}}</h4>
              <h6 class="card-subtitle text-muted">Price: <em>{{$general->symbol}}{{$data->price}}</em></h6>
            </div>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                @php $i = 0; @endphp
                @foreach($data->product as $key => $image)
                    <div class="carousel-item @if($key == $i[0]) active @endif">
                        <img src="{{ asset('assets/images/product/'.$image->image) }}" class="d-block w-100" alt="products">
                    </div>
                @php $i++; @endphp
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="la la-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <div class="card-body">
              <p class="card-text">
                <a class="add-to-cart" href="{{route('view.detail', $data->id)}}">View Detail</a>
              </p>
            </div>
          </div>
        </div>
      </div> -->
      <div class="col-xl-4 col-lg-6">
              <div class="card">
                <div class="card-content">
                  <div class="card-body text-center">
                    <p class="text-uppercase">You Are Purchasing</p>
                    <h3 class="text-uppercase">{{$data->title}}</h3>
                    <div class="rating">
                  <!--    <i class="la la-star"></i>
                      <i class="la la-star"></i>
                      <i class="la la-star"></i>
                      <i class="la la-star"></i>
                      <i class="la la-star-half-o"></i> -->
                      Price: {{$general->symbol}}{{$data->price}}
                    </div>
                    @php $i = 0; @endphp
                    @foreach($data->product as $key => $image)
                        <div class="carousel-item @if($key == $i[0]) active @endif">
                            <img src="{{ asset('assets/images/product/'.$image->image) }}" class="img-fluid p-2" alt="products" style="height: 200px;">
                        </div>
                    @php $i++; @endphp
                    @endforeach
                    <a class="add-to-cart" href="{{route('view.detail', $data->id)}}"><button type="button" class="btn btn-success btn-block btn-glow text-uppercase p-1">View Details</button></a>
                  </div>
                </div>
              </div>
            </div>
      @endforeach
    </div>
    @endforeach
    <div class="row justify-content-center align-self-center">
          {{ $product->links() }}    
    </div>  
  </section>
  <!-- Content types section end -->      
</div>
<br/><br/>
@endsection

