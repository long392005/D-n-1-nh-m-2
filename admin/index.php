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

// Require toàn bộ file Models

// Route
$act = $_GET['act'] ?? '/';


if (!isset($_SESSION['user_admin']) && $act !== 'login-admin' && $act !== 'check-login-admin') {
    header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
    exit();
}



match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),

    'don-hang' =>(new donHangController())->index(),
    'form-sua-don-hang'=>(new donHangController())->edit(),
    'sua-don-hang'=>(new donHangController())->update(),
    'chi-tiet-don-hang'=>(new donHangController())->detailDonHang(),

    
    'login-admin' => (new LoginController())->formLogin(),
    'check-login-admin' => (new LoginController())->Login(),
    'detail-tai-khoan' => (new LoginController())->formDetail(),
    'update-tai-khoan'=>(new LoginController())->updateAcc(),
    'form-password' => (new LoginController())->formPassword(),
    'update-password' => (new LoginController())->updatePassword(),
    'logout-admin' => (new LoginController())->logout(),
 };

