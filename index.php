<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
?>
<?php
 //include 'fehead.php';
 //include 'feheader.php';
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title><?php echo $pname.WEBNAME;?></title>

 	<!-- Global stylesheets -->
 	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>icons/icomoon/styles.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>bootstrap.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>core.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>components.css" rel="stylesheet" type="text/css">
 	<link href="<?php echo FRONTCSS;?>colors.css" rel="stylesheet" type="text/css">
 	<!-- /global stylesheets -->

 	<!-- Core JS files -->
 	<script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/jquery.min.js"></script>
 	<script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/bootstrap.min.js"></script>
 	<script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/nicescroll.min.js"></script>
 	<script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/drilldown.js"></script>
 	<!-- /core JS files -->

 	<!-- Theme JS files -->
 	<script type="text/javascript" src="<?php echo FRONTJS;?>core/app.js"></script>
 	<!-- /theme JS files -->

 </head>

 <body>
   <div class="col-md-8 col-md-offset-2">

 	<!-- Main navbar -->
  <?php if(!MV){?>
 	<div class="navbar navbar-inverse bg-purple">
 		<div class="navbar-header">
 			<a class="navbar-brand" href="index.php"><img src="<?php echo BACK_IMG; ?>logo.png"></a>


 			<ul class="nav navbar-nav pull-right visible-xs-block">
 				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
 			</ul>
 		</div>

 		<div class="navbar-collapse collapse" id="navbar-mobile">



 			<ul class="nav navbar-nav navbar-right">


        <span class="dy-diamond" style="">


        </span>

        <li class="dropdown dropdown-user">
          <a><div class="left" data-toggle="tooltip" title="Potboy Credit - You can use credit to buy groceries. Buy your Potboy Credit at discounted rate today!"> <img src="http://potboy.com.my/pub/media/customercredit/point.png" style="width:15px"> <span id="credit_navlink">RM 0.00</span></div></a>
        </li>

        <li class="dropdown dropdown-user">
          <a><div class="left" data-toggle="tooltip" title="Potboy Gold - You can further slash prices with Potboy Gold, collect Potboy Gold today!"> <img src="http://potboy.com.my/pub/media/logo/stores/1/gold.png" style="width:16px"> <span id="gold_navlink">0</span></div></a>
        </li>

        <li class="dropdown dropdown-user">
          <a><div class="left" data-toggle="tooltip" title="Potboy Diamond - Earn Diamond with every RM50 purchase, you can convert Potboy Diamond to Potboy Gold!"><img src="http://potboy.com.my/pub/media/logo/stores/1/diamond.png" style="width:16px"> <span id="diamond_navlink">0</span></div></a>
        </li>


          <li class="dropdown dropdown-user">
 						<?php
            if (!$user->logged_in) {
                ?>
                <a href="login.php"><span>Guest</span>
                  <?php
            }
            else {
              ?>
              <a class="dropdown-toggle" data-toggle="dropdown"><span>User</span><i class="caret"></i>
                <?php
            }
            ?>

 					</a>

 					<ul class="dropdown-menu dropdown-menu-right">

 						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
 						<li><a href="#"><i class="icon-coins"></i> My balance</a></li>
 						<li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
 						<li class="divider"></li>
 						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
 						<li><a href="#"><i class="icon-switch2"></i> Logout</a></li>

 					</ul>
 				</li>
 			</ul>
 		</div>
 	</div>
 	<!-- /main navbar -->



 	<!-- Second navbar -->
 	<div class="navbar navbar-default" id="navbar-second">
 		<ul class="nav navbar-nav no-border visible-xs-block">
 			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
 		</ul>

 		<div class="navbar-collapse collapse" id="navbar-second-toggle">
 			<ul class="nav navbar-nav">
 				<li><a href="index.php"><i class="icon-display4 position-left"></i> Dashboard</a></li>
        <li><a href="index.php"><i class="icon-display4 position-left"></i> Bidding</a></li>
        <li><a href="index.php"><i class="icon-display4 position-left"></i> Latest Winners</a></li>
        <li><a href="index.php"><i class="icon-display4 position-left"></i> Wishlist Voting</a></li>
        <?php
        if (!$user->logged_in) {
            ?>
            <li><a href="login.php"><i class="icon-display4 position-left"></i> Login</a></li>
              <?php
        }
        else {
          ?>
          <li><a href="index.php"><i class="icon-display4 position-left"></i> My Account</a></li>
            <?php
        }
        ?>

 			</ul>
 		</div>
 	</div>
 	<!-- /second navbar -->
<?php }?>

 	<!-- Page header -->
 	<div class="page-header">
 		<div class="page-header-content">
 			<br>


 		</div>
 	</div>
 	<!-- /page header -->


 	<!-- Page container -->
 	<div class="page-container">

 		<!-- Page content -->
 		<div class="page-content">

 			<!-- Main content -->
 			<div class="content-wrapper">

 				<!-- Simple panel -->
 				<div class="panel panel-flat">
 					<div class="panel-heading">
 						<h5 class="panel-title">Simple panel</h5>
 						<div class="heading-elements">
 							<ul class="icons-list">
 		                		<li><a data-action="collapse"></a></li>
 		                		<li><a data-action="close"></a></li>
 		                	</ul>
 	                	</div>
 					</div>

 					<div class="panel-body">
 						<h6 class="text-semibold">Start your development with no hassle!</h6>
 						<p class="content-group">Common problem of templates is that all code is deeply integrated into the core. This limits your freedom in decreasing amount of code, i.e. it becomes pretty difficult to remove unnecessary code from the project. Limitless allows you to remove unnecessary and extra code easily just by removing the path to specific LESS file with component styling. All plugins and their options are also in separate files. Use only components you actually need!</p>

 						<h6 class="text-semibold">What is this?</h6>
 						<p class="content-group">Starter kit is a set of pages, useful for developers to start development process from scratch. Each layout includes base components only: layout, page kits, color system which is still optional, bootstrap files and bootstrap overrides. No extra CSS/JS files and markup. CSS files are compiled without any plugins or components. Starter kit was moved to a separate folder for better accessibility.</p>

 						<h6 class="text-semibold">How does it work?</h6>
 						<p>You open one of the starter pages, add necessary plugins, uncomment paths to files in components.less file, compile new CSS. That's it. I'd also recommend to open one of main pages with functionality you need and copy all paths/JS code from there to your new page, it's just faster and easier.</p>
 					</div>
 				</div>
 				<!-- /simple panel -->


 				<!-- Table -->
 				<div class="panel panel-flat">
 					<div class="panel-heading">
 						<h5 class="panel-title">Basic table</h5>
 						<div class="heading-elements">
 							<ul class="icons-list">
 		                		<li><a data-action="collapse"></a></li>
 		                		<li><a data-action="close"></a></li>
 		                	</ul>
 	                	</div>
                 	</div>

                 	<div class="panel-body">
                 		Starter pages include the most basic components that may help you start your development process - basic grid example, panel, table and form layouts with standard components. Nothing extra.
                 	</div>

 					<div class="table-responsive">
 						<table class="table">
 							<thead>
 								<tr>
 									<th>#</th>
 									<th>First Name</th>
 									<th>Last Name</th>
 									<th>Username</th>
 								</tr>
 							</thead>
 							<tbody>
 								<tr>
 									<td>1</td>
 									<td>Eugene</td>
 									<td>Kopyov</td>
 									<td>@Kopyov</td>
 								</tr>
 								<tr>
 									<td>2</td>
 									<td>Victoria</td>
 									<td>Baker</td>
 									<td>@Vicky</td>
 								</tr>
 								<tr>
 									<td>3</td>
 									<td>James</td>
 									<td>Alexander</td>
 									<td>@Alex</td>
 								</tr>
 								<tr>
 									<td>4</td>
 									<td>Franklin</td>
 									<td>Morrison</td>
 									<td>@Frank</td>
 								</tr>
 							</tbody>
 						</table>
 					</div>
 				</div>
 				<!-- /table -->


 				<!-- Grid -->
 				<div class="row">
 					<div class="col-md-6">

 						<!-- Horizontal form -->
 						<div class="panel panel-flat">
 							<div class="panel-heading">
 								<h5 class="panel-title">Horizontal form</h5>
 								<div class="heading-elements">
 									<ul class="icons-list">
 				                		<li><a data-action="collapse"></a></li>
 				                		<li><a data-action="close"></a></li>
 				                	</ul>
 			                	</div>
 		                	</div>

 							<div class="panel-body">
 								<form class="form-horizontal" action="#">
 									<div class="form-group">
 										<label class="control-label col-lg-2">Text input</label>
 										<div class="col-lg-10">
 											<input type="text" class="form-control">
 										</div>
 									</div>

 									<div class="form-group">
 										<label class="control-label col-lg-2">Password</label>
 										<div class="col-lg-10">
 											<input type="password" class="form-control">
 										</div>
 									</div>

 			                        <div class="form-group">
 			                        	<label class="control-label col-lg-2">Select</label>
 			                        	<div class="col-lg-10">
 				                            <select name="select" class="form-control">
 				                                <option value="opt1">Basic select</option>
 				                                <option value="opt2">Option 2</option>
 				                                <option value="opt3">Option 3</option>
 				                                <option value="opt4">Option 4</option>
 				                                <option value="opt5">Option 5</option>
 				                                <option value="opt6">Option 6</option>
 				                                <option value="opt7">Option 7</option>
 				                                <option value="opt8">Option 8</option>
 				                            </select>
 			                            </div>
 			                        </div>

 									<div class="form-group">
 										<label class="control-label col-lg-2">Textarea</label>
 										<div class="col-lg-10">
 											<textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"></textarea>
 										</div>
 									</div>

 									<div class="text-right">
 										<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
 									</div>
 								</form>
 							</div>
 						</div>
 						<!-- /horizotal form -->

 					</div>

 					<div class="col-md-6">

 						<!-- Vertical form -->
 						<div class="panel panel-flat">
 							<div class="panel-heading">
 								<h5 class="panel-title">Vertical form</h5>
 								<div class="heading-elements">
 									<ul class="icons-list">
 				                		<li><a data-action="collapse"></a></li>
 				                		<li><a data-action="close"></a></li>
 				                	</ul>
 			                	</div>
 		                	</div>

 							<div class="panel-body">
 								<form action="#">
 									<div class="form-group">
 										<label>Text input</label>
 										<input type="text" class="form-control">
 									</div>

 			                        <div class="form-group">
 			                        	<label>Select</label>
 			                            <select name="select" class="form-control">
 			                                <option value="opt1">Basic select</option>
 			                                <option value="opt2">Option 2</option>
 			                                <option value="opt3">Option 3</option>
 			                                <option value="opt4">Option 4</option>
 			                                <option value="opt5">Option 5</option>
 			                                <option value="opt6">Option 6</option>
 			                                <option value="opt7">Option 7</option>
 			                                <option value="opt8">Option 8</option>
 			                            </select>
 			                        </div>

 									<div class="form-group">
 										<label>Textarea</label>
 										<textarea rows="4" cols="4" class="form-control" placeholder="Default textarea"></textarea>
 									</div>

 									<div class="text-right">
 										<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
 									</div>
 								</form>
 							</div>
 						</div>
 						<!-- /vertical form -->

 					</div>
 				</div>
 				<!-- /grid -->

 			</div>
 			<!-- /main content -->

 		</div>
 		<!-- /page content -->

 	</div>
 	<!-- /page container -->

<?php if(!MV){?>
 	<!-- Footer -->
 	<div class="footer text-muted">
    ©Copyright <?php echo date('Y');?> by  <a href="<?php echo HOMEURL;?>">PB Grocery Group Sdn. Bhd. (1209976-H)</a>. All Rights Reserved.
 	</div>
 	<!-- /footer -->
  <?php }?>
  </div>
 </body>
 </html>
