<?php

class LoginController {
    public $modelLogin;
    
    public function __construct() {
        $this->modelLogin = new Login();
    }
    public function index(){
        $nguoidungs= $this->modelLogin
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
                    header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
                }
            } else {
                $_SESSION['error'] = 'Email hoặc mật khẩu không đúng.';
                header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
            }
            exit();
        }
    }
}
?>
