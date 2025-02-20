
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<head>

    <meta charset="utf-8" />
    <title>Dashboard | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php
    require_once "views/layouts/libs_css.php";
    ?>

</head>

<body>


    <div id="layout-wrapper">

        <?php
        require_once "views/layouts/header.php";

        require_once "views/layouts/siderbar.php";
        ?>
        <div class="main-content">

<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Thêm sản phẩm</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Thêm sản phẩm</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- Striped Rows -->
        <form action="<?= BASE_URL_ADMIN . '?act=them-san-pham' ?>" method="post" enctype="multipart/form-data">
                <div class="card-body row">

                <div class="form-group col-6">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" class="form-control" name="ma_san_pham" placeholder="nhập giá tiền sản phẩm">
                    <?php if(isset($_SESSION['errors']['ma_san_pham'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['ma_san_pham'] ?></p>
                  <?php  } ?>
                  </div>
                  
                  <div class="form-group col-6">
                    <label for="">tên sản phẩm</label>
                    <input type="text" class="form-control" name="ten_san_pham" placeholder="nhập giá tiền sản phẩm">
                    <?php if(isset($_SESSION['errors']['ten_san_pham'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['ten_san_pham'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">giá nhập</label>
                    <input type="number" class="form-control" name="gia_nhap" placeholder="nhập giá tiền sản phẩm">
                    <?php if(isset($_SESSION['errors']['gia_nhap'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['gia_nhap'] ?></p>
                  <?php  } ?>
                  </div>
                  
                  <div class="form-group col-6">
                    <label for="">giá sản phẩm</label>
                    <input type="number" class="form-control" name="gia_san_pham" placeholder="nhập giá tiền sản phẩm">
                    <?php if(isset($_SESSION['errors']['gia_san_pham'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['gia_san_pham'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">hình ảnh</label>
                    <input type="file" class="form-control" name="hinh_anh" >
                    <?php if(isset($_SESSION['errors']['hinh_anh'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['hinh_anh'] ?></p>
                  <?php  } ?>
                  </div>
                  <div class="form-group col-6">
                    <label for="exampleInputEmail1">Album Ảnh</label>
                    <input type="file" class="form-control" name="img_array[]" multiple>           
                  </div>                       
                  <div class="form-group col-6">
                    <label for="">số lượng</label>
                    <input type="number" class="form-control" name="so_luong" >
                    <?php if(isset($_SESSION['errors']['so_luong'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['so_luong'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">Lượt xem</label>
                    <input type="number" class="form-control" name="luot_xem" placeholder="nhập giá tiền sản phẩm">
                    <?php if(isset($_SESSION['errors']['luot_xem'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['luot_xem'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">ngày nhập</label>
                    <input type="date" class="form-control" name="ngay_nhap" placeholder="nhập tên sản phẩm">
                    <?php if(isset($_SESSION['errors']['ngay_nhap'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['ngay_nhap'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">danh mục</label>
                      <select name="danh_muc_id" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>chọn danh mục sản phẩm</option>
                            <?php foreach($listDanhMuc as $danhmuc) :?>
                                <option value="<?= $danhmuc['id'] ?>"><?= $danhmuc['ten_danh_muc'] ?></option>
                              <?php endforeach;?>
                      </select>
                    <?php if(isset($_SESSION['errors']['danh_muc_id'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['danh_muc_id'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">trạng thái</label>
                      <select name="trang_thai" class="form-control" id="exampleFormControlSelect1">
                            <option selected disabled>chọn danh mục sản phẩm</option>
                            <option value="1">còn bán</option>
                            <option value="2">dừng bán</option>

                      </select>
                    <?php if(isset($_SESSION['errors']['trang_thai'])){ ?>
                      <p class="text-danger"><?=$_SESSION['errors']['trang_thai'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-12">
                    <label for="">mô tả</label>
                    <textarea name="mo_ta" id="" class="form-control" placeholder="nhập mô tả"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © Velzon.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Themesbrand
                </div>
            </div>
        </div>
    </div>
</footer>
</div>


</div>



</body>
    <?php
    require_once "views/layouts/libs_js.php";
    ?>

</body>

</html>