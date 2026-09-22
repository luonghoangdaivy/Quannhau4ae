<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Nhân viên phục vụ')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef6ff;
            font-size: 18px;
        }
        .waiter-header {
            background: #0d6efd;
            color: white;
            padding: 16px 24px;
        }
        .waiter-header h1 {
            margin: 0;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="waiter-header d-flex justify-content-between align-items-center">
    <h1>🧑‍🍽️ NHÂN VIÊN PHỤC VỤ</h1>
    <div>{{ auth()->user()->name ?? 'Nhân viên' }}</div>
</div>

<div class="container-fluid py-4">
    @yield('content')
</div>

<script>
    // Tự reload mỗi 8s
    setTimeout(() => {
        location.reload();
    }, 8000);
</script>

</body>
</html>
