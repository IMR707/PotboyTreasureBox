<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Product Sponsor';
$menu = 'ADMIN_PRODUCT';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
}


/************** END BASIC CONFIG *********************/

?>

<?php include BACK_INC.'header.php'; ?>

<style type="text/css">
.li_sort{
	list-style-type: none;
	text-decoration: none;
	color: #333333;
	padding: 10px; /*2px 6px 2px 6px*/
	border: 1px solid #ccc;
	margin: 5px 35px 5px 0px;
	cursor: pointer;
}
</style>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

<?php include BACK_INC.'htmlheader.php'; ?>

<!-- BEGIN CONTAINER -->
<div class="page-container">

<?php include BACK_INC.'menu.php'; ?>

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><?php echo $pname; ?>
                    <small>
                      <!-- bootstrap form controls and more -->
                    </small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->

        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="admin-dashboard.php">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"><?php echo $pname; ?></span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase">Product Sponsor </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                          <div class="col-md-12">
                            <ul id="sortable-item">
                              <?php

                              $sponsors = $fz->getSponsor();

                              foreach($sponsors as $key => $row){
                              ?>

                                <a href="admin-productlist.php?id=<?php echo $row->id; ?>"><li class="li_sort"><?php echo $row->name; ?></li></a>

                              <?php
                              }

                              ?>
                            </ul>
                          </div>
                        </div>
                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>

</div>
<!-- END CONTAINER -->

<script type="text/javascript">

$(document).ready(function(){

});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
