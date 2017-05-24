<?php
define('_VALID_PHP', true);
$pname = 'Instant Claim View';
$menu = 'Instant Claim View';
$pagemenu="BID";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
?>
<?php
 include 'fehead.php';
 ?>



 		<!-- Page content -->
 		<div class="page-content">

 			<!-- Main content -->
 			<div class="content-wrapper">

        <div class="panel panel-flat mb-5">
          <div class="panel-body">


            <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" style="margin:0 auto;width:100%" >
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12 text-center">
              <div class="col-sm-12 col-md-12 col-xs-12 text-center pt-20 pb-20 bg-purple-300">
                <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                  <div class="progress">
                      <div class="progress-bar bg-purple" id="textval1_100" style="width: 42%">
                        <span id="text1_100">42%</span>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-xs-12 pt-10">
                  <div class="col-sm-6 col-md-6 col-xs-6 text-left">
                    538 voucher available
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12">

              <div class="col-sm-12 col-md-12 col-xs-12 text-center pt-20">
                <span class="title-custom">iPhone 7, Red, 128GB, 4G LTE</span>
                <hr>
              </div>
              <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                <span class="font-17">You haven’t claim this voucher yet !</span>
                <br>
                Gold Required – 10000 POTBOY Gold
              </div>
              <div class="col-sm-12 col-md-12 col-xs-12 text-center pt-20">
                <button class="btn btn-purple btn-lg" id="btn_claim" style="width:100%;font-size:30px">
                  CLAIM NOW
                </button>
              </div>


            </div>
          </div>
        </div>


 			</div>
 			<!-- /main content -->

 		</div>

<script type="text/javascript">

$(document).ready(function(){
  $('#btn_claim').on('click',function(){

    //ajax hantar email

    bootbox.alert("You have claimed this voucher. We are preparing the voucher and you will receieved it shortly !");


  });
});




</script>
  <?php
   include 'fefoot.php';
   ?>
