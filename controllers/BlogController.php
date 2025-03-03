<?php 
class ListBlogController

{
    public $modelBaiViet;
    public function __construct()
    {
        $this->modelBaiViet = new ListBaiViet();
    }
    // require_once './views/listBlog.php';
    public function ListBlog()
    {
    $listBaiViet = $this->modelBaiViet->getAllBaiViet();

    // Ensure $listBaiViet is always an array, even if no posts are found
    if (!is_array($listBaiViet)) {
        $listBaiViet = [];
    }

    // Pass $listBaiViet to the view
    require_once './views/baiviet/listBlog.php';
    }

    public function detailBlog()
    {
        $id = $_GET['id'];
        if ($id) {
            $detailBaiViet = $this->modelBaiViet->getOne($id); // Lấy thông tin bài viết từ model theo ID
        } else {
            // Xử lý khi không có ID (hoặc thông báo lỗi)
            echo "Bài viết không tồn tại!";
            exit;
        }
        require_once './views/baiviet/detailBlog.php';                        
    } 
}

