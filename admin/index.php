<?php 


require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ
require_once './controllers/DonHangController.php';
require_once './controllers/LoginController.php';
require_once './controllers/AdminSanphamController.php';
// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once './models/DonHang.php';
require_once './models/Login.php';
require_once './models/AdminSanpham.php';
// Require toàn bộ file Models
require_once 'models/AdminDanhMuc.php';
require_once 'controllers/AdminDanhMucController.php';
// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),

    'don-hang' =>(new donHangController())->index(),
    'form-sua-don-hang'=>(new donHangController())->edit(),
    'sua-don-hang'=>(new donHangController())->update(),
    'chi-tiet-don-hang'=>(new donHangController())->detailDonHang(),

    
    'login-admin' => (new LoginController())->formLogin(),
    'check-login-admin' => (new LoginController())->Login(),

    //Danh mục
    'danh-muc'              => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc'    => (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc'         => (new AdminDanhMucController())->addDanhMuc(),
    'form-sua-danh-muc'     =>(new AdminDanhMucController())->formEditDanhMuc(),
    'sua-danh-muc'          =>(new AdminDanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc'          =>(new AdminDanhMucController())->deleteDanhMuc(),

    'san-pham' =>(new AdminSanPhamController)->danhSachSanPham(),
    'form-them-san-pham' =>(new AdminSanPhamController)->formaddSanpham(),
    'them-san-pham' =>(new AdminSanPhamController)->postaddSanpham(),
    'form-sua-san-pham' =>(new AdminSanPhamController)->formEditSanpham(),
    'sua-san-pham' =>(new AdminSanPhamController)->postEditSanpham(),
    'xoa-san-pham' =>(new AdminSanPhamController)->deleteSanpham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController)->detailSanpham(),

 };


