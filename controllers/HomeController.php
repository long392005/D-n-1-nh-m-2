
<?php
require_once './models/SlideModel.php';
require_once './models/SanPham.php';     // Mô hình cho Sản Phẩm

class ListController {
    public $modelSanPham;

    public $modelSlide;
 
    public function __construct() {
        // Khởi tạo models với cơ sở dữ liệu
        $this->modelSanPham = new ListSanPham();  // Mô hình Sản Phẩm
        $this->modelSlide = new SlideModel();  
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
}