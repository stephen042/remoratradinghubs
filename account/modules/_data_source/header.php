<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="./" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="./_vendors/images/logo.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="./_vendors/images/logo.png" alt="" height="35">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div id="google_translate_element" class="google_translate_element"></div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="border-rounded-13 header-profile-user" src="./_vendors/images/placeholder.png" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?php echo $account_data["username"] ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item d-block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#accountInformation"><i class="bx bx-cog font-size-16 align-middle me-1"></i> <span key="t-settings">Account Settings</span></a>
                    <a class="dropdown-item d-block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#accountSecurity"><i class="bx bx-check-shield font-size-16 align-middle me-1"></i> <span key="t-settings">Account Security</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="./authx"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">End Session</span></a>
                </div>
            </div>
        </div>
    </div>
</header>