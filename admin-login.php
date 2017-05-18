<?php

/************** BASIC CONFIG *************************/

define('_VALID_PHP', true);
require_once 'init.php';
$pname = 'Admin Login';

if ($user->logged_in) {
    //redirect_to(SITEURL.'/admin-dashboard.php');
}
if (isset($_POST['doLogin'])) {
    //header('Refresh:0');
    $result = isset($_POST['rememberme']) ? $log=$user->login($_POST['email'], $_POST['password'], $_POST['rememberme']) : $log=$user->login($_POST['email'], $_POST['password']);

    if($log)
      redirect_to(SITEURL . "/dashboard.php");
    else {
      redirect_to(SITEURL . "/index.php");
    }
}

/************** END BASIC CONFIG *********************/

?>
<html lang="en">
  <?php include BACK_INC.'header.php'; ?>

  <script src="<?php echo BACK_PLUGIN; ?>jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <script src="<?php echo BACK_PLUGIN; ?>jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
  <script src="<?php echo BACK_PLUGIN; ?>select2/js/select2.full.min.js" type="text/javascript"></script>

  <link href="<?php echo BACK_PAGES_CSS; ?>login.min.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo BACK_PAGES_SCRIPT; ?>login.min.js" type="text/javascript"></script>



    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
              <img src="backend/img/logo.png" alt="logo" class="logo-default" width="52">
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form method="post" action="" accept-charset="UTF-8" class="form-horizontal login-form" autocomplete="off" id="login_form" name="login_form">
                <h3 class="form-title font-green">Sign In</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Login</button>
                    <label class="rememberme check mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" value="1" />Remember
                        <span></span>
                    </label>
                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
                <input name="doLogin" type="hidden" value="1">
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="index.html" method="post">
                <h3 class="font-green">Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                    <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright">
          2017 © PotboyTreasureBox by
       <a href="http://clooneit.com" title="We are your Web, System and IT Solutions company ! " target="_blank">ClooneIT</a>
        </div>

    </body>

</html>
