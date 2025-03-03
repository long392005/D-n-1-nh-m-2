<?php
class BaiViet
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllBaiViet()
    {
        try {
            $sql = 'SELECT * FROM bai_viet';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
