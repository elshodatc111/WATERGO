@extends('layout.layout')
@section('title', "Hodimlar")
@section('content')

    <div class="pagetitle">
        <h1>Hodimlar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Hodimlar</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h2 class="card-title">Hodimlar</h2>
                    </div>
                    <div class="col-6" style="text-align: right">
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#new_user"><i class="bi bi-plus-circle"></i> Yangi hodim qo'shish</button>
                    </div>
                </div>
                <div class="notes-wrapper" style="max-height: 500px; overflow-y: auto; overflow-x: hidden;height: 500px;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: 14px">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>FIO</th>
                                    <th>Telefon raqam</th>
                                    <th>Lavozimi</th>
                                    <th>Holati</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $loop->index+1 }}</td>
                                        <td>
                                            <a href="{{ route('users_show', $user->id) }}">{{ $user->name }}</a>
                                        </td>
                                        <td class="text-center">{{ $user->phone }}</td>
                                        <td class="text-center">
                                            @if($user->type == 'drektor') 
                                                <span class="badge role-badge px-3 py-1.5">Direktor</span>
                                            @elseif($user->type == 'operator') 
                                                <span class="badge role-badge px-3 py-1.5">Operator</span>
                                            @elseif($user->type == 'currer') 
                                                <span class="badge role-badge px-3 py-1.5">Xaydavchi</span>
                                            @elseif($user->type == 'omborchi') 
                                                <span class="badge role-badge px-3 py-1.5">Omborchi</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <i class="{{ $user->status ? 'text-success' : 'text-danger' }}">
                                                {{ $user->status ? 'Faol' : 'Faol emas' }}
                                            </i>
                                        </td>
                                    </tr>                                       
                                @empty
                                    <tr>
                                        <td colspan="5">Hodimlar mavjud emas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    <div class="modal fade" id="new_user" tabindex="-1" aria-hidden="true">
        <form action="{{ route('users_store') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Yangi hodim qo'shish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="name" class="mb-2">Yangi hodim FIO</label>
                        <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
                        <label for="phone" class="my-2">Hodim telefon raqami</label>
                        <input type="text" name="phone" required class="form-control phone" value="{{ old('phone', '+998') }}">
                        <label for="type" class="my-2">Hodim Lavozimi</label>
                        <select name="type" required class="form-select">
                            <option value="">Tanlang</option>
                            <option value="drektor" {{ old('type') == 'drektor' ? 'selected' : '' }}>Direktor</option>
                            <option value="operator" {{ old('type') == 'operator' ? 'selected' : '' }}>Operator</option>
                            <option value="currer" {{ old('type') == 'currer' ? 'selected' : '' }}>Xaydavchi</option>
                            <option value="omborchi" {{ old('type') == 'omborchi' ? 'selected' : '' }}>Omborchi</option>
                        </select>
                        <label for="balans" class="my-2">Hodim Oylik ish haqi</label>
                        <input type="text" name="balans" required class="form-control amount-mask" value="{{ old('balans', '0') }}">
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