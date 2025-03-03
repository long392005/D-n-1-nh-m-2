<?php
<<<<<<< HEAD
class BaiViet
=======
class ListBaiViet

>>>>>>> becebb01f12f8faa4f605ccddf5b9e610d204749
{
    public $conn;
    public function __construct()
    {
<<<<<<< HEAD
=======
        // Giả sử bạn có hàm connectDB() để kết nối CSDL
>>>>>>> becebb01f12f8faa4f605ccddf5b9e610d204749
        $this->conn = connectDB();
    }
    public function getAllBaiViet()
    {
        try {
<<<<<<< HEAD
            $sql = 'SELECT * FROM bai_viet';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
=======
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
>>>>>>> becebb01f12f8faa4f605ccddf5b9e610d204749
