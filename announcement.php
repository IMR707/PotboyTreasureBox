<?php
$announcement=$list->FEgetAnnouncement();
?>
<div class="panel panel-flat mb-5">
  <div class="panel-body p-10">
      <div class="col-md-2 col-sm-2 col-xs-3">
        <img src="<?php echo FRONTIMAGE;?>liveupdate.png" class="img-responsive" style="max-width:80px">
      </div>
      <div class="col-md-10 col-sm-10 col-xs-9">
        <ul class='marquee'>
          <?php echo $announcement;?>
        </ul>
      </div>
  </div>
</div>

<script type="text/javascript">

$('.marquee').marquee({
  duration: 5000,
  direction: 'left',
  duplicated: 'true'
});

</script>
