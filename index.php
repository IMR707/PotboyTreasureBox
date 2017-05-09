<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

$announcement=$list->FEgetAnnouncement();
$homeSlider=$list->FEgetHomeSlider();
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
 	<div class="page-container">

 		<!-- Page content -->
 		<div class="page-content">

 			<!-- Main content -->
 			<div class="content-wrapper">

        <!-- Simple panel -->
 				<div class="panel panel-flat">
 					<div class="panel-body">


                    <div class="col-sm-12 col-md-12">
                      <div id="carousel-notification" class="bootstrap-carousel" data-indicators="true" data-controls="true">

                        <?php foreach ($homeSlider as $key => $value):?>
                        <img src="backend/uploads/<?php echo $value->img_name?>" data-title="" class="img-responsive">
                        <?php endforeach; ?>
                      </div>
                    </div>

 						<!-- <h6 class="text-semibold">Start your development with no hassle!</h6>
 						<p class="content-group">Common problem of templates is that all code is deeply integrated into the core. This limits your freedom in decreasing amount of code, i.e. it becomes pretty difficult to remove unnecessary code from the project. Limitless allows you to remove unnecessary and extra code easily just by removing the path to specific LESS file with component styling. All plugins and their options are also in separate files. Use only components you actually need!</p> -->
 					</div>
 				</div>
 				<!-- /simple panel -->


        <!-- Simple panel -->
 				<div class="panel panel-flat">
 					<div class="panel-body">
 						<p class="content-group">
              <div class="col-md-1 col-xs-4">

                <img src="<?php echo FRONTIMAGE;?>liveupdate.png" class="img-responsive">
              </div>
              <div class="col-md-11 col-xs-8">
              <marquee><?php echo $announcement;?></marquee>
              </div>

              </p>
 					</div>
 				</div>
 				<!-- /simple panel -->




        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px!important;">
 								<img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
                <button type="button" class="btn btn-purple" name="button" style="display: block; width: 100%;">Next Daily <br> GOLD box in <br><b id="time">xx:xx:xx</b></button>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px!important;">
 								<img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
                <button type="button" class="btn btn-purple" name="button" style="display: block; width: 100%;">Free Games <br>in <br><b id="time">xx:xx:xx</b></button>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
 				</div>

        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px!important;">
 								<img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
                <button type="button" class="btn btn-purple" name="button" style="display: block; width: 100%;">Convert <br> DIAMOND to <br>GOLD</button>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
          <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px!important;">
 								<img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
                <button type="button" class="btn btn-purple" name="button" style="display: block; width: 100%;">Play it <br>Now<br> <b id="time">1 Diamond</b></button>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
 				</div>



 			</div>
 			<!-- /main content -->

 		</div>
 		<!-- /page content -->

 	</div>
 	<!-- /page container -->
  <?php
   include 'fefoot.php';
   ?>
