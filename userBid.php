<?php
define('_VALID_PHP', true);
$pname = 'My Account';
$menu = 'dailyGold';
$pagemenu = 'UACC';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

$AllDailyReward = [];

if (!$user->logged_in) {
    redirect_to(SITEURL.'/index.php');
}

$bid_details = $fz->getUserBid($user->uid);

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
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title"><b><?php echo $user->name; ?></b></h5>
							</div>

							<div class="list-group no-border no-padding-top">
                <span class="list-group-item"><i class="icon-envelop3"></i> <?php echo $user->email; ?></span>
                <span class="list-group-item"><i class="icon-diamond text-info"></i> <?php echo $user->diamond; ?></span>
                <span class="list-group-item"><i class="icon-radio-unchecked text-gold"></i> <?php echo $user->gold; ?></span>
							</div>
						</div>

            <div class="panel panel-flat">
							<div class="list-group no-border no-padding-top">
								<a href="userAccount.php" class="list-group-item"><i class="icon-cash3"></i> My Transaction</a>
                <a href="userBid.php" class="list-group-item active"><i class="icon-hammer"></i> My Bid</a>
                <a href="userClaim.php" class="list-group-item"><i class="icon-cash3"></i> My Instant Claim</a>
								<!-- <a href="#" class="list-group-item"><i class="icon-cash3"></i> Balance</a>
								<a href="#" class="list-group-item"><i class="icon-tree7"></i> Connections <span class="badge bg-danger pull-right">29</span></a>
								<a href="#" class="list-group-item"><i class="icon-users"></i> Friends</a> -->
							</div>
						</div>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
          <?php
          // pre($user);
          switch ($user->useraccess) {
            case '0':
              ?>
              <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
              <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
              <h6 class="alert-heading text-semibold">Not Logged in</h6>
              <a onclick="verifylink('userAccount.php')" >Click here to Login to your Account</a>
              </div>
              <?php
            break;

            case '1':
              ?>
              <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
              <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
              <h6 class="alert-heading text-semibold">Mobile Number And Address not Available</h6>
              <a onclick="verifylink('userAccount.php')" >Click here to Fill the Infomation</a>
              </div>
              <?php
            break;

            case '2':
              ?>
              <div class="alert alert-info alert-styled-left alert-arrow-left alert-component">
              <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
              <h6 class="alert-heading text-semibold">Your Mobile Number is not Verified.</h6>
              <a onclick="verifylink('userAccount.php')" >Click here to Verify your Account;</a>
              </div>
              <?php
            break;
          }
          ?>

          <!-- <br>ACCOUNT INFORMATION
       <br>Address Book -->

          <table class="table table-striped table-bordered table-advance table-hover datatable-basic">
              <thead>
                  <tr>
                      <th width="20%">
                          <i class="fa fa-calendar"></i> Date
                      </th>
                      <th width="35%">
                          <i class="fa fa-question"></i> Item Name
                      </th>
                      <th>
                          <i class="fa fa-usd"></i> Amount
                      </th>
                      <th>
                          Status
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php
                // pre($bid_details);
                foreach($bid_details as $key => $row){

                ?>
                  <tr>
                      <td> <?php echo date("d/m/y \n h:ia",strtotime($row->date_created)); ?> </td>
                      <td> <?php echo $row->name; ?> </td>
                      <td> <span class=""><?php echo $row->bid_type == 1 ? $row->bid_amount.' Gold' : $row->bid_amount.' Diamond'; ?></span> </td>
                      <td> </td>
                  </tr>
                <?php
                }

                ?>
              </tbody>
          </table>

 			</div>
 			<!-- /main content -->

 		</div>
    <div class="clearfix"></div>
 		<!-- /page content -->
    <?php
     include 'fefoot.php';
     ?>
  </div>
 </body>
 </html>
