@extends('layouts.app')

@section('title', $product->name . ' - Quán Nhậu 4 Anh Em')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trangchu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-lg-6 mb-4">
            <div class="product-image-container bg-light rounded-3 p-3 text-center">
                @if(!empty($product->image))
                    <img src="{{ asset('source/images/'.$product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid rounded-3"
                         id="mainProductImage"
                         style="max-height: 500px; object-fit: contain;">
                @else
                    <div class="no-image-placeholder d-flex align-items-center justify-content-center" 
                         style="height: 400px; background: #f8f9fa;">
                        <div class="text-center">
                            <i class="bi bi-image" style="font-size: 80px; color: #ccc;"></i>
                            <p class="mt-2 text-muted">Không có hình ảnh</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-lg-6">
            <div class="product-details">
                <h1 class="h2 fw-bold mb-3">{{ $product->name }}</h1>
                
                <!-- Giá và Mã sản phẩm -->
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="product-price">
                            <span class="h3 text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="product-code text-muted">
                            Mã: <span class="fw-semibold">#{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                    
                    <!-- Trạng thái -->
                    <div class="badge bg-success mb-3" style="font-size: 0.9rem;">
                        <i class="bi bi-check-circle me-1"></i> Còn phục vụ
                    </div>
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Mô tả món</h5>
                        @if($product->description)
<p class="card-text" style="line-height: 1.8; color: #555;">
                                {{ $product->description }}
                            </p>
                        @else
                            <p class="card-text text-muted">Chưa có mô tả chi tiết cho sản phẩm này.</p>
                        @endif
                    </div>
                </div>

                <!-- Form thêm vào giỏ hàng -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Đặt món ngay</h5>
                        
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-auto">
                                <label class="form-label fw-semibold">Số lượng:</label>
                            </div>
                            <div class="col-auto">
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary" type="button" id="decreaseQty">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" 
                                           class="form-control text-center" 
                                           id="quantityInput" 
                                           value="1" 
                                           min="1" 
                                           max="10">
                                    <button class="btn btn-outline-secondary" type="button" id="increaseQty">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-auto">
                                <span class="text-muted">(Tối đa: 10)</span>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <button type="button" 
                                    class="btn btn-primary btn-lg py-3 fw-bold add-to-cart-detail"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}"
                                    data-image="{{ $product->image ?? '' }}">
                                <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ hàng
                            </button>
                            
                            <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary btn-lg py-3">
                                <i class="bi bi-arrow-left me-2"></i> Tiếp tục xem menu
                            </a>
                        </div>
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    @if($relatedProducts->count() > 0)
    <div class="mt-5 pt-4 border-top">
        <h3 class="mb-4">Món cùng danh mục</h3>
        <div class="row g-4">
            @foreach($relatedProducts as $related)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <a href="{{ route('menu.show', $related->id) }}" class="text-decoration-none text-dark">
                        <div class="card-img-top" style="height: 180px; overflow: hidden;">
                            @if(!empty($related->image))
                                <img src="{{ asset('source/images/'.$related->image) }}" 
                                     alt="{{ $related->name }}" 
                                     class="img-fluid" 
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 100%;">
                                    <i class="bi bi-image text-muted" style="font-size: 48px;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h6 class="card-title mb-2">{{ $related->name }}</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-danger fw-bold">{{ number_format($related->price, 0, ',', '.') }}₫</span>
                                <span class="badge bg-light text-dark">Xem chi tiết</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .product-image-container {
        border: 1px solid #eee;
    }
    .input-group button {
        width: 45px;
    }
    .no-image-placeholder {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý tăng/giảm số lượng
        const quantityInput = document.getElementById('quantityInput');
        const decreaseBtn = document.getElementById('decreaseQty');
        const increaseBtn = document.getElementById('increaseQty');
        
        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < 10) {
                quantityInput.value = currentValue + 1;
            }
        });
        
        // Validate số lượng khi nhập tay
        quantityInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) this.value = 1;
            if (value > 10) this.value = 10;
        });
        
        // Xử lý thêm vào giỏ hàng từ trang chi tiết
        const addToCartBtn = document.querySelector('.add-to-cart-detail');
        
        addToCartBtn.addEventListener('click', async function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = this.dataset.price;
            const image = this.dataset.image;
            const quantity = parseInt(quantityInput.value);
            
            // Disable button và hiển thị loading
            const originalText = addToCartBtn.innerHTML;
            addToCartBtn.disabled = true;
            addToCartBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Đang thêm...';
            
            try {
                const response = await fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        id: id,
                        name: name,
                        price: price,
                        image: image,
                        quantity: quantity
                    })
                });
                
                const data = await response.json();
                
                if (data.ok) {
                    // Update cart count badge
                    const badge = document.getElementById('cart-count');
                    if (badge && data.count !== undefined) {
                        badge.innerText = data.count;
                    }
                    
                    // Update dropdown content if present
                    if (data.dropdownHtml) {
                        const dd = document.getElementById('cart-dropdown-content');
                        if (dd) dd.innerHTML = data.dropdownHtml;
                    }
                    
                    // Show success message
                    showToast(`Đã thêm ${quantity} x "${name}" vào giỏ hàng!`, 'success');
                    
                    // Reset quantity
                    quantityInput.value = 1;
                } else {
showToast(data.message || 'Có lỗi xảy ra', 'danger');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Lỗi kết nối, vui lòng thử lại', 'danger');
            } finally {
                // Re-enable button
                addToCartBtn.disabled = false;
                addToCartBtn.innerHTML = originalText;
            }
        });
        
        // Hàm hiển thị toast message
        function showToast(message, type = 'success') {
            const toastContainer = document.createElement('div');
            toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            
            const toastId = 'toast-' + Date.now();
            toastContainer.innerHTML = `
                <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi ${type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle'} me-2"></i>
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(toastContainer);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
            
            // Remove toast element after it hides
            toastElement.addEventListener('hidden.bs.toast', function() {
                toastContainer.remove();
            });
        }
    });
</script>
@endpush