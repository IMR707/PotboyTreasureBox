<?php
define('_VALID_PHP', true);
$pname = 'Login';
require_once 'init.php';

if ($user->logged_in) {
    redirect_to(SITEURL.'/dashboard.php');
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
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<?php
// include 'head.php';
// include 'footer.php';
?>

<!-- altair admin login page -->
<link rel="stylesheet" href="assets/css/login_page.min.css" />
<body class="">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                  <img src="<?php echo IMAGE;?>logo.png" alt="" />
                  <form method="post" accept-charset="UTF-8" class="form-horizontal" autocomplete="off" id="login_form" name="login_form">
                                  <div class="uk-form-row">
                        <label for="login_email">Email</label>
                        <input class="md-input" type="text" id="login_email" name="email" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Password</label>
                        <input class="md-input" type="password" id="login_password" name="password" />
                    </div>
                    <div class="uk-margin-medium-top">


                          <button class="md-btn md-btn-danger md-btn-block md-btn-large">Sign In</button>
                    </div>
                    <div class="uk-margin-top">
                        <a href="#" id="login_help_show" class="uk-float-right">Need help?</a>
                        <span class="icheck-inline">
                            <input type="checkbox" name="rememberme" id="rememberme" data-md-icheck />
                            <label for="rememberme" class="inline-label">Stay signed in</label>
                        </span>
                    </div>
                      <input name="doLogin" type="hidden" value="1">
                </form>
            </div>





            <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_b uk-text-success">Can't log in?</h2>
                <p>Here’s the info to get you back in to your account as quickly as possible.</p>
                <p>First, try the easiest thing: if you remember your password but it isn’t working, make sure that Caps Lock is turned off, and that your email is spelled correctly, and then try again.</p>
                <p>If your password still isn’t working, it’s time to <a href="#" id="password_reset_show">reset your password</a>.</p>
            </div>
            <div class="md-card-content large-padding" id="login_password_reset" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
                <form>
                    <div class="uk-form-row">
                        <label for="login_email_reset">Your email address</label>
                        <input class="md-input" type="text" id="login_email_reset" name="login_email_reset" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <a href="index.html" class="md-btn md-btn-danger md-btn-block">Reset password</a>
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding" id="register_form" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-medium-bottom">Create an account</h2>
                <form>
                    <div class="uk-form-row">
                        <label for="register_email">Email</label>
                        <input class="md-input" type="text" id="register_email" name="register_email" />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_password">Password</label>
                        <input class="md-input" type="password" id="register_password" name="register_password" />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_password_repeat">Repeat Password</label>
                        <input class="md-input" type="password" id="register_password_repeat" name="register_password_repeat" />
                    </div>
                    <div class="uk-form-row">
                        <label for="register_email">E-mail</label>
                        <input class="md-input" type="text" id="register_email" name="register_email" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <a href="dashboard.php" class="md-btn md-btn-danger md-btn-block md-btn-large">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- altair core functions -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="assets/js/pages/login.min.js"></script>


</body>
</html>
