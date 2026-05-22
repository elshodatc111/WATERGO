@extends('layout.layout')
@section('title', "Moliya")
@section('content')

    <div class="pagetitle">
        <h1>Moliya</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Moliya</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Balansda mavjud</h2>
                        <table class="table text-center table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Naqt</th>
                                    <th scope="col">Karta</th>
                                    <th scope="col">Bank</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                    <td>{{ $moliya->cash }}</td>
                                    <td>{{ $moliya->card }}</td>
                                    <td>{{ $moliya->bank }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Mavjud yangi maxsulotlar</h2>
                        <table class="table text-center table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Yangi idishlar</th>
                                    <th scope="col">Reklama qog'ozi</th>
                                    <th scope="col">Ish qobqog'i</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                    <td>{{ $moliya->contaner }}</td>
                                    <td>{{ $moliya->cover }}</td>
                                    <td>{{ $moliya->label }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection