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
        $_SESSION['noti_slider']['status'] = 'error';
        $_SESSION['noti_slider']['msg'] = 'Problem occured while inserting data.';
      }else{
        $_SESSION['noti_slider']['status'] = 'success';
        $_SESSION['noti_slider']['msg'] = 'New announcement created.';
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
        $_SESSION['noti_slider']['status'] = 'error';
        $_SESSION['noti_slider']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti_slider']['status'] = 'success';
        $_SESSION['noti_slider']['msg'] = 'Data announcement updated.';
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

      if($day == $check_day->day_num){
        $_SESSION['noti_slider']['status'] = 'error';
        $_SESSION['noti_slider']['msg'] = 'Package for <b>Day '.$day.'</b> already exist !';
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
          $_SESSION['noti_slider']['status'] = 'error';
          $_SESSION['noti_slider']['msg'] = 'Problem occured while inserting data.';
        }else{
          $_SESSION['noti_slider']['status'] = 'success';
          $_SESSION['noti_slider']['msg'] = 'New daily reward package created.';
        }
      }
      rd('../admin-dailyreward.php');
      die;
    }

    public function update_dailyreward()
    {
      $id = $_POST['id'];
      $day = $_POST['day'];
      $check_day = $this->getDailyRewardByDay($day);

      if($day == $check_day->day_num){
        $_SESSION['noti_slider']['status'] = 'error';
        $_SESSION['noti_slider']['msg'] = 'Package for <b>Day '.$day.'</b> already exist !';
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
          'date_updated' => 'now()'
        );
        $res = self::$db->update(self::tb_dr, $data, "id='$id'");
        if(!$res){
          $_SESSION['noti_slider']['status'] = 'error';
          $_SESSION['noti_slider']['msg'] = 'Problem occured while updating data.';
        }else{
          $_SESSION['noti_slider']['status'] = 'success';
          $_SESSION['noti_slider']['msg'] = 'Daily reward package updated.';
        }
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
      $sql = "SELECT * FROM ".self::tb_dr." where day_num='$day'";
      $row = self::$db->first($sql);

      return $row;
    }

    /********* WHEEL OF FORTUNE **********************************************/

    public function create_wof()
    {
      $_SESSION['noti_wof'] = '';
      $prio = $_POST['wof_prio'];
      $type = $_POST['wof_type'];
      $amount = $_POST['wof_amount'];
      $percent = $_POST['wof_percent'];

      if($_FILES['wof_icon']['error'] != 0){
        $_SESSION['noti_wof']['status'] = 'error';
        $_SESSION['noti_wof']['msg'] = 'Problem with the uploaded file.';
      }else{
        $img_tmp = $_FILES['wof_icon']['tmp_name'];
        $img_name = $_FILES['wof_icon']['name'];
        $save_name = 'woficon-'.date("Ymdhis").uniqid().'.jpg';

        $data = array(
          'wof_type' => $type,
          'wof_prio' => $prio,
          'wof_amount' => $amount,
          'wof_percent' => $percent,
          'wof_icon' => $save_name,
          'date_updated' => 'now()',
          'date_created' => 'now()'
        );
        $res = self::$db->insert(self::tb_wof, $data);
        if(!$res){
          $_SESSION['noti_wof']['status'] = 'error';
          $_SESSION['noti_wof']['msg'] = 'Problem occured while inserting data.';
        }else{
          if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
            $_SESSION['noti_wof']['status'] = 'success';
            $_SESSION['noti_wof']['msg'] = 'New daily reward package created.';
          }else{
            $_SESSION['noti_wof']['status'] = 'error';
            $_SESSION['noti_wof']['msg'] = 'Problem occured while uploading file.';
          }
        }
      }

      rd('../admin-dailyreward.php');
      die;
    }

    public function update_wof()
    {
      $_SESSION['noti_wof'] = '';
      $prio = $_POST['wof_prio'];
      $type = $_POST['wof_type'];
      $amount = $_POST['wof_amount'];
      $percent = $_POST['wof_percent'];
      $id = $_POST['id'];

      $data = array(
        'wof_type' => $type,
        'wof_prio' => $prio,
        'wof_amount' => $amount,
        'wof_percent' => $percent,
        'date_updated' => 'now()'
      );
      $res = self::$db->update(self::tb_wof, $data,"id='$id'");
      if(!$res){
        $_SESSION['noti_wof']['status'] = 'error';
        $_SESSION['noti_wof']['msg'] = 'Problem occured while updating data.';
      }else{
        $_SESSION['noti_wof']['status'] = 'success';
        $_SESSION['noti_wof']['msg'] = 'Daily reward package updated.';

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

              $_SESSION['noti_wof']['status'] = 'success';
              $_SESSION['noti_wof']['msg'] = 'Daily reward package updated.';
            }else{
              $_SESSION['noti_wof']['status'] = 'error';
              $_SESSION['noti_wof']['msg'] = 'Problem occured while uploading file.';
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
      $_SESSION['noti_add'] = '';
      $_SESSION['noti_add']['msg'] = '<ul>';

      $fileTitle = array(
        'img_banner' => 'Image Banner',
        'img_header' => 'Image Header',
        'img_thumbnail' => 'Image Thumbnail'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0){
            $_SESSION['noti_add']['status'] = 'error';
            $_SESSION['noti_add']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti_add']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-product.php');
        die;
      }else{
        $_SESSION['noti_add']['msg'] = '';
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
            $save_name = 'product-'.date("Ymdhis").uniqid().'.jpg';

            if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
              $data[$key_file] = $save_name;

              $_SESSION['noti_add']['status'] = 'success';
              $_SESSION['noti_add']['msg'] = 'New product created.';
            }else{
              $_SESSION['noti_add']['status'] = 'error';
              $_SESSION['noti_add']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }

        $res = self::$db->insert(self::tb_prod, $data);
      }
      rd('../admin-product.php');
      die;
    }

    public function update_product()
    {
      $id = $_POST['id'];
      $_SESSION['noti_upd'] = '';
      $_SESSION['noti_upd']['msg'] = '<ul>';

      $fileTitle = array(
        'img_banner' => 'Image Banner',
        'img_header' => 'Image Header',
        'img_thumbnail' => 'Image Thumbnail'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0 && $eachfile['name'] != ''){
            $_SESSION['noti_upd']['status'] = 'error';
            $_SESSION['noti_upd']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti_upd']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-product.php');
        die;
      }else{
        $_SESSION['noti_upd']['msg'] = '';
        $name = sanitize($_POST['name']);
        $desc = sanitize($_POST['desc']);

        $data = array(
          'name' => $name,
          'desc' => $desc,
          'date_created' => 'now()',
          'date_updated' => 'now()'
        );

        $_SESSION['noti_upd']['status'] = 'success';
        $_SESSION['noti_upd']['msg'] = 'Product updated.';

        foreach($_FILES as $key_file => $eachfile){
          if($key_file != 'files'){
            if($eachfile['name'] != ''){
              $img_tmp = $_FILES[$key_file]['tmp_name'];
              $img_name = $_FILES[$key_file]['name'];
              $save_name = 'product-'.date("Ymdhis").uniqid().'.jpg';

              if(move_uploaded_file($img_tmp, 'uploads/'.$save_name)){
                $data[$key_file] = $save_name;

                $_SESSION['noti_upd']['status'] = 'success';
                $_SESSION['noti_upd']['msg'] = 'Product updated.';
              }else{
                $_SESSION['noti_upd']['status'] = 'error';
                $_SESSION['noti_upd']['msg'] = 'Problem occured while uploading file.';
              }
            }
          }
        }

        $res = self::$db->update(self::tb_prod, $data,"id='$id'");
      }

      rd('../admin-product.php');
      die;
    }

    public function getProduct()
    {
      $sql = "SELECT * FROM ".self::tb_prod." WHERE active = 1";
      $row = self::$db->fetch_all($sql);

      return $row;
    }

    public function getProductByID()
    {
      $id = $_POST['id'];
      $sql = "SELECT * FROM ".self::tb_prod." where id='$id'";
      $row = self::$db->first($sql);

      $row->desc = html_entity_decode($row->desc);

      echo json_encode($row);
    }

    /********* SPONSOR **********************************************/

    public function create_sponsor()
    {
      $_SESSION['noti_add'] = '';
      $_SESSION['noti_add']['msg'] = '<ul>';

      $fileTitle = array(
        'img_logo' => 'Sponsor Logo'
      );

      $checkfile = true;
      foreach($_FILES as $key_file => $eachfile){
        if($key_file != 'files'){
          if($eachfile['error'] != 0){
            $_SESSION['noti_add']['status'] = 'error';
            $_SESSION['noti_add']['msg'] .= '<li>File upload error - <b>'.$fileTitle[$key_file].'</b></li>';
            $checkfile = false;
          }
        }
      }
      $_SESSION['noti_add']['msg'] .= '</ul>';

      if(!$checkfile){
        rd('../admin-sponsor.php');
        die;
      }else{
        $_SESSION['noti_add']['msg'] = '';
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

              $_SESSION['noti_add']['status'] = 'success';
              $_SESSION['noti_add']['msg'] = 'New sponsor created.';
            }else{
              $_SESSION['noti_add']['status'] = 'error';
              $_SESSION['noti_add']['msg'] = 'Problem occured while uploading file.';
            }
          }
        }

        $res = self::$db->insert(self::tb_spon, $data);
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




}
