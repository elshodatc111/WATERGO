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
            <div class="card-body mt-3">
                <form action="" method="post" id="orderForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon raqam</label>
                                <input type="text" class="form-control phone" value="{{ old('phone','+998') }}" id="phoneInput" name="phone" required>
                                <div id="phoneMessage" class="mt-2"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Yetqazish manzili</label>
                                <input type="text" class="form-control" id="addressInput" name="address" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="order_count" class="form-label">Buyurtma soni</label>
                                <input type="number" class="form-control" id="orderCountInput" name="order_count" min="1" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100" id="submitButton">Yangi buyurtma yaratish</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addressInput  = document.getElementById('addressInput');
        const regionSelect  = document.getElementById('regionSelect');
        const phoneMessage  = document.getElementById('phoneMessage');
        const submitButton  = document.getElementById('submitButton');
        const checkPhoneRoute = "{{ route('orders.checkPhone') }}";

        function resetFields() {
            addressInput.value    = '';
            regionSelect.value    = '';
            submitButton.disabled = false;
            phoneMessage.innerHTML = '';
        }

        function checkPhone(phoneNumber) {
            const clean = phoneNumber.replace(/\s+/g, '');

            phoneMessage.innerHTML = '<span class="text-info">Tekshirilmoqda...</span>';

            fetch(checkPhoneRoute + '?phone=' + encodeURIComponent(clean))
                .then(response => response.json())
                .then(data => {
                    phoneMessage.innerHTML = '';

                    if (data.active_order_exists) {
                        phoneMessage.innerHTML = `<div class="alert alert-warning py-1 px-2 mb-0" style="font-size: 0.85rem;"><i class="bi bi-exclamation-triangle me-1"></i> ${data.message}</div>`;
                        submitButton.disabled = true;
                        addressInput.value = '';
                        regionSelect.value = '';

                    } else if (data.latest_order) {
                        phoneMessage.innerHTML = `<span class="text-success" style="font-size: 0.85rem;"><i class="bi bi-check-circle me-1"></i> ${data.message}</span>`;
                        addressInput.value = data.latest_order.address;
                        regionSelect.value = data.latest_order.region_id;
                        submitButton.disabled = false;

                    } else {
                        phoneMessage.innerHTML = `<span class="text-muted" style="font-size: 0.85rem;">${data.message}</span>`;
                        submitButton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Xatolik:', error);
                    phoneMessage.innerHTML = `<span class="text-danger">Xatolik yuz berdi.</span>`;
                    submitButton.disabled = false;
                });
        }

        // jQuery inputmask — oncomplete callback ishlatish
        $('#phoneInput').inputmask({
            mask: '+999 99 999 9999',
            showMaskOnHover: false,
            showMaskOnFocus: true,
            clearIncomplete: true,
            oncomplete: function () {
                // Raqam to'liq kiritilganda avtomatik tekshirish
                checkPhone($(this).val());
            },
            onincomplete: function () {
                // Raqam o'chirilganda reset
                resetFields();
            },
            oncleared: function () {
                resetFields();
            }
        });
    });
</script>
@endpush
@endsection