<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Wheel of Fortune';
$menu = 'ADMIN_DAILYREWARD';
$submenu = 'ADMIN_DAILYREWARD_WHEEL';
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
                            <span class="caption-subject bold uppercase">Wheel of Fortune</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                      <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                      <h4 class="modal-title">Add New Setting</h4>
                                  </div>
                                  <div class="modal-body">
                          <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Type</label>
                                  <div class="col-md-9">
                                      <div class="mt-radio-list">
                                          <label class="mt-radio mt-radio-outline">
                                              <input type="radio" name="wof_type" id="wof_type22" value="1" checked> Gold
                                              <span></span>
                                          </label>
                                          <label class="mt-radio mt-radio-outline">
                                              <input type="radio" name="wof_type" id="wof_type23" value="2"> Diamond
                                              <span></span>
                                          </label>
                                          <label class="mt-radio mt-radio-outline">
                                              <input type="radio" name="wof_type" id="wof_type24" value="3"> Spin
                                              <span></span>
                                          </label>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Icon</label>
                                  <div class="col-md-9">
                                      <input type="file" class="form-control" name="wof_icon" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Amount</label>
                                  <div class="col-md-9">
                                      <input type="number" class="form-control" name="wof_amount" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 control-label">Percentage</label>
                                  <div class="col-md-9">
                                    <div class="input-group">
                                      <input type="number" class="form-control" name="wof_percent" required>
                                      <span class="input-group-addon">
                                          <i class="fa fa-percent"></i>
                                      </span>
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
                              <input type="hidden" name="func" value="create_wof">
                          </form>
                        </div>
                    </div>
                  </div>
                </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 class="pull-left">Setting List</h4>
                          </div>
                          <div class="col-md-6">
                            <div class="btn-group pull-right">
                              <a class="btn green btn-outline sbold btn_sort"> <i class="fa fa-sort"></i> Sort</a>
                              <a class="btn green btn-outline sbold " data-toggle="modal" href="#modal_add"> <i class="fa fa-plus"></i> Setting</a>
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

                            $wofs = $fz->getWof();
                            ?>

                            <table class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center">Icon</th>
                                  <th class="text-center">Type</th>
                                  <th class="text-center">Amount</th>
                                  <th class="text-center">Percentage</th>
                                  <th class="text-center" width="15%">Action</th>
                                </tr>
                              </thead>
                              <tbody>

                            <?php
                            foreach($wofs as $key => $row){
                            ?>

                                <tr>
                                  <td class="text-center">
                                    <img src="<?php echo BACK_UPLOADS.$row->wof_icon; ?>" class="img-thumbnail">
                                  </td>
                                  <td class="text-center">
                                    <?php
                                    if($row->wof_type == 1){
                                      echo 'Gold';
                                    }elseif($row->wof_type == 2){
                                      echo 'Diamond';
                                    }elseif($row->wof_type == 3){
                                      echo 'Spin';
                                    }
                                    ?>
                                  </td>
                                  <td class="text-center"><?php echo $row->wof_amount; ?></td>
                                  <td class="text-center"><?php echo $row->wof_percent.' %'; ?></td>
                                  <td class="text-center">
                                    <button class="btn btn-sm btn-warning btn_updateWof" id="<?php echo $row->id; ?>"><i class="fa fa-pencil"></i></button>
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
                        <div class="modal fade in" id="modal_update_wof" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Update Setting</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">                                          
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Type</label>
                                              <div class="col-md-9">
                                                  <div class="mt-radio-list">
                                                      <label class="mt-radio mt-radio-outline">
                                                          <input type="radio" class="wof_type_upd" name="wof_type" id="wof_type22" value="1" checked> Gold
                                                          <span></span>
                                                      </label>
                                                      <label class="mt-radio mt-radio-outline">
                                                          <input type="radio" class="wof_type_upd" name="wof_type" id="wof_type23" value="2"> Diamond
                                                          <span></span>
                                                      </label>
                                                      <label class="mt-radio mt-radio-outline">
                                                          <input type="radio" class="wof_type_upd" name="wof_type" id="wof_type24" value="3"> Spin
                                                          <span></span>
                                                      </label>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Icon</label>
                                              <div class="col-md-9">
                                                  <img src="" id="wof_icon_upd" class="img-thumbnail">
                                                  <input type="file" class="form-control" name="wof_icon">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Amount</label>
                                              <div class="col-md-9">
                                                  <input type="number" class="form-control" name="wof_amount" required id="wof_amount_upd">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Percentage</label>
                                              <div class="col-md-9">
                                                <div class="input-group">
                                                  <input type="number" class="form-control" name="wof_percent" required id="wof_percent_upd">
                                                  <span class="input-group-addon">
                                                      <i class="fa fa-percent"></i>
                                                  </span>
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
                                          <input type="hidden" name="func" value="update_wof">
                                          <input type="hidden" name="id" id="upd_id_wof" value="">
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
                                <h4 class="modal-title">Sort Setting</h4>
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
		deleteItem(id,'aa_fortune');
	});

  $(function(){
  	/*----------  Tukar UL kepada Sortable  ----------*/
  	$( "#sortable-item" ).sortable();

  	/*----------  Amik value  ----------*/
  	$('.btn_sort').on('click',function(){
  		//var v = $(this).attr('v');
  		var items = [];
  		$("#sortable-item").empty();

        v = $.parseJSON('<?=json_encode($wofs)?>');
        // console.log(v);

      	$.each(v,function(key,value){
          var types = '';
          if(value.wof_type == 1){
            types = 'Gold';
          }else if(value.wof_type == 2){
            types = 'Diamond';
          }else if(value.wof_type == 3){
            types = 'Spin';
          }
      		items.push('<li class="li_sort" id="sortc_'+value.id+'">'+value.wof_amount+'x '+types+'</li>');
      	});

      	$('#sortable-item').append( items.join('') );

  		$('#modal_sort').modal('show');
  	});

  	/*----------  submit value  ----------*/
  	$('#btn_submit_sort').on('click',function(){
  		var order = $('#sortable-item').sortable("serialize")+'&func=sort_wof';
        $.post("backend/process.php", order, function(data){
          	$('#modal_sort').modal('hide');
            location.reload();
      	});
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
