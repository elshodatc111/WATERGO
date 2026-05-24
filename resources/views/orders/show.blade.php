@extends('layout.layout')
@section('title', "Buyurtma")
@section('content')

    <div class="pagetitle">
        <h1>Buyurtma</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orders_index') }}">Buyurtmalar</a></li>
                <li class="breadcrumb-item active">Buyurtma</li>
            </ol>
        </nav>
    </div>

    <section class="section order">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Buyurtma</h2>
                        <table class="table table-bordered" style="font-size: 14px">
                            <tr>
                                <th>Hudud:</th>
                                <td style="text-align:right">{{ $order->region->name }}</td>
                            </tr>
                            <tr>
                                <th>Buyurtma soni:</th>
                                <td style="text-align:right">{{ $order->order_count }}</td>
                            </tr>
                            <tr>
                                <th>Telefon raqam:</th>
                                <td style="text-align:right">{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <th>Manzil:</th>
                                <td style="text-align:right">{{ $order->address }}</td>
                            </tr>
                            <tr>
                                <th>Buyurtma holati:</th>
                                <td style="text-align:right">
                                    @if($order->status == 'new')
                                        <span class="badge bg-secondary">Yangi</span>
                                    @elseif($order->status == 'pending')
                                        <span class="badge bg-primary">Qabul qilingan</span>
                                    @elseif($order->status == 'success')
                                        <span class="badge bg-success">Yetqazilgan</span>
                                    @elseif($order->status == 'cancel')
                                        <span class="badge bg-danger">Bekor qilingan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Buyurtma vaqt:</th>
                                <td style="text-align:right">{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Operator:</th>
                                <td style="text-align:right">{{ $order->operator->name }}</td>
                            </tr>
                        </table>
                        @if($order->status=='new' || $order->status=='pending')
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#updateOrder"><i class="bi bi-trash"></i> Buyurtmani taxrirlash</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Xaydovchi</h2>
                        <table class="table table-bordered" style="font-size: 14px">
                            <tr>
                                <th>Xaydovchi:</th>
                                <td style="text-align:right">{{ $order->currer_id?$order->currer->name:"Xaydovchi yo'q"}}</td>
                            </tr>
                            <tr>
                                <th>Naqt to'lov:</th>
                                <td style="text-align:right">{{ number_format($order['cash'], 0, '.', ' ') }} UZS</td>
                            </tr>
                            <tr>
                                <th>Karta to'lov:</th>
                                <td style="text-align:right">{{ number_format($order['card'], 0, '.', ' ') }} UZS</td>
                            </tr>
                            <tr>
                                <th>Bank to'lov:</th>
                                <td style="text-align:right">{{ number_format($order['bank'], 0, '.', ' ') }} UZS</td>
                            </tr>
                            <tr>
                                <th>Yetqazilgan buyurtma:</th>
                                <td style="text-align:right">{{ $order->full_contaner }}</td>
                            </tr>
                            <tr>
                                <th>Qabul qilingan bo'sh idish:</th>
                                <td style="text-align:right">{{ $order->empty_contaner }}</td>
                            </tr>
                            <tr>
                                <th>Buyurtma haqida:</th>
                                <td style="text-align:right">{{ $order->description }}</td>
                            </tr>
                        </table>
                        @if($order->status=='new' || $order->status=='pending')
                            <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#orderCancel"><i class="bi bi-trash"></i> Buyurtmani bekor qilish</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body">
                        <h2 class="card-title">Buyurtma chat</h2>
                        <div class="table-responsive rounded-2 border mb-4" style="height: 240px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0" style="font-size: 14px;">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Xabar / Izoh</th>
                                        <th>Xabar vaqti</th>
                                        <th>Xodim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($chat as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->message }}</td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td>{{ $item->user->name }}</td>
                                        </tr>   
                                    @empty
                                         <tr>
                                            <td colspan="4" class="text-center">Xabarlar mavjud emas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <hr class="text-muted my-2">
                        <form action="{{ route('order_store_chat') }}" method="POST" class="bg-light py-1 px-1 rounded-3 border">
                            @csrf 
                            <div class="row g-3">
                                <div class="col-md-6 col-12">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="text" name="message" class="form-control" required placeholder="Xabarni kiriting...">
                                </div>
                                <div class="col-md-6 col-12 d-flex align-items-end justify-content-md-end justify-content-start">
                                    <button type="submit" class="btn btn-primary px-3 w-100 w-md-auto fw-medium">
                                        <i class="bi bi-send-fill me-2"></i> Xabarni saqlash
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="modal fade" id="updateOrder" tabindex="-1" aria-hidden="true">
        <form action="{{ route('order_update') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Buyurtmani taxrirlash
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <label for="phone" class="mb-2">Telefon raqam</label>
                        <input type="text" name="phone" required class="form-control phone" value="{{ $order->phone }}">
                        <label for="address" class="my-2">Buyurtma manzili</label>
                        <input type="text" name="address" required class="form-control" value="{{ $order->address }}">
                        <label for="order_count" class="my-2">Buyurtma soni</label>
                        <input type="number" name="order_count" required class="form-control" value="{{ $order->order_count }}">
                        <label for="phone" class="my-2">Hudud</label>
                        <select name="region_id" required class="form-select">
                            <option value="">Tanlang</option> 
                            @foreach ($region as $item)
                                <option value="{{ $item->id }}" {{ $order->region_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="description" class="my-2">Buyurtma haqida</label>
                        <textarea name="description" required class="form-control">{{ $order->description }}</textarea>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary border-0 px-4" data-bs-dismiss="modal">Bekor qilish</button>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">Saqlash</button>
                    </div>
                </div>
            </div>
        </form>
    </div> 

    <div class="modal fade" id="orderCancel" tabindex="-1" aria-hidden="true">
        <form action="{{ route('order_store_cancel') }}" method="post">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Buyurtmani bekor qilish
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <label for="description" class="mb-2">Bekor qilish sababi</label>
                        <textarea name="description" required class="form-control" value="{{ old('description') }}"></textarea>
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