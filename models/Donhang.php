<?php
class DonHangs
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function addChiTietDonHang($donHangid, $sanPhamId, $donGia, $soLuong, $thanhTien)
    {
        try {
            $sql = "INSERT INTO chi_tiet_don_hangs(don_hang_id,san_pham_id, don_gia, so_luong,thanh_tien)
            VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong,:thanh_tien)
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':don_hang_id' => $donHangid,
                ':san_pham_id' => $sanPhamId,
                ':don_gia' => $donGia,
                ':so_luong' => $soLuong,
                ':thanh_tien' => $thanhTien
            ]);
            return true;
        } catch (\PDOException $e) {
            error_log("SQL Error: " . $e->getMessage());
            return false;
        }
    }
    public function getAllOrders($userId)
    {
        try{
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
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['nguoi_dung_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
}
