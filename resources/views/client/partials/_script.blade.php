  <!-- BEGIN VENDOR JS-->
  <script src="{{ URL::asset('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
  <script src="{{ URL::asset('app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script> 
  <script src="{{ URL::asset('app-assets/vendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script> 
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{ URL::asset('app-assets/js/scripts/pages/dashboard-crypto.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/scripts/extensions/sweet-alerts.js') }}" type="text/javascript"></script>
  <script src="{{ URL::asset('app-assets/js/scripts/tables/datatables/datatable-styling.js') }}"
  type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
  @yield('script')