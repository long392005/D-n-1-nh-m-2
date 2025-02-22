<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Tài khoản bị khóa | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <?php require_once "views/layouts/libs_css.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page Title and Breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Danh sách tài khoản bị khóa</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Tài khoản bị khóa</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Title -->

                    <!-- Card with search and table -->
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <div style="position: relative; max-width: 250px; margin-right: auto;">
                                <input type="text" id="orderSearch" class="form-control search" placeholder="Search..."
                                    style="width: 100%; border-radius: 20px; padding: 8px 15px; border: 1px solid #ced4da; background-color: #f8f9fa; transition: all 0.3s ease;">
                                <i class="ri-search-line search-icon"
                                    style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #6c757d; font-size: 16px;"></i>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
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
                                    <?php if (!empty($listLockedUsers)) : ?>
                                        <?php foreach ($listLockedUsers as $key => $nguoiDung) : ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $nguoiDung['ten'] ?></td>
                                                <td><?= $nguoiDung['email'] ?></td>
                                                <td><?= $nguoiDung['dia_chi'] ?></td>
                                                <td><?= $nguoiDung['phone'] ?></td>
                                                <td><?= $nguoiDung['pass'] ?></td>
                                                <td><?= $nguoiDung['ngay_tao'] ?></td>
                                                <td>
                                                    <img src="<?= BASE_URL . $nguoiDung['avartar'] ?>" style="width:80px;" alt="Avatar">
                                                </td>
                                                <td>
                                                    <span class="badge bg-danger">Đã khóa</span>
                                                </td>
                                                <td>
                                                    <a href="?act=mo-khoa-user&id=<?= $nguoiDung['id'] ?>" class="btn btn-success btn-sm"
                                                        onclick="return confirm('Bạn có chắc muốn mở khóa tài khoản này không?');">
                                                        Mở khóa
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="text-center">Không có tài khoản bị khóa.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end container-fluid -->
            </div><!-- end page-content -->
        </div><!-- end main-content -->
    </div><!-- end layout-wrapper -->

    <!-- JAVASCRIPT -->
    <?php require_once "views/layouts/libs_js.php"; ?>
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
</body>

</html>