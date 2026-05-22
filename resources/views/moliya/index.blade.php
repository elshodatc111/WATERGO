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
                        <div class="table-responsive">
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
                        <button class="btn btn-outline-success w-100 mb-2" data-bs-toggle="modal" data-bs-target="#daromad">Balansdan daromad</button>
                        <button class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#xarajat">Balansdan xarajat</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Mavjud yangi maxsulotlar</h2>
                        <div class="table-responsive">
                            <table class="table text-center table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Yangi idishlar</th>
                                        <th scope="col">Reklama qog'ozi</th>
                                        <th scope="col">Qobqog'</th>
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
                        <button class="btn btn-outline-warning w-100 mb-2" data-bs-toggle="modal" data-bs-target="#maxsulotkirim">Maxsulot kirim qilish</button>
                        <button class="btn btn-outline-info w-100" data-bs-toggle="modal" data-bs-target="#maxsulotchiqim">Maxsulot chiqim qilish</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="notes-wrapper" style="max-height: 460px; overflow-y: auto; overflow-x: hidden;min-height:460px;">
                            <h2 class="card-title">Balans tarixi(oxirgi 60 kun)</h2>
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-striped" style="font-size: 14px">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Amaliyot</th>
                                            <th scope="col">Soni/Summa</th>
                                            <th scope="col">Amaliyot haqida</th>
                                            <th scope="col">Hodim</th>
                                            <th scope="col">Direktor</th>
                                            <th scope="col">Amalyot vaqti</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Kirim</td>
                                            <td>25</td>
                                            <td>Yangi idishlar kirim qilindi</td>
                                            <td>John Doe</td>
                                            <td>Jane Smith</td>
                                            <td>2023-10-01 10:00:00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">Amaliyotlar mavjud emas</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="daromad" tabindex="-1" aria-hidden="true">
        <form action="#" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Daromad chiqim qilish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="name" class="mb-2">Yangi hudud nomi</label>
                        <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
                        <label for="description" class="my-2">Hudud tavsifi</label>
                        <textarea name="description" required class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="xarajat" tabindex="-1" aria-hidden="true">
        <form action="#" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Balansdan xarajat qilish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="name" class="mb-2">Yangi hudud nomi</label>
                        <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
                        <label for="description" class="my-2">Hudud tavsifi</label>
                        <textarea name="description" required class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="maxsulotkirim" tabindex="-1" aria-hidden="true">
        <form action="#" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Maxsulot kirim qilish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="name" class="mb-2">Yangi hudud nomi</label>
                        <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
                        <label for="description" class="my-2">Hudud tavsifi</label>
                        <textarea name="description" required class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="maxsulotchiqim" tabindex="-1" aria-hidden="true">
        <form action="#" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Maxsulot chiqim qilish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="name" class="mb-2">Yangi hudud nomi</label>
                        <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
                        <label for="description" class="my-2">Hudud tavsifi</label>
                        <textarea name="description" required class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
     
@endsection