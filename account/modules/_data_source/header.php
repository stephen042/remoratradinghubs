<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="./" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="./_vendors/images/favicon.ico" alt="" class="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="./_vendors/images/favicon.ico" alt="" class="" height="35">
                        <span>R̳e̳m̳o̳r̳a̳t̳r̳a̳d̳i̳n̳g̳h̳u̳b̳s̳</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block my-4 mx-1">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bx bx-bell" style="font-size: 20px;"></i>
                    <sup class="badge bg-primary badge-number">4</sup>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications overflow-auto p-3" style="max-height: 80vh;min-width:300px;">
                    <li class="dropdown-header">
                        <h5>You have 4 new notifications</h5>

                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <div>
                            <h4>Lorem Ipsum</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>30 min. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <div>
                            <h4>Atque rerum nesciunt</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>1 hr. ago</p>
                        </div>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </div><!-- End Notification Nav -->
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
                    <?php if ($account_data["account_role"] == "Investor") { ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item d-block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#KycVerification"><i class="fas fa-profile font-size-16 align-middle me-1"></i> <span key="t-settings">KYC status</span></a>
                    <a class="dropdown-item d-block" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#KycVerification">
                        <?php if ($datasource_kyc['kyc_status'] == "Pending") { ?>

                            <span key="t-settings" class="btn btn-warning btn-sm">
                                <?php echo $datasource_kyc['kyc_status'] ?>
                            </span>
                        <?php } elseif ($datasource_kyc['kyc_status'] == "Completed") { ?>

                            <span key="t-settings" class="btn btn-success btn-sm">
                                Verified
                            </span>
                        <?php } else { ?>

                            <span key="t-settings" class="btn btn-danger btn-sm">
                               UNVERIFIED
                            </span>
                        <?php } ?>
                    </a>
                    <?php } ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="./authx"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">End Session</span></a>
                </div>
            </div>
        </div>
    </div>
</header>