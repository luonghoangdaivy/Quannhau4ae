@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
  <!-- Header với background giống trang chủ -->
  <div class="menu-header" style="background: linear-gradient(180deg, #7a0b0b, #b91c1c); padding: 50px 0 30px 0; margin-bottom: 40px; box-shadow: 0 8px 20px rgba(0,0,0,0.5);">
    <div class="container">
      <!-- Breadcrumb với màu sáng -->
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb menu-breadcrumb mb-0">
          <li class="breadcrumb-item">
            <a href="{{ route('menu.index') }}">🎯 Thực đơn</a>
          </li>
          @if(isset($selectedCategory) && $selectedCategory)
            <li class="breadcrumb-item active" aria-current="page">
              <span class="category-badge">{{ $selectedCategory->name }}</span>
            </li>
          @endif
        </ol>
      </nav>

      <!-- Tiêu đề chính -->
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1 class="menu-title text-white mb-3">
            THỰC ĐƠN <span class="highlight-text">QUÁN NHẬU</span>
          </h1>
          <p class="menu-subtitle text-light" style="opacity: 0.9; font-size: 18px;">
            {{ isset($selectedCategory) && $selectedCategory ? 
               "Khám phá " . $products->total() . " món ngon trong danh mục " . $selectedCategory->name : 
               "Hơn 50+ món nhậu đặc biệt - Đồng giá từ 50K" }}
          </p>
        </div>
        
        <div class="col-md-6">
          <!-- Thanh tìm kiếm với style giống header -->
          <form action="{{ route('menu.search') }}" method="GET" class="menu-search-form">
            <div class="input-group" style="border-radius: 25px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">
              <input type="text" name="q" value="{{ request('q') }}" 
                     class="form-control border-0 py-3 ps-4" 
                     placeholder="🔍 Tìm món ăn, thức uống...">
              <input type="hidden" name="category" value="{{ request('category') }}">
              <button class="btn btn-warning px-4 fw-bold" type="submit" 
                      style="background: linear-gradient(45deg, #ffcc33, #ff9900); border: none;">
                Tìm kiếm
              </button>
            </div>
          </form>
          
          <!-- Counter hiển thị số lượng -->
          <div class="d-flex align-items-center mt-3">
            <div class="product-count-badge">
              <span class="count-number">{{ $products->total() }}</span>
              <span class="count-text">món đang hiển thị</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <!-- Bộ lọc danh mục với style mới -->
    @if(isset($categories) && $categories->count() > 0)
    <div class="menu-filter-section mb-5">
      <div class="section-header mb-4">
        <h3 class="filter-title">
          <i class="bi bi-filter-circle me-2"></i>
          LỌC THEO DANH MỤC
        </h3>
      </div>
      
      <div class="category-filters">
        <!-- Nút "Tất cả" -->
        <a href="{{ route('menu.index') }}" 
           class="category-filter-btn {{ !request('category') ? 'active' : '' }}">
          <span class="filter-icon">🍽️</span>
          <span class="filter-text">Tất cả món</span>
          <span class="filter-count">{{ $products->total() }}</span>
        </a>
        
        <!-- Các nút danh mục từ database -->
        @foreach($categories as $cat)
          @php
            // Đếm số sản phẩm trong danh mục (nếu có)
            $count = $cat->products_count ?? 0;
          @endphp
          <a href="{{ route('menu.index', ['category' => $cat->id]) }}" 
             class="category-filter-btn {{ request('category') == $cat->id ? 'active' : '' }}">
            <span class="filter-icon">
              @switch(strtolower($cat->name))
                @case('bia')
                @case('rượu')
                @case('đồ uống')
                  🍺
                  @break
                @case('hải sản')
                  🦐
                  @break
                @case('nướng')
                  🔥
                  @break
                @case('lẩu')
                  🍲
                  @break
                @case('khai vị')
                  🥗
                  @break
                @default
                  🍴
              @endswitch
            </span>
            <span class="filter-text">{{ $cat->name }}</span>
            @if($count > 0)
            <span class="filter-count">{{ $count }}</span>
            @endif
          </a>
        @endforeach
      </div>
      
      <!-- Hiển thị danh mục đang chọn -->
      @if(isset($selectedCategory) && $selectedCategory)
      <div class="selected-category-info mt-4">
        <div class="alert" style="background: rgba(255, 204, 51, 0.1); border: 2px solid #ffcc33; border-radius: 15px; padding: 15px;">
          <div class="d-flex align-items-center">
            <div class="selected-icon" style="background: #ffcc33; color: #7a0b0b; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 20px;">
              📁
            </div>
            <div>
              <h5 class="mb-1" style="color: #7a0b0b;">Đang xem: <strong>{{ $selectedCategory->name }}</strong></h5>
              <p class="mb-0" style="color: #666;">
                Tổng cộng {{ $products->total() }} món | 
                <a href="{{ route('menu.index') }}" class="text-decoration-none" style="color: #b91c1c; font-weight: bold;">
                  👈 Quay lại tất cả
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
    @endif

    <!-- Thông báo -->
    @if(session('success')) 
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px; border: none; background: linear-gradient(45deg, #d4edda, #c3e6cb);">
      <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2" style="font-size: 20px; color: #155724;"></i>
        <div>{{ session('success') }}</div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))   
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 15px; border: none; background: linear-gradient(45deg, #f8d7da, #f5c6cb);">
      <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 20px; color: #721c24;"></i>
        <div>{{ session('error') }}</div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Grid sản phẩm -->
    <div class="row g-4">
      @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="menu-product-card">
            <!-- Badge HOT/NEW nếu có -->
            @if($product->is_hot ?? false)
            <div class="product-badge hot">HOT</div>
            @elseif($product->is_new ?? false)
            <div class="product-badge new">MỚI</div>
            @endif
            
            <!-- Hình ảnh -->
            <div class="product-image-wrapper">
              @if(!empty($product->image))
              <img src="{{ asset('source/images/'.$product->image) }}"
                   class="product-image"
                   alt="{{ $product->name }}"
                   onerror="this.src='https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400&auto=format&fit=crop'">
              @else
              <div class="product-image-placeholder">
                <span class="placeholder-icon">🍺</span>
                <span class="placeholder-text">Chưa có hình</span>
              </div>
              @endif
              
              <!-- Overlay khi hover -->
              <div class="product-overlay">
                <div class="overlay-content">
                  <a href="{{ route('menu.show', $product->id) }}" class="btn btn-outline-light btn-sm me-2">
                    <i class="bi bi-eye me-1"></i> Xem
                  </a>
                  <button class="btn btn-warning add-to-cart-btn" type="button"
                          data-id="{{ $product->id }}"
                          data-name="{{ $product->name }}"
                          data-price="{{ $product->price ?? 0 }}"
                          data-image="{{ asset('source/images/'.$product->image ?? '') }}">
                    <i class="bi bi-cart-plus me-1"></i> Thêm
                  </button>
                </div>
              </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="product-info">
              <div class="product-header">
                <h5 class="product-name">{{ $product->name }}</h5>
                @if($product->category)
                <span class="product-category">{{ $product->category->name }}</span>
                @endif
              </div>
              
              <p class="product-description">{{ Str::limit($product->description ?? 'Món ngon đặc biệt của quán', 60) }}</p>
              
              <div class="product-footer">
                <div class="price-section">
                  <div class="current-price">{{ number_format($product->price ?? 0,0,',','.') }}₫</div>
                  @if($product->original_price ?? false)
                  <div class="original-price">{{ number_format($product->original_price,0,',','.') }}₫</div>
                  @endif
                </div>
                
                <div class="product-actions">
                  <button class="btn btn-add-cart add-to-cart-btn" type="button"
                          data-id="{{ $product->id }}"
                          data-name="{{ $product->name }}"
                          data-price="{{ $product->price ?? 0 }}"
                          data-image="{{ asset('source/images/'.$product->image ?? '') }}">
                    <i class="bi bi-cart-plus me-1"></i> Thêm giỏ
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="empty-state">
            <div class="empty-icon">😔</div>
            <h3>Chưa có món nào</h3>
            @if(request('category'))
              <p>Không tìm thấy món nào trong danh mục "{{ $selectedCategory->name ?? '' }}"</p>
            @elseif(request('q'))
              <p>Không tìm thấy món nào với từ khóa "{{ request('q') }}"</p>
            @else
              <p>Thực đơn đang được cập nhật. Vui lòng quay lại sau!</p>
            @endif
            <a href="{{ route('menu.index') }}" class="btn btn-warning mt-3 px-4">
              <i class="bi bi-arrow-left me-1"></i> Xem tất cả món
            </a>
          </div>
        </div>
      @endforelse
    </div>

    <!-- Phân trang -->
    @if(method_exists($products,'links') && $products->total() > 0)
    <div class="menu-pagination mt-5">
      {{ $products->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
    @endif
  </div>
</div>
@endsection

@push('styles')
<style>
/* ===== STYLE CHUNG ===== */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* ===== HEADER MENU ===== */
.menu-header {
  position: relative;
  overflow: hidden;
}

.menu-header::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(0,0,0,0.05)" d="M0,0 L100,0 L100,100 Z"/></svg>');
  opacity: 0.1;
}

.menu-title {
  font-size: 3.5rem;
  font-weight: 800;
  letter-spacing: 1px;
  text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
}

.menu-title .highlight-text {
  color: #ffcc33;
  text-shadow: 0 0 10px rgba(255,204,51,0.5);
}

.menu-subtitle {
  font-size: 1.2rem;
  max-width: 600px;
}

/* Breadcrumb */
.menu-breadcrumb {
  background: transparent;
  padding: 0;
  font-size: 1.8rem;
  font-weight: 600;
}

.menu-breadcrumb .breadcrumb-item a {
  color: #ffcc33 !important;
  text-decoration: none;
  font-weight: 700;
}

.menu-breadcrumb .breadcrumb-item.active .category-badge {
  background: #ffcc33;
  color: #7a0b0b;
  padding: 5px 15px;
  border-radius: 20px;
  font-weight: bold;
}

.breadcrumb-item + .breadcrumb-item::before {
  content: '›';
  color: #ffcc33;
  font-size: 24px;
}

/* Thanh tìm kiếm */
.menu-search-form .form-control {
  background: rgba(255, 255, 255, 0.95);
  font-size: 16px;
}

.menu-search-form .form-control:focus {
  box-shadow: 0 0 0 3px rgba(255, 204, 51, 0.3);
  border-color: #ffcc33;
}

/* Counter badge */
.product-count-badge {
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border: 2px solid #ffcc33;
  border-radius: 20px;
  padding: 8px 20px;
  display: inline-flex;
  align-items: center;
  gap: 10px;
}

.product-count-badge .count-number {
  background: #ffcc33;
  color: #7a0b0b;
  width: 35px;
  height: 35px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 18px;
}

.product-count-badge .count-text {
  color: white;
  font-weight: 500;
}

/* ===== FILTER SECTION ===== */
.filter-title {
  color: #7a0b0b;
  font-size: 24px;
  font-weight: 700;
  border-bottom: 3px solid #ffcc33;
  padding-bottom: 10px;
  display: inline-block;
}

.category-filters {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  margin-top: 20px;
}

.category-filter-btn {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #f8f9fa;
  border: 2px solid #dee2e6;
  border-radius: 15px;
  padding: 12px 20px;
  text-decoration: none;
  color: #495057;
  transition: all 0.3s;
  min-width: 180px;
}

.category-filter-btn:hover {
  transform: translateY(-5px);
  border-color: #ffcc33;
  background: white;
  box-shadow: 0 10px 20px rgba(255, 204, 51, 0.2);
  color: #7a0b0b;
}

.category-filter-btn.active {
  background: linear-gradient(45deg, #7a0b0b, #b91c1c);
  color: white;
  border-color: #ffcc33;
  box-shadow: 0 10px 20px rgba(122, 11, 11, 0.3);
}

.category-filter-btn.active .filter-icon {
  background: #ffcc33;
  color: #7a0b0b;
}

.filter-icon {
  background: #e9ecef;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  transition: all 0.3s;
}

.filter-text {
  flex: 1;
  font-weight: 600;
  font-size: 15px;
}

.filter-count {
  background: #6c757d;
  color: white;
  font-size: 12px;
  padding: 2px 8px;
  border-radius: 10px;
  font-weight: bold;
}

.category-filter-btn.active .filter-count {
  background: #ffcc33;
  color: #7a0b0b;
}

/* ===== PRODUCT CARD ===== */
.menu-product-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  transition: all 0.4s ease;
  height: 100%;
  border: 1px solid #f1f1f1;
  position: relative;
}

.menu-product-card:hover {
  transform: translateY(-15px);
  box-shadow: 0 20px 40px rgba(122, 11, 11, 0.15);
  border-color: #ffcc33;
}

/* Product badges */
.product-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  padding: 5px 15px;
  border-radius: 15px;
  font-size: 12px;
  font-weight: bold;
  z-index: 2;
}

.product-badge.hot {
  background: #ff3333;
  color: white;
  animation: pulse 2s infinite;
}

.product-badge.new {
  background: #33cc33;
  color: white;
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

/* Image wrapper */
.product-image-wrapper {
  height: 220px;
  overflow: hidden;
  position: relative;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.menu-product-card:hover .product-image {
  transform: scale(1.1);
}

.product-image-placeholder {
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, #f8f9fa, #e9ecef);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.placeholder-icon {
  font-size: 48px;
  margin-bottom: 10px;
  opacity: 0.5;
}

.placeholder-text {
  color: #6c757d;
  font-size: 14px;
}

/* Overlay khi hover */
.product-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(122, 11, 11, 0.85);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.menu-product-card:hover .product-overlay {
  opacity: 1;
}

.overlay-content {
  text-align: center;
}

/* Product info */
.product-info {
  padding: 20px;
}

.product-header {
  margin-bottom: 10px;
}

.product-name {
  color: #7a0b0b;
  font-size: 18px;
  font-weight: 700;
  margin-bottom: 5px;
  line-height: 1.3;
}

.product-category {
  display: inline-block;
  background: rgba(255, 204, 51, 0.1);
  color: #b91c1c;
  font-size: 12px;
  padding: 3px 10px;
  border-radius: 10px;
  font-weight: 500;
}

.product-description {
  color: #666;
  font-size: 14px;
  line-height: 1.5;
  margin-bottom: 20px;
  min-height: 42px;
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.price-section {
  display: flex;
  flex-direction: column;
}

.current-price {
  color: #b91c1c;
  font-size: 22px;
  font-weight: bold;
}

.original-price {
  color: #999;
  font-size: 14px;
  text-decoration: line-through;
}

/* Add to cart button */
.btn-add-cart {
  background: linear-gradient(45deg, #ffcc33, #ff9900);
  color: #7a0b0b;
  border: none;
  border-radius: 15px;
  padding: 10px 20px;
  font-weight: bold;
  transition: all 0.3s;
  display: flex;
  align-items: center;
  gap: 5px;
}

.btn-add-cart:hover {
  background: linear-gradient(45deg, #ff9900, #ffcc33);
  transform: translateX(5px);
  box-shadow: 0 5px 15px rgba(255, 153, 0, 0.3);
}

/* ===== EMPTY STATE ===== */
.empty-state {
  text-align: center;
  padding: 60px 20px;
  background: white;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.empty-icon {
  font-size: 60px;
  margin-bottom: 20px;
}

.empty-state h3 {
  color: #7a0b0b;
  margin-bottom: 15px;
}

.empty-state p {
  color: #666;
  max-width: 500px;
  margin: 0 auto 20px;
}

/* ===== PAGINATION ===== */
.menu-pagination .pagination {
  justify-content: center;
}

.menu-pagination .page-item .page-link {
  border: 2px solid #ffcc33;
  color: #7a0b0b;
  margin: 0 5px;
  border-radius: 10px;
  font-weight: bold;
  transition: all 0.3s;
}

.menu-pagination .page-item.active .page-link {
  background: #7a0b0b;
  border-color: #7a0b0b;
  color: white;
}

.menu-pagination .page-item .page-link:hover {
  background: #ffcc33;
  color: #7a0b0b;
  transform: translateY(-3px);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .menu-title {
    font-size: 2.5rem;
  }
  
  .menu-breadcrumb {
    font-size: 1.4rem;
  }
  
  .category-filters {
    justify-content: center;
  }
  
  .category-filter-btn {
    min-width: 150px;
    padding: 10px 15px;
  }
  
  .product-image-wrapper {
    height: 180px;
  }
}

@media (max-width: 576px) {
  .menu-title {
    font-size: 2rem;
  }
  
  .category-filters {
    flex-direction: column;
    align-items: center;
  }
  
  .category-filter-btn {
    width: 100%;
    max-width: 300px;
  }
  
  .product-footer {
    flex-direction: column;
    gap: 15px;
    align-items: flex-start;
  }
  
  .btn-add-cart {
    width: 100%;
    justify-content: center;
  }
}
</style>
@endpush

@push('scripts')
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
// Giữ nguyên script cart của bạn
(function() {
  const cartEndpoints = {
    add: "{{ route('cart.add') }}",
    dropdown: "{{ route('cart.dropdown') }}",
    remove: "{{ route('cart.remove') ?? url('/cart/remove') }}",
  };

  const meta = document.querySelector('meta[name="csrf-token"]');
  const csrfToken = meta ? meta.getAttribute('content') : null;

  function showToast(message, type = 'success', timeout = 2000) {
    const wrap = document.createElement('div');
    wrap.className = 'position-fixed top-0 end-0 p-3';
    wrap.style.zIndex = 9999;
    wrap.innerHTML = `<div class="toast align-items-center text-bg-${type} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">${message}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>`;
    document.body.appendChild(wrap);
    setTimeout(()=> wrap.remove(), timeout + 300);
  }

  document.addEventListener('click', async function(e) {
    const btn = e.target.closest('.add-to-cart-btn');
    if (btn) {
      e.preventDefault();
      const id = btn.dataset.id;
      const name = btn.dataset.name;
      const price = btn.dataset.price;
      const image = btn.dataset.image || '';

      btn.disabled = true;
      const prevHtml = btn.innerHTML;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Đang thêm';

      try {
        const res = await fetch(cartEndpoints.add, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify({ id, name, price, image, quantity: 1 })
        });

        if (!res.ok) {
          let errText = 'Lỗi server';
          try {
            const errJson = await res.json();
            errText = errJson.message || errText;
          } catch(_) {}
          throw new Error(errText);
        }

        const data = await res.json();

        if (data.ok) {
          const badge = document.getElementById('cart-count');
          if (badge && data.count !== undefined) badge.innerText = data.count;

          if (data.dropdownHtml) {
            const dd = document.getElementById('cart-dropdown-content');
            if (dd) dd.innerHTML = data.dropdownHtml;
          }

          showToast(`Đã thêm «${name}» vào giỏ!`, 'success', 1800);
        } else {
          showToast(data.message || 'Không thể thêm vào giỏ', 'danger', 3000);
        }
      } catch (err) {
        console.error('Add to cart error:', err);
        showToast(err.message || 'Lỗi khi thêm món', 'danger', 3000);
      } finally {
        btn.disabled = false;
        btn.innerHTML = prevHtml;
      }
      return;
    }

    const rem = e.target.closest('.remove-from-dropdown');
    if (rem) {
      e.preventDefault();
      const id = rem.dataset.id;
      if (!confirm('Bạn muốn xóa món này?')) return;
      try {
        const response = await fetch(cartEndpoints.remove, {
          method: 'POST',
          headers: {'Content-Type':'application/json','X-CSRF-TOKEN': csrfToken,'X-Requested-With':'XMLHttpRequest'},
          body: JSON.stringify({id})
        });
        if (!response.ok) throw new Error('Lỗi server khi xóa');
        const data = await response.json();
        if (data.ok) {
          const dd = document.getElementById('cart-dropdown-content');
          if (dd) dd.innerHTML = data.dropdownHtml ?? '';
          const badge = document.getElementById('cart-count');
          if (badge) badge.innerText = data.count ?? 0;
          showToast('Đã xóa món', 'success', 1200);
        }
      } catch (err) {
        console.error(err);
        showToast('Lỗi xóa món', 'danger', 2000);
      }
      return;
    }
  });
})();

// Thêm hiệu ứng hover cho category filter
document.querySelectorAll('.category-filter-btn').forEach(btn => {
  btn.addEventListener('mouseenter', function() {
    if (!this.classList.contains('active')) {
      this.style.transform = 'translateY(-5px)';
    }
  });
  
  btn.addEventListener('mouseleave', function() {
    if (!this.classList.contains('active')) {
      this.style.transform = 'translateY(0)';
    }
  });
});

// Thêm hiệu ứng cho product cards
document.querySelectorAll('.menu-product-card').forEach(card => {
  card.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-15px)';
  });
  
  card.addEventListener('mouseleave', function() {
    this.style.transform = 'translateY(0)';
  });
});
</script>
@endpush