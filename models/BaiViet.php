<?php
class ListBaiViet

{
    public $conn;
    public function __construct()
    {
        // Giả sử bạn có hàm connectDB() để kết nối CSDL
        $this->conn = connectDB();
    }
    public function getAllBaiViet()
    {
        try {
            $sql = "SELECT *FROM bai_viet"; // Điều kiện mặc định
            // Chuẩn bị và thực thi câu truy vấn
            $stmt = $this->conn->prepare($sql);



            $stmt->execute();

            // Đảm bảo trả về một mảng, kể cả khi không có dữ liệu
            return $stmt->fetchAll();
        } catch (Throwable $th) {
            // Ghi log lỗi nếu cần
            error_log($th->getMessage());
        }
    }
    public function getOne($id)
    {
        try {
            $sql = 'SELECT *FROM bai_viet  WHERE id = :id'; // Điều kiện mặc định
            // Chuẩn bị và thực thi câu truy vấn
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Liên kết tham số với ID
            $stmt->execute();
            // Đảm bảo trả về một mảng, kể cả khi không có dữ liệu
            return $stmt->fetch();
        } catch (Throwable $th) {
            // Ghi log lỗi nếu cần
            error_log($th->getMessage());
        }
    }
}