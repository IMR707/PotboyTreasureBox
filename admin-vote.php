<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Vote List';
$menu = 'ADMIN_WISHLIST';
$submenu = 'ADMIN_WISHLIST_MONTH';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
}

if(isset($_GET['s']) && $_GET['s'] != ''){
  $sponsor_id = $_GET['s'];
}else{
  rd('admin-month.php');
}

if(isset($_GET['w']) && $_GET['w'] != ''){
  $wish_id = $_GET['w'];
  $wish_detail = $fz->getWishByID($wish_id);
}else{
  rd('admin-month.php');
}

if(isset($_GET['wp']) && $_GET['wp'] != ''){
  $wp_id= $_GET['wp'];
  $votes = $fz->getVoteByWpID($wp_id);
}else{
  rd('admin-month.php');
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
                <span>Wish List Voting</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="admin-month.php?s=<?php echo $sponsor_id; ?>">Month Setting</a>
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
                            <span class="caption-subject bold uppercase">Vote List For <?php echo $wish_detail->title; ?> </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div id="getting-started"></div>

                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Vote List</h4>
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

                            // pre($votes);

                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center">Name</th>
                                  <th class="text-center">Email</th>

                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php

                            foreach($votes as $key => $row){

                            ?>

                                <tr>
                                  <td class="text-center"><?php echo $row->firstname.' '.$row->lastname; ?></td>
                                  <td class="text-center"><?php echo $row->email; ?></td>

                                  <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn_updateVoucher" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                  </td>
                                </tr>

                            <?php
                            }

                            ?>
                              </tbody>
                            </table>

                          </div>
                        </div>

                        <div class="modal fade in" id="modal_voucher" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Upload Voucher Code</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Excel File</label>
                                            <div class="col-md-9">
                                              <input type="file" class="form-control input-file-excel" name="excel_voucher" id="excel_voucher">
                                              <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                              <button type="submit" class="btn blue btn_submit_upload">Upload</button>
                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="func" value="upload_voucher">
                                        <input type="hidden" name="id" id="claim_id" value="<?php echo $id; ?>">
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade in" id="modal_voucher_upd" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Update Voucher Code</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Voucher Code</label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control" name="voucher_code" id="voucher_code_upd">
                                              <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                              <button type="submit" class="btn blue btn_submit_upload">Update</button>
                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="claim_id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="func" value="update_voucher">
                                        <input type="hidden" name="id" id="voucher_id" value="">
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- here -->
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

  $('.btn_uploadVoucher').on('click',function(){

    $('.input-file-excel').val('');
    $('.input-file-excel').parent().removeClass('has-error').find('span').removeClass('text-danger').html('');
    $('.btn_submit_upload').prop('disabled',false);

    $('#modal_voucher').modal('show');
  });

  $('.btn_updateVoucher').on('click',function(){
    $('#voucher_code_upd').val('');
    $('#voucher_id').val('');

    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getVoucherByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#voucher_code_upd').val(data.voucher_code);

        $('#voucher_id').val(data.id);
        $('#modal_voucher_upd').modal('show');
      }
    });
  });

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};


});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
