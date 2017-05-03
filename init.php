<?php
strlen(session_id()) < 1? session_start():$testing=0;
set_time_limit(0);
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Kuala_Lumpur');
define("CLASSPATH","class/");
require CLASSPATH.'validate.php';
define("BASEPATH", str_replace("init.php", "", realpath(__FILE__)));
$configFile = BASEPATH.CLASSPATH.".env";
if (!file_exists($configFile)) {
  die('Enviroment file not exist. please check in class/.env or rename from ex.env to .env');
  exit;
}
require 'vendor/autoload.php';
use Carbon\Carbon;
$now = Carbon::now();
$dotenv = new Dotenv\Dotenv(__DIR__."/class");
$dotenv->load();
define('DEBUG', true);
require_once (BASEPATH.CLASSPATH."db.php");
require_once (BASEPATH.CLASSPATH."registry.php");
Registry::set('Database', new Database(getenv('DB_SERVER'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_DATABASE')));
$db = Registry::get("Database");
$db->connect();
require_once (BASEPATH.CLASSPATH."functions.php");
require_once (BASEPATH.CLASSPATH."core.php");
define("SITEURLconfig",$_SERVER['HTTP_HOST']);
define("SITEDIRconfig",dirname($_SERVER['PHP_SELF']));
Registry::set('Core', new Core());
$core = Registry::get("Core");
require_once (BASEPATH.CLASSPATH."listing.php");
Registry::set('Listing', new Listing());
$list = Registry::get("Listing");

require_once (BASEPATH.CLASSPATH."chunlam.php");
Registry::set('ChunLam', new ChunLam());
$cl = Registry::get("ChunLam");

require_once (BASEPATH.CLASSPATH."fazrin.php");
Registry::set('Fazrin', new Fazrin());
$fz = Registry::get("Fazrin");

require_once (BASEPATH.CLASSPATH."paginate.php");
$pager = Paginator::instance();
require_once (BASEPATH.CLASSPATH."user.php");
Registry::set('Users', new Users());
$user = Registry::get("Users");
require_once (BASEPATH.CLASSPATH."filter.php");
$request = new Filter();
if (isset($_SERVER['HTTPS'])) {
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
}
else {
    $protocol = 'http';
}
$dir = (Registry::get("Core")->site_dir) ? '' . Registry::get("Core")->site_dir : '';
$url = preg_replace("#/+#", "/", $_SERVER['HTTP_HOST'] . $dir);
$site_url = $protocol . "://" . $url;
define("SITEURL", $site_url);
define("ADMINURL", $site_url . "/admin");
define("UPLOADS", BASEPATH . "uploads/");

define("FRONTASSETSURL", "frontend/");
define("FRONTCSS", FRONTASSETSURL . "css/");
define("FRONTJS", FRONTASSETSURL . "js/");
define("FRONTIMAGE", FRONTASSETSURL . "img/");
define("FRONTICON", FRONTASSETSURL . "icons/");
pre($_SERVER);
define("BACKASSETSURL", "backend/");
define("BACKECSS", BACKASSETSURL . "css/");
define("BACKJS", BACKASSETSURL . "js/");
define("BACKIMAGE", BACKASSETSURL . "img/");
define("BACKICON", BACKASSETSURL . "icons/");


define("UPLOADURL", SITEURL . "/uploads/");
// define("CSS", ASSETSURL . "css/");
// define("JS", ASSETSURL . "js/");
// define("IMAGE", ASSETSURL . "img/");
// define("ICON", ASSETSURL . "icons/");
$editfield=0;
$dt=1;
$jsonPretty = new Camspiers\JsonPretty\JsonPretty;
?>
