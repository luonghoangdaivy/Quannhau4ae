@extends('admin.layout')

@section('content')

<h2>Thêm bàn mới</h2>

<form action="{{ route('table.store') }}" method="POST" style="margin-top: 20px;">
    @csrf

    <label>Tên bàn</label>
    <input type="text" name="table_name" class="form-control" required>

    <label>Số chỗ</label>
    <input type="number" name="capacity" class="form-control" required>

    <label>Trạng thái</label>
    <select name="status" class="form-control">
        <option value="Trống">Trống</option>
        <option value="Đang dùng">Đang dùng</option>
        <option value="Đã đặt">Đã đặt</option>
    </select>

    <button class="btn btn-primary" style="margin-top: 15px;">Thêm</button>
</form>

@endsection
