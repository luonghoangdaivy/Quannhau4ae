<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quán Nhậu 4 Anh Em</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* VÙNG HIỂN THỊ USER (góc phải) */
        .user-info {
            position: fixed;
            top: 18px;
            right: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(0, 0, 0, 0.35);
            padding: 8px 12px;
            border-radius: 12px;
            backdrop-filter: blur(4px);
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
            z-index: 2000;
            cursor: default;
        }

        .user-info .user-name {
            color: #ffcc33;
            font-weight: bold;
            user-select: none;
        }

        /* Dropdown */
        .user-info .user-dropdown {
            position: relative;
        }

        .user-info .user-dropdown .dd-toggle {
            display: inline-block;
            padding: 2px 6px;
        }

        .user-info .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            background: #7a0b0b;
            color: #fff;
            padding: 8px 0;
            border-radius: 8px;
            min-width: 190px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.35);
            border: 1px solid rgba(255,204,51,0.15);
            z-index: 3000;
        }

        .user-info .dropdown-menu a {
            display: block;
            padding: 10px 14px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }

        .user-info .dropdown-menu a:hover {
            background: #ffcc33;
            color: #7a0b0b;
        }

        /* nhỏ cho điện thoại */
        @media (max-width: 600px) {
            .user-info { right: 10px; top: 10px; padding: 6px 8px; }
            .user-info .dropdown-menu { right: -10px; min-width: 150px; }
        }
    </style>
</head>
<body style="margin:0; background:#f7f7f7;">

    {{-- HIỂN THỊ TÊN USER KHI ĐÃ LOGIN --}}
    @auth
    <div class="user-info" id="userInfo">
        <div class="user-dropdown">
            <span class="user-name dd-toggle" id="ddToggle">👤 {{ Auth::user()->name }}</span>

            <div class="dropdown-menu" id="ddMenu" role="menu" aria-hidden="true">
                {{-- Link dẫn tới trang profile (nơi có thông tin + form đổi mật khẩu) --}}
                <a href="{{ route('profile.index') }}">Thông tin người dùng</a>

                {{-- Nếu bạn có route riêng cho đổi mật khẩu, đổi href tương ứng --}}
                <a href="{{ route('profile.index') }}#change-password">Đổi mật khẩu</a>

                {{-- Đăng xuất: form sẽ submit để tránh link GET/POST lẫn lộn.
                    Nếu route logout là GET (như project của bạn), form method GET OK.
                    Nếu route logout dùng POST, đổi method thành POST và thêm @csrf --}}
                <a href="#" id="logoutLink">Đăng xuất</a>

                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display:none;">
                    {{-- Nếu route logout là POST, thay method và thêm @csrf --}}
                </form>
            </div>
        </div>
    </div>
    @endauth

    {{-- INCLUDE HEADER --}}
    @include('header')

    <div class="container" style="max-width:1200px; margin:auto; padding:20px;">
        @yield('content')
    </div>

    @include('footer')

    {{-- SCRIPTS --}}
    <script>
        (function(){
            // Toggle dropdown on click
            const toggle = document.getElementById('ddToggle');
            const menu = document.getElementById('ddMenu');
            const userInfo = document.getElementById('userInfo');
            const logoutLink = document.getElementById('logoutLink');
            const logoutForm = document.getElementById('logout-form');

            if (toggle && menu) {
                toggle.addEventListener('click', function(e){
                    e.stopPropagation();
                    const visible = menu.style.display === 'block';
                    menu.style.display = visible ? 'none' : 'block';
                    menu.setAttribute('aria-hidden', visible ? 'true' : 'false');
                });

                // Close when clicking outside
                document.addEventListener('click', function(e){
                    if (!userInfo.contains(e.target)) {
                        menu.style.display = 'none';
                        menu.setAttribute('aria-hidden', 'true');
                    }
                });

                // keyboard ESC to close
                document.addEventListener('keydown', function(e){
                    if (e.key === 'Escape') {
                        menu.style.display = 'none';
                        menu.setAttribute('aria-hidden', 'true');
                    }
                });
            }

            // Logout link behavior
            if (logoutLink && logoutForm) {
                logoutLink.addEventListener('click', function(e){
                    e.preventDefault();
                    logoutForm.submit();
                });
            }
        })();
    </script>
</body>
</html>
