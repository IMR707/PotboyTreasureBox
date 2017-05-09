<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;

$AllDailyReward=$list->FEgetAllDailyReward();

$countAllDailyReward=count($AllDailyReward);
// pre($AllDailyReward);
// pre($countAllDailyReward);
$dt = Carbon::now()->addDay();
$loop=[];
for ($i=0; $i <$countAllDailyReward ; $i++) {
  $dt=$dt->subDay();
  $dz=explode(" ",$dt);
  $day=$dz[0];
  $loop[$day]=array();
}
pre($loop);

pre($user);
