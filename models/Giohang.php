<?php
class GioHang {
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getGioHangFromUser($id){
        try {
           $sql = 'SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id';
           $stmt = $this->conn->prepare($sql);
           $stmt->execute([':tai_khoan_id'=>$id]);
           return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getDetailGioHang($id){
        try {
            $sql = 'SELECT chi_tiet_gio_hangs.*, san_phams.ten_san_pham, san_phams.hinh_anh, san_phams.gia_san_pham, san_phams.gia_khuyen_mai, san_phams.gia_nhap
                    FROM chi_tiet_gio_hangs
                    INNER JOIN san_phams ON chi_tiet_gio_hangs.san_pham_id = san_phams.id
                    WHERE chi_tiet_gio_hangs.gio_hang_id = :gio_hang_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function updateData($id,$so_luong){
        try {
            $sql = 'UPDATE chi_tiet_gio_hangs SET so_luong=:so_luong WHERE id=:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->bindParam(':so_luong',$so_luong);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function addGioHang($id){
        try {
            $sql = 'INSERT INTO gio_hangs (tai_khoan_id) VALUE (:id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $this->conn->lastInsertId();
         } catch (Exception $e) {
             echo "Lỗi: " . $e->getMessage();
         }
    }
    public function addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong){
        try {
            $sql = 'INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong)
                    VALUES (:gio_hang_id, :san_pham_id, :so_luong)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id, ':san_pham_id' => $san_pham_id, ':so_luong' => $so_luong]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    
    
    public function addOrUpdateCart($gio_hang_id, $san_pham_id, $so_luong_them) {
        try {
            // Lấy số lượng tồn kho từ bảng san_phams
            $sql = 'SELECT stock FROM san_phams WHERE id = :san_pham_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':san_pham_id' => $san_pham_id]);
            $ton_kho = $stmt->fetchColumn();
    
            if ($ton_kho === false) {
                return ['success' => false, 'message' => 'Sản phẩm không tồn tại.'];
            }
    
            // Lấy số lượng hiện tại của sản phẩm trong giỏ hàng
            $sql = 'SELECT so_luong FROM chi_tiet_gio_hangs 
                    WHERE gio_hang_id = :gio_hang_id AND san_pham_id = :san_pham_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id, ':san_pham_id' => $san_pham_id]);
            $so_luong_hien_tai = $stmt->fetchColumn();
    
            $so_luong_hien_tai = $so_luong_hien_tai ?: 0; // Nếu chưa có, mặc định là 0
    
            // Tính tổng số lượng muốn thêm
            $tong_so_luong = $so_luong_hien_tai + $so_luong_them;
    
            // Kiểm tra tổng số lượng có vượt quá tồn kho không
            if ($tong_so_luong > $ton_kho) {
                return ['success' => false, 'message' => "Không thể thêm vào giỏ hàng. Số lượng yêu cầu vượt quá tồn kho (Tồn kho: $ton_kho)."];
            }
    
            // Nếu sản phẩm đã tồn tại trong giỏ hàng -> Cập nhật
            if ($so_luong_hien_tai > 0) {
                $this->updateData($gio_hang_id, $san_pham_id, $tong_so_luong);
            } else {
                // Nếu chưa tồn tại -> Thêm mới
                $this->addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong_them);
            }
    
            return ['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()];
        }
    }
    
    public function cleaDetailGioHang($giohangid){
        try {
            $sql = 'DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gio_hang_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $giohangid]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    
    public function clearGioHang($nguoiDungid){
        try {
            $sql = 'DELETE FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $nguoiDungid]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    
    public function deleteSanPham($id) {
        try {
            $sql = 'DELETE FROM chi_tiet_gio_hangs WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
}
?>