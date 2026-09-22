@if (empty($cart) || count($cart) === 0)
    <div class="p-3">Chưa có món nào được thêm vào.</div>
@else
    <div style="min-width:320px; max-width:420px;">
        <ul class="list-group list-group-flush">
            @php $total = 0; @endphp

            @foreach ($cart as $item)
                @php
                    $price     = $item['price']    ?? 0;
                    $quantity  = $item['quantity'] ?? 1;
                    $subtotal  = $price * $quantity;
                    $total    += $subtotal;

                    $imageFile = $item['image'] ?? null;
                    $imagePath = $imageFile && file_exists(public_path("source/images/{$imageFile}"))
                                ? asset("source/images/{$imageFile}")
                                : asset('source/images/no-image.png');
                @endphp

                <li class="list-group-item d-flex align-items-center">
                    <img src="{{ $imagePath }}"
                         class="me-2 flex-shrink-0"
                         style="width:50px; height:50px; object-fit:cover; border-radius:6px;">

                    <div class="flex-grow-1">
                        <div class="fw-bold" style="font-size:.95rem;">
                            {{ $item['name'] }}
                        </div>
                        <div class="small text-muted">
                            x{{ $quantity }} • {{ number_format($price, 0, ',', '.') }}₫
                        </div>
                    </div>

                    <div class="text-end ms-2">
                        <div class="small">
                            {{ number_format($subtotal, 0, ',', '.') }}₫
                        </div>
                        <button type="button"
                                class="btn btn-link btn-sm text-danger remove-from-dropdown"
                                style="padding:0;"
                                data-id="{{ $item['id'] }}">
                            Xóa
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="p-3 border-top">
            <div class="d-flex justify-content-between mb-2">
                <strong>Tổng</strong>
                <strong>{{ number_format($total, 0, ',', '.') }}₫</strong>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('cart.index') }}"
                   class="btn btn-sm btn-outline-secondary w-100">
                    Xem món đã thêm vào
                </a>

                <!-- ĐÃ SỬA Ở ĐÂY -->
                <form action="{{ route('reservation.create') }}" method="GET" class="w-100">
                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        Đặt bàn với thực đơn này
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif
