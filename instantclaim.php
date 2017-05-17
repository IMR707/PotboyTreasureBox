<?php
define('_VALID_PHP', true);
$pname = 'Instant Claim';
$menu = 'Instant Claim';
$pagemenu="BID";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

// $announcement=$list->FEgetAnnouncement();

// pre($homeSlider);
// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
?>
<?php
 include 'fehead.php';
 ?>




 	<!-- Page header -->
 	<!-- <div class="page-header">
 		<div class="page-header-content">
 			<br>


 		</div>
 	</div> -->
 	<!-- /page header -->


 	<!-- Page container -->


 		<!-- Page content -->
 		<div class="page-content">

 			<!-- Main content -->
 			<div class="content-wrapper">




        <div class="panel panel-flat">
          <div class="panel-body">


<?php for ($i=0; $i <10 ; $i++) {
  ?>
  <div class="col-sm-12 col-md-12 col-xs-12 text-center">
        <div class="panel panel-flat timeline-content">
          <div class="panel-body">

            <div class="col-sm-3 col-md-3 col-xs-12 text-center">

              <a href="#" class="display-block content-group">
                <!-- <div class="ribbon-wrapper-green"><div class="ribbon-green">HOT</div></div> -->
                <img src="<?php echo BACK_UPLOADS;?>thumbnail.png" class="img-responsive" alt="">
              </a>

            </div>


            <div class="col-sm-6 col-md-6 col-xs-12 text-center">

              <h6 class="content-group text-left">Fitbit Surge (Small)-min 5,00 Gold</h6>
              <div class="progress">
                <div class="progress-bar bg-purple" style="width: 92.8%">
                  <span>92.8%</span>
                </div>
              </div>

              <span class="pull-left">
                <ul class="list-inline list-inline-condensed heading-text">
                  <li><a href="#" class="text-default">Available Claim<br> 800</a></li>
                </ul>
              </span>

              <span class="pull-right">
                <ul class="list-inline list-inline-condensed heading-text">
              <li><a href="#" class="text-default">Available Claim<br> 900</a></li>
                </ul>
              </span>



            </div>


            <div class="col-sm-3 col-md-3 col-xs-12 text-center">
<br>
              <span class="pull-right">
                <a href="#" class="btn bg-purple">Claim Now</a>
              </span>

            </div>

            <div class="col-sm-12 col-md-12 col-xs-12 text-center">


            </div>



          </div>

          <div class="panel-footer panel-footer-transparent">

          </div>
        </div>


  </div>
  <?php
}?>
          </div>
        </div>















 			</div>
 			<!-- /main content -->

 		</div>

  <?php
   include 'fefoot.php';
   ?>
