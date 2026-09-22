@extends('layouts.app')

@section('title', 'Đặt bàn thành công')

@section('content')
<div class="container py-5 text-center">

    <div class="mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
    </div>

    <h1 class="fw-bold text-success mb-3">ĐẶT BÀN THÀNH CÔNG!</h1>

    @if(session('success'))
        <p class="lead text-dark">{{ session('success') }}</p>
    @else
        <p class="lead text-dark">Cảm ơn bạn đã đặt bàn tại Quán Nhậu 4 Anh Em.</p>
    @endif

    <p class="text-muted">Nhân viên chúng tôi sẽ liên hệ xác nhận sớm nhất.</p>

    <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="{{ route('menu.index') }}" class="btn btn-primary px-4 py-2">
            <i class="bi bi-arrow-left"></i> Tiếp tục xem món
        </a>

        <a href="{{ route('trangchu') }}" class="btn btn-outline-secondary px-4 py-2">
            <i class="bi bi-house"></i> Về trang chủ
        </a>
    </div>

</div>
@endsection
