@extends('admin.layout')

@section('content')

<h2>Thêm món ăn / đồ uống</h2>

<div class="form-box">

<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Loại món -->
    <div class="form-group">
        <label class="form-label">Loại món:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tên món -->
    <div class="form-group">
        <label class="form-label">Tên món:</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <!-- Giá -->
    <div class="form-group">
        <label class="form-label">Giá (VNĐ):</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <!-- Hình ảnh -->
    <div class="form-group">
        <label class="form-label">Hình ảnh:</label>
        <input type="file" name="image" class="form-control"
               onchange="previewImage(this, 'imgPreview')">
        <img id="imgPreview" class="preview-img" style="display:none;">
    </div>

    <div class="form-group">
        <button class="btn btn-primary">Lưu món</button>
    </div>

</form>

</div>

@endsection
