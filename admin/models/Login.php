<?php


class Login {
    public $conn;

    public function __construct(){
        $this->conn = connectDB();
    }
    
    public function checkLogin($email, $pass) {
        try {
            $sql = 'SELECT * FROM nguoi_dungs WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
    
            $user = $stmt->fetch();
    
            if ($user) {
                
                if ($pass === $user['pass']) {
                    // Kiểm tra trạng thái tài khoản
                    if ($user['trang_thai'] == 1) {
                        return $user; // Trả về thông tin user
                    } else {
                        return "Tài khoản của bạn đã bị cấm.";
                    }
                } else {
                    return "Mật khẩu không chính xác.";
                }
            } else {
                return "Email không tồn tại.";
            }
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
}