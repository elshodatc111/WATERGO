@extends('layout.layout')
@section('title', "Buyurtmalar")
@section('content')

    <div class="pagetitle">
        <h1>Buyurtmalar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item active">Buyurtmalar</li>
            </ol>
        </nav>
    </div>

    <section class="section orders">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="card-title">Buyurtmalar</h2>
                    </div>
                    <div class="col-lg-6" style="display: flex; justify-content: flex-end; align-items: center;">
                        <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#new_order"> <i class="bi bi-plus-circle"></i> Yangi buyurtma</button>
                    </div>
                </div>
                <div class="Search">
                    <input class="form-control" type="text" id="tableSearch" placeholder="Telefon, hudud yoki manzil bo'yicha qidiruv...">
                </div>
                <div class="table-responsive pt-2">
                    <table class="table table-bordered table-striped" style="font-size: 14px">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Telefon raqam</th>
                                <th>Hudud</th>
                                <th>Manzil</th> 
                                <th>Buyurtma soni</th>
                                <th>Buyurtma holati</th> 
                                <th>Buyutma vaqti</th>  
                            </tr>
                        </thead>
                        <tbody id="orderTableBody">
                            @forelse($order as $item)
                                <tr>
                                    <td class="text-center row-number">{{ $loop->index+1 }}</td>
                                    <td class="text-center search-field"><a href="{{ route('order_show', $item->id) }}">{{ $item->phone }}</a></td>
                                    <td class="search-field">{{ $item->address }}</td>
                                    <td class="text-center search-field">{{ $item->region->name }}</td>
                                    
                                    <td class="text-center">{{ $item->order_count }}</td>
                                    <td class="text-center">
                                        @if($item->status=='new')
                                            <span class="badge bg-primary">Yangi</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Yetqazilmoqda</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                </tr>
                            @empty
                                <tr id="no-data-row">
                                    <td class="text-center" colspan="7">Aktiv buyurtmalar yo'q.</td>
                                </tr>
                            @endforelse                        
                        </tbody>
                    </table>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const searchInput = document.getElementById('tableSearch');
                        const tableBody = document.getElementById('orderTableBody');
                        const rows = tableBody.getElementsByTagName('tr');
                        searchInput.addEventListener('keyup', function () {
                            const filter = searchInput.value.toLowerCase().trim();
                            let hasVisibleRow = false;
                            let visibleCount = 1;
                            if (document.getElementById('no-data-row') && rows.length === 1) return;
                            for (let i = 0; i < rows.length; i++) {
                                if (rows[i].id === 'no-results-row') continue;
                                const phoneCell = rows[i].cells[1]?.textContent || '';
                                const addressCell = rows[i].cells[2]?.textContent || '';
                                const regionCell = rows[i].cells[3]?.textContent || '';
                                const combinedText = `${phoneCell} ${addressCell} ${regionCell}`.toLowerCase();
                                if (combinedText.includes(filter)) {
                                    rows[i].style.display = '';
                                    const numberCell = rows[i].querySelector('.row-number');
                                    if (numberCell) {
                                        numberCell.textContent = visibleCount++;
                                    }                                
                                    hasVisibleRow = true;
                                } else {
                                    rows[i].style.display = 'none';
                                }
                            }
                            const existingNoResults = document.getElementById('no-results-row');
                            if (!hasVisibleRow) {
                                if (!existingNoResults) {
                                    const noResultsRow = document.createElement('tr');
                                    noResultsRow.id = 'no-results-row';
                                    noResultsRow.innerHTML = `<td colspan="7" class="text-center text-danger fw-bold py-3">Kiritilgan ma'lumot bo'yicha buyurtma topilmadi...</td>`;
                                    tableBody.appendChild(noResultsRow);
                                }
                            } else {
                                if (existingNoResults) {
                                    existingNoResults.remove();
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="mt-2 text-center">
            <a href="{{ route('orders_index_end') }}" class="btn btn-primary w-50">Arxiv buyurtmalar</a>
        </div>
    </section>

    <div class="modal fade" id="new_order" tabindex="-1" aria-hidden="true">
        <form action="{{ route('order_store') }}" method="post" id="orderForm">
            @csrf 
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i> Yangi buyurtma
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-1">
                            <label for="phone" class="form-label">Telefon raqam</label>
                            <input type="text" class="form-control phone" id="phoneInput" name="phone" required>
                            <div id="phoneMessage" class="mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label for="order_count" class="form-label">Buyurtma soni</label>
                            <input type="number" class="form-control" id="orderCountInput" name="order_count" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Yetqazish manzili</label>
                            <input type="text" class="form-control" id="addressInput" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="region_id" class="form-label">Yetqazish hududi</label>
                            <select class="form-select" id="regionSelect" name="region_id" required>
                                <option value="">Hududni tanlang</option>
                                @foreach ($region as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
@push('scripts')
<script>
    $(document).ready(function () {
        const checkPhoneRoute = "{{ route('orders.checkPhone') }}";
        $('#phoneInput').inputmask({
            mask: '+998 99 999 9999',
            placeholder: '_',
            showMaskOnFocus: true,
            showMaskOnHover: false,
            clearIncomplete: false,
            onBeforeMask: function () { return '+998 '; },
            oncomplete: function () {
                const phone = $(this).val().replace(/\s+/g, '');
                $('#phoneMessage').html('<span class="text-info">Tekshirilmoqda...</span>');
                $('#addressInput').val('');
                $('#regionSelect').val('');
                $('#submitButton').prop('disabled', false);
                $.ajax({
                    url: checkPhoneRoute,
                    type: 'GET',
                    data: { phone: phone },
                    success: function (data) {
                        $('#phoneMessage').html('');
                        if (data.active_order_exists) {
                            $('#phoneMessage').html(
                                '<div class="alert alert-warning py-1 px-2 mb-0" style="font-size:0.85rem;">' +
                                '<i class="bi bi-exclamation-triangle me-1"></i> ' + data.message +
                                '</div>'
                            );
                            $('#submitButton').prop('disabled', true);
                            $('#addressInput').val('');
                            $('#regionSelect').val('');
                        } else if (data.latest_order) {
                            $('#phoneMessage').html(
                                '<span class="text-success" style="font-size:0.85rem;">' +
                                '<i class="bi bi-check-circle me-1"></i> ' + data.message +
                                '</span>'
                            );
                            $('#addressInput').val(data.latest_order.address);
                            $('#regionSelect').val(data.latest_order.region_id);
                            $('#submitButton').prop('disabled', false);
                        } else {
                            $('#phoneMessage').html(
                                '<span class="text-muted" style="font-size:0.85rem;">' +
                                data.message + '</span>'
                            );
                            $('#submitButton').prop('disabled', false);
                        }
                    },
                    error: function () {
                        $('#phoneMessage').html('<span class="text-danger">Server bilan bog\'lanishda xatolik.</span>');
                        $('#submitButton').prop('disabled', false);
                    }
                });
            },
            onincomplete: function () {
                $('#phoneMessage').html('');
                $('#addressInput').val('');
                $('#regionSelect').val('');
                $('#submitButton').prop('disabled', false);
            },
            oncleared: function () {
                $('#phoneMessage').html('');
                $('#addressInput').val('');
                $('#regionSelect').val('');
                $('#submitButton').prop('disabled', false);
            }
        });
        $('#phoneInput').val('+998 ');
    });
</script>
@endpush