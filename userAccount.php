<?php
define('_VALID_PHP', true);
$pname = 'My Account';
$menu = 'dailyGold';
$pagemenu = 'UACC';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

$AllDailyReward = [];

if (!$user->logged_in) {
    redirect_to(SITEURL.'/index.php');
}
?>
<?php
 include 'fehead.php';
 ?>

 	<!-- Page container -->
 	<div class="page-container bg-white">
 		<!-- Page content -->
 		<div class="page-content">
 			<!-- Main content -->
 			<div class="content-wrapper">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <?php foreach ($AllDailyReward as $key => $value):
            $today=explode(' ',Carbon::now())[0]== $value->date_check? 1:0;
            if($today){
              $type=$value->done?3:1;
              if($type==1&&!$user->uid)$type=2;
            }elseif ($value->done) {
              $type=4;
            }
            else {
              $type=5;
            }
             ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
              <div class="panel panel-flat <?php echo $today? 'today' : 'not-today';?>">
                <div class="panel-heading" style="padding:10px 10px;">
                  <div class="text-center daily-title bg-yellow-gold img-rounded">Day <?php echo $value->day_num;?></div>
                </div>
                <div class="container-fluid">
                  <div class="row text-center">
                    <div class="col-md-10 col-md-offset-1 col-xs-12 reward-area">


                      <div class="each-reward">
                      <?php
                      if($value->gold_check){
                        ?>
                        <div class="text-center">
                          <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                          <div class="daily-gold-text">100</div>
                        </div>

                      <?php
                      }
                      if($value->spin_check){
                        ?>
                        <div class="text-center">
                          <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                          <div class="daily-gold-text">100</div>
                        </div>

                      <?php
                      } ?>

                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="text-center ">
                        <?php switch ($type) {
                          // $type
                          // 1 = today not done
                          // 2 = today not done no login
                          // 3 = today done
                          // 4 = yesterday
                          // 5 = forwardday
                          case '1':
                            ?>
                            <span class="img-rounded daily-gold-claim pointer"onclick="dailyreward('<?php echo $value->day_num;?>');">Claim Now</span>
                            <?php
                            break;
                          case '2':
                            ?>
                            <span class="img-rounded daily-gold-claim pointer" onclick="alert('Please Login to Claim the Daily Reward.');">Claim Now</span>
                            <?php
                            break;
                          case '3':
                          case '4':
                            ?>
                            <span class="img-rounded daily-gold-claim claim-disabled">Claimed</span>
                            <?php
                            break;
                          case '5':
                            ?>
                            <span class=" daily-gold-claim claim-disabled" style="background-color:transparent"></span>
                            <?php
                            break;
                        }?>

                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <?php


          switch ($user->accstatus) {
            case '0':
              ?>
              <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
              <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
              <h6 class="alert-heading text-semibold">Not Logged in</h6>
              <a href="">Click here to Login to your Account</a>
              </div>
              <?php
              break;

            default:
              # code...
              break;
          }
          if(!$user->accverify||!$user->userAddress){
            ?>
            <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <h6 class="alert-heading text-semibold">Your Mobile Number is not Verified.</h6>

            <a href="">Click here to Verify your Account;</a>
            </div>
            <?php
          }
            ?>









          <br>ACCOUNT INFORMATION
          <br>Address Book
          <br>Potboy Rewards
          <br>Recent Potboy Diamonds Transactions
          <br>Recent Potboy Golds Transactions
          </div>



 			</div>
 			<!-- /main content -->

 		</div>
    <div class="clearfix"></div>
 		<!-- /page content -->
    <?php
     include 'fefoot.php';
     ?>
  </div>
 </body>
 </html>
