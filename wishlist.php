<?php
define('_VALID_PHP', true);
$pname = 'Bidding';
$menu = 'Bidding';
$pagemenu="WISHLIST";
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

// if (!$user->logged_in) {
//     redirect_to(SITEURL.'/index.php');
// }

$cur_month = date("M Y");
$cur_day = date("d-m-Y");

$last_month = date("F Y",strtotime($cur_month." -1 month"));

$sponsors = $fz->getSponsor();


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
                <?php
                $first = true;
                foreach($sponsors as $key => $row){

                ?>
    						<li class="<?php echo ($first)? 'active' : ''; ?>"><a href="#bottom-tab<?php echo $row->id;?>" data-toggle="tab" aria-expanded="true"><?php echo $row->name;?></a></li>
                <?php
                  $first = false;
                }

                ?>
    					</ul>
    				</div>
          </div>
        </div>

        <div class="tab-content">
          <?php

          $first = true;
          foreach($sponsors as $key => $row){

            $spon_id = $row->id;

          ?>
          <div class="tab-pane fade <?php echo ($first)? 'active in' : ''; ?>" id="bottom-tab<?php echo $spon_id;?>">
            <?php

            $top_three = $fz->getTopThree($last_month,$spon_id);

            // pre($top_three);

            ?>
          	<div class="panel panel-flat mb-10">
              <div class="panel-heading">
                <h4 class="panel-title"><?php echo $last_month;?> Voting Top Ranking</h4>
              </div>
							<div class="panel-body">
                <?php
                $num = 1;
                $color = 0;
                $color_arr = array('bg-gold','bg-silver','bg-bronze');
                foreach($top_three as $key2 => $row2){

                ?>
								<div class="col-md-12">
                  <div class="col-md-2 col-sm-3 col-xs-12 top_ranking_box top_ranking_number text-center <?php echo $color_arr[$color++];?>">
                    <div class="top_ranking_number_disp">
                      <?php echo $num++;?>
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12 top_ranking_box">
                    <img src="<?php echo BACK_UPLOADS.$row2->img_header; ?>" class="img-responsive" style="width:100%">
                    <div class="top_ranking_vote"><?php echo $row2->vote_count; ?> votes</div>
                  </div>
                </div>
                <?php

                }
                ?>
                <!-- <div class="col-md-12">
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
                </div> -->
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
          <?php
            $first = false;
          }

          ?>


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
