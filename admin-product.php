<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Product Management';
$menu = 'ADMIN_BIDDING';
$submenu = 'ADMIN_BIDDING_PRODUCT';
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
                            <span class="caption-subject bold uppercase">Product Management </span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Product</h4>
                                  </div>
                                  <div class="modal-body">
                          <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Product Name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Price</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" placeholder="0.00" name="price" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Banner</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control input-file" name="img_banner" required>
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Header</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control input-file" name="img_header" required>
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Thumbnail</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control input-file" name="img_thumbnail" required>
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Specification & Description</label>
                                <div class="col-md-9">
                                    <textarea id="" class="summernote" name="desc" rows="6"> </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                  <button type="submit" class="btn blue btn_submit">Create</button>
                                  <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <input type="hidden" name="func" value="create_product">
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h4 class="pull-left">Product List</h4>
                            <a class="btn green btn-outline sbold pull-right" data-toggle="modal" href="#modal_add"> <i class="fa fa-plus"></i> Product</a>
                            <?php

                            if(isset($_SESSION['noti']) && $_SESSION['noti'] != ''){
                              if($_SESSION['noti']['status'] == 'error'){
                                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                              }elseif($_SESSION['noti']['status'] == 'success'){
                                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
                              }
                              unset($_SESSION['noti']);
                            }

                            $rewards = $fz->getProduct();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" style="width:20%">Thumbnail</th>
                                  <th class="text-left">Product Name</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            foreach($rewards as $key => $row){
                            ?>

                                <tr>
                                  <td class="text-center">
                                    <img src="<?php echo BACK_UPLOADS.$row->img_thumbnail; ?>" class="img-thumbnail">
                                  </td>
                                  <td class="text-left"><?php echo $row->name; ?></td>

                                  <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn_updateProduct" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
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
                            <div class="modal-dialog modal-lg">
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
                                                <input type="text" class="form-control" placeholder="Product Name" name="name" required id="name_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Price</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" placeholder="0.00" name="price" required id="price_upd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Banner</label>
                                            <div class="col-md-9">
                                                <img src="" id="img_banner_upd" class="img-thumbnail">
                                                <input type="file" class="form-control input-file-upd" name="img_banner">
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Header</label>
                                            <div class="col-md-9">
                                                <img src="" id="img_header_upd" class="img-thumbnail">
                                                <input type="file" class="form-control input-file-upd" name="img_header">
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Thumbnail</label>
                                            <div class="col-md-9">
                                                <img src="" id="img_thumbnail_upd" class="img-thumbnail">
                                                <input type="file" class="form-control input-file-upd" name="img_thumbnail">
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Specification & Description</label>
                                            <div class="col-md-9">

                                                <textarea class="summernote" name="desc" rows="6" id="desc_upd"> </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                              <button type="submit" class="btn blue btn_submit_upd" id="">Update</button>
                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="func" value="update_product">
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

  $(".summernote").summernote({
      height: 300
  })

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

  $(".input-file-upd").change(function () {
    readURLmultiple_upd(this);
  });

  function readURLmultiple_upd(input){
      var id = $('#upd_id').val();

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

  $('.btn_updateProduct').on('click',function(){
    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getProductByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        $('#name_upd').val(data.name);
        $('#price_upd').val(data.price);
        $('#desc_upd').summernote('code',data.desc);
        $('#img_banner_upd').attr('src','<?php echo BACK_UPLOADS; ?>'+data.img_banner);
        $('#img_header_upd').attr('src','<?php echo BACK_UPLOADS; ?>'+data.img_header);
        $('#img_thumbnail_upd').attr('src','<?php echo BACK_UPLOADS; ?>'+data.img_thumbnail);
        $('.btn_submit_upd').attr('id','btn_submit_upd_'+data.id);

        $('#upd_id').val(data.id);
        $('#modal_update').modal('show');
      }
    });
  });

  $('#modal_update').on('hide.bs.modal',function(){
    $('#name_upd').val('');
    $('#price_upd').val('');
    $('#img_banner_upd').attr('src','');
    $('#img_header_upd').attr('src','');
    $('#img_thumbnail_upd').attr('src','');
    $('.btn_submit_upd').attr('id','');
    $('#upd_id').val('');
  });


});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
