

<?php 
class donHangController {
    public $modelDonHang;

    public function __construct(){
        $this->modelDonHang = new DonHang();
    }

    public function index() {
        // Lấy từ khóa tìm kiếm từ query string (nếu có)
        $search = isset($_GET['search']) ? $_GET['search'] : null;

        // Lấy danh sách đơn hàng có áp dụng tìm kiếm nếu có từ khóa
        $donHangs = $this->modelDonHang->getAll($search);
        foreach ($donHangs as &$order) {
            $order['tong_tien'] = $this->modelDonHang->calculateTotal($order['id']);
        }
        require_once './views/donhang/list_don_hang.php';
    }

    
    public function detailDonHang() {
      $don_hang_id=$_GET['don_hang_id'];


      $donHang= $this->modelDonHang->getDetailDonHang($don_hang_id);

      $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
     
      $listTrangThaiDonHang= $this->modelDonHang->getAllTrangThaiDonHang();
      require_once './views/donhang/detail_don_hang.php';   
    
    }
    
    

    public function edit(){
        $id=$_GET['don_dang_id'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang= $this->modelDonHang->getAllTrangThaiDonHang();
        if ($donHang) {
            require_once './views/donhang/edit_don_hang.php';
        deleteSessionError();
        } else{
            header("Location:" . BASE_URL_ADMIN. '?act=don-hang');
            exit();
        }
        require_once './views/donhang/edit_don_hang.php';
    }  

        public function update(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Lấy dữ liệu từ form
                $don_hang_id = $_POST['don_hang_id'];
                $ma_don_hang = $_POST['ma_don_hang'];
                $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
                $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
                $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
                $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
                $ghi_chu = $_POST['ghi_chu'];
                $trang_thai_id = $_POST['trang_thai_id'];
                  $errors = [];
                if(empty($errors)){
                    $this->modelDonHang->updateDonHang($don_hang_id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id);
                    unset($_SESSION['errors']);
                    header('Location: ?act=don-hang');
                    exit();  
                } else {
                    $_SESSION['errors'] = $errors;
                    header('Location: ?act=form-sua-don-hang');
                    exit();      
                }
            }
        }
        
    }