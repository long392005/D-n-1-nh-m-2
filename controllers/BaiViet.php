<?php
include_once './models/BaiViet.php';

class BaiVietController
{
    public $modelBaiViet;
    public function __construct()
    {

        $this->modelBaiViet = new BaiViet();
    }
    public function danhSachBaiViet()
    {
        $listBaiViet = $this->modelBaiViet->getAllBaiViet();
        require_once './views/baiviet/list.php';
    }
    public function danhSachBaiVietNguoiDung()
    {
        $listBaiViet = $this->modelBaiViet->getAllBaiViet();
        require_once '../../controllers/BaiViet.php';
    }
}
