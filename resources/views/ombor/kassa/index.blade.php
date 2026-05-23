@extends('layout.layout')
@section('title', "Kassa")
@section('content')

    <div class="pagetitle">
        <h1>Kassa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Kassa</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h2 class="card-title">Kassa</h2>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#kassaChiqim">Kassadan chiqim</button>
                    </div>
                </div>
                <table class="table text-center table-bordered">
                    <tr>
                        <td scope="col">Naqt summa</td>
                        <td scope="col">Plastik summa</td>
                        <td scope="col">Bank summa</td>
                    </tr>
                    <tr>
                        <th scope="col">{{ number_format($ombor['cash'], 0, '.', ' ') }} UZS</th>
                        <th scope="col">{{ number_format($ombor['card'], 0, '.', ' ') }} UZS</th>
                        <th scope="col">{{ number_format($ombor['bank'], 0, '.', ' ') }} UZS</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Tasdiqlanmagan chiqimlar</h2>
                <div class="table-responsive pt-2">
                    <table class="table table-bordered table-striped" style="font-size: 14px">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Chiqim summasi</th>
                                <th>Chiqim turi</th>
                                <th>Chiqim haqida</th>
                                <th>Omborchi</th> 
                                <th>Chiqim vaqti</th> 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ number_format($item->count, 0, '.', ' ') }} UZS</td>
                                    <td>{{ $item->type == 'input_cash' ? 'Naqt' : ($item->type == 'input_card' ? 'Plastik' : 'Bank') }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                    <td class="d-flex align-items-center gap-1 text-center justify-content-center">
                                        <form action="{{ route('omborxona_kassa_chiqim_cancel') }}" method="post" class="m-0">
                                            @csrf
                                            <input type="hidden" name="history_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                        </form>
                                        @if(auth()->user()->type == 'admin' || auth()->user()->type == 'drektor')
                                        <form action="{{ route('omborxona_kassa_chiqim_confirm') }}" method="post" class="m-0">
                                            @csrf
                                            <input type="hidden" name="history_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-success p-0 px-1"><i class="bi bi-check"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tasdiqlanmagan chiqimlar mavjud emas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="kassaChiqim" tabindex="-1" aria-hidden="true">
        <form action="{{ route('omborxona_kassa_chiqim') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Kassadan chiqim
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="count" class="mb-2">Chiqim summasi</label>
                        <input type="text" name="count" required class="form-control  amount-mask" value="{{ old('count') }}">
                        <label for="phone" class="my-2">Chiqim turi</label>
                        <select name="type" required class="form-select">
                            <option value="">Tanlang</option>
                            <option value="cash" {{ old('type') == 'cash' ? 'selected' : '' }}>Naqt</option>
                            <option value="card" {{ old('type') == 'card' ? 'selected' : '' }}>Plastik</option>
                            <option value="bank" {{ old('type') == 'bank' ? 'selected' : '' }}>Bank</option>
                        </select>
                        <label for="description" class="my-2">Chiqim haqida</label>
                        <textarea name="description" required class="form-control" value="{{ old('description') }}"></textarea>
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