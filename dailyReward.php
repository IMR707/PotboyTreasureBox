<?php
define('_VALID_PHP', true);
$pname = 'Daily Reward';
$menu = 'dailyGold';
$pagemenu = 'DASH';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
$AllDailyReward = $list->FEgetAllDailyReward($user->uid);
$msg = '';
if (isset($_GET['day'])) {
    $msg = $list->FEgetDailyReward($_GET['day'], $user->uid);
}

// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
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


          <?php

          // pre($AllDailyReward);
          foreach ($AllDailyReward as $key => $value):
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
                          <div class="daily-gold-text"><?php echo $value->gold_amount; ?></div>
                        </div>

                      <?php
                      }
                      if($value->spin_check){
                        ?>
                        <div class="text-center">
                          <img class="gold-coin" src="<?php echo FRONTIMG;?>present.png" style="width:30px;margin:0 5px;">
                          <div class="daily-gold-text"><?php echo $value->spin_amount; ?></div>
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
                          case '2':
                            ?>
                            <span class="img-rounded daily-gold-claim pointer"onclick="dailyreward('<?php echo $value->day_num;?>');">Claim Now</span>
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
          </div>



 			</div>
 			<!-- /main content -->

 		</div>
    <div class="clearfix"></div>
 		<!-- /page content -->
  </div>

 	<!-- /page container -->
  <script type="text/javascript">
    function dailyreward(day){
      var a=verifylogin();
      if(a){
      location.href="dailyReward.php?day="+day;
      }
    }
    <?php
     if ($msg) {
         ?>
         bootbox.confirm({
     message: "<?php echo $msg; ?>",
     buttons: {
         confirm: {
             label: 'Yes',
             className: 'btn-success'
         }
     },
     callback: function (result) {
         console.log('This was logged in the callback: ' + result);
         location.href="dailyReward.php";
     }
 });
    <?php

     }
     ?>
  </script>
  <?php
   include 'fefoot.php';
   ?>
  </div>
 </body>
 </html>
