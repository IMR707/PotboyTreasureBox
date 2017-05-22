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



          <?php

          pre($user);
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









          <br>ACCOUNT INFORMATION
          <br>Address Book
          <br>Potboy Rewards
          <br>Recent Potboy Diamonds Transactions
          <br>Recent Potboy Golds Transactions
          </div>



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
