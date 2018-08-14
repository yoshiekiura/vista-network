@extends('home')

@section('style')

@endsection

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">My Tree</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Marketing</a></li>
          <li class="breadcrumb-item active">My Tree
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
      
<!-- radar & chord charts section start -->
<section id="radar-chord-charts">
  <div class="row">
     <!-- Non-ribbon Chord Chart -->
      <div class="col-md-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">My Tree</h4>
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
          <div class="card-content collapse show">
            <div class="card-body">
              <div id="non-ribbon-chord" class="height-400 echart-container"></div>
            </div>
          </div>
        </div>
      </div>

      
  </div>
</section>    
<br/><br/>

@endsection

@section('script')

<script src="{{ URL::asset('app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script> 
<script src="{{ URL::asset('app-assets/vendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('app-assets/js/scripts/charts/echarts/radar-chord/non-ribbon-chord.js') }}"
  type="text/javascript"></script>
<script src="{{ URL::asset('app-assets/js/scripts/extensions/tree-view.js') }}" type="text/javascript"></script>

@endsection