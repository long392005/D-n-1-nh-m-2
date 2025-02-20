<?php

class AdminSanPham {

    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Get all products with their associated category name
    public function getAllSanPham() {
        try {
            // Corrected SQL query to fetch all products and their category names
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();  // Fetch all the records

        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function insertAlbumAnhSanPham($san_pham_id , $link_hinh_anh){
        try{
            $sql= 'INSERT INTO hinh_anh_san_phams (san_pham_id , link_hinh_anh) 
                        VALUES          (:san_pham_id ,:link_hinh_anh)' ;
            $stmt= $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh,
            ]);
            return true;
        }catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();

        }
    }
    public function getListAnhSanPham($id){
        try{
            $sql= 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id =:id';
            $stmt= $this->conn->prepare($sql);
            $stmt->execute([':id'=>$id]);
            return $stmt->fetchAll();
        }catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();

        }
    }
    // Insert new product
    public function InsertSanPham($ma_san_pham, $ten_san_pham, $gia_nhap, $gia_san_pham, $so_luong, $luot_xem, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh) {
        try {
            $sql = 'INSERT INTO san_phams (ma_san_pham, ten_san_pham, gia_nhap, gia_san_pham, so_luong, luot_xem, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
                    VALUES (:ma_san_pham, :ten_san_pham, :gia_nhap, :gia_san_pham, :so_luong, :luot_xem, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ma_san_pham' => $ma_san_pham,
                ':ten_san_pham' => $ten_san_pham,
                ':gia_nhap' => $gia_nhap,
                ':gia_san_pham' => $gia_san_pham,
                ':so_luong' => $so_luong,
                ':luot_xem' => $luot_xem,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
            ]);
    
            return $this->conn->lastInsertId();  // Return the last inserted product ID
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    // Get one product by ID
    public function getOnetSanPham($id) {
        try {
            $sql= 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id 
            WHERE san_phams.id =:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();  // Fetch a single record by ID
        } catch (Exception $e) {
            echo 'lỗi ' . $e->getMessage();
        }
    }

    // Update a product by ID
    public function UpdateSanPham($san_pham_id, $ma_san_pham, $ten_san_pham, $gia_nhap, $gia_san_pham, $so_luong, $luot_xem, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh) {
        try {
            $sql = 'UPDATE san_phams SET 
                        ma_san_pham = :ma_san_pham,
                        ten_san_pham = :ten_san_pham,
                        gia_nhap = :gia_nhap,
                        gia_san_pham = :gia_san_pham,
                        so_luong = :so_luong,
                        luot_xem = :luot_xem,
                        ngay_nhap = :ngay_nhap,
                        danh_muc_id = :danh_muc_id,
                        trang_thai = :trang_thai,
                        mo_ta = :mo_ta,
                        hinh_anh = :hinh_anh
                    WHERE id = :san_pham_id';
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':ma_san_pham' => $ma_san_pham,
                ':ten_san_pham' => $ten_san_pham,
                ':gia_nhap' => $gia_nhap,
                ':gia_san_pham' => $gia_san_pham,
                ':so_luong' => $so_luong,
                ':luot_xem' => $luot_xem,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
            ]);
    
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi SQL: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteSanPham($id) {
        try {
            $sql = 'DELETE FROM san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function getDetailSanpham($id) {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();  // Fetch a single product detail with category
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function getAnhSanPham($id)
    {
        // Query to get images for the specified product ID
        $sql = "SELECT * FROM san_phams WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getBinhLuanFromSanPham($id) {
        try {
            $sql = 'SELECT binh_luans.*, nguoi_dungs.ten
                    FROM binh_luans
                    INNER JOIN nguoi_dungs ON binh_luans.nguoi_dung_id = nguoi_dungs.id
                    WHERE binh_luans.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();  // Fetch all reviews for the specified product
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    
    
    

    public function xoaBinhLuan($id_binh_luan) {
        try {
            $sql = 'DELETE FROM binh_luans WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id_binh_luan, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
    
    public function getDetailBinhLuan($id) {
        try {
            $sql = 'SELECT binh_luans.*, nguoi_dungs.ten
                    FROM binh_luans
                    INNER JOIN nguoi_dungs ON binh_luans.nguoi_dung_id = nguoi_dungs.id
                    WHERE binh_luans.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();  // Fetch a single review by its ID
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    
    
    public function updateTrangThaiBinhLuan($id, $trang_thai) {
        try {
            $sql = 'UPDATE binh_luans
                    SET trang_thai = :trang_thai
                    WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':trang_thai', $trang_thai, PDO::PARAM_INT);
            $stmt->execute();
            return true;  // Return true if the update was successful
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;  // Return false if there was an error
        }
    }
    


    // Destructor to close the connection
    public function __destruct() {
        $this->conn = null;
    }

}

   ?>
   <?php class AdminDanhGia {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getDanhGiaBySanPham($san_pham_id) {
        try {
            $sql = 'SELECT danh_gias.*, nguoi_dungs.ten
                    FROM danh_gias
                    INNER JOIN nguoi_dungs ON danh_gias.nguoi_dung_id = nguoi_dungs.id
                    WHERE danh_gias.san_pham_id = :san_pham_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':san_pham_id' => $san_pham_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
}