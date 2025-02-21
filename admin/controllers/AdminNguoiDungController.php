<?php

include_once './models/AdminUser.php';
class AdminNguoiDungController
{
    public $modelNguoiDung;


    public function __construct()
    {

        $this->modelNguoiDung = new AdminUser();
    }

    public function dachSachNguoiDung()
    {

        $listNguoiDung = $this->modelNguoiDung->getAllUser();
        require_once './views/nguoidung/list_nguoidung.php';
    }

    public function formEditUser()
    {

        $id = $_GET['id_nguoi_dung'];
        $user = $this->modelNguoiDung->getOneUser($id);

        if ($user) {
            require_once './views/nguoidung/update_nguoidung.php';
        } else {
            header('Location: ?act=nguoi-dung');
            exit();
        }
    }
    public function postEditUser()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy ra dữ liệu
            $id = $_POST['id'];
            $ten = $_POST['ten'];
            $email = $_POST['email'];
            $dia_chi = $_POST['dia_chi'];
            $phone = $_POST['phone'];
            $pass = $_POST['pass'];
            $ngay_tao = $_POST['ngay_tao'];
            $avartar = $_POST['avartar'];

            $trang_thai = $_POST['trang_thai'];


            $errors = [];
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($phone)) {
                $errors['phone'] = 'Phone không được để trống';
            }
            if (empty($pass)) {
                $errors['pass'] = 'Password không được để trống';
            }


            if (empty($errors)) {
                $this->modelNguoiDung->UpdateUser($id, $ten, $email, $dia_chi, $phone, $pass, $ngay_tao,  $avartar,  $trang_thai);
                header('Location: ?act=nguoi-dung');
                exit();
            } else {
                require_once './views/nguoidung/update_nguoidung.php';
            }
        }
    }

    public function resetStatus()
    {
        if (isset($_POST['id_nguoi_dung'])) {
            $id = $_POST['id_nguoi_dung'];

            $result = $this->modelNguoiDung->resetUserStatus($id);

            if ($result) {
                header("Location: index.php?act=nguoi-dung");
                exit();
            } else {
                echo "Có lỗi khi cập nhật trạng thái.";
            }
        } else {
            echo "ID không hợp lệ.";
        }
    }

    public function danhSachTaiKhoanBiKhoa()
    {
        // Lấy danh sách người dùng bị khóa từ model
        $listLockedUsers = $this->modelNguoiDung->getLockedUsers();
        // Load view hiển thị danh sách tài khoản bị khóa
        require_once './views/nguoidung/listtkkhoa.php';
    }

    public function moKhoaUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $this->modelNguoiDung->unlockUser($id);

            if ($result) {
                // Sau khi mở khóa thành công, chuyển hướng về danh sách tài khoản bị khóa
                header("Location: index.php?act=list-tk-khoa");
                exit();
            } else {
                echo "Có lỗi khi mở khóa tài khoản.";
            }
        } else {
            echo "ID không hợp lệ.";
        }
    }
}
