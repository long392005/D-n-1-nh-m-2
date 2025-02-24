<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Người Dùng</title>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/D-n-1-nh-m-2/views/layout/header.php'); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/D-n-1-nh-m-2/views/layout/menu.php'); ?>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body">
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
                        <header class="entry-header text-center mb-4">
                            <h4 class="entry-title">THÔNG TIN NGƯỜI DÙNG</h4>
                        </header>
                        <p class="woocommerce-info p-3 border rounded bg-light mb-4 text-center">Cập nhật thông tin tài khoản</p>

                        <!-- User Info Form -->
                        <form method="post" action="<?= BASE_URL . '?act=update-password' ?>">
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

                            <a href="<?= BASE_URL . '?act=detail-tai-khoan&id_nguoi_dung=' . $nguoiDung['id'] ?>" class="btn btn-warning btn-sm">Về trang cập nhật</a>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <br>
    <br>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/base_du_an_1/views/layout/footer.php'); ?>
</body>

</html>