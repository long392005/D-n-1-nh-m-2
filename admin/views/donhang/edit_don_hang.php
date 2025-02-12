
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

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

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
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
                                <h2 class="mb-sm-1">Quản lý thông tin đơn hàng</h>

                            
                                </div>
                            </div>
                        </div>
                    </div>

    <div class="card-header">
                <h3 class="card-title">Chỉnh sửa thông tin đơn hàng: <?= $donHang['ma_don_hang'] ?></h3>
              </div>
    <br>
              <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="post">
                  <input type="hidden" value="<?= $donHang['id']?>" name="don_hang_id">
              <div class="card-body">
                  <div class="form-group">
                    <label for="">Tên Người nhận</label>
                    <input type="text" class="form-control" name="ten_nguoi_nhan" value="<?= $donHang['ten_nguoi_nhan']?>" placeholder="nhập tên danh mục">
                    <?php if(isset($errors['ten_nguoi_nhan'])){ ?>
                      <p class="text-danger"><?=$errors['ten_nguoi_nhan'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" class="form-control" name="sdt_nguoi_nhan" value="<?= $donHang['sdt_nguoi_nhan']?>" placeholder="nhập tên danh mục">
                    <?php if(isset($errors['sdt_nguoi_nhan'])){ ?>
                      <p class="text-danger"><?=$errors['sdt_nguoi_nhan'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email_nguoi_nhan" value="<?= $donHang['email_nguoi_nhan']?>" placeholder="nhập tên danh mục">
                    <?php if(isset($errors['email_nguoi_nhan'])){ ?>
                      <p class="text-danger"><?=$errors['email_nguoi_nhan'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input type="text" class="form-control" name="dia_chi_nguoi_nhan" value="<?= $donHang['dia_chi_nguoi_nhan']?>" placeholder="nhập tên danh mục">
                    <?php if(isset($errors['dia_chi_nguoi_nhan'])){ ?>
                      <p class="text-danger"><?=$errors['dia_chi_nguoi_nhan'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group">
                    <label for="">Ghi chú</label>
                    <textarea name="ghi_chu" id="" class="form-control" placeholder="nhập mô tả"><?= $donHang['ghi_chu']?></textarea>
                  </div>
                            <hr>

                <div class="form-group">
    <label for="inputStatus" class="form-label">Trạng thái</label>
    <select id="inputStatus" name="trang_thai_id" class="form-control custom-select">
        <?php foreach ($listTrangThaiDonHang as $trangThai): ?>
            <option 
            <?php 
            if($donHang['trang_thai_id']>$trangThai['id']
            || $donHang['trang_thai_id'] == 5
             || $donHang['trang_thai_id'] == 6  
             || $donHang['trang_thai_id'] == 7){
             echo 'disabled';
            }
            ?> 
                <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?> 
                value="<?= $trangThai['id']; ?>">
                <?= $trangThai['trang_thai'] ?>
            </option>
        <?php endforeach ?>
    </select>
</div>

                </div>
                <br>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>

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
<!-- end main content-->

</div>
<!-- END layout-wrapper -->




</body>
    <?php
    require_once "views/layouts/libs_js.php";
    ?>

</body>

</html>