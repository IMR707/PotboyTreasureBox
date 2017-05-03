<?php
set_time_limit(0);
ini_set('memory_limit', '-1');

if (!defined('_VALID_PHP')) {
    die('Direct access to this location is not allowed.');
}
use Httpful\Request;

class ChunLam
{
    const lTable = 'leads';
    private static $db;
    public function __construct()
    {
        self::$db = Registry::get('Database');
    }
    public function test($value)
    {
      pre($value);
    }


    public function CustgetLeads($id)
    {
      return "$id test";
    }


}
