<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Tizimga kirish</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                            <input type="text" name="phone" class="form-control" placeholder="998901234567" value="{{ old('phone') }}" required>
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

</body>
</html>