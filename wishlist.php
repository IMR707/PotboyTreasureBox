<?php
define('_VALID_PHP', true);
$pname = 'Bidding';
$menu = 'Bidding';
$pagemenu="WISHLIST";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
$topbid=$list->FEgetBidding('1');
$endsoonbid=$list->FEgetBidding('2');
$newbid=$list->FEgetBidding('3');
$pdbid=$list->FEgetBidding('4');
$pubid=$list->FEgetBidding('5');
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

        <div class="panel panel-flat mb-10">
          <div class="panel-body">
            <div class="tabbable">
    					<ul class="nav nav-tabs nav-tabs-bottom">
    						<li class="active"><a href="#bottom-tab1" data-toggle="tab" aria-expanded="true">Potboy</a></li>
    						<li class=""><a href="#bottom-tab2" data-toggle="tab" aria-expanded="false">Harvey Norman</a></li>
    					</ul>
    				</div>
          </div>
        </div>

        <div class="tab-content">
          <div class="tab-pane fade active in" id="bottom-tab1">

          	<div class="panel panel-flat mb-10">
              <div class="panel-heading">
                <h4 class="panel-title">July Voting Top Ranking</h4>
              </div>
							<div class="panel-body">
								<div class="col-md-12">
                  <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-gold">
                    <div class="top_ranking_number_disp">
                      1
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                    <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" style="width:100%">
                    <div class="top_ranking_vote">100,123 votes</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-silver">
                    <div class="top_ranking_number_disp">
                      2
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                    <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" style="width:100%">
                    <div class="top_ranking_vote">100,123 votes</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-bronze">
                    <div class="top_ranking_number_disp">
                      3
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                    <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" style="width:100%">
                    <div class="top_ranking_vote">100,123 votes</div>
                  </div>
                </div>
							</div>
						</div>

            <div class="panel panel-flat">
              <div class="panel-heading">
                <h4 class="panel-title">VOTE NOW for next month prize !</h4>
              </div>
							<div class="panel-body">
                <?php
                $id = 5;
                for($i=0;$i<8;$i++){

                ?>
								<div class="col-md-3 col-sm-3 col-xs-6 vote_box">
                  <img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive img-center thumbnail-vote <?php echo ($i == $id)? 'vote-active' : ''; ?>" >
                </div>
                <?php
                }
                ?>
							</div>
						</div>
          </div>

          <div class="tab-pane fade" id="bottom-tab2">

           <div class="panel panel-flat mb-10">
             <div class="panel-heading">
               <h4 class="panel-title">Julys Voting Top Ranking</h4>
             </div>
             <div class="panel-body">
               <div class="col-md-12">
                 <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-gold">
                   <div class="top_ranking_number_disp">
                     1
                   </div>
                 </div>
                 <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                   <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" style="width:100%">
                   <div class="top_ranking_vote">100,123 votes</div>
                 </div>
               </div>
               <div class="col-md-12">
                 <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-silver">
                   <div class="top_ranking_number_disp">
                     2
                   </div>
                 </div>
                 <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                   <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" style="width:100%">
                   <div class="top_ranking_vote">100,123 votes</div>
                 </div>
               </div>
               <div class="col-md-12">
                 <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center bg-bronze">
                   <div class="top_ranking_number_disp">
                     3
                   </div>
                 </div>
                 <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                   <img src="<?php echo BACK_UPLOADS; ?>header.png" class="img-responsive" style="width:100%">
                   <div class="top_ranking_vote">100,123 votes</div>
                 </div>
               </div>
             </div>
           </div>

           <div class="panel panel-flat">
             <div class="panel-heading">
               <h4 class="panel-title">VOTE NOW for next month prize !</h4>
             </div>
             <div class="panel-body">
               <?php

               for($i=0;$i<8;$i++){

               ?>
               <div class="col-md-3 vote_box">
                 <img src="<?php echo BACK_UPLOADS; ?>thumbnail.png" class="img-responsive img-center thumbnail-vote" >
               </div>
               <?php
               }
               ?>
             </div>
           </div>
         </div>

        </div>
 			</div>
 			<!-- /main content -->

 		</div>

<script type="text/javascript">
$(document).ready(function(){

  $('.thumbnail-vote').on('click',function(){
    bootbox.confirm({
      message: "<h3>Confirm vote this item for this month ?</h3> <br> **Note : You only have <b>2 VOTE</b> left and you won't be able to change this vote.",
      buttons: {
          confirm: {
              label: 'Confirm',
              className: 'btn-success'
          }
      },
      callback: function (result) {
          
      }

    });

  });

});

</script>
  <?php
   include 'fefoot.php';
   ?>
