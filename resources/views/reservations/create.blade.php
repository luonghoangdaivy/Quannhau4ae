@extends('layouts.app')

@section('title', 'Đặt bàn - Quán Nhậu 4 Anh Em')

@section('content')
<div class="py-4">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-danger mb-3">ĐẶT BÀN TRỰC TUYẾN</h1>
        <p class="lead text-muted">Đặt bàn trước để có trải nghiệm tốt nhất tại Quán Nhậu 4 Anh Em</p>
    </div>

    <div class="row">
        <!-- LEFT: Form đặt bàn -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">Thông tin đặt bàn</h3>

                    @if($errors->any())
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <!-- FORM BẮT ĐẦU -->
                    <form id="bookingForm" method="POST" action="{{ route('reservation.store') }}">
                        @csrf

                        <!-- Thông tin khách -->
                        <div class="row mb-4">
                            <h5 class="mb-3"><i class="bi bi-person-circle me-2"></i> Thông tin liên hệ</h5>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Họ và tên *</label>
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', auth()->user()->name ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại *</label>
                                <input type="tel" name="phone" class="form-control" required
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', auth()->user()->email ?? '') }}">
                            </div>
                        </div>

                        <!-- Thông tin đặt bàn -->
                        <div class="row mb-4">
                            <h5 class="mb-3"><i class="bi bi-calendar-event me-2"></i> Thông tin đặt bàn</h5>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Chọn bàn *</label>
                                <select name="table_id" class="form-select" required>
                                    <option value="">Chọn bàn</option>
                                    <option value="1">Bàn 1</option>
                                    <option value="2">Bàn 2</option>
                                    <option value="3">Bàn 3</option>
                                    <option value="4">Bàn 4</option>
                                    <option value="5">Bàn 5</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lượng người *</label>
                                <select name="people" class="form-select" required>
                                    <option value="">Chọn số người</option>
                                    <option value="1">1 người</option>
                                    <option value="2">2 người</option>
                                    <option value="3">3 người</option>
                                    <option value="4">4 người</option>
                                    <option value="5">5-6 người</option>
                                    <option value="7">7-8 người</option>
                                    <option value="9">9-10 người</option>
                                    <option value="11">Trên 10 người</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày đặt *</label>
                                <input type="date" name="booking_date" class="form-control" required
                                       min="{{ date('Y-m-d') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giờ đặt *</label>
                                <select name="booking_time" class="form-select" required>
                                    <option value="">Chọn giờ</option>
                                    <option value="16:00">16:00 - 17:00</option>
                                    <option value="17:00">17:00 - 18:00</option>
                                    <option value="18:00">18:00 - 19:00</option>
                                    <option value="19:00">19:00 - 20:00</option>
                                    <option value="20:00">20:00 - 21:00</option>
                                    <option value="21:00">21:00 - 22:00</option>
                                    <option value="22:00">22:00 - 23:00</option>
                                </select>
                            </div>
                        </div>

                        <!-- Ghi chú -->
                        <div class="mb-4">
                            <h5 class="mb-3"><i class="bi bi-chat-text me-2"></i> Ghi chú</h5>
                            <textarea name="special_request" class="form-control" rows="3"
                                      placeholder="Ví dụ: Bàn yên tĩnh, có trẻ em..."></textarea>
                        </div>

                        <!-- Hidden reservation_time -->
                        <input type="hidden" name="reservation_time" id="reservation_time">

                        <!-- Check điều khoản -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="confirmBooking" required>
                            <label class="form-check-label" for="confirmBooking">
                                Tôi đồng ý với điều khoản đặt bàn
                            </label>
                        </div>

                        <!-- Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-danger btn-lg py-3">
                                <i class="bi bi-check-circle me-2"></i> XÁC NHẬN ĐẶT BÀN
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT: Giỏ hàng -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-cart3 me-2"></i> Giỏ hàng</h5>

                    @if(isset($items) && $items->isNotEmpty())
                      <ul class="list-group mb-3">
                        @foreach($items as $it)
                          <li class="list-group-item d-flex justify-content-between">
                            <div>
                              <strong>{{ $it->name }}</strong><br>
                              <small>x{{ $it->qty }} – {{ number_format($it->price) }}₫</small>
                            </div>
                            <strong>{{ number_format($it->subtotal) }}₫</strong>
                          </li>
                        @endforeach
                      </ul>
                      <h5 class="text-end">Tổng: <b>{{ number_format($total) }}₫</b></h5>
                    @else
                      <div class="alert alert-info">Giỏ hàng trống</div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const dateInput = document.querySelector('input[name="booking_date"]');
    const timeInput = document.querySelector('select[name="booking_time"]');
    const resInput  = document.getElementById('reservation_time');
    const bookingForm = document.getElementById('bookingForm');

    function updateReservationTime() {
        if (dateInput.value && timeInput.value) {
            resInput.value = dateInput.value + " " + timeInput.value + ":00";
        }
    }

    dateInput.addEventListener('change', updateReservationTime);
    timeInput.addEventListener('change', updateReservationTime);

    bookingForm.addEventListener('submit', function(e) {
        updateReservationTime(); // EP CẬP NHẬT GIÁ TRỊ TRƯỚC KHI SUBMIT

        if (!document.getElementById('confirmBooking').checked) {
            e.preventDefault();
            alert('Vui lòng xác nhận điều khoản đặt bàn!');
        }
    });
});
</script>
@endpush
