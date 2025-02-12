<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/apps-ecommerce-order-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:31:30 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Chi tiết đơn hàng | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <?php
    require_once "views/layouts/libs_css.php";
    ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php
            require_once "views/layouts/header.php";
            require_once "views/layouts/siderbar.php";
        ?>
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Chi tiết đơn hàng</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                                        <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Mã đơn hàng : <?= $donHang['ma_don_hang'] ?></h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap align-middle table-borderless mb-1">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tên sản phẩm</th>
                                                    <th scope="col">Đơn giá</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Ngày đặt</th>
                                                    <th scope="col" >Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
    $tong_tien = 0;
    foreach ($sanPhamDonHang as $key => $sanPham):
        // Tính thành tiền cho mỗi sản phẩm
        $sanPham['thanh_tien'] = $sanPham['don_gia'] * $sanPham['so_luong'];
?>
    <tr>
        <td><?= $sanPham['ten_san_pham'] ?></td>
        <td><?= number_format($sanPham['don_gia'], 0, ',', '.') ?> đ</td>  <!-- Định dạng đơn giá -->
        <td><?= $sanPham['so_luong'] ?></td>
        <td><?= formatDate($donHang['ngay_dat']) ?></td>
        <td><?= number_format($sanPham['thanh_tien'], 0, ',', '.') ?> đ</td> <!-- Định dạng thành tiền -->
    </tr>
<?php 
    $tong_tien += $sanPham['thanh_tien'];  // Cộng tổng thành tiền
endforeach;
?>

<!-- Tính tổng tiền sau thuế và phí vận chuyển -->
<tr class="border-top border-top-dashed">
    <td colspan="3"></td>
    <td colspan="2" class="fw-medium p-0">
        <table class="table table-borderless mb-0">
            <tbody>
                <tr>
                    <td>Sub Total :</td>
                    <td class="text-end"><?= number_format($tong_tien, 0, ',', '.') ?> đ</td> <!-- Hiển thị tổng tiền sản phẩm -->
                </tr>
                <tr>
                    <td>Thuế (15%) :</td>
                    <td class="text-end"><?= number_format($tong_tien * 0.15, 0, ',', '.') ?> đ</td> <!-- Hiển thị thuế -->
                </tr>
                <tr>
                    <td>Phí vận chuyển :</td>
                    <td class="text-end"><?= number_format(30000, 0, ',', '.') ?> đ</td> <!-- Hiển thị phí vận chuyển -->
                </tr>
                <tr class="border-top border-top-dashed">
                    <th scope="row">Tổng cộng (Thanh toán) :</th>
                    <td class="text-end">
                        <?= number_format($tong_tien + 30000 + ($tong_tien * 0.15), 0, ',', '.') ?> đ
                    </td> <!-- Tổng tiền bao gồm thuế và phí vận chuyển -->
                </tr>
            </tbody>
        </table>
    </td>
</tr>

                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="profile-timeline">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item border-0">
                                                <div class="accordion-header" id="headingOne">
                                                        <div class="d-flex align-items-center">
                                                            <form action="" method="post">
                                                            <div class="col-12">
                                                                <div class="mb-4">
                                                                    <label for="ForminputState" class="form-label">Trạng thái đơn hàng</label>
                                                                    <select id="ForminputState" class="form-select">
                                                                    <?php foreach($listTrangThaiDonHang as $key=>$trangThai): ?>
                                                                        <option 
                                                                        <?= $trangThai['id']==$donHang['trang_thai_id'] ? 'selected ':'' ?>
                                                                        <?=$trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled':'' ?>
                                                                                value="<?= $trangThai['id']; ?>">
                                                                                <?= $trangThai['trang_thai'];?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div><!--end col-->
                                                            </form>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php 
                                                    if ($donHang['trang_thai_id'] == 1) {
                                                        $colorAlerts = 'primary';
                                                    } elseif ($donHang['trang_thai_id']==2 && $donHang['trang_thai_id'] ){
                                                        $colorAlerts = 'warning';
                                                    }elseif ($donHang['trang_thai_id']==6){
                                                        $colorAlerts = 'success';
                                                    } else{
                                                        $colorAlerts = 'danger';

                                                    }
                                                
                                                    ?>

                                                    
                                                <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                                                Đơn hàng: <?= $donHang['trang_thai'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end accordion-->
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                                        <h5 class="fs-16 mt-2">RQK Logistics</h5>
                                        <p class="fw-medium fs-14">Phương thức thanh toán:                                                       <?php 
                                                    if ($donHang['ten_phuong_thuc'] == 1) {
                                                        $colorAlerts = 'danger';
                                                    } else{
                                                        $colorAlerts = 'primary';
                                                    }
                                                
                                                    ?></p>
                                                    <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                                                <?= $donHang['ten_phuong_thuc'] ?>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->

                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <h5 class="card-title flex-grow-1 mb-0">Chi tiết khách hàng</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0 vstack gap-3">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0"> Tên : 
                                                <?= $donHang['ten_nguoi_nhan'] ?>
                                                </div>
                                            </div>
                                        </li>
                                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i><?=  $donHang['email_nguoi_nhan']?></li>
                                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i><?=  $donHang['sdt_nguoi_nhan'] ?></li>
                                    </ul>
                                </div>
                            </div>
                            <!--end card-->
                            <!--end card-->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Địa chỉ nhận hàng</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                        <li class="fw-medium fs-14"><?=  $donHang['dia_chi_nguoi_nhan'] ?></li>

                                    </ul>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
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

    <?php require_once "views/layouts/libs_js.php"; ?>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/apps-ecommerce-order-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:31:30 GMT -->
</html>