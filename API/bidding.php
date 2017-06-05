<?php
define('_VALID_PHP', true);
require_once '../init.php';

if(isset($_POST)){

  if($_POST['func'] == 'getBidProductByID'){
    $id = $_POST['id'];
    $res = $fz->getBidProductByID($id);

    echo json_encode($res);
  }

  elseif($_POST['func'] == 'getBiddingByID2'){
    $id = $_POST['id'];
    $res = $fz->getBidProductByID($id);

    echo json_encode($res);
  }

  elseif($_POST['func'] == 'submitBid'){
    $id = $_POST['bid_id'];
    $amount = $_POST['bid_amount'];

    $res = $fz->submitBid($id,$amount);

    echo json_encode($res);
  }



}
