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




  // elseif($_POST['func'] == 'checkVote'){
  //   $wpid = $_POST['wpid'];
  //   $sponid = $_POST['sponid'];
  //
  //   $res = $fz->checkVote($sponid);
  //
  //   echo $res;
  //
  // }

}
