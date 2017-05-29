<?php
define('_VALID_PHP', true);
require_once '../init.php';

if(isset($_POST)){

  if($_POST['func'] == 'submitclaim'){

    $claim_id = $_POST['claim_id'];

    $res = $fz->submitClaim($claim_id);

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
