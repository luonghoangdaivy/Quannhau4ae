@extends('admin.layout')

@section('content')

<h2>Sửa thông tin bàn</h2>

<form action="{{ route('table.update', $table->id) }}" method="POST" style="margin-top: 20px;">
    @csrf
    @method('PUT')

    <label>Tên bàn</label>
    <input type="text" name="table_name" class="form-control"
           value="{{ $table->table_name }}" required>

    <label>Số chỗ</label>
    <input type="number" name="capacity" class="form-control"
           value="{{ $table->capacity }}" required>

    <label>Trạng thái</label>
    <select name="status" class="form-control">
        <option value="Trống" {{ $table->status == 'Trống' ? 'selected' : '' }}>Trống</option>
        <option value="Đang dùng" {{ $table->status == 'Đang dùng' ? 'selected' : '' }}>Đang dùng</option>
        <option value="Đã đặt" {{ $table->status == 'Đã đặt' ? 'selected' : '' }}>Đã đặt</option>
    </select>

    <button class="btn btn-primary" style="margin-top: 15px;">Cập nhật</button>
</form>

@endsection
