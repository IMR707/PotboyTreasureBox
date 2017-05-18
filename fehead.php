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
 <link href="<?php echo FRONTCSS;?>style.css" rel="stylesheet" type="text/css">
 <!-- /global stylesheets -->

 <!-- Core JS files -->
 <script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/bootstrap.min.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/nicescroll.min.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/drilldown.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>bootbox.min.js"></script>
 <script src="<?php echo BACK_PLUGIN; ?>moment.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo BACK_PAGES_SCRIPT; ?>jquery.countdown.js"></script>

 <!-- /core JS files -->

 <!-- Theme JS files -->
 <script type="text/javascript" src="<?php echo FRONTJS;?>core/app.js"></script>
 <script src="<?php echo FRONTJS;?>bootstrap-carousel.js"></script>
 <!-- /theme JS files -->

</head>

<body>
  <div class="col-md-8 col-md-offset-2">

 <!-- Main navbar -->
 <?php if (!MV) {
    ?>
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

<?php
$crdata=$list->FEgetRewardData(($user->logged_in) ? $user->uid:0);
    $credit=$crdata->credit;
    $gold=$crdata->gold;
    $diamond=$crdata->diamond;
    $spin=$crdata->spin; ?>

       <li class="dropdown dropdown-user">
         <a><div class="left" data-toggle="tooltip" title="Potboy Credit - You can use credit to buy groceries. Buy your Potboy Credit at discounted rate today!"> <img src="http://potboy.com.my/pub/media/customercredit/point.png" style="width:15px"> <span id="credit_navlink"><?php echo $credit; ?></span></div></a>
       </li>

       <li class="dropdown dropdown-user">
         <a><div class="left" data-toggle="tooltip" title="Potboy Gold - You can further slash prices with Potboy Gold, collect Potboy Gold today!"> <img src="http://potboy.com.my/pub/media/logo/stores/1/gold.png" style="width:16px"> <span id="gold_navlink"><?php echo $gold; ?></span></div></a>
       </li>

       <li class="dropdown dropdown-user">
         <a><div class="left" data-toggle="tooltip" title="Potboy Diamond - Earn Diamond with every RM50 purchase, you can convert Potboy Diamond to Potboy Gold!"><img src="http://potboy.com.my/pub/media/logo/stores/1/diamond.png" style="width:16px"> <span id="diamond_navlink"><?php echo $diamond; ?></span></div></a>
       </li>

       <li class="dropdown dropdown-user">
         <a><div class="left" data-toggle="tooltip" title="Potboy Spin - Earn Diamond , Gold or Spin again."><img src="img/spin.png" style="width:16px"> <span id="spin_navlink"><?php echo $spin; ?></span></div></a>
       </li>




         <li class="dropdown dropdown-user">
           <?php
           if (!$user->logged_in) {
               ?>
               <a href="login.php"><span>Guest</span>
                 <?php

           } else {
               ?>
             <a class="dropdown-toggle" data-toggle="dropdown"><span><?php echo ucwords($user->name); ?></span><i class="caret"></i>
               <?php

           } ?>

         </a>

         <ul class="dropdown-menu dropdown-menu-right">

           <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
           <li><a href="#"><i class="icon-coins"></i> My balance</a></li>
           <li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
           <li class="divider"></li>
           <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
           <li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>

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
       <li class="<?php echo isActived('DASH', $pagemenu, 'active')?>"><a href="index.php"><i class="icon-display4 position-left"></i> Dashboard</a></li>
       <li class="<?php echo isActived('BID', $pagemenu, 'active')?>"><a href="bidding.php"><i class="icon-display4 position-left"></i> Bidding</a></li>
       <li class=""><a href="index.php"><i class="icon-display4 position-left"></i> Latest Winners</a></li>
       <li class=""><a href="index.php"><i class="icon-display4 position-left"></i> Wishlist Voting</a></li>
       <?php
       if (!$user->logged_in) {
           ?>
           <li><a href="login.php"><i class="icon-display4 position-left"></i> Login</a></li>
             <?php

       } else {
           ?>
         <li><a href="index.php"><i class="icon-display4 position-left"></i> My Account</a></li>
           <?php

       } ?>

     </ul>
   </div>
 </div>
 <!-- /second navbar -->
<?php

}?>
<div class="page-container">
