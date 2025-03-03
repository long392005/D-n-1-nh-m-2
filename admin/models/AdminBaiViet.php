<?php
class AdminBaiViet
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
    public function InsertBaiViet($title, $content, $ngay_tao_bai_viet, $trang_thai)
    {
        try {
            $sql = 'INSERT INTO bai_viet(title,content,ngay_tao_bai_viet,trang_thai)
            VALUES (:title,:content,:ngay_tao_bai_viet,:trang_thai)';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':title' => $title, ':content' => $content, ':ngay_tao_bai_viet' => $ngay_tao_bai_viet, ':trang_thai' => $trang_thai]);
            return true;
        } catch (Exception $e) {
            echo 'lỗi ' . $e->getMessage();
        }
    }
    public function getOnetBaiViet($id)
    {
        try {
            $sql = 'SELECT * FROM bai_viet where id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'lỗi ' . $e->getMessage();
        }
    }
    public function UpdateBaiViet($id, $title, $content, $ngay_tao_bai_viet, $trang_thai)
    {
        try {
            $sql = 'UPDATE bai_viet SET title = :title, content = :content, ngay_tao_bai_viet = :ngay_tao_bai_viet, trang_thai = :trang_thai WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id, ':title' => $title, ':content' => $content, ':ngay_tao_bai_viet' => $ngay_tao_bai_viet, ':trang_thai' => $trang_thai]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function destroyBaiViet($id)
    {
        try {
            $sql = 'DELETE FROM bai_viet WHERE
                    id=:id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo 'lỗi ' . $e->getMessage();
        }
    }
}
