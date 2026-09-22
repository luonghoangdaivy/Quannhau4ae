@extends('master')

<style>
/* --- CARD SẢN PHẨM --- */
.product-card {
    border:1px solid #ddd;
    border-radius:10px;
    padding:12px;
    text-align:center;
    transition:0.25s;
    background:white;
}
.product-card:hover {
    transform: translateY(-4px);
    box-shadow:0 4px 15px rgba(0,0,0,0.12);
}
.product-card img {
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:10px;
}
.view-all {
    display:block;
    text-align:center;
    margin-top:25px;
    padding:10px 20px;
    background:#b91c1c;
    color:white;
    border-radius:10px;
    width:200px;
    margin-left:auto;
    margin-right:auto;
    font-weight:bold;
    text-decoration:none;
}
.view-all:hover { background:#9f1717; }

.grid-4 {
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

/* --- CƠ SỞ QUÁN --- */
.branch-grid {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-top:20px;
}
.branch-card {
    background:white;
    border-radius:12px;
    padding:15px;
    box-shadow:0 3px 10px rgba(0,0,0,0.12);
    transition:0.25s;
    text-align:center;
}
.branch-card:hover {
    transform: translateY(-5px);
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
}
.branch-card img {
    width:100%;
    height:160px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:10px;
}

/* --- KHUYẾN MÃI --- */
.sale-box {
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.12);
    margin-top:25px;
}
.sale-item {
    display:flex;
    gap:20px;
    margin-bottom:20px;
}
.sale-item img {
    width:160px;
    height:120px;
    object-fit:cover;
    border-radius:10px;
}
.sale-text h4 {
    margin:0;
    color:#b91c1c;
}
.sale-text p {
    margin:4px 0;
    font-size:15px;
}
</style>


@section('content')

<div class="container" style="padding:30px 0;">

    <!-- GIỚI THIỆU -->
    <div style="margin-bottom:35px; text-align:center;">
        <h2 style="color:#b91c1c; margin-bottom:10px;">🍻 Quán Nhậu 4 Anh Em – Đậm chất quán xưa</h2>
        <p style="max-width:700px; margin:0 auto; font-size:17px;">
            Không gian rộng – món ăn tươi – phục vụ nhanh – giá sinh viên.  
            Chúng tôi luôn đem đến trải nghiệm nhậu chill nhất cho bạn và hội bạn thân.
        </p>
    </div>

    <!-- CƠ SỞ QUÁN -->
    <h3 style="color:#b91c1c; margin-bottom:10px;">📍 Hệ thống cơ sở </h3>

    <div class="branch-grid">
        <div class="branch-card">
            <img src="{{ asset('source/images/branch1.jpg') }}">
            <h4>4 Anh Em - Cơ sở Nguyễn Văn Linh</h4>
            <p>Không gian 2 tầng – bàn ngoài trời – để xe thoải mái.</p>
        </div>

        <div class="branch-card">
            <img src="{{ asset('source/images/branch2.jpg') }}">
            <h4>4 Anh Em - Cơ sở Hà Huy Tập</h4>
            <p>Không gian trẻ trung – phù hợp đi nhóm bạn – mở cửa tới 1h sáng.</p>
        </div>

        <div class="branch-card">
            <img src="{{ asset('source/images/branch3.jpg') }}">
            <h4>4 Anh Em - Cơ sở Lê Duẩn</h4>
            <p>Chuyên hải sản – món nướng tẩm ướp đặc biệt – cực đông khách.</p>
        </div>
    </div>

    <!-- MÓN HOT -->
    <h3 style="color:#b91c1c; margin-top:40px;">🔥 Món Hot Hôm Nay</h3>

    <div class="grid-4" style="margin-top:20px;">
        
        @foreach($hotProducts as $item)
        <div class="product-card">
            <img src="{{ asset('source/images/'.$item->image) }}">
            <h4 style="margin-top:10px;">{{ $item->name }}</h4>
            <p style="color:#b91c1c; font-weight:bold;">{{ number_format($item->price) }}đ</p>
        </div>
        @endforeach
    </div>

    <!-- Xem thêm -->
    <a class="view-all" href="{{ auth()->check() ? url('/menu') : route('login') }}">
  Xem tất cả thực đơn
</a>

    <!-- ... Phần hiển thị sản phẩm hot của bạn ... -->

<!-- PHẦN KHUYẾN MÃI RANDOM - THÊM SAU SẢN PHẨM -->
<div class="random-promotions-section" style="margin: 60px 0; padding: 40px 20px; background: linear-gradient(135deg, #fff9e6 0%, #fff0cc 100%); border-radius: 20px;">
    <div class="section-header" style="text-align: center; margin-bottom: 40px;">
        <h2 style="color: #b91c1c; font-size: 32px; margin-bottom: 10px;">
            <span style="margin-right: 10px;">🎁</span>
            ƯU ĐÃI NGẪU NHIÊN HÔM NAY
        </h2>
        <p style="color: #7a0b0b; font-size: 16px; max-width: 600px; margin: 0 auto;">
            Khám phá các ưu đãi đặc biệt được chọn ngẫu nhiên cho bạn
        </p>
        
        <!-- Nút refresh -->
        <button onclick="refreshPromotions()" 
                style="margin-top: 20px; background: #ffcc33; color: #7a0b0b; border: none; 
                       padding: 12px 25px; border-radius: 25px; font-weight: bold; 
                       cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
                       transition: all 0.3s; font-size: 15px;"
                onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 5px 15px rgba(255,204,51,0.3)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <span>🔄</span>
            <span>Đổi ưu đãi khác</span>
        </button>
    </div>

    <!-- Grid khuyến mãi -->
    <div id="randomPromotions" class="promotions-grid" 
         style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
                gap: 30px; max-width: 1200px; margin: 0 auto;">
        
        @foreach($randomPromotions as $promo)
        <div class="promotion-card" 
             style="background: white; border-radius: 15px; overflow: hidden; 
                    box-shadow: 0 10px 30px rgba(122, 11, 11, 0.1); transition: all 0.3s; 
                    position: relative; border: 3px solid {{ $promo['badge'] == 'hot' ? '#ff3333' : ($promo['badge'] == 'new' ? '#33cc33' : '#ffcc33') }};
                    height: 100%;">
            
            @if($promo['badge'] == 'hot')
            <div style="position: absolute; top: 15px; right: 15px; background: #ff3333; color: white; 
                        padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; 
                        z-index: 2; animation: pulse 2s infinite;">
                HOT
            </div>
            @elseif($promo['badge'] == 'new')
            <div style="position: absolute; top: 15px; right: 15px; background: #33cc33; color: white; 
                        padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; z-index: 2;">
                MỚI
            </div>
            @endif

            <img src="{{ Str::startsWith($promo['image'], 'http') ? $promo['image'] : asset('source/images/' . $promo['image']) }}" 
                 alt="{{ $promo['title'] }}" 
                 style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.5s;"
                 onmouseover="this.style.transform='scale(1.05)'" 
                 onmouseout="this.style.transform='scale(1)'">
            
            <div style="padding: 25px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                    <span style="font-size: 28px;">{{ $promo['icon'] }}</span>
                    <h3 style="color: #7a0b0b; font-size: 20px; margin: 0; flex: 1;">
                        {{ $promo['title'] }}
                    </h3>
                </div>
                
                <p style="color: #666; font-size: 15px; line-height: 1.6; margin-bottom: 20px;">
                    {{ $promo['description'] }}
                </p>
                
                <div style="display: flex; justify-content: space-between; align-items: center; 
                            margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
                    <div style="font-size: 22px; color: #b91c1c; font-weight: bold;">
                        {{ $promo['price'] }}
                    </div>
                    <a href="{{ $promo['link'] }}" 
                       style="background: linear-gradient(45deg, #7a0b0b, #b91c1c); color: white; 
                              padding: 10px 25px; border-radius: 20px; text-decoration: none; 
                              font-weight: bold; transition: all 0.3s; display: inline-flex; 
                              align-items: center; gap: 8px;"
                       onmouseover="this.style.transform='translateX(5px)'; this.style.background='linear-gradient(45deg, #b91c1c, #7a0b0b)'"
                       onmouseout="this.style.transform='translateX(0)'; this.style.background='linear-gradient(45deg, #7a0b0b, #b91c1c)'">
                        <span>👉</span>
                        <span>Xem chi tiết</span>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Link đến trang khuyến mãi đầy đủ -->
    <div style="text-align: center; margin-top: 50px;">
        <a href="{{ route('promotions.index') ?? '#' }}" 
           style="display: inline-flex; align-items: center; gap: 12px; 
                  background: #ffcc33; color: #7a0b0b; padding: 15px 35px; 
                  border-radius: 25px; text-decoration: none; font-weight: bold;
                  font-size: 17px; transition: all 0.3s; border: 2px solid #ff9900;"
           onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(255,204,51,0.4)'"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
            <span>🎯</span>
            <span>Xem tất cả {{ count($randomPromotions) }}/10 ưu đãi đặc biệt</span>
            <span style="font-size: 20px;">→</span>
        </a>
    </div>
</div>

<!-- Thêm CSS animation -->
<style>
@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.promotion-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(122, 11, 11, 0.2);
}
</style>

<!-- Thêm JavaScript -->
<script>
function refreshPromotions() {
    const grid = document.getElementById('randomPromotions');
    const button = event.currentTarget;
    
    // Hiệu ứng loading
    grid.style.opacity = '0.5';
    button.innerHTML = '<span>⏳</span><span>Đang tải...</span>';
    button.disabled = true;
    
    // Gọi AJAX
    fetch('/refresh-promotions')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật HTML
                grid.innerHTML = data.html;
                
                // Hiệu ứng xuất hiện
                grid.style.opacity = '0';
                grid.style.transform = 'scale(0.9)';
                
                setTimeout(() => {
                    grid.style.opacity = '1';
                    grid.style.transform = 'scale(1)';
                }, 50);
                
                // Cập nhật số lượng trong link
                const allLink = document.querySelector('.promotions-section a');
                if (allLink) {
                    allLink.querySelector('span:nth-child(2)').textContent = 
                        `Xem tất cả ${data.count}/10 ưu đãi đặc biệt`;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi tải ưu đãi mới');
        })
        .finally(() => {
            // Khôi phục nút
            setTimeout(() => {
                button.innerHTML = '<span>🔄</span><span>Đổi ưu đãi khác</span>';
                button.disabled = false;
                grid.style.opacity = '1';
            }, 500);
        });
}

// Tự động refresh sau 30 phút
setTimeout(() => {
    if (confirm('Đã 30 phút! Bạn có muốn xem ưu đãi mới không?')) {
        refreshPromotions();
    }
}, 30 * 60 * 1000);
</script>

<!-- ... Phần còn lại của trang chủ ... -->
</div>

@endsection
