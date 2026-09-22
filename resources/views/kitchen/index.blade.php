@extends('kitchen.kitchenlayout')

@section('title', 'Bếp - Danh sách món')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-danger fw-bold">
        🍳 DANH SÁCH MÓN CẦN LÀM
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên món</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- TÊN MÓN --}}
                        <td class="fw-bold">
                            {{ $item->product->name ?? 'Không có tên món' }}
                        </td>

                        {{-- SỐ LƯỢNG --}}
                        <td>x{{ $item->quantity }}</td>

                        {{-- TRẠNG THÁI --}}
                        <td>
                            @if($item->kitchen_status == 'PENDING')
                                <span class="badge bg-warning text-dark">Chờ món</span>
                            @elseif($item->kitchen_status == 'COOKING')
                                <span class="badge bg-info">Đang làm</span>
                            @else
                                <span class="badge bg-success">Hoàn thành</span>
                            @endif
                        </td>

                        {{-- NÚT LÀM XONG --}}
                        <td class="text-center">
                            @if($item->kitchen_status != 'DONE')
                                <form action="{{ route('kitchen.updateStatus', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="DONE">
                                    <button class="btn btn-success btn-sm">
                                        ✅ Làm xong
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">✔ Đã xong</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Không có món cần làm
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
