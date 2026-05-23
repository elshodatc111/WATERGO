@extends('layout.layout')
@section('title', "Arxiv buyurtmalar")
@section('content')

    <div class="pagetitle">
        <h1>Arxiv buyurtmalar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orders_index') }}">Buyurtmalar</a></li>
                <li class="breadcrumb-item active">Arxiv buyurtmalar</li>
            </ol>
        </nav>
    </div>

    <section class="section orders">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Arxiv buyurtmalar</h2>
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
                                        @if($item->status=='success')
                                            <span class="badge bg-success">Yetqazildi</span>
                                        @else
                                            <span class="badge bg-danger text-white">Bekor qilindi</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                </tr>
                            @empty
                                <tr id="no-data-row">
                                    <td class="text-center" colspan="7">Arxiv buyurtmalar yo'q.</td>
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
    </section>
@endsection