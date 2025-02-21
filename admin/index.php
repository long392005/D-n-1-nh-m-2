<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ
<<<<<<< HEAD
// Require toàn bộ file Controllers
require_once './controllers/DonHangController.php';
require_once './controllers/LoginController.php';
=======
require_once './controllers/DonHangController.php';
require_once './controllers/LoginController.php';

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once './models/DonHang.php';
require_once './models/Login.php';
>>>>>>> 0a94451 (Cập nhật các tệp liên quan đến login)

require_once  './controllers/AdminDanhMucController.php';
require_once  './controllers/AdminSanphamController.php';
<<<<<<< HEAD
// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
=======
require_once './controllers/DashboardController.php';
// Require toàn bộ file Models

<<<<<<< HEAD
>>>>>>> 12e65b11f4f880e76eb74fb443a79d27d0917e10
require_once './models/DonHang.php';
require_once './models/Login.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanpham.php';
require_once './models/Dashboard.php';
=======
>>>>>>> 0a94451 (Cập nhật các tệp liên quan đến login)
// Route
$act = $_GET['act'] ?? '/';


<<<<<<< HEAD

if (!isset($_SESSION['user_admin']) && $act !== 'login-admin' && $act !== 'check-login-admin'  && $act !== 'dang-ky' && $act !== 'check-dang-ky') {
=======
if (!isset($_SESSION['user_admin']) && $act !== 'login-admin' && $act !== 'check-login-admin') {
>>>>>>> 0a94451 (Cập nhật các tệp liên quan đến login)
    header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
    exit();
}



match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),
<<<<<<< HEAD
    'danh-muc'         => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc'=> (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc'     => (new AdminDanhMucController())->addDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhmuc(),
    'xoa-danh-muc'      => (new AdminDanhMucController())->deleteDanhMuc(),
    'sua-danh-muc'      => (new AdminDanhMucController())-> postEditDanhmuc(),

    'don-hang'          => (new DonHangController())->index(),
    'form-sua-don-hang' => (new DonHangController())->edit(),
    'sua-don-hang'      => (new DonHangController())->update(),
    'chi-tiet-don-hang' => (new DonHangController())->detailDonHang(),

    'login-admin'       => (new LoginController())->formLogin(),
    'check-login-admin' => (new LoginController())->Login(),
    'dang-ky' => (new LoginController())->formDangky(),
    'check-dang-ky'=>(new LoginController())->DangKy(),
    'dang-ky-thanh-cong'=>(new LoginController())->formDangKyThanhCong(),

    'detail-tai-khoan'  => (new LoginController())->formDetail(),
    'update-tai-khoan'  => (new LoginController())->updateAcc(),
    'form-password'     => (new LoginController())->formPassword(),
    'update-password'   => (new LoginController())->updatePassword(),
    'logout-admin'      => (new LoginController())->logout(),


    'san-pham'=> (new AdminSanPhamController())->index(),
    'form-them-san-pham' => (new AdminSanPhamController())->formaddSanpham(),
    'them-san-pham'=>(new AdminSanPhamController())->postaddSanpham(),
    'form-sua-san-pham' =>(new AdminSanPhamController())->formEditSanpham(),
    'sua-san-pham' =>(new AdminSanPhamController())->postEditSanpham(),
    'xoa-san-pham' =>(new AdminSanPhamController())->deleteSanpham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController)->detailSanpham(),

};
=======

    // 'don-hang' =>(new donHangController())->index(),
    // 'form-sua-don-hang'=>(new donHangController())->edit(),
    // 'sua-don-hang'=>(new donHangController())->update(),
    // 'chi-tiet-don-hang'=>(new donHangController())->detailDonHang(),

    
    'login-admin' => (new LoginController())->formLogin(),
    'check-login-admin' => (new LoginController())->Login(),
    'detail-tai-khoan' => (new LoginController())->formDetail(),
    'update-tai-khoan'=>(new LoginController())->updateAcc(),
    'form-password' => (new LoginController())->formPassword(),
    'update-password' => (new LoginController())->updatePassword(),
    'logout-admin' => (new LoginController())->logout(),
 };

>>>>>>> 0a94451 (Cập nhật các tệp liên quan đến login)
