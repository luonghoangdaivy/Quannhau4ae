@extends('waiter.layout')

@section('title', 'Món đã xong')

@section('content')
<h3 class="mb-4 text-primary fw-bold">
    📣 MÓN ĐÃ LÀM XONG – MANG RA BÀN
</h3>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Tên món</th>
                    <th>Số lượng</th>
                    <th>Bàn</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $item->product->name }}</td>
                    <td>x{{ $item->quantity }}</td>
                    <td>Bàn {{ $item->order->table_id }}</td>
                    <td>
                        <span class="badge bg-success">Đã xong</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Chưa có món nào xong
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
