<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Image slider';
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
                            <span class="caption-subject bold uppercase"> Image Slider</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Slider Image</h4>
                                  </div>
                                  <div class="modal-body">
                            <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Title" name="title" required>
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
                                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="func" value="create_slideimage">
                            </form>
                          </div>
                      </div>
                    </div>
                  </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Slider Image List</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="btn-group pull-right">
                              <a class="btn green btn-outline sbold btn_sort"> <i class="fa fa-sort"></i> Sort</a>
                              <a class="btn green btn-outline sbold " data-toggle="modal" href="#modal_add"> <i class="fa fa-plus"></i> Slider Image</a>
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

                            $sliders = $fz->getHomeSlider();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center" width="20%">Image</th>
                                  <th class="text-center">Title</th>
                                  <th class="text-center">Publish</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            foreach($sliders as $key => $row){
                            ?>

                                <tr>
                                  <td class="text-center">
                                    <img src="<?php echo BACK_UPLOADS.$row->img_name; ?>" class="img-thumbnail" style="width:40%">
                                  </td>
                                  <td class="text-center"><?php echo $row->title; ?></td>
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
                                    <button class="btn btn-sm btn-warning btn_updateConversion" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                  </td>
                                </tr>

                            <?php
                            }

                            ?>
                              </tbody>
                            </table>

                            <div id="modal_sort" class="modal fade">
                            	<div class="modal-dialog">
                            	<form class="form_validator" role="form" method="POST">
                            		<div class="modal-content">
                            			<div class="modal-header bg-teal-300">
                            				<button type="button" class="close" data-dismiss="modal">&times;</button>
                            				<h4 class="modal-title">Sort Announcement</h4>
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

  $(function(){
  	/*----------  Tukar UL kepada Sortable  ----------*/
  	$( "#sortable-item" ).sortable();

  	/*----------  Amik value  ----------*/
  	$('.btn_sort').on('click',function(){
  		//var v = $(this).attr('v');
  		var items = [];
  		$("#sortable-item").empty();

        v = $.parseJSON('<?=json_encode($sliders)?>');
        // console.log(v);

      	$.each(v,function(key,value){
      		items.push('<li class="li_sort" id="sortc_'+value.id+'">'+value.title+'</li>');
      	});

      	$('#sortable-item').append( items.join('') );

  		$('#modal_sort').modal('show');
  	});

  	/*----------  submit value  ----------*/
  	$('#btn_submit_sort').on('click',function(){
  		var order = $('#sortable-item').sortable("serialize")+'&func=sort_homeslider';
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

  $(".input-file-upd").change(function () {
    readURLmultiple_upd(this);
  });

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
