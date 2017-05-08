<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Bidding Management';
$menu = 'ADMIN_BIDDING';
$submenu = 'ADMIN_BIDDING_LIST';
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
                            <span class="caption-subject bold uppercase">Bidding Management </span>
                        </div>
                    </div>
                    <div class="portlet-body form">

                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Bid Item</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Title</label>
                                          <div class="col-md-9">
                                              <input type="text" class="form-control" placeholder="Bid Title" name="title" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Product</label>
                                          <div class="col-md-9">
                                            <select class="form-control select2" required name="product_id">
                                              <option value=""></option>
                                            <?php
                                              $prod = $fz->getProduct();
                                              foreach($prod as $key => $row){
                                                echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                              }
                                            ?>
                                            </select>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Start Time</label>
                                          <div class="col-md-5">
                                            <div class="input-icon">
                                              <i class="fa fa-calendar-o"></i>
                                              <input type="text" class="form-control date-picker" required name="start_time_date">
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
                                          <label class="col-md-3 control-label">Bidding Base</label>
                                          <div class="col-md-9">
                                            <select class="form-control select2" required id="base_add" name="bid_base">
                                              <option value=""></option>
                                              <option value="1">Time</option>
                                              <option value="2">Participant</option>
                                            </select>

                                            <span id="time_end" style="display:none">
                                              <br>
                                              End Time
                                              <div class="input-icon">
                                                <i class="fa fa-calendar-o"></i>
                                                <input type="text" style="width:50%" class="form-control date-picker" name="end_time_date">
                                              </div>
                                              <div class="input-icon">
                                                <i class="fa fa-clock-o"></i>
                                                <input type="text" style="width:50%" class="form-control timepicker timepicker-no-seconds" name="end_time_time">
                                              </div>
                                              <br>
                                            </span>
                                            <span id="participant_end" style="display:none">
                                              <br>
                                              Max Participant
                                              <input type="text" class="form-control" placeholder="Max Participant" name="max_participant">
                                              <br>
                                            </span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Bidding Type</label>
                                          <div class="col-md-9">
                                            <select class="form-control select2" required name="bid_type">
                                              <option value=""></option>
                                              <option value="1">Normal</option>
                                              <option value="2">Premium</option>
                                            </select>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Minimum Bid</label>
                                          <div class="col-md-9">
                                            <input type="number" class="form-control" placeholder="Gold / Diamond" min="1" name="min_bid">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Sponsor</label>
                                          <div class="col-md-9">
                                            <div class="select2-bootstrap-append">
                                                <select id="multi-append" class="form-control select2" multiple name="sponsor_id[]">
                                                    <option></option>
                                                    <?php
                                                      $prod = $fz->getSponsor();
                                                      foreach($prod as $key => $row){
                                                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                      }
                                                    ?>
                                                </select>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label"></label>
                                          <div class="col-md-9">
                                            <button type="submit" class="btn blue btn_submit">Create</button>
                                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                          </div>
                                      </div>
                                      <input type="hidden" name="func" value="create_bidding">
                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Bidding List</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="btn-group pull-right">
                              <a class="btn green btn-outline sbold pull-right" data-toggle="modal" href="#modal_add"> <i class="fa fa-plus"></i> Bid Item</a>
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

                            $rewards = $fz->getBidding();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" style="width:20%">Product</th>
                                  <th class="text-left">Title</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            foreach($rewards as $key => $row){
                              $product_id = $row->product_id;

                              $prod_detail = $fz->getProductByID2($product_id);                              
                            ?>

                                <tr>
                                  <td class="text-left">
                                    <img src="<?php echo BACK_UPLOADS.$prod_detail->img_thumbnail; ?>" class="img-thumbnail">
                                  </td>
                                  <td class="text-left"><?php echo $row->title; ?></td>

                                  <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn_updateSponsor" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
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
                                        <h4 class="modal-title">Update Sponsor</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Sponsor Name" name="name" required id="spon_name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Logo</label>
                                            <div class="col-md-9">
                                                <img src="" id="img_logo_view" class="img-thumbnail">
                                                <input type="file" class="form-control input-file" name="img_logo">
                                                <span><span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Description</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control summernote" name="desc" rows="6" required id="spon_desc"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                              <button type="submit" class="btn blue">Update</button>
                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="func" value="update_sponsor">
                                        <input type="hidden" name="id" id="upd_id" value="">
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

  $.fn.modal.Constructor.prototype.enforceFocus = function() {};

  $(".summernote").summernote({
      height: 300
  });

  $('#base_add').on('change',function(){
    var sel = $(this).val();
    if(sel == 1){
      $('#time_end').show();
      $('#participant_end').hide();
    }else if(sel == 2){
      $('#time_end').hide();
      $('#participant_end').show();
    }
  });

  var allowedType = [
    "image/jpeg",
    "image/jpg",
    "image/pjpeg",
    "image/x-png",
    "image/png"
  ];

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

  $('.btn_updateSponsor').on('click',function(){
    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getSponsorByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#spon_name').val(data.name);
        $('#spon_desc').summernote('code',data.desc);
        $('#img_logo_view').attr('src','<?php echo BACK_UPLOADS; ?>'+data.img_logo);
        $('#upd_id').val(data.id);
        $('#modal_update').modal('show');
      }
    });
  });

  $('#modal_update').on('hide.bs.modal',function(){
    $('#package_name_upd').val('');
    $('#package_image_upd').attr('src','');
    $('#package_prio_upd').val('');
    $('#diamond_amount_upd').val('');
    $('#gold_amount_upd').val('');
    $('#upd_id').val('');
  });


});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
