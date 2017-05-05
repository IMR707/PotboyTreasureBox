<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Conversion Rate';
$menu = 'ADMIN_CONVERSION';
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
                            <span class="caption-subject bold uppercase">Conversion Package </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div class="row">
                        <div class="col-md-6">
                          <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                            <h4>Add New Package</h4>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Package Name" name="package_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Priority</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" placeholder="Priority" value="1" min="1" name="package_prio" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Image</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="package_image" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Rate</label>
                                <div class="col-md-9">
                                    <div class="input-group input-large">
                                        <input type="number" class="form-control" name="diamond_amount" placeholder="Diamond">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>
                                        <input type="number" class="form-control" name="gold_amount" placeholder="Gold">
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
                            <input type="hidden" name="func" value="create_conversion">
                          </form>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                      </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h4>Package List</h4>
                            <?php

                            if(isset($_SESSION['noti_convert'])){
                              if($_SESSION['noti_convert']['status'] == 'error'){
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti_convert']['msg'].'</div>';
                              }elseif($_SESSION['noti_convert']['status'] == 'success'){
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti_convert']['msg'].'</div>';
                              }
                              unset($_SESSION['noti_convert']);
                            }

                            $rewards = $fz->getConversion();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center">Priority</th>
                                  <th class="text-center">Icon</th>
                                  <th class="text-center">Name</th>
                                  <th class="text-center">Diamond</th>
                                  <th class="text-center">Gold</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            foreach($rewards as $key => $row){
                            ?>

                                <tr>
                                  <td class="text-center"><?php echo $row->prio; ?></td>
                                  <td class="text-center">
                                    <img src="<?php echo BACK_UPLOADS.$row->icon; ?>" class="img-thumbnail">
                                  </td>
                                  <td class="text-center"><?php echo $row->name; ?></td>
                                  <td class="text-center"><?php echo $row->diamond_amount; ?></td>
                                  <td class="text-center"><?php echo $row->gold_amount; ?></td>

                                  <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn_updateConversion" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
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
                                            <label class="col-md-3 control-label">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Package Name" name="package_name" required id="package_name_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Priority</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" placeholder="Priority" value="1" min="1" name="package_prio" required id="package_prio_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Image</label>
                                            <div class="col-md-9">
                                                <img src="" id="package_image_upd" class="img-thumbnail">
                                                <input type="file" class="form-control" name="package_image" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Rate</label>
                                            <div class="col-md-9">
                                                <div class="input-group input-large">
                                                    <input type="number" class="form-control" name="diamond_amount" placeholder="Diamond" id="diamond_amount_upd">
                                                    <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>
                                                    <input type="number" class="form-control" name="gold_amount" placeholder="Gold" id="gold_amount_upd">
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
                                        <input type="hidden" name="func" value="update_conversion">
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



  $('.btn_updateConversion').on('click',function(){
    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getConversionByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#package_name_upd').val(data.name);
        $('#package_prio_upd').val(data.prio);
        $('#diamond_amount_upd').val(data.diamond_amount);
        $('#gold_amount_upd').val(data.gold_amount);
        $('#package_image_upd').attr('src','<?php echo BACK_UPLOADS; ?>'+data.icon);
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
