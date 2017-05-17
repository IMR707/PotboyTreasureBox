<?php
define('_VALID_PHP', true);
$pname = 'Instant Claim';
$menu = 'Instant Claim';
$pagemenu="BID";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

altest('1');
$allclaim=$list->FEgetAllClaim();

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


            <?php if(!$allclaim){
              ?>
              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                <div class="panel panel-flat timeline-content">
                  <div class="panel-body">
                    No Instant Claim at the Moment
                  </div>
                </div>
              </div>
                <?php
            }

            foreach ($allclaim as $key => $value) {

              ?>

              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                    <div class="panel panel-flat timeline-content">
                      <div class="panel-body">

                        <div class="col-sm-3 col-md-3 col-xs-12 text-center">

                          <div class="col-sm-12 col-md-12 col-xs-12 text-center">

                            <div class="bg-slate-400"><span>Instant Claim</span></div>
                          </div>
                          <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                            <img src="<?php echo BACK_UPLOADS.$value->img_header;?>" class="img-responsive" alt="" width="100%">
                          </div>
                        </div>


                        <div class="col-sm-6 col-md-6 col-xs-12 text-center">

                          <h6 class="content-group text-left"><?php echo styleword($value->title);?><br><small>Each claim - <b><?php echo $value->gold_amount;?></b> POTBOY GOLD</small></h6>
                          <div class="progress">
                            <div class="progress-bar bg-purple" style="width: <?php echo stylewordpercent($value->percent);?>">
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

                          <span class="pull-left">
                            <ul class="list-inline list-inline-condensed heading-text">
                              <li><a href="#" class="text-default">Available<br>Claim<br> <?php echo $value->max_participant;?></a></li>
                            </ul>
                          </span>

                          <span class="pull-right">
                            <ul class="list-inline list-inline-condensed heading-text">
                          <li><a href="#" class="text-default">Remaining<br>Claim<br> <?php echo ($value->max_participant-$value->participant);?></a></li>
                            </ul>
                          </span>



                        </div>


                        <div class="col-sm-3 col-md-3 col-xs-12 text-center">
              <br>
                          <span class="pull-right">
                            <a href="<?php echo $value->id;?>" class="btn bg-purple">Claim Now</a>
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
            }
            ?>


          </div>
        </div>















 			</div>
 			<!-- /main content -->

 		</div>

  <?php
   include 'fefoot.php';
   ?>
