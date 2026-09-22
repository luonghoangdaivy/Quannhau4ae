@extends('admin.layout')

@section('content')

<h2 style="margin-bottom: 20px;">Sửa món ăn / đồ uống</h2>

<div class="form-container">

    <form action="{{ route('admin.product.update', $product->id) }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Loại món -->
        <label class="form-label">Loại món</label>
        <select name="category_id" class="form-input">
            @foreach($categories as $c)
                <option value="{{ $c->id }}" 
                    {{ $product->category_id == $c->id ? 'selected' : '' }}>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>

        <!-- Tên món -->
        <label class="form-label">Tên món</label>
        <input type="text" name="name" class="form-input" 
               value="{{ $product->name }}" required>

        <!-- Giá -->
        <label class="form-label">Giá</label>
        <input type="number" name="price" class="form-input" 
               value="{{ $product->price }}" required>

        <!-- Hình ảnh mới -->
        <label class="form-label">Chọn ảnh mới</label>
        <input type="file" name="image" 
               class="form-input-file" onchange="previewImage(this,'preview')">

        <!-- Ảnh hiện tại -->
        <p style="font-size: 14px; color:#444; margin:10px 0 5px;">Ảnh hiện tại:</p>
        <img src="{{ asset('source/images/' . $product->image) }}" 
     width="150" style="border-radius:8px; border:1px solid #ddd;">

        <!-- Ảnh mới preview -->
        <p style="font-size: 14px; color:#444; margin-top: 20px;">Ảnh mới (nếu chọn):</p>
        <img id="preview" class="preview-img" style="display:none;">

        <button class="btn-submit">Cập nhật</button>
    </form>
</div>

@endsection


{{-- CSS --}}
<style>
.form-container {
    width: 420px;
    background: #fff;
    padding: 25px 25px 30px;
    border-radius: 10px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.2);
}

.form-label {
    font-weight: bold;
    margin-top: 15px;
    display: block;
}

.form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #aaa;
    border-radius: 6px;
    margin-top: 5px;
}

.form-input-file {
    margin-top: 8px;
}

.current-img {
    border-radius: 8px;
    border: 1px solid #ddd;
}

.preview-img {
    width: 150px;
    border-radius: 8px;
    border: 1px dashed #888;
    padding: 5px;
}

.btn-submit {
    width: 100%;
    margin-top: 25px;
    padding: 12px;
    background: #007bff;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    transition: 0.3s;
}

.btn-submit:hover {
    background: #0056b3;
}
</style>

{{-- JS preview ảnh --}}
<script>
function previewImage(input, targetId) {
    const preview = document.getElementById(targetId);
    const file = input.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
    }
}
</script>
