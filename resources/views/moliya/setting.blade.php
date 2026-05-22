@extends('layout.layout')
@section('title', "Narxlar")
@section('content')

    <div class="pagetitle">
        <h1>Narxlar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Narxlar</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Narxlar</h2>
                        <form action="{{ route('moliya_settings_update') }}" method="POST">
                            @csrf 
                            <div class="mb-3">
                                <label for="price_contaner" class="form-label">Bo'sh idish narxi</label>
                                <input type="text" name="price_contaner" class="form-control amount-mask" id="price_contaner" value="{{ $moliya->price_contaner ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="price_water" class="form-label">Suv narxi</label>
                                <input type="text" name="price_water" class="form-control amount-mask" id="price_water" value="{{ $moliya->price_water ?? '' }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Saqlash</button>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection