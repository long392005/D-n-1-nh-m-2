<?php
class UserController
{
    public $modelNguoiDung;
    public function __construct()
    {
        $this->modelNguoiDung = new NguoiDung();
    }

    public function formDetail()
    {
        $id = $_GET['id_nguoi_dung'] ?? null;
        $nguoiDung = $this->modelNguoiDung->getDetailData($id);

        if ($nguoiDung) {
            $_SESSION['nguoiDung'] = $nguoiDung;
            require_once './views/accs/tai_khoan.php';
        } else {
            $_SESSION['error'] = "Người dùng không tồn tại";
            header('Location: ' . BASE_URL . '?act=detail-tai-khoan');
            exit();
        }
    }


    public function updateAcc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nguoi_dung_id = $_POST['nguoi_dung_id'];
            $nguoi_dung_cu = $this->modelNguoiDung->getDetailData($nguoi_dung_id);
            $file_cu = $nguoi_dung_cu['avartar'];


            $ten = $_POST['ten'];
            $email = $_POST['email'];
            $dia_chi = $_POST['dia_chi'];
            $pass = $_POST['pass'];
            $phone = $_POST['phone'];
            $avartar = $_FILES['avartar'] ?? Null;

            $errors = [];
            if (empty($email)) {
                $errors['email'] = 'Vui lòng nhập email mới';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            } else {
                $email_exist = $this->modelNguoiDung->isEmailUpdate($email, $nguoi_dung_id);
                if ($email_exist) {
                    $errors['email'] = 'Email đã tồn tại';
                }
            }



            if (isset($avartar) && $avartar['error'] == UPLOAD_ERR_OK) {
                $file_moi = uploadFile($avartar, './uploads/');
                if ($file_moi) {
                    if (!empty($file_cu)) {
                        deleteFile($file_cu);
                    }
                } else {
                    $file_moi = $file_cu;
                }
            } else {
                $file_moi = $file_cu;
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: ' . BASE_URL . '?act=detail-tai-khoan&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            }
            if (
                $ten == $nguoi_dung_cu['ten'] &&
                $email == $nguoi_dung_cu['email'] &&
                $dia_chi == $nguoi_dung_cu['dia_chi'] &&
                $phone == $nguoi_dung_cu['phone'] &&
                $file_moi == $nguoi_dung_cu['avartar']
            ) {
                $_SESSION['errors'][] = 'Bạn chưa thay đổi thông tin nào!';
                header('Location: ' . BASE_URL . '?act=detail-tai-khoan&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            }
            $this->modelNguoiDung->updateDataUser(
                $nguoi_dung_id,
                $ten,
                $email,
                $dia_chi,
                $phone,
                $file_moi,
                $pass,

                $nguoi_dung_cu['ngay_tao'],
                $nguoi_dung_cu['gioi_tinh'],
                $nguoi_dung_cu['vai_tro'],
                $nguoi_dung_cu['trang_thai']

            );
            $_SESSION['user_admin']['ten'] = $ten;
            $_SESSION['user_admin']['email'] = $email;
            $_SESSION['user_admin']['dia_chi'] = $dia_chi;
            $_SESSION['user_admin']['phone'] = $phone;
            $_SESSION['user_admin']['pass'] = $pass;
            $_SESSION['user_admin']['avartar'] = $file_moi;


            unset($_SESSION['error']);
            unset($_SESSION['errors']);
            $_SESSION['success'] = 'Cập nhật thông tin thành công';
            $_SESSION['flash'] = true;
            header('Location: ' . BASE_URL . '?act=detail-tai-khoan&id_nguoi_dung=' . $nguoi_dung_id);
            exit();
        }
    }

    public function formPassword()
    {
        $id = $_GET['id_nguoi_dung'] ?? null;
        $nguoiDung = $this->modelNguoiDung->getDetailData($id);
        if ($nguoiDung) {
            $_SESSION['nguoiDung'] = $nguoiDung;
            require_once './views/accs/doi_mat_khau.php';
        } else {
            $_SESSION['error'] = "Người dùng không tồn tại";
            header('Location: ' . BASE_URL . '?act=detail-tai-khoan');
            exit();
        }
    }
    public function updatePassword()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nguoi_dung_id = $_POST['nguoi_dung_id'];
            $mat_khau_cu = $_POST['mat_khau_cu'];
            $mat_khau_moi = $_POST['mat_khau_moi'];
            $xac_nhan_mk = $_POST['xac_nhan_mk'];
            $nguoi_dung_cu = $this->modelNguoiDung->getDetailData($nguoi_dung_id);
            if (!$nguoi_dung_cu) {
                $_SESSION['error'] = 'Người dùng không tồn tại.';
                header('Location: ' . BASE_URL . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            }
            if ($mat_khau_cu !== $nguoi_dung_cu['pass']) {
                $_SESSION['errors']['mat_khau_cu'] = 'Mật khẩu hiện tại không đúng.';
            }
            if (empty($mat_khau_moi)) {
                $_SESSION['errors']['mat_khau_moi'] = 'Vui lòng nhập mật khẩu mới.';
            } elseif (strlen($mat_khau_moi) < 6) {
                $_SESSION['errors']['mat_khau_moi'] = 'Mật khẩu mới phải có ít nhất 6 kí tự.';
            }
            if ($mat_khau_moi !== $xac_nhan_mk) {
                $_SESSION['errors']['xac_nhan_mk'] = 'Xác nhận mật khẩu mới không đúng.';
            }
            if (!empty($_SESSION['errors'])) {
                header('Location: ' . BASE_URL . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            }
            if ($this->modelNguoiDung->updatePassword($nguoi_dung_id, $mat_khau_moi)) {
                $_SESSION['user_admin']['nguoi_dung_id'] = $nguoi_dung_id;
                $_SESSION['success'] = "Đổi mật khẩu thành công";
                header('Location: ' . BASE_URL . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            } else {
                $_SESSION['error'] = 'Cập nhật mật khẩu thất bại.';
                header('Location: ' . BASE_URL . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            }
        }
    }
}
