<?php
define('_VALID_PHP', true);
$pname = 'Daily Gold';
$menu = 'dailyGold';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
?>
<?php
 //include 'fehead.php';
 //include 'feheader.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title><?php echo $pname.WEBNAME;?></title>

 	<!-- Global stylesheets -->
 	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>icons/icomoon/styles.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>bootstrap.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>core.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>components.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>colors.css" rel="stylesheet" type="text/css">
  <link href="<?php echo FRONTCSS;?>style.css" rel="stylesheet" type="text/css">
 	<!-- /global stylesheets -->

 	<!-- Core JS files -->
 	<script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/jquery.min.js"></script>
 	<script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/bootstrap.min.js"></script>
 	<script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/nicescroll.min.js"></script>
 	<script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/drilldown.js"></script>
 	<!-- /core JS files -->

 	<!-- Theme JS files -->
 	<script type="text/javascript" src="<?php echo FRONTJS;?>core/app.js"></script>
  <script src="<?php echo FRONTJS;?>bootstrap-carousel.js"></script>
 	<!-- /theme JS files -->

 </head>

 <body>
   <div class="col-md-8 col-md-offset-2">

 	<!-- Main navbar -->
  <?php if (!MV) {
     ?>
 	<div class="navbar navbar-inverse bg-purple">
 		<div class="navbar-header">
 			<a class="navbar-brand" href="index.php"><img src="<?php echo BACK_IMG; ?>logo.png"></a>


 			<ul class="nav navbar-nav pull-right visible-xs-block">
 				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
 			</ul>
 		</div>

 		<div class="navbar-collapse collapse" id="navbar-mobile">



 			<ul class="nav navbar-nav navbar-right">


        <span class="dy-diamond" style="">


        </span>

        <li class="dropdown dropdown-user">
          <a><div class="left" data-toggle="tooltip" title="Potboy Credit - You can use credit to buy groceries. Buy your Potboy Credit at discounted rate today!"> <img src="http://potboy.com.my/pub/media/customercredit/point.png" style="width:15px"> <span id="credit_navlink">RM 0.00</span></div></a>
        </li>

        <li class="dropdown dropdown-user">
          <a><div class="left" data-toggle="tooltip" title="Potboy Gold - You can further slash prices with Potboy Gold, collect Potboy Gold today!"> <img src="http://potboy.com.my/pub/media/logo/stores/1/gold.png" style="width:16px"> <span id="gold_navlink">0</span></div></a>
        </li>

        <li class="dropdown dropdown-user">
          <a><div class="left" data-toggle="tooltip" title="Potboy Diamond - Earn Diamond with every RM50 purchase, you can convert Potboy Diamond to Potboy Gold!"><img src="http://potboy.com.my/pub/media/logo/stores/1/diamond.png" style="width:16px"> <span id="diamond_navlink">0</span></div></a>
        </li>


          <li class="dropdown dropdown-user">
 						<?php
            if (!$user->logged_in) {
                ?>
                <a href="login.php"><span>Guest</span>
                  <?php

            } else {
                ?>
              <a class="dropdown-toggle" data-toggle="dropdown"><span>User</span><i class="caret"></i>
                <?php

            } ?>

 					</a>

 					<ul class="dropdown-menu dropdown-menu-right">

 						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
 						<li><a href="#"><i class="icon-coins"></i> My balance</a></li>
 						<li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
 						<li class="divider"></li>
 						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
 						<li><a href="#"><i class="icon-switch2"></i> Logout</a></li>

 					</ul>
 				</li>
 			</ul>
 		</div>
 	</div>
 	<!-- /main navbar -->



 	<!-- Second navbar -->
 	<div class="navbar navbar-default" id="navbar-second">
 		<ul class="nav navbar-nav no-border visible-xs-block">
 			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
 		</ul>

 		<div class="navbar-collapse collapse" id="navbar-second-toggle">
 			<ul class="nav navbar-nav">
 				<li><a href="index.php"><i class="icon-display4 position-left"></i> Dashboard</a></li>
        <li><a href="index.php"><i class="icon-display4 position-left"></i> Bidding</a></li>
        <li><a href="index.php"><i class="icon-display4 position-left"></i> Latest Winners</a></li>
        <li><a href="index.php"><i class="icon-display4 position-left"></i> Wishlist Voting</a></li>
        <?php
        if (!$user->logged_in) {
            ?>
            <li><a href="login.php"><i class="icon-display4 position-left"></i> Login</a></li>
              <?php

        } else {
            ?>
          <li><a href="index.php"><i class="icon-display4 position-left"></i> My Account</a></li>
            <?php

        } ?>

 			</ul>
 		</div>
 	</div>
 	<!-- /second navbar -->
<?php
 }?>

 	<!-- Page header -->
 	<!-- <div class="page-header">
 		<div class="page-header-content">
 			<br>


 		</div>
 	</div> -->
 	<!-- /page header -->


 	<!-- Page container -->
        <div>&nbsp;</div>
 	<div class="page-container bg-white">

 		<!-- Page content -->
 		<div class="page-content">

 			<!-- Main content -->
 			<div class="content-wrapper">

        <!-- Simple panel -->
<!-- 				<div class="panel panel-flat">
 					<div class="panel-body">



 					</div>
 				</div>-->

        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel-heading daily-gold-container">
                  <div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
                  <div class="text-center daily-gold-text">X 1</div>
                  <div class="text-center"><img class="img-responsive gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
                  <div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="panel-heading daily-gold-container">
                  <div class="text-center daily-title bg-yellow-gold img-rounded">Day 2</div>
                  <div class="text-center daily-gold-text">X 2</div>
                  <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
                  <div class="text-center "><span class="img-rounded daily-gold-claim claim-disabled">Claim Now</span></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="panel-heading daily-gold-container">
                  <div class="text-center daily-title bg-yellow-gold img-rounded">Day 3</div>
                  <div class="text-center daily-gold-text">X 4</div>
                  <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
                  <div class="text-center "><span class="img-rounded daily-gold-claim claim-disabled">Claim Now</span></div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel-heading daily-gold-container">
                  <div class="text-center daily-title bg-yellow-gold img-rounded">Day 4</div>
                  <div class="text-center">&nbsp;</div>
                  <div class="text-center"><img class="img-responsive gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png"></div>
                  <div class="text-center "><span class="img-rounded daily-gold-claim claim-disabled">Claim Now</span></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="panel-heading daily-gold-container">
                  <div class="text-center daily-title bg-yellow-gold img-rounded">Day 5</div>
                  <div class="text-center daily-gold-text">X 8</div>
                  <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
                  <div class="text-center "><span class="img-rounded daily-gold-claim claim-disabled">Claim Now</span></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              <div class="panel-heading daily-gold-container">
                  <div class="text-center daily-title bg-yellow-gold img-rounded">Day 6</div>
                  <div class="text-center daily-gold-text">X 16</div>
                  <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
                  <div class="text-center "><span class="img-rounded daily-gold-claim claim-disabled">Claim Now</span></div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-sm-offset-2">
              <div class="panel-heading daily-gold-container">
                  <div>
                      <div class="text-center daily-title bg-yellow-gold img-rounded">Day 7</div>
                  </div>
                  <div class="padding-btm-md">
                      <div class="col-md-4">
                        <div class="text-center daily-gold-text">X 20</div>
                        <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
                      </div>
                    <div class="col-md-4 daily-gold-plus">+</div>
                    <div class="col-md-4"><img src="<?php echo FRONTIMAGE;?>slot_machine.png" class="img-responsive" ></div>
                  </div>
                  <div class="padding-top-md">
                      <div class="text-center "><span class="img-rounded daily-gold-claim claim-disabled">Claim Now</span></div>
                  </div>  
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

 				<!-- /simple panel -->

        <!-- Simple panel -->
 				<!--<div class="panel panel-flat">
 					<div class="panel-body">
 						<p class="content-group">Common problem of templates is that
              </p>
 					</div>
 				</div>-->
 				<!-- /simple panel -->

        <!-- <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">

 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px!important;">
 								<img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
 							</div>
 						</div>

 					</div>
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">

 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px!important;">
 								<img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
 							</div>
 						</div>

 					</div>
 				</div>-->


 			</div>
 			<!-- /main content -->

 		</div>
 		<!-- /page content -->

 	</div>
 	<!-- /page container -->

<?php if (!MV) {
     ?>
 	<!-- Footer -->
  <br>
 	<div class="footer text-muted">
    <center>©Copyright <?php echo date('Y'); ?> by  <a href="<?php echo HOMEURL; ?>">PB Grocery Group Sdn. Bhd. (1209976-H)</a>. All Rights Reserved.</center>
 	</div>
 	<!-- /footer -->
  <?php
 }?>
  </div>
 </body>
 </html>