<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Heykodi Simple</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  @stack('css')


  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  @livewireStyles
</head>

<body class="hold-transition sidebar-mini  {{ auth()->user()->sidebar_collapse ? 'sidebar-collapse' : ''}}">
  <div class="wrapper">

    @include('sections.navbar')

    @include('sections.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @include('sections.content-header')

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('sections.control-sidebar')

    @include('sections.footer')
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  @stack('pluginjs')

  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

  @livewireScripts

  @stack('js')
</body>

</html>