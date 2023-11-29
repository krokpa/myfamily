<div id="wrapper">

  <!-- Sidebar -->
  @include('template.sidebar')
  <!-- End of Sidebar -->
  
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

          @include('template.header')

          @include('includes.flash')

          @yield('content')

      </div>

  </div>
  <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

