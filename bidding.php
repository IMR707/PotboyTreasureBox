<?php
define('_VALID_PHP', true);
$pname = 'Bidding';
$menu = 'Bidding';
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


        <?php
         include 'homeSlider.php';
         ?>

         <?php
          include 'announcement.php';
          ?>


          <div class="panel panel-flat">
            <div class="panel-body">


              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <img src="<?php echo UPLOADURL;?>a4.svg" class="imgsmall" alt="">
                  <h2>Instant Claim</h2>
              </div>
              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <img src="<?php echo UPLOADURL;?>a2.svg" class="imgsmall" alt="">
                  <h2 >Coming Up Soon</h2>
              </div>
              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <img src="<?php echo UPLOADURL;?>a4.svg" class="imgsmall" alt="">
                  <h2 >Winner Sharing</h2>
              </div>

              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <img src="<?php echo UPLOADURL;?>a2.svg" class="imgsmall" alt="">
                  <h2 >Rules T&C</h2>
              </div>
            </div>
          </div>



          	<div class="panel panel-flat">
							<div class="panel-body">
								<div class="tabbable">
									<ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
										<li class="active"><a href="#solid-rounded-justified-tab1" data-toggle="tab">Top</a></li>
										<li><a href="#solid-rounded-justified-tab2" data-toggle="tab">Progress</a></li>
                    <li><a href="#solid-rounded-justified-tab3" data-toggle="tab">New</a></li>
                    <li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Price <span class="caret"></span></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#solid-rounded-justified-tab4" data-toggle="tab">Expensive first</a></li>
												<li><a href="#solid-rounded-justified-tab5" data-toggle="tab">Cheap first</a></li>
											</ul>
										</li>
									</ul>

									<div class="tab-content">
										<div class="tab-pane active" id="solid-rounded-justified-tab1">




                      <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                    				<div class="panel panel-flat timeline-content">
          										<div class="panel-body">
          											<a href="#" class="display-block content-group">
          												<img src="<?php echo UPLOADURL;?>cover.jpg" class="img-responsive" alt="">
          											</a>

          											<h6 class="content-group text-left">
          												Fitbit Surge (Small)-min 5,00 Gold</h6>

                                  <div class="progress">
                    								<div class="progress-bar bg-purple" style="width: 92.8%">
                    									<span><i id="" class="icon-spinner4 spinner position-left"></i>92.8% Complete</span>
                    								</div>
                    							</div>
          										</div>

          										<div class="panel-footer panel-footer-transparent">
          											<div class="heading-elements">
          												<ul class="list-inline list-inline-condensed heading-text">
          													<li><a href="#" class="text-default">Need 900</a></li>

          												</ul>

          												<span class="heading-btn pull-right">
          													<a href="#" class="btn bg-purple">Join Now</a>
          												</span>
          											</div>
          										</div>
          									</div>


                      </div>


                      <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                    				<div class="panel panel-flat timeline-content">
          										<div class="panel-body">
          											<a href="#" class="display-block content-group">
          												<img src="<?php echo UPLOADURL;?>cover.jpg" class="img-responsive" alt="">
          											</a>

          											<h6 class="content-group text-left">
          												Fitbit Surge (Small)-min 5,00 Gold</h6>

                                  <div class="progress">
                    								<div class="progress-bar bg-purple" style="width: 85%">
                    									<span><i id="" class="icon-spinner4 spinner position-left"></i>85% Complete</span>
                    								</div>
                    							</div>
          										</div>

          										<div class="panel-footer panel-footer-transparent">
          											<div class="heading-elements">
          												<ul class="list-inline list-inline-condensed heading-text">
          													<li><a href="#" class="text-default">Need 900</a></li>
          													<li><a href="#" class="text-default">Bids 800</a></li>
          												</ul>

          												<span class="heading-btn pull-right">
          													<a href="#" class="btn bg-purple">Claim Now</a>
          												</span>
          											</div>
          										</div>
          									</div>


                      </div>

                      <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                    				<div class="panel panel-flat timeline-content">
          										<div class="panel-body">
          											<a href="#" class="display-block content-group">
          												<img src="<?php echo UPLOADURL;?>cover.jpg" class="img-responsive" alt="">
          											</a>

          											<h6 class="content-group text-left">
          												Fitbit Surge (Small)-min 5,00 Gold</h6>

                                  <div class="progress">
                    								<div class="progress-bar bg-purple" style="width: 85%">
                    									<span><i id="" class="icon-spinner4 spinner position-left"></i>85% Complete</span>
                    								</div>
                    							</div>
          										</div>

          										<div class="panel-footer panel-footer-transparent">
          											<div class="heading-elements">
          												<ul class="list-inline list-inline-condensed heading-text">
          													<li><a href="#" class="text-default">Need 900</a></li>
          													<li><a href="#" class="text-default">Bids 800</a></li>
          												</ul>

          												<span class="heading-btn pull-right">
          													<a href="#" class="btn bg-purple">Claim Now</a>
          												</span>
          											</div>
          										</div>
          									</div>


                      </div>

                      <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                    				<div class="panel panel-flat timeline-content">
          										<div class="panel-body">
          											<a href="#" class="display-block content-group">
          												<img src="<?php echo UPLOADURL;?>cover.jpg" class="img-responsive" alt="">
          											</a>

          											<h6 class="content-group text-left">
          												Fitbit Surge (Small)-min 5,00 Gold</h6>

                                  <div class="progress">
                    								<div class="progress-bar bg-purple" style="width: 85%">
                    									<span><i id="" class="icon-spinner4 spinner position-left"></i>85% Complete</span>
                    								</div>
                    							</div>
          										</div>

          										<div class="panel-footer panel-footer-transparent">
          											<div class="heading-elements">
          												<ul class="list-inline list-inline-condensed heading-text">
          													<li><a href="#" class="text-default">Need 900</a></li>
          													<li><a href="#" class="text-default">Bids 800</a></li>
          												</ul>

          												<span class="heading-btn pull-right">
          													<a href="#" class="btn bg-purple">Claim Now</a>
          												</span>
          											</div>
          										</div>
          									</div>


                      </div>











										</div>

										<div class="tab-pane" id="solid-rounded-justified-tab2">
											Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
										</div>

										<div class="tab-pane" id="solid-rounded-justified-tab3">
											DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
										</div>

                    <div class="tab-pane" id="solid-rounded-justified-tab4">
											Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
										</div>
                    <div class="tab-pane" id="solid-rounded-justified-tab5">
											test123 ganic, assumenda labore aesthet. nulla singl
										</div>
									</div>
								</div>
							</div>
						</div>










 			</div>
 			<!-- /main content -->

 		</div>

  <?php
   include 'fefoot.php';
   ?>
