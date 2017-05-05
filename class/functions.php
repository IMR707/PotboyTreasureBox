<?php

/**
 * Functions
 *
 * @author RuzainiOurtech
 */
if (!defined("_VALID_PHP")) {
    die('Direct access to this location is not allowed.');
}

function jp($res)
{
    $jsonPretty = new Camspiers\JsonPretty\JsonPretty;
    return $jsonPretty->prettify($res);
}

function array_flatten($array)
{
    if (!is_array($array)) {
        return false;
    }

    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        } else {
            $result[$key] = $value;
        }
    }

    return $result;
}

function GetXlsScript($FileName, $st, $highest_col)
{
    $detecterror    = 0;
    $location       = array();
    $rowData        = array();
    $phpExcel = new \PHPExcel();

    try {
        $inputFileType  = PHPExcel_IOFactory::identify($FileName);
        $objReader      = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel    = $objReader->load($FileName);
    } catch (Exception $e) {
        die('Error loading file "' . pathinfo($FileName, PATHINFO_BASENAME).'": ' . $e->getMessage());
    }

    $sheet          = $objPHPExcel->getSheet(0);
    $highestRow     = $sheet->getHighestRow();
    $highestColumn  = $sheet->getHighestColumn();//getHighestColumn();
            $highestColumnIndex = $sheet->getHighestDataColumn();//$sheet->columnIndexFromString($highestColumm);


            /*
            * checking column match with column given from user.
            */
            $row = 1;
    $i = 0;
    $col_checking = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);


            // if($highestColumn == $highest_col)
            // {
            //     // good..go check each column
            //     foreach($col_checking[0] as $k=>$v)
            //     {
            //         if(in_array($v, $st))
            //         {
            //             //$detecterror = 0;
            //         }
            //         else
            //         {
            //             //$rowData[$highestColumn] = $v;
            //             //$this->col_error[$i] = $v;
            //             $detecterror += 1;
            //             //break;
            //         }
            //         $i++;
            //     }
            // }
            // else
            // {
            //     //$this->col_error_msg[] = 'Please use A to '.$highest_col.' column only, currently your file column ended at '.$highestColumn.' column';
            //     $detecterror += 1;
            // }



            /*
            * if no error, return list of data in array
            */
            if ($detecterror == 0) {
                for ($row = 2; $row <= $highestRow; $row++) {
                    $oriData        = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
                    $oriData_flat   = array_flatten($oriData);

                    //final array to be return
                    $rowData[]      = $oriData_flat;
                }
            }
    return $rowData;
}


function getClosest($search, $arr)
{
    $closest = null;
    foreach ($arr as $item) {
        if ($closest === null || abs($search - $closest) > abs($item - $search)) {
            $closest = $item;
        }
    }
    return $closest;
}

function getClosestSmallest($search, $arr)
{
    $closest = null;
    foreach ($arr as $item) {
        if ($item<$search) {
            $closest = $item;
        }
    }
    if ($closest == null) {
        $closest=0;
    }

    return $closest;
}

function ObjtoArr($obj)
{
    $a=array();

    if (empty($obj)) {
        return $a;
    } else {
        foreach ($obj as $key) {
            $a[]=(array) $key;
        }

        return $a;
    }
}

function isMenuPortal($menu, $compare)
{
    if ($menu==$compare) {
        echo 'active open';
    }
}

function isMenu($menu, $compare)
{
    if ($menu==$compare) {
        echo 'class="current_section"';
    }
}

function isSubMenu($submenu, $compare)
{
    if ($submenu==$compare) {
        echo 'class="act_item"';
    }
}

function isBackMenu($menu, $compare)
{
    if ($menu==$compare) {
        echo 'active open';
    }
}

function isBackSubMenu($submenu, $compare)
{
    if ($submenu==$compare) {
        echo 'active open';
    }
}

function alert($string)
{
    echo "<script>alert('".$string."')</script>";
}

function styleword($var)
{
    $var=strtolower($var);
    $var=ucwords($var);
    return $var;
}

function styleword2($var)
{
    $var=strtolower($var);
    $var=ucwords($var);
    echo $var;
}

function upword($var)
{
    $var=strtolower($var);
    $var=strtoupper($var);
    return $var;
}

function stripstring($var, $length)
{
    $string = strip_tags($var);
    if (strlen($string) > $length) {
        $stringCut = substr($string, 0, $length);
        $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
    }
    echo $string;
}

function debug($var1, $var2, $var3, $var4)
{
    if (DEBUG==true) {
        $var1;
        $var2;
        $var3;
        $var4;
    } else {
        return 0;
    }
}



function printr($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}


function pre($arr)
{
    print '<pre>' . @print_r($arr, true) . '</pre>';
}

function styledate($date)
{
    echo date('j M Y', strtotime($date));
}

function styledateret($date)
{
    return date('j M Y', strtotime($date));
}


function prid($date, $id, $string, $total)
{
    $digit='';

    $num=$total-(strlen((string)$id));
    for ($i=0; $i <$num; $i++) {
        $digit.=0;
    }
    $date=date('ymd', strtotime($date));

    echo        $string.=$date."-".$digit.$id;
}



function pridret($date, $id, $string, $total)
{
    $digit='';

    $num=$total-(strlen((string)$id));
    for ($i=0; $i <$num; $i++) {
        $digit.=0;
    }
    $date=date('ymd', strtotime($date));

    return    $string.=$date."-".$digit.$id;
}

// function pr($total,$date,$id,$pr)
// {
// 	$no='';
// 	$num=$total-(strlen((string)$id));
// 	for ($i=0; $i <$num; $i++) {
// 		$no.=0;
// 	}
// 	$date=date('ymd',strtotime($date));
// 	$no.=$id;

// 	//echo $pr.$date."-".$no;
// }

function pr2($total, $date, $id, $pr)
{
    $num=$total-(strlen((string)$id));
    for ($i=0; $i <$num; $i++) {
        $pr.=0;
    }
    return $pr.=$id;
}

function submitalert($text)
{
    echo '<script type="text/javascript">';
    echo 'alert("'.$text.'");';
    echo '</script>';
}

function redirect_to($location)
{
    if (!headers_sent()) {
        header('Location: ' . $location);
        exit;
    } else {
        echo '<script type="text/javascript">';
    }
    echo 'window.location.href="' . $location . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
    echo '</noscript>';
}

/**
 * countEntries()
 *
 * @param mixed $table
 * @param string $where
 * @param string $what
 * @return
 */
function countEntries($table, $where = '', $what = '')
{
    if (!empty($where) && isset($what)) {
        $q = "SELECT COUNT(*) FROM " . $table . "  WHERE " . $where . " = '" . $what . "' LIMIT 1";
    } else {
        $q = "SELECT COUNT(*) FROM " . $table . " LIMIT 1";
    }

    $record = Registry::get("Database")->query($q);
    $total = Registry::get("Database")->fetchrow($record);
    return $total[0];
}

/**
 * getChecked()
 *
 * @param mixed $row
 * @param mixed $status
 * @return
 */
function getChecked($row, $status)
{
    if ($row == $status) {
        echo "checked=\"checked\"";
    }
}


function ucase($var)
{
    echo ucwords($var);
}

/**
 * post()
 *
 * @param mixed $var
 * @return
 */
function post($var)
{
    if (isset($_POST[$var])) {
        return $_POST[$var];
    }
}

/**
 * get()
 *
 * @param mixed $var
 * @return
 */
function get($var)
{
    if (isset($_GET[$var])) {
        return $_GET[$var];
    }
}

/**
 * sanitize()
 *
 * @param mixed $string
 * @param bool $trim
 * @return
 */
function sanitize($string, $trim = false, $int = false, $str = false)
{
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);

    if ($trim) {
        $string = substr($string, 0, $trim);
    }
    if ($int) {
        $string = preg_replace("/[^0-9\s]/", "", $string);
    }
    if ($str) {
        $string = preg_replace("/[^a-zA-Z\s]/", "", $string);
    }

    return $string;
}

/**
 * cleanSanitize()
 *
 * @param mixed $string
 * @param bool $trim
 * @return
 */
function cleanSanitize($string, $trim = false, $end_char = '&#8230;')
{
    $string = cleanOut($string);
    $string = filter_var($string, FILTER_SANITIZE_STRING);
    $string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);

    if ($trim) {
        if (strlen($string) < $trim) {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim) {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val) {
            $out.= $val . ' ';

            if (strlen($out) >= $trim) {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out . $end_char;
            }
        }
    }
    return $string;
}

/**
 * truncate()
 *
 * @param mixed $string
 * @param mixed $length
 * @param bool $ellipsis
 * @return
 */
function truncate($string, $length, $ellipsis = true)
{
    $wide = strlen(preg_replace('/[^A-Z0-9_@#%$&]/', '', $string));
    $length = round($length - $wide * 0.2);
    $clean_string = preg_replace('/&[^;]+;/', '-', $string);
    if (strlen($clean_string) <= $length) {
        return $string;
    }
    $difference = $length - strlen($clean_string);
    $result = substr($string, 0, $difference);
    if ($result != $string and $ellipsis) {
        $result = add_ellipsis($result);
    }
    return $result;
}

/**
 * getValue()
 *
 * @param mixed $stwhatring
 * @param mixed $table
 * @param mixed $where
 * @return
 */
function getValue($what, $table, $where)
{
    $sql = "SELECT $what FROM $table WHERE $where";
    $row = Registry::get("Database")->first($sql);
    return ($row) ? $row->$what : '';
}

/**
 * getValueById()
 *
 * @param mixed $what
 * @param mixed $table
 * @param mixed $id
 * @return
 */
function getValueById($what, $table, $id)
{
    $sql = "SELECT $what FROM $table WHERE id = $id";
    $row = Registry::get("Database")->first($sql);
    return ($row) ? $row->$what : '';
}

/**
 * phpself()
 *
 * @return
 */
function phpself()
{
    return htmlspecialchars($_SERVER['PHP_SELF']);
}

/**
 * cleanOut()
 *
 * @param mixed $text
 * @return
 */
function cleanOut($text)
{
    $text = strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $text = str_replace('<br>', '<br />', $text);
    return stripslashes($text);
}

/**
 * getSize()
 *
 * @param mixed $size
 * @param integer $precision
 * @param bool $long_name
 * @param bool $real_size
 * @return
 */
function getSize($size, $precision = 2, $long_name = false, $real_size = true)
{
    if ($size == 0) {
        return '-/-';
    } else {
        $base = $real_size ? 1024 : 1000;
        $pos = 0;
        while ($size > $base) {
            $size/= $base;
            $pos++;
        }
        $prefix = _getSizePrefix($pos);
        $size_name = $long_name ? $prefix . "bytes" : $prefix[0] . 'B';
        return round($size, $precision) . ' ' . ucfirst($size_name);
    }
}

/**
 * _getSizePrefix()
 *
 * @param mixed $pos
 * @return
 */
function _getSizePrefix($pos)
{
    switch ($pos) {
        case 00:
            return "";
        case 01:
            return "kilo";
        case 02:
            return "mega";
        case 03:
            return "giga";
        default:
            return "?-";
    }
}

/**
 * alphaBits()
 *
 * @param bool $all
 * @param array $vars
 * @param array $class
 * @return
 */
function alphaBits($all = false, $vars, $class)
{

    // if (!empty($_SERVER['QUERY_STRING'])) {
    $parts = explode("&amp;", $_SERVER['QUERY_STRING']);
    $vars = str_replace(" ", "", $vars);
    $c_vars = explode(",", $vars);
    $newParts = array();
    foreach ($parts as $val) {
        $val_parts = explode("=", $val);
        if (!in_array($val_parts[0], $c_vars)) {
            array_push($newParts, $val);
        }
    }
    if (count($newParts) != 0) {
        $qs = "&amp;" . implode("&amp;", $newParts);

        // } else {
        //     return false;
        // }
        $html = '';
        $charset = explode(",", "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z");
        $html.= "<div class=\"$class center\">\n";
        foreach ($charset as $key) {
            $active = ($key == get('letter')) ? ' active swatch-red-white' : null;
            $html.= "<a class=\"  btn btn-sm btn-link $active\" href=\"" . phpself() . "?letter=" . $key . $qs . "\">" . $key . "</a>\n";
        }
        $viewAll = ($all === false) ? phpself() : $all;
        $html.= "<a class=\" swatch-red-white btn btn-sm  btn-link  \" href=\"" . $viewAll . "\">All</a>\n";
        $html.= "</div>\n";
        unset($key);

        return $html;
    } else {
        return false;
    }
}

/**
 * userStatus()
 *
 * @param mixed $id
 * @return
 */
function userStatus($status, $id)
{
    switch ($status) {
        case "y":
            $display = '<i class="icon success check"></i> ' . Core::$word->USER_A;
            break;

        case "n":
            $display = '<a class="activate" data-id="' . $id . '"><i class="icon adjust warning"></i> ' . Core::$word->USER_I . '</a>';
            break;

        case "t":
            $display = '<i class="icon time info"></i> ' . Core::$word->USER_P;
            break;

        case "b":
            $display = '<i class="icon ban circle danger"></i> ' . Core::$word->USER_B;
            break;
    }

    return $display;
    ;
}

/**
 * isActive()
 *
 * @param mixed $id
 * @return
 */
function isActive($id)
{
    if ($id == 1) {
        $display = '<a data-content="' . Core::$word->YES . '"><i class="icon check"></i></a>';
    } else {
        $display = '<a data-content="' . Core::$word->NO . '"><i class="icon time"></i></a>';
    }

    return $display;
    ;
}
function ca($page, $content)
{
    if ($page == $content) {
        echo 'active';
    }
}

function ck($page, $content)
{
    if ($page == $content) {
        echo 'checked';
    }
}


function checkuser($id)
{
    switch ($id) {
        case 1:
            return "Admin";
            break;

        case 2:
            return "Account";
            break;

        case 3:
            return "Manager";
            break;

        case 4:
            return "Staff";
            break;
    }
}

/**
 * array_key_exists_wildcard()
 *
 * @param mixed $array
 * @param mixed $search
 * @param string $return
 * @return
 */
function array_key_exists_wildcard($array, $search, $return = '')
{
    $search = str_replace('\*', '.*?', preg_quote($search, '/'));
    $result = preg_grep('/^' . $search . '$/i', array_keys($array));
    if ($return == 'key-value') {
        return array_intersect_key($array, array_flip($result));
    }
    return $result;
}

/**
 * array_value_exists_wildcard()
 *
 * @param mixed $array
 * @param mixed $search
 * @param string $return
 * @return
 */
function array_value_exists_wildcard($array, $search, $return = '')
{
    $search = str_replace('\*', '.*?', preg_quote($search, '/'));
    $result = preg_grep('/^' . $search . '$/i', array_values($array));
    if ($return == 'key-value') {
        return array_intersect($array, $result);
    }
    return $result;
}

/**
 * compareFloatNumbers()
 *
 * @param mixed $float1
 * @param mixed $float2
 * @param string $operator
 * @return
 */
function compareFloatNumbers($float1, $float2, $operator = '=')
{

    // Check numbers to 5 digits of precision
    $epsilon = 0.00001;

    $float1 = (float)$float1;
    $float2 = (float)$float2;

    switch ($operator) {

            // equal


        case "=":
        case "eq":
            if (abs($float1 - $float2) < $epsilon) {
                return true;
            }
            break;

            // less than


        case "<":
        case "lt":
            if (abs($float1 - $float2) < $epsilon) {
                return false;
            } else {
                if ($float1 < $float2) {
                    return true;
                }
            }
            break;

            // less than or equal


        case "<=":
        case "lte":
            if (compareFloatNumbers($float1, $float2, '<') || compareFloatNumbers($float1, $float2, '=')) {
                return true;
            }
            break;

            // greater than


        case ">":
        case "gt":
            if (abs($float1 - $float2) < $epsilon) {
                return false;
            } else {
                if ($float1 > $float2) {
                    return true;
                }
            }
            break;

            // greater than or equal


        case ">=":
        case "gte":
            if (compareFloatNumbers($float1, $float2, '>') || compareFloatNumbers($float1, $float2, '=')) {
                return true;
            }
            break;

        case "<>":
        case "!=":
        case "ne":
            if (abs($float1 - $float2) > $epsilon) {
                return true;
            }
            break;

        default:
            die("Unknown operator '" . $operator . "' in compareFloatNumbers()");
    }

    return false;
}

/**
 * numberToWords()
 *
 * @param mixed $number
 * @return
 */
function numberToWords($number)
{
    $words = array('zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty', 30 => 'thirty', 40 => 'fourty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 100 => 'hundred', 1000 => 'thousand');
    $number_in_words = '';
    if (is_numeric($number)) {
        $number = (int)round($number);
        if ($number < 0) {
            $number = - $number;
            $number_in_words = 'minus ';
        }
        if ($number > 1000) {
            $number_in_words = $number_in_words . numberToWords(floor($number / 1000)) . " " . $words[1000];
            $hundreds = $number % 1000;
            $tens = $hundreds % 100;
            if ($hundreds > 100) {
                $number_in_words = $number_in_words . ", " . numberToWords($hundreds);
            } elseif ($tens) {
                $number_in_words = $number_in_words . " and " . numberToWords($tens);
            }
        } elseif ($number > 100) {
            $number_in_words = $number_in_words . numberToWords(floor($number / 100)) . " " . $words[100];
            $tens = $number % 100;
            if ($tens) {
                $number_in_words = $number_in_words . " and " . numberToWords($tens);
            }
        } elseif ($number > 20) {
            $number_in_words = $number_in_words . " " . $words[10 * floor($number / 10) ];
            $units = $number % 10;
            if ($units) {
                $number_in_words = $number_in_words . numberToWords($units);
            }
        } else {
            $number_in_words = $number_in_words . " " . $words[$number];
        }
        return $number_in_words;
    }
    return false;
}

/**
 * wordsToNumber()
 *
 * @param mixed $number
 * @return
 */
function wordsToNumber($data)
{
    $data = strtr($data, array('zero' => '0', 'a' => '1', 'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9', 'ten' => '10', 'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 'fifteen' => '15', 'sixteen' => '16', 'seventeen' => '17', 'eighteen' => '18', 'nineteen' => '19', 'twenty' => '20', 'thirty' => '30', 'forty' => '40', 'fourty' => '40', 'fifty' => '50', 'sixty' => '60', 'seventy' => '70', 'eighty' => '80', 'ninety' => '90', 'hundred' => '100', 'thousand' => '1000', 'million' => '1000000', 'billion' => '1000000000', 'and' => '',));

    $parts = array_map(function ($val) {
        return floatval($val);
    }, preg_split('/[\s-]+/', $data));

    $stack = new SplStack;
    $sum = 0;
    $last = null;

    foreach ($parts as $part) {
        if (!$stack->isEmpty()) {
            if ($stack->top() > $part) {
                if ($last >= 1000) {
                    $sum+= $stack->pop();
                    $stack->push($part);
                } else {
                    $stack->push($stack->pop() + $part);
                }
            } else {
                $stack->push($stack->pop() * $part);
            }
        } else {
            $stack->push($part);
        }

        $last = $part;
    }

    return $sum + $stack->pop();
}

/**
 * randName()
 *
 * @return
 */
function randName()
{
    $code = '';
    for ($x = 0; $x < 6; $x++) {
        $code.= '-' . substr(strtoupper(sha1(rand(0, 999999999999999))), 2, 6);
    }
    $code = substr($code, 1);
    return $code;
}
