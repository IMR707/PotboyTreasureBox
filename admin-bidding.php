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
                            <span class="caption-subject bold uppercase">Bidding Management </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div id="getting-started"></div>



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
                                          <label class="col-md-3 control-label">Sponsor</label>
                                          <div class="col-md-9">
                                            <div class="select2-bootstrap-append">
                                                <select id="multi-append" class="form-control select2 sponsor_select" multiple name="sponsor_id[]">
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
                                          <label class="col-md-3 control-label">Product</label>
                                          <div class="col-md-9">
                                            <select class="form-control select2" required name="product_id" id="product_id_add">

                                            </select>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-md-3 control-label">Start Time</label>
                                          <div class="col-md-5">
                                            <div class="input-icon">
                                              <i class="fa fa-calendar-o"></i>
                                              <input type="text" class="form-control date-picker" required name="start_time_date" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
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
                                                <input type="text" style="width:50%" class="form-control date-picker" name="end_time_date" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
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
                                  <th class="text-center" width="30%">Title</th>
                                  <th class="text-center">Progress</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            $current_time = time();
                            foreach($rewards as $key => $row){
                              $product_id = $row->product_id;

                              $prod_detail = $fz->getProductByID($product_id);
                              $bid_type = $row->bid_type;
                              if($bid_type == 1){
                                $currency = ' G';
                              }elseif($bid_type == 2){
                                $currency = ' D';
                              }

                              $start_date = $row->start_time;
                              $start = strtotime($start_date);

                              $bid_base = $row->bid_base;
                              $max_participant = 0;
                              $total_cur_participant = 0;
                              $percent = 0;

                              $disp_time = '';

                              if($bid_base == 1){
                                $end_date = $row->end_time;
                                $end = strtotime($end_date);

                                $diff = $end - $start;
                                $cdiff = $current_time - $start;

                                if($current_time < $start){
                                  $disp_time = $start_date;
                                  $percent = 0;
                                }elseif($current_time >= $start && $current_time < $end){
                                  $disp_time = $end_date;
                                  $percent = floor(( $cdiff / $diff ) * 100);
                                }elseif($current_time >= $end){
                                  $percent = 100;
                                }

                                $cur_participant = $fz->getCurParticipant($row->id);
                                $total_cur_participant = count($cur_participant);

                              }elseif($bid_base == 2){
                                $disp_time = $start_date;
                                $end_date = '';
                                $max_participant = $row->max_participant;
                                $cur_participant = $fz->getCurParticipant($row->id);
                                $total_cur_participant = count($cur_participant);
                                $percent = floor(($total_cur_participant/$max_participant) * 100);
                              }
                            ?>

                                <tr>
                                  <td class="text-center"><?php echo $row->title.'<br>( '.$prod_detail->name.' )'; ?></td>
                                  <td class="text-left">
                                    <div class="col-md-4">min bid - <?php echo $row->min_bid.' '.$currency; ?></div>
                                    <div class="col-md-4">
                                      <span class="countdown_time" id="disp_time_<?php echo $row->id; ?>" start-time="<?php echo $start_date; ?>" end-time="<?php echo $end_date; ?>">
                                        <?php echo $disp_time; ?>
                                      </span>
                                    </div>
                                    <div class="col-md-4" id="status_<?php echo $row->id; ?>">
                                      <?php
                                      if($bid_base == 1){
                                        if($current_time < $start){
                                          echo '<span class="text-warning">Not started</span>';
                                        }elseif($current_time >= $start && $current_time < $end){
                                          echo '<span class="text-success">Ongoing <i class="fa fa-users"></i> '.$total_cur_participant.'</span>';
                                        }elseif($current_time >= $end){
                                          echo '<span class="text-danger">Ended</span>';
                                        }
                                      }elseif($bid_base == 2){
                                        echo '<span class="text-success"><i class="fa fa-users"></i> '.$total_cur_participant.'/'.$max_participant.'</span>';;
                                      }

                                      ?>
                                      <span>
                                    </div>
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
                                    <a href="admin-bidder.php?id=<?php echo $row->id; ?>"><button class="btn btn-sm btn-success"><i class="fa fa-users"></i></button></a>
                                    <button class="btn btn-sm btn-warning btn_updateBidding" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger btn_delete" id="<?php echo $row->id; ?>"><i class="fa fa-trash"></i></button>
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
                                        <h4 class="modal-title">Update Bidding</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Bid Title" name="title" required id="title_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Sponsor</label>
                                            <div class="col-md-9">
                                              <div class="select2-bootstrap-append">
                                                  <select id="sponsor_id_upd" class="form-control select2 sponsor_select_upd" multiple name="sponsor_id[]">
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
                                            <label class="col-md-3 control-label">Product</label>
                                            <div class="col-md-9">
                                              <select class="form-control select2" required name="product_id" id="product_id_upd">

                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Start Time</label>
                                            <div class="col-md-5">
                                              <div class="input-icon">
                                                <i class="fa fa-calendar-o"></i>
                                                <input type="text" class="form-control date-picker" required name="start_time_date" id="start_time_date_upd" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
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
                                            <label class="col-md-3 control-label">Bidding Base</label>
                                            <div class="col-md-9">
                                              <select class="form-control select2" required id="base_add_upd" name="bid_base">
                                                <option value=""></option>
                                                <option value="1">Time</option>
                                                <option value="2">Participant</option>
                                              </select>

                                              <span id="time_end_upd" style="display:none">
                                                <br>
                                                End Time
                                                <div class="input-icon">
                                                  <i class="fa fa-calendar-o"></i>
                                                  <input type="text" style="width:50%" class="form-control date-picker" name="end_time_date" id="end_time_date_upd" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                                </div>
                                                <div class="input-icon">
                                                  <i class="fa fa-clock-o"></i>
                                                  <input type="text" style="width:50%" class="form-control timepicker timepicker-no-seconds" name="end_time_time" id="end_time_time_upd">
                                                </div>
                                                <br>
                                              </span>
                                              <span id="participant_end_upd" style="display:none">
                                                <br>
                                                Max Participant
                                                <input type="text" class="form-control" placeholder="Max Participant" name="max_participant" id="max_participant_upd">
                                                <br>
                                              </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Bidding Type</label>
                                            <div class="col-md-9">
                                              <select class="form-control select2" required name="bid_type" id="bid_type_upd">
                                                <option value=""></option>
                                                <option value="1">Normal</option>
                                                <option value="2">Premium</option>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Minimum Bid</label>
                                            <div class="col-md-9">
                                              <input type="number" class="form-control" placeholder="Gold / Diamond" min="1" name="min_bid" id="min_bid_upd">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                              <button type="submit" class="btn blue btn_submit">Update</button>
                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="func" value="update_bidding">
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

  $('.sponsor_select').on('change',function(){
    $('#product_id_add').html('');
    var idr = $(this).val();

    var dataString = "idr="+idr+"&func=getSponsorProduct";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        console.log(data);
        $('#product_id_add').select2({
          data: data,
          width: null
        });
      }
    });
  });

  $('.sponsor_select_upd').on('change',function(){
    $('#product_id_upd').html('');
    var idr = $(this).val();

    var dataString = "idr="+idr+"&func=getSponsorProduct";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        console.log(data);
        $('#product_id_upd').select2({
          data: data,
          width: null
        });
      }
    });
  });

  $('.btn_delete').on('click',function(){
		var id = $(this).attr('id');
		deleteItem(id,'aa_bidding');
	});

  $('.btn_updateBidding').on('click',function(){

    $('#title_upd').val('');
    $('#product_id_upd').select2('val','');
    $('#sponsor_id_upd').val('').trigger('change');
    $('#start_time_date_upd').val('');
    $('#start_time_time_upd').val('');
    $('#base_add_upd').select2('val','');
    $('#end_time_date_upd').val('');
    $('#end_time_time_upd').val('');
    $('#max_participant_upd').val('');

    $('#bid_type_upd').select2('val','');
    $('#min_bid_upd').val('');

    $('#upd_id').val('');

    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getBiddingByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        var sp = JSON.parse(data.sponsor);
        $('#title_upd').val(data.title);
        $('#product_id_upd').select2('val',data.product_id);
        $('#sponsor_id_upd').val(sp).trigger('change');
        $('#start_time_date_upd').val(data.start_time_date);
        $('#start_time_time_upd').val(data.start_time_time);
        $('#base_add_upd').select2('val',data.bid_base);

        if(data.bid_base == 1){
          $('#end_time_date_upd').val(data.end_time_date);
          $('#end_time_time_upd').val(data.end_time_time);

        }else if(data.bid_base == 2){
          $('#max_participant_upd').val(data.max_participant);
        }

        $('#bid_type_upd').select2('val',data.bid_type);
        $('#min_bid_upd').val(data.min_bid);

        $('#upd_id').val(data.id);
        $('#modal_update').modal('show');
      }
    });
  });

  $('#modal_update').on('hide.bs.modal',function(){
    // $('#title_upd').val('');
    // $('#product_id_upd').select2('val','');
    //
    // $('#upd_id').val('');
  });


  $('.countdown_time').each(function(index){
    var ids = $(this).attr('id');
    var id = ids.replace('disp_time_','');
    var start = $(this).attr('start-time');
    var end = $(this).attr('end-time');
    var diff = moment(end,"YYYY/MM/DD HH:mm:ss").diff(moment(start,"YYYY/MM/DD HH:mm:ss"));
    var time = $(this).html().trim();
    $('#'+$(this).attr('id')).countdown(time, function(event) {
      $(this).html(event.strftime('%-D days %H:%M:%S'));
    }).on('update.countdown', function() {
      var val = $('#disppercent_'+id).html().trim();
      var cdiff = new Date() - moment(start,"YYYY/MM/DD HH:mm:ss");

      if(cdiff > 0){
        var percent = Math.floor(( cdiff / diff ) * 100);
        $('#disppercent_'+id).html(percent+'%');
        $('#progressbar_'+id).css('width',percent+'%');
      }
    }).on('finish.countdown', function() {
      location.href = 'admin-bidding.php';
    });
  });

  function countdown(element, minutes, seconds) {
    // Fetch the display element
    var el = document.getElementById(element);

    // Set the timer
    var interval = setInterval(function() {
        if(seconds == 0) {
            if(minutes == 0) {
                (el.innerHTML = "STOP!");

                clearInterval(interval);
                return;
            } else {
                minutes--;
                seconds = 60;
            }
        }

        if(minutes > 0) {
            var minute_text = minutes + (minutes > 1 ? ' minutes' : ' minute');
        } else {
            var minute_text = '';
        }

        var second_text = seconds > 1 ? '' : '';
        el.innerHTML = minute_text + ' ' + seconds + ' ' + second_text + '';
        seconds--;
    }, 1000);
  }

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

  $('#base_add_upd').on('change',function(){
    var sel = $(this).val();
    if(sel == 1){
      $('#time_end_upd').show();
      $('#participant_end_upd').hide();
    }else if(sel == 2){
      $('#time_end_upd').hide();
      $('#participant_end_upd').show();
    }
  });



});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
