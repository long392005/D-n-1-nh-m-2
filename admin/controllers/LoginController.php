
<?php

class LoginController {
    public $modelLogin;
    
    public function __construct() {
        $this->modelLogin = new Login();
    }
    public function index(){
        $nguoidungs= $this->modelLogin;
    }

    public function formLogin(){
        
        require_once './views/acc/formDangNhap.php';
        deleteSessionError();
    }

    public function Login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            $pass = $_POST['pass'];    
            $user = $this->modelLogin->checkLogin($email, $pass);
    
            if (is_array($user)) {
                $_SESSION['user_admin'] = $user;

                if ($user['vai_tro'] == 1) {
                    header('Location: ' . BASE_URL_ADMIN. '?act=/');
                } elseif ($user['vai_tro'] == 2) {
                    header('Location: ' . BASE_URL. '?act=/');
                } else {
                    $_SESSION['error'] = 'Tài khoản không hợp lệ.';
                    header('Location: ' . BASE_URL_ADMIN . '?act=ạdjdjjạdjdjj');
                }
            } else {
                $_SESSION['error'] = 'Email hoặc mật khẩu không đúng.';
                header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');


            }
            exit();
        }
    }
    public function formDetail(){
        $id = $_GET['id_nguoi_dung'] ?? null;    
        $nguoiDung = $this->modelLogin->getDetailData($id);
    
        if ($nguoiDung) {
            $_SESSION['nguoiDung'] = $nguoiDung;
            require_once './views/acc/tai_khoan.php';
        } else {
            $_SESSION['error'] = "Người dùng không tồn tại";
            header('Location: ' . BASE_URL_ADMIN . '?act=detail-tai-khoan');
            exit();
        }
    }
    

    public function updateAcc(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nguoi_dung_id= $_POST['nguoi_dung_id'];
            $nguoi_dung_cu= $this->modelLogin->getDetailData($nguoi_dung_id);
            $file_cu=$nguoi_dung_cu['avartar'];


            $ten = $_POST['ten'];
            $email = $_POST['email'];
            $dia_chi= $_POST['dia_chi'];
            $pass = $_POST['pass'];
            $phone = $_POST['phone'];
            $avartar = $_FILES['avartar'] ?? Null;

            $errors = [];
            if (empty($email)) {
                $errors['email'] = 'Vui lòng nhập email mới';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            } else {
                $email_exist = $this->modelLogin->isEmailUpdate($email, $nguoi_dung_id);
                if ($email_exist) {
                    $errors['email'] = 'Email đã tồn tại';
                }
            }

            

           if(isset($avartar)&& $avartar['error']==UPLOAD_ERR_OK){
            $file_moi=uploadFile($avartar, './uploads/');
            if($file_moi){
                if(!empty($file_cu)){
                    deleteFile($file_cu);
                }
            }else{
                $file_moi=$file_cu;
            }
           }else{
            $file_moi=$file_cu;
           }

           if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ' . BASE_URL_ADMIN . '?act=detail-tai-khoan&id_nguoi_dung=' . $nguoi_dung_id);
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
            header('Location: ' . BASE_URL_ADMIN . '?act=detail-tai-khoan&id_nguoi_dung=' . $nguoi_dung_id);
            exit();
        }
            $this->modelLogin->updateAcc(
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
            header('Location: '. BASE_URL_ADMIN.'?act=detail-tai-khoan&id_nguoi_dung=' . $nguoi_dung_id);
            exit();
        }
    }

    public function formPassword(){
        $id = $_GET['id_nguoi_dung']?? null;    
        $nguoiDung = $this->modelLogin->getDetailData($id);
        if ($nguoiDung) {
            $_SESSION['nguoiDung'] = $nguoiDung;
            require_once './views/acc/doi_mat_khau.php';
        }else{
            $_SESSION['error'] = "Người dùng không tồn tại";
            header('Location: '. BASE_URL_ADMIN.'?act=detail-tai-khoan');
            exit();
        }
    }
    public function updatePassword(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nguoi_dung_id = $_POST['nguoi_dung_id'];
            $mat_khau_cu = $_POST['mat_khau_cu'];
            $mat_khau_moi = $_POST['mat_khau_moi'];
            $xac_nhan_mk = $_POST['xac_nhan_mk'];
            $nguoi_dung_cu= $this->modelLogin->getDetailData($nguoi_dung_id);
            if (!$nguoi_dung_cu) {
                $_SESSION['error'] = 'Người dùng không tồn tại.';
                header('Location: ' . BASE_URL_ADMIN . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            }
            if($mat_khau_cu !== $nguoi_dung_cu['pass']){
                $_SESSION['errors']['mat_khau_cu']='Mật khẩu hiện tại không đúng.';
            }
            if(empty($mat_khau_moi)){
                $_SESSION['errors']['mat_khau_moi']='Vui lòng nhập mật khẩu mới.';
            }elseif(strlen($mat_khau_moi)< 6){
                    $_SESSION['errors']['mat_khau_moi']='Mật khẩu mới phải có ít nhất 6 kí tự.';
            }
            if($mat_khau_moi!== $xac_nhan_mk){
                $_SESSION['errors']['xac_nhan_mk']='Xác nhận mật khẩu mới không đúng.';
            }
            if (!empty($_SESSION['errors'])) {
                header('Location: ' . BASE_URL_ADMIN . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
                exit();
            }
            if($this->modelLogin->updatePass($nguoi_dung_id, $mat_khau_moi)){
                $_SESSION['user_admin']['nguoi_dung_id'] = $nguoi_dung_id;
                $_SESSION['success'] ="Đổi mật khẩu thành công";
                header('Location: ' . BASE_URL_ADMIN . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
            exit();
        } else {
            $_SESSION['error'] = 'Cập nhật mật khẩu thất bại.';
            header('Location: ' . BASE_URL_ADMIN . '?act=form-password&id_nguoi_dung=' . $nguoi_dung_id);
            exit();
        }

            
        }
    }
    public function formDangky(){
        require_once "./views/acc/formDangKy.php";
    }
    public function DangKy(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten = trim($_POST['ten'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $pass = trim($_POST['pass'] ?? '');
            $confirm_pass = trim($_POST['confirm_pass'] ?? '');
            $dia_chi = trim($_POST['dia_chi'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $ngay_tao = date('Y-m-d');
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $avartar = $_FILES['avartar'] ?? '';
            $file_thumb= uploadFile($avartar , './uploads/');
            $errors = [];
            if (empty($ten)) {
                $errors['ten'] = 'Tên không được để trống.';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ.';
            }
           
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Vui lòng chọn giới tính.';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Vui lòng chọn địa chỉ.';
            }
            if (empty($phone)) {
                $errors['phone'] = 'Vui lòng chọn số điện thoại.';
            }
            if (empty($pass)) {
                $errors['pass'] = 'Mật khẩu không được để trống.';
            }
            if (empty($confirm_pass)) {
                $errors['confirm_pass'] = 'Xác nhận mật khẩu không được để trống.';
            } elseif ($pass !== $confirm_pass) {
                $errors['confirm_pass'] = 'Mật khẩu xác nhận không khớp.';
            }
            if(!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['form_data']=$_POST;
                header('Location: '. BASE_URL_ADMIN.'?act=dang-ky');
                exit();
            }
            if ($this->modelLogin->isEmailExists($email)) {
                $_SESSION['errorsEmail'] = ['Email đã được sử dụng.'];
                $_SESSION['form_data'] = $_POST;
                header('Location: '. BASE_URL_ADMIN.'?act=dang-ky');
                exit();
            }
            $vai_tro = 2;
            $trang_thai = 1;
            $result = $this->modelLogin->dangKyUser
            ($ten, $email, $dia_chi, $phone, $pass, $ngay_tao, $gioi_tinh, $file_thumb, $vai_tro, $trang_thai);
            if ($result) {
                $user = $this->modelLogin->getUserByEmail($email);
                    $_SESSION['user_admin'] = [
                        'id' => $user['id'],
                        'ten' => $user['ten'],
                        'email' => $user['email'],
                        'vai_tro' => $user['vai_tro'],
                        'trang_thai' => $user['trang_thai'],
                        'gioi_tinh' => $user['gioi_tinh'],
                        'avartar' => $user['avartar'],
                    ];
                    unset($_SESSION['errors']);
                    unset($_SESSION['form_data']);
                    header('Location: ' . BASE_URL_ADMIN . '?act=dang-ky-thanh-cong');
                    exit();
            }

        }
    }
    public function formDangKyThanhCong(){
        require_once './views/acc/dang_ky_thanh_cong.php';
    }



    public function logout(){
        if (isset($_SESSION['user_admin'])) {
        unset($_SESSION['user_admin']);
        header('Location: '. BASE_URL_ADMIN.'?act=login-admin');
        exit();
        }
    }
}
?>
