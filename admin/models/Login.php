

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
    public function getDetailData($id){
        try {
        $sql = 'SELECT * FROM nguoi_dungs WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo 'Lỗi: ' . $e->getMessage();
        return false;
    }
    
    }
    public function updateAcc($nguoi_dung_id, $ten, $email, $dia_chi, $phone, $avartar, $pass, $ngay_tao, $gioi_tinh, $vai_tro, $trang_thai){
        try {
            $sql = 'UPDATE nguoi_dungs SET
             ten=:ten, 
             email = :email, 
             dia_chi=:dia_chi, 
             phone= :phone, 
             pass=:pass, 
             ngay_tao= :ngay_tao, 
             gioi_tinh=:gioi_tinh,
             avartar= :avartar, 
             vai_tro= :vai_tro, 
             trang_thai= :trang_thai 
             WHERE id= :nguoi_dung_id';
             $stmt = $this->conn->prepare($sql);
             $stmt ->execute([
                ':nguoi_dung_id'=> $nguoi_dung_id,
                ':ten'=> $ten,
                ':email'=> $email,
                ':dia_chi'=> $dia_chi,
                ':phone'=> $phone,
                ':pass'=> $pass,
                ':ngay_tao'=> $ngay_tao,
                ':gioi_tinh'=> $gioi_tinh,
                ':avartar'=> $avartar,
                ':vai_tro'=> $vai_tro,
                ':trang_thai'=> $trang_thai,

            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi SQL: ' . $e->getMessage();
            return false;
        }

    }
    public function updatePass($nguoi_dung_id, $mat_khau_moi){
        $sql = "UPDATE nguoi_dungs SET pass = :pass WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':pass', $mat_khau_moi, PDO::PARAM_STR);
    $stmt->bindParam(':id', $nguoi_dung_id, PDO::PARAM_INT);


    if ($stmt->execute()) {
        return true;
    }
    
    return false;
    }

    public function isEmailUpdate($email, $nguoi_dung_id) {
        $sql = 'SELECT id FROM nguoi_dungs WHERE email = :email AND id != :nguoi_dung_id LIMIT 1';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nguoi_dung_id', $nguoi_dung_id);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

}

