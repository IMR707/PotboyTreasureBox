<?php
$refurl="";
if(isset($_SERVER['HTTP_REFERER'])){
  $refurl=substr(isset($_SERVER['HTTP_REFERER']), strrpos($_SERVER['HTTP_REFERER'], '/') + 1)=='login.php'? "":$_SERVER['HTTP_REFERER'];
}
$errormsg='';

if (isset($_POST['dosLogins'])) {
    $log=$user->login($_POST['email'], $_POST['password'],$_POST['refurl']);
if($log=='success')
    redirect_to($_SERVER['HTTP_REFERER']);
    else {
      $errormsg=$log;
    }
}

if (isset($_POST['doAddress'])) {
    $log=$user->addAddress();
if($log=='success')
    redirect_to($_SERVER['HTTP_REFERER']);
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
 <?php //pre($user);

// $ua=$user->getUserAddress(($user->logged_in) ? '188':0);
 ?>
 <script type="text/javascript">

   function verifylink(url){
     /*
     useraccess
     0 = Guest
     1 = no default address
     2 = no verify
     3 = ok
     */
     switch (<?php echo $user->useraccess;?>) {
       case 0:
       $("#modal-login").modal();
       break;
       case 1:
       $("#modal-address").modal();
       break;
       case 2:

       $("#modal-verify").modal();
       break;
       case 3:
       location.href=url;
       break;
     }
}


//   retacfield
$(document).ready(function(){
  $('#tacsubmit').on('click',function () {
    var code=$('#codetac').val();
    if(code){
      ///////
      $.ajax({
        type    : "GET",
        url     : "API/mobile.php",
        data    : "type=sendtac&code="+code+"&cid="+<?php echo ($user->logged_in) ? $user->uid:0;?>,
        cache   : false,
        dataType: 'json',
        success : function(data)
        {
          var msg=data.msg;
          switch (msg) {
            case 'success':
            var ss="Successfully Verify the TAC";
            alert(ss);
            location.reload();
              break;
            //
            //   case 'exist':
            //     alert(msg);
            //     break;
            //
                case 'error':
            //     var tel=data.tel;
                  alert("Wrong TAC Code");
                  break;
            // default:

         }
        }
      });
      ///////
    }
    else {
      alert('TAC Code is Required');
    }


      });
  $('#tacfield').on('click',function () {
    var tel=$('#telephone').val();
    $.ajax({
      type    : "GET",
      url     : "API/mobile.php",
      data    : "type=tac&tel="+tel+"&cid="+<?php echo ($user->logged_in) ? $user->uid:0;?>,
      cache   : false,
      dataType: 'json',
      success : function(data)
      {
        var msg=data.msg;
        switch (msg) {
          case 'success':
          var ss="Your TAC Request is successful.<br> Your TAC number will be sent to your registered mobile phone number "+data.tel;
          $('#tacstatus').html(ss);
          $('#tacfield').html("Re-Send TAC");

            break;

            case 'exist':
            var ss="Your TAC Request is unsuccessful.<br> You have already submitted a TAC request earlier.To avoid multiple TAC requests, please wait a few minutes for your TAC to be sent to you before making another request ";
            var tel=$('#tacstatus').html(ss);
            $('#tacfield').html("Re-Send TAC");

              /*

(19 May 2017 12:05:37).


              Your TAC Request is  (19 May 2017 12:03:22).
Reject Code : [00A9]
*/
              break;

              case 'error':
              var tel=data.tel;
                alert(msg);
                break;
          default:

        }
      }
    });
  });
});



function verifymobile(id){
  alert(id);
  return;
  $.ajax({
    type    : "GET",
    url     : "API/mobile.php",
    data    : dataString,
    cache   : false,
    dataType: 'json',
    success : function(data)
    {
      $('#upd_id').val(data.id);
      $('#upd_title').val(data.title);
      $('#upd_prio').val(data.prio);
      $('#upd_content').val(data.content);
      $('input[name=publish][class=upd_publish][value='+data.publish+']').prop('checked', 'checked');
      $('#modal_update').modal('show');
    }
  });
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
         <a><div class="left" data-toggle="tooltip" title="Potboy Credit - You can use credit to buy groceries. Buy your Potboy Credit at discounted rate today!"> <img src="https://potboy.com.my/pub/media/customercredit/point.png" style="width:15px"> <span id="credit_navlink"><?php echo $credit; ?></span></div></a>
       </li>

       <li class="dropdown dropdown-user">
         <a><div class="left" data-toggle="tooltip" title="Potboy Gold - You can further slash prices with Potboy Gold, collect Potboy Gold today!"> <img src="https://potboy.com.my/pub/media/logo/stores/1/gold.png" style="width:16px"> <span id="gold_navlink"><?php echo $gold; ?></span></div></a>
       </li>

       <li class="dropdown dropdown-user">
         <a><div class="left" data-toggle="tooltip" title="Potboy Diamond - Earn Diamond with every RM50 purchase, you can convert Potboy Diamond to Potboy Gold!"><img src="https://potboy.com.my/pub/media/logo/stores/1/diamond.png" style="width:16px"> <span id="diamond_navlink"><?php echo $diamond; ?></span></div></a>
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


       <div class="modal-body">
         <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
         <form method="POST" action="">

           <div class="text-center">

             <h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
           </div>

           <span class="help-block text-danger text-center">Please Login First</span>


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

     </div>
   </div>
 </div>
 <!-- /login form -->

 <div id="modal-address" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content login-form">


       <div class="modal-body">
         <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
         <form method="POST" action="" role="form">

           <div class="text-center">

             <h5 class="content-group">Complete your Details <small class="display-block">Address and Mobile Number</small></h5>
           </div>
           <span class="help-block text-danger text-center">Please Update Shipping address and Mobile Number</span>


           <?php
           $ud=$user->getUserbyID(($user->logged_in) ? $user->uid:0);
           $fn=$ud?$ud->firstname:"";
           $ln=$ud?$ud->lastname:"";
           ?>


          <div class="col-sm-6 col-md-6 col-xs-12 text-center">

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="First Name" value="<?php echo $fn;?>" required name="firstname">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $ln;?>" required name="lastname">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>


            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Phone number" required name="telephone">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Fax number"  name="fax">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>


          </div>

          <div class="col-sm-6 col-md-6 col-xs-12 text-center">

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Address line 1" required name="address1">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Address line 2"  name="address2">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="City" required name="city">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>


            <div class="form-group has-feedback has-feedback-left">
              <select class="form-control" required name="region">
                <option class="form-control" value="">-State/Province-</option>
                <option value="Selangor">Selangor</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Sabah">Sabah</option>
                <option value="Pahang">Pahang</option>
                <option value="Perak">Perak</option>
                <option value="Johor">Johor</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Kedah">Kedah</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Melaka">Melaka</option>
                <option value="Pulau Pinang">Pulau Pinang</option>
                <option value="Perlis">Perlis</option>
                <option value="Labuan">Labuan</option>
                <option value="Putrajaya">Putrajaya</option>
              </select>
              <input type="hidden" value="0"  name="region_id">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Zip/Postal Code" required name="postcode">
              <input type="hidden" value="MY"  name="country_id">

              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>

          </div>

           <input type="hidden" value="<?php echo $refurl;?>" name="refurl" />
           <input type="hidden" value="1" name="doAddress" />
           <div class="col-sm-12 col-md-12 col-xs-12 text-center">
           <div class="form-group">
             <button type="submit" class="btn bg-purple btn-block">Submit</button>
             <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
           </div>
           </div>




           </form>
           <div class="clearfix"></div>
       </div>

     </div>
   </div>
 </div>

 <div id="modal-verify" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content login-form">


       <div class="modal-body">
         <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
         <form method="POST" action="" role="form">

           <div class="text-center">

             <h5 class="content-group">Please Select and Verify <small class="display-block">Your Mobile Number</small></h5>
           </div>

           <span class="help-block text-danger text-center">Please verify Your Mobile Number</span>

           <?php
           $um=$user->getUserMobile(($user->logged_in) ? $user->uid:0);
           $umz=$user->getUserMobileSMS(($user->logged_in) ? $user->uid:0);
           $veritext="";
           if($umz){
             $carbon = new Carbon\Carbon($umz->date_created);
             $veritext=$umz->telephone." ".$carbon->diffForHumans();
           }

           ?>



           <div class="row">
           <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 text-center">
             <div class="form-group has-feedback has-feedback-left">
               <select class="form-control" required name="telephone" id="telephone">
                 <?php foreach ($um as $key => $value):  ?>
                   <option value="<?php echo $value['id'];?>" <?php echo $value['default']?"selected":"";?>><?php echo $key;?></option>
                 <?php endforeach; ?>
               </select>
             </div>
           </div>
           </div>



           <div class="row">
           <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 text-center">

               <input type="text"  class="form-control" placeholder="TAC Code" name="" id="codetac" required>

           </div>

           </div>
           <div class="row text-center">
           <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 ">
             <br>
             <?php if ($veritext): ?>
            <button type="button" name="button" class="btn btn-warningcd " id="tacfield">Re-Send TAC</button>
          <?php else: ?>
            <button type="button" name="button" class="btn btn-warningcd " id="tacfield">Send TAC</button>
          <?php endif; ?>

             <br><br>
             <span class="text-success" id="tacstatus" >
             <?php if ($veritext): ?>
                 Successfully Send TAC to <?php echo $veritext;?>
         <?php endif; ?>
</span>

           </div>
           </div>

           <div class="col-sm-12 col-md-12 col-xs-12 text-center">
             <br>
           <div class="form-group">
             <button type="button" class="btn bg-purple btn-block" id="tacsubmit">Submit</button>
             <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
           </div>
           </div>




           </form>
           <div class="clearfix"></div>
       </div>

     </div>
   </div>
 </div>
 <!-- /second navbar -->
<?php

}?>
<div class="page-container">
