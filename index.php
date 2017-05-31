<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$pagemenu="DASH";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
$now = Carbon::now();
$end = Carbon::tomorrow('Asia/Kuala_Lumpur');
$ckdg=$user->checkDailyGold(($user->logged_in) ? $user->uid:0);
$ckfg=$user->checkDailyFreeGames(($user->logged_in) ? $user->uid:0);




//pre($user);
// die;

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


        <?php
         include 'homeSlider.php';
         ?>

         <?php
          include 'announcement.php';
          ?>
          <div class="panel panel-flat" style="margin-bottom:5px !important">
            <div class="panel-body" style="padding:5px 30px !important;">
          <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
 								<a href="dailyReward.php"><img src="img/pot_of_gold.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a href="dailyReward.php"  class="btn btn-purple" name="button" style="display: block; width: 100%; height:80px;">
                  <?php if ($user->logged_in): ?>
                    <?php if ($ckdg): ?>
                    <br>Daily Gold Box<br>
                    <?php else: ?>
                      Next Daily <br> GOLD box in <br><b><span class="countdown_time2" id="disp_time_daily" start-time="<?php echo $now;?>" end-time="<?php echo $endday;?>"><?php echo $end;?></span></b>
                    <?php endif; ?>

                  <?php else: ?>
                  <br>  Daily Gold Box<br>
                  <?php endif; ?>
                  <br>
                </a>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
          <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
                <?php

                if($user->logged_in){
                  if ($ckfg){ //klu ada chance
                    ?>
                    <a onclick="verifylogin2('flyingJelly/index.php')" ><img src="img/pot_of_gold.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                    <a onclick="verifylogin2('flyingJelly/index.php')" class="btn btn-purple" name="button" style="display: block; width: 100%; height:80px;">
                      <br>Play It Now ! <label class="label bg-pink-600"><?php echo $ckfg; ?> <i class="fa fa-heart"></i></label><br>
                      <br>
                    </a>
                    <?php
                  }else{ //klu chance dah abeh
                    ?>
                    <a ><img src="img/pot_of_gold.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                    <a class="btn btn-purple" name="button" style="display: block; width: 100%; height:80px;">
                      Free Games <br>in <br><b><span class="countdown_time2" id="disp_time_freegames" start-time="<?php echo $now;?>" end-time="<?php echo $endday;?>"><?php echo $end;?></span></b>
                      <br>
                    </a>
                    <?php
                  }
                }else{ //klu user x login
                  ?>
                  <a onclick="verifylogin2('flyingJelly/index.php')" ><img src="img/pot_of_gold.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                  <a onclick="verifylogin2('flyingJelly/index.php')" class="btn btn-purple" name="button" style="display: block; width: 100%; height:80px;">
                    <br>Free Games<br>
                    <br>
                  </a>
                  <?php
                }

                ?>

 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>



          <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
 								<a href="goldConversion.php"><img src="img/pot_of_gold.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a href="goldConversion.php"  class="btn btn-purple" name="button" style="display: block; width: 100%; height:80px;">
                  <br>PotBoy Gold Conversion<br>
                  <br>
                  </a>
 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>
          <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:2px !important;padding-right:2px !important;">
 						<!-- Horizontal form -->
 						<div class="panel panel-flat" style="margin-bottom:5px !important">
 							<div class="panel-body" style="padding:5px 30px !important;">
                <a onclick="verifylogin2('game2.php')" ><img src="img/pot_of_gold.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a onclick="verifylogin2('game2.php')" class="btn btn-purple" name="button" style="display: block; width: 100%; height:80px;">
                  <br>Play it Now <b id="time">1 Diamond</b><br>
                  <br>
                </a>

 							</div>
 						</div>
 						<!-- /horizotal form -->
 					</div>

      </div>
      </div>


 			</div>
 			<!-- /main content -->

 		</div>
    <script type="text/javascript">
    $('.countdown_time').each(function(index){
      var ids = $(this).attr('id');
      var id = ids.replace('disp_time_','');
      var start = $(this).attr('start-time');
      var end = $(this).attr('end-time');
      var diff = moment(end,"YYYY/MM/DD HH:mm:ss").diff(moment(start,"YYYY/MM/DD HH:mm:ss"));
      var time = $(this).html().trim();
      $('#'+$(this).attr('id')).countdown(time, function(event) {
        // console.log('s');
        $(this).html(event.strftime('%-D days %H:%M:%S'));
      }).on('update.countdown', function() {
        // var val = $('#disppercent_'+id).html().trim();
        var cdiff = new Date() - moment(start,"YYYY/MM/DD HH:mm:ss");
        if(cdiff > 0){
          var percent = Math.floor(( cdiff / diff ) * 100);
          $('#text'+id).html(percent+'%');
          $('#textval'+id).css('width',percent+'%');
        }
      }).on('finish.countdown', function() {
        location.href = 'admin-bidding.php';
      });
    });

    $('.countdown_time2').each(function(index){
      var ids = $(this).attr('id');
      var id = ids.replace('disp_time_','');
      var start = $(this).attr('start-time');
      var end = $(this).attr('end-time');
      var diff = moment(end,"YYYY/MM/DD HH:mm:ss").diff(moment(start,"YYYY/MM/DD HH:mm:ss"));
      var time = $(this).html().trim();
      $('#'+$(this).attr('id')).countdown(time, function(event) {
        // console.log('s');
        $(this).html(event.strftime('%H:%M:%S'));
      }).on('update.countdown', function() {
        // var val = $('#disppercent_'+id).html().trim();
        var cdiff = new Date() - moment(start,"YYYY/MM/DD HH:mm:ss");
        if(cdiff > 0){
          var percent = Math.floor(( cdiff / diff ) * 100);
          $('#text'+id).html(percent+'%');
          $('#textval'+id).css('width',percent+'%');
        }
      }).on('finish.countdown', function() {
        location.href = 'admin-bidding.php';
      });
    });

    function countdown(element, minutes, seconds) {
      // Fetch the display element
      var el = document.getElementById(element);

      // Set the timer
      var interval = setInterval(function() {
          if(seconds == 0) {
              if(minutes == 0) {
                  (el.innerHTML = "STOP!");

                  clearInterval(interval);
                  return;
              } else {
                  minutes--;
                  seconds = 60;
              }
          }

          if(minutes > 0) {
              var minute_text = minutes + (minutes > 1 ? ' minutes' : ' minute');
          } else {
              var minute_text = '';
          }

          var second_text = seconds > 1 ? '' : '';
          el.innerHTML = minute_text + ' ' + seconds + ' ' + second_text + '';
          seconds--;
      }, 1000);
    }

    </script>
  <?php
   include 'fefoot.php';
   ?>
