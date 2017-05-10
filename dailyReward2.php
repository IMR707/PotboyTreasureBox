<?php
define('_VALID_PHP', true);
$pname = 'Daily Gold';
$menu = 'dailyGold';
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

 	<!-- Page container -->
 	<div class="page-container bg-white">
 		<!-- Page content -->
 		<div class="page-content">
 			<!-- Main content -->
 			<div class="content-wrapper">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
              <div class="panel-heading" style="padding:10px 10px;">
                <div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
              </div>
              <div class="container-fluid">
                <div class="row text-center">
                  <div class="col-md-10 col-md-offset-1 reward-area">
                    <div class="text-center each-reward">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>

                  </div>
                  <div class="col-md-12">
                    <div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
							<div class="panel-heading" style="padding:10px 10px;">
								<div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
							</div>
							<div class="container-fluid">
								<div class="row text-center">
									<div class="col-md-10 col-md-offset-1 reward-area">
										<div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>
                    <div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                      <div class="daily-gold-text">200</div>
                    </div>
									</div>
									<div class="col-md-12">
										<div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
									</div>
								</div>
							</div>
				    </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
							<div class="panel-heading" style="padding:10px 10px;">
								<div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
							</div>
							<div class="container-fluid">
								<div class="row text-center">
									<div class="col-md-10 col-md-offset-1 reward-area">
										<div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>
                    <div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                      <div class="daily-gold-text">200</div>
                    </div>
									</div>
									<div class="col-md-12">
										<div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
									</div>
								</div>
							</div>
				    </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
							<div class="panel-heading" style="padding:10px 10px;">
								<div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
							</div>
							<div class="container-fluid">
								<div class="row text-center">
									<div class="col-md-10 col-md-offset-1 reward-area">
										<div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>
                    <div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                      <div class="daily-gold-text">200</div>
                    </div>
									</div>
									<div class="col-md-12">
										<div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
									</div>
								</div>
							</div>
				    </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
							<div class="panel-heading" style="padding:10px 10px;">
								<div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
							</div>
							<div class="container-fluid">
								<div class="row text-center">
									<div class="col-md-10 col-md-offset-1 reward-area">
										<div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>
                    <div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                      <div class="daily-gold-text">200</div>
                    </div>
									</div>
									<div class="col-md-12">
										<div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
									</div>
								</div>
							</div>
				    </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
							<div class="panel-heading" style="padding:10px 10px;">
								<div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
							</div>
							<div class="container-fluid">
								<div class="row text-center">
									<div class="col-md-10 col-md-offset-1 reward-area">
										<div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>
                    <div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                      <div class="daily-gold-text">200</div>
                    </div>
									</div>
									<div class="col-md-12">
										<div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
									</div>
								</div>
							</div>
				    </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
							<div class="panel-heading" style="padding:10px 10px;">
								<div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
							</div>
							<div class="container-fluid">
								<div class="row text-center">
									<div class="col-md-10 col-md-offset-1 reward-area">
										<div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>
                    <div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                      <div class="daily-gold-text">200</div>
                    </div>
									</div>
									<div class="col-md-12">
										<div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
									</div>
								</div>
							</div>
				    </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="panel panel-flat">
							<div class="panel-heading" style="padding:10px 10px;">
								<div class="text-center daily-title bg-yellow-gold img-rounded">Day 1</div>
							</div>
							<div class="container-fluid">
								<div class="row text-center">
									<div class="col-md-10 col-md-offset-1 reward-area">
										<div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                      <div class="daily-gold-text">100</div>
                    </div>
                    <div class="text-center">
                      <img class="gold-coin" src="<?php echo FRONTIMAGE;?>slot_machine.png" >
                      <div class="daily-gold-text">200</div>
                    </div>
									</div>
									<div class="col-md-12">
										<div class="text-center "><span class="img-rounded daily-gold-claim">Claim Now</span></div>
                    <br>
									</div>
								</div>
							</div>
				    </div>
          </div> 




        </div>

 			</div>
 			<!-- /main content -->

 		</div>
 		<!-- /page content -->
  </div>

 	<!-- /page container -->

<?php if (!MV) {
     ?>
 	<!-- Footer -->
  <br>
 	<div class="footer text-muted">
    <center>©Copyright <?php echo date('Y'); ?> by  <a href="<?php echo HOMEURL; ?>">PB Grocery Group Sdn. Bhd. (1209976-H)</a>. All Rights Reserved.</center>
 	</div>
 	<!-- /footer -->
  <?php
 }?>
  </div>
 </body>
 </html>
