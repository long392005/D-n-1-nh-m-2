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
                                <h4 class="mb-sm-0">Quản lý User</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">User</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Update User</h4>
                            </div><!-- end card header -->
                            <form action="<?= '?act=sua-nguoi-dung' ?>" method="POST" enctype="multipart/form-data">
                                <input type="text" value="<?= $user['id'] ?>" name="id" hidden>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Tên User</label>
                                        <input type="text" class="form-control" name="ten" value="<?= $user['ten'] ?>" placeholder="nhập tên User">

                                    </div>

                                    <div class="form-group">
                                        <label for="">email User</label>
                                        <input type="text" class="form-control" name="email" value="<?= $user['email'] ?>" placeholder="nhập email User">
                                        <?php if (isset($errors['email'])) { ?>
                                            <p class="text-danger"><?= $errors['email'] ?></p>
                                        <?php  } ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Địa chỉ User</label>
                                        <input type="text" class="form-control" name="dia_chi" value="<?= $user['dia_chi'] ?>" placeholder="nhập địa chỉ User">

                                    </div>

                                    <div class="form-group">
                                        <label for="">SĐT User</label>
                                        <input type="text" class="form-control" name="phone" value="<?= $user['phone'] ?>" placeholder="nhập tên User">
                                        <?php if (isset($errors['phone'])) { ?>
                                            <p class="text-danger"><?= $errors['phone'] ?></p>
                                        <?php  } ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Password User</label>
                                        <input type="text" class="form-control" name="pass" value="<?= $user['pass'] ?>" placeholder="nhập tên User">
                                        <?php if (isset($errors['pass'])) { ?>
                                            <p class="text-danger"><?= $errors['pass'] ?></p>
                                        <?php  } ?>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Ngày tạo</label>
                                        <input type="date" class="form-control" name="ngay_tao" value="<?= $user['ngay_tao'] ?>" placeholder="nhập tên User">
                                        <?php if (isset($errors['ngay_tao'])) { ?>
                                            <p class="text-danger"><?= $errors['ngay_tao'] ?></p>
                                        <?php  } ?>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Avatar User</label>

                                        <!-- Input chọn ảnh mới -->
                                        <input type="file" class="form-control" name="avartar">

                                        <!-- Hiển thị ảnh cũ nếu có -->
                                        <?php if (!empty($user['avartar'])): ?>
                                            <br>
                                            <img src="uploads/<?= htmlspecialchars($user['avartar']) ?>" alt="Avatar User" width="100" height="100" style="object-fit: cover; border-radius: 5px;">
                                        <?php endif; ?>

                                        <!-- Hiển thị lỗi nếu có -->
                                        <?php if (isset($errors['avartar'])): ?>
                                            <p class="text-danger"><?= htmlspecialchars($errors['avartar']) ?></p>
                                        <?php endif; ?>
                                    </div>



                                    <div class="mb-3">
                                        <labe for="ForminputState" class="form-label">Trạng thái</labe>
                                        <select class="form-select" name="trang_thai">
                                            <option selected>Chọn trạng thái</option>
                                            <option value="1" <?= $user['trang_thai'] == 1 ? 'selected' : '' ?>>Mở khóa</option>
                                            <option value="2" <?= $user['trang_thai'] == 2 ? 'selected' : '' ?>>Khóa</option>
                                        </select>
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['trang_thai']) ? $_SESSION['errors']['trang_thai'] : '' ?>
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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