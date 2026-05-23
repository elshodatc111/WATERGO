@extends('layout.layout')
@section('title', "Xaydavchilar")
@section('content')

    <div class="pagetitle">
        <h1>Xaydavchilar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Xaydavchilar</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="card-title">Xaydovchilar</h2>
                    </div>
                    <div class="col-lg-6" style="text-align: right">
                        <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#xaydovchigaChiqim">Xaydovchiga chiqim</button>
                    </div>
                </div>
                <div class="table-responsive pt-2">
                    <table class="table table-bordered table-striped" style="font-size: 14px">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Xaydovchilar</th>
                                <th>Naqt summa</th>
                                <th>Karta summa</th>
                                <th>Bank summa</th> 
                                <th>Tayyor maxsulotlar</th> 
                                <th>Bosh idishlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($currer as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->index+1 }}</td>
                                    <td style="text-align: left"><a href="{{ route('users_show',$item->user_id) }}">{{ $item->user->name }}</a></td>
                                    <td>{{ number_format($item->cash, 0, '.', ' ') }} UZS</td>
                                    <td>{{ number_format($item->card, 0, '.', ' ') }} UZS</td>
                                    <td>{{ number_format($item->bank, 0, '.', ' ') }} UZS</td>
                                    <td>{{ number_format($item->full_contaner, 0, '.', ' ') }}</td>
                                    <td>{{ number_format($item->empty_contaner, 0, '.', ' ') }}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Ma'lumot mavjud emas</td>   
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{{ number_format($res['cash'], 0, '.', ' ') }} UZS</th>
                                <th>{{ number_format($res['card'], 0, '.', ' ') }} UZS</th>
                                <th>{{ number_format($res['bank'], 0, '.', ' ') }} UZS</th> 
                                <th>{{ number_format($res['full_contaner'], 0, '.', ' ') }}</th> 
                                <th>{{ number_format($res['empty_contaner'], 0, '.', ' ') }}</th> 
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Amaliyotlar tarixi</h2>
                <div class="table-responsive pt-2">
                    <table class="table table-bordered table-striped" style="font-size: 14px">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Xaydovchilar</th>
                                <th>Amaliyot</th>
                                <th>Summa/Soni</th>
                                <th>Amaliyot haqida</th> 
                                <th>Amaliyot holati</th> 
                                <th>Amaluyot vaqti</th> 
                                <th>Omborchi</th> 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($currerHistory as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->index+1 }}</td>
                                    <td>{{ $item->currer->name }}</td>
                                    <td class="text-center">
                                        @if($item->type=='out_full_contaner')
                                            Ombordan chiqim
                                        @else
                                            {{ $item->type }}</td>
                                        @endif
                                    <td class="text-center">{{ $item->count }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td class="text-center">
                                        @if(!$item->status)
                                            <span class="text-warning">Kutilmoqda</span>
                                        @else
                                            <span class="text-success">Tasdiqlandi</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->created_at->format("Y-m-d H:i") }}</td>
                                    <td class="text-center">
                                        @if($item->user_id) 
                                            {{ $item->omborchi->name }} 
                                        @else 
                                            - 
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(!$item->status)
                                            @if($item->type=='out_full_contaner')
                                                <form action="{{ route('omborxona_currerga_chiqim_cancel') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('omborxona_currerga_chiqim_success') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button class="btn btn-success p-0 px-1"><i class="bi bi-check"></i></button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan=9 class="text-center">Amaliyotlar mavjud emas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="xaydovchigaChiqim" tabindex="-1" aria-hidden="true">
        <form action="{{ route('omborxona_currerga_chiqim') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Xaydovchiga chiqim
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <label for="currer_id" class="mb-2">Xaydovchini tanlang</label>
                        <select name="currer_id" required class="form-select">
                            <option value="">Tanlang</option>
                            @foreach($currer as $item)
                                <option value="{{ $item['user_id'] }}">{{ $item->user->name }}</option>
                            @endforeach
                        </select>
                        <label for="count" class="my-2">Chiqim uchun tayyor maxsulotlar soni. (Max: {{ $ombor->full_contaner }})</label>
                        <input type="number" name="count" required class="form-control" max="{{ $ombor->full_contaner }}" value="{{ old('count') }}">
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