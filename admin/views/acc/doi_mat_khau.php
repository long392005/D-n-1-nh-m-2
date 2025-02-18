<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8">
    <title>Danh mục bài viết | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">

    <!-- CSS -->
    <?php require_once "views/layouts/libs_css.php"; ?>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Cập nhật tài khoản</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Cập nhật</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Card Section -->
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="card-body">
                                    <header class="entry-header text-center mb-4">
                                        <h4 class="entry-title">THÔNG TIN NGƯỜI DÙNG</h4>
                                    </header>
                                    <p class="woocommerce-info p-3 border rounded bg-light">Cập nhật thông tin tài khoản</p>
                                    <?php
                                    // Hiển thị thông báo lỗi nếu có
                                    if (isset($_SESSION['error'])) {
                                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                                        unset($_SESSION['error']); // Xóa thông báo lỗi sau khi đã hiển thị
                                    }

                                    // Hiển thị thông báo thành công nếu có
                                    if (isset($_SESSION['success'])) {
                                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                                        unset($_SESSION['success']); // Xóa thông báo sau khi đã hiển thị
                                    }

                                    // Hiển thị các lỗi form nếu có
                                    if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                                        foreach ($_SESSION['errors'] as $error) {
                                            echo '<div class="alert alert-danger">' . $error . '</div>';
                                        }
                                        unset($_SESSION['errors']); // Xóa lỗi sau khi đã hiển thị


                                    }
                                    ?>
                                    <form method="post" action="<?= BASE_URL_ADMIN . '?act=update-password' ?>">
                                        <input type="hidden" name="nguoi_dung_id" value="<?= $nguoiDung['id'] ?>">
                                        <div class="col-md-12 mt-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="mb-3">Đổi mật khẩu</h5>
                                                    <div class="mb-3">
                                                        <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                                                        <input type="password" class="form-control" id="currentPassword" name="mat_khau_cu" placeholder="Nhập mật khẩu hiện tại">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="newPassword" class="form-label">Mật khẩu mới</label>
                                                        <input type="password" class="form-control" id="newPassword" name="mat_khau_moi" placeholder="Nhập mật khẩu mới">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                                                        <input type="password" class="form-control" id="confirmPassword" name="xac_nhan_mk" placeholder="Xác nhận mật khẩu mới">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="<?= BASE_URL_ADMIN . '?act=detail-tai-khoan&id_nguoi_dung=' . $nguoiDung['id'] ?>" class="btn btn-warning btn-sm">Về trang cập nhật</a>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success">Cập nhật</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Top -->
            <button onclick="topFunction()" class="btn btn-danger btn-icon position-fixed bottom-0 end-0 m-3" id="back-to-top">
                <i class="ri-arrow-up-line"></i>
            </button>
        </div>
    </div>

    <!-- Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <?php require_once "views/layouts/libs_js.php"; ?>
</body>

</html>