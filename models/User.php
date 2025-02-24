<?php
class NguoiDung{
    public $conn;
    public function __construct()
    {
        $this->conn=connectDB();
    }
    public function isEmailUpdate($email, $nguoi_dung_id) {
        $sql = 'SELECT id FROM nguoi_dungs WHERE email = :email AND id != :nguoi_dung_id LIMIT 1';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nguoi_dung_id', $nguoi_dung_id);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }
    public function getTaiKhoanFromEmail($id) {
        try {
            $sql = 'SELECT * FROM nguoi_dungs WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
    
            $result = $stmt->fetch();
           
            return $result;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getDetailData($id){
        try {
            $sql = 'SELECT * FROM nguoi_dungs where id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt ->execute([':id'=>$id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'lỗi ' .$e->getMessage();
        }
    }

    public function updateDataUser($nguoi_dung_id,$ten, $email, $dia_chi,$phone,$pass,$ngay_tao,$gioi_tinh,$avartar,$vai_tro, $trang_thai){
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
            // In ra lỗi nếu có trong câu lệnh SQL
            echo 'Lỗi SQL: ' . $e->getMessage();
            return false;
        }
    }
    public function updatePassword($nguoi_dung_id, $new_password)
    {
        $sql = "UPDATE nguoi_dungs SET pass = :pass WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':pass', $new_password, PDO::PARAM_STR);  // Lưu mật khẩu thuần túy
        $stmt->bindParam(':id', $nguoi_dung_id, PDO::PARAM_INT);
    
        // Thực thi câu lệnh SQL
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>