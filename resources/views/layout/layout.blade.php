<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="{{ asset('assets/img/logo1.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo1.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="https://atkopanel.uz/umka/public/assets/css/style.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-center text-center">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center text-center">
                <h3 style="font-weight: 900">WaterGo</h3> 
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        @include('layout.header')
    </header>

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @include('layout.menu')
        </ul>
    </aside>

    <main id="main" class="main">
        @yield('content')
    </main>
    
    <footer id="footer" class="footer">
        @include('layout.footer')
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="https://atkopanel.uz/umka/public/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/vendor/echarts/echarts.min.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/vendor/quill/quill.min.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/vendor/php-email-form/validate.js"></script>
    <script src="https://atkopanel.uz/umka/public/assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        $(".phone").inputmask("+998 99 999 9999");
    </script>
</body>

</html>