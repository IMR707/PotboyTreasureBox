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

elseif($_POST['func'] == 'sort_homeslider'){
  $fz->sort_homeslider();
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

elseif($_POST['func'] == 'sort_announcement'){
  $fz->sort_announcement();
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

elseif($_POST['func'] == 'sort_wof'){
  $fz->sort_wof();
}

//conversion

elseif($_POST['func'] == 'create_conversion'){
  $fz->create_conversion();
}

elseif($_POST['func'] == 'update_conversion'){
  $fz->update_conversion();
}

elseif($_POST['func'] == 'getConversionByID'){
  $fz->getConversionByID();
}

elseif($_POST['func'] == 'sort_conversion'){
  $fz->sort_conversion();
}

//Product

elseif($_POST['func'] == 'create_product'){
  $fz->create_product();
}

elseif($_POST['func'] == 'update_product'){
  $fz->update_product();
}

elseif($_POST['func'] == 'getProductByID'){
  $id = $_POST['id'];
  $row = $fz->getProductByID($id);
  echo json_encode($row);
}

elseif($_POST['func'] == 'getProductBySponsorID'){
  $id = $_POST['id'];
  $out = $fz->getProductBySponsorID($id);
  $output = array();
  foreach($out as $key => $row)
  {
    $output[] = array(
      "id" => $row->id,
      "text" => $row->name,
    );
  }
  echo json_encode($output);
}

//Sponsor

elseif($_POST['func'] == 'create_sponsor'){
  $fz->create_sponsor();
}

elseif($_POST['func'] == 'update_sponsor'){
  $fz->update_sponsor();
}

elseif($_POST['func'] == 'getSponsorByID'){
  $fz->getSponsorByID();
}

elseif($_POST['func'] == 'getSponsorProduct'){
  $fz->getSponsorProduct();
}

//Bidding

elseif($_POST['func'] == 'create_bidding'){
  $fz->create_bidding();
}

elseif($_POST['func'] == 'update_bidding'){
  $fz->update_bidding();
}

elseif($_POST['func'] == 'getBiddingByID'){
  $fz->getBiddingByID();
}

//Claim

elseif($_POST['func'] == 'create_claim'){
  $fz->create_claim();
}

elseif($_POST['func'] == 'update_claim'){
  $fz->update_claim();
}

elseif($_POST['func'] == 'getClaimByID'){
  $fz->getClaimByID();
}

//Voucher

elseif($_POST['func'] == 'update_voucher'){
  $fz->update_voucher();
}

elseif($_POST['func'] == 'upload_voucher'){
  $fz->upload_voucher();
}

elseif($_POST['func'] == 'getVoucherByID'){
  $fz->getVoucherByID();
}

// Wish List

elseif($_POST['func'] == 'create_wishlist'){
  $fz->create_wishlist();
}

elseif($_POST['func'] == 'getProductByWishID'){
  $fz->getProductByWishID();
}

// Delete Item

elseif($_POST['func'] == 'deleteItem'){
  $id = $_POST['id'];
  $table = $_POST['table'];
  $fz->deleteItem($id,$table);
  echo '';
}





?>
