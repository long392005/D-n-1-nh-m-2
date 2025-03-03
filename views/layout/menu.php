<?php
$nguoiDung = $_SESSION['user_admin'] ?? null; // Kiểm tra nếu có thông tin người dùng
?>

<header id="header" class="header header_sticky">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <div class="container">
    <div class="header-desk header-desk_type_1">
      <div class="logo">
        <a href="<?= BASE_URL ?>">
          <img src="./assets/images/logo.png" alt="Uomo" class="logo__image d-block">
        </a>
      </div><!-- /.logo -->

      <nav class="navigation">
        <ul class="navigation__list list-unstyled d-flex">
          <li class="navigation__item">
            <a href="<?= BASE_URL ?>" class="navigation__link">Trang chủ</a>

          </li>
          <li class="navigation__item">
            <a href="?act=list-san-pham" class="navigation__link">Sản phẩm</a>

          </li>
          <li class="navigation__item">
            <a href="?act=list-bai-viet" class="navigation__link">Tin tức</a>

          </li>
          <li class="navigation__item">
            <a href="?act=list-khuyen-mai" class="navigation__link">Khuyến mãi</a>

          </li>
          <li class="navigation__item">
            <a href="<?= BASE_URL . '?act=form-lien-he' ?>" class="navigation__link">Liên hệ</a>

          </li>

        </ul><!-- /.navigation__list -->
      </nav><!-- /.navigation -->

      <div class="header-tools d-flex align-items-center">
        <div class="header-tools__item hover-container">
          <div class="js-hover__open position-relative">
            <button class="header-search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
            <form class="js-search-popup search-field__actor" href="#">
              <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_search" />
              </svg>
              <i class="btn-icon btn-close-lg"></i>
            </form>
          </div>


          <div class="dropdown ms-sm-3 header-item topbar-user">
            <!-- Nút User -->
            <div class="dropdown ms-sm-3 header-item topbar-user">
              <!-- Nút User -->
              <button
                type="button"
                class="btn material-shadow-none"
                id="page-header-user-dropdown"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">

                <span class="d-flex align-items-center">
                  <!-- Ảnh đại diện -->
                  <img
                    class="rounded-circle header-profile-user"
                    style="width: 37px; height: 35px;"
                    src="<?= isset($_SESSION['user_admin']) ? BASE_URL . $_SESSION['user_admin']['avartar'] : BASE_URL . './uploads/iconn.jpg'; ?>"
                    alt="Header Avatar">
                  <!-- Tên user -->
                  <span class="text-start ms-xl-2">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                      <?= isset($_SESSION['user_admin']) ? $_SESSION['user_admin']['ten'] : 'Guest'; ?>
                    </span>
                    <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">
                      <?= isset($_SESSION['user_admin']) ? 'Người dùng' : ''; ?>
                    </span>
                  </span>
                </span>
              </button>

              <!-- Dropdown Menu -->
              <div class="dropdown-menu dropdown-menu-end">
                <?php if (isset($_SESSION['user_admin'])): ?>
                  <!-- Đã đăng nhập -->
                  <h6 class="dropdown-header">
                    Chào <?= $_SESSION['user_admin']['ten'] ?? 'Guest'; ?>!
                  </h6>
                  <!-- Profile -->
                  <a class="dropdown-item" href="?act=detail-tai-khoan&id_nguoi_dung=<?= $nguoiDung['id'] ?? ''; ?>">
                    <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle">Tài khoản</span>
                  </a>
                  <a class="dropdown-item" href="?act=don-hang&id_nguoi_dung=<?= $nguoiDung['id'] ?? ''; ?>">
                    <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle">Đơn hàng</span>
                  </a>
                  <!-- Logout -->
                  <a class="dropdown-item" href="?act=logout-client">
                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle" data-key="t-logout">Đăng xuất</span>
                  </a>
                <?php else: ?>
                  <!-- Chưa đăng nhập -->
                  <h6 class="dropdown-header">
                    Chào mừng, Guest!
                  </h6>
                  <!-- Login -->
                  <a class="dropdown-item" href="<?= BASE_URL_ADMIN . '?act=login-admin' ?>">
                    <i class="mdi mdi-login text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle">Đăng nhập</span>
                  </a>
                <?php endif; ?>
              </div>
            </div>


            <!-- Dropdown Menu -->
            <div class="dropdown-menu dropdown-menu-end">
              <!-- Header -->
              <h6 class="dropdown-header">
                Welcome <?php echo $_SESSION['user_admin']['ten'] ?? 'Guest'; ?>!
              </h6>
              <!-- Profile -->
              <a class="dropdown-item" href="pages-profile.html">
                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Tài khoản</span>
              </a>
              <!-- Logout -->
              <a class="dropdown-item" href="?act=logout-admin&base=user">
                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle" data-key="t-logout">Đăng nhập</span>
              </a>
            </div>
          </div>

          <a class="header-tools__item" href="account_wishlist.html">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_heart" />
            </svg>
          </a>

          <a href="?act=gio-hang" class="header-tools__item" data-aside="cartDrawer">
            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_cart" />
            </svg>
            <span class="cart-amount d-block position-absolute"></span>
          </a>


        </div><!-- /.header__tools -->
      </div><!-- /.header-desk header-desk_type_1 -->
    </div><!-- /.container -->
</header>
<!-- End Header Type 1 -->