<?php
define('_VALID_PHP', true);
$pname = 'Bidding View';
$menu = 'Bidding View';
$pagemenu="BID";
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

        <div class="panel panel-flat mb-5">
          <div class="panel-body">


            <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                <img src="<?php echo BACK_UPLOADS; ?>banner.png" class="img-responsive" style="margin:0 auto;width:100%" >
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12 text-center">
              <div class="col-sm-12 col-md-12 col-xs-12 text-center pt-20 pb-20 bg-purple-300">
                <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                  <div class="progress">
                      <div class="progress-bar bg-purple" id="textval1_100" style="width: 42%">
                        <span id="text1_100">42%</span>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-xs-12 pt-10">
                  <div class="col-sm-6 col-md-6 col-xs-6 text-left">
                    538 users had joined
                  </div>
                  <div class="col-sm-6 col-md-6 col-xs-6 text-right">
                    662 participants needed
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12">
              <div class="col-sm-12 col-md-12 col-xs-12 pt-20">
                <label class="label bg-orange-300 text-grey-800 title-custom">
                  Participant Bid
                </label>
                <i>Winner will be announced once the target participant is reached !</i>
              </div>
              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                <span class="title-custom">iPhone 7, Red, 128GB, 4G LTE</span>
                <hr>
              </div>
              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                <span class="font-17">You haven’t join this bid !</span>
                <br>
                minimum bid – 10000 POTBOY Gold
              </div>

            </div>
          </div>
        </div>

        <div class="panel panel-flat mb-5">
          <div class="panel-body">
            <a class="text-unstyled" href="" data-toggle="modal" data-target="#modal_default">
              <div class="col-sm-12 col-md-12 col-xs-12">
                <div class="col-sm-10 col-md-10 col-xs-10 text-left title-custom">
                  Check out product specifications & details
                </div>
                <div class="col-sm-2 col-md-2 col-xs-2 text-right title-custom">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div class="panel panel-flat mb-5">
          <div class="panel-body">
            <a class="text-unstyled" href="latestwinner.php">
              <div class="col-sm-12 col-md-12 col-xs-12">
                <div class="col-sm-10 col-md-10 col-xs-10 text-left title-custom">
                  Latest Winner Announcement
                </div>
                <div class="col-sm-2 col-md-2 col-xs-2 text-right title-custom">
                  <i class="fa fa-chevron-right"></i>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div id="modal_default" class="modal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h5 class="modal-title">Item Description</h5>
							</div>

							<div class="modal-body">
								description
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>


 			</div>
 			<!-- /main content -->

 		</div>

<script type="text/javascript">


</script>
  <?php
   include 'fefoot.php';
   ?>
