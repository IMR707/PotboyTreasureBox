<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
// $AllDailyReward=$list->FEgetAllDailyReward($user->uid);
// echo "AllDailyReward";
// pre($AllDailyReward);
//
// $AllConversion=$list->FEgetAllConversion($user->uid);
// echo "AllConversion";
// pre($AllConversion);
$fz->fakeWishVote();
