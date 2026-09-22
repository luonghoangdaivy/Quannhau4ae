@extends('admin.layout')

@section('content')
<h2>Danh sách món ăn & đồ uống</h2>

<a href="{{ route('admin.product.create') }}" class="btn btn-primary" style="margin: 15px 0; display: inline-block;">+ Thêm món</a>

<table>
    <tr>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tên món</th>
        <th>Loại</th>
        <th>Giá</th>
        <th>Hành động</th>
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>
            <img src="{{ asset('source/images/' . $p->image) }}" width="60" style="border-radius:5px;">

        </td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->category->name }}</td>
        <td>{{ number_format($p->price) }}đ</td>
        <td>
            <a href="{{ route('admin.product.edit',$p->id) }}" class="btn btn-warning">Sửa</a>

           <form action="{{ route('admin.product.destroy', $p->id) }}" 
      method="POST" 
      style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Bạn chắc chắn muốn xoá?')" 
            class="btn btn-danger">
        Xóa
    </button>
</form>

        </td>
    </tr>
    @endforeach
</table>

{{ $products->links() }}
@endsection
