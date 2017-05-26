<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'User Management';
$menu = 'ADMIN_USERLIST';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
}

if(isset($_GET['id']) && $_GET['id'] != ''){
  $id = $_GET['id'];
  $user_detail = $fz->getUserByID($id);
  $user_address = $user->getUserAddress($id);
  $reward_detail = $list->FEgetRewardData($id);
  $diamond_trans = $fz->getUserDiamondTrans($id);
  $gold_trans = $fz->getUserGoldTrans($id);
}else{
  rd('admin-userlist.php');
}



/************** END BASIC CONFIG *********************/

?>

<?php include BACK_INC.'header.php'; ?>

<link href="<?php echo BACK_PAGES_CSS; ?>profile-2.min.css" rel="stylesheet" type="text/css" />

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

<?php include BACK_INC.'htmlheader.php'; ?>

<!-- BEGIN CONTAINER -->
<div class="page-container">

<?php include BACK_INC.'menu.php'; ?>

            <!-- BEGIN CONTENT -->
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

                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="admin-dashboard.php">Dashboard</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                          <a href="admin-userlist.php">User</a>
                          <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php echo $pname; ?></span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="profile">
                        <div class="tabbable-line tabbable-full-width">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab"> Overview </a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab"> Account </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <ul class="list-unstyled profile-nav">
                                                <li>
                                                    <img src="<?php echo BACKASSETSURL;?>/assets/pages/media/profile/people19.png" class="img-responsive pic-bordered" alt="" />
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> Projects </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> Messages
                                                        <span> 3 </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> Friends </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> Settings </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8 profile-info">
                                                    <h1 class="font-green sbold uppercase"><?php echo $user_detail->firstname.' '.$user_detail->lastname; ?></h1>
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <i class="fa fa-envelope"></i> <?php echo $user_detail->email;?>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-diamond"></i> <?php echo $reward_detail->diamond;?>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-circle"></i> <?php echo $reward_detail->gold;?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--end col-md-8-->

                                            </div>
                                            <!--end row-->
                                            <div class="tabbable-line tabbable-custom-profile">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_11" data-toggle="tab"> Diamond Transaction </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_22" data-toggle="tab"> Gold Transaction </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1_11">
                                                        <div class="portlet-body">
                                                          <button class="btn btn-success pull-right add_data" id="diamond">Add Diamond</button>
                                                            <table class="table table-striped table-bordered table-advance table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="15%">
                                                                            <i class="fa fa-calendar"></i> Date
                                                                        </th>
                                                                        <th width="25%">
                                                                            <i class="fa fa-question"></i> Type
                                                                        </th>
                                                                        <th>
                                                                            <i class="fa fa-bookmark"></i> Details
                                                                        </th>
                                                                        <th>
                                                                            <i class="fa fa-usd"></i> Amount
                                                                        </th>
                                                                        <th>
                                                                            <i class="fa fa-bookmark"></i> Status
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  <?php

                                                                  foreach($diamond_trans as $key => $row){

                                                                  ?>
                                                                    <tr>
                                                                        <td> <?php echo date("d-m-Y h:ia",strtotime($row->created_at)); ?> </td>
                                                                        <td> <?php echo $row->title; ?> </td>
                                                                        <td> <?php echo $row->desc; ?> </td>
                                                                        <td> <span class="<?php echo $row->amount < 0 ? 'text-danger' : 'text-success'; ?>"><?php echo $row->amount; ?> Diamond </span> </td>
                                                                        <td> <?php echo $row->status; ?> </td>
                                                                    </tr>
                                                                  <?php
                                                                  }

                                                                  ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--tab-pane-->
                                                    <div class="tab-pane" id="tab_1_22">
                                                      <div class="portlet-body">
                                                          <table class="table table-striped table-bordered table-advance table-hover">
                                                              <thead>
                                                                  <tr>
                                                                      <th width="15%">
                                                                          <i class="fa fa-calendar"></i> Date
                                                                      </th>
                                                                      <th width="25%">
                                                                          <i class="fa fa-question"></i> Type
                                                                      </th>
                                                                      <th>
                                                                          <i class="fa fa-bookmark"></i> Details
                                                                      </th>
                                                                      <th>
                                                                          <i class="fa fa-usd"></i> Amount
                                                                      </th>
                                                                      <th>
                                                                          <i class="fa fa-bookmark"></i> Status
                                                                      </th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                                <?php

                                                                foreach($gold_trans as $key => $row){

                                                                ?>
                                                                  <tr>
                                                                      <td> <?php echo date("d-m-Y h:ia",strtotime($row->created_at)); ?> </td>
                                                                      <td> <?php echo $row->title; ?> </td>
                                                                      <td> <?php echo $row->desc; ?> </td>
                                                                      <td> <span class="<?php echo $row->amount_gold < 0 ? 'text-danger' : 'text-success'; ?>"><?php echo $row->amount_gold; ?> Gold </span> </td>
                                                                      <td> <?php echo $row->status; ?> </td>
                                                                  </tr>
                                                                <?php
                                                                }

                                                                ?>
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                    </div>
                                                    <!--tab-pane-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--tab_1_2-->
                                <div class="tab-pane" id="tab_1_3">
                                    <div class="row profile-account">
                                        <div class="col-md-3">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#tab_1-1">
                                                        <i class="fa fa-cog"></i> Personal info </a>
                                                    <span class="after"> </span>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#tab_2-2">
                                                        <i class="fa fa-map-marker"></i> Address Book </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="tab-content">
                                                <div id="tab_1-1" class="tab-pane active">
                                                  <table class="table table-hover">
                                                    <tbody>
                                                      <tr>
                                                        <th>First Name</th>
                                                        <td><?php echo $user_detail->firstname; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <th>Last Name</th>
                                                        <td><?php echo $user_detail->lastname; ?></td>
                                                      </tr>
                                                      <tr>
                                                        <th>Email</th>
                                                        <td><?php echo $user_detail->email; ?></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                                <div id="tab_2-2" class="tab-pane">
                                                  <?php

                                                  // pre($user_address);

                                                  foreach($user_address as $key => $row){

                                                  ?>

                                                  <div class="col-md-6">
                                                      <!-- BEGIN Portlet PORTLET-->
                                                      <div class="portlet box <?php echo $row->deek ? 'green' : 'grey-salsa' ?>">
                                                          <div class="portlet-title">
                                                              <div class="caption">
                                                                  <i class="fa fa-map-marker"></i><?php echo $row->deek ? 'Default Shipping' : 'Additional' ?> Address </div>
                                                          </div>
                                                          <div class="portlet-body" style="height:160px;">

                                                                  <p>
                                                                    <?php

                                                                    $street_arr = explode("\n",$row->street);


                                                                    if($row->firstname != '' || $row->lastname != ''){
                                                                      echo $row->firstname != '' ? $row->firstname.' ' : '';
                                                                      echo $row->lastname != '' ? $row->lastname.' ' : '';
                                                                      echo '<br>';
                                                                    }

                                                                    echo isset($street_arr[0]) ? $street_arr[0].'<br>' : '';
                                                                    echo isset($street_arr[1]) ? $street_arr[1].'<br>' : '';

                                                                    echo $row->city != '' ? $row->city.', ' : '';
                                                                    echo $row->region != '' ? $row->region.', ' : '';
                                                                    echo $row->postcode != '' ? $row->postcode.'<br>' : '';


                                                                    echo $row->telephone != '' ? 'T : '.$row->telephone : '';

                                                                    ?>
                                                                  </p>

                                                          </div>
                                                      </div>
                                                      <!-- END Portlet PORTLET-->
                                                  </div>
                                                  <?php
                                                  }
                                                  ?>

                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-md-9-->
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>

                    <div class="modal fade in" id="modal_add" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title" id="modal_title"></h4>
                                </div>
                                <div class="modal-body">
                                  <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Amount</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Amount" name="amount" required id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                          <button type="submit" class="btn blue btn_submit">Add</button>
                                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="func" value="add_amount">
                                    <input type="hidden" name="type" id="type" value="">
                                  </form>
                              </div>
                          </div>
                        </div>
                      </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
<script type="text/javascript">

$(document).ready(function(){

  $('.add_data').on('click',function(){

    $('#modal_title').html('');
    $('#type').val('');

    var id = $(this).attr('id');

    if(id == 'diamond'){
      $('#modal_title').html('Add Diamond Amount');
      $('#type').val(id);
    }else if(id == 'gold'){
      $('#modal_title').html('Add Gold Amount');
      $('#type').val(id);
    }

    $('#modal_add').modal('show');


  });

});


</script>
<?php include BACK_INC.'htmlfooter.php'; ?>
