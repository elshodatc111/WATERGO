@extends('layout.layout')
@section('title', "Hudud")
@section('content')

    <div class="pagetitle">
        <h1>Hudud</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('regions_index') }}">Hududlar</a></li>
                <li class="breadcrumb-item active">Hudud</li>
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