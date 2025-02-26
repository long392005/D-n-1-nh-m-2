<?php

class DonHang {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
  public function addChiTietDonHang($donHangid,$sanPhamId, $donGia,$soLuong,$thanhTien){
    try {
        $sql="INSERT INTO chi_tiet_don_hangs(don_hang_id,san_pham_id, don_gia, so_luong,thanh_tien)
        VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong,:thanh_tien)
        ";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute([':don_hang_id'=> $donHangid , 
        ':san_pham_id'=> $sanPhamId,
        ':don_gia'=>$donGia,
        ':so_luong' => $soLuong,
        ':thanh_tien'=>$thanhTien]);
        return true; 
    } catch (\PDOException $e) {
        error_log("SQL Error: " . $e->getMessage()); // Debug lỗi SQL
        return false;
    }

  }
  
    public function getAllOrders($userId) {
        try {
            // Câu truy vấn SQL để lấy thông tin đơn hàng và tính tổng thành tiền từ chi tiết đơn hàng
            $sql = "SELECT 
                        don_hangs.*, 
                        trang_thai_don_hang.trang_thai AS trang_thai,
                        SUM(chi_tiet_don_hangs.so_luong * chi_tiet_don_hangs.don_gia) AS tong_tien
                    FROM don_hangs
                    INNER JOIN trang_thai_don_hang 
                        ON don_hangs.trang_thai_id = trang_thai_don_hang.id
                    LEFT JOIN chi_tiet_don_hangs 
                        ON don_hangs.id = chi_tiet_don_hangs.don_hang_id
                    WHERE don_hangs.nguoi_dung_id = :nguoi_dung_id
                    GROUP BY don_hangs.id
                    ORDER BY don_hangs.ngay_dat DESC";
            
            $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn
            $stmt->execute(['nguoi_dung_id' => $userId]); // Truyền tham số
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả kết quả
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
    
     
    public function getTrangThaiDonHang() {
        try {
            $sql = "SELECT * FROM trang_thai_don_hang";

            $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn
            $stmt->execute(); // Truyền tham số
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả kết quả
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
    
    
    public function getPhuongThucThanhToan() {
        try {
            $sql = "SELECT * FROM phuong_thuc_thanh_toans";
                 
                    
            $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn
            $stmt->execute(); // Truyền tham số
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả kết quả
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
    
    
    public function deleteOrder($orderId) {
        try {
            // Kiểm tra trạng thái đơn hàng
            $sql = "SELECT trang_thai_id FROM don_hangs WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$orderId]); // Truyền tham số
            $order = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy kết quả
    
            // Nếu đơn hàng tồn tại và trạng thái hợp lệ
            if ($order && in_array($order['trang_thai_id'], [1])) {
                // Cập nhật trạng thái đơn hàng thành 7
                $sql = "UPDATE don_hangs SET trang_thai_id = 7 WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$orderId]);
                return true;
            }
    
            return false; // Trạng thái không hợp lệ hoặc không tìm thấy đơn hàng
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    public function getOrderById($orderId) {
        try {
            $sql = "SELECT * FROM don_hangs WHERE id = :id";
                 
                    
            $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn
            $stmt->execute([':id'=>$orderId]); // Truyền tham số
            
            return $stmt->fetch(PDO::FETCH_ASSOC); // Lấy tất cả kết quả
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
    public function getOrderDetails($orderId) {
        try {
            $sql = "SELECT 
            chi_tiet_don_hangs.*,
            san_phams.ten_san_pham,
            san_phams.hinh_anh
        FROM chi_tiet_don_hangs
        JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
        WHERE chi_tiet_don_hangs.don_hang_id = :orderId";
        
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['orderId' => $orderId]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về thông tin đơn hàng
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
    
    public function addDonHang( $nguoi_dung_id,$ten_nguoi_nhan,$email_nguoi_nhan,$sdt_nguoi_nhan,$dia_chi_nguoi_nhan,$ghi_chu,$phuong_thuc_thanh_toan_id,$tong_tien,$ngay_dat,$ma_don_hang,$trang_thai_id) {
        try {
            $sql = 'INSERT INTO don_hangs (nguoi_dung_id,ten_nguoi_nhan,email_nguoi_nhan,sdt_nguoi_nhan,dia_chi_nguoi_nhan,ghi_chu,phuong_thuc_thanh_toan_id,tong_tien,ngay_dat,ma_don_hang,trang_thai_id)
                    VALUES (:nguoi_dung_id,:ten_nguoi_nhan,:email_nguoi_nhan,:sdt_nguoi_nhan,:dia_chi_nguoi_nhan,:ghi_chu,:phuong_thuc_thanh_toan_id,:tong_tien,:ngay_dat,:ma_don_hang,:trang_thai_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':nguoi_dung_id' => $nguoi_dung_id, 
                            ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                             ':email_nguoi_nhan' => $email_nguoi_nhan,
                             ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                             ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                             ':ghi_chu' => $ghi_chu,
                             ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                             ':tong_tien' => $tong_tien,
                             ':ngay_dat' => $ngay_dat,
                             ':ma_don_hang' => $ma_don_hang,
                             ':trang_thai_id' => $trang_thai_id,
                             
                            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function updateSoLuongTonKho($sanPhamId, $soLuong) {
        // Prepare SQL query to update stock
        $sql = "UPDATE san_pham SET so_luong = so_luong + :soLuong WHERE id = :sanPhamId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':soLuong', $soLuong, PDO::PARAM_INT);
        $stmt->bindParam(':sanPhamId', $sanPhamId, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    public function updateOrderStatus($orderId, $newStatus) {
        $sql = "UPDATE don_hangs SET trang_thai_id = :newStatus WHERE id = :orderId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    }