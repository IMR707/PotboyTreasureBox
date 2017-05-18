<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'User Management';
$menu = 'ADMIN_USERLIST';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
}


/************** END BASIC CONFIG *********************/

?>

<?php include BACK_INC.'header.php'; ?>

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
                            <span class="caption-subject bold uppercase">USERS </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">User List</h4>
                          </div>


                          <div class="col-md-12">


                            <?php

                            if(isset($_SESSION['noti']) && $_SESSION['noti'] != ''){
                              if($_SESSION['noti']['status'] == 'error'){
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                              }elseif($_SESSION['noti']['status'] == 'success'){
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                              }
                              unset($_SESSION['noti']);
                            }

                            $users = $fz->getUsers();
                            ?>

                            <table class="table table-bordered table-hover" id="sample_1">
                              <thead>
                                <tr>
                                  <th class="text-center">First Name</th>
                                  <th class="text-center">Last Name</th>
                                  <th class="text-center">Email</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            foreach($users as $key => $row){
                            ?>

                                <tr>
                                  <td class="text-center"><?php echo $row->firstname; ?></td>
                                  <td class="text-center"><?php echo $row->lastname; ?></td>
                                  <td class="text-center"><?php echo $row->email; ?></td>

                                  <td class="text-center">
                                    <a href="admin-userprofile.php?id=<?php echo $row->entity_id; ?>"><button class="btn btn-sm btn-success"><i class="fa fa-search"></i></button></a>
                                  </td>
                                </tr>

                            <?php
                            }

                            ?>
                              </tbody>
                            </table>

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
