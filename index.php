<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$pagemenu="DASH";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;


//pre($user);
// die;

// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
?>
<?php
 include 'fehead.php';
 ?>


 		<!-- Page content -->
 		<div class="page-content">

 			<!-- Main content -->
 			<div class="content-wrapper">


        <?php
         include 'homeSlider.php';
         ?>

         <?php
          include 'announcement.php';
          ?>
          <div class="panel panel-flat" style="margin-bottom:5px !important">
            <div class="panel-body" style="padding:5px 30px !important;">
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
 								<a href="dailyReward.php"><img src="https://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a href="dailyReward.php"  class="btn btn-purple" name="button" style="display: block; width: 100%;">Next Daily <br> GOLD box in <br><b id="time">xx:xx:xx</b></a>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
                <a onclick="verifylink('bidpage.php?bid=s')" ><img src="https://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a onclick="verifylink('bidpage.php?bid=5')" class="btn btn-purple" name="button" style="display: block; width: 100%;">Free Games <br>in <br><b id="time">xx:xx:xx</b></a>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>



          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
 								<a href="goldConversion.php"><img src="https://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a href="goldConversion.php"  class="btn btn-purple" name="button" style="display: block; width: 100%;">Convert <br> DIAMOND to <br>GOLD</a>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
 								<img src="https://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
                <button type="button" class="btn btn-purple" name="button" style="display: block; width: 100%;">Play it <br>Now<br> <b id="time">1 Diamond</b></button>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>

      </div>
      </div>


 			</div>
 			<!-- /main content -->

 		</div>

  <?php
   include 'fefoot.php';
   ?>
