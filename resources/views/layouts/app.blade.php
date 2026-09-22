<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Quán nhậu')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

  @stack('styles')
  <style>
    /* Custom styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }
    
    /* nhỏ: đảm bảo dropdown menu hiển thị đẹp */
    .cart-dropdown { min-width: 320px; max-width: 420px; }
    .cart-dropdown .list-group-item img { width:48px; height:48px; object-fit:cover; border-radius:6px; }
    
    /* Breadcrumb styling */
    .breadcrumb {
      background-color: transparent;
      padding: 0.75rem 0;
      margin-bottom: 1rem;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
      content: "›";
      color: #6c757d;
      padding: 0 0.5rem;
    }
    
    .breadcrumb-item a {
      color: #0d6efd;
      text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
      text-decoration: underline;
    }
    
    /* Custom toast styling */
    .custom-toast-container {
      z-index: 9999;
    }
    
    /* Product card hover effects */
    .product-card-hover:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    /* Navbar styling */
    .navbar-brand {
      font-weight: 700;
      color: #b91c1c !important;
      font-size: 1.5rem;
    }
    
    /* Footer margin fix */
    main {
      min-height: calc(100vh - 200px);
    }
    
    /* Quantity input styling */
    .quantity-input-group {
      max-width: 150px;
    }
    
    .quantity-input-group .btn {
      width: 40px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .cart-dropdown {
        min-width: 280px;
      }
      
      .search-form-nav {
        width: 100%;
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">Quán Nhậu 4 Anh Em</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('trangchu') ? 'active' : '' }}" href="{{ route('trangchu') }}">Trang chủ</a>
        </li>
        <li class="nav-item">
<a class="nav-link {{ request()->is('menu*') ? 'active' : '' }}" href="{{ url('/menu.index') }}">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="bi bi-tag-fill text-danger me-1"></i> Khuyến mãi</a>
        </li>
      </ul>

      <!-- RIGHT SIDE: cart dropdown + optional links -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <li class="nav-item me-3 d-none d-lg-block">
          <!-- small search in navbar -->
          <form action="{{ route('menu.search') }}" method="GET" class="d-flex search-form-nav">
            <input name="q" value="{{ request('q') }}" class="form-control form-control-sm me-2" placeholder="Tìm món..." style="width:220px;">
            <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
          </form>
        </li>

        <!-- Auth links -->
        @auth
          <li class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Tài khoản</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Đăng xuất</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item me-3">
            <a class="nav-link" href="{{ route('login.form') }}"><i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập</a>
          </li>
          <li class="nav-item me-3">
            <a class="nav-link" href="{{ route('register.form') }}"><i class="bi bi-person-plus me-1"></i> Đăng ký</a>
          </li>
        @endauth

        <!-- Cart dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link position-relative" href="#" id="cartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-cart3 fs-5"></i>
            <span class="badge bg-danger ms-1" id="cart-count">0</span>
          </a>

          <div class="dropdown-menu dropdown-menu-end p-0 cart-dropdown" aria-labelledby="cartDropdown">
            <div id="cart-dropdown-content" class="p-0">
              <!-- content loaded by AJAX -->
              <div class="p-3 text-center">
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <span class="ms-2">Đang tải giỏ hàng...</span>
              </div>
            </div>
          </div>
        </li>
      </ul>
</div>
  </div>
</nav>

<main class="py-3">
  <div class="container">
    @yield('content')
  </div>
</main>

<!-- Footer -->
<footer class="pro-footer">
    <div class="footer-container">

        <!-- CỘT 1 -->
        <div class="footer-column">
            <h3>Quán Nhậu 4 Anh Em</h3>
            <p>Quán nhậu bình dân – hải sản – lẩu – nướng, không gian rộng rãi, phù hợp họp nhóm và gia đình.</p>

            <p><strong>Địa chỉ:</strong> 123 Nguyễn Văn Linh, Thanh Khê, Đà Nẵng</p>
            <p><strong>Hotline:</strong> <a href="tel:0901234567">0901 234 567</a></p>
            <p><strong>Email:</strong> <a href="mailto:info@4anhem.com">info@4anhem.com</a></p>
        </div>

        <!-- CỘT 2 -->
        <div class="footer-column">
            <h3>Giờ mở cửa</h3>
            <p>Thứ 2 – Chủ Nhật</p>
            <p><strong>15:00 – 00:00</strong></p>

            <h3 style="margin-top:15px;">Menu nhanh</h3>
            <ul>
                <li><a href="#">Hải sản</a></li>
                <li><a href="#">Món nướng</a></li>
                <li><a href="#">Món lẩu</a></li>
                <li><a href="#">Đồ nhậu bình dân</a></li>
            </ul>
        </div>

        <!-- CỘT 3 -->
        <div class="footer-column">
            <h3>Kết nối với chúng tôi</h3>
            <div class="footer-social">
                <a href="#">📘 Facebook</a><br>
                <a href="#">📸 Instagram</a><br>
                <a href="#">🎵 TikTok</a>
            </div>

            <h3 style="margin-top:15px;">Đặt bàn nhanh</h3>
            <p>Gọi ngay hotline hoặc đặt bàn online để giữ chỗ giờ cao điểm.</p>
            <a href="#" class="reserve-btn">Đặt bàn ngay</a>
        </div>

    </div>

    <div class="footer-bottom">
        © 2025 Quán Nhậu 4 Anh Em — All Rights Reserved
    </div>
</footer>


<style>
.pro-footer {
    background: linear-gradient(90deg, #111827, #1f2937);
    color: #fff;
    padding: 40px 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: auto;
    gap: 30px;
}

.footer-column {
    flex: 1;
    min-width: 250px;
}

.footer-column h3 {
    font-size: 22px;
    margin-bottom: 10px;
    color: #ffcc33;
    text-shadow: 0 0 5px #000;
}

.footer-column p {
    font-size: 15px;
    line-height: 1.6;
    margin: 6px 0;
}

.footer-column ul {
    list-style: none;
    padding: 0;
}

.footer-column ul li {
    margin: 6px 0;
}

.footer-column a {
    color: #ffcc33;
    text-decoration: none;
    transition: 0.3s;
}

.footer-column a:hover {
    color: #ff9900;
    text-shadow: 0 0 6px #ffcc33;
}

.footer-social a {
    display: inline-block;
    margin: 5px 0;
    font-size: 17px;
}

.reserve-btn {
    display: inline-block;
    margin-top: 8px;
    padding: 8px 15px;
    background: #ffcc33;
    color: #000;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: 0.3s;
}

.reserve-btn:hover {
    background: #ff9900;
    transform: scale(1.05);
}

.footer-bottom {
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
    color: #bbb;
}
</style>


<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

<script>
/*
  Layout JS for cart:
  - expects these named routes (adjust if your routes differ):
      route('cart.add')        -> POST (JSON)
      route('cart.dropdown')   -> GET (returns dropdown HTML)
      route('cart.update')     -> POST (JSON)
      route('cart.remove')     -> POST (JSON)
  - If you used different route names, replace route(...) strings below.
*/

const cartEndpoints = {
  add: "{{ route('cart.add') }}",
  dropdown: "{{ route('cart.dropdown') }}",
  update: "{{ route('cart.update') }}",
  remove: "{{ route('cart.remove') }}",
  checkout: "{{ route('cart.checkout') }}",
};

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Load dropdown content and update badge count
async function fetchDropdownAndUpdateBadge() {
  try {
    const res = await fetch(cartEndpoints.dropdown, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
    const html = await res.text();
    document.getElementById('cart-dropdown-content').innerHTML = html;
// Update badge count from server-rendered dropdown: look for list items and sum quantities
    let count = 0;
    document.querySelectorAll('#cart-dropdown-content .list-group-item').forEach(li=>{
      const small = li.querySelector('.small.text-muted');
      if (small) {
        const m = small.textContent.match(/x(\d+)/);
        if (m) count += parseInt(m[1]);
      }
    });
    document.getElementById('cart-count').innerText = count;
  } catch (e) {
    console.error('Error loading cart dropdown:', e);
    document.getElementById('cart-dropdown-content').innerHTML = 
      '<div class="p-3 text-danger">Lỗi tải giỏ hàng</div>';
  }
}

// On page load, populate dropdown and badge
document.addEventListener('DOMContentLoaded', function(){
  fetchDropdownAndUpdateBadge();
});

// Delegate click to handle remove buttons inside dropdown
document.addEventListener('click', async function(ev){
  // remove inside dropdown
  const removeBtn = ev.target.closest('.remove-from-dropdown');
  if (removeBtn) {
    ev.preventDefault();
    const id = removeBtn.dataset.id;
   // if (!confirm('Xóa món này khỏi giỏ?')) return;
    try {
      const res = await fetch(cartEndpoints.remove, {
        method: 'POST',
        headers: {'Content-Type':'application/json','X-CSRF-TOKEN': csrfToken, 'X-Requested-With': 'XMLHttpRequest'},
        body: JSON.stringify({ id })
      });
      const data = await res.json();
      if (data.ok) {
        // replace dropdown content with server HTML and update badge
        document.getElementById('cart-dropdown-content').innerHTML = data.dropdownHtml || '';
        document.getElementById('cart-count').innerText = data.count ?? 0;
        
        // Show success toast
        //showToast('Đã xóa món khỏi giỏ hàng', 'success');
      } else {
      //  showToast('Xóa thất bại', 'danger');
      }
    } catch(err){ 
      console.error(err); 
      showToast('Lỗi xóa món', 'danger');
    }
  }
});

// Helper function to show toast messages
function showToast(message, type = 'success') {
  const toastContainer = document.createElement('div');
  toastContainer.className = 'position-fixed bottom-0 end-0 p-3 toast-global';
  toastContainer.style.zIndex = '9999';
  
  const toastId = 'global-toast-' + Date.now();
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
</script>
</body>
</html>