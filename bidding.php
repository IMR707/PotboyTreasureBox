<?php
define('_VALID_PHP', true);
$pname = 'Bidding';
$menu = 'Bidding';
$pagemenu="BID";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
$topbid=$list->FEgetBidding('1');
$endsoonbid=$list->FEgetBidding('2');
$newbid=$list->FEgetBidding('3');
$pdbid=$list->FEgetBidding('4');
$pubid=$list->FEgetBidding('5');

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
                  <a href="instantclaim.php"  class="text-default"><img src="<?php echo UPLOADURL;?>a4.svg" class="imgsmall" alt="">
                  <h2>Instant Claim</h2>
                  </a>
              </div>
              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <a href="instantclaim.php"  class="text-default"><img src="<?php echo UPLOADURL;?>a2.svg" class="imgsmall" alt="">
                  <h2 >Coming Up Soon</h2>
                  </a>
              </div>
              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <a href="instantclaim.php"  class="text-default"><img src="<?php echo UPLOADURL;?>a4.svg" class="imgsmall" alt="">
                  <h2 >Winner Sharing</h2>
                  </a>
              </div>

              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <a href="instantclaim.php"  class="text-default"><img src="<?php echo UPLOADURL;?>a2.svg" class="imgsmall" alt="">
                  <h2 >Rules T&C</h2>
                  </a>
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
                      <?php if(!$topbid){

                        ?>
                        <div class="col-sm-6 col-md-6 col-xs-12 text-center">
                        </div><?php

                      }?>
                      <?php foreach ($topbid as $key => $value):

                        if($value->bid_base==1)pre($value);

                        ?>

                        <div class="col-sm-6 col-md-6 col-xs-12 text-center">
                      				<div class="panel panel-flat timeline-content">
            										<div class="panel-body">
                                  <div class="col-sm-12 col-md-12 col-xs-12 text-center">
            											<a href="#" class="display-block content-group">
            											  <img src="<?php echo BACK_UPLOADS;?><?php echo $value->img_header;?>" class="img-responsive" alt="">
            											</a>
                                    <h6 class="content-group text-left"><?php echo styleword($value->name);?>-<?php if($value->bid_base!=3){ echo " min ";} echo $value->min_bid; echo ($value->bid_type==1)?" Gold":" Diamond";?></h6>
                                    <div class="progress">
                      								<div class="progress-bar bg-purple" id='textval<?php echo $value->bidid;?>' style="width: <?php echo stylewordpercent($value->percent);?>">
                      									<?php if($value->percent>10){
                                          ?>
                                          <?php echo "<span id='text".$value->bidid."'>".stylewordpercent($value->percent)."</span>";?>
                                          <?php
                                        }?>
                      								</div>
                                      <?php if($value->percent<10){
                                        ?>
                                        <?php echo "<span id='text".$value->bidid."'>".stylewordpercent($value->percent)."</span>";?>
                                        <?php
                                      }?>
                      							</div>
                                  </div>

                                    <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                                      <br>
                                      <div class="clearfix"></div>

              												<span class="pull-left">


                                          <?php



                                          switch ($value->bid_base) {
                                            case '1':

                                            // $dt=$value->end_time->diffForHumans(\Carbon\Carbon::now());
                                            // pre($dt);
                                              ?>
                                              <ul class="list-inline list-inline-condensed heading-text pull-left">
                                              <li>Close in <b><?php echo $value->max_participant;?></b></li>
                                              </ul>
                                              <br>
                                              <?php
                                              break;

                                              case '2':
                                              ?>
                                              <ul class="list-inline list-inline-condensed heading-text pull-left">
                                              <li>Need <b><?php echo $value->max_participant;?></b> Participant</li>
                                              </ul>
                                              <br>
                                              <ul class="list-inline list-inline-condensed heading-text pull-left">
                                              <li>Current Participant <b><?php echo $value->participant;?></b> <br></li>
                                              </ul>
                                              <?php
                                                break;
                                                case '3':
                                                ?>
                                                <ul class="list-inline list-inline-condensed heading-text pull-left">
                                                <li>Available Voucher <b><?php echo $value->max_participant;?></b></li>
                                                </ul>
                                                <br>
                                                <ul class="list-inline list-inline-condensed heading-text pull-left">
                                                <li>Claimed Voucher <b><?php echo $value->participant;?></b> <br></li>
                                                </ul>
                                                <?php
                                                  break;

                                          }?>





              												</span>

                                      <span class="pull-right">
                                        <?php switch ($value->bid_base) {
                                          case '3':
                                            ?>
                                            <a href="claimpage.php?bid=<?php echo $value->bidid;?>" class="btn bg-purple">Claim Now</a>
                                            <?php
                                            break;

                                          default:
                                          ?>
                                          <a href="bidpage.php?bid=<?php echo $value->bidid;?>" class="btn bg-purple">Join Now</a>

                                          <?php
                                            break;
                                        }?>

                                      </span>
              											</div>

            										</div>

            										<div class="panel-footer panel-footer-transparent">

            										</div>
            									</div>


                        </div>

                      <?php endforeach; ?>

                      <!-- =$list->FEgetBidding('1');
                      $endsoonbid=$list->FEgetBidding('2');
                      $newbid=$list->FEgetBidding('3');
                      $pdbid=$list->FEgetBidding('4');
                      $pubid=$list->FEgetBidding('5'); -->


















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
