<?php
define('_VALID_PHP', true);
$pname = 'Instant Claim';
$menu = 'Instant Claim';
$pagemenu="BID";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
$allclaim=$list->FEgetAllClaim();


// pre($homeSlider);
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




        <div class="panel panel-flat" style="height:100%">
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
            // pre($allclaim);
            foreach ($allclaim as $key => $value) {
              $claim_id = $value->id;

              $check_claim = $fz->checkUserClaim($claim_id);

              ?>

              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                    <div class="panel panel-flat timeline-content">
                      <div class="panel-body" style="padding:5px">

                        <div class="col-sm-4 col-md-4 col-xs-12 text-center">

                          <div class="col-sm-12 col-md-12 col-xs-12 text-center">

                            <div class="bg-danger-600" style="padding:5px;margin-top:3px;border:2px solid white"><span>Instant Claim</span></div>
                          </div>
                          <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                            <img src="<?php echo BACK_UPLOADS.$value->img_header;?>" class="img-responsive" alt="" width="100%" style="border:2px solid white">
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
                            <?php if($value->percent<=10){
                              ?>
                              <?php echo "<span id='text".$value->bidid."'>".stylewordpercent($value->percent)."</span>";?>
                              <?php
                            }?>
                          </div>

                          <span class="pull-right">
                            <ul class="list-inline list-inline-condensed heading-text">
                          <li><a href="#" class="text-default">Voucher Available<br> <?php echo ($value->max_participant-$value->participant);?></a></li>
                            </ul>
                          </span>

                        </div>


                        <div class="col-sm-2 col-md-2 col-xs-12 text-center">
                          <br>
                          <span class="pull-right">
                            <?php
                            if($check_claim){
                              ?>
                              <button class="btn bg-purple" disabled>Claimed</button>
                              <?php
                            }else{
                              ?>
                              <button class="btn bg-purple btn_claim" id="<?php echo $value->id?>">Claim Now</button>
                              <?php
                            }

                            ?>

                          </span>

                        </div>
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

  <script type="text/javascript">

  $(document).ready(function(){
    
  });

  </script>

  <?php
   include 'fefoot.php';
   ?>
