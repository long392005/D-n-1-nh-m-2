<?php
class DetailBaiViet
{
    public $conn;
    
    public function __construct()
    {
        // Giả sử bạn đã có hàm kết nối CSDL
        $this->conn = connectDB(); 
    }
    
    public function getOneBaiViet($id)
    {
        try {
            // Câu lệnh SQL lấy thông tin bài viết theo id
            $sql = "SELECT * FROM bai_viet WHERE id = :id"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Đảm bảo tránh SQL Injection
            $stmt->execute();
            
            // Trả về bài viết nếu tìm thấy, nếu không sẽ trả về null
            return $stmt->fetch();
        } catch (Throwable $th) {
            // Ghi log nếu có lỗi
            error_log($th->getMessage());
            return null;
        }
    }
}

