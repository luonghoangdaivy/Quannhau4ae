@extends('admin.layout') 

@section('content')
<h2>Quản lý đặt bàn</h2>

<table border="1" width="100%" cellpadding="10">
    <thead>
        <tr>
            <th>Khách hàng</th>
            <th>Bàn</th>
            <th>Thời gian đặt</th>
            <th>Món đã đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
        </tr>
    </thead>

    <tbody>
    @foreach($reservations as $res)
        <tr>
            <td>{{ $res->user->name }}</td>
            <td>{{ $res->table->table_name ?? '—' }}</td>
            <td>{{ $res->reservation_time }}</td>

            {{-- MÓN ĐÃ ĐẶT --}}
            <td>
                @if($res->order)
                    <ul style="padding-left:15px;">
                        @foreach($res->order->orderDetails as $item)
                            <li>
                                {{ $item->product->name }}
                                ({{ $item->quantity }} × {{ number_format($item->price) }})
                            </li>
                        @endforeach
                    </ul>
                @else
                    Chưa gọi món
                @endif
            </td>

            {{-- TỔNG TIỀN --}}
            <td>
                {{ number_format($res->order->total ?? 0) }} đ
            </td>

            <td>{{ $res->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
