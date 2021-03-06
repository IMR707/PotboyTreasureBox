<?php

use Birke\Rememberme;

if (!defined("_VALID_PHP")) {
    die('Direct access to this location is not allowed.');
}
  class Users
  {
      const uTable = "customer_entity";
      const aTable = "customer_address_entity";
      const smsTable = "aa_verifysms";
      const FgamTable = "aa_game_free";
      const tb_drtran = 'aa_dailyreward_transaction';
      const tb_rewardcus = 'lof_rewardpoints_customer';
      const tb_rewardcredit = 'customer_credit';


      public $logged_in = null;
      public $uid = 0;
      public $name;
      public $employeeid = 0;
      public $email;
      public $phone;
      public $cookie_id = 0;
      public $address;
      public $notes;
      public $storagePath;
      public $storage;
      public $rememberMe;
      public $userlevel;
      public $userlevelText;
      public $accverify=0;
      public $userAddress=0;
      public $useraccess=0;

      public $last;
      private $lastlogin = "NOW()";
      private static $db;
      public function __construct()
      {
          self::$db = Registry::get("Database");
          $this->startSession();
      }

      private function startSession()
      {
          if (strlen(session_id()) < 1) {
              session_start();
          }


          $this->logged_in = $this->loginCheck();

          if (!$this->logged_in) {
              $this->email = $_SESSION['email'] = "Guest";
              $this->sesid = sha1(session_id());
              $this->userlevel = 0;
          }
      }


      public function FEgetRewardData($id)
      {
          $sql = 'SELECT available_points as diamond,available_golds as gold,total_spin as spin FROM '.self::tb_rewardcus." where customer_id ='$id'";
          $row = self::$db->first($sql);
          if (!$row) {
              $row = new stdClass();
              $row->diamond=0;
              $row->gold=0;
              $row->spin=0;
          }
          $sql2 = 'SELECT credit_balance as credit FROM '.self::tb_rewardcredit." where customer_id ='$id'";
          $row2 = self::$db->first($sql2);
          if (!$row2) {
              $row->credit='0.00';
          } else {
              $num=$row2->credit;
              $row->credit=sprintf('%.2f', $num);
          }
          $row->credit="RM ".$row->credit;
          return $row;
      }

      public function mydetail()
      {
          return $a=self::$uid;
      }

      private function loginCheck()
      {
          if (isset($_SESSION['email']) && $_SESSION['email'] != "Guest") {
              $row = $this->getUserInfo($_SESSION['email']);
              $this->uid = $_SESSION['userid'] = $row->entity_id;
              $this->email = $row->email;
              $this->name = $_SESSION['name'] = $row->firstname." ".$row->middlename." ".$row->lastname;
              $this->userlevel = $_SESSION['userlevel'] = 1;
              $this->cookie_id = $_SESSION['cookie_id'];
              $this->accverify = $_SESSION['accverify'] = $row->accverify;
              $a=$this->FEgetRewardData($this->uid);
              $this->diamond=$a->diamond;
              $this->gold=$a->gold;
              $this->spin=$a->spin;
              $this->credit=$a->credit;
              $this->userAddress = $_SESSION['userAddress'] =(!$row->default_shipping)?0:$row->default_shipping;
              if(!$this->userAddress){
                $this->useraccess=1;
              }
              elseif($this->accverify){
                $this->useraccess=3;
              }
              else {
                $this->useraccess=2;
              }
              /*
              useraccess
              0 = Guest
              1 = no default address
              2 = no verify
              3 = ok
              */
              return 1;
          } else {
              return 0;
          }
      }
      public function addAddress()
      {
        $address1=self::$db->escape(sanitize($_POST['address1']));
        $address2=self::$db->escape(sanitize($_POST['address2']));
            $data = array(
                  'parent_id' => $this->uid,
                  'city' => self::$db->escape(sanitize($_POST['city'])),
                  'country_id' => self::$db->escape(sanitize($_POST['country_id'])),
                  'fax' => self::$db->escape(sanitize($_POST['fax'])),
                  'firstname' =>  self::$db->escape(sanitize($_POST['firstname'])),
                  'lastname' =>  self::$db->escape(sanitize($_POST['lastname'])),
                  'postcode' =>  self::$db->escape(sanitize($_POST['postcode'])),
                  'region' =>  self::$db->escape(sanitize($_POST['region'])),
                  'region_id' =>  self::$db->escape(sanitize($_POST['region_id'])),
                  'street' =>  $address2?$address1.PHP_EOL.$address2:$address1,
                  'telephone' =>  self::$db->escape(sanitize($_POST['telephone'])),
                  'increment_id'=>NULL,
                  'created_at' => 'now()',
                  'updated_at' => 'now()',
                  'is_active' => 1,
                  );
            $data2 = array(
                'default_shipping' => self::$db->insert(self::aTable, $data)
            );
            $res = self::$db->update(self::uTable, $data2, "entity_id='" .$this->uid. "'");
            return ($res)? "success" : "error";
      }
      public function checkDailyGold($id)
      {
        if(!$id){
        return 0;
      }else {
        $sql = "SELECT * FROM " . self::tb_drtran . " WHERE customer_id='" .$id. "' AND date(date_created)=date(NOW())";
        $row = self::$db->first($sql);
        if($row){
          return 0;
        }
        else {
          return 1;
        }
      }
      }
      public function checkDailyFreeGames($id)
      {
        if(!$id){
          return 0;
        }else {
          $fz = new Fazrin;
          $game_detail = $fz->getFreeGame();
          $chances = $game_detail->chances;

          $sql = "SELECT COUNT(*) as total_played FROM " . self::FgamTable . " WHERE customer_id='" .$id. "' AND date(date_created)=date(NOW())";
          $row = self::$db->first($sql);

          $chance_left = $chances - $row->total_played;

          return $chance_left;
        }
      }

      public function checkPaidGames($id)
      {
        if(!$id){
          return 0;
        }else {
          $list = new Listing;
          $user_reward = $list->FEgetRewardData($id);
          $user_diamond = $user_reward->diamond;

          return $user_diamond;

        }
      }


      public function getUserAddress($id)
      {
        $sql = "SELECT default_shipping as ids FROM " . self::uTable . " WHERE  entity_id ='" . $id . "' AND default_shipping IS NOT NULL";
        $row = self::$db->first($sql);
        $lala="";
        $lili="";
        if($row){
          $lala=", (case
        when (a.entity_id = ".$row->ids.") THEN 1
   ELSE 0 END) as deek";
   $lili="  ORDER BY deek desc ";
        }
        $sql2 = "SELECT * $lala FROM " . self::aTable . " a WHERE  parent_id ='" . $id . "' $lili ";
        $row2 = self::$db->fetch_all($sql2);
        return $row2;
      }

      public function getUserMainAddress($id)
      {
        $sql = "SELECT default_shipping as ids FROM " . self::uTable . " WHERE  entity_id ='" . $id . "' AND default_shipping IS NOT NULL";
        $row = self::$db->first($sql);

        if(!$row){
          return 0;
        }

        $sql2 = "SELECT * FROM " . self::aTable . " a WHERE  parent_id ='" . $id . "' AND a.entity_id = '".$row->ids."' ";
        $row2 = self::$db->first($sql2);
        return $row2;
      }



      public function getUserMobileSMS($id)
      {
        $sql = "SELECT *,DATE_ADD(s.date_created, INTERVAL 30 MINUTE) as expired FROM " . self::smsTable . " s  join ".self::aTable." a on s.address_id=a.entity_id WHERE  customer_id ='" . $id . "' HAVING NOW() < expired order by s.date_created desc";
        $row = self::$db->first($sql);
        return $row;
      }

      public function repairNum()
      {
        $sql = "SELECT * FROM " . self::aTable . " WHERE `telephone` LIKE '0%'";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
        $data = array(
            'telephone' => "+6".$value->telephone
        );
                  $res = self::$db->update(self::aTable, $data, "entity_id='" .$value->entity_id. "'");
        }
        $sql2 = "SELECT id,DATE_ADD(s.date_created, INTERVAL 1 DAY) as expired FROM " . self::smsTable . " s WHERE process=0 HAVING NOW() > expired order by s.date_created desc";
        $row2 = self::$db->fetch_all($sql2);
        foreach ($row2 as $key => $value) {
          $data2 = array(
              'process' => 1
          );
          $res = self::$db->update(self::smsTable, $data2, "id='" .$value->id. "'");
        }



      }
      public function CheckUserMobileSMS($code,$cid)
      {
        $sql = "SELECT * FROM " . self::smsTable . " a WHERE  customer_id ='" . $cid . "' ORDER BY date_created desc ";
        $row = self::$db->first($sql);

        // AND code ='" . $code . "'
        if($row){
          if($row->code==$code){
          $data = array(
              'accverify' => 1
          );
          $data2 = array(
              'process' => 1
          );
                    $res = self::$db->update(self::uTable, $data, "entity_id='" .$cid. "'");
                    $res = self::$db->update(self::smsTable, $data2, "code='" .$code. "'");
          return array('msg'=>'success');
        }
        else {
          return array('msg'=>'error');
        }
      }
        else {
          return array('msg'=>'error');
        }
      }

        public function generateUserMobileSMS($cid,$aid)
        {
        $sqlx = "SELECT *,DATE_ADD(s.date_created, INTERVAL 30 MINUTE) as expired FROM " . self::smsTable . " s  join ".self::aTable." a on s.address_id=a.entity_id WHERE  customer_id ='" . $cid . "' HAVING NOW() < expired";
        $rowx = self::$db->first($sqlx);
        if($rowx){
          return array('msg'=>'exist');
        }
        $tac=rand(pow(10,4), pow(10,5)-1);
        $sql = "SELECT * FROM " . self::aTable . " a WHERE  entity_id ='" . $aid . "' ";
        $row = self::$db->first($sql);
        $telnum=$row->telephone;
        //pre($row);

        $sendsms=1;
        $data = array(
      'customer_id' => $cid,
      'address_id' => $aid,
      'code' => $tac,
      'date_created' => "NOW()",
      'date_updated' => "NOW()",
);
    $telnum_new=str_replace("+","",$telnum);
    $curl_link = "http://www.etracker.cc/bulksms/send?user=TEST110&pass=@@Ox1992zz@@&type=0&to=".$telnum_new."&from=potboy&text=Potboy+TreasureBox.+Your+TAC+is+".$tac."&servid=mes01";
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
    if($xml->status!=200){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $curl_link);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // grab URL and pass it to the browser
      $curl_result2 = curl_exec($ch);
      // close cURL resource, and free up system resources
      curl_close($ch);
      $xml2=simplexml_load_string($curl_result2) or die("Error: Cannot create object");
    }
        $a=self::$db->insert(self::smsTable, $data);
        if($a){
          return array('msg'=>'success','tel'=>$telnum);
        }
        else {
          return array('msg'=>'error','tel'=>$telnum);
        }

        // $sql = "SELECT *,DATE_ADD(s.date_created, INTERVAL 30 MINUTE) as expired FROM " . self::smsTable . " s  join ".self::aTable." a on s.address_id=a.entity_id WHERE  customer_id ='" . $id . "' HAVING NOW() < expired";
        // $row = self::$db->first($sql);
        // return $row;
      }

        public function getUserMobile($id)
        {
        $sql = "SELECT default_shipping as ids FROM " . self::uTable . " WHERE  entity_id ='" . $id . "' AND default_shipping IS NOT NULL";
        $row = self::$db->first($sql);

        $lala="";
        $lili="";
        if($row){
          $lala=", (case
        when (a.entity_id = ".$row->ids.") THEN 1
   ELSE 0 END) as deek";
   $lili="  ORDER BY deek desc ";
        }
        $sql2 = "SELECT entity_id as id,telephone as phone $lala FROM " . self::aTable . " a WHERE parent_id ='" . $id . "' $lili ";
        $row2 = self::$db->fetch_all($sql2);
        if(!$row2){
        return [];
        }
        $default=[];
        $listnum=[];
        foreach ($row2 as $key => $value) {
          if($value->deek==1){
            $default=$value;
            unset($row2[$key]);
          }
        }
        if($default){
          foreach ($row2 as $key => $value) {
            if($value->phone==$default->phone){
              unset($row2[$key]);
            }
          }
          $listnum[$default->phone]=array('id' => $default->id,'default'=>'1');
        }

        foreach ($row2 as $key => $value) {
          $listnum[$value->phone]=array('id' => $value->id,'default'=>'0');
        }

        return $listnum;


      }

      private function getUserInfo($email)
      {
          $email = sanitize($email);
          $email = self::$db->escape($email);

          $sql = "SELECT * FROM " . self::uTable . " WHERE  email ='" . $email . "'";
          $row = self::$db->first($sql);
          if (!$email) {
              return false;
          }
          return ($row) ? $row : 0;
      }

      public function redirect($destroySession=false)
      {
          if ($destroySession) {
              session_regenerate_id(true);
              session_destroy();
          }
          header("Location: index.php");
          exit;
      }

      public function logout()
      {
          unset($_SESSION['email']);
          unset($_SESSION['name']);

          unset($_SESSION['userid']);
          unset($_SESSION['cookie_id']);
          session_destroy();
          session_regenerate_id();

          $this->logged_in = false;
          $this->email = "Guest";
          $this->userlevel = 0;
      }

      public function loginadmin($email, $pass, $rememberme=false)
      {
          if ($email == "" && $pass == "") {
              Filter::$msgs['email'] = "Please enter valid email and password.";
          } else {
              echo "string";
          }
      }

      public function login($email,$pass,$url)
      {


          if ($email == "" && $pass == "") {
              Filter::$msgs['email'] = "Please enter valid email and password.";
          } else {

//            pre($url);

            $status = $this->checkStatus($email, $pass);

              switch ($status) {
                  case 0:
                      Filter::$msgs['email'] ="Login and/or password did not match to the database.";
                      break;

                  case 1:
                      Filter::$msgs['email'] ="Your account has been banned.";
                      break;

                  case 2:
                      Filter::$msgs['email'] = "Your account it's not activated.";
                      break;

                  case 3:
                      Filter::$msgs['email'] = "You need to verify your email address.";
                      break;
              }
          }
          if (empty(Filter::$msgs) && $status == 5) {
              $row = $this->getUserInfo($email);
              $this->uid = $_SESSION['userid'] = $row->entity_id;
              $this->email = $_SESSION['email'] = $row->email;
              $this->name = $_SESSION['name'] = $row->firstname." ".$row->middlename." ".$row->lastname;
              $this->userlevel = $_SESSION['userlevel'] = 1;
              $this->cookie_id = $_SESSION['cookie_id'] = $this->generateRandID();
              return 'success';
          } else {
              return Filter::msgStatus();
          }
      }


      public function userDetail($id)
      {
          $sql = "SELECT * FROM " . self::uTable . "  where id='$id'";
          $row = self::$db->first($sql);
          return $row;
      }

      public function presaleId($id)
      {
          $sql = "SELECT * FROM " . self::uTable . "  where oldid='$id'";
          $row = self::$db->first($sql);
          return $row;
      }

      public function checkStatus($email, $pass)
      {

          $email = sanitize($email);
          $email = self::$db->escape($email);
          $pass = sanitize($pass);



          $sql = "SELECT * FROM " . self::uTable
      . "\n WHERE email = '" . $email . "'";
          $result = self::$db->query($sql);
          if (self::$db->numrows($result) == 0) {
              return 0;
          }
          $row = self::$db->fetch($result);
          $error='';
          $userData = array("username" =>$email, "password" => $pass);
          $ch = curl_init("http://potboy.com.my/index.php/rest/V1/integration/customer/token");
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Lenght: " . strlen(json_encode($userData))));
          $token = curl_exec($ch);
          $obj = json_decode($token);
          if (isset($obj->message)) {
              return 0;
          }
          if (!$error) {
              return 5;
          }
      }


      public function isUser()
      {
          return ($this->userlevel == 1);
      }

      public function isAdmin()
      {
          return ($this->userlevel == 2);
      }

      public function isSale()
      {
          return ($this->userlevel == 3);
      }

      public function confirmUserID($email, $cookie_id)
      {
          $sql = "SELECT cookie_id FROM users WHERE email = '" . self::$db->escape($email) . "'";
          $result = self::$db->query($sql);
          if (!$result || (self::$db->numrows($result) < 1)) {
              return 1;
          }

          $row = self::$db->fetch($result);
          $row->cookie_id = sanitize($row->cookie_id);
          $cookie_id = sanitize($cookie_id);

          if ($cookie_id == $row->cookie_id) {
              return 0;
          } else {
              return 2;
          }
      }

      public function getUserLevel($id)
      {
          switch ($id) {
          case 1:
            return "Administrator";
            break;

            case 2:
              return "Manager";
              break;
              case 3:
                return "Sale Person";
                break;

        }
      }

      public function getActiveStatus($id)
      {
          switch ($id) {
          case 'y':
            return "Active";
            break;

            case 'n':
              return 'Not Active';
              break;

              case 't':
                return 'Terminate';
                break;

                case 'b':
                  return 'Banned';
                  break;

        }
      }

      public function getUserbyID($id)
      {
          $sql = "SELECT * FROM " . self::uTable . " WHERE entity_id = '" . $id."'";
          $row = self::$db->first($sql);
          if (!$id) {
              return false;
          }

          return ($row) ? $row : 0;
      }


      public function getUserbyemail($email)
      {
          $sql = "SELECT * FROM " . self::uTable . " WHERE email = '" . $email."'";
          $row = self::$db->first($sql);
          if (!$email) {
              return false;
          }

          return ($row) ? $row : 0;
      }


      public function getAllUsersSearch($name, $email, $usertype, $contactnumber, $status, $sorting)
      {
          $a='';
          if ($name!='') {
              $a.="AND fullname LIKE '%$name%'";
          }

          if ($email!='') {
              $a.="AND email LIKE '%$email%'";
          }

          if ($contactnumber!='') {
              $a.="AND phonenumber LIKE '%$contactnumber%'";
          }

          if ($usertype!=''&&$usertype!='0') {
              $a.="AND userlevel = '$usertype'";
          }


          if ($status!='0') {
              if ($status!='') {
                  $a.="AND active = '$status'";
              } else {
                  $a.="AND active = 'y'";
              }
          }



          if ($sorting!=''&&$sorting!='0') {
              $a.="ORDER BY $sorting";
          }


  // echo "<br>email[".$email."]";
  // echo " <br>usertype[".$usertype."]";
  // echo "<br>status[".$status."]";

$sql = "SELECT *"
. "\n FROM " . self::uTable . " WHERE TRUE $a";
          $row = self::$db->fetch_all($sql);
          $a=ObjtoArr($row);
          return $a;
      }



      public function getAllUsers()
      {
          $sql = "SELECT u.*"
. "\n FROM " . self::uTable . " as u";
          $row = self::$db->fetch_all($sql);
          $a=ObjtoArr($row);
          return $a;
      }


      public function getAllAdmin()
      {
          $sql = "SELECT u.*"
. "\n FROM " . self::uTable . " as u WHERE u.userlevel = 1 AND not id = '".$_SESSION['userid']."'";
          $row = self::$db->fetch_all($sql);
          return $row;
      }

      public function getAllManager()
      {
          $sql = "SELECT u.*"
. "\n FROM " . self::uTable . " as u WHERE u.userlevel = 2 AND not id = '".$_SESSION['userid']."'";
          $row = self::$db->fetch_all($sql);
          return $row;
      }

      public function getAllSale($not=false)
      {
          $a="";

          if ($not=='1') {
              $a="AND not id = '".$_SESSION['userid']."' ";
          }
          $sql = "SELECT *"
. "\n FROM " . self::uTable . " WHERE userlevel ='3' AND not id ='36' $a";
          $row = self::$db->fetch_all($sql);
          return $row;
      }

      public function getAllSaleleads($not=false)
      {
          $a="";

          if ($not=='1') {
              $a="AND not id = '".$_SESSION['userid']."' ";
          }
          $sql = "SELECT *"
. "\n FROM " . self::uTable . " WHERE userlevel ='3' AND not id ='36' AND not leads ='0' $a";
          $row = self::$db->fetch_all($sql);
          return $row;
      }

      private function validateToken($token)
      {
          $token = sanitize($token, 40);
          $sql = "SELECT token"
. "\n FROM " . self::uTable
. "\n WHERE token ='" . self::$db->escape($token) . "'"
. "\n LIMIT 1";
          $result = self::$db->query($sql);

          if (self::$db->numrows($result)) {
              return 1;
          }
      }


      private function getUniqueCode($length = "")
      {
          $code = sha1(uniqid(rand(), true));
          if ($length != "") {
              return substr($code, 0, $length);
          } else {
              return $code;
          }
      }

      private function generateRandID()
      {
          return sha1($this->getUniqueCode(24));
      }
      public function levelCheck($levels)
      {
          $m_arr = explode(",", $levels);
          reset($m_arr);

          if ($this->logged_in and in_array($this->userlevel, $m_arr)) {
              return 1;
          }
      }

      private function isValidEmail($email)
      {
          if (function_exists('filter_var')) {
              if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  return 1;
              } else {
                  return 0;
              }
          } else {
              return preg_match('/^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email);
          }
      }


      private function emailExists($email)
      {
          $sql = self::$db->query("SELECT email"
. "\n FROM " . self::uTable
. "\n WHERE email = '" . sanitize($email) . "'"
. "\n LIMIT 1");

          if (self::$db->numrows($sql) == 1) {
              return 1;
          } else {
              return 0;
          }
      }

      private function exEmailExists($oldemail, $newemail)
      {
          $sql = self::$db->query("SELECT email"
. "\n FROM " . self::uTable
. "\n WHERE email != '" . sanitize($oldemail) . "' AND email='" . sanitize($newemail) . "'"
. "\n LIMIT 1");

          if (self::$db->numrows($sql) == 1) {
              return 1;
          } else {
              return 0;
          }
      }


      public function getUserData()
      {
          $sql = "SELECT *, DATE_FORMAT(created, '%a. %d, %M %Y') as cdate,"
. "\n DATE_FORMAT(lastlogin, '%a. %d, %M %Y') as ldate"
. "\n FROM " . self::uTable
. "\n WHERE id = " . $this->uid;
          $row = self::$db->first($sql);

          return ($row) ? $row : 0;
      }


      public function edit()
      {
          Filter::checkPost('email', 'Please Enter Valid Email Address');
          $old=$this->getUserbyID(Filter::$id);
          if ($this->exEmailExists($old->email, $_POST['email'])) {
              Filter::$msgs['email'] = 'Entered Email Address Is Not Valid.';
          }

          if (!$this->isValidEmail($_POST['email'])) {
              Filter::$msgs['email'] = 'Entered Email Address Is Not Valid.';
          }
          if (isset($_POST['address'])) {
              $address=$_POST['address'];
          } else {
              $address='';
          }


          Filter::checkPost('fullname', 'Full Name');
//Filter::checkPost('leads','Leads Per Round');
if (!$_POST['leads']||!isset($_POST['leads'])) {
    $leads=0;
} else {
    $leads=$_POST['leads'];
    if ($leads=="") {
        $leads=0;
    }
}
          Filter::checkPost('phonenumber', 'Phone Number');
          Filter::checkPost('userlevel', 'userlevel');
          Filter::checkPost('active', 'active');

          if (isset($_POST['password'])) {
              if ($_POST['password']=='') {
                  $passwd=$old->password;
              } else {
                  if (strlen($_POST['password']) < 6) {
                      Filter::$msgs['password'] ='Password is too short (less than 6 characters long)' ;
                  } elseif (!preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z]).*$/", ($_POST['password'] = trim($_POST['password'])))) {
                      Filter::$msgs['password'] = 'Password must contain at least one lower, one upper case letter and one digit.';
                  } else {
                      $passwd=sha1($_POST['password']);
                  }
              }
          } else {
              $passwd=$old->password;
          }

// Filter::checkPost('password','Please Enter Valid Password.');






    if (isset($_POST['target'])&&$_POST['target']!='') {
        $target=$_POST['target'];
    }


          if (empty(Filter::$msgs)) {
              $token = (Registry::get("Core")->reg_verify == 1) ? $this->generateRandID() : 0;
              $pass = sanitize($_POST['password']);
              $active = sanitize($_POST['active']);

              $data = array(
            'email' => strtolower(sanitize($_POST['email'])),
            'fullname' => strtolower(sanitize($_POST['fullname'])),
            'phonenumber' => strtolower(sanitize($_POST['phonenumber'])),
            'password' => $passwd,
            'userlevel' => strtolower(sanitize($_POST['userlevel'])),
            'token' => $token,

            'address' =>sanitize($address),
            'leads' =>$leads,
              'target' =>$target,
            'active' => $active,
            'created' => "NOW()",
            'updated' => "NOW()",

    );


              (Filter::$id) ? self::$db->update(self::uTable, $data, "id=" . Filter::$id) : $last_id = self::$db->insert(self::uTable, $data);


              if (self::$db->affected()) {
                  $json['type'] = 'OK';
                  $json['title'] = 'Success';
                  $json['message'] = 'the User have successfully registered.';
                  return json_encode($json);
              } else {
                  $json['type'] = 'error';
                  $json['title'] = 'Error';
                  $json['message'] = 'There was an error during registration process. Please contact the administrator...';
                  return json_encode($json);
              }
          } else {
              $json['type'] = 'ERROR';
              $json['title'] = 'Please complete the following fields:';
              $json['message'] = Filter::msgSingleStatus();
              return json_encode($json);
          }
      }

      public function register()
      {
          Filter::checkPost('email', 'Please Enter Valid Email Address');
          if ($this->emailExists($_POST['email'])) {
              Filter::$msgs['email'] = 'Entered Email Address Is Not Valid.';
          }
          if (!$this->isValidEmail($_POST['email'])) {
              Filter::$msgs['email'] = 'Entered Email Address Is Not Valid.';
          }

          if (isset($_POST['address'])) {
              $address=$_POST['address'];
          } else {
              $address='';
          }
          $leads=1;
          if (isset($_POST['leads'])&&$_POST['leads']!='') {
              $leads=$_POST['leads'];
          }

          $target=100000;
          if (isset($_POST['target'])&&$_POST['target']!='') {
              $target=$_POST['target'];
          }


          Filter::checkPost('fullname', 'Full Name');
          Filter::checkPost('phonenumber', 'Phone Number');
          Filter::checkPost('userlevel', 'userlevel');
          Filter::checkPost('target', 'Sale Target');
          Filter::checkPost('active', 'active');




          Filter::checkPost('password', 'Please Enter Valid Password.');
          if (strlen($_POST['password']) < 6) {
              Filter::$msgs['password'] ='Password is too short (less than 6 characters long)' ;
          } elseif (!preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z]).*$/", ($_POST['password'] = trim($_POST['password'])))) {
              Filter::$msgs['password'] = 'Password must contain at least one lower, one upper case letter and one digit.';
          }




          if (empty(Filter::$msgs)) {
              $token = (Registry::get("Core")->reg_verify == 1) ? $this->generateRandID() : 0;
              $pass = sanitize($_POST['password']);
              $active = sanitize($_POST['active']);

              $data = array(
            'email' => strtolower(sanitize($_POST['email'])),
              'fullname' => strtolower(sanitize($_POST['fullname'])),
            'phonenumber' => strtolower(sanitize($_POST['phonenumber'])),
            'password' => sha1($_POST['password']),
            'userlevel' => strtolower(sanitize($_POST['userlevel'])),
            'token' => $token,
            'address' =>sanitize($address),
            'leads' =>$leads,
            'target' =>$target,
            'active' => $active,
            'created' => "NOW()"
    );




              self::$db->insert(self::uTable, $data);


              if (self::$db->affected()) {
                  $json['type'] = 'OK';
                  $json['title'] = 'Success';
                  $json['message'] = 'the User have successfully registered.';
                  return json_encode($json);
              } else {
                  $json['type'] = 'error';
                  $json['title'] = 'Error';
                  $json['message'] = 'There was an error during registration process. Please contact the administrator...';
                  return json_encode($json);
              }
          } else {
              $json['type'] = 'ERROR';
              $json['title'] = 'Please complete the following fields:';
              $json['message'] = Filter::msgSingleStatus();
              return json_encode($json);
          }
      }


      public function deleteUser($id)
      {
          //$res = self::$db->delete(self::uTable,'id='.$id);
$data = array(
    'active' => 'n'
);
          $res = self::$db->update(self::uTable, $data, "id='" .$id. "'");


          $title="Deleted";
          if ($res) :
$json['type'] = 'OK';
          $json['title'] = 'OK';
          $json['message'] =  "User have been ".$title; else :
$json['type'] = 'ERROR';
          $json['title'] = Core::$word->ALERT;
          $json['message'] = Core::$word->SYSTEM_PROCCESS;
          endif;
          return json_encode($json);
      }
  }
