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
            $sql = 'UPDATE nguoi_dungs SET ten = :ten, email = :email, dia_chi = :dia_chi, phone = :phone, pass = :pass, ngay_tao = :ngay_tao, gioi_tinh = :gioi_tinh, avartar = :avartar, vai_tro = :vai_tro, trang_thai = :trang_thai WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id, ':ten' => $ten, ':email' => $email, ':dia_chi' => $dia_chi, ':phone' => $phone, ':pass' => $pass, ':ngay_tao' => $ngay_tao, ':avartar' => $avartar, ':trang_thai' => $trang_thai]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
}
