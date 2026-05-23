@extends('layout.layout')
@section('title', "Ombor")
@section('content')

    <div class="pagetitle">
        <h1>Ombor</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Ombor</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Ombor</h2>
                <table class="table text-center table-bordered">
                    <tr>
                        <td scope="col">Yorliqlar</td>
                        <td scope="col">Qobqog'lar</td>
                        <td scope="col">Tayyor maxsulotlar</td>
                        <td scope="col">Bo'sh idishlar</td>
                        <td scope="col">Nosoz idishlar</td>
                    </tr>
                    <tr>
                        <th scope="col">{{ number_format($ombor['full_label'], 0, '.', ' ') }}</th>
                        <th scope="col">{{ number_format($ombor['full_cover'], 0, '.', ' ') }}</th>
                        <th scope="col">{{ number_format($ombor['full_contaner'], 0, '.', ' ') }}</th>
                        <th scope="col">{{ number_format($ombor['empty_contaner'], 0, '.', ' ') }}</th>
                        <th scope="col">{{ number_format($ombor['defect_contaner'], 0, '.', ' ') }}</th>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-danger mb-2 w-100" data-bs-toggle="modal" data-bs-target="#nosozIdishlar">Nosoz idishlar chiqim</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-primary mb-2 w-100" data-bs-toggle="modal" data-bs-target="#kassaChiqim">Ishlab chiqarish</button>
                    </div>
                </div>
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
                                    <td>{{ number_format($item->count, 0, '.', ' ') }}</td>
                                    <td>{{ $item->type == 'input_cash' ? 'Naqt' : ($item->type == 'input_card' ? 'Plastik' : 'Bank') }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                    <td class="d-flex align-items-center gap-1 text-center justify-content-center">
                                        @if(auth()->user()->type == 'admin' || auth()->user()->type == 'drektor')
                                        <form action="{{ route('omborxona_omborchi_nosoz_chiqim_confirm') }}" method="post" class="m-0">
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
        
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Ishlab chiqarish tarixi (oxirgi 60 kun)</h2>
                <div class="notes-wrapper" style="max-height: 460px; overflow-y: auto; overflow-x: hidden;min-height:460px;">
                    <div class="table-responsive pt-2">
                        <table class="table table-bordered table-striped" style="font-size: 14px">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Ishlab chiqarish soni</th>
                                    <th>Ishlatilgan qopqog'lar</th>
                                    <th>Ishlatilgan yorliqlar</th>
                                    <th>Ishlab chiqarish haqida</th> 
                                    <th>Omborchi</th> 
                                    <th>Ishlab chiqarish vaqti</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($historyOmbor as $item)
                                    <tr class="text-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->contaner }}</td>
                                        <td>{{ $item->cover }}</td>
                                        <td>{{ $item->label }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Ishlab chiqarish mavjud emas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="nosozIdishlar" tabindex="-1" aria-hidden="true">
        <form action="{{ route('omborxona_omborchi_nosoz_chiqim') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Nosoz idishlar chiqim qilish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="count" class="mb-2">Nosoz idishlar soni</label>
                        <input type="text" name="count" required class="form-control  amount-mask" value="{{ old('count') }}">
                        <label for="phone" class="my-2">Chiqim turi</label>
                        <select name="type" required class="form-select">
                            <option value="">Tanlang</option> 
                            <option value="empty_contaner" {{ old('type') == 'empty_contaner' ? 'selected' : '' }}>Bo'sh idishlardan</option>
                            <option value="full_contaner" {{ old('type') == 'full_contaner' ? 'selected' : '' }}>Tayyor maxsulotlardan</option>
                            <option value="defect_contaner" {{ old('type') == 'defect_contaner' ? 'selected' : '' }}>Nosoz idishlardan</option>
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
    <div class="modal fade" id="kassaChiqim" tabindex="-1" aria-hidden="true">
        <form action="{{ route('omborxona_omborchi_ishlabchiqarish') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Ishlab chiqarish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="empty_contaner" class="mb-2">Ishlab chiqarish miqdori (Max: @if ($ombor->full_cover>=$ombor->empty_contaner)
                            {{ $ombor->empty_contaner }}
                        @else
                            {{ $ombor->full_cover }}
                        @endif)</label>
                        <input type="number" max="{{ $ombor->full_cover>=$ombor->empty_contaner ? $ombor->empty_contaner : $ombor->full_cover }}" name="empty_contaner" required class="form-control" value="{{ old('empty_contaner') }}">
                        <label for="full_label" class="my-2">Ishlatilgan yorliqlar miqdori (Max: {{ $ombor->full_label }})</label>
                        <input type="number" max="{{ $ombor->full_label }}" name="full_label" required class="form-control" value="{{ old('full_label') }}">
                        <label for="description" class="my-2">Ishlab chiqarish haqida</label>
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