<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>WaterGo</title>
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
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Tizimga Kirish</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger p-2 small">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Telefon raqam</label>
                                <input type="text" name="phone" class="form-control phone" value="{{ old('phone')??"+998" }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Parol</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Eslab qolish</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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