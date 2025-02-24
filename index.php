<?php 
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/LogoutController.php';
require_once './controllers/UserController.php';



// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/SlideModel.php';
require_once './models/User.php';

// Require toàn bộ file Models




$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    'logout-client' => (new LogoutController())->logout(),

    '/' => (new ListController())->home(),
    'list-san-pham'                 => (new ListController())->listProduct(),
   'chi-tiet-san-pham'=> (new ListController())->detailProduct(),
   'them-binh-luan'=> (new ListController())->addComment(),

    'detail-tai-khoan' =>(new UserController())->formDetail(),
    'update-tai-khoan' =>(new UserController)->updateAcc(),
    'form-password' =>(new UserController)->formPassword(),
    'update-password' =>(new UserController)->updatePassword(),
    


};
