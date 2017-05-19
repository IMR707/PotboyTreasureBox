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

          	<div class="panel panel-flat">
              <div class="panel-heading">
                <h4 class="panel-title">July Voting Top Ranking</h4>
              </div>
							<div class="panel-body">
								<div class="col-md-12">
                  <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-gold">
                    <div class="top_ranking_number_disp">
                      1
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                    <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" >
                    <div class="top_ranking_vote">100,123 votes</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-silver">
                    <div class="top_ranking_number_disp">
                      2
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                    <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" >
                    <div class="top_ranking_vote">100,123 votes</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-bronze">
                    <div class="top_ranking_number_disp">
                      3
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                    <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" >
                    <div class="top_ranking_vote">100,123 votes</div>
                  </div>
                </div>
							</div>
						</div>

            <div class="panel panel-flat">
              <div class="panel-heading">
                <h4 class="panel-title">VOTE NOW for next month prize !</h4>
              </div>
							<div class="panel-body">
                <?php

                for($i=0;$i<8;$i++){

                ?>
								<div class="col-md-3 vote_box">
                  <img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive" >
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
    var val = $('#disppercent_'+id).html().trim();
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
