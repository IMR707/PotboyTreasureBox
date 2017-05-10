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
         $clear = 0;

         foreach ($AllDailyReward as $key => $value) {
             if ($value->gold_check == 1 && $value->spin_check == 1) {
                 $AllDailyReward[$key]->type = 1;
             } elseif ($value->gold_check == 1 && $value->spin_check == 0) {
                 $AllDailyReward[$key]->type = 2;
             } else {
                 $AllDailyReward[$key]->type = 3;
             }
         }

         $clear = 0;
         foreach ($AllDailyReward as $key => $value) {
             ++$clear;

             if ($value->type == 2 || $value->type == 3) {
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
              $amount1 = $value->gold_amount;
              $amount2 = $value->spin_amount;
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
             $urlarray = array('day' => $value->day_num);
             $url = http_build_query($urlarray); ?>
           <center>
             <?php
             $dt = Carbon::now();
             $dz = explode(' ', $dt);
             $day = $dz[0];
             $nowtext = 'Claim Now';
             $today = '';
             if ($day == $value->date_check) {
                 $nowtext = 'Claim Today';
                 $today = 'Today';
             }
             if ($value->done == 1) {
                 ?>
            <button class="btn daily-gold-claim claim-disabled" name="button" >Claimed <?php echo $today; ?></button>
            <?php

             } elseif ($day == $value->date_check) {
                 if ($user->uid) {
                     ?>
              <a href="?<?php echo $url; ?>" class="btn daily-gold-claim" name="button"><?php echo $nowtext; ?></a>
              <?php

                 } else {
                     ?>
              <button class="btn daily-gold-claim" name="button" onclick="alert('Please Login to Claim the Daily Reward')"><?php echo $nowtext; ?></button>
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
