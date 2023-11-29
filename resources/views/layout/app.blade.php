<!DOCTYPE html>
<html lang="en"> 
    
    <head>

        <title>{{ $title ?? config('app.env_all.APP_NAME') }}</title>
        
        <link href="{{ asset('assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <link href="{{ asset('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">

        @section('styles')
            <style>
        
            </style>
        @show

    </head>
  <body id="page-top"> 

    @include('template.default')

    @section('javascripts')
         <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
        <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script>
    @show

</body>


</html>
