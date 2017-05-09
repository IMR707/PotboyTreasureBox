<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

// $AllDailyReward=$list->FEgetAllDailyReward();
$AllDailyReward=$list->FEgetAllDailyReward2($user->uid);
pre($AllDailyReward);
