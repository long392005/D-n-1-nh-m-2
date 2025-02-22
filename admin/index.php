<?php
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

require_once './controllers/DonHangController.php';
require_once './controllers/LoginController.php';

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once './models/DonHang.php';
require_once './models/Login.php';

require_once  './controllers/AdminDanhMucController.php';
require_once  './controllers/AdminSanphamController.php';
// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once './controllers/DashboardController.php';
require_once './controllers/AdminNguoiDungController.php';
// Require toàn bộ file Models

require_once './models/DonHang.php';
require_once './models/Login.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanpham.php';
require_once './models/Dashboard.php';
// Route
$act = $_GET['act'] ?? '/';



if (!isset($_SESSION['user_admin']) && $act !== 'login-admin' && $act !== 'check-login-admin'  && $act !== 'dang-ky' && $act !== 'check-dang-ky') {


    header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
    exit();
}

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),
    'danh-muc'         => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc'     => (new AdminDanhMucController())->addDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhmuc(),
    'xoa-danh-muc'      => (new AdminDanhMucController())->deleteDanhMuc(),
    'sua-danh-muc'      => (new AdminDanhMucController())->postEditDanhmuc(),

    'don-hang'          => (new DonHangController())->index(),
    'form-sua-don-hang' => (new DonHangController())->edit(),
    'sua-don-hang'      => (new DonHangController())->update(),
    'chi-tiet-don-hang' => (new DonHangController())->detailDonHang(),

    'login-admin'       => (new LoginController())->formLogin(),
    'check-login-admin' => (new LoginController())->Login(),
    'dang-ky' => (new LoginController())->formDangky(),
    'check-dang-ky' => (new LoginController())->DangKy(),
    'dang-ky-thanh-cong' => (new LoginController())->formDangKyThanhCong(),
    'nguoi-dung' => (new AdminNguoiDungController())->dachSachNguoiDung(),
    'sua-nguoi-dung' => (new AdminNguoiDungController())->postEditUser(),
    'form-sua-nguoi-dung' => (new AdminNguoiDungController())->formEditUser(),
    'khoa-user' => (new AdminNguoiDungController())->resetStatus(),
    'list-tk-khoa' => (new AdminNguoiDungController())->danhSachTaiKhoanBiKhoa(),
    'mo-khoa-user' => (new AdminNguoiDungController())->moKhoaUser(),
    'detail-tai-khoan'  => (new LoginController())->formDetail(),
    'update-tai-khoan'  => (new LoginController())->updateAcc(),
    'form-password'     => (new LoginController())->formPassword(),
    'update-password'   => (new LoginController())->updatePassword(),
    'logout-admin'      => (new LoginController())->logout(),


    'san-pham' => (new AdminSanPhamController())->index(),
    'form-them-san-pham' => (new AdminSanPhamController())->formaddSanpham(),
    'them-san-pham' => (new AdminSanPhamController())->postaddSanpham(),
    'form-sua-san-pham' => (new AdminSanPhamController())->formEditSanpham(),
    'sua-san-pham' => (new AdminSanPhamController())->postEditSanpham(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanpham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController)->detailSanpham(),
};

