<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Instant Claim Management';
$menu = 'ADMIN_BIDDING';
$submenu = 'ADMIN_BIDDING_CLAIM';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
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
                            <span class="caption-subject bold uppercase">Instant Claim Management </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div id="getting-started"></div>



                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Instant Claim</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Title</label>
                                          <div class="col-md-9">
                                              <input type="text" class="form-control" placeholder="Claim Title" name="title" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Thumbnail Image</label>
                                          <div class="col-md-9">
                                            <img src="" id="img_thumbnail" class="img-thumbnail">
                                            <input type="file" class="form-control input-file" name="img_thumbnail">
                                            <span></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Header Image</label>
                                          <div class="col-md-9">
                                              <input type="file" class="form-control input-file" name="img_header" required>
                                              <span></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Price</label>
                                          <div class="col-md-9">
                                              <input type="number" class="form-control" placeholder="0.00" name="price" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Start Time</label>
                                          <div class="col-md-5">
                                            <div class="input-icon">
                                              <i class="fa fa-calendar-o"></i>
                                              <input type="text" class="form-control date-picker" required name="start_time_date" data-date-format="dd/mm/yyyy">
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="input-icon">
                                              <i class="fa fa-clock-o"></i>
                                              <input type="text" class="form-control timepicker timepicker-no-seconds" required name="start_time_time">
                                            </div>
                                         </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Gold Amount</label>
                                          <div class="col-md-9">
                                            <input type="number" class="form-control" placeholder="Gold" min="1" name="gold_amount">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="col-md-3 control-label"></label>
                                          <div class="col-md-9">
                                            <button type="submit" class="btn blue btn_submit">Create</button>
                                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                          </div>
                                      </div>
                                      <input type="hidden" name="func" value="create_claim">
                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Instant Claim List</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="btn-group pull-right">
                              <a class="btn green btn-outline sbold pull-right" data-toggle="modal" href="#modal_add"> <i class="fa fa-plus"></i> Instant Claim</a>
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

                            $rewards = $fz->getInstantClaim();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" width="30%">Title</th>
                                  <th class="text-center">Progress</th>
                                  <th class="text-center" width="15%">Publish</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php

                            foreach($rewards as $key => $row){
                              $claim_id = $row->id;
                              $start_date = $row->start_time;
                              $start = strtotime($start_date);

                              $total_voucher = $fz->getTotalVoucher($claim_id);
                              $total_claimed = $fz->getTotalVoucherClaimed($claim_id);;
                              $percent = 0;

                              $percent = floor(( $total_claimed / $total_voucher ) * 100);


                            ?>

                                <tr>
                                  <td class="text-center"><?php echo $row->title; ?></td>
                                  <td class="text-left">
                                    <div class="col-md-6">Gold needed - <?php echo $row->gold_amount; ?></div>
                                    <div class="col-md-6"><?php echo $total_claimed.'/'.$total_voucher; ?> claimed</div>

                                    <div class="col-md-10">
                                      <div class="progress progress-striped active" style="margin-bottom:10px;">
                                          <div class="progress-bar progress-bar-info" role="progressbar" id="progressbar_<?php echo $row->id; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent; ?>%">
                                              <span class="sr-only"> <?php echo $percent; ?>% Complete </span>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-2 text-left" id="disppercent_<?php echo $row->id; ?>">
                                      <?php echo $percent; ?>%
                                    </div>
                                  </td>
                                  <td class="text-center">
                                    <?php
                                    if($row->publish){
                                      echo '<label class="label label-success">Published</label>';
                                    }else{
                                      echo '<label class="label label-danger">Not Publish</label>';
                                    }
                                    ?>
                                  </td>
                                  <td class="text-center">
                                    <a href="admin-voucher.php?id=<?php echo $row->id; ?>"><button class="btn btn-sm btn-success"><i class="fa fa-ticket"></i></button></a>
                                    <button class="btn btn-sm btn-warning btn_updateClaim" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
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
                        <div class="modal fade in" id="modal_update" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Update Voucher Claim</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Publish</label>
                                            <div class="col-md-9">
                                              <select class="form-control select2" required name="publish" id="publish_upd">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Claim Title" name="title" required id="title_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Thumbnail Image</label>
                                            <div class="col-md-9">
                                              <img src="" id="img_thumbnail_upd" class="img-thumbnail">
                                              <input type="file" class="form-control input-file" name="img_thumbnail">
                                              <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Header Image</label>
                                            <div class="col-md-9">
                                                <img src="" id="img_header_upd" class="img-thumbnail">
                                                <input type="file" class="form-control input-file-upd" name="img_header">
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Price</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" placeholder="0.00" name="price" required id="price_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Start Time</label>
                                            <div class="col-md-5">
                                              <div class="input-icon">
                                                <i class="fa fa-calendar-o"></i>
                                                <input type="text" class="form-control date-picker" required name="start_time_date" data-date-format="dd/mm/yyyy" id="start_time_date_upd">
                                              </div>
                                            </div>
                                            <div class="col-md-4">
                                              <div class="input-icon">
                                                <i class="fa fa-clock-o"></i>
                                                <input type="text" class="form-control timepicker timepicker-no-seconds" required name="start_time_time" id="start_time_time_upd">
                                              </div>
                                           </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Gold Amount</label>
                                            <div class="col-md-9">
                                              <input type="number" class="form-control" placeholder="Gold" min="1" name="gold_amount" id="gold_amount_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                              <button type="submit" class="btn blue btn_submit">Update</button>
                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="func" value="update_claim">
                                        <input type="hidden" name="id" id="upd_id" value="">
                                      </form>
                                    </div>
                                </div>
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
                                        <input type="hidden" name="id" id="upload_id" value="">
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

  var allowedType = [
    "image/jpeg",
    "image/jpg",
    "image/pjpeg",
    "image/x-png",
    "image/png"
  ];

  var allowedTypeExcel = [
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "text/csv"
  ];

  $(".input-file-excel").change(function () {
    readURLmultiple_upload(this);
  });

  function readURLmultiple_upload(input){
      var id = $('#upload_id').val();

      $.each(input.files, function( index, value ){
        if (input.files && input.files[index]){
          if($.inArray(value.type, allowedTypeExcel) == -1){
            $(input).parent().addClass('has-error').find('span').addClass('text-danger').html('File type not allowed');
            $('.btn_submit_upload').prop('disabled',true);
          }else{
            $(input).parent().removeClass('has-error').find('span').removeClass('text-danger').html('');
            $('.btn_submit_upload').prop('disabled',false);
          }
        }
    });
  }


  $(".input-file").change(function () {
    readURLmultiple(this);
    if($(".input-file").parent().find('span').hasClass('text-danger')){
      $('.btn_submit').prop('disabled',true);
    }else{
      $('.btn_submit').prop('disabled',false);
    }
  });

  function readURLmultiple(input){
    $('#multiple_photo_preview').html('');

      $.each(input.files, function( index, value ){
        if (input.files && input.files[index]){
          if($.inArray(value.type, allowedType) == -1){
            $(input).parent().addClass('has-error').find('span').addClass('text-danger').html('File type not allowed');
          }else{
            $(input).parent().removeClass('has-error').find('span').removeClass('text-danger').html('');
          }
        }
    });
  }

  $('.btn_uploadVoucher').on('click',function(){
    $('#upload_id').val('');
    $('.input-file-excel').val('');
    $('.input-file-excel').parent().removeClass('has-error').find('span').removeClass('text-danger').html('');
    $('.btn_submit_upload').prop('disabled',false);
    var upload_id = $(this).attr('id');

    $('#upload_id').val(upload_id);
    $('#modal_voucher').modal('show');
  });

  $('.btn_updateClaim').on('click',function(){
    $('#publish_upd').select2('val','');
    $('#title_upd').val('');
    $('#price_upd').val('');
    $('#img_thumbnail_upd').attr('src','');
    $('#img_header_upd').attr('src','');
    $('#start_time_date_upd').val('');
    $('#start_time_time_upd').val('');
    $('#gold_amount_upd').val('');
    $('#upd_id').val('');

    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getClaimByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#title_upd').val(data.title);
        $('#publish_upd').select2('val',data.publish);
        $('#img_thumbnail_upd').attr('src','<?php echo BACK_UPLOADS; ?>'+data.img_thumbnail);
        $('#img_header_upd').attr('src','<?php echo BACK_UPLOADS; ?>'+data.img_header);
        $('#price_upd').val(data.price);
        $('#start_time_date_upd').val(data.start_time_date);
        $('#start_time_time_upd').val(data.start_time_time);
        $('#gold_amount_upd').val(data.gold_amount);

        $('#upd_id').val(data.id);
        $('#modal_update').modal('show');
      }
    });
  });

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};


});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
