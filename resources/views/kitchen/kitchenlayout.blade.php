<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Khu vực bếp')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-size: 18px;
        }

        .kitchen-header {
            background: #b02a37;
            color: white;
            padding: 16px 24px;
        }

        .kitchen-header h1 {
            margin: 0;
            font-weight: bold;
        }

        .badge {
            font-size: 0.9rem;
            padding: 8px 12px;
        }

        .btn {
            font-size: 16px;
            padding: 8px 16px;
        }

        table th, table td {
            vertical-align: middle;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- HEADER --}}
    <div class="kitchen-header d-flex justify-content-between align-items-center">
        <h1>🍳 KHU VỰC BẾP</h1>

        <div>
            <span class="me-3">
                👨‍🍳 {{ auth()->user()->name ?? 'Nhân viên bếp' }}
            </span>
            <a href="{{ route('logout') }}"
               class="btn btn-light btn-sm"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Đăng xuất
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container-fluid py-4">
        @yield('content')
    </div>

    {{-- AUTO REFRESH (OPTIONAL) --}}
    <script>
        // Tự reload mỗi 10s (có thể tắt nếu không thích)
        setTimeout(() => {
            location.reload();
        }, 10000);
    </script>

    @stack('scripts')
</body>
</html>
