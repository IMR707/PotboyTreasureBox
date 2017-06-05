<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
$pname = 'Sky Knight';
$menu = 'ADMIN_GAMES';
$submenu = 'ADMIN_GAMES_PAY';
require_once 'init.php';
use Carbon\Carbon;

if (!$user->logged_in) {
    //redirect_to(SITEURL.'/index.php');
}

$game_detail = $fz->getDiamondGame();

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
                            <span class="caption-subject bold uppercase">Settings</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
											<div class="col-md-9">
												<?php

												if(isset($_SESSION['noti'])){
													if($_SESSION['noti']['status'] == 'error'){
														echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
													}elseif($_SESSION['noti']['status'] == 'success'){
														echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><span>×</span></button>'.$_SESSION['noti']['msg'].'</div>';
													}
													unset($_SESSION['noti']);
												}

												// pre($game_detail);
												?>

                        <form class="form-horizontal" role="form" action="backend/process.php" method="post" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Game Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Game Name" name="name" required value="<?php echo $game_detail->name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Diamond Amount</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="diamond" name="pay_amount" required value="<?php echo $game_detail->pay_amount; ?>">
                                    </div>
                                </div>
																<div class="form-group">
                                    <label class="col-md-3 control-label">Time Limit</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="seconds" name="time_limit" required value="<?php echo $game_detail->time_limit; ?>">
                                    </div>
                                </div>
																<div class="form-group">
                                    <label class="col-md-3 control-label">Score Multiplier</label>
                                    <div class="col-md-8">
                                        <input type="decimal" class="form-control" placeholder="0.0" name="score_multiplier" required value="<?php echo $game_detail->score_multiplier; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enemy 1</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="enemy1_score" required value="<?php echo $game_detail->enemy1_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enemy 2</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="enemy2_score" required value="<?php echo $game_detail->enemy2_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enemy 3</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="enemy3_score" required value="<?php echo $game_detail->enemy3_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enemy 4</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="enemy4_score" required value="<?php echo $game_detail->enemy4_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enemy 5</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="enemy5_score" required value="<?php echo $game_detail->enemy5_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sea ship</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="seaship_score" required value="<?php echo $game_detail->seaship_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Asteroid</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="asteroid_score" required value="<?php echo $game_detail->asteroid_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Silver Coin</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="silver_score" required value="<?php echo $game_detail->silver_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Gold Coin</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="gold_score" required value="<?php echo $game_detail->gold_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Medium Boss</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="medium_boss_score" required value="<?php echo $game_detail->medium_boss_score; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Final Boss</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" placeholder="0" name="final_boss_score" required value="<?php echo $game_detail->final_boss_score; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-8">
                                      <button type="submit" class="btn blue">Update</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="func" value="update_paid_game">
                        </form>

                      </div>
											<div class="clearfix"></div>
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


});


</script>


<?php include BACK_INC.'htmlfooter.php'; ?>
