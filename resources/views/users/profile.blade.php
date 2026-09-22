@extends('master')

@section('content')
<div class="container" style="max-width:600px; margin:40px auto;">
    
    <h2 style="margin-bottom:20px;">Thông tin tài khoản</h2>

    <p><strong>Tên:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <hr>

    <h3>Đổi mật khẩu</h3>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('profile.changePassword') }}" method="POST">
        @csrf

        <label>Mật khẩu hiện tại:</label>
        <input type="password" name="current_password" class="form-control" required>

        <label>Mật khẩu mới:</label>
        <input type="password" name="new_password" class="form-control" required>

        <label>Nhập lại mật khẩu mới:</label>
        <input type="password" name="new_password_confirmation" class="form-control" required>

        <button type="submit" style="margin-top:15px;" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
