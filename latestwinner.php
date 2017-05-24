<?php
define('_VALID_PHP', true);
$pname = 'Latest Winner';
$menu = 'Latest Winner';
$pagemenu="LATESTWINNER";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

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

        <div class="panel panel-flat mb-10">
          <div class="panel-body">
            <div class="tabbable">
    					<ul class="nav nav-tabs nav-tabs-bottom">
    						<li class=""><a href="#bottom-tab1" data-toggle="tab" aria-expanded="true">To be Announced</a></li>
    						<li class="active"><a href="#bottom-tab2" data-toggle="tab" aria-expanded="false">Announced</a></li>
    					</ul>
    				</div>
          </div>
        </div>

        <div class="tab-content">
          <div class="tab-pane fade" id="bottom-tab1">

          	<div class="panel panel-flat mb-10">
							<div class="panel-body">
								<div class="col-md-12">

                  <div class="timeline-content">
    								<div class="panel border-left-lg border-left-primary">
    									<div class="panel-body">
    										<div class="row">
    											<div class="col-md-4 col-xs-12 col-sm-4">
    												<img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive" >
    											</div>

    											<div class="col-md-8 col-xs-12 col-sm-8 mt-10 ">

                              <span class="title-custom">iPhone 7 (Red)</span>
                              <br>
                              Highest Bids :
                              <table>
                                <tr>
                                  <td class="pr-10">1st</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD (WINNER)</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">2nd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">3rd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                              </table>
    											</div>
    										</div>
    									</div>
    								</div>

                    <div class="panel border-left-lg border-left-primary">
    									<div class="panel-body">
    										<div class="row">
    											<div class="col-md-4 col-xs-12 col-sm-4">
    												<img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive" >
    											</div>

    											<div class="col-md-8 col-xs-12 col-sm-8 mt-10 ">

                              <span class="title-custom">iPhone 7 (Red)</span>
                              <br>
                              Highest Bids :
                              <table>
                                <tr>
                                  <td class="pr-10">1st</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD (WINNER)</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">2nd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">3rd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                              </table>
    											</div>
    										</div>
    									</div>
    								</div>
                    <div class="panel border-left-lg border-left-primary">
    									<div class="panel-body">
    										<div class="row">
    											<div class="col-md-4 col-xs-12 col-sm-4">
    												<img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive" >
    											</div>

    											<div class="col-md-8 col-xs-12 col-sm-8 mt-10 ">

                              <span class="title-custom">iPhone 7 (Red)</span>
                              <br>
                              Highest Bids :
                              <table>
                                <tr>
                                  <td class="pr-10">1st</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD (WINNER)</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">2nd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">3rd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                              </table>
    											</div>
    										</div>
    									</div>
    								</div>


    							</div>
                </div>
							</div>
						</div>


          </div>

          <div class="tab-pane fade active in" id="bottom-tab2">

          	<div class="panel panel-flat mb-10">
							<div class="panel-body">
								<div class="col-md-12">

                  <div class="timeline-content">
    								<div class="panel border-left-lg border-left-primary">
    									<div class="panel-body">
    										<div class="row">
    											<div class="col-md-4 col-xs-12 col-sm-4">
    												<img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive" >
    											</div>

    											<div class="col-md-8 col-xs-12 col-sm-8 mt-10 ">

                              <span class="title-custom">iPhone 7 (Red)</span>
                              <br>
                              Highest Bids :
                              <table>
                                <tr>
                                  <td class="pr-10">1st</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD (WINNER)</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">2nd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">3rd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                              </table>
    											</div>
    										</div>
    									</div>
    								</div>

                    <div class="panel border-left-lg border-left-primary">
    									<div class="panel-body">
    										<div class="row">
    											<div class="col-md-4 col-xs-12 col-sm-4">
    												<img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive" >
    											</div>

    											<div class="col-md-8 col-xs-12 col-sm-8 mt-10 ">

                              <span class="title-custom">iPhone 7 (Red)</span>
                              <br>
                              Highest Bids :
                              <table>
                                <tr>
                                  <td class="pr-10">1st</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD (WINNER)</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">2nd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">3rd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                              </table>
    											</div>
    										</div>
    									</div>
    								</div>
                    <div class="panel border-left-lg border-left-primary">
    									<div class="panel-body">
    										<div class="row">
    											<div class="col-md-4 col-xs-12 col-sm-4">
    												<img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive" >
    											</div>

    											<div class="col-md-8 col-xs-12 col-sm-8 mt-10 ">

                              <span class="title-custom">iPhone 7 (Red)</span>
                              <br>
                              Highest Bids :
                              <table>
                                <tr>
                                  <td class="pr-10">1st</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD (WINNER)</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">2nd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                                <tr>
                                  <td class="pr-10">3rd</td>
                                  <td class="pr-10">012-28XXX32</td>
                                  <td class="pr-10">26780 GOLD</td>
                                </tr>
                              </table>
    											</div>
    										</div>
    									</div>
    								</div>


    							</div>
                </div>
							</div>
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
