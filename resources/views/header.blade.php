<header class="bar-header header-premium">

    {{-- RIBBON TRANG TRÍ --}}
    <div class="header-ribbon">
        <div class="ribbon-content">
            <span class="ribbon-icon">🎊</span>
            <span class="ribbon-text">KHAI TRƯƠNG - GIẢM 20% HÓA ĐƠN TRÊN 500K</span>
            <span class="ribbon-icon">🎊</span>
        </div>
    </div>

    {{-- LOGO VÀ THÔNG TIN --}}
    <div class="logo-section">
        <div class="logo-container">
            <img src="{{ asset('source/images/logo.jpg') }}" alt="Logo Quán Nhậu" class="logo-big">
            <div class="logo-decoration">
                <span class="deco-item deco-1">🍺</span>
                <span class="deco-item deco-2">🍢</span>
                <span class="deco-item deco-3">🦐</span>
            </div>
            <div class="logo-badge">MỚI</div>
        </div>
        
        <div class="brand-info">
            <h1 class="slogan">Quán Nhậu 4 Anh Em</h1>
            <p class="slogan-sub">"Rượu ngon bạn hiền - Vui không giới hạn"</p>
            <div class="brand-rating">
                <span class="stars">★★★★★</span>
                <span class="rating-text">4.8/5 (128 đánh giá)</span>
            </div>
        </div>
    </div>

    {{-- THÔNG TIN LIÊN HỆ --}}
    <div class="contact-bar">
        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-icon">📞</div>
                <div class="contact-details">
                    <div class="contact-label">Hotline</div>
                    <div class="contact-value">0909 888 999</div>
                </div>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">🕒</div>
                <div class="contact-details">
                    <div class="contact-label">Giờ mở cửa</div>
                    <div class="contact-value">16:00 - 23:30</div>
                </div>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">📍</div>
                <div class="contact-details">
                    <div class="contact-label">Địa chỉ</div>
                    <div class="contact-value">123 Đường Ẩm Thực, Q1</div>
                </div>
            </div>
        </div>
    </div>

    {{-- MENU CHÍNH --}}
    <nav class="main-nav nav-enhanced">
        <a href="{{ route('trangchu') }}" class="nav-link">
            <div class="nav-box">
                <span class="nav-symbol">🏠</span>
                <span class="nav-label">Trang chủ</span>
            </div>
        </a>
        
        <a href="{{ route('menu.index') }}" class="nav-link">
            <div class="nav-box">
                <span class="nav-symbol">📋</span>
                <span class="nav-label">Thực đơn</span>
                <span class="nav-badge hot">HOT</span>
            </div>
        </a>
        
        <a href="{{ route('reservation.create') }}" class="nav-link">
            <div class="nav-box">
                <span class="nav-symbol">📅</span>
                <span class="nav-label">Đặt bàn</span>
                <span class="nav-badge new">NEW</span>
            </div>
        </a>
        
        <a href="khuyen-mai" class="nav-link">
            <div class="nav-box">
                <span class="nav-symbol">🎯</span>
                <span class="nav-label">Khuyến mãi</span>
            </div>
        </a>
        
        <a href="#" class="nav-link">
            <div class="nav-box">
                <span class="nav-symbol">📞</span>
                <span class="nav-label">Liên hệ</span>
            </div>
        </a>
    </nav>

    {{-- ACTION BAR (TÌM KIẾM) --}}
    <div class="action-bar">
        {{-- TÌM KIẾM NÂNG CAO --}}
        <div class="search-container">
            <form class="search-form" action="{{ route('menu.search') }}" method="get">
                <div class="search-wrapper">
                    <input type="text" placeholder="Tìm món ăn, thức uống..." name="q" value="{{ request('q') }}">
                    <button type="submit" class="search-button">
                        <span class="search-icon">🔍</span>
                        <span class="search-text">Tìm kiếm</span>
                    </button>
                </div>
                <div class="search-quick">
                    <span class="quick-label">Tìm nhanh:</span>
                    <button type="button" class="quick-tag" data-search="Bia Tiger">Bia</button>
                    <button type="button" class="quick-tag" data-search="Heo nướng">Nướng</button>
                    <button type="button" class="quick-tag" data-search="Lẩu Thái">Lẩu</button>
                    <button type="button" class="quick-tag" data-search="Tôm hùm">Hải sản</button>
                </div>
            </form>
        </div>

       
    </div>

    {{-- KHU VỰC ĐĂNG KÝ / ĐĂNG NHẬP (NẾU CHƯA ĐĂNG NHẬP) --}}
    @guest
    <div class="auth-btns">
        <a href="{{ route('register.form') }}" class="auth reg">
            <span class="btn-icon">👤</span>
            <span>Đăng Ký</span>
        </a>
        <a href="{{ route('login.form') }}" class="auth login">
            <span class="btn-icon">🔐</span>
            <span>Đăng nhập</span>
        </a>
    </div>
    @endguest

    {{-- USER DROPDOWN GÓC PHẢI MÀN HÌNH (ĐÃ ĐĂNG NHẬP) - PHIÊN BẢN MỚI ĐẸP HƠN --}}
    @auth
    <div class="user-dropdown-enhanced">
        <div class="user-display" onclick="toggleUserMenu()">
            <div class="user-avatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-status">
                    <span class="status-dot"></span>
                    <span class="status-text">Đang hoạt động</span>
                </div>
            </div>
            <div class="dropdown-arrow">▼</div>
        </div>

        <div id="userMenu" class="user-menu">
            <div class="menu-header">
                <div class="menu-user">
                    <strong>{{ Auth::user()->name }}</strong>
                    <small>{{ Auth::user()->email }}</small>
                </div>
            </div>
            
            <a href="{{ route('profile.index') }}" class="menu-item">
                <span class="menu-icon">👤</span>
                <span class="menu-text">Thông tin cá nhân</span>
            </a>
            
            <a href="{{ route('change.password') }}" class="menu-item">
                <span class="menu-icon">🔒</span>
                <span class="menu-text">Đổi mật khẩu</span>
            </a>
            
           
            
            <div class="menu-divider"></div>
            
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="menu-item logout">
                <span class="menu-icon">🚪</span>
                <span class="menu-text">Đăng xuất</span>
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="get" style="display:none;"></form>
    </div>
    @endauth

    {{-- THÔNG BÁO ĐẶC BIỆT --}}
    <div class="special-notice">
        <div class="notice-content">
            <span class="notice-icon">🔥</span>
            <span class="notice-message">ĐẶT BÀN TRƯỚC 18:00 - TẶNG NGAY 1 BIA TIGER</span>
            <span class="notice-icon">🍺</span>
        </div>
        <div class="notice-timer">
            <span class="timer-text">Ưu đãi còn lại:</span>
            <span class="timer-count">02:15:30</span>
        </div>
    </div>

</header>

<style>
/* ========== CSS MỚI - KHÔNG CHẠM VÀO CLASS CŨ ========== */

/* Header premium */
.header-premium {
    position: relative;
    overflow: hidden;
}

/* Ribbon trên cùng */
.header-ribbon {
    background: linear-gradient(90deg, #ffcc33, #ff9900, #ffcc33);
    color: #7a0b0b;
    padding: 8px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.ribbon-content {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    animation: slideRibbon 20s linear infinite;
}

@keyframes slideRibbon {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}

.ribbon-icon {
    font-size: 16px;
    animation: bounce 2s infinite;
}

.ribbon-text {
    font-weight: bold;
    font-size: 15px;
    letter-spacing: 1px;
}

/* Logo section */
.logo-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.logo-container {
    position: relative;
    display: inline-block;
}

.logo-decoration {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}

.deco-item {
    position: absolute;
    font-size: 20px;
    opacity: 0.8;
    animation: floatItem 3s ease-in-out infinite;
}

.deco-1 {
    top: -15px;
    right: -15px;
    animation-delay: 0s;
}

.deco-2 {
    bottom: -10px;
    left: -20px;
    animation-delay: 0.5s;
}

.deco-3 {
    top: -10px;
    left: -15px;
    animation-delay: 1s;
}

@keyframes floatItem {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(10deg); }
}

.logo-badge {
    position: absolute;
    bottom: 10px;
    right: -10px;
    background: #ff3333;
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: bold;
    transform: rotate(-5deg);
    animation: badgeGlow 2s infinite;
}

@keyframes badgeGlow {
    0%, 100% { box-shadow: 0 0 5px #ff3333; }
    50% { box-shadow: 0 0 15px #ff3333; }
}

.brand-info {
    text-align: center;
}

.brand-rating {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 5px;
}

.stars {
    color: #ffcc33;
    font-size: 16px;
    letter-spacing: 2px;
}

.rating-text {
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px;
}

/* Contact bar */
.contact-bar {
    margin: 15px 0;
}

.contact-grid {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.contact-card {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255, 255, 255, 0.1);
    padding: 10px 20px;
    border-radius: 10px;
    border: 1px solid rgba(255, 204, 51, 0.3);
    transition: all 0.3s;
    min-width: 180px;
}

.contact-card:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.contact-icon {
    font-size: 22px;
    background: #ffcc33;
    color: #7a0b0b;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.contact-details {
    text-align: left;
}

.contact-label {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 3px;
}

.contact-value {
    font-weight: bold;
    font-size: 14px;
}

/* Enhanced navigation */
.nav-enhanced {
    position: relative;
    margin-top: 20px !important;
}

.nav-link {
    position: relative;
    text-decoration: none !important;
}

.nav-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    padding: 10px 15px;
    border-radius: 10px;
    transition: all 0.3s;
    position: relative;
}

.nav-box:hover {
    background: rgba(255, 204, 51, 0.1);
    transform: translateY(-5px);
}

.nav-symbol {
    font-size: 24px;
    transition: transform 0.3s;
}

.nav-box:hover .nav-symbol {
    transform: scale(1.2);
}

.nav-label {
    font-size: 14px;
    font-weight: bold;
}

.nav-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    color: white;
    font-weight: bold;
}

.nav-badge.hot {
    background: #ff3333;
    animation: pulseRed 1.5s infinite;
}

.nav-badge.new {
    background: #33cc33;
    animation: pulseGreen 1.5s infinite;
}

@keyframes pulseRed {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes pulseGreen {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Action bar */
.action-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 25px;
    width: 100%;
}

.search-container {
    flex: 1;
    max-width: 700px;
}

.search-wrapper {
    display: flex;
    background: white;
    border-radius: 25px;
    overflow: hidden;
    border: 2px solid #ffcc33;
    box-shadow: 0 5px 20px rgba(255, 204, 51, 0.3);
}

.search-wrapper input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    font-size: 16px;
    outline: none;
}

.search-button {
    background: linear-gradient(45deg, #7a0b0b, #b91c1c);
    color: white;
    border: none;
    padding: 0 25px;
    cursor: pointer;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.search-button:hover {
    background: linear-gradient(45deg, #b91c1c, #7a0b0b);
    padding: 0 30px;
}

.search-icon {
    font-size: 16px;
}

.search-text {
    font-size: 16px;
}

.search-quick {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
    justify-content: center;
    flex-wrap: wrap;
}

.quick-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 13px;
}

.quick-tag {
    background: rgba(255, 204, 51, 0.2);
    color: #ffcc33;
    border: 1px solid #ffcc33;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s;
}

.quick-tag:hover {
    background: #ffcc33;
    color: #7a0b0b;
    transform: translateY(-2px);
}

/* Cart button */
.cart-button {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: #ffcc33;
    color: #7a0b0b;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s;
}

.cart-button:hover {
    background: #ff9900;
    transform: rotate(15deg) scale(1.1);
}

.cart-icon {
    font-size: 22px;
}

.cart-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff3333;
    color: white;
    font-size: 12px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    animation: cartPulse 2s infinite;
}

@keyframes cartPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Cải thiện nút đăng nhập/đăng ký */
.auth-btns {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 22px;
}

.auth-btns .auth {
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-icon {
    font-size: 16px;
}

/* USER DROPDOWN GÓC PHẢI - PHIÊN BẢN MỚI */
.user-dropdown-enhanced {
    position: absolute;
    top: 20px;
    right: 35px;
    z-index: 1000;
    cursor: pointer;
}

.user-display {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 15px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 25px;
    transition: all 0.3s;
    min-width: 200px;
    border: 1px solid rgba(255, 204, 51, 0.3);
}

.user-display:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, #ffcc33, #ff9900);
    color: #7a0b0b;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
}

.user-info {
    flex: 1;
    text-align: left;
}

.user-name {
    font-weight: bold;
    font-size: 14px;
    color: white;
}

.user-status {
    display: flex;
    align-items: center;
    gap: 5px;
}

.status-dot {
    width: 8px;
    height: 8px;
    background: #33cc33;
    border-radius: 50%;
    animation: statusPulse 2s infinite;
}

@keyframes statusPulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.status-text {
    font-size: 11px;
    color: rgba(255, 255, 255, 0.7);
}

.dropdown-arrow {
    font-size: 10px;
    color: #ffcc33;
    transition: transform 0.3s;
}

.user-display:hover .dropdown-arrow {
    transform: rotate(180deg);
}

/* User menu dropdown */
.user-menu {
    display: none;
    position: absolute;
    right: 0;
    top: calc(100% + 10px);
    background: #7a0b0b;
    border-radius: 10px;
    min-width: 250px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid #ffcc33;
    z-index: 1000;
    overflow: hidden;
}

.menu-header {
    padding: 15px;
    background: rgba(0, 0, 0, 0.2);
    border-bottom: 1px solid rgba(255, 204, 51, 0.3);
}

.menu-user {
    text-align: left;
}

.menu-user strong {
    display: block;
    font-size: 14px;
    color: white;
}

.menu-user small {
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    color: white;
    text-decoration: none;
    transition: all 0.2s;
    border-left: 3px solid transparent;
}

.menu-item:hover {
    background: #b91c1c;
    border-left-color: #ffcc33;
    padding-left: 20px;
}

.menu-item.logout {
    color: #ffcc33;
}

.menu-icon {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.menu-text {
    font-size: 14px;
}

.menu-divider {
    height: 1px;
    background: rgba(255, 204, 51, 0.3);
    margin: 5px 15px;
}

/* Special notice */
.special-notice {
    background: linear-gradient(90deg, rgba(255,51,51,0.2), rgba(255,204,51,0.2));
    border: 2px solid #ffcc33;
    border-radius: 15px;
    padding: 12px 25px;
    margin-top: 20px;
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    animation: noticeGlow 3s infinite;
}

@keyframes noticeGlow {
    0%, 100% { box-shadow: 0 0 10px rgba(255,204,51,0.3); }
    50% { box-shadow: 0 0 20px rgba(255,204,51,0.6); }
}

.notice-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.notice-icon {
    font-size: 18px;
    animation: bounce 1s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

.notice-message {
    color: #ffcc33;
    font-weight: bold;
    font-size: 15px;
}

.notice-timer {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ĐÈ LÊN MỌI STYLE KHÁC */
.user-dropdown, 
.user-name, 
.dropdown-content,
.user-dropdown * {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    position: absolute !important;
    left: -9999px !important;
}

/* CHỈ HIỆN PHẦN MỚI */
.user-dropdown-enhanced {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: absolute !important;
    top: 20px !important;
    right: 35px !important;
}

.timer-text {
    color: rgba(255, 255, 255, 0.8);
    font-size: 12px;
}

.timer-count {
    background: rgba(0, 0, 0, 0.3);
    color: #ff3333;
    font-family: monospace;
    font-weight: bold;
    padding: 4px 10px;
    border-radius: 5px;
    font-size: 14px;
    letter-spacing: 2px;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 1024px) {
    .contact-grid {
        gap: 15px;
    }
    
    .contact-card {
        min-width: 150px;
        padding: 8px 15px;
    }
    
    .nav-box {
        padding: 8px 12px;
    }
    
    .user-dropdown-enhanced {
        right: 20px;
    }
}

@media (max-width: 768px) {
    .ribbon-text {
        font-size: 13px;
    }
    
    .logo-decoration {
        display: none;
    }
    
    .contact-grid {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    
    .contact-card {
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
    
    .nav-enhanced {
        flex-wrap: wrap;
        gap: 10px !important;
    }
    
    .nav-box {
        padding: 6px 10px;
    }
    
    .nav-symbol {
        font-size: 20px;
    }
    
    .nav-label {
        font-size: 12px;
    }
    
    .action-bar {
        flex-direction: column;
        gap: 15px;
    }
    
    .search-wrapper {
        flex-direction: column;
        border-radius: 15px;
    }
    
    .search-wrapper input {
        padding: 12px 15px;
    }
    
    .search-button {
        padding: 12px 15px;
        justify-content: center;
    }
    
    .user-dropdown-enhanced {
        position: static;
        margin: 15px auto;
        width: 90%;
    }
    
    .user-display {
        min-width: auto;
        width: 100%;
        justify-content: center;
    }
    
    .special-notice {
        padding: 10px 15px;
        text-align: center;
    }
    
    .notice-content {
        flex-direction: column;
        gap: 8px;
    }
    
    .notice-message {
        font-size: 13px;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .logo-big {
        width: 180px !important;
    }
    
    .slogan {
        font-size: 24px !important;
    }
    
    .slogan-sub {
        font-size: 12px;
    }
    
    .brand-rating {
        flex-direction: column;
        gap: 5px;
    }
    
    .nav-box {
        padding: 5px 8px;
        min-width: 70px;
    }
    
    .user-display {
        flex-direction: column;
        text-align: center;
        gap: 8px;
    }
    
    .user-info {
        text-align: center;
    }
    
    .auth-btns {
        flex-direction: column;
        align-items: center;
    }
}

/* ========== GIỮ NGUYÊN CSS CŨ CỦA BẠN ========== */
.bar-header {
    background: linear-gradient(180deg, #7a0b0b, #b91c1c);
    padding: 40px 0 50px 0;
    color: #fff;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.logo-big {
    width: 240px;
    height: auto;
    border-radius: 10px;
    filter: drop-shadow(0 0 15px rgba(255,204,51,0.9));
    transition: 0.4s;
}

.logo-big:hover {
    transform: scale(1.08);
}

.slogan {
    font-size: 32px;
    font-weight: bold;
    letter-spacing: 2px;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
    margin: 0;
}

.main-nav {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    gap: 35px;
}

.main-nav a {
    color: #fff;
    font-weight: bold;
    text-decoration: none;
    font-size: 20px;
    padding-bottom: 4px;
    position: relative;
    transition: 0.3s;
}

.main-nav a::after {
    content: "";
    position: absolute;
    width: 0;
    height: 3px;
    left: 0;
    bottom: 0;
    background: #ffcc33;
    transition: width .3s;
}

.main-nav a:hover {
    color: #ffcc33;
    text-shadow: 0 0 10px #ffcc33;
}

.main-nav a:hover::after {
    width: 100%;
}

.auth-btns {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 22px;
}

.auth {
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;
    border: 2px solid transparent;
    font-size: 18px;
    transition: 0.3s;
}

.reg {
    background: #ffcc33;
    color: #7a0b0b;
}
.reg:hover {
    background: #ff9900;
    color: #fff;
}

.login {
    border: 2px solid #ffcc33;
}
.login:hover {
    background: #ffcc33;
    color: #7a0b0b;
}

.search-form {
    display: flex;
    max-width: 600px;
    margin: 28px auto 0 auto;
    border: 2px solid #ffcc33;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(255,204,51,0.7);
}

.search-form input {
    flex: 1;
    padding: 15px 18px;
    border: none;
    font-size: 18px;
    outline: none;
}

.search-form button {
    padding: 15px 25px;
    border: none;
    background: #ffcc33;
    color: #7a0b0b;
    cursor: pointer;
    font-size: 20px;
    transition: 0.3s;
}

.search-form button:hover {
    background: #ff9900;
    color: #fff;
}

@media (max-width: 850px) {
    .logo-big { width: 170px; }
    .slogan { font-size: 24px; }
    .main-nav { flex-wrap: wrap; gap: 15px; }
    .auth-btns { flex-wrap: wrap; }
}

/* XÓA CSS CŨ CỦA USER DROPDOWN */
/* .user-dropdown, .user-name, .dropdown-content - đã bị xóa */
</style>

<script>
function toggleUserMenu() {
    let menu = document.getElementById("userMenu");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

// Close menu when clicking outside
document.addEventListener("click", function(e) {
    if (!e.target.closest('.user-dropdown-enhanced')) {
        let menu = document.getElementById("userMenu");
        if (menu) menu.style.display = "none";
    }
});

// Quick search tags
document.querySelectorAll('.quick-tag').forEach(button => {
    button.addEventListener('click', function() {
        const searchTerm = this.getAttribute('data-search');
        const searchInput = document.querySelector('.search-form input[name="q"]');
        searchInput.value = searchTerm;
        searchInput.focus();
    });
});

// Timer countdown (example)
function updateTimer() {
    const timerElement = document.querySelector('.timer-count');
    if (timerElement) {
        // You can implement actual countdown logic here
        // For now, just show static time
        timerElement.textContent = "02:15:30";
    }
}

// Update timer every second
setInterval(updateTimer, 1000);

// Cart button animation
const cartButton = document.querySelector('.cart-button');
if (cartButton) {
    cartButton.addEventListener('click', function(e) {
        e.preventDefault();
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = '';
        }, 200);
    });
}

// Smooth hover effects for nav items
document.querySelectorAll('.nav-box').forEach(box => {
    box.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
    });
    
    box.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// User dropdown hover effect
const userDisplay = document.querySelector('.user-display');
if (userDisplay) {
    userDisplay.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
    });
    
    userDisplay.addEventListener('mouseleave', function() {
        if (document.getElementById('userMenu').style.display !== 'block') {
            this.style.transform = 'translateY(0)';
        }
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateTimer();
});
</script>