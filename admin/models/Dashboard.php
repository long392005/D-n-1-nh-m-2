<?php
class dashboard
{
public $conn;

public function __construct()
{
  $this->conn = connectDB();
}
  public function countSanPham(){
    try {
      $sql = 'SELECT COUNT(*) AS tong_san_pham FROM san_phams';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch();
      return $result['tong_san_pham'];
    } catch (Exception $e) {
      echo 'Lỗi: ' . $e->getMessage();
      return 0;
    }
  }
  public function countDonHang(){
    try {
      $sql = 'SELECT COUNT(*) AS tong_don_hang FROM don_hangs';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch();
      return $result['tong_don_hang'];
    } catch (Exception $e) {
      echo 'Lỗi: ' . $e->getMessage();
      return 0;
    }
  }
  public function countThuNhap(){
    try {
      $sql = 'SELECT SUM(tong_tien) AS tong_thu_nhap FROM don_hangs';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch();
      return $result['tong_thu_nhap'];
    } catch (Exception $e) {
      echo 'Lỗi: ' . $e->getMessage();
      return 0;
    }
  }
  public function countTaiKhoan(){
    try {
      $sql = 'SELECT COUNT(*) AS tong_tai_khoan FROM nguoi_dungs';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch();
      return $result['tong_tai_khoan'];
    } catch (Exception $e) {
      echo 'Lỗi: ' . $e->getMessage();
      return 0;
    }
  }
}
?>