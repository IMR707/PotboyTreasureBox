<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item start <?php isBackMenu($menu,'ADMIN_DASHBOARD'); ?>">
            <a href="admin-dashboard.php" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item start <?php isBackMenu($menu,'ADMIN_HOMESLIDER'); ?>">
            <a href="admin-homeslider.php" class="nav-link nav-toggle">
                <i class="icon-picture"></i>
                <span class="title">Image Slider</span>
            </a>
        </li>
        <li class="nav-item start <?php isBackMenu($menu,'ADMIN_ANNOUNCEMENT'); ?>">
            <a href="admin-announcement.php" class="nav-link nav-toggle">
                <i class="icon-volume-2"></i>
                <span class="title">Announcement</span>
            </a>
        </li>
        <li class="nav-item start <?php isBackMenu($menu,'ADMIN_DAILYREWARD'); ?>">
          <a href="javascript:;" class="nav-link nav-toggle">
              <i class="icon-diamond"></i>
              <span class="title">Daily Reward</span>
              <span class="selected"></span>
              <span class="arrow <?php echo isBackMulti($menu,'ADMIN_DAILYREWARD'); ?>"></span>
          </a>
            <ul class="sub-menu">
                <li class="nav-item <?php isBackSubMenu($submenu,'ADMIN_DAILYREWARD_PACKAGE'); ?>">
                    <a href="admin-dailyreward.php" class="nav-link ">
                        <span class="title">Package</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item <?php isBackSubMenu($submenu,'ADMIN_DAILYREWARD_WHEEL'); ?>">
                    <a href="admin-fortunewheel.php" class="nav-link ">
                        <span class="title">Fortune Wheel</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item start <?php isBackMenu($menu,'ADMIN_CONVERSION'); ?>">
            <a href="admin-conversion.php" class="nav-link nav-toggle">
                <i class="icon-shuffle"></i>
                <span class="title">Conversion</span>
            </a>
        </li>
        <li class="nav-item <?php isBackMenu($menu,'ADMIN_SPONSOR'); ?>">
            <a href="admin-sponsor.php" class="nav-link ">
                <i class="icon-user-following"></i>
                <span class="title">Sponsor</span>
            </a>
        </li>
        <li class="nav-item <?php isBackMenu($menu,'ADMIN_PRODUCT'); ?>">
            <a href="admin-product.php" class="nav-link ">
                <i class="icon-basket"></i>
                <span class="title">Product</span>
            </a>
        </li>

        <li class="nav-item <?php isBackMenu($menu,'ADMIN_BIDDING'); ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-trophy"></i>
                <span class="title">Bidding</span>
                <span class="selected"></span>
                <span class="arrow <?php echo isBackMulti($menu,'ADMIN_BIDDING'); ?>"></span>
            </a>
            <ul class="sub-menu">

                <li class="nav-item <?php isBackSubMenu($submenu,'ADMIN_BIDDING_LIST'); ?>">
                    <a href="admin-bidding.php" class="nav-link ">
                        <span class="title">Bidding List</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item <?php isBackSubMenu($submenu,'ADMIN_BIDDING_CLAIM'); ?>">
                    <a href="admin-instantclaim.php" class="nav-link ">
                        <span class="title">Instant Claim List</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item <?php isBackMenu($menu,'ADMIN_WISHLIST'); ?>">
            <a href="admin-month.php" class="nav-link ">
                <i class="icon-like"></i>
                <span class="title">Wish List Voting</span>
            </a>
        </li>

        <li class="nav-item <?php isBackMenu($menu,'ADMIN_USERLIST'); ?>">
            <a href="admin-userlist.php" class="nav-link ">
                <i class="icon-users"></i>
                <span class="title">User List</span>
            </a>
        </li>


        <li class="nav-item <?php isBackMenu($menu,'ADMIN_FORM'); ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-settings"></i>
                <span class="title">Form Stuff</span>
                <span class="selected"></span>
                <span class="arrow <?php echo isBackMulti($menu,'ADMIN_FORM'); ?>"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php isBackSubMenu($submenu,'ADMIN_BS_FORM'); ?>">
                    <a href="form_controls.html" class="nav-link ">
                        <span class="title">Bootstrap Form
                            <br>Controls</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_controls_md.html" class="nav-link ">
                        <span class="title">Material Design
                            <br>Form Controls</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_validation.html" class="nav-link ">
                        <span class="title">Form Validation</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_validation_states_md.html" class="nav-link ">
                        <span class="title">Material Design
                            <br>Form Validation States</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_validation_md.html" class="nav-link ">
                        <span class="title">Material Design
                            <br>Form Validation</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_layouts.html" class="nav-link ">
                        <span class="title">Form Layouts</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_input_mask.html" class="nav-link ">
                        <span class="title">Form Input Mask</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_editable.html" class="nav-link ">
                        <span class="title">Form X-editable</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_wizard.html" class="nav-link ">
                        <span class="title">Form Wizard</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_icheck.html" class="nav-link ">
                        <span class="title">iCheck Controls</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_image_crop.html" class="nav-link ">
                        <span class="title">Image Cropping</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_fileupload.html" class="nav-link ">
                        <span class="title">Multiple File Upload</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="form_dropzone.html" class="nav-link ">
                        <span class="title">Dropzone File Upload</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
