{{-- resources/views/promotions/index.blade.php --}}
@extends('master')

@section('title', 'Khuyến Mãi - Quán Nhậu 4 Anh Em')

@section('content')
<style>
    /* CSS giống như trang khuyến mãi tôi đã gửi trước đó */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .promotions-page {
        padding: 20px;
        background: linear-gradient(135deg, #f9f3e9 0%, #fff5e6 100%);
        min-height: 100vh;
    }

    .page-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        padding: 30px;
        background: linear-gradient(90deg, #7a0b0b, #b91c1c);
        border-radius: 20px;
        color: white;
        box-shadow: 0 10px 30px rgba(122, 11, 11, 0.3);
    }

    .page-header h1 {
        font-size: 42px;
        margin-bottom: 10px;
        color: #ffcc33;
    }

    .promotions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
    }

    .promotion-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    .promotion-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .promotion-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .promotion-content {
        padding: 20px;
    }

    .promotion-title {
        font-size: 20px;
        color: #7a0b0b;
        margin-bottom: 10px;
    }

    .promotion-price {
        font-size: 24px;
        color: #b91c1c;
        font-weight: bold;
        margin: 10px 0;
    }

    /* Thêm các style khác từ trang khuyến mãi trước */
</style>

<div class="promotions-page">
    <div class="page-container">
        <div class="page-header">
            <h1>🎁 TẤT CẢ ƯU ĐÃI</h1>
            <p>10 chương trình khuyến mãi hấp dẫn đang chờ bạn</p>
        </div>

        <div class="promotions-grid">
            @foreach($promotions as $promo)
            <div class="promotion-card">
                <img src="{{ Str::startsWith($promo['image'], 'http') ? $promo['image'] : asset('source/images/' . $promo['image']) }}" 
                     alt="{{ $promo['title'] }}" class="promotion-img">
                
                <div class="promotion-content">
                    <h3 class="promotion-title">
                        <span style="margin-right: 10px;">{{ $promo['icon'] }}</span>
                        {{ $promo['title'] }}
                    </h3>
                    
                    <p style="color: #666; margin-bottom: 15px;">
                        {{ $promo['description'] }}
                    </p>
                    
                    <div class="promotion-price">
                        @if($promo['original_price'] != '0đ')
                            <span style="text-decoration: line-through; color: #999; font-size: 16px;">
                                {{ $promo['original_price'] }}
                            </span>
                        @endif
                        <span style="color: #b91c1c;">
                            {{ $promo['sale_price'] }}
                        </span>
                    </div>
                    
                    <a href="{{ $promo['link'] }}" 
                       style="display: inline-block; background: #7a0b0b; color: white; 
                              padding: 10px 20px; border-radius: 20px; text-decoration: none;
                              margin-top: 10px;">
                        Xem chi tiết
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection