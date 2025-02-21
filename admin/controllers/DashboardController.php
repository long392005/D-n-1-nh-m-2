<?php

class DashboardController {

    public function __construct(){
        $this->modelDashboard = new dashboard();
    }
    public function index() {
        $tongSanPham = $this->modelDashboard->countSanPham();
        $tongDonHang = $this->modelDashboard->countDonHang();
        $tongThuNhap = $this->modelDashboard->countThuNhap();
        $tongTaiKhoan = $this->modelDashboard->countTaiKhoan();
        require_once "./models/Dashboard.php";
    }
}