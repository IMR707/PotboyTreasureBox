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

    <!-- <h6 class="text-semibold">Start your development with no hassle!</h6>
    <p class="content-group">Common problem of templates is that all code is deeply integrated into the core. This limits your freedom in decreasing amount of code, i.e. it becomes pretty difficult to remove unnecessary code from the project. Limitless allows you to remove unnecessary and extra code easily just by removing the path to specific LESS file with component styling. All plugins and their options are also in separate files. Use only components you actually need!</p> -->
  </div>
</div>
