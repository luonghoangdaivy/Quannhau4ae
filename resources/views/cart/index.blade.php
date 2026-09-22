@extends('layouts.app')

@section('title', 'Giỏ hàng - Quán Nhậu 4 Anh Em')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @php $total = 0; @endphp
    
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Món</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tạm tính</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cart-tbody">
                @forelse($cart as $id => $item)
                    @php 
                        $subtotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 1); 
                        $total += $subtotal; 
                    @endphp
                    <tr data-id="{{ $id }}">
                        <td class="align-middle">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ !empty($item['image']) ? asset('source/images/'.$item['image']) : asset('source/images/no-image.png') }}"
                                     style="width:80px;height:80px;object-fit:cover;border-radius:6px;">
                                <div>
                                    <div class="fw-bold">{{ $item['name'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ number_format($item['price'],0,',','.') }}₫</td>
                        <td>
                            <div class="input-group" style="max-width:140px;">
                                <button class="btn btn-outline-secondary btn-decrease" data-id="{{ $id }}">-</button>
                                <input class="form-control qty-input text-center" data-id="{{ $id }}" 
                                       value="{{ $item['quantity'] }}" type="number" min="1">
                                <button class="btn btn-outline-secondary btn-increase" data-id="{{ $id }}">+</button>
                            </div>
                        </td>
                        <td class="subtotal">{{ number_format($subtotal,0,',','.') }}₫</td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-remove" data-id="{{ $id }}">Xóa</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-cart-x" style="font-size: 48px;"></i>
<p class="mt-2">Chưa có món nào trong giỏ hàng</p>
                                <a href="{{ route('menu.index') }}" class="btn btn-primary mt-2">
                                    <i class="bi bi-arrow-left me-1"></i> Tiếp tục mua sắm
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($cart) > 0)
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td><strong id="cart-total">{{ number_format($total,0,',','.') }}₫</strong></td>
                    <td></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    @if(count($cart) > 0)
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Tiếp tục gọi món
        </a>
     <a href="{{ route('reservation.create') }}"
   class="btn btn-success"
   id="checkout-link">
    <i class="bi bi-credit-card me-1"></i>
    Đặt bàn / Thanh toán ({{ number_format($total,0,',','.') }}₫)
</a>
    </div>
    @endif
</div>


@endsection

@push('scripts')
<script>
// Cart update/remove scripts
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

async function updateQty(id, qty) {
    try {
        const res = await fetch("{{ route('cart.update') }}", {
            method: 'POST',
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken,'X-Requested-With':'XMLHttpRequest'},
            body: JSON.stringify({id, quantity: qty})
        });
        const data = await res.json();
        if (data.ok) {
            // 1. Cập nhật subtotal trong bảng
            const tr = document.querySelector('tr[data-id="'+id+'"]');
            if (tr) {
                tr.querySelector('.subtotal').innerText = new Intl.NumberFormat('vi-VN').format(data.subtotal) + '₫';
            }
            
            // 2. Cập nhật tổng tiền trong bảng
            document.getElementById('cart-total').innerText = new Intl.NumberFormat('vi-VN').format(data.total) + '₫';
            
            // 3. Cập nhật tổng tiền trong modal checkout
            const modalTotal = document.getElementById('modal-total');
            if (modalTotal) {
                modalTotal.innerText = new Intl.NumberFormat('vi-VN').format(data.total) + '₫';
            }
            
            // 4. Cập nhật nút thanh toán (QUAN TRỌNG)
           const checkoutLink = document.getElementById('checkout-link');
if (checkoutLink) {
    checkoutLink.innerHTML =
        `<i class="bi bi-credit-card me-1"></i>
         Đặt bàn / Thanh toán (${new Intl.NumberFormat('vi-VN').format(data.total)}₫)`;
}
            
         // 5. Cập nhật badge icon giỏ hàng
const cartCount = document.getElementById('cart-count');
if (cartCount && data.count !== undefined) {
    cartCount.innerText = data.count;
    cartCount.style.display = data.count > 0 ? 'inline-block' : 'none';
}
      if (typeof fetchDropdownAndUpdateBadge === 'function') {
    fetchDropdownAndUpdateBadge();
}

          
        }
    } catch(err){ 
        console.error(err); 
    }
}

document.addEventListener('click', function(e){
    const inc = e.target.closest('.btn-increase');
    const dec = e.target.closest('.btn-decrease');
    const rem = e.target.closest('.btn-remove');

    if (inc) {
        const id = inc.dataset.id;
        const input = document.querySelector('.qty-input[data-id="'+id+'"]');
        input.value = parseInt(input.value) + 1;
        updateQty(id, parseInt(input.value));
    }
    if (dec) {
        const id = dec.dataset.id;
        const input = document.querySelector('.qty-input[data-id="'+id+'"]');
        const newv = Math.max(1, parseInt(input.value) - 1);
        input.value = newv;
        updateQty(id, newv);
    }
    if (rem) {
        const id = rem.dataset.id;
        if (!confirm('Bạn có chắc muốn xóa món này?')) return;
        fetch("{{ route('cart.remove') }}", {
            method: 'POST',
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken,'X-Requested-With':'XMLHttpRequest'},
            body: JSON.stringify({id})
        })
        .then(r=>r.json()).then(data=>{
            if (data.ok) {
                const tr = document.querySelector('tr[data-id="'+id+'"]');
                if (tr) tr.remove();
document.getElementById('cart-total').innerText = new Intl.NumberFormat('vi-VN').format(data.total) + '₫';
                
                fetchCartDropdown();
            }
        }).catch(e=>{
            console.error(e); 
        });
    }
});

// Xử lý thay đổi số lượng bằng tay
document.addEventListener('change', function(e) {
    const input = e.target.closest('.qty-input');
    if (input) {
        const id = input.dataset.id;
        const qty = Math.max(1, parseInt(input.value) || 1);
        input.value = qty;
        updateQty(id, qty);
    }
});

// Checkout modal
document.addEventListener('DOMContentLoaded', function() {
    const checkoutBtn = document.getElementById('open-checkout-modal');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            const modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            modal.show();
        });
    }
});
</script>
@endpush