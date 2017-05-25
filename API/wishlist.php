<?php
define('_VALID_PHP', true);
require_once '../init.php';

if(isset($_POST)){

  if($_POST['func'] == 'voteWishlist'){

    $wpid = $_POST['wpid'];
    $user_id = $_SESSION['userid'];

    $res = $fz->voteWishlist($wpid,$user_id);

    echo $res;

  }

  elseif($_POST['func'] == 'checkVote'){
    $wpid = $_POST['wpid'];
    $sponid = $_POST['sponid'];

    $res = $fz->checkVote($sponid);

    echo $res;

  }

}
