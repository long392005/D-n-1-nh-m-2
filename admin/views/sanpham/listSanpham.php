<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Danh mục sản phẩm | NN Shop</title>
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
        
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Quản lý sản phẩm</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Sản phẩm</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
    <div class="card-header align-items-center d-flex">
    <div style="position: relative; max-width: 250px; margin-right: auto;">
    <input type="text" id="orderSearch" class="form-control search" placeholder="Search..."
           style="width: 100%; border-radius: 20px; padding: 8px 15px; border: 1px solid #ced4da; background-color: #f8f9fa; transition: all 0.3s ease;">
    <i class="ri-search-line search-icon" 
       style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #6c757d; font-size: 16px;"></i>
</div>

        <div class="flex-shrink-0">
<a href="?act=form-them-san-pham" class="btn btn-soft-success material-shadow-none"><i class="ri-add-circle-line align-middle me-1"></i> Thêm sản phẩm</button></a>
        </div>
    </div><!-- end card header -->

   <!-- Striped Rows -->

 
   <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá nhập</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Mô tả chi tiết</th>
                    <th>Danh mục sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>

=
                  <?php foreach ($listsanpham as $key => $sanpham) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $sanpham['ma_san_pham'] ?></td>
                      <td><?= $sanpham['ten_san_pham'] ?></td>
                      <td><img src="<?= BASE_URL . $sanpham['hinh_anh']?>" style="width:80px;" alt=""></td>
                      <td><?= number_format($sanpham['gia_nhap'], 0, ',', '.')  ?>đ</td>
                      <td><?= number_format($sanpham['gia_san_pham'], 0, ',', '.')  ?>đ</td>
                      <td><?= $sanpham['so_luong'] ?></td>
                      <td><?= $sanpham['mo_ta_chi_tiet'] ?></td>
                      <td><?= $sanpham['ten_danh_muc'] ?></td>
                      <td><?= $sanpham['mo_ta'] ?></td>
                      <td>
                      <?php 
                    if ($sanpham['trang_thai'] == 1) {?>
                    <span class="badge bg-success">Còn bán</span>
                      <?php
                    } else { ?>
                        <span class="badge bg-danger">Dừng bán</span>
                        <?php 
                    }
                    ?>
                    </td>
                    <td>
   <div class="btn-group">
    <a href="<?= BASE_URL_ADMIN ?>?act=chi-tiet-san-pham&id_san_pham=<?= $sanpham['id'] ?>">
        <button class="btn btn-primary" ><i class="fa-solid fa-eye"></i></button>
    </a>
   </div>
        
     <div class="hstack gap-3 flex-wrap">
     <a href="?act=form-sua-san-pham&id_san_pham=<?= $sanpham['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
     <form action="?act=xoa-san-pham" method="POST"
      onsubmit="return confirm('Bạn có đồng ý xóa không')">
    <input type="hidden" name="id_san_pham" value="<?= $sanpham['id'] ?>">
    <button type="submit" class="link-danger fs-15" style="border: none; background: none;"><i class="ri-delete-bin-line"></i></button>
    </form>
</div>
     </td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
                
              </table>
    </div><!-- end card-body -->
</div><!-- end card -->


    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>
    <script>
    document.getElementById('orderSearch').addEventListener('keyup', function () {
        var input = document.getElementById('orderSearch').value.toLowerCase();
        var tableRows = document.querySelectorAll('#example1 tbody tr');

        tableRows.forEach(row => {
            var cells = row.getElementsByTagName('td');
            var rowContainsSearchText = Array.from(cells).some(cell => 
                cell.textContent.toLowerCase().includes(input)
            );
            row.style.display = rowContainsSearchText ? '' : 'none';
        });
    });
</script>

    <!-- JAVASCRIPT -->
    <?php
    require_once "views/layouts/libs_js.php";
    ?>

</body>



</html>