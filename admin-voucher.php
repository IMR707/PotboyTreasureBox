<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Voucher Management';
$menu = 'ADMIN_BIDDING';
$submenu = 'ADMIN_BIDDING_CLAIM';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
}

if(isset($_GET['id']) && $_GET['id'] != ''){
  $id = $_GET['id'];
  $claim_detail = $fz->getClaimByID2($id);
}else{
  rd('admin-instantclaim.php');
}


/************** END BASIC CONFIG *********************/

?>

<?php include BACK_INC.'header.php'; ?>

<link href="<?php echo BACK_PLUGIN; ?>select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACK_PLUGIN; ?>select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BACK_PLUGIN; ?>bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACK_PLUGIN; ?>bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACK_PLUGIN; ?>bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BACK_PLUGIN; ?>bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo BACK_PLUGIN; ?>select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo BACK_PAGES_SCRIPT; ?>components-select2.min.js" type="text/javascript"></script>
<script src="<?php echo BACK_PAGES_SCRIPT; ?>jquery.countdown.js" type="text/javascript"></script>

<script src="<?php echo BACK_PLUGIN; ?>moment.min.js" type="text/javascript"></script>
<script src="<?php echo BACK_PLUGIN; ?>bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo BACK_PLUGIN; ?>bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo BACK_PLUGIN; ?>bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo BACK_PLUGIN; ?>bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo BACK_PAGES_SCRIPT; ?>components-date-time-pickers.min.js" type="text/javascript"></script>

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
                <span>Bidding</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="admin-instantclaim.php">Instant Claim List</a>
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
                            <span class="caption-subject bold uppercase"><?php echo $claim_detail->title; ?> </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div id="getting-started"></div>

                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Voucher List</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="btn-group pull-right">
                              <a class="btn green btn-outline sbold pull-right" data-toggle="modal" href="#modal_voucher"> <i class="fa fa-plus"></i> Voucher Claim</a>
                            </div>
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

                            $vouchers = $fz->getVoucherByClaimID($id);
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" width="25%">Voucher Code</th>
                                  <th class="text-center">Status</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php

                            foreach($vouchers as $key => $row){

                            ?>

                                <tr>
                                  <td class="text-center"><?php echo $row->voucher_code; ?></td>
                                  <td class="text-center">
                                    <?php
                                    if($row->cust_id){
                                      echo '<label class="label label-success">Claimed</label> by '.$row->cust_id;
                                    }else{
                                      echo '<label class="label label-danger">Available</label>';
                                    }
                                    ?>
                                  </td>
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
