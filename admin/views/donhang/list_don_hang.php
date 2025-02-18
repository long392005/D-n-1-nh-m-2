<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


<head>
    <meta charset="utf-8" />
    <title>Danh mục đơn hàng | NN Shop</title>
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
        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>

        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Quản lý đơn hàng</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Đơn hàng</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <!-- Nút thêm khuyến mãi -->
                            

                            <!-- Thanh tìm kiếm -->
                            <div class="col-sm">
                                                <div class="d-flex justify-content-sm-end">
                                                    <div class="search-box ms-2">
                                                    <input type="text" id="orderSearch" class="form-control search" placeholder="Search...">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>

                        </div>

                        <!-- Bảng Đơn Hàng -->
                        <table id="example1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhận</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
// Sắp xếp mảng `$donHangs` theo `ngay_dat` giảm dần
if (!empty($donHangs) && is_array($donHangs)) {
    usort($donHangs, function ($a, $b) {
        return strtotime($b['ngay_dat']) - strtotime($a['ngay_dat']);
    });
}
?>

                                <?php
                                foreach ($donHangs as $key => $donhang) : 
                                    // Kiểm tra nếu 'tong_tien' có giá trị hợp lệ trước khi hiển thị
                                    $tongTien = isset($donhang['tong_tien']) ? $donhang['tong_tien'] : 0;
                                    // Tính tổng tiền bao gồm thuế và phí vận chuyển
                                    $thue = $tongTien * 0.15;
                                    $phi_van_chuyen = 30000;
                                    $tong_cong = $tongTien + $thue + $phi_van_chuyen;
                                ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $donhang['ma_don_hang'] ?></td>
                                        <td><?= $donhang['ten_nguoi_nhan'] ?></td>
                                        <td><?= $donhang['sdt_nguoi_nhan'] ?></td>
                                        <td><?= $donhang['ngay_dat'] ?></td>
                                        <!-- Hiển thị tổng tiền sau khi tính thuế và phí vận chuyển -->
                                        <td><?= number_format($tong_cong, 0, ',', '.') ?> đ</td>
                                        <td><?= $donhang['trang_thai'] ?></td>
                                        <td>
                                            <div class="hstack gap-3 flex-wrap">
                                                <a href="?act=form-sua-don-hang&don_dang_id=<?= $donhang['id'] ?>" style="text-decoration: none;">
                                                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: linear-gradient(135deg, #f39c12, #ffdd57); border: 2px solid #f39c12; border-radius: 50%; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); cursor: pointer; transition: all 0.3s ease;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="#fff">
                                                            <path d="M3 17.25v3h3l9.5-9.5-3-3L3 17.25zM20.7 6.71c.39-.39.39-1.02 0-1.41l-2.29-2.29c-.39-.39-1.02-.39-1.41 0l-3.47 3.47 3 3 3.47-3.47z"/>
                                                        </svg>
                                                    </div>
                                                </a>

                                                <a href="?act=chi-tiet-don-hang&don_hang_id=<?= $donhang['id'] ?>" class="btn btn-primary">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
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
            <?php require_once "views/layouts/libs_js.php"; ?>
        </div>
    </div>
</body>
</html>
