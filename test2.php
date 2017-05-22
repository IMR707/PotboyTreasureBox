<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
$mobile_new="60122244417";
$sms_code="11111";
$curl_link = "http://www.etracker.cc/bulksms/send?user=TEST110&pass=@@Ox1992zz@@&type=0&to=".$mobile_new."&from=potboy&text=Potboy+TreasureBox.+Your+TAC+is+".$sms_code."&servid=mes01";
    // create a new cURL resource
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $curl_link);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // grab URL and pass it to the browser
    $curl_result = curl_exec($ch);
    // close cURL resource, and free up system resources
    curl_close($ch);
    $xml=simplexml_load_string($curl_result) or die("Error: Cannot create object");
    if($xml->status!=201){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $curl_link);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // grab URL and pass it to the browser
      $curl_result = curl_exec($ch);
      // close cURL resource, and free up system resources
      curl_close($ch);
      $xml=simplexml_load_string($curl_result) or die("Error: Cannot create object");
    }
