<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Người dùng| NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

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
                                <h4 class="mb-sm-0">Quản lý Người Dùng</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Người dùng</li>
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

                        </div><!-- end card header -->

                        <!-- Striped Rows -->
                        <table id="example1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Password</th>
                                    <th>Ngày tạo</th>
                                    <th>Avatar</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt = 1;
                                foreach ($listNguoiDung as $nguoiDung) :
                                    // Chỉ hiển thị người dùng không bị khóa (trang_thai == 1)
                                    if ($nguoiDung['trang_thai'] != 1) continue;
                                ?>
                                    <tr>
                                        <td><?= $stt++ ?></td>
                                        <td><?= $nguoiDung['ten'] ?></td>
                                        <td><?= $nguoiDung['email'] ?></td>
                                        <td><?= $nguoiDung['dia_chi'] ?></td>
                                        <td><?= $nguoiDung['phone'] ?></td>
                                        <td><?= $nguoiDung['pass'] ?></td>
                                        <td><?= $nguoiDung['ngay_tao'] ?></td>
                                        <td><img src="<?= BASE_URL . $nguoiDung['avartar'] ?>" style="width:80px;" alt="ảnh"></td>
                                        <td>
                                            <span class="badge bg-success">Bình thường</span>
                                        </td>
                                        <td>

                                            <div class="hstack gap-3 flex-wrap">
                                                <a href="?act=form-sua-nguoi-dung&id=<?= $nguoiDung['id'] ?>" class="link-success fs-15">
                                                    <i class="ri-edit-2-line"></i>
                                                </a>
                                                <form action="?act=khoa-user" method="POST" onsubmit="return confirm('Bạn có chắc muốn khóa người dùng này không?')">
                                                    <input type="hidden" name="id_nguoi_dung" value="<?= $nguoiDung['id'] ?>">
                                                    <button type="submit" class="link-danger fs-15" style="border: none; background: none;">
                                                        <i class="fa-solid fa-lock"></i>
                                                    </button>
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
                    document.getElementById('orderSearch').addEventListener('keyup', function() {
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
                <?php require_once "views/layouts/libs_js.php"; ?>
            </div>
        </div>
    </div>
</body>

</html>