<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Quán Nhậu</title>

    <style>
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial;
        }

        body {
            display: flex;
            background: #f5f6fa;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 230px;
            background: #2d3436;
            min-height: 100vh;
            padding: 20px 0;
            color: white;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 22px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #dfe6e9;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            background: #636e72;
        }

        /* ===== MAIN CONTENT ===== */
        .main {
            margin-left: 230px;
            padding: 20px;
            width: calc(100% - 230px);
        }

        /* ===== HEADER ===== */
        .admin-header {
            background: white;
            padding: 15px 25px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px #ccc;
            display: flex;
            justify-content: space-between;
        }

        /* ===== BUTTON ===== */
        .btn {
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            border: none;
        }
        .btn-primary { background: #0984e3; }
        .btn-warning { background: #fdcb6e; color: black; }
        .btn-danger { background: #d63031; }
        .btn:hover { opacity: 0.8; }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px #ccc;
        }
        table th {
            background: #0984e3;
            color: white;
            padding: 12px;
            text-align: left;
        }
        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        table tr:hover {
            background: #f1f2f6;
        }

        /* Image preview */
        .preview-img {
            max-width: 120px;
            margin-top: 10px;
            border-radius: 6px;
        }

        /* ===== FORM STYLE ===== */
.form-group {
    margin-bottom: 15px;
}

.form-label {
    font-weight: bold;
    margin-bottom: 6px;
    display: block;
}

.form-control {
    width: 100%;
    max-width: 350px;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 15px;
}

.form-control:focus {
    border-color: #0984e3;
    box-shadow: 0 0 3px rgba(0, 136, 255, 0.6);
}

.form-box {
    background: white;
    padding: 25px;
    width: 500px;
    border-radius: 12px;
    box-shadow: 0 4px 10px #ccc;
}

    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Quán Nhậu Admin</h2>
    <a href="/admin">Dashboard</a>
    <a href="/admin/products">Món ăn & Đồ uống</a>
    <a href="/admin/categories">Loại món</a>
    <a href="/admin/tables">Bàn ăn</a>
    <a href="/admin/customers">Khách hàng</a>
    <a href="/admin/orders">Đơn hàng</a>
    <a href="/admin/reservations">Đặt bàn</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="admin-header">
        <h3>Trang quản trị</h3>
        <span>Xin chào, Admin</span>
    </div>

    @yield('content')

</div>

<script>
    // Preview hình ảnh khi upload
    function previewImage(input, previewId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
        }
    }
</script>

</body>
</html>
