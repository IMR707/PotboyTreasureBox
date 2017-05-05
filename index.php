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
 	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

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
 	<div class="navbar navbar-inverse bg-indigo">
 		<div class="navbar-header">
 			<a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

 			<ul class="nav navbar-nav pull-right visible-xs-block">
 				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
 			</ul>
 		</div>

 		<div class="navbar-collapse collapse" id="navbar-mobile">
 			<ul class="nav navbar-nav">
 				<li><a href="#">Text link</a></li>

 				<li>
 					<a href="#">
 						<i class="icon-calendar3"></i>
 						<span class="visible-xs-inline-block position-right">Icon link</span>
 					</a>
 				</li>
 			</ul>

 			<ul class="nav navbar-nav navbar-right">
 				<li><a href="#">Text link</a></li>

 				<li>
 					<a href="#">
 						<i class="icon-cog3"></i>
 						<span class="visible-xs-inline-block position-right">Icon link</span>
 					</a>
 				</li>

 				<li class="dropdown dropdown-user">
 					<a class="dropdown-toggle" data-toggle="dropdown">
 						<img src="assets/images/image.png" alt="">
 						<span>Victoria</span>
 						<i class="caret"></i>
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
 				<li><a href="../index.html"><i class="icon-display4 position-left"></i> Dashboard</a></li>

 				<li class="dropdown mega-menu mega-menu-wide">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mega menu <span class="caret"></span></a>

 					<div class="dropdown-menu dropdown-content">
 						<div class="dropdown-content-body">
 							<div class="row">
 								<div class="col-md-3">
 									<span class="menu-heading underlined">Column 1 title</span>
 									<ul class="menu-list">
 										<li><a href="#">First link, first column</a></li>
 										<li>
 											<a href="#">Second link (multilevel)</a>
 											<ul>
 												<li><a href="#">Second level, first link</a></li>
 												<li><a href="#">Second level, second link</a></li>
 												<li><a href="#">Second level, third link</a></li>
 												<li><a href="#">Second level, fourth link</a></li>
 											</ul>
 										</li>
 										<li><a href="#">Third link, first column</a></li>
 										<li><a href="#">Fourth link, first column</a></li>
 									</ul>
 								</div>
 								<div class="col-md-3">
 									<span class="menu-heading underlined">Column 2 title</span>
 									<ul class="menu-list">
 										<li><a href="#">First link, second column</a></li>
 										<li>
 											<a href="#">Second link (multilevel)</a>
 											<ul>
 												<li><a href="#">Second level, first link</a></li>
 												<li><a href="#">Second level, second link</a></li>
 												<li><a href="#">Second level, third link</a></li>
 												<li><a href="#">Second level, fourth link</a></li>
 											</ul>
 										</li>
 										<li><a href="#">Third link, second column</a></li>
 										<li><a href="#">Fourth link, second column</a></li>
 									</ul>
 								</div>
 								<div class="col-md-3">
 									<span class="menu-heading underlined">Column 3 title</span>
 									<ul class="menu-list">
 										<li><a href="#">First link, third column</a></li>
 										<li>
 											<a href="#">Second link (multilevel)</a>
 											<ul>
 												<li><a href="#">Second level, first link</a></li>
 												<li><a href="#">Second level, second link</a></li>
 												<li><a href="#">Second level, third link</a></li>
 												<li><a href="#">Second level, fourth link</a></li>
 											</ul>
 										</li>
 										<li><a href="#">Third link, third column</a></li>
 										<li><a href="#">Fourth link, third column</a></li>
 									</ul>
 								</div>
 								<div class="col-md-3">
 									<span class="menu-heading underlined">Column 4 title</span>
 									<ul class="menu-list">
 										<li><a href="#">First link, fourth column</a></li>
 										<li>
 											<a href="#">Second link (multilevel)</a>
 											<ul>
 												<li><a href="#">Second level, first link</a></li>
 												<li><a href="#">Second level, second link</a></li>
 												<li><a href="#">Second level, third link</a></li>
 												<li><a href="#">Second level, fourth link</a></li>
 											</ul>
 										</li>
 										<li><a href="#">Third link, fourth column</a></li>
 										<li><a href="#">Fourth link, fourth column</a></li>
 									</ul>
 								</div>
 							</div>
 						</div>
 					</div>
 				</li>

 				<li class="dropdown">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
 						Starter kit <span class="caret"></span>
 					</a>

 					<ul class="dropdown-menu width-200">
 						<li class="dropdown-header">Basic layouts</li>
 						<li class="dropdown-submenu">
 							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-grid2"></i> Columns</a>
 							<ul class="dropdown-menu">
 								<li class="dropdown-header highlight">Options</li>
 								<li class="active"><a href="1_col.html">One column</a></li>
 								<li><a href="2_col.html">Two columns</a></li>
 								<li class="dropdown-submenu">
 									<a href="#">Three columns</a>
 									<ul class="dropdown-menu">
 										<li class="dropdown-header highlight">Sidebar position</li>
 										<li><a href="3_col_dual.html">Dual sidebars</a></li>
 										<li><a href="3_col_double.html">Double sidebars</a></li>
 									</ul>
 								</li>
 								<li><a href="4_col.html">Four columns</a></li>
 							</ul>
 						</li>
 						<li class="dropdown-submenu">
 							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify3"></i> Navbars</a>
 							<ul class="dropdown-menu">
 								<li class="dropdown-header highlight">Fixed navbars</li>
 								<li><a href="layout_navbar_fixed_main.html">Fixed main navbar</a></li>
 								<li><a href="layout_navbar_fixed_secondary.html">Fixed secondary navbar</a></li>
 								<li><a href="layout_navbar_fixed_both.html">Both navbars fixed</a></li>
 							</ul>
 						</li>
 						<li class="dropdown-header">Optional layouts</li>
 						<li><a href="layout_boxed.html"><i class="icon-align-center-horizontal"></i> Fixed width</a></li>
 						<li><a href="layout_sidebar_sticky.html"><i class="icon-flip-vertical3"></i> Sticky sidebar</a></li>
 					</ul>
 				</li>
 			</ul>

 			<ul class="nav navbar-nav navbar-right">
 				<li><a href="#">Text link</a></li>

 				<li class="dropdown">
 					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
 						<i class="icon-cog3"></i>
 						<span class="visible-xs-inline-block position-right">Dropdown</span>
 						<span class="caret"></span>
 					</a>

 					<ul class="dropdown-menu dropdown-menu-right">
 						<li><a href="#">Action</a></li>
 						<li><a href="#">Another action</a></li>
 						<li><a href="#">Something else here</a></li>
 						<li class="divider"></li>
 						<li><a href="#">One more separated line</a></li>
 					</ul>
 				</li>
 			</ul>
 		</div>
 	</div>
 	<!-- /second navbar -->


 	<!-- Page header -->
 	<div class="page-header">
 		<div class="page-header-content">
 			<div class="page-title">
 				<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Starters</span> - One Column</h4>

 				<ul class="breadcrumb breadcrumb-caret position-right">
 					<li><a href="index.html">Home</a></li>
 				<li><a href="1_col.html">Starters</a></li>
 				<li class="active">One column</li>
 				</ul>
 			</div>

 			<div class="heading-elements">
 				<a href="#" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Button <b><i class="icon-menu7"></i></b></a>
 			</div>
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


 	<!-- Footer -->
 	<div class="footer text-muted">
    ©Copyright <?php echo date('Y');?> by  <a href="<?php echo HOMEURL;?>">PB Grocery Group Sdn. Bhd. (1209976-H)</a>. All Rights Reserved.
 	</div>
 	<!-- /footer -->
  </div>
 </body>
 </html>
