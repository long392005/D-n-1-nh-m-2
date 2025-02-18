<?php

class DonHang{

    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getAll($search = null) {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hang.trang_thai
                    FROM don_hangs
                    INNER JOIN trang_thai_don_hang ON don_hangs.trang_thai_id = trang_thai_don_hang.id';

            // Thêm điều kiện tìm kiếm nếu có từ khóa
            if ($search) {
                $sql .= ' WHERE don_hangs.ma_don_hang LIKE :search OR don_hangs.ten_nguoi_nhan LIKE :search';
            }

            $stmt = $this->conn->prepare($sql);

            // Gán giá trị tìm kiếm nếu có
            if ($search) {
                $stmt->bindValue(':search', '%' . $search . '%');
            }

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }}
        public function getDetailDonHang($id) {
            try {
                $sql = 'SELECT don_hangs.*, 
                            trang_thai_don_hang.trang_thai,
                            nguoi_dungs.ten,
                            nguoi_dungs.email,
                            nguoi_dungs.phone,
                            phuong_thuc_thanh_toans.ten_phuong_thuc
                        FROM don_hangs 
                        INNER JOIN trang_thai_don_hang ON don_hangs.trang_thai_id = trang_thai_don_hang.id
                        INNER JOIN nguoi_dungs ON don_hangs.nguoi_dung_id = nguoi_dungs.id
                        INNER JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
                        WHERE don_hangs.id = :id;';
        
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if (!$result) {
                    return null; // Trả về null nếu không có đơn hàng
                }
                return $result;
            } catch (Exception $e) {
                echo 'Lỗi: ' . $e->getMessage();
                return false;
            }
        }
        
    public function getListSpDonHang($id) {
        try {
            $sql = 'SELECT chi_tiet_don_hangs. *, san_phams.ten_san_pham
             FROM  chi_tiet_don_hangs
             INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
              WHERE chi_tiet_don_hangs.don_hang_id=:id';
                   

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function getAllTrangThaiDonHang(){
        try{
         $sql = 'SELECT * FROM trang_thai_don_hang';
         $stmt = $this->conn->prepare($sql);
    
         $stmt->execute();
         return $stmt->fetchAll();
        }catch(PDOException $e){
            echo 'loi:' . $e->getMessage();
        }
    }
    public function getOrderDetails($orderId) {
        try {
            // Lấy chi tiết các sản phẩm trong đơn hàng từ bảng chi_tiet_don_hangs
            $sql = 'SELECT san_phams.gia_khuyen_mai, chi_tiet_don_hangs.so_luong
                    FROM chi_tiet_don_hangs
                    INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                    WHERE chi_tiet_don_hangs.don_hang_id = :orderId';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    

    public function calculateTotal($orderId) {
        $details = $this->getOrderDetails($orderId);  // Lấy thông tin chi tiết đơn hàng
        $total = 0;
        foreach ($details as $item) {
            // Tính tổng tiền (số lượng * đơn giá)
            $total += $item['so_luong'] * $item['gia_khuyen_mai'];
        }
        return $total;
    }
    

    public function getDetailData($id) {
        try {
            $sql = 'SELECT * FROM khuyen_mais WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function updateDonHang($don_hang_id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id) {
        try {
          
            $sql = 'UPDATE don_hangs
                    SET ten_nguoi_nhan = :ten_nguoi_nhan, sdt_nguoi_nhan = :sdt_nguoi_nhan, email_nguoi_nhan = :email_nguoi_nhan, 
                        dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan, ghi_chu = :ghi_chu, trang_thai_id = :trang_thai_id 
                    WHERE id = :don_hang_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam('don_hang_id', $don_hang_id);
            $stmt->bindParam(':ten_nguoi_nhan', $ten_nguoi_nhan);
            $stmt->bindParam(':sdt_nguoi_nhan', $sdt_nguoi_nhan);
            $stmt->bindParam(':email_nguoi_nhan', $email_nguoi_nhan);
            $stmt->bindParam(':dia_chi_nguoi_nhan', $dia_chi_nguoi_nhan);
            $stmt->bindParam(':ghi_chu', $ghi_chu);
            $stmt->bindParam(':trang_thai_id', $trang_thai_id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}

