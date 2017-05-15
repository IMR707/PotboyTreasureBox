<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Month Setting';
$menu = 'ADMIN_WISHLIST';
$submenu = 'ADMIN_WISHLIST_MONTH';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
}

if(isset($_GET['s']) && $_GET['s'] != ''){
  $s_id = $_GET['s'];
}else{
  $s_id = 0;
}

if(isset($_GET['m']) && $_GET['m'] != ''){
  $month = $_GET['m'];
}else{
  $month = 0;
}

if(isset($_GET['y']) && $_GET['y'] != ''){
  $year = $_GET['y'];
}else{
  $year = 0;
}

$sponsors = $fz->getSponsor();

$found = false;
foreach($sponsors as $key => $row) {
    if ($s_id == $row->id) {
      $found = true;
      break;
    }
}

if(!$found && $s_id != 0){
  rd('admin-month.php');
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
                            <span class="caption-subject bold uppercase">Wish List Voting Item </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <?php

                      if(isset($_SESSION['noti']) && $_SESSION['noti'] != ''){
                        if($_SESSION['noti']['status'] == 'error'){
                          echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                        }elseif($_SESSION['noti']['status'] == 'success'){
                          echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                        }
                        unset($_SESSION['noti']);
                      }


                      ?>
                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Wish List</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Title</label>
                                          <div class="col-md-9">
                                              <input type="text" class="form-control" placeholder="Title" name="title" required id="title">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Month</label>
                                          <div class="col-md-5">
                                            <div class="input-icon">
                                              <i class="fa fa-calendar-o"></i>
                                              <input type="text" class="form-control date-picker" required name="time_month" id="time_month">
                                            </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Product</label>
                                          <div class="col-md-9">
                                            <div class="select2-bootstrap-append">
                                                <select id="product_id" class="form-control select2" multiple name="product_id[]">

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
                                      <input type="hidden" name="spon_id" id="spon_id" value="">
                                      <input type="hidden" name="wish_id" id="wish_id" value="">
                                      <input type="hidden" name="func" value="create_wishlist">

                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>

                      <div class="tabbable-line">
                          <ul class="nav nav-tabs ">
                            <?php

                            $first = false;
                            if($s_id == 0){
                                $first = true;
                            }

                            $active = '';
                            foreach($sponsors as $key => $row){
                              if($first){
                                $active = 'active';
                              }else{
                                if($s_id == $row->id){
                                  $active = 'active';
                                }
                              }
                            ?>
                              <li class="<?php echo $active; ?>">
                                  <a href="#tab_<?php echo $row->id; ?>" data-toggle="tab"> <?php echo $row->name; ?></a>
                              </li>
                            <?php
                              $active = '';
                              $first = false;
                            }
                            ?>
                          </ul>
                          <div class="tab-content">
                            <?php

                            $first = false;
                            if($s_id == 0){
                                $first = true;
                            }

                            $active = '';
                            foreach($sponsors as $key => $row){
                              if($first){
                                $active = 'active';
                              }else{
                                if($s_id == $row->id){
                                  $active = 'active';
                                }
                              }
                            ?>
                              <div class="tab-pane <?php echo $active; ?>" id="tab_<?php echo $row->id; ?>">
                                <div class="col-md-6">
                                  <h4 class="pull-left">Wish List for Each Month</h4>
                                </div>
                                <div class="col-md-6">
                                  <div class="btn-group pull-right">
                                    <a class="btn green btn-outline sbold pull-right btn_WishListAdd" ids="<?php echo $row->id; ?>"><i class="fa fa-plus"></i> Wish List</a>
                                  </div>
                                </div>
                                <table class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th class="text-center" width="20%">Month</th>
                                      <th class="text-left">Title</th>
                                      <th class="text-center" width="15%">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  <?php

                                    $wishlists = $fz->getWishListBySponID($row->id);

                                    foreach($wishlists as $key2 => $row2){
                                      $time_month = $row2->time_month;
                                      $month = date('F Y',strtotime($time_month));
                                  ?>
                                    <tr>
                                      <td class="text-center"><?php echo $month; ?></td>
                                      <td class="text-left"><?php echo $row2->title; ?></td>

                                      <td class="text-center">
                                        <button class="btn btn-sm btn-warning btn_WishListUpd" ids="<?php echo $row2->id; ?>" idspon="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                      </td>
                                    </tr>
                                  <?php
                                    }
                                  ?>

                                  </tbody>
                                </table>
                              </div>
                            <?php
                              $active = '';
                              $first = false;
                            }
                            ?>
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
  var date=new Date();
  var year=date.getFullYear();
  var month=date.getMonth();

  $('.date-picker').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'M yyyy',
    startDate: new Date(year, month, '01')
  });

  $('.btn_WishListAdd').on('click',function(){
    $('#wish_id').val('');
    $('#title').val('');
    $('#time_month').val('');
    $('#spon_id').val('');
    $('#product_id').html('');
    var ids = $(this).attr('ids');

    var dataString = "id="+ids+"&func=getProductBySponsorID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#product_id').select2({
          data: data,
          width: null
        });

        $('#spon_id').val(ids);
        $('#modal_add').modal('show');
      }
    });
  });

  $('.btn_WishListUpd').on('click',function(){
    $('#wish_id').val('');
    $('#title').val('');
    $('#time_month').val('');
    $('#spon_id').val('');
    $('#product_id').html('');

    var idspon = $(this).attr('idspon');
    var ids = $(this).attr('ids');
    var dataString = "id="+ids+"&idspon="+idspon+"&func=getProductByWishID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#product_id').select2({
          data: data.productlist,
          width: null
        });
        $('#title').val(data.title);
        $('#wish_id').val(data.id);
        $('#spon_id').val(data.spon_id);
        $('#time_month').val(data.time_month);
        $('#product_id').val(data.product).trigger('change');
        $('#modal_add').modal('show');
      }
    });
  });


});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
