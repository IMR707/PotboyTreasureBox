<?php
$homeSlider=$list->FEgetHomeSlider();
?>
<div class="panel panel-flat">
  <div class="panel-body">
            <div class="col-sm-12 col-md-12">
              <div id="carousel-notification" class="bootstrap-carousel" data-indicators="true" data-controls="true">
                <?php foreach ($homeSlider as $key => $value):?>
                <img src="backend/uploads/<?php echo $value->img_name?>" data-title="" class="img-responsive">
                <?php endforeach; ?>
              </div>
            </div>
  </div>
</div>
