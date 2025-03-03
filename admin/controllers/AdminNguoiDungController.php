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

        $id = $_GET['id'];
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
            // Lấy dữ liệu từ form
            $id = $_POST['id'];
            $ten = $_POST['ten'];
            $email = $_POST['email'];
            $dia_chi = $_POST['dia_chi'];
            $phone = $_POST['phone'];
            $pass = $_POST['pass'];
            $ngay_tao = $_POST['ngay_tao'];
            $trang_thai = $_POST['trang_thai'];

            // Lấy thông tin user hiện tại từ database
            $oldUser = $this->modelNguoiDung->getOneUser($id);
            $avartar = $oldUser['avartar']; // Giữ avatar cũ mặc định

            // Xử lý upload ảnh mới nếu có
            if (!empty($_FILES['avartar']['name'])) {
                $targetDir = "uploads/"; // Thư mục lưu ảnh
                $fileName = time() . "_" . basename($_FILES['avartar']['name']);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['avartar']['tmp_name'], $targetFilePath)) {
                        // Nếu upload thành công, cập nhật avatar mới
                        $avartar = $fileName;
                    } else {
                        $errors['avartar'] = 'Lỗi khi tải ảnh lên';
                    }
                } else {
                    $errors['avartar'] = 'Chỉ chấp nhận file ảnh (JPG, JPEG, PNG, GIF)';
                }
            }

            // Kiểm tra lỗi nhập liệu
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
                // Cập nhật thông tin người dùng
                $this->modelNguoiDung->UpdateUser($id, $ten, $email, $dia_chi, $phone, $pass, $ngay_tao, $avartar, $trang_thai);
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
