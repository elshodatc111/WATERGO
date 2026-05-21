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
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Hudud tafsilotlari</h2>
                        <div class="table-responsive pt-2">
                            <table class="table table-bordered table-striped" style="font-size: 14px">
                                <tbody>
                                    <tr>
                                        <th>Hudud nomi</th>
                                        <td style="text-align: right">{{ $region['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hudud holati</th>
                                        <td style="text-align: right">{{ $region['status'] ? 'Faol' : 'Faol emas' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hodimlar soni</th>
                                        <td style="text-align: right">{{ $region['currer'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hudud haqida</th>
                                        <td style="text-align: right">{{ $region['description'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Admin</th>
                                        <td style="text-align: right">{{ $region['admin'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hudud ochildi</th>
                                        <td style="text-align: right">{{ $region['created_at']->format('d-m-Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#edit_region"> <i class="bi bi-pencil-square"></i> Hududni tahrirlash</button>
                        <button class="btn btn-info w-100 text-white my-2" data-bs-toggle="modal" data-bs-target="#add_driver"> <i class="bi bi-plus-circle"></i> Haydovchi qo'shish</button>
                        <form action="{{ route('regions_update_status') }}" method="POST" class="w-100">
                            @csrf
                            <input type="hidden" name="region_id" value="{{ $region['id'] }}">
                            @if ($region['status'] == 1)
                                <button type="submit" class="btn btn-danger w-100"> <i class="bi bi-trash"></i> Hududni faolsizlantirish</button>                                
                            @else
                                <button type="submit" class="btn btn-success w-100"> <i class="bi bi-check-circle"></i> Hududni faol qilish</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8"> 
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Hudud haydovchilari</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" style="font-size: 14px">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Haydovchi</th>
                                        <th class="text-center">Holati</th>
                                        <th class="text-center">Qo'shilgan vaqti</th>
                                        <th class="text-center">Hududdan o'chirish</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($currer as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->index+1 }}</td>
                                            <td><a href="{{ route('users_show', $item->user->id) }}" class="text-decoration-none">{{ $item->user->name }}</a></td>
                                            <td class="text-center">{{ $item->status ? 'Faol' : 'Faol emas' }}</td>
                                            <td class="text-center">{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                            <td class="text-center">
                                                @if ($item->status)
                                                    <form action="{{ route('regions_trash_currer') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="region_id" value="{{ $region['id'] }}">
                                                        <input type="hidden" name="user_id" value="{{ $item->user->id }}">
                                                        <button type="submit" class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                                    </form>    
                                                @else
                                                    {{ $item->updated_at->format('d-m-Y H:i') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Bu hududga haydovchi tayinlanmagan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="edit_region" tabindex="-1" aria-hidden="true">
        <form action="{{ route('regions_update') }}" method="post">
            @csrf  
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-pencil-square me-2"></i> Hududni tahrirlash
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="id" value="{{ $region['id'] }}">
                        <label for="name" class="mb-2">Hudud nomi</label>
                        <input type="text" name="name" required class="form-control" value="{{ $region['name'] }}">
                        <label for="description" class="my-2">Hudud tavsifi</label>
                        <textarea name="description" required class="form-control" rows="4">{{ $region['description'] }}</textarea>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="add_driver" tabindex="-1" aria-hidden="true">
        <form action="{{ route('regions_add_currer') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Yangi hudud qo'shish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="region_id" value="{{ $region['id'] }}">
                        <label for="name" class="mb-2">Haydovchini tanlang</label>
                        <select name="user_id" required class="form-select">
                            <option value="">Tanlang...</option>
                            @foreach ($new_currer as $item)
                                <option value="{{ $item['currer_id'] }}">{{ $item['currer'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Xaydovchini qo'shish</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>
@endsection