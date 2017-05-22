<?php
set_time_limit(0);
ini_set('memory_limit', '-1');

if (!defined('_VALID_PHP')) {
    die('Direct access to this location is not allowed.');
}
use Httpful\Request;

class Fazrin
{
    const tb_hs = 'aa_homeslider';
    const tb_an = 'aa_announcement';
    const tb_dr = 'aa_dailyreward';
    const tb_wof = 'aa_fortune';
    const tb_cr = 'aa_conversion';
    const tb_prod = 'aa_product';
    const tb_spon = 'aa_sponsor';
    const tb_bid = 'aa_bidding';
    const tb_bidtrans = 'aa_bidding_transaction';
    const tb_claim = 'aa_instantclaim';
    const tb_vouc = 'aa_voucher';
    const tb_wish = 'aa_wishlist';
    const tb_wishProd = 'aa_wishlistProduct';
    const tb_wishVote = 'aa_wishlistVote';
    const tb_user = 'customer_entity';
    const tb_userAdd = 'customer_address_entity';
    const tb_reward = 'lof_rewardpoints_customer';
    const tb_credit = 'customer_credit';
    const tb_rewardTrans = 'lof_rewardpoints_transaction';


    private static $db;

    public static $allowedType = array(
      "image/jpeg",
      "image/jpg",
      "image/pjpeg",
      "image/x-png",
      "image/png"
    );

    public function __construct()
    {
        self::$db = Registry::get('Database');
    }

    function GetXlsScript($FileName)
    {
        $detecterror    = 0;
        $location       = array();
        $rowData        = array();
        include '../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';

        try
        {
            $inputFileType  = PHPExcel_IOFactory::identify($FileName);
            $objReader      = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel    = $objReader->load($FileName);
        }
        catch (Exception $e)
        {
            die('Error loading file "' . pathinfo($FileName, PATHINFO_BASENAME).'": ' . $e->getMessage());
        }

        $sheet          = $objPHPExcel->getSheet(0);
        $highestRow     = $sheet->getHighestRow();
        $highestColumn  = $sheet->getHighestDataColumn();//getHighestColumn();
        $highestColumnIndex = $sheet->getHighestDataColumn();//$sheet->columnIndexFromString($highestColumm);

        if($detecterror == 0)
        {
            for ($row = 1; $row <= $highestRow; $row++)
            {
                $oriData        = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                $oriData_flat   = array_flatten($oriData);

                //final array to be return
                $rowData[]      = $oriData_flat;
            }
        }

        return $rowData;
    }

    /********* HOME SLIDER **********************************************/

    public function create_slide()
    {
      $_SESSION['noti_slider'] = '';
      $title = sanitize($_POST['title']);

      if($_FILES['image_slide']['error'] != 0){
        $_SESSION['noti_slider']['status'] = 'error';
        $_SESSION['noti_slider']['msg'] = 'Problem with the uploaded file.';
      }else{
        $img_tmp = $_FILES['image_slide']['tmp_name'];
        $img_name = $_FILES['image_slide']['name'];
        $save_name = 'homeslider-'.date("Ymdhis").uniqid().'.jpg';

        $data = array(
          'title' => $title,
          'prio' => 99999,
          'publish' => 1,
          'img_name' => $save_name,
          'date_updated' => 'now()',
          'date_created' => 'now()'
        );
        $res = self::$db->insert(self::tb_hs, $data);
        if(!$res){
          $_SESSION['noti_slider']['status'] = 'error';
          $_SESSION['noti_slider']['msg'] = 'Problem occured while inserting data.';
        }else{
          if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
            $_SESSION['noti_slider']['status'] = 'success';
            $_SESSION['noti_slider']['msg'] = 'New home slider created.';
          }else{
            $_SESSION['noti_slider']['status'] = 'error';
            $_SESSION['noti_slider']['msg'] = 'Problem occured while uploading file.';
          }
        }
      }

      rd('../admin-homeslider.php');
      die;

    }

    public function update_slide()
    {
      $_SESSION['noti_slider'] = '';
      $title = sanitize($_POST['title']);
      $publish = $_POST['publish'];
      $id = $_POST['id'];

      $data = array(
        'title' => $title,
        'publish' => $publish,
        'date_updated' => 'now()'
      );
      $res = self::$db->update(self::tb_hs, $data,"id='$id'");
      if(!$res){
        $_SESSION['noti_slider']['status'] = 'error';
        $_SESSION['noti_slider']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti_slider']['status'] = 'success';
        $_SESSION['noti_slider']['msg'] = 'Home slider updated.';

        if(isset($_FILES)){
          if($_FILES['image_slide']['error'] == 0){

            $img_tmp = $_FILES['image_slide']['tmp_name'];
            $img_name = $_FILES['image_slide']['name'];
            $save_name = 'homeslider-'.date("Ymdhis").uniqid().'.jpg';

            if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){

              $data = array(
                'img_name' => $save_name
              );
              $res = self::$db->update(self::tb_hs, $data,"id='$id'");

              $_SESSION['noti_slider']['status'] = 'success';
              $_SESSION['noti_slider']['msg'] = 'Home slider updated.';
            }else{
              $_SESSION['noti_slider']['status'] = 'error';
              $_SESSION['noti_slider']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }
      }

      rd('../admin-homeslider.php');
      die;

    }

    public function getHomeSlider()
    {
      $sql = "SELECT * FROM ".self::tb_hs." WHERE active = 1 ORDER BY prio";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function sort_homeslider()
    {

      $sortc = !empty($_POST['sortc']) ? $_POST['sortc'] : array() ;

    	$countc = 1;
    	foreach ($sortc as $id)
    	{
    		$data = array(
    			"prio" => $countc,
    		);

        $res = self::$db->update(self::tb_hs, $data,"id='$id'");

    		$countc++;
    	}

    }

    /********* ANNOUNCEMENT **********************************************/

    public function create_announcement()
    {
      $title = sanitize($_POST['title']);
      $prio = $_POST['prio'];
      $content = sanitize($_POST['content']);

      $data = array(
        'title' => $title,
        'prio' => 9999,
        'publish' => 1,
        'content' => $content,
        'date_updated' => 'now()',
        'date_created' => 'now()'
      );
      $res = self::$db->insert(self::tb_an, $data);
      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while inserting data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'New announcement created.';
      }
      rd('../admin-announcement.php');
      die;

    }

    public function update_announcement()
    {
      $id = $_POST['id'];
      $title = sanitize($_POST['title']);
      $content = sanitize($_POST['content']);
      $publish = $_POST['publish'];

      $data = array(
        'title' => $title,
        'publish' => $publish,
        'content' => $content,
        'date_updated' => 'now()'
      );
      $res = self::$db->update(self::tb_an, $data,"id='$id'");
      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Data announcement updated.';
      }
      rd('../admin-announcement.php');
      die;

    }

    public function sort_announcement()
    {

      $sortc = !empty($_POST['sortc']) ? $_POST['sortc'] : array() ;

    	$countc = 1;
    	foreach ($sortc as $id)
    	{
    		$data = array(
    			"prio" => $countc,
    		);

        $res = self::$db->update(self::tb_an, $data,"id='$id'");

    		$countc++;
    	}

    }

    public function getAnnouncement()
    {
      $sql = "SELECT * FROM ".self::tb_an." WHERE active = 1 ORDER BY prio";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getAnnouncementByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_an." where id='$id'";
      $row = self::$db->first($sql);

      echo json_encode($row);
    }

    /********* DAILY REWARD **********************************************/

    public function create_dailyreward()
    {
      $day = $_POST['day'];

      $check_day = $this->getDailyRewardByDay($day);

      if($check_day){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Package for <b>Day '.$day.'</b> already exist !';
      }else{
        $spin_check = isset($_POST['spin_check'])? 1 : 0;
        $gold_check = isset($_POST['gold_check'])? 1 : 0;
        $spin_amount = 0;
        $gold_amount = 0;

        if($spin_check){
          $spin_amount = $_POST['spin_amount'];
        }

        if($gold_check){
          $gold_amount = $_POST['gold_amount'];
        }

        $data = array(
          'day_num' => $day,
          'gold_check' => $gold_check,
          'gold_amount' => $gold_amount,
          'spin_check' => $spin_check,
          'spin_amount' => $spin_amount,
          'date_updated' => 'now()',
          'date_created' => 'now()'
        );
        $res = self::$db->insert(self::tb_dr, $data);
        if(!$res){
          $_SESSION['noti']['status'] = 'error';
          $_SESSION['noti']['msg'] = 'Problem occured while inserting data.';
        }else{
          $_SESSION['noti']['status'] = 'success';
          $_SESSION['noti']['msg'] = 'New daily reward package created.';
        }
      }

      rd('../admin-dailyreward.php');
      die;
    }

    public function update_dailyreward()
    {
      $id = $_POST['id'];
      $day = $_POST['day'];

      $spin_check = isset($_POST['spin_check'])? 1 : 0;
      $gold_check = isset($_POST['gold_check'])? 1 : 0;
      $spin_amount = 0;
      $gold_amount = 0;

      if($spin_check){
        $spin_amount = $_POST['spin_amount'];
      }

      if($gold_check){
        $gold_amount = $_POST['gold_amount'];
      }

      $data = array(
        'day_num' => $day,
        'gold_check' => $gold_check,
        'gold_amount' => $gold_amount,
        'spin_check' => $spin_check,
        'spin_amount' => $spin_amount,
        'date_updated' => 'now()'
      );
      $res = self::$db->update(self::tb_dr, $data, "id='$id'");
      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Daily reward package updated.';
      }

      rd('../admin-dailyreward.php');
      die;
    }

    public function getDailyReward()
    {
      $sql = "SELECT * FROM ".self::tb_dr." WHERE active = 1 ORDER BY day_num";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getDailyRewardByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_dr." where id='$id'";
      $row = self::$db->first($sql);

      echo json_encode($row);
    }

    public function getDailyRewardByDay($day)
    {
      $sql = "SELECT * FROM ".self::tb_dr." where day_num='$day' AND active = 1";
      $row = self::$db->first($sql);

      return $row;
    }

    /********* WHEEL OF FORTUNE **********************************************/

    public function create_wof()
    {
      $_SESSION['noti'] = '';
      $type = $_POST['wof_type'];
      $amount = $_POST['wof_amount'];
      $percent = $_POST['wof_percent'];

      if($_FILES['wof_icon']['error'] != 0){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem with the uploaded file.';
      }else{
        $img_tmp = $_FILES['wof_icon']['tmp_name'];
        $img_name = $_FILES['wof_icon']['name'];
        $save_name = 'woficon-'.date("Ymdhis").uniqid().'.jpg';

        $data = array(
          'wof_type' => $type,
          'wof_prio' => 9999,
          'wof_amount' => $amount,
          'wof_percent' => $percent,
          'wof_icon' => $save_name,
          'date_updated' => 'now()',
          'date_created' => 'now()'
        );
        $res = self::$db->insert(self::tb_wof, $data);
        if(!$res){
          $_SESSION['noti']['status'] = 'error';
          $_SESSION['noti']['msg'] = 'Problem occured while inserting data.';
        }else{
          if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
            $_SESSION['noti']['status'] = 'success';
            $_SESSION['noti']['msg'] = 'New daily reward package created.';
          }else{
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
          }
        }
      }

      rd('../admin-dailyreward.php');
      die;
    }

    public function update_wof()
    {
      $_SESSION['noti'] = '';
      $type = $_POST['wof_type'];
      $amount = $_POST['wof_amount'];
      $percent = $_POST['wof_percent'];
      $id = $_POST['id'];

      $data = array(
        'wof_type' => $type,
        'wof_amount' => $amount,
        'wof_percent' => $percent,
        'date_updated' => 'now()'
      );
      $res = self::$db->update(self::tb_wof, $data,"id='$id'");
      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Daily reward package updated.';

        if(isset($_FILES)){
          if($_FILES['wof_icon']['error'] == 0){

            $img_tmp = $_FILES['wof_icon']['tmp_name'];
            $img_name = $_FILES['wof_icon']['name'];
            $save_name = 'homeslider-'.date("Ymdhis").uniqid().'.jpg';

            if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){

              $data = array(
                'wof_icon' => $save_name
              );
              $res = self::$db->update(self::tb_wof, $data,"id='$id'");

              $_SESSION['noti']['status'] = 'success';
              $_SESSION['noti']['msg'] = 'Daily reward package updated.';
            }else{
              $_SESSION['noti']['status'] = 'error';
              $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }
      }
      rd('../admin-dailyreward.php');
      die;

    }

    public function getWof()
    {
      $sql = "SELECT * FROM ".self::tb_wof." WHERE active = 1 ORDER BY wof_prio";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getWofByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_wof." where id='$id'";
      $row = self::$db->first($sql);

      echo json_encode($row);
    }

    public function sort_wof()
    {

      $sortc = !empty($_POST['sortc']) ? $_POST['sortc'] : array() ;

    	$countc = 1;
    	foreach ($sortc as $id)
    	{
    		$data = array(
    			"wof_prio" => $countc,
    		);

        $res = self::$db->update(self::tb_wof, $data,"id='$id'");

    		$countc++;
    	}

    }

    /********* CONVERSION RATE **********************************************/

    public function create_conversion()
    {
      $_SESSION['noti'] = '';
      $package_name = sanitize($_POST['package_name']);
      $diamond_amount = $_POST['diamond_amount'];
      $gold_amount = $_POST['gold_amount'];

      if($_FILES['package_image']['error'] != 0){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem with the uploaded file.';
      }else{
        $img_tmp = $_FILES['package_image']['tmp_name'];
        $img_name = $_FILES['package_image']['name'];
        $save_name = 'conversion-'.date("Ymdhis").uniqid().'.jpg';

        $data = array(
          'name' => $package_name,
          'prio' => 9999,
          'icon' => $save_name,
          'diamond_amount' => $diamond_amount,
          'gold_amount' => $gold_amount,
          'date_updated' => 'now()',
          'date_created' => 'now()'
        );
        $res = self::$db->insert(self::tb_cr, $data);
        if(!$res){
          $_SESSION['noti']['status'] = 'error';
          $_SESSION['noti']['msg'] = 'Problem occured while inserting data.';
        }else{
          if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
            $_SESSION['noti']['status'] = 'success';
            $_SESSION['noti']['msg'] = 'New conversion rate package created.';
          }else{
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
          }
        }
      }

      rd('../admin-conversion.php');
      die;

    }

    public function update_conversion()
    {
      $_SESSION['noti'] = '';
      $package_name = sanitize($_POST['package_name']);
      $diamond_amount = $_POST['diamond_amount'];
      $gold_amount = $_POST['gold_amount'];
      $id = $_POST['id'];

      $data = array(
        'name' => $package_name,
        'diamond_amount' => $diamond_amount,
        'gold_amount' => $gold_amount,
        'date_updated' => 'now()',
      );
      $res = self::$db->update(self::tb_cr, $data,"id='$id'");
      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Conversion rate package updated.';

        if(isset($_FILES)){
          if($_FILES['package_image']['error'] == 0){

            $img_tmp = $_FILES['package_image']['tmp_name'];
            $img_name = $_FILES['package_image']['name'];
            $save_name = 'homeslider-'.date("Ymdhis").uniqid().'.jpg';

            if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){

              $data = array(
                'icon' => $save_name
              );
              $res = self::$db->update(self::tb_cr, $data,"id='$id'");

              $_SESSION['noti']['status'] = 'success';
              $_SESSION['noti']['msg'] = 'Conversion rate package updated.';
            }else{
              $_SESSION['noti']['status'] = 'error';
              $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }
      }
      rd('../admin-conversion.php');
      die;
    }

    public function getConversion()
    {
      $sql = "SELECT * FROM ".self::tb_cr." WHERE active = 1 ORDER BY prio";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getConversionByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_cr." where id='$id'";
      $row = self::$db->first($sql);

      echo json_encode($row);
    }

    public function sort_conversion()
    {

      $sortc = !empty($_POST['sortc']) ? $_POST['sortc'] : array() ;

    	$countc = 1;
    	foreach ($sortc as $id)
    	{
    		$data = array(
    			"prio" => $countc,
    		);

        $res = self::$db->update(self::tb_cr, $data,"id='$id'");

    		$countc++;
    	}

    }

    /********* PRODUCT **********************************************/

    public function create_product()
    {
      $_SESSION['noti'] = '';
      $_SESSION['noti']['msg'] = '<ul>';
      $spon_id = $_POST['spon_id'];

      $fileTitle = array(
        'img_banner' => 'Image Banner',
        'img_header' => 'Image Header',
        'img_thumbnail' => 'Image Thumbnail'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0){
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-productlist.php?id='.$spon_id);
        die;
      }else{
        $_SESSION['noti']['msg'] = '';
        $name = sanitize($_POST['name']);
        $desc = sanitize($_POST['desc']);
        $price = $_POST['price'];

        $data = array(
          'name' => $name,
          'desc' => $desc,
          'price' => $price,
          'spon_id' => $spon_id,
          'date_created' => 'now()',
          'date_updated' => 'now()'
        );

        foreach($_FILES as $key_file => $eachfile){
          if($key_file != 'files'){
            $img_tmp = $_FILES[$key_file]['tmp_name'];
            $img_name = $_FILES[$key_file]['name'];
            $save_name = 'product-'.date("Ymdhis").uniqid().'.jpg';

            if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
              $data[$key_file] = $save_name;

              $_SESSION['noti']['status'] = 'success';
              $_SESSION['noti']['msg'] = 'New product created.';
            }else{
              $_SESSION['noti']['status'] = 'error';
              $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }

        $res = self::$db->insert(self::tb_prod, $data);
      }
      rd('../admin-productlist.php?id='.$spon_id);
      die;
    }

    public function update_product()
    {
      $spon_id = $_POST['spon_id'];
      $id = $_POST['id'];
      $_SESSION['noti'] = '';
      $_SESSION['noti']['msg'] = '<ul>';

      $fileTitle = array(
        'img_banner' => 'Image Banner',
        'img_header' => 'Image Header',
        'img_thumbnail' => 'Image Thumbnail'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0 && $eachfile['name'] != ''){
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-productlist.php?id='.$spon_id);
        die;
      }else{
        $_SESSION['noti']['msg'] = '';
        $name = sanitize($_POST['name']);
        $desc = sanitize($_POST['desc']);
        $price = $_POST['price'];

        $data = array(
          'name' => $name,
          'desc' => $desc,
          'price' => $price,
          'date_updated' => 'now()'
        );

        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Product updated.';

        foreach($_FILES as $key_file => $eachfile){
          if($key_file != 'files'){
            if($eachfile['name'] != ''){
              $img_tmp = $_FILES[$key_file]['tmp_name'];
              $img_name = $_FILES[$key_file]['name'];
              $save_name = 'product-'.date("Ymdhis").uniqid().'.jpg';

              if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
                $data[$key_file] = $save_name;

                $_SESSION['noti']['status'] = 'success';
                $_SESSION['noti']['msg'] = 'Product updated.';
              }else{
                $_SESSION['noti']['status'] = 'error';
                $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
              }
            }
          }
        }

        $res = self::$db->update(self::tb_prod, $data,"id='$id'");
      }

      rd('../admin-productlist.php?id='.$spon_id);
      die;
    }

    public function getProduct()
    {
      $sql = "SELECT * FROM ".self::tb_prod." WHERE active = 1";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getProductBySponsorID($id)
    {
      $sql = "SELECT * FROM ".self::tb_prod." WHERE spon_id = '$id' AND active = 1";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getProductByID($id)
    {
      $sql = "SELECT * FROM ".self::tb_prod." where id='$id'";
      $row = self::$db->first($sql);

      $row->desc = html_entity_decode($row->desc);

      return $row;
    }

    /********* SPONSOR **********************************************/

    public function create_sponsor()
    {
      $_SESSION['noti'] = '';
      $_SESSION['noti']['msg'] = '<ul>';

      $fileTitle = array(
        'img_logo' => 'Sponsor Logo'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0){
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-sponsor.php');
        die;
      }else{
        $_SESSION['noti']['msg'] = '';
        $name = sanitize($_POST['name']);
        $desc = sanitize($_POST['desc']);

        $data = array(
          'name' => $name,
          'desc' => $desc,
          'date_created' => 'now()',
          'date_updated' => 'now()'
        );

        foreach($_FILES as $key_file => $eachfile){
          if($key_file != 'files'){
            $img_tmp = $_FILES[$key_file]['tmp_name'];
            $img_name = $_FILES[$key_file]['name'];
            $save_name = 'sponsor-'.date("Ymdhis").uniqid().'.jpg';

            if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
              $data[$key_file] = $save_name;

              $_SESSION['noti']['status'] = 'success';
              $_SESSION['noti']['msg'] = 'New sponsor created.';
            }else{
              $_SESSION['noti']['status'] = 'error';
              $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }

        $res = self::$db->insert(self::tb_spon, $data);
      }
      rd('../admin-sponsor.php');
      die;
    }

    public function update_sponsor()
    {
      $id = $_POST['id'];
      $_SESSION['noti'] = '';
      $_SESSION['noti']['msg'] = '<ul>';

      $fileTitle = array(
        'img_logo' => 'Sponsor Logo'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0 && $eachfile['name'] != ''){
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-sponsor.php');
        die;
      }else{
        $_SESSION['noti']['msg'] = '';
        $name = sanitize($_POST['name']);
        $desc = sanitize($_POST['desc']);

        $data = array(
          'name' => $name,
          'desc' => $desc,
          'date_updated' => 'now()'
        );

        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Sponsor updated.';

        foreach($_FILES as $key_file => $eachfile){
          if($key_file != 'files'){
            if($eachfile['name'] != ''){
              $img_tmp = $_FILES[$key_file]['tmp_name'];
              $img_name = $_FILES[$key_file]['name'];
              $save_name = 'sponsor-'.date("Ymdhis").uniqid().'.jpg';

              if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
                $data[$key_file] = $save_name;

                $_SESSION['noti']['status'] = 'success';
                $_SESSION['noti']['msg'] = 'Sponsor updated.';
              }else{
                $_SESSION['noti']['status'] = 'error';
                $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
              }
            }
          }
        }

        $res = self::$db->update(self::tb_spon, $data,"id='$id'");
      }

      rd('../admin-sponsor.php');
      die;
    }

    public function getSponsor()
    {
      $sql = "SELECT * FROM ".self::tb_spon." WHERE active = 1";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getSponsorByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_spon." where id='$id'";
      $row = self::$db->first($sql);

      $row->desc = html_entity_decode($row->desc);

      echo json_encode($row);
    }

    public function getSponsorByID2($id)
    {
      $sql = "SELECT * FROM ".self::tb_spon." where id='$id'";
      $row = self::$db->first($sql);

      $row->desc = html_entity_decode($row->desc);

      return $row;
    }

    public function getSponsorProduct()
    {
      $idr = $_POST['idr'];
      $id_arr = explode(",",$idr);
      $out = array();
      foreach($id_arr as $id){
        $res = $this->getProductBySponsorID($id);
        $out = array_merge($out,$res);
      }
      $output = array();
      foreach($out as $key => $rows)
      {
        $output[] = array(
          "id" => $rows->id,
          "text" => $rows->name,
        );
      }

      echo json_encode($output);
    }

    /********* BIDDING **********************************************/

    public function create_bidding(){
      $title = $_POST['title'];
      $product_id = $_POST['product_id'];
      $start_time_date = $_POST['start_time_date'];
      $start_time_time = $_POST['start_time_time'];

      $date = DateTime::createFromFormat('d/m/Y h:i A', $start_time_date.' '.$start_time_time);
      $start_time = $date->format('Y-m-d H:i:s');

      $bid_type = $_POST['bid_type'];
      $min_bid = $_POST['min_bid'];
      $sponsor_id = json_encode($_POST['sponsor_id']);
      $bid_base = $_POST['bid_base'];

      $data = array(
        'title' => $title,
        'product_id' => $product_id,
        'start_time' => $start_time,
        'bid_base' => $bid_base,
        'bid_type' => $bid_type,
        'min_bid' => $min_bid,
        'sponsor' => $sponsor_id,
        'date_created' => 'now()',
        'date_updated' => 'now()'
      );

      if($bid_base == 1){
        $end_time_date = $_POST['end_time_date'];
        $end_time_time = $_POST['end_time_time'];

        $date2 = DateTime::createFromFormat('d/m/Y h:i A', $end_time_date.' '.$end_time_time);
        $end_time = $date2->format('Y-m-d H:i:s');

        $data['end_time'] = $end_time;

      }elseif($bid_base == 2){
        $max_participant = $_POST['max_participant'];

        $data['max_participant'] = $max_participant;
      }

      $res = self::$db->insert(self::tb_bid, $data);
      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while inserting data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'New bidding created.';
      }
      rd('../admin-bidding.php');
      exit;

    }

    public function update_bidding()
    {
      $id = $_POST['id'];
      $title = $_POST['title'];
      $product_id = $_POST['product_id'];
      $start_time_date = $_POST['start_time_date'];
      $start_time_time = $_POST['start_time_time'];

      $date = DateTime::createFromFormat('d/m/Y h:i A', $start_time_date.' '.$start_time_time);
      $start_time = $date->format('Y-m-d H:i:s');

      $bid_type = $_POST['bid_type'];
      $min_bid = $_POST['min_bid'];
      $sponsor_id = json_encode($_POST['sponsor_id']);
      $bid_base = $_POST['bid_base'];

      $data = array(
        'title' => $title,
        'product_id' => $product_id,
        'start_time' => $start_time,
        'bid_base' => $bid_base,
        'bid_type' => $bid_type,
        'min_bid' => $min_bid,
        'sponsor' => $sponsor_id,
        'date_created' => 'now()',
        'date_updated' => 'now()'
      );

      if($bid_base == 1){
        $end_time_date = $_POST['end_time_date'];
        $end_time_time = $_POST['end_time_time'];

        $date2 = DateTime::createFromFormat('d/m/Y h:i A', $end_time_date.' '.$end_time_time);
        $end_time = $date2->format('Y-m-d H:i:s');

        $data['end_time'] = $end_time;

      }elseif($bid_base == 2){
        $max_participant = $_POST['max_participant'];

        $data['max_participant'] = $max_participant;
      }

      $res = self::$db->update(self::tb_bid, $data,"id='$id'");
      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Bidding updated.';
      }
      rd('../admin-bidding.php');
      exit;
    }

    public function getBidding()
    {
      $sql = "SELECT * FROM ".self::tb_bid." WHERE active = 1";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getBiddingByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_bid." where id='$id'";
      $row = self::$db->first($sql);

      $start_time = $row->start_time;
      $start_time_date = date('d/m/Y',strtotime($start_time));
      $start_time_time = date('h:i A',strtotime($start_time));

      $row->start_time_date = $start_time_date;
      $row->start_time_time = $start_time_time;

      $end_time = $row->end_time;
      $end_time_date = date('d/m/Y',strtotime($end_time));
      $end_time_time = date('h:i A',strtotime($end_time));

      $row->end_time_date = $end_time_date;
      $row->end_time_time = $end_time_time;


      echo json_encode($row);
    }

    public function getBiddingByID2($id)
    {
      $sql = "SELECT * FROM ".self::tb_bid." where id='$id'";
      $row = self::$db->first($sql);

      $start_time = $row->start_time;
      $start_time_date = date('d/m/Y',strtotime($start_time));
      $start_time_time = date('h:i A',strtotime($start_time));

      $row->start_time_date = $start_time_date;
      $row->start_time_time = $start_time_time;

      $end_time = $row->end_time;
      $end_time_date = date('d/m/Y',strtotime($end_time));
      $end_time_time = date('h:i A',strtotime($end_time));

      $row->end_time_date = $end_time_date;
      $row->end_time_time = $end_time_time;


      return $row;
    }

    /********* BIDDING TRANSACTION **********************************************/

    public function getCurParticipant($bid_id)
    {
      $sql = "SELECT * FROM ".self::tb_bidtrans." WHERE bidding_id = '$bid_id' AND active = 1 ORDER BY bid_amount DESC";
      $row = self::$db->fetch_all($sql);

      return $row;
    }



    /********* CLAIM **********************************************/

    public function create_claim()
    {
      $_SESSION['noti'] = '';
      $_SESSION['noti']['msg'] = '<ul>';

      $fileTitle = array(
        'img_thumbnail' => 'Thumbnail Image',
        'img_header' => 'Header Image'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0){
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-instantclaim.php');
        die;
      }else{
        $_SESSION['noti']['msg'] = '';
        $title = sanitize($_POST['title']);
        $gold_amount = $_POST['gold_amount'];
        $price = $_POST['price'];
        $start_time_date = $_POST['start_time_date'];
        $start_time_time = $_POST['start_time_time'];

        $date = DateTime::createFromFormat('d/m/Y h:i A', $start_time_date.' '.$start_time_time);
        $start_time = $date->format('Y-m-d H:i:s');

        $data = array(
          'title' => $title,
          'gold_amount' => $gold_amount,
          'price' => $price,
          'start_time' => $start_time,
          'publish' => 0,
          'date_created' => 'now()',
          'date_updated' => 'now()'
        );

        foreach($_FILES as $key_file => $eachfile){
          if($key_file != 'files'){
            $img_tmp = $_FILES[$key_file]['tmp_name'];
            $img_name = $_FILES[$key_file]['name'];
            $save_name = 'claim-'.date("Ymdhis").uniqid().'.jpg';

            if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
              $data[$key_file] = $save_name;

              $_SESSION['noti']['status'] = 'success';
              $_SESSION['noti']['msg'] = 'New voucher claim created.';
            }else{
              $_SESSION['noti']['status'] = 'error';
              $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }

        $res = self::$db->insert(self::tb_claim, $data);
      }
      rd('../admin-instantclaim.php');
      die;
    }

    public function update_claim()
    {
      $id = $_POST['id'];
      $_SESSION['noti'] = '';
      $_SESSION['noti']['msg'] = '<ul>';

      $fileTitle = array(
        'img_thumbnail' => 'Thumbnail Image',
        'img_header' => 'Header Image'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0 && $eachfile['name'] != ''){
            $_SESSION['noti']['status'] = 'error';
            $_SESSION['noti']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-instantclaim.php');
        die;
      }else{
        $_SESSION['noti']['msg'] = '';
        $title = sanitize($_POST['title']);
        $gold_amount = $_POST['gold_amount'];
        $price = $_POST['price'];
        $start_time_date = $_POST['start_time_date'];
        $start_time_time = $_POST['start_time_time'];
        $publish = $_POST['publish'];

        $date = DateTime::createFromFormat('d/m/Y h:i A', $start_time_date.' '.$start_time_time);
        $start_time = $date->format('Y-m-d H:i:s');

        $data = array(
          'title' => $title,
          'gold_amount' => $gold_amount,
          'price' => $price,
          'start_time' => $start_time,
          'publish' => $publish,
          'date_updated' => 'now()'
        );

        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Voucher claim updated.';

        foreach($_FILES as $key_file => $eachfile){
          if($key_file != 'files'){
            if($eachfile['name'] != ''){
              $img_tmp = $_FILES[$key_file]['tmp_name'];
              $img_name = $_FILES[$key_file]['name'];
              $save_name = 'claim-'.date("Ymdhis").uniqid().'.jpg';

              if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
                $data[$key_file] = $save_name;

                $_SESSION['noti']['status'] = 'success';
                $_SESSION['noti']['msg'] = 'Voucher claim updated.';
              }else{
                $_SESSION['noti']['status'] = 'error';
                $_SESSION['noti']['msg'] = 'Problem occured while uploading file.';
              }
            }
          }
        }

        $res = self::$db->update(self::tb_claim, $data,"id='$id'");
      }

      rd('../admin-instantclaim.php');
      die;
    }

    public function getInstantClaim()
    {
      $sql = "SELECT * FROM ".self::tb_claim." WHERE active = 1";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getClaimByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_claim." where id='$id'";
      $row = self::$db->first($sql);

      $start_time = $row->start_time;
      $start_time_date = date('d/m/Y',strtotime($start_time));
      $start_time_time = date('h:i A',strtotime($start_time));

      $row->start_time_date = $start_time_date;
      $row->start_time_time = $start_time_time;

      echo json_encode($row);
    }

    public function getClaimByID2($id)
    {
      $sql = "SELECT * FROM ".self::tb_claim." where id='$id'";
      $row = self::$db->first($sql);

      $start_time = $row->start_time;
      $start_time_date = date('d/m/Y',strtotime($start_time));
      $start_time_time = date('h:i A',strtotime($start_time));

      $row->start_time_date = $start_time_date;
      $row->start_time_time = $start_time_time;

      return $row;
    }

    /********* VOUCHER **********************************************/

    public function checkVoucher($id,$code)
    {
      $sql = "SELECT * FROM ".self::tb_vouc." WHERE instantclaim_id = '$id' AND voucher_code = '$code' AND active = 1";
      $row = self::$db->first($sql);

      return $row ? 0 : 1;
    }

    public function update_voucher()
    {
      $id = $_POST['id'];
      $claim_id = $_POST['claim_id'];
      $voucher_code = sanitize($_POST['voucher_code']);

      if($this->checkVoucher($id,$voucher_code)){
        $data = array(
          'voucher_code' => $voucher_code,
          'date_updated' => 'now()'
        );

        $res = self::$db->update(self::tb_vouc, $data,"id='$id'");
        if(!$res){
          $_SESSION['noti']['status'] = 'error';
          $_SESSION['noti']['msg'] = 'Problem occured while updating data.';
        }else{
          $_SESSION['noti']['status'] = 'success';
          $_SESSION['noti']['msg'] = 'Voucher updated successfully.';
        }
      }else{
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Voucher code already exist !';
      }

      rd('../admin-voucher.php?id='.$claim_id);
      exit;
    }

    public function upload_voucher()
    {
      $id = $_POST['id'];
      $file_tmp = $_FILES['excel_voucher']['tmp_name'];
      $file_name = $_FILES['excel_voucher']['name'];


      $file_excel = $this->GetXlsScript($file_tmp);

      $res = true;
      foreach($file_excel as $key => $row){
        $voucher_code = $row[0];
        if($this->checkVoucher($id,$voucher_code)){

          $data = array(
            'instantclaim_id' => $id,
            'voucher_code' => $voucher_code,
            'date_created' => 'now()',
            'date_updated' => 'now()'
          );

          $res = self::$db->insert(self::tb_vouc, $data);
          if(!$res){
            break;
          }
        }
      }

      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while inserting data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Voucher imported successfully.';
      }
      rd('../admin-voucher.php?id='.$id);
      exit;
    }

    public function getVoucherByClaimID($id)
    {
      $sql = "SELECT * FROM ".self::tb_vouc." WHERE instantclaim_id = '$id' AND active = 1 ORDER BY voucher_code";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getTotalVoucher($id)
    {
      $sql = "SELECT * FROM ".self::tb_vouc." WHERE instantclaim_id = '$id' AND active = 1";
      $row = self::$db->query($sql);
      $num = self::$db->numrows($row);

      return $num;
    }

    public function getTotalVoucherClaimed($id)
    {
      $sql = "SELECT * FROM ".self::tb_vouc." WHERE instantclaim_id = '$id' AND cust_id <> 'NULL' AND active = 1";
      $row = self::$db->query($sql);
      $num = self::$db->numrows($row);

      return $num;
    }

    public function getVoucherByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_vouc." where id='$id'";
      $row = self::$db->first($sql);

      echo json_encode($row);
    }

    /********* WISHLIST **********************************************/

    public function create_wishlist()
    {
      $title = $_POST['title'];
      $time_month = $_POST['time_month'];
      $spon_id = $_POST['spon_id'];
      $wish_id = $_POST['wish_id'];
      $time_month = date('Y-m-d H:i:s',strtotime($time_month));

      if($wish_id == ''){
        $data = array(
          'spon_id' => $spon_id,
          'time_month' => $time_month,
          'title' => $title,
          'date_created' => 'now()',
          'date_updated' => 'now()'
        );

        $wish_id = self::$db->insert(self::tb_wish, $data);

        if($wish_id){
          $product_id = $_POST['product_id'];

          foreach($product_id as $key => $value){
            $data = array(
              'wish_id' => $wish_id,
              'product_id' => $value
            );

            $res = self::$db->insert(self::tb_wishProd, $data);
            if(!$res){
              $_SESSION['noti']['status'] = 'error';
              $_SESSION['noti']['msg'] = 'Problem occured while inserting data.';
            }else{
              $_SESSION['noti']['status'] = 'success';
              $_SESSION['noti']['msg'] = 'New wish list created successfully.';
            }
          }
        }
        rd('../admin-month.php?s='.$spon_id);
        exit;
      }else{
        $data = array(
          'time_month' => $time_month,
          'title' => $title,
          'date_updated' => 'now()'
        );

        $res = self::$db->update(self::tb_wish, $data,"id='$wish_id'");

        if($res){
          // pre($_POST);
          $product_id = empty($_POST['product_id']) ? array() : $_POST['product_id'];

          $cur_prod_id = $this->getProductIDbyWishID($wish_id);

          // pre($cur_prod_id);

          if(count($product_id) > 0){
            //part utk update/insert data product id
            foreach($product_id as $key => $value){
              $check = $this->checkProdIdExistWish($wish_id,$value);

              if($check){
                $data = array(
                  'active' => 1
                );

                $res = self::$db->update(self::tb_wishProd, $data,"id='$check'");
              }else{
                $data = array(
                  'wish_id' => $wish_id,
                  'product_id' => $value
                );

                $res = self::$db->insert(self::tb_wishProd, $data);
              }
            }

            // part utk delete dr db
            $prod_id = 0;
            foreach($cur_prod_id as $key => $row){
              $prod_id = $row->product_id;

              if(in_array($prod_id,$product_id)){
                //edit
              }else{
                $data = array(
                  'active' => 0
                );

                $res = self::$db->update(self::tb_wishProd, $data,"id='$row->id'");
              }

            }
          }else{
            $data = array(
              'active' => 0
            );

            $res = self::$db->update(self::tb_wishProd, $data,"wish_id='$wish_id'");
          }

        }

        rd('../admin-month.php?s='.$spon_id);
        exit;

      }
    }

    public function getWishByID($id)
    {
      $sql = "SELECT * FROM ".self::tb_wish." WHERE id='$id'";
      $row = self::$db->first($sql);

      return $row;
    }

    public function checkProdIdExistWish($wish_id,$prod_id)
    {
      $sql = "SELECT id FROM ".self::tb_wishProd." WHERE wish_id = '$wish_id' AND product_id = '$prod_id'";
      $row = self::$db->first($sql);

      return $row ? $row->id : 0;
    }

    public function getProductIDbyWishID($wish_id)
    {
      $sql = "SELECT * FROM ".self::tb_wishProd." WHERE wish_id = '$wish_id'";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getProductAndVote($wish_id)
    {
      $sql = "SELECT a.*,(SELECT COUNT(*) FROM ".self::tb_wishVote." b WHERE a.id = b.wp_id ) as vote FROM ".self::tb_wishProd." a WHERE wish_id = '$wish_id' ORDER BY vote DESC";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getWishListBySponID($spon_id)
    {
      $sql = "SELECT * FROM ".self::tb_wish." WHERE spon_id = '$spon_id' AND active = 1 ORDER BY time_month";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getProductByWishID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_wish." WHERE id='$id' ";
      $row = self::$db->first($sql);

      $row->time_month = date('M Y',strtotime($row->time_month));

      $sql2 = "SELECT a.*,b.name FROM ".self::tb_wishProd." a, ".self::tb_prod." b  WHERE a.product_id = b.id AND a.wish_id='$id' AND a.active = 1";
      $row2 = self::$db->fetch_all($sql2);

      $output = array();
      foreach($row2 as $key => $value){
        $output[] = $value->product_id;
      }
      $row->product = $output;

      $idspon = $_POST['idspon'];
      $out = $this->getProductBySponsorID($idspon);
      $output = array();
      foreach($out as $key => $rows)
      {
        $output[] = array(
          "id" => $rows->id,
          "text" => $rows->name,
        );
      }
      $row->productlist = $output;
      echo json_encode($row);

    }

    /********* VOTE **********************************************/

    public function getVoteCount($wp_id)
    {
      $sql = "SELECT count(*) as count FROM ".self::tb_wishVote." WHERE wp_id = '$wp_id'";
      $row = self::$db->first($sql);

      return $row->count;
    }

    public function getVoteByWpID($wp_id)
    {
      $sql = "SELECT a.*,b.* FROM ".self::tb_wishVote." a, ".self::tb_user." b WHERE a.user_id = b.entity_id AND wp_id = '$wp_id'";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    /********* USER **********************************************/

    public function getUsers()
    {
      $sql = "SELECT * FROM ".self::tb_user." WHERE is_active = 1";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getUserByID($id)
    {
      $sql = "SELECT * FROM ".self::tb_user." WHERE entity_id = '$id'";
      $row = self::$db->first($sql);

      return $row;
    }

    public function getUserDiamondTrans($id)
    {
      $sql = "SELECT * FROM ".self::tb_rewardTrans." WHERE amount <> 0 AND customer_id = '$id'";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getUserGoldTrans($id)
    {
      $sql = "SELECT * FROM ".self::tb_rewardTrans." WHERE amount_gold <> 0 AND customer_id = '$id'";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    /********* DELETE ITEM **********************************************/

    public function deleteItem($id,$table)
    {
      $res = self::$db->soft_delete($table, $id);

      if(!$res){
        $_SESSION['noti']['status'] = 'error';
        $_SESSION['noti']['msg'] = 'Problem occured while deleting data.';
      }else{
        $_SESSION['noti']['status'] = 'success';
        $_SESSION['noti']['msg'] = 'Data deleted successfully.';
      }
    }

    /********* FAKER **********************************************/

    public function fakeBid()
    {
      for($i = 0;$i < 40;$i++){

        $cus_id = rand(1,312);
        $bid_amount = rand(300,10000);

        $data = array(
          'bidding_id' => 1,
          'customer_id' => $cus_id,
          'bid_amount' => $bid_amount,
          'date_updated' => 'now()',
          'date_created' => 'now()'
        );
        $res = self::$db->insert(self::tb_bidtrans, $data);
      }
    }





}
