<?php
set_time_limit(0);
ini_set('memory_limit', '-1');

if (!defined('_VALID_PHP')) {
    die('Direct access to this location is not allowed.');
}
use Httpful\Request;

class ChunLam
{
    const tbSponsor = 'tb_sponsor';
    const tbPro = "tb_voting_pro";

    private static $db;
    public function __construct()
    {
        self::$db = Registry::get('Database');
    }

    public function test($value)
    {
      pre($value);
    }

    public function getAllActiveSponsors(){
      $sql = 'SELECT * FROM '.self::tbSponsor." where active = '1' ORDER BY name ";
      $row = self::$db->fetch_all($sql);
//      if($row){
        return $row;
//      }
    }

    public function getAllInactiveSponsors(){
      $sql = 'SELECT * FROM '.self::tbSponsor." where active = '0' ORDER BY name ";
      $row = self::$db->fetch_all($sql);
//      if($row){
        return $row;
//      }
    }

    public function getAllSponsors(){
      $sql = 'SELECT * FROM '.self::tbSponsor." ORDER BY active DESC, name ";
      $row = self::$db->fetch_all($sql);
//      if($row){
        return $row;
//      }
    }

    public function getSponsorById($sponsor_id){
      $sql = 'SELECT * FROM '.self::tbSponsor." where id = '$sponsor_id' ";
      $row = self::$db->first($sql);
//    if($row){
        return $row;
//      }
    }

    public function AddSponsor($name,$logo,$active)
    {
      $data = array(
                    'name' => $name,
                    'logo' => $logo,
                    'active' => $active,
                    'created' => 'now()',
                    );
      self::$db->insert(self::tbSponsor, $data);

    }

    public function UpdateSponsor($name,$logo,$active)
    {

      $data = array(
                    'name' => $name,
                    'logo' => $logo,
                    'active' => $active,
                    );
      self::$db->update(self::tbSponsor, $data);

    }

    public function DeleteSponsor($pd)
    {
        $sid = $pd['sid'];
        $data = array(
          'active' => '0',
        );
        self::$db->update(self::tbSponsor, $data, 'id='.$sid);
        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Delete the sponsor.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => 'Error Updating Data');

            return json_encode($a);
        }
    }

    public function getProductById($pid){
      $sql = 'SELECT * FROM '.self::tbPro." where id = '$pid' ";
      $row = self::$db->first($sql);
      return $row;
    }

    public function getProducts(){
      $sql = 'SELECT * FROM '.self::tbPro." ";
      $row = self::$db->fetch_all($sql);
      return $row;
    }

    public function getActiveProducts(){
      $sql = 'SELECT * FROM '.self::tbPro." where active = '1' ";
      $row = self::$db->fetch_all($sql);
      return $row;
    }

// need to add spec and details
    public function AddProduct($name,$desc,$thumbnail,$banner,$header,$active)
    {
      $data = array(
                    'name' => $name,
                    'des' => $desc,
                    'thumbnail_img' => $thumbnail,
                    'banner_img' => $banner,
                    'header_img' => $header,
                    'active' => $active,
                    'created' => 'now()',
                    );
      self::$db->insert(self::tbPro, $data);

    }

    public function UpdateProduct($name,$desc,$thumbnail,$banner,$header,$active)
    {

      $data = array(
                    'name' => $name,
                    'des' => $desc,
                    'thumbnail_img' => $thumbnail,
                    'banner_img' => $banner,
                    'header_img' => $header,
                    'active' => $active,
                    );
      self::$db->update(self::tbPro, $data);

    }

    public function DeleteProduct($pd)
    {
        $pid = $pd['pid'];
        $data = array(
          'active' => '0',
        );
        self::$db->update(self::tbPro, $data, 'id='.$pid);
        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Delete the reward item.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => 'Error Updating Data');

            return json_encode($a);
        }
    }

/*  public function AddLogHistory($oldspid,$spid,$table,$data,$user)
    {

      $data = array(
                    'userid' => $oldspid,
                    'newuserid' => $spid,
                    'tablename' => $table,
                    'data' => $data,
                    'by' => $user,
                    'created' => 'now()',
                    'updated' => 'now()',
                    );
      self::$db->insert(self::hdirTable, $data);

    }
*/
}
