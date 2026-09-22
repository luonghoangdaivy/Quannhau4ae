<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotionController extends Controller
{
    // Hiển thị trang khuyến mãi đầy đủ
    public function index()
    {
        $promotions = $this->getAllPromotions();
        
        return view('promotions.index', compact('promotions'));
    }
    
    // Lấy tất cả 10 khuyến mãi
    private function getAllPromotions()
    {
        return [
            [
                'id' => 1,
                'title' => 'COMBO HẢI SẢN SIÊU KHỦNG',
                'description' => 'Tôm sú hấp bia + Mực nướng sa tế + Nghêu hấp xả + Lẩu Thái chua cay mini + Rau sống ăn kèm.',
                'image' => 'sale1.jpg',
                'original_price' => '350.000đ',
                'sale_price' => '279.000đ',
                'badge' => 'hot',
                'icon' => '🦐',
                'category' => 'combo',
                'details' => [
                    'people' => '3-5 người',
                    'time' => 'Tất cả các ngày',
                    'used' => '245 lần'
                ],
                'link' => '#'
            ],
            [
                'id' => 2,
                'title' => 'UỐNG 3 TẶNG 1 TIGER BẠC',
                'description' => 'Mỗi bàn 3 ly Tiger Bạc được tặng thêm 1 ly. Áp dụng tất cả các loại bia Tiger.',
                'image' => 'sale2.jpg',
                'original_price' => '45.000đ/ly',
                'sale_price' => '33.750đ/ly',
                'badge' => 'bestseller',
                'icon' => '🍺',
                'category' => 'drink',
                'details' => [
                    'time' => '20:00 - 23:30',
                    'days' => 'T2 - CN',
                    'used' => '1,245 lần'
                ],
                'link' => '#'
            ],
            [
                'id' => 3,
                'title' => 'SET NƯỚNG ĐẶC BIỆT',
                'description' => 'Ba chỉ heo nướng + Đùi gà nướng mật ong + Mề gà + Bò cuộn nấm + Rau củ nướng.',
                'image' => 'sale3.jpg',
                'original_price' => '199.000đ',
                'sale_price' => '159.000đ',
                'badge' => 'new',
                'icon' => '🔥',
                'category' => 'food',
                'details' => [
                    'people' => '2-3 người',
                    'time' => 'Cả tuần',
                    'used' => '189 lần'
                ],
                'link' => '#'
            ],
            [
                'id' => 4,
                'title' => 'LẨU 3 TẦNG ĐẶC BIỆT',
                'description' => 'Tầng 1: Lẩu Thái - Tầng 2: Lẩu Nấm - Tầng 3: Lẩu Gà lá giang. Bao gồm 10 loại nhúng.',
                'image' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400&auto=format&fit=crop',
                'original_price' => '550.000đ',
                'sale_price' => '429.000đ',
                'badge' => 'new',
                'icon' => '🍲',
                'category' => 'combo',
                'details' => [
                    'people' => '6-8 người',
                    'time' => 'Cuối tuần',
                    'used' => '78 lần'
                ],
                'link' => '#'
            ],
            [
                'id' => 5,
                'title' => 'VOUCHER ĐẠI TIỆC',
                'description' => 'Voucher 500K áp dụng cho hóa đơn từ 1.5 triệu. Mua 3 voucher được tặng thêm 1.',
                'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=400&auto=format&fit=crop',
                'original_price' => '500.000đ',
                'sale_price' => '400.000đ',
                'badge' => 'voucher',
                'icon' => '🎫',
                'category' => 'voucher',
                'details' => [
                    'value' => '500.000đ',
                    'expiry' => '3 tháng',
                    'sold' => '312 voucher'
                ],
                'link' => '#'
            ],
            [
                'id' => 6,
                'title' => 'SINH NHẬT HOÀNH TRÁNG',
                'description' => 'Đặt tiệc sinh nhật từ 10 người: Tặng 1 bánh kem + 1 chai rượu vang + Trang trí bàn miễn phí.',
                'image' => 'https://images.unsplash.com/photo-1532117182044-031e7cd916ee?w=400&auto=format&fit=crop',
                'original_price' => '0đ',
                'sale_price' => 'MIỄN PHÍ',
                'badge' => 'hot',
                'icon' => '🎂',
                'category' => 'voucher',
                'details' => [
                    'people' => 'Từ 10 người',
                    'time' => 'Cả tuần',
                    'booked' => '45 bữa tiệc'
                ],
                'link' => '#'
            ],
            [
                'id' => 7,
                'title' => 'RƯỢU NGOẠI GIẢM SỐC',
                'description' => 'Johnnie Walker Red Label - Chivas Regal 12 năm - Hennessy VSOP giảm đến 25%.',
                'image' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=400&auto=format&fit=crop',
                'original_price' => '1.200.000đ',
                'sale_price' => '899.000đ',
                'badge' => 'drink',
                'icon' => '🥃',
                'category' => 'drink',
                'details' => [
                    'brand' => 'Chivas, JW, Hennessy',
                    'discount' => '15-25%',
                    'sold' => '89 chai'
                ],
                'link' => '#'
            ],
            [
                'id' => 8,
                'title' => 'BUFFET TỐI THỨ 7',
                'description' => 'Hơn 50 món: Hải sản tươi sống + Đồ nướng + Lẩu + Món Á Âu + Tráng miệng.',
                'image' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=400&auto=format&fit=crop',
                'original_price' => '299.000đ',
                'sale_price' => '199.000đ/người',
                'badge' => 'new',
                'icon' => '🍽️',
                'category' => 'combo',
                'details' => [
                    'time' => '18:00 - 22:00',
                    'days' => 'Thứ 7 hàng tuần',
                    'booked' => '156 suất'
                ],
                'link' => '#'
            ],
            [
                'id' => 9,
                'title' => 'COMBO GIA ĐÌNH',
                'description' => '4 món mặn + 1 canh + 1 rau xào + Cơm trắng + Trái cây tráng miệng.',
                'image' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400&auto=format&fit=crop',
                'original_price' => '350.000đ',
                'sale_price' => '279.000đ',
                'badge' => 'combo',
                'icon' => '👨‍👩‍👧‍👦',
                'category' => 'combo',
                'details' => [
                    'people' => '4-5 người',
                    'time' => 'Trưa & Tối',
                    'used' => '312 lần'
                ],
                'link' => '#'
            ],
            [
                'id' => 10,
                'title' => 'THỨ 4 ĐỒNG GIÁ 50K',
                'description' => 'Tất cả các món nhậu đặc biệt chỉ 50K/đĩa: Gỏi, nem, chả giò, khô mực, đậu phộng.',
                'image' => 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=400&auto=format&fit=crop',
                'original_price' => '0đ',
                'sale_price' => '50.000đ/món',
                'badge' => 'hot',
                'icon' => '💰',
                'category' => 'food',
                'details' => [
                    'time' => '16:00 - 20:00',
                    'days' => 'Thứ 4 hàng tuần',
                    'used' => '845 món'
                ],
                'link' => '#'
            ],
        ];
    }
}