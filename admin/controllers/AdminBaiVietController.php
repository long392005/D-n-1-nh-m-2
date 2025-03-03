<?php
require_once './models/AdminBaiViet.php';
class AdminBaiVietController
{
    public $modleBaiViet;
    public function __construct()
    {

        $this->modleBaiViet = new AdminBaiViet();
    }
    public function danhSachBaiViet()
    {
        $listBaiViet = $this->modleBaiViet->getAllBaiViet();
        require_once './views/baiviet/list.php';
    }
    public function formAddBaiViet()
    {
        require_once './views/baiviet/addBaiViet.php';
    }
    public function addBaiViet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $ngay_tao_bai_viet = $_POST['ngay_tao_bai_viet'];
            $trang_thai = $_POST['trang_thai'];
            $errors = [];
            if (empty($title)) {
                $errors['title'] = 'tên danh mục không được để trống';
            }
            if (empty($errors)) {
                $this->modleBaiViet->InsertBaiViet($title, $content, $ngay_tao_bai_viet, $trang_thai);
                header('Location: ?act=bai-viet');
                exit();
            } else {
                require_once './views/baiviet/addBaiViet.php';
            }
        }
    }

    public function formEditBaiViet()
    {

        $id = $_GET['id_bai_viet'];
        $baiviet = $this->modleBaiViet->getOnetBaiViet($id);

        if ($baiviet) {
            require_once './views/baiviet/editBaiViet.php';
        } else {
            header('Location: ?act=bai-viet');
            exit();
        }
    }
    public function postEditBaiViet()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy ra dữ liệu
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $ngay_tao_bai_viet = $_POST['ngay_tao_bai_viet'];
            $trang_thai = $_POST['trang_thai'];


            $errors = [];
            if (empty($title)) {
                $errors['title'] = 'tên danh mục không được để trống';
            }


            if (empty($errors)) {
                $this->modleBaiViet->UpdateBaiViet($id, $title, $content, $ngay_tao_bai_viet, $trang_thai);
                header('Location: ?act=bai-viet');
                exit();
            } else {
                require_once './views/baiviet/editBaiViet.php';
            }
        }
    }

    public function deleteBaiViet()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_bai_viet'];
            $this->modleBaiViet->destroyBaiViet($id);
            header('Location: ?act=bai-viet');
            exit();
        }
    }
}
