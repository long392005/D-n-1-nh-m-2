<?php
class AdminDanhMuc {
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getAllDanhMuc(){
        try {
            $sql = 'SELECT * FROM danh_mucs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function InsertDanhMuc($ten_danh_muc,$mo_ta, $trang_thai){
        try {
            $sql = 'INSERT INTO danh_mucs(ten_danh_muc,mo_ta,trang_thai)
            VALUES (:ten_danh_muc,:mo_ta,:trang_thai)';

            $stmt = $this->conn->prepare($sql);
            $stmt ->execute([':ten_danh_muc'=>$ten_danh_muc,':mo_ta'=>$mo_ta,':trang_thai'=>$trang_thai]);
            return true;

        } catch (Exception $e) {
            echo 'lỗi ' .$e->getMessage();
        }
    }
    public function getOnetDanhMuc($id){
        try {
            $sql = 'SELECT * FROM danh_mucs where id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt ->execute([':id'=>$id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'lỗi ' .$e->getMessage();
        }
    }
    public function UpdateDanhMuc($id, $ten_danh_muc, $mo_ta, $trang_thai){
        try {
            $sql = 'UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta, trang_thai = :trang_thai WHERE id = :id';
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id, ':ten_danh_muc' => $ten_danh_muc, ':mo_ta' => $mo_ta, ':trang_thai' => $trang_thai]);
            
            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    
    public function destroyDanhMuc($id){
        try {
            $sql = 'DELETE FROM danh_mucs WHERE
                    id=:id';

            $stmt = $this->conn->prepare($sql);
            $stmt ->execute([':id'=>$id]);
            return true;

        } catch (Exception $e) {
            echo 'lỗi ' .$e->getMessage();
        }
    }
}