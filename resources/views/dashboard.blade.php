@extends('layout.layout')
@section('title', "Dashboard")
@section('content')

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Dashboard</h2>
            </div>
        </div>
    </section>
    
</body>
</html>
@endsection