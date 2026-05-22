@extends('layout.layout')
@section('title', "Hududlar")
@section('content')

    <div class="pagetitle">
        <h1>Hududlar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Hududlar</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="card-title">Hududlar</h2>
                    </div>
                    <div class="col-lg-6" style="display: flex; justify-content: flex-end; align-items: center;">
                        <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#new_region"> <i class="bi bi-plus-circle"></i> Hudud qo'shish</button>
                    </div>
                </div>
                <div class="table-responsive pt-2">
                    <table class="table table-bordered table-striped" style="font-size: 14px">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Hudud</th>
                                <th>Hudud holati</th>
                                <th>Haydovchilar</th>
                                <th>Hudud ochildi</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($region as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->index+1 }}</td>
                                    <td style="text-align: left;"><a href="{{ route('regions_show', $item['id']) }}" class="text-decoration-none">{{ $item['name'] }}</a></td>
                                    <td>
                                        @if($item['status'] == 1)
                                            <span class="badge role-badge px-3 py-1.5">Faol</span>
                                        @else
                                            <span class="badge role-badge px-3 py-1.5">Faol emas</span>
                                        @endif
                                    </td>
                                    <td><span class="badge role-badge ">{{ $item['currer'] }}</span></td>
                                    <td>{{ $item['created_at']->format('d-m-Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Hududlar mavjud emas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <div class="modal fade" id="new_region" tabindex="-1" aria-hidden="true">
        <form action="{{ route('regions_store') }}" method="post">
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