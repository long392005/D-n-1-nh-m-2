<?php
class LogoutController{
    public function logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_client'])) {
            $_SESSION['user_client'] = null;
        }
        unset($_SESSION['user_client']);
        session_destroy();
        header('Location: '.BASE_URL.'?act=/');
        exit();
    }
}
?>