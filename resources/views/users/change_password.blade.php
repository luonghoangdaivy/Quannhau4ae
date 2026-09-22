<h2>Đổi mật khẩu</h2>

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('change.password.post') }}">
    @csrf

    <label>Mật khẩu hiện tại:</label>
    <input type="password" name="current_password" required>

    <label>Mật khẩu mới:</label>
    <input type="password" name="new_password" required>

    <label>Xác nhận mật khẩu mới:</label>
    <input type="password" name="new_password_confirmation" required>

    <button type="submit">Đổi mật khẩu</button>
</form>
