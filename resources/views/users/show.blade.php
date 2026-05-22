@extends('layout.layout')
@section('title', "Hodimlar")
@section('content')
    <div class="pagetitle">
        <h1>Hodimlar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users_index') }}">Hodimlar</a></li>
                <li class="breadcrumb-item active">Hodim</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <div class="notes-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="card-title">Hodim haqida</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="font-size: 14px">
                                    <tr>
                                        <th>FIO</th>
                                        <td style="text-align: right">{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telefon raqam</th>
                                        <td style="text-align: right">{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lavozimi</th>
                                        <td style="text-align: right">{{ $user->type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Holati</th>
                                        <td style="text-align: right">
                                            <i class="{{ $user->status ? 'text-success' : 'text-danger' }}">
                                                {{ $user->status ? 'Faol' : 'Faol emas' }}
                                            </i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Oylik ish haqi</th>
                                        <td style="text-align: right">{{ $user->balans }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ishga olindi</th>
                                        <td style="text-align: right">{{ $user->created_at }}</td>
                                    </tr>
                                </table>
                                <button class="btn btn-info text-white my-1 w-100" data-bs-toggle="modal" data-bs-target="#add_payment">Ish haqi to'lash</button>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ route('users_update_status') }}" method="post">
                                        @csrf 
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        @if($user->status)
                                            <button type="submit" class="btn btn-danger my-1 w-100">Hodimni ishdan bo'shatish</button>
                                        @else
                                            <button type="submit" class="btn btn-success my-1 w-100">Hodimni ishga qaytarish</button>
                                        @endif
                                    </form>
                                </div>
                                <div class="col-lg-6">                                        
                                    <form action="{{ route('users_update_password') }}" method="post">
                                        @csrf 
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button class="btn btn-warning text-white my-1 w-100">Parolni yangilash</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="card-title mb-0 pb-3">Taxrirlash</h2>
                            <form action="{{ route('users_update') }}" method="post">
                                @csrf 
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <label for="name" class="mb-2 mt-0">Hodim FIO</label>
                                <input type="text" name="name" required class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                                <label for="phone" class="my-2">Hodim telefon raqami</label>
                                <input type="text" name="phone" required class="form-control phone @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                                <label for="type" class="21">Hodim Lavozimi</label>
                                <select name="type" required class="form-select @error('type') is-invalid @enderror">
                                    <option value="">Tanlang</option>
                                    <option value="drektor" {{ old('type', $user->type) == 'drektor' ? 'selected' : '' }}>Direktor</option>
                                    <option value="operator" {{ old('type', $user->type) == 'operator' ? 'selected' : '' }}>Operator</option>
                                    <option value="currer" {{ old('type', $user->type) == 'currer' ? 'selected' : '' }}>Xaydavchi</option>
                                    <option value="omborchi" {{ old('type', $user->type) == 'omborchi' ? 'selected' : '' }}>Omborchi</option>
                                </select>
                                <label for="balans" class="my-2">Hodim Oylik ish haqi</label>
                                <input type="text" name="balans" required class="form-control amount-mask mb-2 @error('balans') is-invalid @enderror" value="{{ old('balans', $user->balans) }}">
                                <button type="submit" class="btn btn-primary px-5 mt-2 w-100 shadow-sm">O'zgarishlarni saqlash</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="notes-wrapper" style="max-height: 300px; overflow-y: auto; overflow-x: hidden;min-height:300px;">
                    <h2 class="card-title">Ish haqi tarixi</h2>
                    <div class="table-responsive">
                        <table class="table text-center table-bordered table-striped" style="font-size: 14px">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">To'lov summasi</th>
                                    <th scope="col">To'lov turi</th>
                                    <th scope="col">Hodim</th>
                                    <th scope="col">Direktor</th>
                                    <th scope="col">To'lov vaqti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($salary as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->admin->name }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Ish haqi to'lovi mavjud emas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>    

    <div class="modal fade" id="add_payment" tabindex="-1" aria-hidden="true">
        <form action="{{ route('users_salary_store') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Ish haqi to'lash
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <label for="amount" class="mb-2">Ish haqi summasi</label>
                        <input type="text" name="count" required class="form-control amount-mask" value="{{ old('count') }}">
                        <label for="amount_type" class="my-2">To'lov turi</label>
                        <select name="amount_type" required class="form-select">
                            <option value="">Tanlang</option>
                            <option value="cash">Naqt</option>
                            <option value="card">Karta</option>
                            <option value="bank">Bank</option>
                        </select>
                        <label for="description" class="my-2">Hodim Lavozimi</label>
                        <textarea name="description" required class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-danger px-5 shadow-sm">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection