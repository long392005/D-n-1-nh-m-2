<?php
class DatHang
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function addDonHang(
        $nguoi_dung_id,
        $ten_nguoi_nhan,
        $email_nguoi_nhan,
        $sdt_nguoi_nhan,
        $dia_chi_nguoi_nhan,
        $ghi_chu,
        $phuong_thuc_thanh_toan_id,
        $tong_tien,
        $ngay_dat,
        $ma_don_hang,
        $trang_thai_id  
    ) {
        try {
            $sql = "INSERT INTO don_hangs (
                        nguoi_dung_id,
                        ten_nguoi_nhan,
                        email_nguoi_nhan,
                        sdt_nguoi_nhan,
                        dia_chi_nguoi_nhan,
                        ghi_chu,
                        phuong_thuc_thanh_toan_id,
                        tong_tien,
                        ngay_dat,
                        ma_don_hang,
                        trang_thai_id
                    ) 
                    VALUES (
                        :nguoi_dung_id,
                        :ten_nguoi_nhan,
                        :email_nguoi_nhan,
                        :sdt_nguoi_nhan,
                        :dia_chi_nguoi_nhan,
                        :ghi_chu,
                        :phuong_thuc_thanh_toan_id,
                        :tong_tien,
                        :ngay_dat,
                        :ma_don_hang,
                        :trang_thai_id
                    )";
    
            $stmt = $this->conn->prepare($sql);
    
            
            $stmt->execute([
                ':nguoi_dung_id' => $nguoi_dung_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':tong_tien' => $tong_tien,
                ':ngay_dat' => $ngay_dat,
                ':ma_don_hang' => $ma_don_hang,
                ':trang_thai_id' => $trang_thai_id
            ]);
    
            
            return $this->conn->lastInsertId();
    
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateSoLuongTonKho($sanPhamId, $soLuongMua)
    {
        try {
            $sql = "UPDATE san_phams 
            SET so_luong = so_luong- :so_luong_don_hang
            WHERE id = :san_pham_id AND so_luong >= :so_luong_don_hang";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':so_luong_don_hang' => $soLuongMua,
                ':san_pham_id' => $sanPhamId
            ]);
            if ($stmt->rowCount() == 0) {
                throw new Exception("Sản phẩm mã $sanPhamId không đủ số lượng tồn kho để cập nhật.");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
