<?php
define('_VALID_PHP', true);
$pname = 'Daily Reward';
$menu = 'dailyGold';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

$AllDailyReward=$list->FEgetAllDailyReward($user->uid);

$msg='';
if (isset($_GET['day'])) {
  $msg=$list->FEgetDailyReward($_GET['day'],$user->uid);
}

// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
?>
<?php
 include 'fehead.php';
 ?>


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

         <?php
         $clear=0;

         foreach ($AllDailyReward as $key => $value) {
             if ($value->gold_check==1&&$value->spin_check==1) {
                 $AllDailyReward[$key]->type=1;
             } elseif ($value->gold_check==1&&$value->spin_check==0) {
                 $AllDailyReward[$key]->type=2;
             } else {
                 $AllDailyReward[$key]->type=3;
             }
         }

         $clear=0;
         foreach ($AllDailyReward as $key => $value) {
             $clear++;

             if ($value->type==2||$value->type==3) {
                 ?>

          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="clearfix">&nbsp;</div>

            <?php

             } else {
                 ?>
           <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2">
             <?php

             } ?>
         <div class="panel-heading daily-gold-container">

           <div class="text-center daily-title bg-yellow-gold img-rounded">Day <?php echo $value->day_num; ?></div>
           <?php
           $amount1=$value->gold_amount;
             $amount2=$value->spin_amount;
             switch ($value->type) {
             case '1':
               ?>
               <div class="col-md-4">
                 <div class="text-center daily-gold-text">X <?php echo $amount1;?></div>
                 <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
               </div>
               <div class="col-md-4 daily-gold-plus">+</div>
               <div class="col-md-4">
                 <div class="text-center daily-gold-text">X <?php echo $amount2;?></div>
                 <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>slot_machine.png"></div>
               </div>
               <?php
               break;

               case '2':
                 ?>

                   <div class="text-center daily-gold-text">X <?php echo $amount1;?></div>
                   <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>gold-coin-icon.png"></div>
                   <div class="text-center">&nbsp;</div>

                 <?php
                 break;

                 case '3':
                   ?>
                     <div class="text-center daily-gold-text">X <?php echo $amount2;?></div>
                     <div class="text-center"><img class="img-responsive gold-coin"  src="<?php echo FRONTIMAGE;?>slot_machine.png"></div>

                   <?php
                   break;
           }
             $urlarray=array('day'=>$value->day_num);
             $url=http_build_query($urlarray); ?>
           <center>
             <?php
             $dt = Carbon::now();
             $dz=explode(" ", $dt);
             $day=$dz[0];
             $nowtext="Claim Now";
             $today="";
             if ($day==$value->date_check) {
                 $nowtext="Claim Today";
                 $today="Today";
             }
             if ($value->done==1) {
                 ?>
            <button class="btn daily-gold-claim claim-disabled" name="button" >Done Claimed <?php echo $today; ?></button>
            <?php

             } elseif ($day==$value->date_check) {
                 if ($user->uid) {
                     ?>
              <a href="?<?php echo $url; ?>" class="btn daily-gold-claim" name="button"><?php echo $nowtext; ?></a>
              <?php

                 } else {
                     ?>
              <button class="btn daily-gold-claim" name="button" onclick="alert('please login to claim')"><?php echo $nowtext; ?></button>
              <?php

                 }
             } else {
                 ?>
            <a class="btn daily-gold-claim claim-disabled" name="button">Claim Later</a>
            <?php

             } ?>

           </center>
         </div>
       </div>

         <?php

         }

         ?>
       </div>

       <!-- <div class="row">
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
       </div> -->

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

  <?php
   include 'fefoot.php';
   ?>
   <script type="text/javascript">
   <?php
    if ($msg) {
        ?>
      alert('<?php echo $msg; ?>');
      location.href="dailyReward.php";
   <?php
    }
    ?>
   </script>
