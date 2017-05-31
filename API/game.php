<?php
define('_VALID_PHP', true);
require_once '../init.php';

if(isset($_POST)){

  if($_POST['func'] == 'submitFreeGame'){

    $uid = $_POST['uid'];
    $score = $_POST['score'];
    $res = $fz->submitFreeGame($uid,$score);

    echo $res;

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
