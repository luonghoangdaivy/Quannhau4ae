@extends('admin.layout')

@section('content')

<h2 style="margin-bottom: 20px;">Quản lý bàn</h2>

<a href="{{ route('table.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">+ Thêm bàn</a>

<table>
    <tr>
        <th>ID</th>
        <th>Tên bàn</th>
        <th>Số chỗ</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>

    @foreach($tables as $t)
    <tr>
        <td>{{ $t->id }}</td>
        <td>{{ $t->table_name }}</td>
        <td>{{ $t->capacity }}</td>
        <td>{{ $t->status }}</td>

        <td>
            <a href="{{ route('table.edit', $t->id) }}" class="btn btn-warning">Sửa</a>

            <form action="{{ route('table.destroy', $t->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Xóa bàn này?')" class="btn btn-danger">
                    Xóa
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $tables->links() }}
@endsection
