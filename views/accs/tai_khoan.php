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
                        <form method="post" action="<?= BASE_URL . '?act=update-tai-khoan' ?>" enctype="multipart/form-data" novalidate="novalidate">
                            <input type="hidden" name="nguoi_dung_id" value="<?= $nguoiDung['id'] ?>">
                            <div class="row">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                       <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                            <img
                                                src="<?= isset($nguoiDung['avartar']) && is_string($nguoiDung['avartar']) ? BASE_URL . $nguoiDung['avartar'] : BASE_URL . './uploads/iconn.jpg'; ?>"
                                                class="rounded-circle img-thumbnail user-profile-image material-shadow"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                alt="user-profile-image">


                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" name="avartar" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <h5 class="fs-16 mb-1"><?= $nguoiDung['ten'] ?></h5>
                                        <p class="text-muted mb-0">Thông tin tài khoản</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="userName" class="form-label">Họ và tên <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="form-control" id="userName" name="ten" value="<?= $nguoiDung['ten'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email <abbr class="required" title="required">*</abbr></label>
                                        <input type="email" class="form-control" id="userEmail" name="email" value="<?= $nguoiDung['email'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPhone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="userPhone" name="phone" value="<?= $nguoiDung['phone'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="userAddress" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" id="userAddress" name="dia_chi" value="<?= $nguoiDung['dia_chi'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Mật khẩu</label>
                                        <input type="password" class="form-control" id="userPassword" name="pass" value="<?= $nguoiDung['pass'] ?>" readonly>
                                        <a href="<?= BASE_URL . '?act=form-password&id_nguoi_dung=' . $nguoiDung['id'] ?>" class="text-primary d-block mt-2">Đổi mật khẩu</a>
                                    </div>


                                </div>
                            </div>
                            <!-- Submit Button -->
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
