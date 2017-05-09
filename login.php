<?php
define('_VALID_PHP', true);
$pname = 'Login';
require_once 'init.php';

if ($user->logged_in) {
    redirect_to(SITEURL.'/dashboard.php');
}
$refurl=isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

if($refurl){
  $refurl=substr($refurl, strrpos($refurl, '/') + 1)=='login.php'? "":$refurl;
}
if (isset($_POST['doLogin'])) {
pre($_POST);
}

if (isset($_POST['doLogin'])) {
    $log=$user->login($_POST['username'], $_POST['password'],$_POST['refurl']);
if($log)
    redirect_to(SITEURL . "/index.php");
    else {
      redirect_to(SITEURL . "/login.php");
    }
}
include 'fehead.php';
?>

  <div class="col-md-6 col-md-offset-3">

<div class="page-container">

  <!-- Page content -->
  <div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

      <!-- Advanced login -->

        <div class="panel panel-body login-form">
          <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
          </div>
          <form method="POST" action="login.php">
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
                  <input type="hidden" value="<?php echo $refurl;?>" name="refurl">
                  <input name="doLogin" type="hidden" value="1">
                  <input type="checkbox" class="styled" checked="checked" name="rememberme">
                  Remember
                </label>
              </div>

              <div class="col-sm-6 text-right">
                <a href="<?php echo FORGOTURL;?>">Forgot password?</a>
              </div>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn bg-pink-400 btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
          </div>
            </form>

          <div class="content-divider text-muted form-group"><span>or sign in with</span></div>
          <ul class="list-inline form-group list-inline-condensed text-center">
            <li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
            <li><a href="#" class="btn border-pink-300 text-pink-300 btn-flat btn-icon btn-rounded"><i class="icon-dribbble3"></i></a></li>
            <li><a href="#" class="btn border-slate-600 text-slate-600 btn-flat btn-icon btn-rounded"><i class="icon-github"></i></a></li>
            <li><a href="#" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>
          </ul>

          <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
          <a href="<?php echo SIGNUPURL;?>" class="btn btn-default btn-block content-group">Sign up</a>
          <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
        </div>


      <!-- /advanced login -->

    </div>
    <!-- /main content -->

  </div>
  <!-- /page content -->

</div>
<!-- /page container -->
</div>
<?php
 include 'fefoot.php';
 ?>
