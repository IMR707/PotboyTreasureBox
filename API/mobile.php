<?php
define('_VALID_PHP', true);
require_once '../init.php';

switch ($_GET['type']) {
  case 'tac':
  $telid=$_GET['tel'];
  $cid=$_GET['cid'];
  $a=$user->generateUserMobileSMS($cid,$telid);
echo "stringx";
    break;

    case 'retac':
    $telid=$_GET['tel'];
    $cid=$_GET['cid'];

  //echo "stringx";
      break;


      case 'repairnum':
      $user->repairNum();
      echo "string";

    //echo "stringx";
        break;





  default:
    # code...
    break;
}
