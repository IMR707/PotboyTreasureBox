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
$ckpg=$user->checkPaidGames(($user->logged_in) ? $user->uid:0);



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
                <a href="dailyReward.php"  class="btn bg-purple-400 bg-gradient disp-table" name="button" style="width: 100%; height:60px;padding:0px;">
                  <?php if ($user->logged_in): ?>
                    <?php if ($ckdg): ?>
                    <span class="disp-tablecell" style="font-size:15px;"><b>Daily Gold</b> Box</span>
                    <?php else: ?>
                      <span class="disp-tablecell" style="font-size:15px;">
                        Next Daily GOLD box <br>in <b><span class="countdown_time2" id="disp_time_daily" start-time="<?php echo $now;?>" end-time="<?php echo $endday;?>"><?php echo $end;?></span></b>
                      </span>
                    <?php endif; ?>

                  <?php else: ?>
                  <span class="disp-tablecell" style="font-size:15px;"><b>Daily Gold</b> Box</span>
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
                    <a onclick="verifylogin2('flyingJelly/index.php')" ><img src="img/flyingJelly.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                    <a onclick="verifylogin2('flyingJelly/index.php')" class="btn bg-purple-400 bg-gradient disp-table" name="button" style="width: 100%; height:60px;">
                      <span class="disp-tablecell" style="font-size:15px;">Play It Now ! <label class="label bg-pink-600"><?php echo $ckfg; ?> <i class="fa fa-heart"></i></label></span>
                    </a>
                    <?php
                  }else{ //klu chance dah abeh
                    ?>
                    <a ><img src="img/flyingJelly.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                    <a class="btn bg-purple-400 bg-gradient disp-table" name="button" style="width: 100%; height:60px;padding:0px;">
                      <span class="disp-tablecell" style="font-size:15px;">Free Games <br>in <b><span class="countdown_time2" id="disp_time_freegames" start-time="<?php echo $now;?>" end-time="<?php echo $endday;?>"><?php echo $end;?></span></span>
                    </a>
                    <?php
                  }
                }else{ //klu user x login
                  ?>
                  <a onclick="verifylogin2('flyingJelly/index.php')" ><img src="img/flyingJelly.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                  <a onclick="verifylogin2('flyingJelly/index.php')" class="btn bg-purple-400 bg-gradient disp-table" name="button" style="width: 100%; height:60px;">
                    <span class="disp-tablecell" style="font-size:15px;">Free Games</span>
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
                <a href="goldConversion.php"  class="btn bg-purple-400 bg-gradient disp-table" name="button" style="width: 100%; height:60px;padding:0px">
                  <span class="disp-tablecell" style="font-size:15px">Convert <b>Diamond</b> <br>to <b>Gold</b></span>
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

                if($ckpg){

                ?>
                <a onclick="verifylogin2('skyKnight/index.php')" ><img src="img/skyKnight.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a onclick="verifylogin2('skyKnight/index.php')" class="btn bg-purple-400 bg-gradient disp-table" name="button" style="width: 100%; height:60px;padding:0px">
                  <span class="disp-tablecell" style="font-size:15px;">Play it Now <br><b id="time">1 Diamond</b></span>
                </a>
                <?php
                }else{
                ?>
                <a ><img src="img/skyKnight.png" style="" data-title="doge" data-content="Hey there!" class="img-responsive"></a>
                <a class="btn bg-purple-400 bg-gradient disp-table" name="button" style="width: 100%; height:60px;padding:0px">
                  <span class="disp-tablecell" style="font-size:15px;">Play it Now <br><b id="time">1 Diamond</b></span>
                </a>
                <?php
                }

                ?>

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
