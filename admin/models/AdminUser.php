<?php
class AdminUser
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllUser()
    {
        try {
            $sql = 'SELECT * FROM nguoi_dungs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getOneUser($id)
    {
        try {
            $sql = 'SELECT * FROM nguoi_dungs where id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'lỗi ' . $e->getMessage();
        }
    }

    public function UpdateUser($id, $ten, $email, $dia_chi, $phone, $pass, $ngay_tao,  $avartar,  $trang_thai)
    {
        try {
            $sql = 'UPDATE nguoi_dungs SET ten = :ten, email = :email, dia_chi = :dia_chi, phone = :phone, pass = :pass, ngay_tao = :ngay_tao, avartar = :avartar, trang_thai = :trang_thai WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id, ':ten' => $ten, ':email' => $email, ':dia_chi' => $dia_chi, ':phone' => $phone, ':pass' => $pass, ':ngay_tao' => $ngay_tao, ':avartar' => $avartar, ':trang_thai' => $trang_thai]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function resetUserStatus($id)
    {
        try {
            $sql = 'UPDATE nguoi_dungs SET trang_thai = 0 WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function getLockedUsers(): array
    {
        try {
            $sql = "SELECT * FROM nguoi_dungs WHERE trang_thai = 0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ?: [];
        } catch (Exception $e) {
            // Ghi log lỗi nếu cần và trả về mảng rỗng
            return [];
        }
    }

    public function unlockUser($id)
    {
        try {
            $sql = "UPDATE nguoi_dungs SET trang_thai = 1 WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            // Có thể log lỗi ở đây nếu cần
            return false;
        }
    }
}
