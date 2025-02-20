<?php
class AdminDanhMucController{
    public $modelDanhMuc;

    public function __construct(){
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc(){
        $listDanhMuc = $this->modelDanhMuc-> getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }
    public function formAddDanhMuc(){
        require_once './views/danhmuc/addDanhMuc.php';
    }
    public function addDanhMuc(){
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai= $_POST['trang_thai'];
            $errors = [];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'tên danh mục không được để trống';
            }
            if(empty($errors)){
                $this->modelDanhMuc->InsertDanhMuc($ten_danh_muc,$mo_ta,$trang_thai);
                header('Location: ?act=danh-muc');
                exit();
            }else{
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }
    }
    public function formEditDanhMuc(){

        $id = $_GET['id_danh_muc'];
        $danhmuc = $this->modelDanhMuc->getOnetDanhMuc($id);

        if($danhmuc){
           require_once './views/danhmuc/editDanhMuc.php';

        }else{
            header('Location: ?act=danh-muc');
            exit();

        }
    }
    public function postEditDanhmuc(){

        if($_SERVER['REQUEST_METHOD']== 'POST'){
            //lấy ra dữ liệu
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai= $_POST['trang_thai'];

 
            $errors = [];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'tên danh mục không được để trống';
            }


            if(empty($errors)){
                $this->modelDanhMuc->UpdateDanhMuc($id,$ten_danh_muc,$mo_ta,$trang_thai);
                header('Location: ?act=danh-muc');
            exit();
            }else{
                require_once './views/danhmuc/editDanhMuc.php';

            }
        }
    }

    public function deleteDanhmuc(){
        
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id_danh_muc'];
            $this->modelDanhMuc->destroyDanhMuc($id);
            header('Location: ?act=danh-muc');
            exit();
            }
    
    }
}
?>