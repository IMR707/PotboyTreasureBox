<?php
define('_VALID_PHP', true);
require_once '../init.php';

switch ($_GET['type']) {
  case 'tac':
  $telid=$_GET['tel'];
  $cid=$_GET['cid'];
  echo jp($user->generateUserMobileSMS($cid,$telid));
  break;

  case 'retac':
  $telid=$_GET['tel'];
  $cid=$_GET['cid'];
  echo $user->RegenerateUserMobileSMS($cid,$telid);
  break;

  case 'sendtac':
  $code=$_GET['code'];
  $cid=$_GET['cid'];
  echo jp($user->CheckUserMobileSMS($code,$cid));
  break;


  case 'repairnum':
  $user->repairNum();
  echo "done repair num";
  break;

  default:
    echo "Please Select Type";
    break;
}
