<?php

/*********Basic Settings*********************************/
define('_VALID_PHP', true);
require_once '../init.php';

/********************************************************/

//home slider
if($_POST['func'] == 'create_slideimage'){
  $fz->create_slide();
}

elseif($_POST['func'] == 'update_slideimage'){
  $fz->update_slide();
}

//announcement

elseif($_POST['func'] == 'create_announcement'){
  $fz->create_announcement();
}

elseif($_POST['func'] == 'update_announcement'){
  $fz->update_announcement();
}

elseif($_POST['func'] == 'getAnnouncementByID'){
  $fz->getAnnouncementByID();
}

//daily reward

elseif($_POST['func'] == 'create_dailyreward'){
  $fz->create_dailyreward();
}

elseif($_POST['func'] == 'update_dailyreward'){
  $fz->update_dailyreward();
}

elseif($_POST['func'] == 'getDailyRewardByID'){
  $fz->getDailyRewardByID();
}

//wheel of fortune

elseif($_POST['func'] == 'create_wof'){
  $fz->create_wof();
}

elseif($_POST['func'] == 'update_wof'){
  $fz->update_wof();
}

elseif($_POST['func'] == 'getWofByID'){
  $fz->getWofByID();
}

//conversion

elseif($_POST['func'] == 'create_conversion'){
  $fz->create_conversion();
}

elseif($_POST['func'] == 'getConversionByID'){
  $fz->getConversionByID();
}










?>
