<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- Thêm JavaScript của Swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Mirrored from themesbrand.com/velzon/html/master/apps-ecommerce-product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:31:05 GMT -->
<head>
<?php require_once "views/layouts/libs_css.php"; ?>
    <meta charset="utf-8" />
    <title>Chi tiết sản phẩm | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Chi tiết sản phẩm</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">sản phẩm</a></li>
                                        <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gx-lg-5">
                                        <div class="col-xl-4 col-md-8 mx-auto">
                                            <div class="product-img-slider sticky-side-div">
                                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                                <div class="col-12">
                                                <img style="width:300px; height:300px;" src="<?= BASE_URL . $sanpham['hinh_anh'] ?>" class="product-image" class="img-fluid d-block">
                                                </div>
                                                    <div class="swiper-button-next material-shadow"></div>
                                                    <div class="swiper-button-prev material-shadow"></div>
                                                </div>
                                                <!-- end swiper thumbnail slide -->
                                                <div class="swiper product-nav-slider mt-2">
    <div class="product-image-thumbs">
        <?php foreach ($listAnhSanPham as $key => $anhSP) : ?>
            <div class="product-image-thumb <?= $key == 0 ? 'active' : '' ?>">
                <img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image" style="width: 80px; height: 80px; object-fit: cover;">
            </div>
        <?php endforeach ?>
    </div>
</div>

                                                <!-- end swiper nav slide -->
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-xl-8">
                                            <div class="mt-xl-0 mt-5">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h4 class="my-3">Tên sản phẩm: <?= $sanpham['ten_san_pham']; ?></h4>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div>
                                                            <a href="apps-ecommerce-add-product.html" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                                    <div class="text-muted fs-16">
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                    </div>
                                                    <div class="text-muted">( 5.50k Customer Review )</div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-file-copy-2-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Mã sản phẩm :</p>
                                                                    <h5 class="mb-0"><?= $sanpham['ma_san_pham'] ?></h5>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Giá tiền :</p>
                                                                    <h5 class="mb-0"><?= $sanpham['gia_san_pham'] ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-stack-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Lượt xem :</p>
                                                                    <h5 class="mb-0"><?= $sanpham['luot_xem'] ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-inbox-archive-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Trạng thái  :</p>
                                                                    <h5 class="mb-0"><?= $sanpham['trang_thai'] == 1  ? 'Còn bán' : 'Dừng bán' ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div>
                                                <div class="product-content mt-5">
                                                    <nav>
                                                        <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                                                          <li class="nav-item">
                                                                <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab" href="#nav-speci" role="tab" aria-controls="nav-speci" aria-selected="true">Specification</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Mô tả sản phẩm</a>
                                                                <!-- <h4 class="mt-3"></h4> -->
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                    <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-speci" role="tabpanel" aria-labelledby="nav-speci-tab">
                                                            <div class="table-responsive">
                                                                <table class="table mb-0">
                                                                <tbody>
                                                                        <tr>
                                                                            <th scope="row" style="width: 200px;">Danh mục</th>
                                                                            <td><?= $sanpham['ten_danh_muc'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Số lượng</th>
                                                                            <td><?= $sanpham['so_luong'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Ngày nhập</th>
                                                                            <td><?= $sanpham['ngay_nhap'] ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                                            <div>
                                                                <h5 class="font-size-16 mb-3"><?= $sanpham['mo_ta'] ?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- product-content -->

                                                <div class="row mt-4">
                                                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                      <a class="nav-item nav-link active" id="product-desc-tab" data-bs-toggle="tab" href="#binh-luan" role="tab" aria-controls="product-desc" aria-selected="true">Bình luận sản phẩm</a>
                      <a class="nav-item nav-link" id="product-rating-tab" data-bs-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Đánh giá sản phẩm</a>
                      <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                          <div class="search-box ms-2">
                            <input type="text" id="orderSearch" class="form-control search" placeholder="Search...">
                            <i class="ri-search-line search-icon"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </nav>

                  <div class="tab-content p-3" id="nav-tabContent">
    <div class="tab-pane fade show active" id="binh-luan" role="tabpanel" aria-labelledby="product-desc-tab">
        <div class="container-fluid">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên người bình luận</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listBinhLuan as $key => $binhLuan) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $binhLuan['ten'] ?></td>
                            <td><?= $binhLuan['noi_dung'] ?></td>
                            <td><?= date('d/m/Y', strtotime($binhLuan['ngay_dang'])) ?></td>
                            <td><?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Ẩn' ?></td>
                            <td>
                                <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="POST">
                                    <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                                    <input type="hidden" name="name_view" value="detail_san_pham">
                                    <input type="hidden" name="id_san_pham" value="<?= $binhLuan['san_pham_id'] ?>">
                                    <button onclick="return confirm('Bạn muốn ẩn bình luận này không?')" class="btn btn-warning">
                                        <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ ẩn' ?>
                                    </button>
                                    <button formaction="<?= BASE_URL_ADMIN . '?act=xoa-binh-luan' ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')" class="btn btn-danger">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
        <h3>Danh sách đánh giá</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên người đánh giá</th>
                    <th>Điểm</th>
                    <th>Nội dung</th>
                    <th>Ngày đăng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listDanhGia as $key => $danhGia) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $danhGia['ten'] ?></td>
                        <td><?= $danhGia['diem'] ?></td>
                        <td><?= $danhGia['noi_dung'] ?></td>
                        <td><?= date('d/m/Y', strtotime($danhGia['ngay_dang'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="<?= BASE_URL_ADMIN . '?act=form-them-danh-gia&id_san_pham=' . $sanpham['id'] ?>" class="btn btn-primary">Thêm đánh giá</a>
    </div>
</div>


                  </div>
                </div>
              </div>
            </div>
          </section>
          <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="btn btn-primary">Quay lại trang sản phẩm</a>
                                                <!-- end card body -->
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

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



    <!--start back-to-top-->

    <?php require_once "views/layouts/libs_js.php"; ?>
    <!-- JAVASCRIPT -->

</body>
<!-- CSS cho các ảnh thu nhỏ dàn ngang và cuộn -->

<!-- Mirrored from themesbrand.com/velzon/html/master/apps-ecommerce-product-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:31:06 GMT -->
</html>