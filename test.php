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
//$fz->fakeWishVote();

$chances = array(
  4 => 54,
  5 => 45,
  6 => 33,
  7 => 64,
  2 => 99,
  77 => 42,
);

echo calculateWinningChances($chances);

function calculateWinningChances(array $chances)
{
$sum=0;
$bet=0;
foreach ($chances as $key => $value) {
  $sum+=$value;
}
foreach ($chances as $key => $value) {
  $chances[$key]=($value/$sum)*100;
}
$newc=[];
$nsum=0;
$currentval=0;
foreach ($chances as $key => $value) {
  $newval=$currentval+$value;
  $newc[$key]=array('min' =>$currentval, 'max' => $newval);
  $currentval=$newval;
}
$rnd = rand(1,100);
foreach($newc as $k =>$v) {
    if ($rnd > $v['min'] && $rnd <= $v['max']) {
        $bet=$k;
    }
}
return $bet;
}



die;



$prices=[];
foreach ($chances as $key => $value) {
  $prices[$key]=array('check' =>1,'chance'=>$value);
}



$data=calculateWinningChances($prices);
pre($data);

function calculateWinningChancews(array $prices)
{
  $check=0;
  $pcheck=0;
  foreach ($prices as $key => $value) {
    if($prices[$key]['check']==1){
        $check=1;
        $pcheck++;
    }
  }
  if($pcheck==1){
    return $prices;
  }
  else if(!$check||$pcheck==0){
    return $prices=calculateWinningChances(resetChances($prices));
  }
  else {
      $calc=rand(1, 100);
      foreach ($prices as $key => $value) {
        if($prices[$key]['chance']<$calc){
          $prices[$key]['check']=0;
        }

      }
      pre($prices);
    //pre($prices);
  }
}

function resetChances(array $prices){
foreach ($prices as $key => $value) {
$prices[$key]['check']==1;
}
return $prices;
}




// $chances = array(
//   1 => 20,
//   2 => 30,
//   3 => 50,
//   4 => 50,
//   5 => 50,
//   6 => 50,
// );
// $new=[];
// foreach ($chances as $key => $value) {
//   $new[$key]= array('chance' =>0 ,'vz' );
// }
//
//
//
//
// $a=calculateWinningChances($chances);
// pre($a);
//




//
// function getChanceOfWinning($price)
// {
//
//   if (isset($chances[$price])) {
//     return $chances[$price];
//   }
//   return 0; // <-- default chance
// }
//
// function calculateWinningChance($price,$calc)
// {
//   $chance = getChanceOfWinning($price);
//   if ($calc <= $chance) {
//     return true;
//   }
//   return false;
// }
//
// function calculateWinningChances(array $prices)
// {

//   $results = array();
//   foreach($prices as $price) {
//     $results[$price] = calculateWinningChance($price,$calc);
//   }
//   return $results;
// }
//$data=array('1',200, 300,400,500,600);
//pre(calculateWinningChances($data));
