<?php

class DashboardController {
<<<<<<< HEAD

=======
    public $modelDashboard;
    public function __construct(){
        $this->modelDashboard = new dashboard();
    }
>>>>>>> 12e65b11f4f880e76eb74fb443a79d27d0917e10
    public function index() {
        $tongSanPham = $this->modelDashboard->countSanPham();
        $tongDonHang = $this->modelDashboard->countDonHang();
        $tongThuNhap = $this->modelDashboard->countThuNhap();
        $tongTaiKhoan = $this->modelDashboard->countTaiKhoan();
        require_once "./views/dashboard.php";
    }
}