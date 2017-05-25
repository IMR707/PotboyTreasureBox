<?php
define('_VALID_PHP', true);
require_once '../init.php';

if(isset($_POST)){

  if($_POST['func'] == 'getUserSpin'){

    $user_id = $_SESSION['userid'];

    $res = $list->FEgetRewardData($user_id);

    echo $res->spin;

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
