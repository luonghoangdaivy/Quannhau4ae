<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        // Sản phẩm hot của bạn (giữ nguyên)
        $hotProducts = Product::inRandomOrder()->take(8)->get();
        
        // THÊM PHẦN NÀY: Lấy 3 khuyến mãi random
        $randomPromotions = $this->getRandomPromotions(3);
        
        // Trả về cả sản phẩm và khuyến mãi
        return view('trangchu', compact('hotProducts', 'randomPromotions'));
    }
    
    /**
     * Phương thức mới: Lấy khuyến mãi random
     */
    private function getRandomPromotions($count = 3)
    {
        $allPromotions = [
            [
                'id' => 1,
                'title' => 'COMBO HẢI SẢN SIÊU KHỦNG',
                'description' => 'Tôm sú hấp bia + Mực nướng sa tế',
                'image' => 'sale1.jpg',
                'price' => '279.000đ',
                'badge' => 'hot',
                'icon' => '🦐',
                'link' => '#'
            ],
            [
                'id' => 2,
                'title' => 'UỐNG 3 TẶNG 1 TIGER BẠC',
                'description' => 'Áp dụng sau 20h hàng ngày',
                'image' => 'sale2.jpg',
                'price' => '33.750đ/ly',
                'badge' => 'bestseller',
                'icon' => '🍺',
                'link' => '#'
            ],
            [
                'id' => 3,
                'title' => 'SET NƯỚNG ĐẶC BIỆT',
                'description' => 'Ba chỉ + gà + mề + bò cuộn nấm',
                'image' => 'sale3.jpg',
                'price' => '159.000đ',
                'badge' => 'new',
                'icon' => '🔥',
                'link' => '#'
            ],
            [
                'id' => 4,
                'title' => 'LẨU 3 TẦNG ĐẶC BIỆT',
                'description' => '3 loại lẩu: Thái, Nấm, Gà lá giang',
                'image' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400&auto=format&fit=crop',
                'price' => '429.000đ',
                'badge' => 'new',
                'icon' => '🍲',
                'link' => '#'
            ],
            [
                'id' => 5,
                'title' => 'VOUCHER ĐẠI TIỆC 500K',
                'description' => 'Áp dụng cho hóa đơn từ 1.5 triệu',
                'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=400&auto=format&fit=crop',
                'price' => '400.000đ',
                'badge' => 'voucher',
                'icon' => '🎫',
                'link' => '#'
            ],
            [
                'id' => 6,
                'title' => 'SINH NHẬT HOÀNH TRÁNG',
                'description' => 'Tặng bánh kem + rượu vang + trang trí',
                'image' => 'https://images.unsplash.com/photo-1532117182044-031e7cd916ee?w=400&auto=format&fit=crop',
                'price' => 'MIỄN PHÍ',
                'badge' => 'hot',
                'icon' => '🎂',
                'link' => '#'
            ],
            [
                'id' => 7,
                'title' => 'RƯỢU NGOẠI GIẢM SỐC',
                'description' => 'Chivas, Johnnie Walker, Hennessy giảm 25%',
                'image' => 'https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=400&auto=format&fit=crop',
                'price' => '899.000đ',
                'badge' => 'drink',
                'icon' => '🥃',
                'link' => '#'
            ],
            [
                'id' => 8,
                'title' => 'BUFFET TỐI THỨ 7',
                'description' => '50+ món hải sản, nướng, lẩu, tráng miệng',
                'image' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=400&auto=format&fit=crop',
                'price' => '199.000đ/người',
                'badge' => 'new',
                'icon' => '🍽️',
                'link' => '#'
            ],
            [
                'id' => 9,
                'title' => 'COMBO GIA ĐÌNH',
                'description' => '4 món mặn + canh + rau + cơm + trái cây',
                'image' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400&auto=format&fit=crop',
                'price' => '279.000đ',
                'badge' => 'combo',
                'icon' => '👨‍👩‍👧‍👦',
                'link' => '#'
            ],
            [
                'id' => 10,
                'title' => 'THỨ 4 ĐỒNG GIÁ 50K',
                'description' => 'Tất cả món nhậu đặc biệt chỉ 50K/đĩa',
                'image' => 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=400&auto=format&fit=crop',
                'price' => '50.000đ/món',
                'badge' => 'hot',
                'icon' => '💰',
                'link' => '#'
            ],
        ];
        
        // Random lấy $count khuyến mãi
        shuffle($allPromotions);
        return array_slice($allPromotions, 0, $count);
    }
    
    /**
     * AJAX endpoint để refresh promotions
     */
    public function refreshPromotions(Request $request)
    {
        $promotions = $this->getRandomPromotions(3);
        
        // Tạo HTML response
        $html = '';
        foreach($promotions as $promo) {
            $badgeColor = $promo['badge'] == 'hot' ? '#ff3333' : 
                         ($promo['badge'] == 'new' ? '#33cc33' : '#ffcc33');
            $badgeText = $promo['badge'] == 'hot' ? 'HOT' : 
                        ($promo['badge'] == 'new' ? 'MỚI' : 'ƯU ĐÃI');
            
            $html .= '
            <div class="promotion-card">
                <div class="promotion-badge" style="background: ' . $badgeColor . '">' . $badgeText . '</div>
                <img src="' . (str_starts_with($promo['image'], 'http') ? $promo['image'] : asset('source/images/' . $promo['image'])) . '" 
                     alt="' . $promo['title'] . '" class="promotion-img">
                <div class="promotion-content">
                    <div class="promotion-header">
                        <span class="promotion-icon">' . $promo['icon'] . '</span>
                        <h3>' . $promo['title'] . '</h3>
                    </div>
                    <p class="promotion-desc">' . $promo['description'] . '</p>
                    <div class="promotion-footer">
                        <span class="promotion-price">' . $promo['price'] . '</span>
                        <a href="' . $promo['link'] . '" class="promotion-btn">Xem ngay</a>
                    </div>
                </div>
            </div>';
        }
        
        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => count($promotions)
        ]);
    }
}