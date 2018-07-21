<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

@include('client.partials._head')

<body class="horizontal-layout horizontal-menu horizontal-menu-padding 2-columns   menu-expanded"
data-open="click" data-menu="horizontal-menu" data-col="2-columns">

@include('client.partials._fixed-top')

@include('client.partials._top-nav')

<div class="app-content container center-layout mt-2">
    <div class="content-wrapper">
      
      @yield('content')	

    </div>
</div>

@include('client.partials._footer')

@include('client.partials._script')

</body>
</html>      	