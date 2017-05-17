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

<script type="text/javascript" src="<?php echo BACK_PAGES_SCRIPT; ?>interactions.min.js"></script>

<style type="text/css">
.li_sort{
	list-style-type: none;
	text-decoration: none;
	color: #333333;
	padding: 10px; /*2px 6px 2px 6px*/
	border: 1px solid #ccc;
	margin: 5px 35px 5px 0px;
	cursor: move;
}
</style>

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
                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Package</h4>
                                  </div>
                                  <div class="modal-body">
                          <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Package Name" name="package_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Image</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control input-file-add" name="package_image" required>
                                    <span></span>
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
                                  <button type="submit" class="btn blue btn_submit_add">Create</button>
                                  <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <input type="hidden" name="func" value="create_conversion">
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Conversion List</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="btn-group pull-right">
                              <a class="btn green btn-outline sbold btn_sort"> <i class="fa fa-sort"></i> Sort</a>
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

                            $rewards = $fz->getConversion();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" style="width:25%">Icon</th>
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
                                  <td class="text-center">
                                    <img src="<?php echo BACK_UPLOADS.$row->icon; ?>" class="img-thumbnail">
                                  </td>
                                  <td class="text-center"><?php echo $row->name; ?></td>
                                  <td class="text-center"><?php echo $row->diamond_amount; ?></td>
                                  <td class="text-center"><?php echo $row->gold_amount; ?></td>

                                  <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn_updateConversion" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
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
                                            <label class="col-md-3 control-label">Image</label>
                                            <div class="col-md-9">
                                                <img src="" id="package_image_upd" class="img-thumbnail">
                                                <input type="file" class="form-control input-file-upd" name="package_image">
                                                <span></span>
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
                                              <button type="submit" class="btn blue btn_submit_upd">Update</button>
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
                        <div id="modal_sort" class="modal fade">
                          <div class="modal-dialog">
                          <form class="form_validator" role="form" method="POST">
                            <div class="modal-content">
                              <div class="modal-header bg-teal-300">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Sort Package</h4>
                              </div>

                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <ul id="sortable-item">

                                    </ul>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" name="btn_submit_sort" id="btn_submit_sort" value="" class="btn btn-success">Submit</button>
                              </div>
                            </div>
                          </form>
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

	$('.btn_delete').on('click',function(){
		var id = $(this).attr('id');
		deleteItem(id,'aa_conversion');
	});

  $(function(){
  	/*----------  Tukar UL kepada Sortable  ----------*/
  	$( "#sortable-item" ).sortable();

  	/*----------  Amik value  ----------*/
  	$('.btn_sort').on('click',function(){
  		//var v = $(this).attr('v');
  		var items = [];
  		$("#sortable-item").empty();

        v = $.parseJSON('<?=json_encode($rewards)?>');
        // console.log(v);

      	$.each(v,function(key,value){
      		items.push('<li class="li_sort" id="sortc_'+value.id+'">'+value.name+'</li>');
      	});

      	$('#sortable-item').append( items.join('') );

  		$('#modal_sort').modal('show');
  	});

  	/*----------  submit value  ----------*/
  	$('#btn_submit_sort').on('click',function(){
  		var order = $('#sortable-item').sortable("serialize")+'&func=sort_conversion';
        $.post("backend/process.php", order, function(data){
          	$('#modal_sort').modal('hide');
            location.reload();
      	});
  	});
  });

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
      $.each(input.files, function( index, value ){
        if (input.files && input.files[index]){
          if($.inArray(value.type, allowedType) == -1){
            $(input).parent().addClass('has-error').find('span').addClass('text-danger').html('File type not allowed');
            $('.btn_submit_upd').prop('disabled',true);
          }else{
            $(input).parent().removeClass('has-error').find('span').removeClass('text-danger').html('');
            $('.btn_submit_upd').prop('disabled',false);
          }
        }
    });
  }

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
        $('.btn_submit_upd').prop('disabled',false);
        $('#modal_update').modal('show');
      }
    });
  });

  $('#modal_update').on('hide.bs.modal',function(){
    $('#package_name_upd').val('');
    $('#package_image_upd').attr('src','');
    $('.input-file-upd').val('');
    $('.input-file-upd').parent().removeClass('has-error').find('span').removeClass('text-danger').html('');
    $('#package_prio_upd').val('');
    $('#diamond_amount_upd').val('');
    $('#gold_amount_upd').val('');
    $('.btn_submit_upd').prop('disabled',false);
    $('#upd_id').val('');
  });


});

</script>

<?php include BACK_INC.'htmlfooter.php'; ?>
