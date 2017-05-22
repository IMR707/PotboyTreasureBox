<?php
$announcement=$list->FEgetAnnouncement();
?>
<div class="panel panel-flat">
  <div class="panel-body">

      <div class="col-md-2 col-sm-2 col-xs-3">
        <img src="<?php echo FRONTIMAGE;?>liveupdate.png" class="img-responsive">
      </div>
      <div class="col-md-10 col-sm-10 col-xs-9">
      <marquee class="marquee_ann"><?php echo $announcement;?></marquee>
      </div>


  </div>
</div>
