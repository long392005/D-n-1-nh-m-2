<?php 

session_start();
// echo session_id(); 
// var_dump($_SESSION);
// die();


// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once './controllers/LoginController.php';

// Require toàn bộ file Models
require_once './models/Login.php';
require_once './models/Dashboad.php';


// Route
$act = $_GET['act'] ?? '/';

if (!isset($_SESSION['user_admin']) && $act !== 'login-admin' && $act !== 'check-login-admin') {
    header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
    exit();
}
// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),
    'login-admin' => (new LoginController())->formLogin(),
    'check-login-admin' => (new LoginController())->Login(),
    

};