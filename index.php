<?php 

session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/LogoutController.php';
require_once './controllers/UserController.php';
require_once './controllers/BlogController.php';
// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/SlideModel.php';
require_once './models/User.php';
require_once './models/Giohang.php';
require_once './models/DatHang.php';
require_once './models/Donhang.php';
require_once './models/BaiViet.php';

$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    'logout-client' => (new LogoutController())->logout(),

    '/' => (new ListController())->home(),
    'list-san-pham' => (new ListController())->listProduct(),
    'chi-tiet-san-pham' => (new ListController())->detailProduct(),
    'them-binh-luan' => (new ListController())->addComment(),

    'detail-tai-khoan' => (new UserController())->formDetail(),
    'update-tai-khoan' => (new UserController)->updateAcc(),
    'form-password' => (new UserController)->formPassword(),
    'update-password' => (new UserController)->updatePassword(),

    //giỏ hàng
    'gio-hang' => (new ListController())->gioHang(),
    'them-gio-hang'                 => (new ListController())->addGioHang(),
    'update-gio-hang' => (new ListController())->updateGioHang(),
    'xoa-gio-hang' => (new ListController())->delete(),



   'form-dat-hang'=>(new ListController())->formDat(),
   'xu-ly-dat-hang'=>(new ListController)->postThanhToan(),
   'dat-hang-thanh-cong'=>(new ListController)->formDatHangThanhCong(),

   'don-hang' =>(new ListController())->lichsumuahang(),
   'huy-don-hang' => (new ListController())->huydonhang($_GET['id']),
   'chi-tiet-don-hang' => (new ListController())->chitietmuahang(),
 'xac-nhan-don-hang' => (new ListController())->xacNhanDonHang(),

  'list-bai-viet'                 => (new ListBlogController())->ListBlog(),
  'chi-tiet-bai-viet'             => (new ListBlogController())->detailBlog(),


};
