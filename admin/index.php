<?php 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ
require_once './controllers/DonHangController.php';
// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once './models/DonHang.php';
// Require toàn bộ file Models

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),

    'don-hang' =>(new donHangController())->index(),
    'form-sua-don-hang'=>(new donHangController())->edit(),
    'sua-don-hang'=>(new donHangController())->update(),
    'chi-tiet-don-hang'=>(new donHangController())->detailDonHang(),
 };