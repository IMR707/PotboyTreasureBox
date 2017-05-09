<?php
define('_VALID_PHP', true);
$pname = 'Gold Conversion';
$menu = 'dailyGold';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

$AllConversion=$list->FEgetAllConversion($user->uid);

$msg='';
if (isset($_GET['cid'])) {
    $msg=$list->FEgetConversion($_GET['cid'], $user->uid);
}

// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }
?>
<?php
 include 'fehead.php';
 ?>

 <div class="page-container bg-white">

   <!-- Page content -->
   <div class="page-content">

     <!-- Main content -->
     <div class="content-wrapper">

       <!-- Simple panel -->
 <!-- 				<div class="panel panel-flat">
         <div class="panel-body">



         </div>
       </div>-->
       <div class="row">

         <?php foreach ($AllConversion as $key => $value):?>
           <div class="col-md-4 col-sm-4 col-xs-4">
               <div class="panel-heading daily-gold-container">
                 <div class="text-center convert-title bg-yellow-gold-dark img-rounded-md"><?php echo $value->name;?></div>
                 <div class="text-center daily-gold-text"><?php echo $value->gold_amount;?></div>
                 <div class="text-center convert-img"><img class="img-responsive gold-pack" src="<?php echo BACK_UPLOADS.$value->icon;?>"></div>
                 <div class="text-center ">
                   <?php if (!$value->disable): ?>
<a href="?cid=<?php echo $value->id;?>">
                   <?php endif;
                   $dis="";
                   if($value->disable)
                   {
                     $dis="claim-disabled";
                   }
                    ?>
                     <div class="diamond-claim img-rounded-md <?php echo $dis;?>" >
                         <div class="row">
                         Claim Now <br>with <br>
                         <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                             <span class="text-lg"><?php echo $value->diamond_amount;?></span>
                         </div>
                         <div class="col-xs-6 col-sm-6 col-md-6">
                             <img src="<?php echo FRONTIMAGE;?>diamond.png" class="img-responsive diamond" >
                         </div>
                         </div>
                     </div>
                     <?php if (!$value->disable): ?>
  </a>
                     <?php endif; ?>
                 </div>
               </div>
           </div>
         <?php endforeach; ?>



         </div>
       <!--<div class="row">
           <div class="col-md-4 col-sm-4 col-xs-4">
               <div class="panel-heading daily-gold-container">
                 <div class="text-center convert-title bg-yellow-gold-dark img-rounded-md">Pouch of <br>POTBOY Gold</div>
                 <div class="text-center daily-gold-text">10000</div>
                 <div class="text-center convert-img"><img class="img-responsive gold-pack" src="<?php echo FRONTIMAGE;?>bag-gold-coins.png"></div>
                 <div class="text-center ">
                     <div class="diamond-claim img-rounded-md" >
                         <div class="row">
                         Claim Now <br>with <br>
                         <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                             <span class="text-lg">10</span>
                         </div>
                         <div class="col-xs-6 col-sm-6 col-md-6">
                             <img src="<?php echo FRONTIMAGE;?>diamond.png" class="img-responsive diamond" >
                         </div>
                         </div>
                     </div>
                 </div>
               </div>
           </div>
           <div class="col-md-4 col-sm-4 col-xs-4">
             <div class="panel-heading daily-gold-container">
                 <div class="text-center convert-title bg-yellow-gold-dark img-rounded-md">Bucket of <br>POTBOY Gold</div>
                 <div class="text-center daily-gold-text">60000</div>
                 <div class="text-center convert-img"><img class="img-responsive gold-pack"  src="<?php echo FRONTIMAGE;?>pot_of_gold.png"></div>
                 <div class="text-center ">
                     <div class="diamond-claim img-rounded-md" >
                         <div class="row">
                         Claim Now <br>with <br>
                         <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                             <span class="text-lg">50</span>
                         </div>
                         <div class="col-xs-6 col-sm-6 col-md-6">
                             <img src="<?php echo FRONTIMAGE;?>diamond.png" class="img-responsive diamond" >
                         </div>
                         </div>
                     </div>
                 </div>
               </div>
           </div>
           <div class="col-md-4 col-sm-4 col-xs-4">
             <div class="panel-heading daily-gold-container">
                 <div class="text-center convert-title bg-yellow-gold-dark img-rounded-md">Wagon of <br>POTBOY Gold</div>
                 <div class="text-center daily-gold-text">150000</div>
                 <div class="text-center convert-img"><img class="img-responsive gold-pack" src="<?php echo FRONTIMAGE;?>wagon_gold.png"></div>
                 <div class="text-center ">
                     <div class="diamond-claim img-rounded-md" >
                         <div class="row">
                         Claim Now <br>with <br>
                         <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                             <span class="text-lg">100</span>
                         </div>
                         <div class="col-xs-6 col-sm-6 col-md-6">
                             <img src="<?php echo FRONTIMAGE;?>diamond.png" class="img-responsive diamond" >
                         </div>
                         </div>
                     </div>
                 </div>
               </div>
           </div>
           <div class="clearfix">&nbsp;</div>
           <div>&nbsp;</div>

       </div> -->



       <!-- /simple panel -->

       <!-- Simple panel -->
       <div class="panel panel-flat">
               <div class="panel-body bg-yellow-gold-dark">
                       <div class="go-shop-gold">
                           <div class="col-md-2 col-xs-2 col-sm-2 text-center"><i class="glyphicon glyphicon-menu-right"></i> </div>
                           <div class="col-md-10 col-xs-10 col-sm-10">Shop Gold</div>
                       </div>
               </div>
       </div>
       <!-- /simple panel -->

       <!-- <div class="row">
         <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">

           <div class="panel panel-flat" style="margin-bottom:5px !important">
             <div class="panel-body" style="padding:5px!important;">
               <img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
             </div>
           </div>

         </div>
         <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:2px !important;padding-right:2px !important;">

           <div class="panel panel-flat" style="margin-bottom:5px !important">
             <div class="panel-body" style="padding:5px!important;">
               <img src="http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/plainDoge-700x525.jpg" data-title="doge" data-content="Hey there!" class="img-responsive">
             </div>
           </div>

         </div>
       </div>-->


     </div>
     <!-- /main content -->

   </div>
   <!-- /page content -->

 </div>

  <?php
   include 'fefoot.php';
   ?>
   <script type="text/javascript">
   <?php
    if ($msg) {
        ?>
      alert('<?php echo $msg; ?>');
      location.href="goldConversion.php";
   <?php

    }
    ?>
   </script>
