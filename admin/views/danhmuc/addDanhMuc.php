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
                                <h4 class="mb-sm-0">Quản lý danh mục</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Danh mục</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Thêm danh mục</h4>
                            </div><!-- end card header -->   
<<<<<<< HEAD
                                <form action="<?= '?act=them-danh-muc' ?>" method="post">
=======
                                <form action="<?= '?act=them-danh-muc'?>" method="POST">
>>>>>>> dfdbe41b58cea97ffeb1e285a21d2fb4e33d8e61
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Tên danh mục</label>
                                            <input type="text" class="form-control" name="ten_danh_muc" placeholder="nhập tên danh mục">
                                            <?php if(isset($errors['ten_danh_muc'])){ ?>
                                            <p class="text-danger"><?=$errors['ten_danh_muc'] ?></p>
                                        <?php  } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mô tả</label>
                                            <textarea name="mo_ta" id="" class="form-control" placeholder="nhập mô tả"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Trạng thái</label>
                                            <select  class="form-select" name="trang_thai" >
                                            <option selected>Chọn trạng thái</option>

                                                <option value="1">Hiển thị</option>
                                                    <option value="2">Không hiển thi</option>
                                                    </select>
                                                    <span class="text-danger">
                                                    <?= !empty($_SESSION['errors']['trang_thai']) ? $_SESSION['errors']['trang_thai'] : ''?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>
                                </form>
                        </div>                            
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

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

    <!-- JAVASCRIPT -->
    <?php
    require_once "views/layouts/libs_js.php";
    ?>

</body>

</html>