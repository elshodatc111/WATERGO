<!DOCTYPE html>
<html lang="uz">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <div class="container shadow-sm p-4 bg-white rounded">
        <h2>Xush kelibsiz, {{ auth()->user()->name }}!</h2>
        <p>Sizning rolingiz: <strong class="text-uppercase text-danger">{{ auth()->user()->type }}</strong></p>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">Tizimdan chiqish</button>
        </form>
    </div>
</body>
</html>