<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Daily Reward';
$menu = 'ADMIN_DAILYREWARD';
$submenu = 'ADMIN_DAILYREWARD_PACKAGE';
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
                            <span class="caption-subject bold uppercase">Daily Reward Package</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Package</h4>
                                  </div>
                                  <div class="modal-body">
                          <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Day</label>
                                  <div class="col-md-9">
                                      <input type="number" class="form-control" placeholder="Day" value="1" min="1" name="day" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Item</label>
                                  <div class="col-md-9">
                                      <div class="mt-checkbox-list">
                                          <label class="mt-checkbox mt-checkbox-outline">
                                              <input type="checkbox" class="gold_check" id="gold_new" name="gold_check" value="1"> Gold
                                              <span></span>
                                          </label>
                                          <span id="gold_amount_new" style="display:none"><input type="number" id="gold_input_new" class="form-control" placeholder="Gold Amount" name="gold_amount"><br></span>
                                          <label class="mt-checkbox mt-checkbox-outline">
                                              <input type="checkbox" class="spin_check" id="spin_new" name="spin_check" value="1"> Spin
                                              <span></span>
                                          </label>
                                          <span id="spin_amount_new" style="display:none"><input type="number" id="spin_input_new" class="form-control" placeholder="Spin Amount" name="spin_amount"><br></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-9">
                                    <button type="submit" class="btn blue">Create</button>
                                    <button type="button" class="btn default">Cancel</button>
                                  </div>
                              </div>
                              <input type="hidden" name="func" value="create_dailyreward">
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Package List</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="btn-group pull-right">
                              <a class="btn green btn-outline sbold " data-toggle="modal" href="#modal_add"> <i class="fa fa-plus"></i> Package</a>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <?php

                            if(isset($_SESSION['noti'])){
                              if($_SESSION['noti']['status'] == 'error'){
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                              }elseif($_SESSION['noti']['status'] == 'success'){
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                              }
                              unset($_SESSION['noti']);
                            }

                            $rewards = $fz->getDailyReward();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center">Day</th>
                                  <th class="text-center">Gold</th>
                                  <th class="text-center">Gold Amount</th>
                                  <th class="text-center">Spin</th>
                                  <th class="text-center">Spin Amount</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            foreach($rewards as $key => $row){
                            ?>

                                <tr>
                                  <td class="text-center"><?php echo $row->day_num; ?></td>
                                  <td class="text-center">
                                    <?php
                                    if($row->gold_check){
                                      echo '<i class="fa fa-check text-success"></i>';
                                    }else{
                                      echo '<i class="fa fa-times text-danger"></i>';
                                    }
                                    ?>
                                  </td>
                                  <td class="text-center"><?php echo $row->gold_amount; ?></td>
                                  <td class="text-center">
                                    <?php
                                    if($row->spin_check){
                                      echo '<i class="fa fa-check text-success"></i>';
                                    }else{
                                      echo '<i class="fa fa-times text-danger"></i>';
                                    }
                                    ?>
                                  </td>
                                  <td class="text-center"><?php echo $row->spin_amount; ?></td>

                                  <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn_updateDailyReward" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
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
                                        <h4 class="modal-title">Update Package</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Day</label>
                                              <div class="col-md-9">
                                                  <input type="number" class="form-control" placeholder="Day" value="1" min="1" name="day" required id="day_upd">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Item</label>
                                              <div class="col-md-9">
                                                  <div class="mt-checkbox-list">
                                                      <label class="mt-checkbox mt-checkbox-outline">
                                                          <input type="checkbox" class="gold_check" id="gold_upd" name="gold_check" value="1"> Gold
                                                          <span></span>
                                                      </label>
                                                      <span id="gold_amount_upd" style="display:none"><input type="number" id="gold_input_upd" class="form-control" placeholder="Gold Amount" name="gold_amount"><br></span>
                                                      <label class="mt-checkbox mt-checkbox-outline">
                                                          <input type="checkbox" class="spin_check" id="spin_upd" name="spin_check" value="1"> Spin
                                                          <span></span>
                                                      </label>
                                                      <span id="spin_amount_upd" style="display:none"><input type="number" id="spin_input_upd" class="form-control" placeholder="Spin Amount" name="spin_amount"><br></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-3 control-label"></label>
                                              <div class="col-md-9">
                                                <button type="submit" class="btn blue">Update</button>
                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                          <input type="hidden" name="func" value="update_dailyreward">
                                          <input type="hidden" name="id" id="upd_id" value="">
                                      </form>
                                    </div>
                                </div>
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

  $('.gold_check').on('change',function(){
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    var id = id_arr[1];

    if($(this).is(':checked')){
      $('#gold_input_'+id).prop('required',true);
      $('#gold_amount_'+id).show();
    }else{
      $('#gold_input_'+id).prop('required',false);
      $('#gold_amount_'+id).hide();
    }
  });

  $('.spin_check').on('change',function(){
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    var id = id_arr[1];

    if($(this).is(':checked')){
      $('#spin_input_'+id).prop('required',true);
      $('#spin_amount_'+id).show();
    }else{
      $('#spin_input_'+id).prop('required',false);
      $('#spin_amount_'+id).hide();
    }
  });

  $('.btn_updateDailyReward').on('click',function(){
    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getDailyRewardByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#day_upd').val(data.day_num);
        var gold_check = data.gold_check;
        var spin_check = data.spin_check;
        if(gold_check == 1){
          $('#gold_upd').prop('checked',true);
          $('#gold_amount_upd').show();
          $('#gold_input_upd').val(data.gold_amount);
        }
        if(spin_check == 1){
          $('#spin_upd').prop('checked',true);
          $('#spin_amount_upd').show();
          $('#spin_input_upd').val(data.spin_amount);
        }
        $('#upd_id').val(data.id);
        $('#modal_update').modal('show');
      }
    });
  });

  $('#modal_update').on('hide.bs.modal',function(){
    $('#upd_id').val('');
    $('#day_upd').val('');
    $('#gold_upd').prop('checked',false);
    $('#gold_amount_upd').hide();
    $('#gold_input_upd').val('');
    $('#spin_upd').prop('checked',false);
    $('#spin_amount_upd').hide();
    $('#spin_input_upd').val('');

  });

  $('.btn_updateWof').on('click',function(){
    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getWofByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#wof_prio_upd').val(data.wof_prio);
        $('#wof_amount_upd').val(data.wof_amount);
        $('#wof_percent_upd').val(data.wof_percent);
        $('input[class=wof_type_upd][name=wof_type][value='+data.wof_type+']').prop('checked', 'checked');
        $('#wof_icon_upd').attr('src','<?php echo BACK_UPLOADS; ?>'+data.wof_icon);
        $('#upd_id_wof').val(data.id);
        $('#modal_update_wof').modal('show');
      }
    });
  });

  $('#modal_update_wof').on('hide.bs.modal',function(){
    $('#wof_prio_upd').val('');
    $('#wof_amount_upd').val('');
    $('#wof_percent_upd').val('');
    $('#wof_icon_upd').attr('src','');
    $('#upd_id_wof').val('');

  });


});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
