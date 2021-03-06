<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
header('Access-Control-Allow-Credentials: true');
strlen(session_id()) < 1? session_start():$testing=0;
set_time_limit(0);
ini_set('memory_limit', '-1');
date_default_timezone_set('Asia/Kuala_Lumpur');
define("CLASSPATH", "class/");
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
require_once(BASEPATH.CLASSPATH."db.php");
require_once(BASEPATH.CLASSPATH."registry.php");
Registry::set('Database', new Database(getenv('DB_SERVER'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_DATABASE')));
$db = Registry::get("Database");
$db->connect();
require_once(BASEPATH.CLASSPATH."functions.php");
require_once(BASEPATH.CLASSPATH."core.php");
define("SITEURLconfig", $_SERVER['HTTP_HOST']);
define("SITEDIRconfig", dirname($_SERVER['PHP_SELF']));
Registry::set('Core', new Core());
$core = Registry::get("Core");
require_once(BASEPATH.CLASSPATH."listing.php");
Registry::set('Listing', new Listing());
$list = Registry::get("Listing");

require_once(BASEPATH.CLASSPATH."chunlam.php");
Registry::set('ChunLam', new ChunLam());
$cl = Registry::get("ChunLam");

require_once(BASEPATH.CLASSPATH."fazrin.php");
Registry::set('Fazrin', new Fazrin());
$fz = Registry::get("Fazrin");

require_once(BASEPATH.CLASSPATH."paginate.php");
$pager = Paginator::instance();
require_once(BASEPATH.CLASSPATH."user.php");
Registry::set('Users', new Users());
$user = Registry::get("Users");
require_once(BASEPATH.CLASSPATH."filter.php");
$request = new Filter();
if (isset($_SERVER['HTTPS'])) {
    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
} else {
    $protocol = 'http';
}
$dir = (Registry::get("Core")->site_dir) ? '' . Registry::get("Core")->site_dir : '';
$url = preg_replace("#/+#", "/", $_SERVER['HTTP_HOST'] . $dir);
$site_url = $protocol . "://" . $url;
define("SITEURL", $site_url);
define("FB_APPID", '1819562131638393');
define("FB_APPSECRET",'e810a7d4ba4c172796e3bfad664c2fce');


define("ADMINURL", $site_url . "/admin");
define("UPLOADS", BASEPATH . "uploads/");
define("FRONTASSETSURL", "frontend/");
define("FRONTREVO", FRONTASSETSURL . "revo-slider/");
define("FRONTCSS", FRONTASSETSURL . "assets/css/");
define("FRONTJS", FRONTASSETSURL . "assets/js/");
define("FRONTIMG", FRONTASSETSURL . "assets/images/");
define("FRONTIMAGE", "img/");
define("FRONTICON", FRONTASSETSURL . "assets/icons/");

define("BACKASSETSURL", "backend/");
define("BACKCSS", BACKASSETSURL . "css/");
define("BACKJS", BACKASSETSURL . "js/");
define("BACKIMAGE", BACKASSETSURL . "img/");
define("BACKICON", BACKASSETSURL . "icons/");
define("BACK_INC", BACKASSETSURL . "include/");
define("BACK_PLUGIN", BACKASSETSURL . "assets/global/plugins/");
define("BACK_SCRIPT", BACKASSETSURL . "assets/global/scripts/");
define("BACK_PAGES_SCRIPT", BACKASSETSURL . "assets/pages/scripts/");
define("BACK_PAGES_CSS", BACKASSETSURL . "assets/pages/css/");
define("BACK_CSS", BACKASSETSURL . "assets/global/css/");
define("BACK_LAYOUT", BACKASSETSURL . "assets/layouts/");
define("BACK_IMG", BACKASSETSURL . "img/");
define("BACK_UPLOADS", BACKASSETSURL . "uploads/");


define("SIGNUPURL","https://potboy.com.my/customer/account/create/");
define("FORGOTURL","https://potboy.com.my/customer/account/forgotpassword/");
define("TNCURL","https://potboy.com.my/terms-conditions");


define("WEBNAME", " | Potboy Treasure box");
define("UPLOADURL", SITEURL . "/uploads/");
define("HOMEURL", "https://potboy.com.my/");
define("HOMETBURL", "https://potboy.com.my/treasurebox");
if (isset($_GET['mobileview'])) {
    switch ($_GET['mobileview']) {
    case '0':
      unset($_SESSION['mobileview']);
      break;
    default:
      $_SESSION['mobileview']=1;
      break;
  }
}
define("MV",isset($_SESSION['mobileview']) ? 1:0);
if(isset($fb)){
  $fb = new Facebook\Facebook([
    'app_id' => FB_APPID,
    'app_secret' => FB_APPSECRET,
    'default_graph_version' => 'v2.2',
    ]);
}
