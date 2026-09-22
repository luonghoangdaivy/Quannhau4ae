@extends('layouts.app')

@section('title', 'Đặt bàn - Quán Nhậu 4 Anh Em')

@section('content')
<div class="py-4">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-danger mb-3">ĐẶT BÀN TRỰC TUYẾN</h1>
        <p class="lead text-muted">Đặt bàn trước để có trải nghiệm tốt nhất tại Quán Nhậu 4 Anh Em</p>
    </div>

    <div class="row">
        <!-- Form đặt bàn -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">Thông tin đặt bàn</h3>
                    
                    <form id="bookingForm" method="POST" action="{{ route('dat-ban.store') }}">
                        @csrf
                        
                        <!-- Thông tin khách hàng -->
                        <div class="row mb-4">
                            <h5 class="mb-3"><i class="bi bi-person-circle me-2"></i> Thông tin liên hệ</h5>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required 
                                       value="{{ auth()->user()->name ?? '' }}"
                                       placeholder="Nhập họ tên của bạn">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" required
                                       value="{{ auth()->user()->phone ?? '' }}"
                                       placeholder="Nhập số điện thoại">
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ auth()->user()->email ?? '' }}"
                                       placeholder="Nhập email (nếu có)">
                            </div>
                        </div>

                        <!-- Thông tin đặt bàn -->
                        <div class="row mb-4">
                            <h5 class="mb-3"><i class="bi bi-calendar-event me-2"></i> Thông tin đặt bàn</h5>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày đặt bàn <span class="text-danger">*</span></label>
                                <input type="date" name="booking_date" class="form-control" required
                                       min="{{ date('Y-m-d') }}">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giờ đặt bàn <span class="text-danger">*</span></label>
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
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lượng người <span class="text-danger">*</span></label>
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
                                <label class="form-label">Loại bàn</label>
                                <select name="table_type" class="form-select">
                                    <option value="">Không yêu cầu</option>
                                    <option value="standard">Bàn tiêu chuẩn</option>
                                    <option value="vip">Bàn VIP</option>
                                    <option value="family">Bàn gia đình</option>
                                    <option value="window">Bàn cạnh cửa sổ</option>
                                </select>
                            </div>
                        </div>

                        <!-- Ghi chú -->
                        <div class="mb-4">
                            <h5 class="mb-3"><i class="bi bi-chat-text me-2"></i> Ghi chú đặc biệt</h5>
                            <div class="mb-3">
                                <label class="form-label">Yêu cầu đặc biệt (nếu có)</label>
                                <textarea name="special_request" class="form-control" rows="3" 
                                          placeholder="Ví dụ: Bàn yên tĩnh, có trẻ em, yêu cầu trang trí sinh nhật..."></textarea>
                            </div>
                        </div>

                        <!-- Xác nhận -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="confirmBooking" required>
                            <label class="form-check-label" for="confirmBooking">
                                Tôi xác nhận thông tin đặt bàn là chính xác và đồng ý với 
                                <a href="#" class="text-decoration-none">điều khoản đặt bàn</a> của quán
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg py-3">
                                <i class="bi bi-check-circle me-2"></i> XÁC NHẬN ĐẶT BÀN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Thông tin bên cạnh -->
        <div class="col-lg-4">
            <!-- Thông tin quán -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-info-circle me-2"></i> Thông tin quán</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-danger me-2"></i>
                            <strong>Địa chỉ:</strong> 123 Nguyễn Văn Linh, Thanh Khê, Đà Nẵng
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone text-danger me-2"></i>
                            <strong>Hotline:</strong> 0901 234 567
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-clock text-danger me-2"></i>
                            <strong>Giờ mở cửa:</strong> 16:00 - 23:00 hàng ngày
                        </li>
                        <li>
                            <i class="bi bi-credit-card text-danger me-2"></i>
                            <strong>Thanh toán:</strong> Tiền mặt, chuyển khoản
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Chính sách đặt bàn -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-shield-check me-2"></i> Chính sách đặt bàn</h5>
                    <div class="alert alert-info">
                        <h6><i class="bi bi-exclamation-circle me-2"></i> Lưu ý quan trọng:</h6>
                        <ul class="mb-0">
                            <li>Vui lòng đến trước 15 phút so với giờ đã đặt</li>
                            <li>Đặt bàn chỉ được giữ tối đa 30 phút</li>
                            <li>Hủy đặt bàn trước 2 giờ để không bị phí</li>
                            <li>Đối với nhóm trên 8 người vui lòng gọi trực tiếp</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Trạng thái bàn -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="bi bi-table me-2"></i> Trạng thái bàn hôm nay</h5>
                    <div class="table-status">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Bàn trống:</span>
                            <span class="badge bg-success">12 bàn</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Bàn đã đặt:</span>
                            <span class="badge bg-warning text-dark">8 bàn</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Bàn đang sử dụng:</span>
                            <span class="badge bg-danger">5 bàn</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map -->
    <div class="card shadow-sm border-0 mt-5">
        <div class="card-body p-4">
            <h3 class="card-title mb-3">Vị trí quán</h3>
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7388350437785!2d108.20683731528757!3d16.016347988926757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219b3c7b8c54f%3A0x3b6c5f3a7f0d8c0f!2zMTIzIE5ndXnhu4VuIFbEg24gTGluaCwgVGhhbmggS2jhuqEsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1620000000000!5m2!1svi!2s" 
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Custom styles for booking page */
.card {
    border-radius: 15px !important;
    border: 1px solid #e9ecef !important;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 10px 15px;
}

.form-control:focus, .form-select:focus {
    border-color: #b91c1c;
    box-shadow: 0 0 0 0.25rem rgba(185, 28, 28, 0.25);
}

.btn-danger {
    background-color: #b91c1c;
    border-color: #b91c1c;
    border-radius: 10px;
    font-weight: 600;
}

.btn-danger:hover {
    background-color: #991b1b;
    border-color: #991b1b;
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

/* Table status */
.table-status {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
}

.badge {
    font-size: 0.9rem;
    padding: 5px 10px;
    border-radius: 20px;
}

/* Map iframe */
.ratio {
    border-radius: 10px;
    overflow: hidden;
}

/* Alert box */
.alert-info {
    background-color: #e7f1ff;
    border-color: #b6d4fe;
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .display-5 {
        font-size: 2rem;
    }
    
    .btn-lg {
        padding: 12px 24px;
        font-size: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set min date to today
    const dateInput = document.querySelector('input[name="booking_date"]');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
        
        // Set default to tomorrow
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowStr = tomorrow.toISOString().split('T')[0];
        dateInput.value = tomorrowStr;
    }
    
    // Form validation
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            const confirmCheckbox = document.getElementById('confirmBooking');
            if (!confirmCheckbox.checked) {
                e.preventDefault();
                alert('Vui lòng xác nhận điều khoản đặt bàn trước khi gửi!');
                return false;
            }
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Đang xử lý...';
            submitBtn.disabled = true;
            
            // Simulate processing (in real app, this would be AJAX)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }
    
    // People count validation
    const peopleSelect = document.querySelector('select[name="people"]');
    if (peopleSelect) {
        peopleSelect.addEventListener('change', function() {
            const value = parseInt(this.value);
            if (value > 8) {
                showToast('Đối với nhóm trên 8 người, vui lòng gọi trực tiếp hotline 0901 234 567', 'warning');
            }
        });
    }
});

function showToast(message, type = 'info') {
    const toastContainer = document.createElement('div');
    toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
    toastContainer.style.zIndex = '9999';
    
    const toastId = 'toast-' + Date.now();
    toastContainer.innerHTML = `
        <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi ${type === 'success' ? 'bi-check-circle' : 
                                   type === 'warning' ? 'bi-exclamation-triangle' : 
                                   type === 'danger' ? 'bi-exclamation-circle' : 
                                   'bi-info-circle'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    document.body.appendChild(toastContainer);
    
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
    
    // Remove toast after it hides
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastContainer.remove();
    });
}
</script>
@endpush