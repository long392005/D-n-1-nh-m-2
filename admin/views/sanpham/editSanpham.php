
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
                                <h4 class="mb-sm-0">Cập nhật sản phẩm</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Cập nhât sản phẩm</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- Striped Rows -->
        <form action="<?= BASE_URL_ADMIN . '?act=sua-san-pham' ?>" method="post" enctype="multipart/form-data">
                <div class="card-body row">
                <input type="hidden" name="san_pham_id" value="<?= $sanpham['id'] ?>">

                <div class="form-group col-6">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" class="form-control" name="ma_san_pham" placeholder="nhập giá tiền sản phẩm"value="<?= $sanpham['ma_san_pham'] ?>">
                    <?php if(isset($errors['ma_san_pham'])){ ?>
                      <p class="text-danger"><?=$errors['ma_san_pham'] ?></p>
                  <?php  } ?>
                  </div>
                  
                  <div class="form-group col-6">
                    <label for="">tên sản phẩm</label>
                    <input type="text" class="form-control" name="ten_san_pham" placeholder="nhập giá tiền sản phẩm" value="<?= $sanpham['ten_san_pham'] ?>">
                    <?php if(isset($errors['ten_san_pham'])){ ?>
                      <p class="text-danger"><?=$errors['ten_san_pham'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">Giá nhập</label>
                    <input type="number" class="form-control" name="gia_nhap" placeholder="nhập giá tiền sản phẩm" value="<?= $sanpham['gia_nhap'] ?>">
                    <?php if(isset($errors['gia_nhap'])){ ?>
                      <p class="text-danger"><?=$errors['gia_nhap'] ?></p>
                  <?php  } ?>
                  </div>
                  
                  <div class="form-group col-6">
                    <label for="">giá sản phẩm</label>
                    <input type="number" class="form-control" name="gia_san_pham" placeholder="nhập giá tiền sản phẩm" value="<?= $sanpham['gia_san_pham'] ?>">
                    <?php if(isset($errors['gia_san_pham'])){ ?>
                      <p class="text-danger"><?=$errors['gia_san_pham'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">hình ảnh</label>
                    <input type="file" class="form-control" name="hinh_anh" value="<?= $sanpham['hinh_anh'] ?>" >
                    <?php if(isset($errors['hinh_anh'])){ ?>
                      <p class="text-danger"><?=$errors['hinh_anh'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">số lượng</label>
                    <input type="number" class="form-control" name="so_luong" value="<?= $sanpham['so_luong'] ?>" >
                    <?php if(isset($errors['so_luong'])){ ?>
                      <p class="text-danger"><?=$errors['so_luong'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">Lượt xem</label>
                    <input type="number" class="form-control" name="luot_xem" placeholder="nhập giá tiền sản phẩm" value="<?= $sanpham['luot_xem'] ?>">
                    <?php if(isset($errors['luot_xem'])){ ?>
                      <p class="text-danger"><?=$errors['luot_xem'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group col-6">
                    <label for="">ngày nhập</label>
                    <input type="date" class="form-control" name="ngay_nhap" placeholder="nhập tên sản phẩm" value="<?= $sanpham['ngay_nhap'] ?>">
                    <?php if(isset($errors['ngay_nhap'])){ ?>
                      <p class="text-danger"><?=$errors['ngay_nhap'] ?></p>
                  <?php  } ?>
                  </div>

                  <div class="form-group">
                <label for="danh_muc_id">danh mục sản phẩm</label>
                <select id="danh_muc_id" name="danh_muc_id" class="form-control custom-select">
                  <?php foreach ($listdanhmuc as $danhmuc) : ?>
                    <option <?= $danhmuc['id'] == $sanpham['danh_muc_id'] ? 'selected' : '' ?> value="<?= $danhmuc['id'] ?>"><?= $danhmuc['ten_danh_muc'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="trang_thai">trạng thái sản phẩm</label>
                <select id="trang_thai" name="trang_thai" class="form-control custom-select">
                  <option value="1" <?= $sanpham['trang_thai'] == 1 ? 'selected' : '' ?>>Còn bán</option>
                  <option value="2" <?= $sanpham['trang_thai'] == 2 ? 'selected' : '' ?>>Dừng bán</option>
                </select>
              </div>

                  <div class="form-group">
                    <label for="">mô tả</label>
                    <textarea name="mo_ta" id="" class="form-control" placeholder="nhập mô tả"><?= $sanpham['mo_ta']?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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