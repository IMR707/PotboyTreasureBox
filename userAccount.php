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

$diamond_trans = $fz->getUserDiamondTrans($user->uid);
$gold_trans = $fz->getUserGoldTrans($user->uid);

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
          <div class="tabbable">
						<ul class="nav nav-tabs nav-tabs-bottom">
							<li class="active"><a href="#right-icon-tab1" data-toggle="tab" aria-expanded="false">Diamond Transaction <i class="icon-diamond position-right"></i></a></li>
							<li class=""><a href="#right-icon-tab2" data-toggle="tab" aria-expanded="false">Gold Transaction <i class="icon-radio-unchecked position-right"></i></a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="right-icon-tab1">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th width="15%">
                                <i class="fa fa-briefcase"></i> Date
                            </th>
                            <th width="55%">
                                <i class="fa fa-question"></i> Type
                            </th>
                            <th>
                                <i class="fa fa-usd"></i> Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php

                      foreach($diamond_trans as $key => $row){

                      ?>
                        <tr>
                            <td> <?php echo date("d/m/y \n h:ia",strtotime($row->created_at)); ?> </td>
                            <td> <?php echo $row->title.'<br>( '.$row->desc.' )'; ?> </td>
                            <td> <span class="<?php echo $row->amount < 0 ? 'text-danger' : 'text-success'; ?>"><?php echo $row->amount; ?> Diamond </span> </td>
                        </tr>
                      <?php
                      }

                      ?>
                    </tbody>
                </table>
							</div>

							<div class="tab-pane" id="right-icon-tab2">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th width="15%">
                                <i class="fa fa-briefcase"></i> Date
                            </th>
                            <th width="55%">
                                <i class="fa fa-question"></i> Type
                            </th>
                            <th>
                                <i class="fa fa-usd"></i> Amount
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php

                      foreach($gold_trans as $key => $row){

                      ?>
                        <tr>
                            <td> <?php echo date("d/m/y \n h:ia",strtotime($row->created_at)); ?> </td>
                            <td> <?php echo $row->title.'<br>( '.$row->desc.' )'; ?> </td>
                            <td> <span class="<?php echo $row->amount < 0 ? 'text-danger' : 'text-success'; ?>"><?php echo $row->amount_gold; ?> Gold </span> </td>
                        </tr>
                      <?php
                      }

                      ?>
                    </tbody>
                </table>
							</div>

						</div>
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
