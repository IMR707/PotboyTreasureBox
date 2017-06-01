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
// pre($endsoonbid);
// die;
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


        <?php
         include 'homeSlider.php';
         ?>

         <?php
          include 'announcement.php';
          ?>


          <div class="panel panel-flat mb-5">
            <div class="panel-body">


              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <a href="instantclaim.php" class="text-default"><img src="<?php echo UPLOADURL;?>a4.svg" class="imgsmall" alt="" style="max-width:100px">
                  <br><b>Instant Claim</b>
                  </a>
              </div>
              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <a href="instantclaim.php"  class="text-default"><img src="<?php echo UPLOADURL;?>a2.svg" class="imgsmall" alt="" style="max-width:100px">
                  <br><b>Coming Up Soon</b>
                  </a>
              </div>
              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <a href="instantclaim.php"  class="text-default"><img src="<?php echo UPLOADURL;?>a4.svg" class="imgsmall" alt="" style="max-width:100px">
                  <br><b>Winner Sharing</b>
                  </a>
              </div>

              <div class="col-sm-3 col-md-3 col-xs-3 text-center">
                  <a href="instantclaim.php"  class="text-default"><img src="<?php echo UPLOADURL;?>a2.svg" class="imgsmall" alt="" style="max-width:100px">
                  <br><b>Rules T&C</b>
                  </a>
              </div>
            </div>
          </div>

          	<div class="panel panel-flat">
							<div class="panel-body" style="padding:0px;">
								<div class="tabbable">
									<!-- <ul class="nav nav-tabs nav-tabs-solid nav-tabs-component nav-justified" style="margin-bottom:10px;">
										<li class="active"><a href="#solid-rounded-justified-tab1" data-toggle="tab"><i class="fa fa-fire"></i> Hot</a></li>
										<li><a href="#solid-rounded-justified-tab2" data-toggle="tab">Ongoing</a></li>
                    <li><a href="#solid-rounded-justified-tab3" data-toggle="tab">New</a></li>
                    <li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Prize <span class="caret"></span></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#solid-rounded-justified-tab4" data-toggle="tab">High to Low</a></li>
												<li><a href="#solid-rounded-justified-tab5" data-toggle="tab">Low to High</a></li>
											</ul>
										</li>
									</ul> -->
                  <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
                              Sort <span class="glyphicon glyphicon-sort"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="example-nav-collapse">
                            <ul class="nav navbar-nav navbar-right col-md-12 col-sm-12">
                                <li class="active col-md-3 col-sm-3 text-center"><a href="#solid-rounded-justified-tab1" data-toggle="tab"><span class="glyphicon glyphicon-fire"></span> Hot</a></li>
                                <li class="col-md-3 col-sm-3 text-center"><a href="#solid-rounded-justified-tab2" data-toggle="tab"><span class="glyphicon glyphicon-time"></span> Ending Soon</a></li>
                                <li class="col-md-3 col-sm-3 text-center"><a href="#solid-rounded-justified-tab3" data-toggle="tab"><span class="glyphicon glyphicon-ok"></span> New</a></li>
                                <li class="dropdown col-md-3 col-sm-3 text-center">
            											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-gift"></span> Prize <span class="caret"></span></a>
            											<ul class="dropdown-menu dropdown-menu-right">
            												<li><a href="#solid-rounded-justified-tab4" data-toggle="tab">High to Low</a></li>
            												<li><a href="#solid-rounded-justified-tab5" data-toggle="tab">Low to High</a></li>
            											</ul>
            										</li>
                            </ul>
                        </div>
                    </div>
                </nav>

									<div class="tab-content">
										<div class="tab-pane active" id="solid-rounded-justified-tab1">
                      <?php if(!$topbid){
                        ?>
                        <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                          <div class="panel panel-flat timeline-content">
                            <div class="panel-body">
                              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                                No Bidding for now
                        </div>
                        </div>
                        </div>
                        </div><?php

                      }?>
                      <?php foreach ($topbid as $key => $value){
                        $list->FEgetBiddingUI($value);
                      }?>
                      </div>




										<div class="tab-pane" id="solid-rounded-justified-tab2">
                      <?php if(!$endsoonbid){
                        ?>
                        <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                          <div class="panel panel-flat timeline-content">
                            <div class="panel-body">
                              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                                No Bidding for now
                        </div>
                        </div>
                        </div>
                        </div><?php

                      }?>
                      <?php foreach ($endsoonbid as $key => $value){
                        $list->FEgetBiddingUI($value);
                      }?>
										</div>

										<div class="tab-pane" id="solid-rounded-justified-tab3">
                      <?php if(!$newbid){
                        ?>
                        <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                          <div class="panel panel-flat timeline-content">
                            <div class="panel-body">
                              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                                No Bidding for now
                        </div>
                        </div>
                        </div>
                        </div><?php

                      }?>
                      <?php foreach ($newbid as $key => $value){
                        $list->FEgetBiddingUI($value);
                      }?>
										</div>

                    <div class="tab-pane" id="solid-rounded-justified-tab4">
                      <?php if(!$pdbid){
                        ?>
                        <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                          <div class="panel panel-flat timeline-content">
                            <div class="panel-body">
                              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                                No Bidding for now
                        </div>
                        </div>
                        </div>
                        </div><?php

                      }?>
                      <?php foreach ($pdbid as $key => $value){
                        $list->FEgetBiddingUI($value);
                      }?>
										</div>
                    <div class="tab-pane" id="solid-rounded-justified-tab5">
                      <?php if(!$pubid){
                        ?>
                        <div class="col-sm-6 col-md-6 col-xs-6 text-center">
                          <div class="panel panel-flat timeline-content">
                            <div class="panel-body">
                              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                                No Bidding for now
                        </div>
                        </div>
                        </div>
                        </div><?php
                      }?>
                      <?php foreach ($pubid as $key => $value){
                        $list->FEgetBiddingUI($value);
                      }?>
										</div>
									</div>
								</div>
							</div>
						</div>
 			</div>
      <div id="modal_bid" class="modal fade in">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h5 class="modal-title">Enter your bid amount !</h5>
							</div>

							<div class="modal-body">

							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>
 			<!-- /main content -->

 		</div>

<script type="text/javascript">

$(document).ready(function(){

  $('.joinBid').on('click',function(){
    var id = $(this).attr('id');

    var dataString = "id="+id+"&func=getBidProductByID";
    $.ajax({
      type    : "POST",
      url     : "backend/process.php",
      data    : dataString,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        console.log(data);

      }
    });

    $('#modal_bid').modal('show');


  });

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

});



</script>
  <?php
   include 'fefoot.php';
   ?>
