<?php

$fb = new Facebook\Facebook([
  'app_id' => '1819562131638393', // Replace {app-id} with your app id
  'app_secret' => '{app-secret}',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://potboy.com.my/treasurebox/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';



$refurl="";
if(isset($_SERVER['HTTP_REFERER'])){
  $refurl=substr(isset($_SERVER['HTTP_REFERER']), strrpos($_SERVER['HTTP_REFERER'], '/') + 1)=='login.php'? "":$_SERVER['HTTP_REFERER'];
}
$errormsg='';
if (isset($_POST['dosLogins'])) {
    $log=$user->login($_POST['email'], $_POST['password'],$_POST['refurl']);
if($log=='success')
    redirect_to(SITEURL . "/index.php");
    else {
      $errormsg=$log;
    }
}
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
 <link href="<?php echo FRONTCSS;?>style.css" rel="stylesheet" type="text/css">
 <link rel="shortcut icon" href="<?php echo BACK_IMG; ?>favicon.png" />
 <!-- /global stylesheets -->

 <!-- Core JS files -->
 <script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>core/libraries/bootstrap.min.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/nicescroll.min.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>plugins/ui/drilldown.js"></script>
 <script type="text/javascript" src="<?php echo FRONTJS;?>bootbox.min.js"></script>
 <script src="<?php echo BACK_PLUGIN; ?>moment.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo BACK_PAGES_SCRIPT; ?>jquery.countdown.js"></script>
 <?php //pre($user);?>
 <script type="text/javascript">

   function gotolink(url){
     location.href=url;
     return;
     var accstatus=<?php echo $user->accstatus;?>;
     var userAddress=<?php echo $user->userAddress;?>;
     switch (accstatus) {
       case 0:
       alert('Please Login First');
       $("#modal-login").modal();
       break;
      case 1:
      if(!userAddress){
        alert('Please Update Shipping address and Mobile Number');
        location.href='useraddress.php';
      }
      alert(useraccess);
      $("#modal-login").modal();
      break;
      case 2:
      alert(useraccess);
      $("#modal-login").modal();
      break;
      case 3:
      alert(useraccess);
      location.href=url;
      break;
       default:
     }
     <?php
//pre($user);
     ?>
   }
 </script>

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
           <li>
             <a data-toggle="modal" href="#modal-login"><i class="icon-display4 position-left"></i> Login</a>
             </li>
             <?php
       } else {
           ?>
         <li class="<?php echo isActived('UACC', $pagemenu, 'active')?>"><a href="userAccount.php"><i class="icon-display4 position-left"></i> My Account</a></li>
           <?php

       } ?>





     </ul>
   </div>
 </div>
 <div id="modal-login" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content login-form">


       <!-- Form -->
       <div class="modal-body">
         <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
         <form method="POST" action="login.php">

           <div class="text-center">

             <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
           </div>
           <?php if($errormsg){?>
           <span class="help-block text-danger"><?php echo $errormsg;?></span>
           <?php }?>


           <div class="form-group has-feedback has-feedback-left">
             <input type="text" class="form-control" placeholder="Email"  name="email">
             <div class="form-control-feedback">
               <i class="icon-user text-muted"></i>
             </div>
           </div>

           <div class="form-group has-feedback has-feedback-left">
             <input type="password" class="form-control" placeholder="Password" name="password">
             <div class="form-control-feedback">
               <i class="icon-lock2 text-muted"></i>
             </div>
           </div>

           <div class="form-group login-options">
             <div class="row">
               <div class="col-sm-6">
                 <label class="checkbox-inline">
                   <input type="checkbox" class="styled" checked="checked" name="rememberme">
                   Remember
                 </label>
               </div>

               <div class="col-sm-6 text-right">
                 <a href="<?php echo FORGOTURL;?>">Forgot password?</a>
               </div>
             </div>
           </div>

           <input type="hidden" value="<?php echo $refurl;?>" name="refurl" />
           <input type="hidden" value="1" name="dosLogins" />

           <div class="form-group">
             <button type="submit" class="btn bg-purple btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
             <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
           </div>


           <div class="content-divider text-muted form-group"><span>or sign in with</span></div>
           <ul class="list-inline form-group list-inline-condensed text-center">
             <li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
           </ul>

           <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
           <a href="<?php echo SIGNUPURL;?>" class="btn btn-default btn-block content-group">Sign up</a>
           <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="<?php echo TNCURL;?>" target="_blank">Terms &amp; Conditions</a></span>

           </form>
       </div>
       <!-- /form -->

     </div>
   </div>
 </div>
 <!-- /login form -->

 <!-- /second navbar -->
<?php

}?>
<div class="page-container">
