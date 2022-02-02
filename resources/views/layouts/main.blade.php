<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('style/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('style/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('style/assets/css/components.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('layouts.header')
      
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
            @yield('breadcrumbs')
            
          @yield('content')
        </section>
      </div>
      @include('layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('style/assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('style/assets/modules/popper.js')}}"></script>
  <script src="{{asset('style/assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('style/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('style/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('style/assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('style/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{asset('style/assets/js/scripts.js')}}"></script>
  <script src="{{asset('style/assets/js/custom.js')}}"></script>
</body>
</html>