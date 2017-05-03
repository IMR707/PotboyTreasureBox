<?php
define('_VALID_PHP', true);
$pname = 'Dashboard';
$menu = 'Dashboard';
$submenu = '';
require_once 'init.php';
use Carbon\Carbon;
if (!$user->logged_in) {
    redirect_to(SITEURL.'/index.php');
}

pre($user);
die;
$user->isAdmin() ? $leadname = 'Total All Leads' : $leadname = 'Total Of My Leads';
$totalleads = $user->uid;
$us = $user->userDetail($user->uid);
$byyear='';
if(isset($_GET['byyear']))
{
  $byyear=$_GET['byyear'];
}
  $bymonth='';
if(isset($_GET['bymonth']))
{
  $bymonth=$_GET['bymonth'];
}
$bystart='';
if(isset($_GET['bystart'])){
  $bystart=$_GET['bystart'];
}

$byend='';
if(isset($_GET['byend'])){
  $byend=$_GET['byend'];
}
if(!isset($_GET['byyear'])&&isset($_GET['bymonth'])&&isset($_GET['bystart'])&&isset($_GET['byend'])) {
  $bymonth=date('m/Y');
}

if($byyear&&isset($_GET['filteryear']))
{
  $targettext= $byyear==date('Y')? 'This Year': 'Year '.$byyear;
  $filterdash="byyear";
}
elseif ($bystart&&$byend&&isset($_GET['filterbystart'])) {
  $targettext= 'From '.$bystart.' to '.$byend;
  $filterdash="bystart";
}

elseif ($bymonth&&isset($_GET['filtermonth'])) {
  $targettext= $bymonth==date("m")."/".date('Y')? 'This Month': 'For '.$bymonth;
  $filterdash="bymonth";
}
else {
  $targettext='This Month';
  $filterdash="thismonth";
}



$latestcus=$list->getAllCustomerLatest('10');
$comingbday = $list->getCusComingBday('10');
$listinglead=$list->getAllLeadsLatest($user,'10');
$latestleads=$listinglead[0];
// $latestleadsmanual=$listinglead[1];
$fl=$list->getFollowup($user,10);
$cm=$list->getCompleteFollowup($user,10);

$todo=$list->getTodo($user,10);


$cni=$cm['cni'];
$ccl=$cm['ccl'];
$ccc=$cni+$ccl;

$accc='';
if($ccc>0)
{
  $accc=' <span class="uk-badge uk-badge-danger uk-badge-notification">'.$ccc.'</span>';
}

$acni='';
if($cni>0)
{
  $acni=' <span class="uk-badge uk-badge-danger uk-badge-notification">'.$cni.'</span>';
}

$accl='';
if($ccl>0)
{
  $accl=' <span class="uk-badge uk-badge-danger uk-badge-notification">'.$ccl.'</span>';
}


$cna=$todo['cna'];
$acna='';
if($cna>0)
{
  $acna=' <span class="uk-badge uk-badge-danger uk-badge-notification">'.$cna.'</span>';
}

$ci=$todo['ci'];
$aci='';
if($ci>0)
{
  $aci=' <span class="uk-badge uk-badge-danger uk-badge-notification">'.$ci.'</span>';
}

$co=$todo['co'];
$aco='';
if($co>0)
{
  $aco=' <span class="uk-badge uk-badge-danger uk-badge-notification">'.$co.'</span>';
}




$cfl=count($list->getFollowup($user));
$cfls='';
if($cfl>0)
{
  $cfls=' <span class="uk-badge uk-badge-danger uk-badge-notification">'.$cfl.'</span>';
}

switch ($filterdash) {
            case 'thismonth':
                $startdate = date('Y').'-'.date('m').'-01';
                $enddate = date('Y-m-t', strtotime($startdate));
            break;
            case 'bymonth':
                $pieces = explode('/', $_GET['bymonth']);
                $startdate = $pieces[1].'-'.$pieces[0].'-01';
                $enddate = date('Y-m-t', strtotime($startdate));
            break;
            case 'byyear':
                $startdate = $_GET['byyear'].'-01-01';
                $enddate = $_GET['byyear'].'-12-31';
            break;
            case 'bystart':
                $startdate = $_GET['bystart'];
                $enddate = $_GET['byend'];
            break;
            }
            $lso = $list->getLeadSourcebyID($filterdash,$user);
            arsort($lso);
            $lst = $list->getLeadStatusbyID($filterdash,$user);
            arsort($lst);
?>
    <!doctype html>
    <!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
    <!--[if gt IE 9]><!-->
    <html lang="en">
    <!--<![endif]-->
    <?php include 'head.php';?>
    <?php include 'header.php';?>

    <body class=" sidebar_main_open sidebar_main_swipe">
        <?php include 'menu.php';?>
        <div id="page_content">
            <div id="page_content_inner">
          <div class="md-card uk-margin-bottom ">
            <div class="md-card-content  ">

              <div class="md-card uk-margin-bottom uk-text-center uk-width-1-1">
                <div class="md-card-content " >

              <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-4 uk-text-center" data-uk-grid-margin>
                  <div >
                      <div class=" ">
                          <div class="">
                              By Year
                              <input id="yeardatepicker" style="width: 100%;" value="<?php echo $byyear;?>" />
                          </div>
                      </div>
                  </div>
                  <div>
                      <div class="">
                          <div class="">
                              By Month
                              <input id="monthdatepicker" style="width: 100%;" value="<?php echo $bymonth;?>" />

                          </div>
                      </div>
                  </div>
                 <div>
                      <div class="">
                          <div class="">
                            From
                            <input id="start_date" style="width: 100%;" value="<?php echo $startdate;?>" />
                          </div>
                      </div>
                  </div>
                  <div>
                      <div class="">
                          <div class="">
                            To
                            <input id="end_date" style="width: 100%;" value="<?php echo $enddate;?>" />
                        </div>
                      </div>
                  </div>
              </div>

            </div>
          </div>



              <?php  if($user->isSale()){
                $target = $us->target;
                $currentamount = $list->getClosesalebyID($filterdash,$us->id);
                $precent = ($currentamount / $target) * 100;
                $target = 'RM'.number_format($target);
                $currentamount = 'RM'.number_format($currentamount);

                $cr=$list->getMyLeadsClosingRatio($filterdash,$us->id);
                $percent=$cr['percent'];
                $close=$cr['close'];
                $total=$cr['total'];
                if($total==0)
                $per=0;
                else {
                $per=number_format(($cr['close']/$cr['total'])*100);
                }
                $closepertotal=$cr['close']."/".$cr['total'];
                //$lso $lst
                ?>
                <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-4 uk-text-center" data-uk-grid-margin style="display:none;">
                  <div>
                      <div class="">
                          <div class="">
                              <h4 class="heading_c uk-margin-bottom">Sale Target</h4>
                            <div id="targetsale" class="c3chart">Your Target <?php echo $targettext;?> is <b><?php echo $target;?></b>
                                      <br>Current Amount is <b><?php echo $currentamount;?></b></div>
                          </div>
                      </div>
                  </div>
                  <div>
                      <div class="">
                          <div class="">
                              <h4 class="heading_c uk-margin-bottom">Leads Source</h4>
                              <div id="leadsource" class="c3chart"></div>
                          </div>
                      </div>
                  </div>
                  <div>
                      <div class="">
                          <div class="">
                              <h4 class="heading_c uk-margin-bottom">Leads Status</h4>
                              <div id="analysistotalsaleleads" class="c3chart"></div>
                          </div>
                      </div>
                  </div>
                  <div>
                      <div class="">


                          <div class="">
                              <h4 class="heading_c uk-margin-bottom">Closing Ratio (%)</h4>
                              <div class="c3chart">
                                  <div class="epc_chart" data-percent="<?php echo $per;?>" data-bar-color="#005543">
                                      <span class="epc_chart_text"><span class="countUpMe"><?php echo $per;?></span>%</span>
                                  </div>Current Closing case is <b><?php echo $closepertotal;?></b></div>

                          </div>



                      </div>
                  </div>
              </div>
              <?php } ?>
            </div>
          </div> <!-- ///////////////////////////////////////testing------------------------------------>
          <!-- admin list-->
          <?php

          if(!$user->isSale())
          {
            $salepts=$user->getAllSale();
            $sale=array();
            foreach ($salepts as $key => $value) {
              $target = $value->target;
              $currentamount = $list->getClosesalebyID($filterdash,$value->id);
              $precent = ($currentamount / $target) * 100;
              $data[$value->id]['name']=$value->fullname;
              $data[$value->id]['stt']="RM ".number_format($target);
              $data[$value->id]['stca']="RM ".number_format($currentamount);
              $data[$value->id]['stp']=$precent." %";
              $data[$value->id]['art']=$list->getResponsebyID($filterdash,$value->id);
              $cr=$list->getMyLeadsClosingRatio($filterdash,$value->id);
              $data[$value->id]['cr']=$cr['percent'];
              $data[$value->id]['close']=$cr['close'];
              $data[$value->id]['total']=$cr['total'];
              $data[$value->id]['closepertotal']=$cr['close']."/".$cr['total'];
            }
            ?>

            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                  <h3 class="heading_a uk-margin-bottom">Leads Chart</h3>

                  <div class="uk-grid uk-grid-width-small-1-3 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-3 uk-text-center" data-uk-grid-margin>

                    <div>
                        <div class="">
                            <div class="">
                                <h4 class="heading_c uk-margin-bottom">Analysis on Total Sales Leads</h4>
                                <div id="analysistotalsaleleads" class="c3chart"></div>
                                <div>
                                  Total : 100
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>
                        <div class="">
                            <div class="">
                                <h4 class="heading_c uk-margin-bottom">Analysis on Interested</h4>
                                <div id="analysisinterest" class="c3chart"></div>
                                <div>
                                  Total : 100 Sales Leads
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>
                        <div class="">
                            <div class="">
                                <h4 class="heading_c uk-margin-bottom">Analysis on Sales Leads Source</h4>
                                <div id="analysissalesleadssource" class="c3chart"></div>
                                <div>
                                  Total : 100
                                </div>
                            </div>
                        </div>
                    </div>




                </div>

                </div>
            </div>




          <div class="md-card uk-margin-medium-bottom">
              <div class="md-card-content">
                <h3 class="heading_a uk-margin-bottom">Summary</h3>
                  <div class="uk-grid" data-uk-grid-margin="">
                      <div class="uk-width-1-1">
                          <ul class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                              <li class="sps-active" aria-expanded="true"><a href="#">Sale Persons</a></li>
                              <li class="lso-active" aria-expanded="true"><a href="#">Leads Source</a></li>
                              <li class="lst-active" aria-expanded="true"><a href="#">Leads Status</a></li>
                              <li class="uk-tab-responsive uk-active uk-hidden" aria-haspopup="true" aria-expanded="false"><a>Active</a>
                                  <div class="uk-dropdown uk-dropdown-small">
                                      <ul class="uk-nav uk-nav-dropdown"></ul>
                                      <div></div>
                                  </div>
                              </li>

<div class="uk-text-right">
<span class="uk-badge uk-badge-success"><b><?php echo $targettext;?></b></span>

</div>

                          </ul>
                          <ul id="tabs_1" class="uk-switcher uk-margin">
                            <li aria-hidden="false" class="sps-active">
                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="uk-width-2-10 uk-text-left">Sale Person Name</th>
                                            <th class="uk-width-2-10 uk-text-center">Sale Target</th>
                                            <th class="uk-width-1-10 uk-text-center">Current Sale Amount</th>
                                            <th class="uk-width-1-10 uk-text-center">Percentage Sale Target</th>
                                            <th class="uk-width-1-10 uk-text-center">Average Response Time</th>
                                            <th class="uk-width-1-10 uk-text-center">Closing Ratio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                              <?php
                              foreach ($data as $key => $value) {
                              ?>
                                <tr>
                                <td class="uk-text-left"><?php echo styleword($value['name']);?></td>
                                <td class="uk-text-center"><?php echo $value['stt'];?></td>
                                <td class="uk-text-center"><?php echo $value['stca'];?></td>
                                <td class="uk-text-center"><?php echo $value['stp'];?></td>
                                <td class="uk-text-center"><?php echo $value['art'];?></td>
                                <td class="uk-text-center"><?php echo $value['cr'];?> (<?php echo $value['closepertotal'];?>)</td>
                                </tr>
                              <?php } ?>
                                    </tbody>
                                </table>
                            </li>


                            <li aria-hidden="false" class="lso-active">
                              <?php

                              ?>
                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="uk-width-2-10 uk-text-left">Leads Source</th>
                                            <th class="uk-width-2-10 uk-text-center">Amount Source <?php echo $targettext;?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                          foreach ($lso as $key => $value) {
                                            $aa=$list->getSource2($key);
                                          ?>
                                          <tr>
                                              <td class="uk-text-left"><?php echo styleword($aa->name);?></td>
                                              <td class="uk-text-center"><?php echo $value;?></td>

                                          </tr>
                                          <?php
                                        } ?>
                                    </tbody>
                                </table>



                            </li>


                            <li aria-hidden="false" class="lst-active">
                              <?php

                              ?>
                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="uk-width-2-10 uk-text-left">Leads Status</th>
                                            <th class="uk-width-2-10 uk-text-center">Amount Status <?php echo $targettext;?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                          foreach ($lst as $key => $value) {
                                            $aa=$list->getStatus2($key);
                                          ?>
                                          <tr>
                                              <td class="uk-text-left"><?php echo styleword($aa->data);?></td>
                                              <td class="uk-text-center"><?php echo $value;?></td>

                                          </tr>
                                          <?php
                                        } ?>
                                    </tbody>
                                </table>



                            </li>




                          </ul>
                      </div>
                  </div>
              </div>
          </div>

          <!-- admin list-->
        <?php }?>





          <!-- lead list-->
          <div class="md-card uk-margin-medium-bottom">
              <div class="md-card-content">
                <h3 class="heading_a uk-margin-bottom">Sales Leads</h3>
                  <div class="uk-grid" data-uk-grid-margin="">
                      <div class="uk-width-1-1">
                          <ul class="uk-tab" data-uk-tab="{connect:'#tabs_2'}">
                              <li class="ll-active" aria-expanded="true"><a href="#">New</a></li>
                              <li class="lml-active" aria-expanded="true"><a href="#">To Do <?php echo $cfls;?></a></li>
                              <li class="fu-active" aria-expanded="true"><a href="#">Completed <?php echo $accc;?></a></li>
                              <!-- <li class="lr-active" aria-expanded="true"><a href="#">Latest Referrals</a></li> -->
                              <li class="uk-tab-responsive uk-active uk-hidden" aria-haspopup="true" aria-expanded="false"><a>Active</a>
                                  <div class="uk-dropdown uk-dropdown-small">
                                      <ul class="uk-nav uk-nav-dropdown"></ul>
                                      <div></div>
                                  </div>
                              </li>
                          </ul>
                          <ul id="tabs_2" class="uk-switcher uk-margin">
                              <li aria-hidden="false" class="ll-active">
                                  <table class="uk-table uk-table-nowrap">
                                      <thead>
                                          <tr>
                                              <th class="uk-width-2-10 uk-text-center">Date</th>
                                              <th class="uk-width-2-10 uk-text-center">Name</th>
                                              <th class="uk-width-2-10 uk-text-center">Interested Project</th>
                                              <th class="uk-width-2-10 uk-text-center">Contact No</th>
                                              <th class="uk-width-1-10 uk-text-center">Email</th>
                                              <th class="uk-width-2-10 uk-text-center">Source</th>
                                              <th class="uk-width-2-10 uk-text-center">Sale Person</th>



                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php

                                          foreach ($latestleads as $key => $value) {
                                            $pp="<ul>";
                                            foreach (json_decode($value->interest) as $key2=> $value2) {
                                                $pp.="<li>";
                                                $aaa=$list->getProjects($value2);//name
                                                $pp.=$aaa->name;
                                                $pp.="</li>";
                                            }
                                            $pp.="</ul>";

                                            $sources=$list->getSource($value->source);
                                            $source=$sources[0]->name;
                                            $sp=$user->getUserbyID($value->spid);


                                            $cre=Carbon::createFromTimeStamp(strtotime($value->created));
                                            $date=$cre->formatLocalized('%d-%m-%Y');

                                            //pre($cre);
                                            //$spid=$value->spid;

                                            ?>
                                          <tr>
                                              <td class="uk-text-center"><?php echo $date;?></td>
                                              <td class="uk-text-left"><a href="leadsview.php?lid=<?php echo $value->id;?>"><?php echo styleword($value->leadsname);?></a></td>
                                              <td class="uk-text-center"><?php echo $pp;?></td>
                                              <td class="uk-text-center"><?php echo $value->mobile;?></td>
                                              <td class="uk-text-center"><?php echo $value->leadsemail;?></td>
                                              <td class="uk-text-center"><?php echo $source;?></td>
                                              <td class="uk-text-center"><?php echo styleword($sp->fullname);?></td>

                                          </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>



                              </li>
                              <li aria-hidden="false" class="lml-active">

                                <?php
                                $naid=$todo['na'];
                                $iid=$todo['i'];
                                $oid=$todo['o'];
                                ?>

                                <h3 class="heading_a uk-margin-bottom">Not Attempted <?php echo $acna;?> <a href="leads.php?lstatus=18" class="pull-right">View All</a></h3>

                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>

                                            <th class="uk-width-2-10 uk-text-center">Date</th>
                                            <th class="uk-width-2-10 uk-text-center">Name</th>
                                            <th class="uk-width-2-10 uk-text-center">Status</th>
                                            <th class="uk-width-2-10 uk-text-center">Source</th>
                                            <th class="uk-width-1-10 uk-text-center">Enquiry</th>
                                            <th class="uk-width-2-10 uk-text-center">Contact No</th>
                                            <th class="uk-width-2-10 uk-text-center">Email</th>
                                            <?php if(!$user->isSale()){ ?>
                                            <th class="uk-width-2-10 uk-text-center">Sale Person</th>
                                            <?php }?>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                      foreach ($naid as $key => $value) {
                                          $follow=$list->getLeadsENbyLeadsIDNA($value);



                                          $cre=Carbon::createFromTimeStamp(strtotime($follow[1]->created));
                                          $date=$cre->formatLocalized('%d-%m-%Y');
                                          ?>
                                          <tr>
                                            <td class="uk-text-center"><?php echo $date;?></td>
                                              <td class="uk-text-center"><a href="leadsview.php?lid=<?php echo $follow[0]->id;?>"><?php echo styleword($follow[0]->name);?></a></td>
                                              <td class="uk-text-center"><span class="uk-badge">
                                                <?php $status=$list->getStatus2($follow[1]->status);
                                                echo ($status->data);
                                              ?></span></td>
                                              <td class="uk-text-center"><?php
                                              $source=$list->getSource($follow[1]->source);
                                              echo ($source[0]->name);?></td>
                                              <td class="uk-text-center"><?php echo $follow[1]->enquiry;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->contact_m;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->email;?></td>
                                              <?php if(!$user->isSale()){ ?>
                                                <td class="uk-text-center"><?php
                                                $slper=$user->getUserbyID($follow[1]->spid);
                                                echo styleword($slper->fullname);?></td>
                                              <?php }?>
                                          </tr>
                                          <?php }

                                          if(empty($naid)){
                                            $cols=$user->isSale()? 6: 7;
                                            ?>
                                            <tr>
                                              <td colspan="<?php echo $cols;?>">
                                                <p class="uk-text-center">-- No Data --</p>

                                              </td>
                                            </tr>
                                            <?php
                                          }
                                             ?>
                                    </tbody>
                                </table>


                                <h3 class="heading_a uk-margin-bottom">Interested <?php echo $aci;?> <a href="leads.php?lstatus=19" class="pull-right">View All</a></h3>
                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>

                                            <th class="uk-width-2-10 uk-text-center">Date</th>
                                            <th class="uk-width-2-10 uk-text-center">Name</th>
                                            <th class="uk-width-2-10 uk-text-center">Status</th>
                                            <th class="uk-width-2-10 uk-text-center">Source</th>
                                            <th class="uk-width-1-10 uk-text-center">Enquiry</th>
                                            <th class="uk-width-2-10 uk-text-center">Contact No</th>
                                            <th class="uk-width-2-10 uk-text-center">Email</th>
                                            <?php if(!$user->isSale()){ ?>
                                            <th class="uk-width-2-10 uk-text-center">Sale Person</th>
                                            <?php }?>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                      foreach ($iid as $key => $value) {
                                          $follow=$list->getLeadsENbyLeadsIDI($value);
                                          $cre=Carbon::createFromTimeStamp(strtotime($follow[1]->created));
                                          $date=$cre->formatLocalized('%d-%m-%Y');

                                          ?>
                                          <tr>
                                            <td class="uk-text-center"><?php echo $date;?></td>
                                              <td class="uk-text-center"><a href="leadsview.php?lid=<?php echo $follow[0]->id;?>"><?php echo styleword($follow[0]->name);?></a></td>
                                              <td class="uk-text-center"><span class="uk-badge">
                                                <?php $status=$list->getStatus2($follow[1]->status);
                                                echo ($status->data);
                                              ?></span></td>
                                              <td class="uk-text-center"><?php
                                              $source=$list->getSource($follow[1]->source);
                                              echo ($source[0]->name);?></td>
                                              <td class="uk-text-center"><?php echo $follow[1]->enquiry;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->contact_m;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->email;?></td>
                                              <?php if(!$user->isSale()){ ?>
                                                <td class="uk-text-center"><?php
                                                $slper=$user->getUserbyID($follow[1]->spid);
                                                echo styleword($slper->fullname);?></td>
                                              <?php }?>
                                          </tr>
                                          <?php }

                                          if(empty($iid)){
                                            $cols=$user->isSale()? 6: 7;
                                            ?>
                                            <tr>
                                              <td colspan="<?php echo $cols;?>">
                                                <p class="uk-text-center">-- No Data --</p>

                                              </td>
                                            </tr>
                                            <?php
                                          }
                                             ?>
                                    </tbody>
                                </table>


                                <h3 class="heading_a uk-margin-bottom">Others <?php echo $aco;?><a href="leads.php?lstatus=21" class="pull-right">View All</a></h3>
                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="uk-width-2-10 uk-text-center">Date</th>
                                            <th class="uk-width-2-10 uk-text-center">Name</th>
                                            <th class="uk-width-2-10 uk-text-center">Status</th>
                                            <th class="uk-width-2-10 uk-text-center">Source</th>
                                            <th class="uk-width-1-10 uk-text-center">Enquiry</th>
                                            <th class="uk-width-2-10 uk-text-center">Contact No</th>
                                            <th class="uk-width-2-10 uk-text-center">Email</th>
                                            <?php if(!$user->isSale()){ ?>
                                            <th class="uk-width-2-10 uk-text-center">Sale Person</th>
                                            <?php }?>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                      foreach ($oid as $key => $value) {
                                          $follow=$list->getLeadsENbyLeadsIDO($value);
                                          $cre=Carbon::createFromTimeStamp(strtotime($follow[1]->created));
                                          $date=$cre->formatLocalized('%d-%m-%Y');

                                          ?>
                                          <tr>
                                              <td class="uk-text-center"><?php echo $date;?></td>
                                              <td class="uk-text-center"><a href="leadsview.php?lid=<?php echo $follow[0]->id;?>"><?php echo styleword($follow[0]->name);?></a></td>
                                              <td class="uk-text-center"><span class="uk-badge">
                                                <?php $status=$list->getStatus2($follow[1]->status);
                                                echo ($status->data);
                                              ?></span></td>
                                              <td class="uk-text-center"><?php
                                              $source=$list->getSource($follow[1]->source);
                                              echo ($source[0]->name);?></td>
                                              <td class="uk-text-center"><?php echo $follow[1]->enquiry;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->contact_m;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->email;?></td>
                                              <?php if(!$user->isSale()){ ?>
                                                <td class="uk-text-center"><?php
                                                $slper=$user->getUserbyID($follow[1]->spid);
                                                echo styleword($slper->fullname);?></td>
                                              <?php }?>
                                          </tr>
                                          <?php }

                                          if(empty($oid)){
                                            $cols=$user->isSale()? 6: 7;
                                            ?>
                                            <tr>
                                              <td colspan="<?php echo $cols;?>">
                                                <p class="uk-text-center">-- No Data --</p>

                                              </td>
                                            </tr>
                                            <?php
                                          }
                                             ?>
                                    </tbody>
                                </table>




                              </li>
                              <li aria-hidden="false" class="fu-active">
                                <?php



                                $nid=$cm['ni'];
                                $cld=$cm['cl'];




                                ?>

                                <h3 class="heading_a uk-margin-bottom">Not Interest <?php echo $acni;?> <a href="leads.php?lstatus=20" class="pull-right">View All</a></h3>
                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>

                                            <th class="uk-width-2-10 uk-text-center">Date</th>
                                            <th class="uk-width-2-10 uk-text-center">Name</th>
                                            <th class="uk-width-2-10 uk-text-center">Status</th>
                                            <th class="uk-width-2-10 uk-text-center">Source</th>
                                            <th class="uk-width-1-10 uk-text-center">Enquiry</th>
                                            <th class="uk-width-2-10 uk-text-center">Contact No</th>
                                            <th class="uk-width-2-10 uk-text-center">Email</th>
                                            <?php if(!$user->isSale()){ ?>
                                            <th class="uk-width-2-10 uk-text-center">Sale Person</th>
                                            <?php }?>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                      foreach ($nid as $key => $value) {
                                          $follow=$list->getLeadsENbyLeadsIDNI($value);
                                          $cre=Carbon::createFromTimeStamp(strtotime($follow[1]->created));
                                          $date=$cre->formatLocalized('%d-%m-%Y');

                                          ?>
                                          <tr>
                                            <td class="uk-text-center"><?php echo $date;?></td>
                                              <td class="uk-text-center"><a href="leadsview.php?lid=<?php echo $follow[0]->id;?>"><?php echo styleword($follow[0]->name);?></a></td>
                                              <td class="uk-text-center"><span class="uk-badge">
                                                <?php $status=$list->getStatus2($follow[1]->status);
                                                echo ($status->data);
                                              ?></span></td>
                                              <td class="uk-text-center"><?php
                                              $source=$list->getSource($follow[1]->source);
                                              echo ($source[0]->name);?></td>
                                              <td class="uk-text-center"><?php echo $follow[1]->enquiry;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->contact_m;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->email;?></td>
                                              <?php if(!$user->isSale()){ ?>
                                                <td class="uk-text-center"><?php
                                                $slper=$user->getUserbyID($follow[1]->spid);
                                                echo styleword($slper->fullname);?></td>
                                              <?php }?>
                                          </tr>
                                          <?php }

                                          if(empty($nid)){
                                            $cols=$user->isSale()? 6: 7;
                                            ?>
                                            <tr>
                                              <td colspan="<?php echo $cols;?>">
                                                <p class="uk-text-center">-- No Data --</p>

                                              </td>
                                            </tr>
                                            <?php
                                          }
                                             ?>
                                    </tbody>
                                </table>

                                <h3 class="heading_a uk-margin-bottom">Sale Closed <?php echo  $accl;?></h3>
                                <table class="uk-table uk-table-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="uk-width-2-10 uk-text-center">Date</th>
                                            <th class="uk-width-2-10 uk-text-center">Name</th>
                                            <th class="uk-width-2-10 uk-text-center">Status</th>
                                            <th class="uk-width-2-10 uk-text-center">Source</th>
                                            <th class="uk-width-1-10 uk-text-center">Amount</th>
                                            <th class="uk-width-2-10 uk-text-center">Contact No</th>
                                            <th class="uk-width-2-10 uk-text-center">Email</th>
                                            <?php if(!$user->isSale()){ ?>
                                            <th class="uk-width-2-10 uk-text-center">Sale Person</th>
                                            <?php }?>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($cld)){
                                        foreach ($cld as $key => $value) {
                                          $follow=$list->getLeadsENbyLeadsIDCL($value);
                                          $cre=Carbon::createFromTimeStamp(strtotime($follow[2][0]->created));
                                          $date=$cre->formatLocalized('%d-%m-%Y');
                                          $amount=0;
                                          foreach ($follow[2] as $key => $value) {
                                            $amount+=$value->amount;
                                          }
                                          ?>
                                          <tr>
                                            <td class="uk-text-center"><?php echo $date;?></td>
                                              <td class="uk-text-center"><a href="leadsview.php?lid=<?php echo $follow[0]->id;?>"><?php echo styleword($follow[0]->name);?></a></td>
                                              <td class="uk-text-center"><span class="uk-badge">Sale Closed</span></td>
                                              <td class="uk-text-center"><?php
                                              $source=$list->getSource($follow[1]->source);
                                              echo ($source[0]->name);?></td>
                                              <td class="uk-text-center">RM <?php echo number_format($amount);?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->contact_m;?></td>
                                              <td class="uk-text-center"><?php echo $follow[0]->email;?></td>
                                              <?php if(!$user->isSale()){ ?>
                                                <td class="uk-text-center"><?php
                                                $slper=$user->getUserbyID($follow[1]->spid);
                                                echo styleword($slper->fullname);?></td>
                                              <?php }?>
                                          </tr>
                                          <?php }}
                                          else {
                                            $cols=$user->isSale()? 6: 7;
                                            ?>
                                            <tr>
                                              <td colspan="<?php echo $cols;?>">
                                                <p class="uk-text-center">-- No Data --</p>
                                              </td>
                                            </tr><?php
                                          } ?>
                                    </tbody>
                                </table>



                              </li>
                              <li aria-hidden="false" class="lr-active">
                                  <table class="uk-table uk-table-nowrap">
                                      <thead>
                                          <tr>

                                              <th class="uk-width-2-10 uk-text-center">Name</th>
                                              <th class="uk-width-2-10 uk-text-center">Referred By</th>
                                              <th class="uk-width-2-10 uk-text-center">Contact No</th>
                                              <th class="uk-width-2-10 uk-text-center">Email</th>


                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php for ($i = 1;$i <= 6;++$i) {
?>
                                          <tr>
                                              <td class="uk-text-center">Fazrin</td>
                                              <td class="uk-text-center"><span class="uk-badge uk-badge-success">Customer name</span></td>
                                              <td class="uk-text-center"><a href="tel:+60122244417">+60122244417</a></td>
                                              <td class="uk-text-center">fazrin@cloone.com.my</td>
                                          </tr>

                                          <?php

}?>
                                      </tbody>
                                  </table>
                              </li>

                          </ul>
                      </div>
                  </div>
              </div>
          </div><!-- lead list-->
                <!-- todo list-->
                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
                    <div class="uk-width-medium-1-2">
                        <div class="md-card">
                            <div class="md-card-content">
                                <h3 class="heading_a uk-margin-bottom">Upcoming Birthdays</h3>
                                <div class="uk-overflow-container">
                                    <table class="uk-table">
                                        <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Name</th>
                                                <th class="uk-text-nowrap uk-text-center">Upcoming Birthday</th>
                                                <th class="uk-text-nowrap uk-text-center">Contact No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach($comingbday as $key => $row){

                                              $ic = $row->bday_date;
                                              $ic_arr = explode("-",$ic);

                                              $bday = '';

                                              $b_day = substr($ic_arr[0], 4, 2);
                                              $b_mon = substr($ic_arr[0], 2, 2);

                                              $bday = $b_day.'-'.$b_mon.'-'.date('Y');

                                              $newbday = date("d M Y",strtotime($bday));
                                            ?>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10"><a href="customerview.php?id=<?php echo $row->id;?>"><?php echo $row->name?></a></td>
                                                <td class="uk-width-2-10 uk-text-center uk-text-muted uk-text-small"><?php echo $newbday;?></span></td>

                                                <td class="uk-width-2-10 uk-text-center uk-text-muted uk-text-small"><?php echo $row->contact_m;?></td>
                                            </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-medium-1-2">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="uk-tab-center">
                                    <ul class="uk-tab" data-uk-tab="{connect:'#tabs_5'}">
                                        <li class="uk-active" aria-expanded="true"><a href="#">Latest Customers</a></li>
                                        <!-- <li aria-expanded="false"><a href="#">Membership</a></li> -->

                                        <li class="uk-tab-responsive uk-active uk-hidden" aria-haspopup="true" aria-expanded="false"><a>Active</a>
                                            <div class="uk-dropdown uk-dropdown-small">
                                                <ul class="uk-nav uk-nav-dropdown"></ul>
                                                <div></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <ul id="tabs_5" class="uk-switcher uk-margin">
                                    <li aria-hidden="false" class="uk-active">

                                        <table class="uk-table">

                                            <tbody>
                                                <?php

                                                foreach($latestcus as $key => $row){
    ?>
                                                <tr class="uk-table-middle">
                                                    <td class="uk-width-3-10 uk-text-center"><a href="customerview.php?id=<?php echo $row->id;?>"><?php echo $row->name;?></a></td>

                                                    <td class="uk-width-2-10 uk-text-center uk-text-muted uk-text-small"><?php echo $row->contact_m?></td>
                                                </tr>

                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>



                                    </li>

                                    <li aria-hidden="true">

                                        <div class="uk-alert uk-alert-danger" data-uk-alert="">
                                            All Memberships
                                            <span class="uk-badge  uk-badge-notification uk-float-right">5</span>
                                        </div>

                                        <hr />
                                        <table class="uk-table">

                                            <tbody>
                                                <?php for ($i = 1;$i <= 5;++$i) {
    ?>
                                                <tr class="uk-table-middle">
                                                    <td class="uk-width-3-10 uk-text-center"><a href="scrum_board.html">Maria</a></td>

                                                    <td class="uk-width-2-10 uk-text-center uk-text-muted uk-text-small">+6012345698</td>
                                                </tr>

                                                <?php

}?>
                                            </tbody>
                                        </table>



                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -->

                <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
                    <!-- <div class="uk-width-medium-1-2">
                        <div class="md-card">
                            <div class="md-card-content">
                                <h3 class="heading_a uk-margin-bottom">To Do List</h3>
                                <div class="uk-overflow-container">
                                    <table class="uk-table">
                                        <thead>
                                            <tr>
                                                <th class="uk-text-nowrap">Task</th>
                                                <th class="uk-text-nowrap">Status</th>
                                                <th class="uk-text-nowrap">Progress</th>
                                                <th class="uk-text-nowrap uk-text-right">Due Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10 uk-text-nowrap"><a href="scrum_board.html">ALTR-231</a></td>
                                                <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge">In progress</span></td>
                                                <td class="uk-width-3-10">
                                                    <div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove">
                                                        <div class="uk-progress-bar" style="width: 40%;"></div>
                                                    </div>
                                                </td>
                                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">24.11.2015</td>
                                            </tr>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10 uk-text-nowrap"><a href="scrum_board.html">ALTR-82</a></td>
                                                <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge uk-badge-warning">Open</span></td>
                                                <td class="uk-width-3-10">
                                                    <div class="uk-progress uk-progress-mini uk-progress-success uk-margin-remove">
                                                        <div class="uk-progress-bar" style="width: 82%;"></div>
                                                    </div>
                                                </td>
                                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">21.11.2015</td>
                                            </tr>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10 uk-text-nowrap"><a href="scrum_board.html">ALTR-123</a></td>
                                                <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge uk-badge-primary">New</span></td>
                                                <td class="uk-width-3-10">
                                                    <div class="uk-progress uk-progress-mini uk-margin-remove">
                                                        <div class="uk-progress-bar" style="width: 0;"></div>
                                                    </div>
                                                </td>
                                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">12.11.2015</td>
                                            </tr>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10 uk-text-nowrap"><a href="scrum_board.html">ALTR-164</a></td>
                                                <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge uk-badge-success">Resolved</span></td>
                                                <td class="uk-width-3-10">
                                                    <div class="uk-progress uk-progress-mini uk-progress-primary uk-margin-remove">
                                                        <div class="uk-progress-bar" style="width: 61%;"></div>
                                                    </div>
                                                </td>
                                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">17.11.2015</td>
                                            </tr>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10 uk-text-nowrap"><a href="scrum_board.html">ALTR-123</a></td>
                                                <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge uk-badge-danger">Overdue</span></td>
                                                <td class="uk-width-3-10">
                                                    <div class="uk-progress uk-progress-mini uk-progress-danger uk-margin-remove">
                                                        <div class="uk-progress-bar" style="width: 10%;"></div>
                                                    </div>
                                                </td>
                                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">12.11.2015</td>
                                            </tr>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10"><a href="scrum_board.html">ALTR-92</a></td>
                                                <td class="uk-width-2-10"><span class="uk-badge uk-badge-success">Open</span></td>
                                                <td class="uk-width-3-10">
                                                    <div class="uk-progress uk-progress-mini uk-margin-remove">
                                                        <div class="uk-progress-bar" style="width: 90%;"></div>
                                                    </div>
                                                </td>
                                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">08.11.2015</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="uk-width-medium-1-2">
                        <div class="md-card">
                            <div class="md-card-content">
                                <h3 class="heading_a uk-margin-bottom">Membership Approval</h3>
                                <div class="uk-overflow-container">
                                    <table class="uk-table">
                                        <thead>
                                            <tr>
                                                <th class="uk-text-nowrap uk-text-center">Customer Name</th>
                                                <th class="uk-text-nowrap uk-text-center">Email</th>
                                                <th class="uk-text-nowrap uk-text-center">Purchase Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php for ($i = 1;$i <= 6;++$i) {
    ?>
                                            <tr class="uk-table-middle">
                                                <td class="uk-width-3-10 uk-text-center"><a href="scrum_board.html">Maria</a></td>
                                                <td class="uk-text-center">ruzaini@ourtech.my</td>

                                                <td class="uk-width-2-10 uk-text-center uk-text-muted uk-text-small">RM 50000</td>
                                            </tr>
                                            <?php
} ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>








                    </div> -->
                </div>

                <?php include 'footer.php';?>
                <!-- page specific plugins -->
                <!-- d3 -->
                <script src="<?php echo ASSETSURL;?>bower_components/d3/d3.min.js"></script>
                <!-- metrics graphics (charts) -->
                <script src="<?php echo ASSETSURL;?>bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
                <!-- chartist (charts) -->
                <script src="<?php echo ASSETSURL;?>bower_components/chartist/dist/chartist.min.js"></script>
                <!-- maplace (google maps) -->
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
                <script src="<?php echo ASSETSURL;?>bower_components/maplace.js/src/maplace-0.1.3.js"></script>
                <!-- peity (small charts) -->
                <script src="<?php echo ASSETSURL;?>bower_components/peity/jquery.peity.min.js"></script>
                <!-- easy-pie-chart (circular statistics) -->
                <script src="<?php echo ASSETSURL;?>bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
                <!-- countUp -->
                <script src="<?php echo ASSETSURL;?>bower_components/countUp.js/countUp.min.js"></script>
                <!-- handlebars.js -->
                <script src="<?php echo ASSETSURL;?>bower_components/handlebars/handlebars.min.js"></script>
                <script src="<?php echo JS;?>custom/handlebars_helpers.min.js"></script>
                <!-- CLNDR -->
                <script src="<?php echo ASSETSURL;?>bower_components/clndr/src/clndr.js"></script>
                <!-- fitvids -->
                <script src="<?php echo ASSETSURL;?>bower_components/fitvids/jquery.fitvids.js"></script>

                <!--  dashbord functions -->
                <script src="<?php echo JS;?>pages/dashboard.min.js"></script>


                <script src="c3js.php?type=leadstatus" type="text/javascript"></script>
                <script src="c3js.php?type=gauge&name=targetsale&val=<?php echo $precent;?>" type="text/javascript"></script>




                <script>


<?php if($user->isSale()){ ?>
                var c3chart_donut_id = '#leadsource';
              var chart = c3.generate({
                bindto: c3chart_donut_id,
                  data: {
                      columns: [
                        <?php
                        $nodata=0;
                        foreach ($lso as $key => $value){

                          $aa=$list->getSource2($key);
                          if($value!=0){
                            $nodata=1;
                          echo '["'.$aa->name.'", '.$value.'],'.PHP_EOL;
                          }

                        }
                        if(!$nodata)
                        {
                          echo "['No Data','1'],".PHP_EOL;
                        }
                        ?>
                      ],
                      type : 'donut',
                      onclick: function (d, i) { console.log("onclick", d, i); },
                      onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                      onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                  },
                  donut: {
                      title: "",
                      width: 60
                  }
              });


              var c3chart_donut_id = '#leadstatus';
            var chart = c3.generate({
              bindto: c3chart_donut_id,
                data: {
                    columns: [
                      <?php
                      $nodata=0;
                      foreach ($lst as $key => $value){
                        $aa=$list->getStatus2($key);
                        if($value!=0){
                          $nodata=1;
                        echo '["'.$aa->data.'", '.$value.'],'.PHP_EOL;
                        }

                      }
                      if(!$nodata)
                      {
                        echo "['No Data','1'],".PHP_EOL;
                      }
                      ?>
                    ],
                    type : 'donut',
                    onclick: function (d, i) { console.log("onclick", d, i); },
                    onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                    onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                },
                donut: {
                    title: "",
                    width: 50
                }
            });

            <?php }else {
?>
var c3chart_donut_id = '#analysistotalsaleleads';
var chart = c3.generate({
bindto: c3chart_donut_id,
  data: {
      columns: [
        <?php
        $nodata=0;
        foreach ($lso as $key => $value){

          $aa=$list->getSource2($key);
          if($value!=0){
            $nodata=1;
          echo '["'.$aa->name.'", '.$value.'],'.PHP_EOL;
          }

        }
        if(!$nodata)
        {
          echo "['No Data','1'],".PHP_EOL;
        }
        ?>
      ],
      type : 'donut',
      onclick: function (d, i) { console.log("onclick", d, i); },
      onmouseover: function (d, i) { console.log("onmouseover", d, i); },
      onmouseout: function (d, i) { console.log("onmouseout", d, i); }
  },
  donut: {
      title: "",
      width: 60
  }
});


var c3chart_donut_id = '#analysisinterest';
var chart = c3.generate({
bindto: c3chart_donut_id,
  data: {
      columns: [
        <?php
        $nodata=0;
        foreach ($lso as $key => $value){

          $aa=$list->getSource2($key);
          if($value!=0){
            $nodata=1;
          echo '["'.$aa->name.'", '.$value.'],'.PHP_EOL;
          }

        }
        if(!$nodata)
        {
          echo "['No Data','1'],".PHP_EOL;
        }
        ?>
      ],
      type : 'donut',
      onclick: function (d, i) { console.log("onclick", d, i); },
      onmouseover: function (d, i) { console.log("onmouseover", d, i); },
      onmouseout: function (d, i) { console.log("onmouseout", d, i); }
  },
  donut: {
      title: "",
      width: 60
  }
});


var c3chart_donut_id = '#analysissalesleadssource';
var chart = c3.generate({
bindto: c3chart_donut_id,
  data: {
      columns: [
        <?php
        $nodata=0;
        foreach ($lso as $key => $value){

          $aa=$list->getSource2($key);
          if($value!=0){
            $nodata=1;
          echo '["'.$aa->name.'", '.$value.'],'.PHP_EOL;
          }

        }
        if(!$nodata)
        {
          echo "['No Data','1'],".PHP_EOL;
        }
        ?>
      ],
      type : 'donut',
      onclick: function (d, i) { console.log("onclick", d, i); },
      onmouseover: function (d, i) { console.log("onmouseover", d, i); },
      onmouseout: function (d, i) { console.log("onmouseout", d, i); }
  },
  donut: {
      title: "",
      width: 60
  }
});
            <?php } ?>


                               $(document).ready(function() {

                                 $('#start_date,#end_date').on('change',function(){

                                   var start=$('#start_date').val();
                                   var end=$('#end_date').val();
                                   var protocol = window.location.protocol;
                                   var hostname = window.location.hostname;
                                   var pathname = window.location.pathname;
                                   var url=protocol+'//'+hostname+pathname+'?bystart='+start+'&byend='+end+'&filterbystart';
                                   top.location.href = url;
                                 });



                                   function startChange() {
                                       var startDate = start.value(),
                                       endDate = end.value();

                                       if (startDate) {
                                           startDate = new Date(startDate);
                                           startDate.setDate(startDate.getDate());
                                           end.min(startDate);
                                       } else if (endDate) {
                                           start.max(new Date(endDate));
                                       } else {
                                           endDate = new Date();
                                           start.max(endDate);
                                           end.min(endDate);
                                       }
                                   }

                                   function endChange() {
                                       var endDate = end.value(),
                                       startDate = start.value();

                                       if (endDate) {
                                           endDate = new Date(endDate);
                                           endDate.setDate(endDate.getDate());
                                           start.max(endDate);
                                       } else if (startDate) {
                                           end.min(new Date(startDate));
                                       } else {
                                           endDate = new Date();
                                           start.max(endDate);
                                           end.min(endDate);
                                       }
                                   }

                                   var pastDate = new Date(2015,11,15);

                                   var start = $("#start_date").kendoDatePicker({
                                     format: "dd/MM/yyyy",
                                     min: pastDate,
                                       change: startChange
                                   }).data("kendoDatePicker");

                                   var end = $("#end_date").kendoDatePicker({
                                     format: "dd/MM/yyyy",

                                     min: pastDate,
                                       change: endChange
                                   }).data("kendoDatePicker");

                                   start.max(end.value());
                                   end.min(start.value());
                               });
                           </script>

    </body>

    </html>
