<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
if (!$user->logged_in) {
    redirect_to(SITEURL.'/index.php');
}
?>
<?php
 //include 'fehead.php';
 //include 'feheader.php';
 ?>


 <!DOCTYPE html>
 <html>
  	<head>
 		<title>Elementy - Responsive HTML5 Template</title>
 		<meta charset=utf-8 >
 		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
 		<meta name="robots" content="index, follow" >
 		<meta name="keywords" content="HTML5 Template" >
 		<meta name="description" content="Elementy - Responsive HTML5 Template" >
 		<meta name="author" content="Vladimir Azarushkin">
 		<!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> -->
    <meta name="viewport" content="width=320">
     <meta name="theme-color" content="#2a2b2f">

 		<!-- FAVICONS -->
     <link rel="shortcut icon" href="images/favicon/favicon.png">
     <link rel="apple-touch-icon" href="images/favicon/apple-touch-icon.png">
     <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-touch-icon-72x72.png">
     <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-touch-icon-114x114.png">
     <link rel="icon" sizes="192x192" href="images/favicon/icon-192x192.png">

 <!-- CSS -->
     <!--  GOOGLE FONT -->
     <link href='http://fonts.googleapis.com/css?family=Poppins:400,600,300%7COpen+Sans:400,300,700' rel='stylesheet' type='text/css'>

     <!-- REVOSLIDER CSS SETTINGS -->

     <!-- REVOLUTION STYLE SHEETS -->
     <link href="<?php echo FRONTREVO;?>/css/settings-custom.css" rel="stylesheet" type="text/css">

     <!--  BOOTSTRAP -->
 		<link rel="stylesheet" href="<?php echo FRONTCSS;?>bootstrap.min.css">

     <!-- ICONS ELEGANT FONT & FONT AWESOME & LINEA ICONS  -->
 		<link rel="stylesheet" href="<?php echo FRONTCSS;?>icons-fonts.css" >

     <!--  CSS THEME -->
 		<link rel="stylesheet" href="<?php echo FRONTCSS;?>style.css" >

     <!-- ANIMATE -->
 		<link rel='stylesheet' href="<?php echo FRONTCSS;?>animate.min.css">

     <!-- IE Warning CSS -->
 		<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie-warning.css" ><![endif]-->
 		<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8-fix.css" ><![endif]-->

     <!-- Magnific popup, Owl Carousel Assets in style.css -->

 <!-- CSS end -->

 <!-- JS begin some js files in bottom of file-->

 		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 		<!--[if lt IE 9]>
 		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
 		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
 		<![endif]-->

 	</head>
 	<body>

 		<!-- LOADER -->
 		<div id="loader-overflow">
       <div id="loader3" class="loader-cont">Please enable JS</div>
     </div>
<div >
 		<div id="wrap" class="boxed ">
 			<div class="grey-bg"> <!-- Grey BG  -->

 				<!--[if lte IE 8]>
 				<div id="ie-container">
 					<div id="ie-cont-close">
 						<a href='#' onclick='javascript&#058;this.parentNode.parentNode.style.display="none"; return false;'><img src='images/ie-warn/ie-warning-close.jpg' style='border: none;' alt='Close'></a>
 					</div>
 					<div id="ie-cont-content" >
 						<div id="ie-cont-warning">
 							<img src='images/ie-warn/ie-warning.jpg' alt='Warning!'>
 						</div>
 						<div id="ie-cont-text" >
 							<div id="ie-text-bold">
 								You are using an outdated browser
 							</div>
 							<div id="ie-text">
 								For a better experience using this site, please upgrade to a modern web browser.
 							</div>
 						</div>
 						<div id="ie-cont-brows" >
 							<a href='http://www.firefox.com' target='_blank'><img src='images/ie-warn/ie-warning-firefox.jpg' alt='Download Firefox'></a>
 							<a href='http://www.opera.com/download/' target='_blank'><img src='images/ie-warn/ie-warning-opera.jpg' alt='Download Opera'></a>
 							<a href='http://www.apple.com/safari/download/' target='_blank'><img src='images/ie-warn/ie-warning-safari.jpg' alt='Download Safari'></a>
 							<a href='http://www.google.com/chrome' target='_blank'><img src='images/ie-warn/ie-warning-chrome.jpg' alt='Download Google Chrome'></a>
 						</div>
 					</div>
 				</div>
 				<![endif]-->

 				<!-- HEADER BOXED FONT WHITE TRANSPARENT -->
         <div class="header-black-bg"></div> <!-- NEED FOR TRANSPARENT HEADER ON MOBILE -->
 				<header id="nav" class="header header-1 header-boxed header-black">
           <div class="header-wrapper">

             <div class="container relative">

               <div class="clearfix">
                 <div class="logo-row">

                 <!-- LOGO -->
                 <div class="logo-container-2">
                     <div class="logo-2">
                       <a href="index.html" class="clearfix">
                         <img src="images/logo-white.png" class="logo-img" alt="Logo">
                       </a>
                     </div>
                   </div>
                 <!-- BUTTON -->
                 <div class="menu-btn-respons-container">
                   <button id="menu-btn" type="button" class="navbar-toggle btn-navbar collapsed" data-toggle="collapse" data-target="#main-menu .navbar-collapse">
                     <span aria-hidden="true" class="icon_menu hamb-mob-icon"></span>
                   </button>
                 </div>
                </div>
               </div>

               <!-- MAIN MENU CONTAINER -->
               <div class="main-menu-container">

                   <div class=" clearfix">

                     <!-- MAIN MENU -->
                     <div id="main-menu">
                       <div class="navbar navbar-default" role="navigation">

                         <!-- MAIN MENU LIST -->
                         <nav class="collapse collapsing navbar-collapse right-1024">
                           <ul class="nav navbar-nav">

                             <!-- MENU ITEM -->
                             <li class="parent current">
                               <a href="#" class="open-sub"><div class="main-menu-title">Home</div></a>
                               <ul class="sub">
                               <li class="parent">
                                 <a class="current open-sub" href="#">Home</a>
                                 <ul class="sub">
                                 <li><a href="index.html">Home 1</a></li>
                                 <li><a href="index2.html">Home 2</a></li>
                                 <li><a href="index3.html">Home 3</a></li>
                                 <li><a href="index4.html">Home 4</a></li>
                                 <li><a href="index5.html">Home 5</a></li>
                                 <li><a href="index6.html">Home 6</a></li>
                                 <li><a class="current" href="index7.html">Home 7</a></li>
                                 <li><a href="index8.html">Home 8</a></li>
                                 <li><a href="index9.html">Home 9</a></li>
                             <li><a href="index10.html">Home 10</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Blog</a>
                                 <ul class="sub">
                                 <li><a href="index-blog.html">Blog Layout 1</a></li>
                                 <li><a href="index-blog2.html">Blog Layout 2</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Landing</a>
                                 <ul class="sub">
                                   <li><a href="index-landing.html">Landing 1</a></li>
                                   <li><a href="index-landing2.html">Landing 2</a></li>
                                   <li><a href="index-landing3.html">Landing 3</a></li>
                                   <li><a href="index-landing-app.html">App Landing</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Minimal Menu</a>
                                 <ul class="sub">
                                   <li><a href="index-side-menu.html">Side Menu</a></li>
                                   <li><a href="index-full-screen-menu.html">Fullscreen Menu</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Finance</a>
                                 <ul class="sub">
                                   <li><a href="index-finance.html">Finance</a></li>
                                   <li><a href="index-finance2.html">Finance 2</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Construction</a>
                                 <ul class="sub">
                                   <li><a href="index-construction.html">Construction</a></li>
                                   <li><a href="index-construction2.html">Construction 2</a></li>
                                 </ul>
                               </li>
                               <li><a href="index-portfolio.html">Portfolio</a></li>
                               <li><a href="index-photo.html">Photo</a></li>
                               <li><a href="index-shop.html">Shop</a></li>
                               <li><a href="index-cars.html">Car Tuning</a></li>
                               <li><a href="about-me.html">About Me</a></li>
                               <li><a href="one-page-travel.html">Travel</a></li>
                               <li><a href="index-magazine.html">Magazine</a></li>
                               <li><a href="intro.html#one-pages">One Page</a></li>

                               </ul>
                             </li>

                             <!-- MENU ITEM -->
                             <li class="parent">
                               <a href="#" class="open-sub"><div class="main-menu-title">Features</div></a>
                               <ul class="sub">
                               <li class="parent">
                                 <a href="#" class="open-sub">Headers</a>
                                 <ul class="sub">
                                   <li><a href="index7.html">Boxed</a></li>
                               <li><a href="one-page-index8.html">Bottom</a></li>
                                   <li><a href="index.html">Black Transp</a></li>
                                   <li><a href="index-blog2.html">Black No Transp</a></li>
                                   <li><a href="index2.html">White Transp</a></li>
                                   <li><a href="index-blog.html">White No Transp</a></li>
                                   <li><a href="index-shop.html">Shop</a></li>
                                   <li><a href="index-photo.html">Side Menu</a></li>
                                   <li><a href="index-side-menu.html">Min Menu</a></li>
                                   <li><a href="index-full-screen-menu.html">Min Menu 2</a></li>

                                   <li><a href="index-construction.html">Top Bar</a></li>
                                   <li><a href="index-magazine.html">Magazine</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Static Media</a>
                                 <ul class="sub">
                                   <li><a href="static-image.html">Image</a></li>
                                   <li><a href="static-parallax.html">Parallax</a></li>
                                   <li><a href="static-text-rotator.html">Text Rotator</a></li>
                                   <li><a href="static-video.html">HTML5 Video</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Revo Slider</a>
                                 <ul class="sub">
                                   <li><a href="index-fullwidth.html">Full-Width</a></li>
                                   <li><a href="index-fullscreen.html">Full-Screen</a></li>
                                   <li><a href="index-video.html">Video</a></li>
                                   <li><a href="index-ken.html">Ken Burns</a></li>
                                   <li><a href="revo-slider-demo/start-here.html">All Demo</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Page Titles</a>
                                 <ul class="sub">
                                   <li><a href="page-title-small-grey.html">Small Grey</a></li>
                                   <li><a href="page-title-small-white.html">Small White</a></li>
                                   <li><a href="page-title-small-dark.html">Small Dark</a></li>
                                   <li><a href="page-title-big-grey.html">Big Grey</a></li>
                                   <li><a href="page-title-big-white.html">Big White</a></li>
                                   <li><a href="page-title-big-dark.html">Big Dark</a></li>
                                   <li><a href="page-title-big-img.html">Big Image</a></li>
                                   <li><a href="page-title-large-img.html">Large Image</a></li>
                                   <li><a href="page-title-large2.html">Large 2</a></li>
                                   <li><a href="page-title-large3-img.html">Large 3 Image</a></li>
                                   <li><a href="page-title-large4-center.html">Large 4 Center</a></li>
                                   <li><a href="page-title-large5.html">Large 5</a></li>
                                 </ul>
                               </li>
                               <li class="parent">
                                 <a href="#" class="open-sub">Footers</a>
                                 <ul class="sub">
                                   <li><a href="index3.html#footer1">Footer 1</a></li>
                                   <li><a href="index-landing-app.html#footer2">Footer 2</a></li>
                                   <li><a href="about-me.html#footer3">Footer 3</a></li>
                                   <li><a href="index2.html#footer4">Footer 4</a></li>
                                   <li><a href="index-cars.html#footer5">Footer 5</a></li>
                                   <li><a href="index-side-menu.html#footer6">Footer 6</a></li>
                                   <li><a href="index.html#footer7">Footer 7</a></li>
                                   <li><a href="404.html#footer8">Footer 8</a></li>
                                   <li><a href="index-shop.html#footer9">Footer 9</a></li>
                                 </ul>
                               </li>

                               </ul>
                             </li>

                             <!-- MEGA MENU ITEM -->
                             <li class="parent megamenu">
                               <a href="#" class="open-sub"><div class="main-menu-title">Elements</div></a>
                               <ul class="sub">
                               <li class="clearfix">

                                 <div class="menu-sub-container">

                                   <div class="box col-md-3 ">
                                     <ul>
                                       <li><a href="shortcodes.html#accordions"><div class="icon icon-basic-map"></div>Accordions</a></li>
                                       <li><a href="shortcodes.html#alerts"><div class="icon icon-basic-exclamation"></div>Alerts</a></li>
                                       <li><a href="animations.html"><div class="icon icon-basic-mixer2"></div> Animations</a></li>
                                       <li><a href="typography.html#blockquotes"><div class="icon icon-basic-message-txt"></div>Blockquotes</a></li>
                                       <li><a href="shortcodes.html#buttons"><div class="icon icon-basic-link"></div>Buttons</a></li>
                                       <li><a href="shortcodes.html#carousels"><div class="icon icon-arrows-expand-horizontal1"></div>Carousels</a></li>
                                       <li><a href="typography.html#code"><div class="icon icon-basic-webpage-txt"></div>Code</a></li>
                                       <li><a href="shortcodes.html#counters-charts"><div class="icon icon-ecommerce-graph2"></div>Counters</a></li>
                                     </ul>
                                   </div>

                                   <div class="box col-md-3">
                                     <ul>
                                       <li><a href="typography.html#dividers"><div class="icon icon-arrows-minus"></div>Dividers</a></li>
                                       <li><a href="typography.html#dropcaps"><div class="icon icon-software-font-smallcaps"></div>Dropcaps</a></li>
                                       <li><a href="shortcodes.html#flickr-link"><div class="icon icon-basic-webpage-multiple"></div>Flickr Feeds</a></li>
                                       <li><a href="typography.html#heading"><div class="icon icon-arrows-drag-vert"></div>Headings</a></li>
                                       <li><a href="typography.html#highlights"><div class="icon icon-ecommerce-sale"></div>Highlights</a></li>
                                       <li><a href="icons.html"><div class="icon icon-basic-lightbulb"></div>Icons</a></li>
                                       <li><a href="shortcodes.html#labels"><div class="icon icon-ecommerce-diamond"></div>Labels</a></li>
                                       <li><a href="shortcodes.html#lightbox"><div class="icon icon-basic-webpage-multiple"></div>Lightbox</a></li>
                                     </ul>
                                   </div>

                                   <div class="box col-md-3">
                                     <ul>
                                       <li><a href="typography.html#lists"><div class="icon icon-arrows-check"></div>Lists</a></li>
                                       <li><a href="shortcodes.html#media"><div class="icon icon-music-play-button"></div>Media</a></li>
                                       <li><a href="shortcodes.html#modals"><div class="icon icon-basic-webpage-img-txt"></div>Modals</a></li>
                                       <li><a href="shortcodes.html#pagination"><div class="icon icon-arrows-stretch-horizontal1"></div>Pagination</a></li>
                                       <li><a href="typography.html#popover"><div class="icon icon-arrows-keyboard-right"></div>Popover</a></li>
                                       <li><a href="typography.html#pricing-tables"><div class="icon icon-basic-notebook"></div>Pricing Tables</a></li>
                                       <li><a href="shortcodes.html#progress-bars"><div class="icon icon-basic-server2"></div>Progress Bars</a></li>
                                       <li><a href="typography.html#tables"><div class="icon icon-arrows-squares"></div>Tables</a></li>
                                     </ul>
                                   </div>

                                   <div class="box col-md-3 ">
                                     <ul>
                                       <li><a href="shortcodes.html#tabs"><div class="icon icon-basic-folder"></div>Tabs</a></li>
                                       <li><a href="typography.html#testimonials"><div class="icon icon-arrows-keyboard-cmd-29"></div>Testimonials</a></li>
                                       <li><a href="typography.html#cd-timeline"><div class="icon icon-arrows-drag-horiz"></div>Timeline</a></li>
                                       <li><a href="shortcodes.html#toggles"><div class="icon icon-arrows-hamburger1"></div>Toggles</a></li>
                                       <li><a href="typography.html#tooltips"><div class="icon icon-arrows-sign-right"></div>Tooltips</a></li>
                                       <li><a href="shortcodes.html#twitter-link"><div class="icon icon-basic-world"></div>Twitter Feeds</a></li>
                                     </ul>
                                   </div>

                                 </div>

                               </li>
                               </ul>
                             </li>

                             <!-- MENU ITEM -->
                             <li class="parent">
                               <a href="#" class="open-sub"><div class="main-menu-title">Portfolio</div></a>
                               <ul class="sub">
                                 <li><a href="index-portfolio.html">Home - Portfolio 1</a></li>
                                 <li><a href="index-photo.html">Home - Portfolio 2</a></li>
                                 <li><a href="portfolio-grid.html">Portfolio Grid</a></li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Boxed</a>
                                   <ul class="sub">
                                     <li><a href="portfolio-boxed-2col.html">2 Columns</a></li>
                                     <li><a href="portfolio-boxed-3col.html">3 Columns</a></li>
                                     <li><a href="portfolio-boxed-4col.html">4 Columns</a></li>
                                     <li><a href="portfolio-boxed-5col.html">5 Columns</a></li>
                                   </ul>
                                 </li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Boxed bordered</a>
                                   <ul class="sub">
                                     <li><a href="portfolio-boxed-gut-2col.html">2 Columns</a></li>
                                     <li><a href="portfolio-boxed-gut-3col.html">3 Columns</a></li>
                                     <li><a href="portfolio-boxed-gut-4col.html">4 Columns</a></li>

                                   </ul>
                                 </li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Wide</a>
                                   <ul class="sub">
                                     <li><a href="portfolio-wide-2col.html">2 Columns</a></li>
                                     <li><a href="portfolio-wide-3col.html">3 Columns</a></li>
                                     <li><a href="portfolio-wide-4col.html">4 Columns</a></li>
                                     <li><a href="portfolio-wide-5col.html">5 Columns</a></li>
                                   </ul>
                                 </li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Wide bordered</a>
                                   <ul class="sub">
                                     <li><a href="portfolio-wide-gut-2col.html">2 Columns</a></li>
                                     <li><a href="portfolio-wide-gut-3col.html">3 Columns</a></li>
                                     <li><a href="portfolio-wide-gut-4col.html">4 Columns</a></li>
                                     <li><a href="portfolio-wide-gut-5col.html">5 Columns</a></li>
                                   </ul>
                                 </li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Masonry</a>
                                   <ul class="sub">
                                     <li><a href="portfolio-masonry-2col.html">2 Columns</a></li>
                                     <li><a href="portfolio-masonry-3col.html">3 Columns</a></li>
                                     <li><a href="portfolio-masonry-4col.html">4 Columns</a></li>

                                   </ul>
                                 </li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Portfolio Single</a>
                                   <ul class="sub">
                                     <li><a href="portfolio-single1.html">Single 1</a></li>
                                     <li><a href="portfolio-single2.html">Single 2</a></li>
                                     <li><a href="portfolio-single3.html">Single 3</a></li>
                                     <li><a href="portfolio-single4.html">Single 4</a></li>
                                   </ul>
                                 </li>
                               </ul>
                             </li>

                             <!-- MENU ITEM -->
                             <li class="parent">
                               <a href="#" class="open-sub"><div class="main-menu-title">Blog</div></a>
                               <ul class="sub">
                                 <li><a href="index-blog.html">Home - Blog 1</a></li>
                                 <li><a href="index-blog2.html">Home - Blog 2</a></li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Blog Masonry</a>
                                   <ul class="sub">
                                     <li><a href="blog-masonry-2col.html">2 Columns</a></li>
                                     <li><a href="blog-masonry-3col.html">3 Columns</a></li>
                                     <li><a href="blog-masonry-4col.html">4 Columns</a></li>
                                   </ul>
                                 </li>
                                 <li><a href="blog-full-width.html">Blog Full Width</a></li>
                                 <li><a href="blog-small-image.html">Blog Small Image</a></li>
                                 <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                 <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                 <li class="parent">
                                   <a href="#" class="open-sub">Blog Single</a>
                                   <ul class="sub">
                                   <li><a href="blog-single-disqus.html">Disqus Comments</a></li>
                                   <li><a href="blog-single-facebook.html">Facebook Comment</a></li>
                                   <li><a href="blog-single-sidebar-right.html">Right Sidebar</a></li>
                                   <li><a href="blog-single-sidebar-left.html">Left Sidebar</a></li>
                                   <li><a href="blog-single-fullwidth.html">Fullwidth</a></li>
                                   <li><a href="blog-single-fullwidth2.html">Fullwidth 2</a></li>
                                   </ul>
                                 </li>
                               </ul>
                             </li>

                             <!-- MENU ITEM -->
                             <li class="parent">
                               <a href="#" class="open-sub"><div class="main-menu-title">Shop</div></a>
                               <ul class="sub">
                                 <li><a href="index-shop.html">Home - Shop</a></li>
                                 <li><a href="shop-2-col.html">2 Columns</a></li>
                                 <li><a href="shop-3-col.html">3 Columns</a></li>
                                 <li><a href="shop-4-col.html">4 Columns</a></li>
                                 <li><a href="shop-single.html">Shop Single</a></li>
                                 <li><a href="shop-shoping-cart.html">Shoping Cart</a></li>
                             <li><a href="shop-checkout.html">Checkout</a></li>
                               </ul>
                             </li>

                             <!-- MEGA MENU ITEM -->
                             <li class="parent megamenu">
                               <a href="#" class="open-sub"><div class="main-menu-title">Pages</div></a>
                               <ul class="sub">
                                 <li>

                                   <div class="menu-sub-container">

                                     <div class="box col-md-3 nofloat closed">
                                       <h5 class="title open-sub">Pages 01</h5>
                                       <ul>
                                         <li><a href="typography.html">Typography</a></li>
                                         <li><a href="grid-system.html">Grid System</a></li>
                                         <li><a href="services.html">Services</a></li>
                                         <li><a href="services2.html">Services 2</a></li>
                                     <li><a href="login.html">Login / Register</a></li>
                                       </ul>
                                     </div>

                                     <div class="box col-md-3 nofloat closed">
                                       <h5 class="title open-sub">Pages 02</h5>
                                       <ul>
                                         <li><a href="coming-soon.html">Coming Soon</a></li>
                                         <li><a href="coming-soon2.html">Coming Soon 2</a></li>
                                         <li><a href="404.html">404 Error</a></li>
                                         <li><a href="maintenance-page.html">Maintenance Page</a></li>
                                       </ul>
                                     </div>

                                     <div class="box col-md-3 nofloat closed">
                                       <h5 class="title open-sub">Pages 03</h5>
                                       <ul>
                                         <li><a href="about-us.html">About Us</a></li>
                                         <li><a href="about-us-2.html">About Us 2</a></li>
                                         <li><a href="about-me.html">About Me</a></li>
                                         <li><a href="team.html">Team</a></li>
                                     <li><a href="loaders.html">Loaders</a></li>
                                       </ul>
                                     </div>

                                     <div class="box col-md-3 nofloat closed">
                                       <h5 class="title open-sub">Pages 04</h5>
                                       <ul>
                                         <li><a href="faq.html">FAQ</a></li>
                                         <li><a href="layout-full-width.html">Layout Full Width</a></li>
                                         <li><a href="layout-left-sidebar.html">Layout Left Sidebar</a></li>
                                         <li><a href="layout-right-sidebar.html">Layout Right Sidebar</a></li>
                                       </ul>
                                     </div>

                                   </div>

                                 </li>
                               </ul>
                             </li>

                             <!-- MENU ITEM -->
                             <li id="menu-contact-info-big" class="parent megamenu">
                               <a href="#" class="open-sub"><div class="main-menu-title">Contact</div></a>
                               <ul class="sub">
                                 <li class="clearfix" >
                                   <div class="menu-sub-container">

                                     <div class="box col-md-3 menu-demo-info closed">
                                       <h5 class="title open-sub">Contact Pages</h5>
                                       <ul>
                                       <li><a href="contact.html">Contact Version 1</a></li>
                                       <li><a href="contact2.html">Contact Version 2</a></li>
                                       </ul>
                                     </div>

                                     <div class="col-md-3 menu-contact-info">
                                       <ul class="contact-list">
                                         <li class="contact-loc clearfix">
                                           <div class="loc-icon-container">
                                             <div class="icon icon-basic-map main-menu-contact-icon"></div>
                                           </div>
                                           <div class="menu-contact-text-container">555 California str, 100</div>
                                         </li>
                                         <li class="contact-phone clearfix">
                                           <div class="loc-icon-container">
                                             <div class="icon icon-basic-smartphone main-menu-contact-icon"></div>
                                           </div>
                                           <div class="menu-contact-text-container">1-80-100-10, 1-80-300-10</div>
                                         </li>
                                         <li class="contact-mail clearfix" >
                                           <div class="loc-icon-container">
                                             <div class="icon icon-basic-mail main-menu-contact-icon"></div>
                                           </div>
                                           <div class="menu-contact-text-container">
                                             <a class="a-mail" href="mailto:info@haswell.com">info@haswell.com</a>
                                           </div>
                                         </li>
                                       </ul>
                                     </div>

                                     <div class="col-md-6 menu-map-container hide-max-960 ">
                                       <!-- Google Maps -->
                                       <div class="google-map-container">
                                         <img src="images/map-line.png" alt="alt">
                                       </div>
                                       <!-- Google Maps / End -->
                                     </div>

                                   </div>
                                 </li>
                               </ul>
                             </li>

                           </ul>

                         </nav>

                       </div>
                     </div>
                     <!-- END main-menu -->

                   </div>
                   <!-- END container-m-30 -->

               </div>
               <!-- END main-menu-container -->

               <!-- SEARCH READ DOCUMENTATION -->
               <ul class="cd-header-buttons">
                 <li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
               </ul> <!-- cd-header-buttons -->
               <div id="cd-search" class="cd-search">
                 <form class="form-search" id="searchForm" action="page-search-results.html" method="get">
                   <input type="text" value="" name="q" id="q" placeholder="Search...">
                 </form>
               </div>

             </div><!-- END container -->

           </div>
           <!-- END header-wrapper -->
 				</header>

         <!-- SLIDER Revo Hero 4 -->
         <div class="relative">

             <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_280_1_wrapper" style="margin:0px auto;background-color:#101010;padding:0px;margin-top:0px;margin-bottom:0px;">
                 <!-- START REVOLUTION SLIDER 5.1.4 fullwidth mode -->
                 <div class="rev_slider fullwidthabanner" data-version="5.1.4" id="rev_slider_280_1" style="display:none;">
                     <ul>

                         <!-- SLIDE  -->
                         <li data-index="rs-673" data-transition="zoomout" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="images/revo-slider/constr2-180x110.jpg" data-rotate="0" data-saveperformance="off" data-title="CONSTRUCT WORKS" data-description="">
                             <!-- MAIN IMAGE -->
                             <img src="images/revo-slider/index-fullwidth.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
                             <!-- LAYERS -->

                             <!-- LAYER NR. 1 -->
                             <div class="tp-caption font-poppins font-white tp-resizeme rs-parallaxlevel-6" id="slide-8981-layer-1" style="z-index: 8; white-space: nowrap;"
                             data-fontsize="['20','24','24','24']"
                             data-fontweight="400"
                             data-height="none"
                             data-lineheight="['74','74','74','74']"
                             data-responsive_offset="on"
                             data-splitin="none"
                             data-splitout="none"
                             data-start="350"
                             data-transform_idle="o:1;"

 									 data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;"
 									 data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
 									 data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
 									 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-whitespace="nowrap"
                             data-width="none"
                             data-x="['center','center','center','center']"
                             data-hoffset="['0','0','0',0']"
                             data-y="['center','center','center','center']"
                             data-voffset="['-70','-90','-70','-55']">
                               One & Multi Page Template
                             </div>

                             <!-- LAYER NR. 2 -->
                             <div class="tp-caption font-poppins font-white tp-resizeme rs-parallaxlevel-6" id="slide-8981-layer-2" style="z-index: 8; white-space: nowrap;"
                             data-fontsize="['70','50','80','50']"
                             data-fontweight="600"
                             data-height="none"
                             data-lineheight="['120','130','110','95']"
                             data-responsive_offset="on"
                             data-splitin="none"
                             data-splitout="none"
                             data-start="550"
                             data-transform_idle="o:1;"

 									 data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;"
 									 data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
 									 data-mask_in="x:0px;y:0px;"
 									 data-mask_out="x:inherit;y:inherit;"
                             data-whitespace="nowrap"
                             data-width="none"
                             data-x="['center','center','center','center']"
                             data-hoffset="['0','0','0',0']"
                             data-y="['center','center','center','center']"
                             data-voffset="['0','0','0',0']">
                               CREATIVE STUDIO
                             </div>

                             <!-- LAYER NR. 3 -->
                             <div class="tp-caption rs-parallaxlevel-6"
                                id="slide-1291-layer-3"
                                data-x="['center','center','center','center']"
                                data-hoffset="['0','0','0','0']"
                                data-y="['center','center','center','center']"
                                data-voffset="['90','120','100',80']"
                               data-width="none"
                               data-height="none"
                               data-whitespace="nowrap"
                               data-transform_idle="o:1;"
 										data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;"
 										data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);cursor:pointer;"

 									 data-transform_in="y:50px;opacity:0;s:1500;e:Power4.easeInOut;"
 									 data-transform_out="y:[175%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
 									 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                               data-start="1000"
                               data-splitin="none"
                               data-splitout="none"
                               data-responsive_offset="on"
                               data-responsive="off"

                               style="z-index: 8; white-space: nowrap;outline:none;"><a class="tp-button1 button medium full-rounded hover-dark white " href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel">PURCHASE</a><a class="tp-button1 button medium full-rounded thin  white ml-20" href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel">READ MORE</a>
                             </div>

                         </li>

                     </ul>
                     <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                 </div>
             </div>
             <!-- END REVOLUTION SLIDER -->

         </div>
 				<!-- FEATURES 1 -->
 				<div id="about" class="page-section">
 					<div class="container fes1-cont pb-0">
 						<div class="row">

 							<div class="col-md-8">

                 <div class="row">
                   <div class="col-md-12">
                     <div class="fes1-main-title-cont wow fadeInDown">
                       <div class="fes1-title-50 font-poppins">
                         <strong>We are<br>creative</strong>
                       </div>
                     </div>
                   </div>
 								</div>

                 <div class="row">

                   <div class="col-md-6 col-sm-6">
                     <div class="fes1-box wow fadeIn" >
                       <div class="fes1-box-icon">
                         <div class="icon icon-basic-mixer2"></div>
                       </div>
                       <h3>Fully Responsive</h3>

                     </div>
                   </div>

                   <div class="col-md-6 col-sm-6">
                     <div class="fes1-box wow fadeIn" data-wow-delay="200ms">
                       <div class="fes1-box-icon">
                         <div class="icon icon-basic-lightbulb"></div>
                       </div>
                       <h3>Retina Ready</h3>

                     </div>
                   </div>

                 </div>

                 <div class="row">

                   <div class="col-md-6 col-sm-6">
                     <div class="fes1-box wow fadeIn" data-wow-delay="400ms">
                       <div class="fes1-box-icon">
                         <div class="icon icon-basic-helm"></div>
                       </div>
                       <h3>Unique Design</h3>

                     </div>
                   </div>

                   <div class="col-md-6 col-sm-6">
                     <div class="fes1-box wow fadeIn"  data-wow-delay="600ms">
                       <div class="fes1-box-icon">
                         <div class="icon icon-basic-settings"></div>
                       </div>
                       <h3>Easy To Customize</h3>

                     </div>
                   </div>

                 </div>

 							</div>


 							<div class="col-md-4 mt-30 fes1-img-cont wow fadeInUp">
 								<img src="images/fes11-2.jpg" alt="img" >
 							</div>

             </div>
 					</div>
 				</div>

         <!-- FEATURES 12 HALF COLORED -->
 				<div class="page-section">
 					<div class="container-fluid">
 						<div data-equal=".equal-height" class="row row-sm-fix">

 							<div class="col-md-6 fes12-img equal-height" style="background-image: url(images/fes12-1.jpg)">
                 <div class="fes2-main-text-cont text-white">
                   <div class="fes2-title-45 font-poppins text-white">
                     <strong>Optimized for<br>mobile</strong>
                   </div>
                   <div class="fes2-text-cont">Sed ut perspiciatis unde omnis iste nat eror acus antium que. Asperiores, ea velit enim labore doloribus.</div>
                   <div class="fes12-btn-cont mt-30">
                   	<a class="button medium white rounded thin btn-4 btn-4cc" href="#"><span class="button-text-anim">READ MORE</span><span aria-hidden="true" class="button-icon-anim arrow_right"></span></a>
                   </div>
                 </div>
 							</div>

 							<div class="col-md-6 fes12-img equal-height" style="background-image: url(images/fes12-2.jpg)">
                 <div class="fes2-main-text-cont text-black">
                   <div class="fes2-title-45 font-poppins">
                     <strong>Powerful<br>Performance</strong>
                   </div>

                   <div class="fes2-text-cont">Sed ut perspiciatis unde omnis iste nat eror acus antium que. Asperiores, ea velit enim labore doloribus.</div>
                   <div class="fes12-btn-cont mt-30">
                   	<a class="button medium rounded thin gray btn-4 btn-4cc" href="#"><span class="button-text-anim">READ MORE</span><span aria-hidden="true" class="button-icon-anim arrow_right"></span></a>
                   </div>
                 </div>
 							</div>

 						</div>
 					</div>
 				</div>

 				<!-- FEATURES 17 OUR SERVICES 2 -->
 				<div class="page-section pt-160-b-120-cont">
 					<div class="container">
             <div class="row">

 							<div class="col-xs-12 col-sm-4 col-md-4">
                 <div class="mb-70 wow fadeIn">
 								  <div class="fes17-title-cont" >
 								  	<div class="fes17-box-icon">
 								  		<div class="icon icon-ecommerce-graph-increase"></div>
 								  	</div>
 								  	<h3><strong>Marketing</strong></h3>
 								  </div>
 								  <div class="text-center">
 								    Maecenas luctus nisi in sem fermentum blandit. In nec elit sollicitudin, elementum odio et, dictum purus. Proin malesuada quam a volutpat
 								  </div>
 								</div>
 							</div>
 							<div class="col-xs-12 col-sm-4 col-md-4">
                 <div class="mb-70 wow fadeIn" data-wow-delay="200ms">
 								  <div class="fes17-title-cont" >
 								  	<div class="fes17-box-icon">
 								  		<div class="icon icon-basic-settings"></div>
 								  	</div>
 								  	<h3><strong>Development</strong></h3>
 								  </div>
 								  <div class="text-center">
 								    Maecenas luctus nisi in sem fermentum blandit. In nec elit sollicitudin, elementum odio et, dictum purus. Proin malesuada quam a volutpat
 								  </div>
 								</div>
 							</div>
 							<div class="col-xs-12 col-sm-4 col-md-4">
                 <div class="mb-70 wow fadeIn" data-wow-delay="400ms">
 								  <div class="fes17-title-cont" >
 								  	<div class="fes17-box-icon">
 								  		<div class="icon icon-basic-share"></div>
 								  	</div>
 								  	<h3><strong>Production</strong></h3>
 								  </div>
 								  <div class="text-center">
 								    Maecenas luctus nisi in sem fermentum blandit. In nec elit sollicitudin, elementum odio et, dictum purus. Proin malesuada quam a volutpat
 								  </div>
 								</div>
 							</div>

 						</div>
 						<div class="row">

 							<div class="col-xs-12 col-sm-4 col-md-4">
                 <div class="mb-70 wow fadeIn" data-wow-delay="600ms">
 								  <div class="fes17-title-cont" >
 								  	<div class="fes17-box-icon">
 								  		<div class="icon icon-basic-target"></div>
 								  	</div>
 								  	<h3><strong>Branding</strong></h3>
 								  </div>
 								  <div class="text-center">
 								    Maecenas luctus nisi in sem fermentum blandit. In nec elit sollicitudin, elementum odio et, dictum purus. Proin malesuada quam a volutpat
 								  </div>
 								</div>
 							</div>
 							<div class="col-xs-12 col-sm-4 col-md-4">
                 <div class="mb-70 wow fadeIn" data-wow-delay="800ms">
 								  <div class="fes17-title-cont" >
 								  	<div class="fes17-box-icon">
 								  		<div class="icon icon-basic-globe"></div>
 								  	</div>
 								  	<h3><strong>Web Design</strong></h3>
 								  </div>
 								  <div class="text-center">
 								    Maecenas luctus nisi in sem fermentum blandit. In nec elit sollicitudin, elementum odio et, dictum purus. Proin malesuada quam a volutpat
 								  </div>
 								</div>
 							</div>
 							<div class="col-xs-12 col-sm-4 col-md-4">
                 <div class="mb-70 wow fadeIn" data-wow-delay="1000ms">
 								  <div class="fes17-title-cont" >
 								  	<div class="fes17-box-icon">
 								  		<div class="icon icon-basic-picture"></div>
 								  	</div>
 								  	<h3><strong>Photography</strong></h3>
 								  </div>
 								  <div class="text-center">
 								    Maecenas luctus nisi in sem fermentum blandit. In nec elit sollicitudin, elementum odio et, dictum purus. Proin malesuada quam a volutpat
 								  </div>
 								</div>
 							</div>

             </div>
 					</div>
 				</div>

 				<!-- WORK PROCESS 2 -->
 				<div class="container-fluid p-110-cont bg-gray">
 					<div class="row">

             <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="work-proc2-cont wow fadeIn"  >
                 <div class="work-proc2-icon-cont pos-l-12">
                   01
                 </div>
                 <h3><strong>Planning</strong></h3>
                 <p>Maecenas luctus nisi in sem fermen blandit. In nec elit </p>
               </div>
             </div>

             <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="work-proc2-cont wow fadeIn" data-wow-delay="200ms">
                 <div class="work-proc2-icon-cont">
                   02
                 </div>
                 <h3><strong>Developmen</strong></h3>
                 <p>Maecenas luctus nisi in sem fermen blandit. In nec elit </p>
               </div>
             </div>

             <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="work-proc2-cont wow fadeIn" data-wow-delay="400ms">
                 <div class="work-proc2-icon-cont">
                   03
                 </div>
                 <h3><strong>Launch</strong></h3>
                 <p>Maecenas luctus nisi in sem fermen blandit. In nec elit </p>
               </div>
             </div>

             <div class="col-lg-3 col-md-6 col-sm-6">
               <div class="work-proc2-a-cont wow fadeIn" data-wow-delay="600ms">
                 <a class="work-proc2-a" href="#">
                   <div class="work-proc2-a-text">
                     Let's work<br><span class="border-bot">together</span>
                   </div>
                   <div class="work-proc2-bg-block"></div>
                 </a>
               </div>
             </div>

           </div>
 				</div>

         <!-- TESTIMONIALS CAROUSEL 3 -->
         <div class="pt-110-b-80-cont pb-md-80 owl-plugin fullwidth-slider" >

           <!-- Slide Item -->
           <div class="container">
             <div class="relative">
               <div class="row">

                 <div class="col-md-3">
                   <div class="ts3-author-cont">
                     <div class="ts3-author-img">
                       <img class="img-circle" src="images/testimonials/ts-author.jpg" alt="photo" >
                     </div>
                     <div class="ts-author-info text-center">
                       <div class="ts-name">
                         <strong>Amanda Eniston</strong>
                       </div>
                       <div class="ts-type">Doodle inc.</div>
                     </div>

                   </div>
                 </div>

                 <div class="col-md-9">
                   <blockquote class="testimonial-3">
                     <p>Nunc nec dictum purus. Nam porttitor molestie dolor nec lacinia. Donec placerat magna erat, non eleifend neque convallis at. Morbi felis sem, molestie, blandit ac quam. Fusce aliquet, est at rhoncus aliquam vehicu.</p>
                   </blockquote>
                 </div>

               </div>
             </div>
           </div>

           <!-- Slide Item -->
           <div class="container">
             <div class="relative">
               <div class="row">

                 <div class="col-md-3">
                   <div class="ts3-author-cont">
                     <div class="ts3-author-img">
                       <img class="img-circle" src="images/testimonials/ts-author2.jpg" alt="photo" >
                     </div>
                     <div class="ts-author-info text-center">
                       <div class="ts-name">
                         <strong>Colin Little</strong>
                       </div>
                       <div class="ts-type">CEO, Pixate</div>
                     </div>

                   </div>
                 </div>

                 <div class="col-md-9">
                   <blockquote class="testimonial-3">
                     <p>Donec euismod vulputate augue, ac sagittis lacus lobortis id. Donec varius velit eget interdum semper. Mauris quis nunc eget blandit ac quam elit finibus semper eu non tellus. Donec at eros sed ante. </p>
                   </blockquote>
                 </div>

               </div>
             </div>
           </div>

           <!-- Slide Item -->
           <div class="container">
             <div class="relative">
               <div class="row">

                 <div class="col-md-3">
                   <div class="ts3-author-cont">
                     <div class="ts3-author-img">
                       <img class="img-circle" src="images/testimonials/ts-author4.jpg" alt="photo" >
                     </div>
                     <div class="ts-author-info text-center">
                       <div class="ts-name">
                         <strong>Robert Jackson</strong>
                       </div>
                       <div class="ts-type">Founder, Drillbox</div>
                     </div>

                   </div>
                 </div>

                 <div class="col-md-9">
                   <blockquote class="testimonial-3">
                     <p>Etiam vestibulum risus et suscipit finibus. Morbi vitae ligula eget sem dignissim iaculis. Mauris blandit ac quam vitae velit quis arcu mollis pellentesque nec non magna. Pellentesque feu  turpis quis bibendum</p>
                   </blockquote>
                 </div>

               </div>
             </div>
           </div>

         </div>

         <!-- CLIENTS 2 -->
         <div class="page-section p-80-cont bg-gray">
 					<div class="container">

             <div class="row">

               <div class="col-xs-6 col-sm-2 client2-item">
                 <img alt="client" src="images/clients/2-9.png">
               </div>

               <div class="col-xs-6 col-sm-2 client2-item">
                 <img alt="client" src="images/clients/3.png">
               </div>

               <div class="col-xs-6 col-sm-2 client2-item">
                 <img alt="client" src="images/clients/5.png">
               </div>

               <div class="col-xs-6 col-sm-2 client2-item">
                 <img alt="client" src="images/clients/4.png">
               </div>

               <div class="col-xs-6 col-sm-2 client2-item">
                 <img alt="client" src="images/clients/8.png">
               </div>

               <div class="col-xs-6 col-sm-2 client2-item">
                 <img alt="client" src="images/clients/2.png">
               </div>

             </div>

           </div>
 				</div>

         <!-- BLOG SECTION 3 FONT MONTSERRAT -->
         <div class="page-section blog-sect3">
           <div class="container p-140-cont">

             <!-- TITLE -->
           	<div class="row">
           		<div class="col-md-12">
           			<h2 class="section-title2 text-center mb-45 p-0"><strong>Latest News</strong></h2>
           		</div>
           	</div>

             <!-- BG GRAY -->
             <div class="bg-gray clearfix">

             	<!-- BLOG ROW -->
               <div class="row">

                 <div class="col-md-6 pr-0">
             			<div class="post2-prev-img">
                     <a href="blog-single-sidebar-right.html"><img src="images/blog/blog-sect3-post-anim.gif" alt="img"></a>
                   </div>
            			</div>

               	<div class="col-md-6 pl-0">
             			<div class="blog-sect3-text-cont">
             			<div class="pos-v-center">
             				<div class="post2-prev-title">
                       <h3><a href="blog-single-sidebar-right.html">User Experience Design Best sources</a></h3>
                     </div>
             				<div class="post-prev-info">
                       Jule 21, 2016<span class="slash-divider">/</span><a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel">Michael Doe</a>
                     </div>
             			</div>
             			</div>
             		</div>

               </div>

               <!-- BLOG ROW -->
               <div class="row">

                 <div class="col-md-6 pos-l-md-50pc pl-0">
             			<div class="post2-prev-img">
                     <a href="blog-single-sidebar-right.html"><img src="images/blog/blog-sect3-post-1.jpg" alt="img"></a>
                   </div>
            			</div>

               	<div class="col-md-6 pos-r-md-50pc pr-0">
             			<div class="blog-sect3-text-cont">
                     <div class="pos-v-center">
                       <div class="post2-prev-title">
                         <h3><a href="blog-single-sidebar-right.html">Modern minimalism is the right choice</a></h3>
                       </div>
                       <div class="post-prev-info">
                         Jule 21, 2016<span class="slash-divider">/</span><a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel">Michael Doe</a>
                       </div>
                     </div>
             			</div>
             		</div>

               </div>

             </div>

             <!-- VIEW ALL -->
           	<div class="row">
           		<div class="col-md-12 blog-sect3-view-all-cont">
           			<a href="blog-single-sidebar-right.html" class="font-poppins"><strong>view all news</strong></a>
           		</div>
           	</div>

           </div>
         </div>

         <!-- NEWS LETTER -->
         <div class="page-section nl-cont">
           <div class="container">
             <div class="col-sm-8">
             	<h2 class="section-title2 font-light pr-0 nl-title">Newsletter</h2>
             </div>
             <div class="col-sm-4">
             	<div class="relative" >
             	  <div id="mc_embed_signup" class="nl-form-container clearfix">
             	    <form action="http://abcgomel.us9.list-manage.com/subscribe/post-json?u=ba37086d08bdc9f56f3592af0&amp;id=e38247f7cc&amp;c=?" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="newsletterform validate" target="_blank" novalidate>   <!-- EDIT THIS ACTION URL (add "post-json?u" instead of "post?u" and appended "&amp;c=?" to the end of this URL) -->
             	      <input type="email" value="" name="EMAIL" class="email nl-email-input" id="mce-EMAIL" placeholder="Email address" required>
             	      <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
             	      <div style="position: absolute; left: -5000px;"><input type="text" name="b_ba37086d08bdc9f56f3592af0_e38247f7cc" tabindex="-1" value=""></div>

             	      <button id="mc-embedded-subscribe" class="nl2-btn" type="submit" name="subscribe">
             	            <span class="icon icon-arrows-slim-right"></span>
             	          </button>
             	    </form>
             	    <div id="notification_container"  ></div>
             	  </div>
             	</div>
             </div>
           </div>
         </div>

         <!-- FOOTER 4 BLACK WITH TWITTER FEED -->
         <footer id="footer4" class="page-section pt-95 pb-50 footer2-black">
           <div class="container">
             <div class="row">

               <div class="col-md-3 col-sm-3 widget">
                 <div class="logo-footer-cont">
                   <a href="index.html">
                     <img class="logo-footer" src="images/logo-footer-white.png" alt="logo">
                   </a>
                 </div>
                 <div class="footer2-text-cont">
                   <address>
                     555 California str, Suite 100<br>
                     San&nbsp;Francisco, CA 94107
                   </address>
                 </div>
                 <div class="footer2-text-cont">
                   1-800-312-2121<br>
                   <a class="a-text" href="mailto:info@haswell.com">info@elementy.com</a>
                 </div>
                 <div class="footer2-text-cont a-text-main-cont">
                   <a class="popup-gmaps mfp-plugin font-poppins" href="https://maps.google.com/maps?q=555+California+Street+Building,+California+Street,+San+Francisco,&amp;hl=en&amp;t=v&amp;hnear=555+California+Street+Building,+California+Street,+San+Francisco">Open Map</a>
                 </div>
               </div>

               <div class="col-md-2 col-sm-2 widget">
                 <h4>Navigate</h4>
                 <ul class="links-list a-text-cont a-text-main-cont font-poppins">
                   <li><a href="index.html">Home</a></li>
                   <li><a href="shortcodes.html">Shortcodes</a></li>
                   <li><a href="services.html">Services</a></li>
                   <li><a href="index-portfolio.html">Portfolio</a></li>
                   <li><a href="index-blog.html">Blog</a></li>
                   <li><a href="index-shop.html">Shop</a></li>
                   <li><a href="intro.html">Pages</a></li>
                 </ul>
               </div>

               <div class="col-md-3 col-sm-3 widget">
                 <h4>Insights</h4>
                 <ul class="links-list a-text-cont font-poppins" >
                   <li><a href="about-us.html">Company</a></li>
                   <li><a href="services.html">What We Do</a></li>
                   <li><a href="https://help.market.envato.com/hc/en-us">Help Center</a></li>
                   <li><a href="http://themeforest.net/legal/market">Terms of Service</a></li>
                   <li><a href="contact.html">Contact</a></li>
                 </ul>
               </div>

               <!-- TWITTER FEEDS -->
               <div class="col-md-4 col-sm-4 widget">
                 <h4>Recent Tweets</h4>
                 <div id="twitter-feeds"></div>
               </div>

             </div>

             <!-- SUB FOOTER -->
             <div class="footer2-copy-cont clearfix">
               <!-- Social Links -->
               <div class="footer2-soc-a right">
                 <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                 <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                 <a href="https://www.behance.net/abcgomel" title="Behance" target="_blank"><i class="fa fa-behance"></i></a>
                 <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" title="LinkedIn+" target="_blank"><i class="fa fa-linkedin"></i></a>
                 <a href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" title="Dribbble" target="_blank"><i class="fa fa-dribbble"></i></a>
               </div>

               <!-- Copyright -->
               <div class="left">
                 <a class="footer2-copy" href="http://themeforest.net/user/abcgomel/portfolio?ref=abcgomel" target="_blank">&copy; elementy</a>
               </div>

             </div>

           </div>
         </footer>

 				<!-- BACK TO TOP -->
 				<!-- BACK TO TOP -->
 				<p id="back-top">
           <a href="#top" title="Back to Top"><span class="icon icon-arrows-up"></span></a>
         </p>

 			</div><!-- End BG -->
 		</div><!-- End wrap -->
  </div>

 <!-- JS begin -->

 		<!-- jQuery  -->
 		<script type="text/javascript" src="<?php echo FRONTJS;?>jquery.min.js"></script>

 		<!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="<?php echo FRONTJS;?>bootstrap.min.js"></script>

 		<!-- MAGNIFIC POPUP -->
 		<script src='<?php echo FRONTJS;?>jquery.magnific-popup.min.js'></script>

     <!-- PORTFOLIO SCRIPTS -->
     <script type="text/javascript" src="<?php echo FRONTJS;?>isotope.pkgd.min.js"></script>
     <script type="text/javascript" src="<?php echo FRONTJS;?>imagesloaded.pkgd.min.js"></script>
     <script type="text/javascript" src="<?php echo FRONTJS;?>masonry.pkgd.min.js"></script>

     <!-- APPEAR -->
     <script type="text/javascript" src="<?php echo FRONTJS;?>jquery.appear.js"></script>

     <!-- OWL CAROUSEL -->
     <script type="text/javascript" src="<?php echo FRONTJS;?>owl.carousel.min.js"></script>

     <!-- JQUERY TWEETS -->
 		<script src="<?php echo FRONTJS;?>twitter/jquery.tweet.js"></script>

     <!-- MAIN SCRIPT -->
 		<script src="<?php echo FRONTJS;?>main.js"></script>

 		<!-- REVOSLIDER SCRIPTS  -->
     <script src="revo-slider/js/jquery.themepunch.tools.min.js" type="text/javascript">
     </script>
     <script src="revo-slider/js/jquery.themepunch.revolution.min.js" type="text/javascript">
     </script>

     <!-- SLIDER REVOLUTION 5.0 EXTENSIONS
       (Load Extensions only on Local File Systems !
       The following part can be removed on Server for On Demand Loading) -->
     <script src="revo-slider/js/extensions/revolution.extension.actions.min.js" type="text/javascript"></script>
     <script src="revo-slider/js/extensions/revolution.extension.carousel.min.js" type="text/javascript"></script>
     <script src="revo-slider/js/extensions/revolution.extension.kenburn.min.js" type="text/javascript"></script>
     <script src="revo-slider/js/extensions/revolution.extension.layeranimation.min.js" type="text/javascript">
     </script>
     <script src="revo-slider/js/extensions/revolution.extension.migration.min.js" type="text/javascript"></script>
     <script src="revo-slider/js/extensions/revolution.extension.navigation.min.js" type="text/javascript"></script>
     <script src="revo-slider/js/extensions/revolution.extension.parallax.min.js" type="text/javascript"></script>
     <script src="revo-slider/js/extensions/revolution.extension.slideanims.min.js" type="text/javascript"></script>
     <script src="revo-slider/js/extensions/revolution.extension.video.min.js" type="text/javascript"></script>

     <!-- SLIDER REVOLUTION INITIALIZATION  -->
     <script type="text/javascript">
       jQuery(document).ready(function() {

         jQuery("#rev_slider_280_1").show().revolution({
           sliderType: "hero",
           jsFileLocation: "revo-slider/js/",
           sliderLayout: "fullwidth",
           dottedOverlay: "none",
           delay: 9000,
           responsiveLevels: [1240, 1024, 778, 480],
           visibilityLevels: [1240, 1024, 778, 480],
           gridwidth: [1240, 1024, 778, 480],
           gridheight: [610, 550, 550, 550],
           lazyType: "none",
           parallax: {
             type: "off",
             origo: "slidercenter",
             speed: 1000,
             levels: [0],
             type: "scroll",
             disable_onmobile: "on"
           },
           shadow: 0,
           spinner: "spinner2",
           autoHeight: "off",
           fullScreenAutoWidth: "off",
           fullScreenAlignForce: "off",
           fullScreenOffsetContainer: "",
           fullScreenOffset: "",
           disableProgressBar: "on",
           hideThumbsOnMobile: "off",
           hideSliderAtLimit: 0,
           hideCaptionAtLimit: 0,
           hideAllCaptionAtLilmit: 0,
           debugMode: false,
           fallbacks: {
             simplifyAll: "off",
             disableFocusListener: false,
           }
         });

       }); /*ready*/
     </script>

 <!-- JS end -->

 	</body>
 </html>
 <?php
  //include 'fefooter.php';
  ?>
