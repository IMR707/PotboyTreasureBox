<?php
$announcement=$list->FEgetAnnouncement();
?>
<div class="panel panel-flat">
  <div class="panel-body">
    <p class="content-group">
      <div class="col-md-1 col-xs-4">

        <img src="<?php echo FRONTIMAGE;?>liveupdate.png" class="img-responsive">
      </div>
      <div class="col-md-11 col-xs-8">
      <marquee><?php echo $announcement;?></marquee>
      </div>

      </p>
  </div>
</div>
