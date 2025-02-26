
<?php
require_once './models/SlideModel.php';
require_once './models/SanPham.php';     // Mô hình cho Sản Phẩm

class ListController {
    public $modelSanPham;
    public $modelGioHang;
    public $modelSlide;
    public $modelDatHang;
    public $modelNguoiDung;

    public $modelDonHang;
    public function __construct() {
        // Khởi tạo models với cơ sở dữ liệu
        $this->modelSanPham = new ListSanPham();  // Mô hình Sản Phẩm
        $this->modelSlide = new SlideModel();  
        $this->modelGioHang = new GioHang();  
        $this->modelNguoiDung = new NguoiDung(); 
        $this->modelDatHang = new DatHang();
        $this->modelDonHang = new DonHangs();
    }
    public function home() {
        // Lấy danh sách sản phẩm
        $listSanPham = $this->modelSanPham->getAllSanPham();
        if (!is_array($listSanPham)) {
            $listSanPham = []; // Đảm bảo dữ liệu luôn là mảng
        }

        // Lấy danh sách slides (Banner)
        $slides = $this->modelSlide->getAllSlides();
        if (!is_array($slides)) {
            $slides = []; // Đảm bảo dữ liệu luôn là mảng
        }
        
        // Truyền dữ liệu ra view
        require_once './views/home.php';
    }
    // Danh sách sản phẩm với lọc và phân trang
    public function listProduct() {
        // Lấy dữ liệu lọc từ URL (nếu có)
        $filters = [
            'search' => $_GET['search'] ?? '',  // Tìm kiếm sản phẩm theo tên
            'category' => $_GET['category'] ?? '',  // Lọc theo danh mục
            'min_price' => $_GET['min_price'] ?? '',  // Giá tối thiểu
            'max_price' => $_GET['max_price'] ?? '',  // Giá tối đa
            'order' => $_GET['order'] ?? '',  // Sắp xếp sản phẩm
        ];

        // Xác định số trang hiện tại (default là trang 1)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 10;  // Số sản phẩm trên mỗi trang

        // Lấy danh sách sản phẩm dựa trên bộ lọc và phân trang
        $listSanPham = $this->modelSanPham->getAllSanPham($filters, $page, $itemsPerPage);
        
        if (!is_array($listSanPham)) {
            $listSanPham = [];  // Nếu không có sản phẩm, khởi tạo giá trị mặc định
        }

        // Lấy tổng số sản phẩm để tính số trang
        $totalProducts = $this->modelSanPham->getTotalProducts($filters);
        $totalProducts = is_numeric($totalProducts) ? (int)$totalProducts : 0; // Đảm bảo giá trị là số
        $totalPages = ceil($totalProducts / $itemsPerPage);  // Tính tổng số trang
        // Lấy danh mục (để hiển thị trong form lọc)
        $listCategories = $this->modelSanPham->getAllCategories();
        if (!is_array($listCategories)) {
            $listCategories = [];  // Khởi tạo giá trị mặc định nếu không có danh mục
        }
        // Truyền dữ liệu ra view
        require_once './views/listProduct.php';  // Gọi view listProduct.php để hiển thị
    }
   public function detailProduct(){
    $id = $_GET['id'] ?? null;
    if(!$id || !is_numeric($id)){
        header('Location: ?act=list-san-pham');
        exit();
    }
    $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    $product = $this->modelSanPham->getProductById((int)$id);
    $listBinhLuan=$this->modelSanPham->getBinhLuanFromSanPham($id);
    if(!$product){
      die('Product not found');
    }
    require_once './views/chitietsp.php';
   }
   public function addComment()
   {
     $checkuser = isset($_SESSION['user_admin']);
     if ($checkuser) {
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $idPrd = $_GET['id'];
           // var_dump($idPrd);die;
           $idUser = $_SESSION['user_admin']['id'];
           $content = $_POST['noi_dung'];
           $this->modelSanPham->addComment($idPrd, $idUser, $content);
           header('location: ?act=chi-tiet-san-pham&id=' . $idPrd);
           exit;            
           echo "<script>alert('Thêm bình luận thành công.');</script>";
           exit;
       }
     } else {
       header('Location: http://localhost/base_du_an_1/admin/?act=login-admin');
     }
   }
   public function addGioHang() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_SESSION['user_admin'])) {
            $userId = $_SESSION['user_admin']['id'];
            $san_pham_id = $_POST['san_pham_id'];
            $so_luong = $_POST['so_luong'];

            // Lấy thông tin sản phẩm
            $sanPham = $this->modelSanPham->getProductById($san_pham_id);
            if (!$sanPham) {
                echo "<script>alert('Sản phẩm không tồn tại.');</script>";
                echo "<script>window.location.href = '?act=chi-tiet-san-pham&id=$san_pham_id';</script>";
                exit;
            }
            $tonKho = $sanPham['so_luong']; // Số lượng tồn kho

            // Lấy thông tin giỏ hàng của người dùng
            $gioHang = $this->modelGioHang->getGioHangFromUser($userId);
            if (!$gioHang) {
                // Tạo giỏ hàng mới nếu chưa có
                $gioHangId = $this->modelGioHang->addGioHang($userId);
                $gioHang = ['id' => $gioHangId];
            }
            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            // Kiểm tra số lượng tổng cộng trong giỏ hàng
            $tongSoLuongTrongGio = 0;
            foreach ($chiTietGioHang as $detail) {
                if ($detail['san_pham_id'] == $san_pham_id) {
                    $tongSoLuongTrongGio += $detail['so_luong'];
                }
            }
            $tongSoLuongMoi = $tongSoLuongTrongGio + $so_luong;

            // Kiểm tra tồn kho
            if ($tongSoLuongMoi > $tonKho) {
                echo "<script>alert('Số lượng yêu cầu vượt quá tồn kho. Tồn kho hiện tại là: $tonKho.');</script>";
                echo "<script>window.location.href = '?act=chi-tiet-san-pham&id=$san_pham_id';</script>";
                exit;
            }

            // Thêm hoặc cập nhật sản phẩm trong giỏ hàng
            $checkSanPham = false;
            foreach ($chiTietGioHang as $detail) {
                if ($detail['san_pham_id'] == $san_pham_id) {
                    $newSoLuong = $detail['so_luong'] + $so_luong;
                    $this->modelGioHang->updateData($gioHang['id'], $san_pham_id, $newSoLuong);
                    $checkSanPham = true;   
                    break;
                }
            }
            if (!$checkSanPham) {
                $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
            }

            // Chuyển hướng về giỏ hàng
            header("Location: " . BASE_URL . "?act=gio-hang");
        } else {
            echo "<script>alert('Bạn cần đăng nhập để thêm vào giỏ hàng.');</script>";
            echo "<script>window.location.href = '" . BASE_URL_ADMIN . "?act=login';</script>";
        }
    }
}

public function gioHang() {
    if (isset($_SESSION['user_admin'])) {
        $userId = $_SESSION['user_admin']['id'];
        $mail = $this->modelNguoiDung->getTaiKhoanFromEmail($userId );
        // Lấy dữ liệu giỏ hàng của người dùng
        $gioHang = $this->modelGioHang->getGioHangFromUser($userId );
        if (!$gioHang) {
            $gioHangId = $this->modelGioHang->addGioHang($userId);
            $gioHang = ['id' => $gioHangId];
            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
        } else {
            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
        }
        require_once './views/gioHang.php';
    } else {
        var_dump('Chưa đăng nhập'); die;
    }
}
    public function updateGioHang(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];
            $so_luong = $_POST['so_luong'];
            $errors = [];
            if(empty($so_luong)){
                echo '<script>
                alert("Số lượng sản phẩm phải khác 0!");
                window.location.href = "?act=gio-hang";
              </script>';
            die;
            }
            if(empty($errors)){
                $this->modelGioHang->updateData($id,$so_luong);
                unset($_SESSION['errors']);
                header('Location: ?act=gio-hang');
            }
        }
    }
    
    public function delete(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['gio_hang_id'];
            $this->modelGioHang->deleteSanPham($id);
            header('Location ?act=gio-hang');
            exit();
        }
    }
    public function formDat(){
        if (isset($_SESSION['user_admin'])) {
            $id = $_SESSION['user_admin']['id'];
            $user = $this->modelNguoiDung->getTaiKhoanFromEmail($id);
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id'] );
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            require_once './views/dathang/dat_hang.php';
        }else{
            var_dump('Chưa đăng nhập'); die;
        }
    }
    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin từ form
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $ngay_dat = date("Y-m-d");
            $trang_thai_id = 1; // Trạng thái mặc định
    
            // Lấy thông tin người dùng từ session
            $userId = $_SESSION['user_admin']['id'];
            $user = $this->modelNguoiDung->getTaiKhoanFromEmail($userId);
            $nguoi_dung_id = $user['id'];
    
            // Tạo mã đơn hàng ngẫu nhiên
            $ma_don_hang = 'DH' . rand(1000, 9999);
            
    
            // Thêm đơn hàng
            $donHang = $this->modelDatHang->addDonHang(
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
            );
    
            if ($donHang) {
                // Kiểm tra và xử lý giỏ hàng
                $gioHang = $this->modelGioHang->getGioHangFromUser($nguoi_dung_id);
    
                if ($gioHang) {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
    
                    foreach ($chiTietGioHang as $item) {
                        $sanPhamId = $item['san_pham_id'];
                        $soLuong = $item['so_luong'];
                        $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham'];
    
                        // Kiểm tra tồn kho trước khi trừ
                     
    
                        // Thêm chi tiết đơn hàng
                        $this->modelDonHang->addChiTietDonHang(
                            $donHang,
                            $sanPhamId,
                            $donGia,
                            $soLuong,
                            $donGia * $soLuong
                        );
    
                        // Cập nhật tồn kho
                        $this->modelDatHang->updateSoLuongTonKho($sanPhamId, $soLuong);
                    }
    
                    // Xóa giỏ hàng sau khi thêm vào đơn hàng
                    $this->modelGioHang->cleaDetailGioHang($gioHang['id']);
                    $this->modelGioHang->clearGioHang($nguoi_dung_id);
                }
            }
    
           
            $_SESSION['user_admin']['ma_don_hang'] = $ma_don_hang;
            $_SESSION['user_admin']['tong_tien'] = $tong_tien;
    
    
            header('Location: ' . BASE_URL . '?act=dat-hang-thanh-cong');
            exit();
        }
    }
    public function formDatHangThanhCong()
    {
        require_once './views/dathang/dat_hang_thanh_cong.php';
    }

}