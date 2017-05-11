<?php
define('_VALID_PHP', true);
$pname = 'Gold Conversion';
$menu = 'dailyGold';
$submenu = '';
$pagemenu="DASH";
require_once 'init.php';
use Carbon\Carbon;

$AllConversion=$list->FEgetAllConversion($user->uid);

$msg='';
if (isset($_GET['cid'])) {
    $msg=$list->FEgetConversion($_GET['cid'], $user->uid);
}
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
        <div class="col-md-12 col-sm-12 col-xs-12">

        <?php foreach ($AllConversion as $key => $value):?>
         <div class="col-md-4 col-sm-12 col-xs-12">
           <div class="panel panel-flat" style="height:370px;">
             <div class="panel-heading" style="padding:10px 10px;">
               <div class="text-center daily-title bg-yellow-gold img-rounded convert-title-heading">
                 <span class="convert-title"><?php echo $value->name;?></span>
               </div>
             </div>
             <div class="container-fluid">
               <div class="row text-center">
                 <div class="col-md-10 col-md-offset-1 ">
                   <div class="text-center convert-img">
                     <img class="img-responsive gold-pack" src="<?php echo BACK_UPLOADS.$value->icon;?>">
                   </div>
                 </div>
                 <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 convert-area">
                   <div class="text-center each-reward">
                     <img class="gold-coin" src="<?php echo FRONTIMAGE;?>gold-coin-icon.png">
                     <div class="daily-gold-text">100</div>
                   </div>
                 </div>

                       <?php if (!$value->disable): ?>
                         <a href="?cid=<?php echo $value->id;?>">
                       <?php endif;
                       $dis="";
                       if($value->disable)
                       {
                         $dis="claim-disabled";
                       }
                        ?>
                        <div class="col-md-12">
                          <div class="text-center ">
                            <span class="img-rounded daily-gold-claim">
                              <img src="<?php echo FRONTIMAGE;?>diamond.png" style="width:40px;vertical-align:top" class="" >
                              <span style="font-size:25px;fon-weight:bold"><?php echo $value->diamond_amount;?></span>
                            </span>
                         </div>
                       <br>
                     </div>
                     <?php if (!$value->disable): ?>
                     </a>
                     <?php endif; ?>

               </div>
             </div>
           </div>
         </div>
         <?php endforeach; ?>


       </div>
      </div>


       <!-- Simple panel -->
       <a href="#"><div class="panel panel-flat">
               <div class="panel-body bg-yellow-gold-dark">
                       <div class="go-shop-gold">
                           <div class="col-md-2 col-xs-2 col-sm-2 text-center"><i class="glyphicon glyphicon-menu-right"></i> </div>
                           <div class="col-md-10 col-xs-10 col-sm-10">Shop Gold</div>
                       </div>
               </div>
       </div>
       </a>



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
        bootbox.confirm({
    message: "<?php echo $msg; ?>",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        }
    },
    callback: function (result) {
        console.log('This was logged in the callback: ' + result);
        location.href="goldConversion.php";
    }
});

      // bootbox.alert('<?php echo $msg; ?>');

   <?php

    }
    ?>
   </script>
