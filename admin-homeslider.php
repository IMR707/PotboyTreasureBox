<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Homeslider';
$menu = 'ADMIN_HOMESLIDER';
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
                            <span class="caption-subject bold uppercase"> Home Slider</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                          <div class="col-md-6">
                            <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                  <h4>Add New Slider Image</h4>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Title" name="title" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Priority</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" placeholder="Priority" value="1" min="1" name="prio" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Image File</label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control input-file-add" name="image_slide" required>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                          <button type="submit" class="btn blue btn_submit_add">Create</button>
                                          <button type="button" class="btn default">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="func" value="create_slideimage">
                            </form>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <hr>
                            <?php

                            if(isset($_SESSION['noti_slider'])){
                              if($_SESSION['noti_slider']['status'] == 'error'){
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti_slider']['msg'].'</div>';
                              }elseif($_SESSION['noti_slider']['status'] == 'success'){
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti_slider']['msg'].'</div>';
                              }
                              unset($_SESSION['noti_slider']);
                            }

                            $sliders = $fz->getHomeSlider();

                            foreach($sliders as $key => $row){
                            ?>

                            <div class="row">
                              <div class="col-md-12">
                                <h4>Slider Image List</h4>
                              </div>
                              <div class="col-md-6">
                                <img src="<?php echo BACK_UPLOADS.$row->img_name; ?>" class="img-thumbnail">
                              </div>
                              <div class="col-md-6">
                                <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo $row->title; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Priority</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" placeholder="Priority" min="1" name="prio" value="<?php echo $row->prio; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Image File</label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control input-file-upd" id="upd-<?php echo $row->id; ?>" name="image_slide">
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Publish</label>
                                            <div class="col-md-9">
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input type="radio" name="publish" value="1" <?php echo $row->publish == 1 ? 'checked' : '';?>> Yes
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="publish" value="0" <?php echo $row->publish == 0 ? 'checked' : '';?>> No
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                              <button type="submit" class="btn blue" id="btn_submit_upd_<?php echo $row->id; ?>">Update</button>
                                              <button type="reset" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="func" value="update_slideimage">
                                    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                                </form>
                              </div>
                              <div class="clearfix"></div>
                              <hr>
                            </div>

                            <?php
                            }

                            ?>

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

<script>

$(document).ready(function(){
  var allowedType = [
    "image/jpeg",
    "image/jpg",
    "image/pjpeg",
    "image/x-png",
    "image/png"
  ];

  $(".input-file-add").change(function () {
    readURLmultiple(this);

    if($(".input-file-add").parent().find('span').hasClass('text-danger')){
      $('.btn_submit_add').prop('disabled',true);
    }else{
      $('.btn_submit_add').prop('disabled',false);
    }

  });

  $(".input-file-upd").change(function () {
    readURLmultiple_upd(this);
  });

  function readURLmultiple(input){
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

  function readURLmultiple_upd(input){
      var ids = $(input).attr('id');
      var id_arr = ids.split('-');
      var id = id_arr[1];

      $.each(input.files, function( index, value ){
        if (input.files && input.files[index]){
          if($.inArray(value.type, allowedType) == -1){
            $(input).parent().addClass('has-error').find('span').addClass('text-danger').html('File type not allowed');
            $('#btn_submit_upd_'+id).prop('disabled',true);
          }else{
            $(input).parent().removeClass('has-error').find('span').removeClass('text-danger').html('');
            $('#btn_submit_upd_'+id).prop('disabled',false);
          }
        }
    });
  }


});

</script>

<!-- END CONTAINER -->
<?php include BACK_INC.'htmlfooter.php'; ?>
