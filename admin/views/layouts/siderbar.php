<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome Anna!</h6>
            <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">


            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Quản lý</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?=BASE_URL_ADMIN?>">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarDanhMuc" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDanhMuc">
                    <i class="ri-stack-line"></i> <span data-key="t-advance-ui">Danh mục sản phẩm</span>
                </a>
                <div class="collapse" id="sidebarDanhMuc">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="?act=danh-muc" class="nav-link">Danh sách</a>
                        </li>
                        <li class="nav-item">
                            <a href="?act=form-them-danh-muc" class="nav-link">Thêm mới</a>
                        </li>
                    </ul>
                </div>
            </li>

                <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarHoadon" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebaHoadon">
                    <i class=" ri-file-paper-2-fill"></i> <span data-key="t-advance-ui"> Quản lí Đơn hàng</span>
                </a>
                <div class="collapse" id="sidebarHoadon">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="?act=don-hang" class="nav-link">Danh sách hóa đơn</a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarSanpham" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSanpham">
                    <i class=" ri-mail-unread-line"></i> <span data-key="t-advance-ui">Quản lý Sản phẩm</span>
                </a>
                <div class="collapse" id="sidebarSanpham">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="?act=san-pham" class="nav-link">Danh sách Sản Phẩm</a>
                        </li>

                        <li class="nav-item">
                            <a href="?act=form-them-san-pham" class="nav-link">Thêm Sản Phẩm</a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>