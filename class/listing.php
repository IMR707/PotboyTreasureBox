<?php
set_time_limit(0);
ini_set('memory_limit', '-1');

if (!defined('_VALID_PHP')) {
    die('Direct access to this location is not allowed.');
}
use Httpful\Request;
use Carbon\Carbon;

class Listing
{
    const tb_hs = 'aa_homeslider';
    const tb_an = 'aa_announcement';
    const tb_rewardcus = 'lof_rewardpoints_customer';
    const tb_rewardSpintrans = 'lof_rewardpoints_spin_transaction';
    const tb_rewardtrans = 'lof_rewardpoints_transaction';
    const tb_rewardcredit = 'customer_credit';
    const tb_dr = 'aa_dailyreward';
    const tb_drtran = 'aa_dailyreward_transaction';
    const tb_wof = 'aa_fortune';
    const tb_cr = 'aa_conversion';
    const tb_prod = 'aa_product';
    const tb_spon = 'aa_sponsor';
    const tb_bid = 'aa_bidding';
    const tb_bidtrans = 'aa_bidding_transaction';

    const tb_claim = 'aa_instantclaim';
    const tb_vouc = 'aa_voucher';

    const lTable = 'leads';
    const leTable = 'leadenquiry';
    const custleTable = 'custenquiry';
    const conTable = 'countries';
    const posTable = 'postcode';
    const remleadTable = 'leadremark';
    const remcusTable = 'customerremark';
    const stTable = 'saletarget';
    const staTable = 'state';
    const sorTable = 'source';
    const prTable = 'project';
    const fTable = 'fontawesome';
    const baTable = 'businessassociates';
    const cTable = 'company';
    const bTable = 'beneficiary';
    const sTable = 'status';
    const pTable = 'paymentdetail';
    const cusTable = 'customerlist';
    const purTable = 'custpurchaselist';
    const cuspurTable = 'customer_purchase';
    const cloTable = 'closesale';
    const pbilTable = 'billing_progress';
    const memTypeTable = 'membership_type';
    const dTable = 'data';
    const clrTable = 'cusleadlink';
    const siteTable = 'site_progress';
    const homeTable = 'home_slider';
    const hdirTable = 'hdirect';


    private static $db;
    public function __construct()
    {
        self::$db = Registry::get('Database');
    }

    public function FEgetBidding($type)
    {
        $sql=  'SELECT b.*,b.id as bidid,pr.*, (case
      when (b.bid_base = 1 and b.end_time >= NOW()) THEN 1
      when (b.bid_base = 2 and b.max_participant > (select count(*) FROM '.self::tb_bidtrans.' bt where bt.bidding_id=b.id )) THEN 1
 ELSE 0 END) as state,
 (case
 when (b.bid_base = 1) THEN FLOOR((TIMESTAMPDIFF(MINUTE,b.start_time,NOW())/TIMESTAMPDIFF(MINUTE,b.start_time,b.end_time))*100)
 when (b.bid_base = 2) THEN ((select count(*) FROM '.self::tb_bidtrans.' bt where bt.bidding_id=b.id )/b.max_participant)*100
END) as percent,
 (select count(*) FROM '.self::tb_bidtrans.' bt where bt.bidding_id=b.id ) as participant FROM '.self::tb_bid." b join ".self::tb_prod." pr on b.product_id=pr.id having state=1";
        $row = self::$db->fetch_all($sql);
        $row2=$this->FEgetAllClaim();
        $row3=array_merge($row,$row2);
        // 1 = top
      // 2 = end soon
      // 3 = new
      // 4 = proce down
      // 5 = price up
        switch ($type) {
        case '1':
        usort($row3, "sortparticipantuptodown");
        break;
        case '2':
        usort($row3, "sortpercentuptodown");
        break;
        case '3':
        usort($row3, "sortnewuptodown");
        break;
        case '4':
        usort($row3, "sortpriceuptodown");
        break;
        case '5':
        usort($row3, "sortpricedowntoup");
        break;
      }
      return $row3;
    }

    public function FEgetBiddingUI($value){
      if($value->bid_base==1)pre($value);
      ?>

      <div class="col-sm-6 col-md-6 col-xs-12 text-center">
            <div class="panel panel-flat timeline-content">
              <div class="panel-body">
                <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                <a href="#" class="display-block content-group">
                  <img src="<?php echo BACK_UPLOADS;?><?php echo $value->img_header;?>" class="img-responsive" alt="">
                </a>
                  <h6 class="content-group text-left"><?php echo styleword($value->name);?>-<?php if($value->bid_base!=3){ echo " min ";} echo $value->min_bid; echo ($value->bid_type==1)?" Gold":" Diamond";?></h6>
                  <div class="progress">
                    <div class="progress-bar bg-purple" id='textval<?php echo $value->bidid;?>' style="width: <?php echo stylewordpercent($value->percent);?>">
                      <?php if($value->percent>10){
                        ?>
                        <?php echo "<span id='text".$value->bidid."'>".stylewordpercent($value->percent)."</span>";?>
                        <?php
                      }?>
                    </div>
                    <?php if($value->percent<10){
                      ?>
                      <?php echo "<span id='text".$value->bidid."'>".stylewordpercent($value->percent)."</span>";?>
                      <?php
                    }?>
                  </div>
                </div>

                  <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                    <br>
                    <div class="clearfix"></div>

                    <span class="pull-left">


                        <?php



                        switch ($value->bid_base) {
                          case '1':

                          // $dt=$value->end_time->diffForHumans(\Carbon\Carbon::now());
                          // pre($dt);
                            ?>
                            <ul class="list-inline list-inline-condensed heading-text pull-left">
                            <li>Close in</li>
                            </ul>
                            <br>
                            <ul class="list-inline list-inline-condensed heading-text pull-left">
                            <li><b><?php echo $value->max_participant;?></b></li>
                            </ul>
                            <br>
                            <?php
                            break;

                            case '2':
                            ?>
                            <ul class="list-inline list-inline-condensed heading-text pull-left">
                            <li>Need <b><?php echo $value->max_participant;?></b> Participant</li>
                            </ul>
                            <br>
                            <ul class="list-inline list-inline-condensed heading-text pull-left">
                            <li>Current Participant <b><?php echo $value->participant;?></b> <br></li>
                            </ul>
                            <?php
                              break;
                              case '3':
                              ?>
                              <ul class="list-inline list-inline-condensed heading-text pull-left">
                              <li>Available Voucher <b><?php echo $value->max_participant;?></b></li>
                              </ul>
                              <br>
                              <ul class="list-inline list-inline-condensed heading-text pull-left">
                              <li>Claimed Voucher <b><?php echo $value->participant;?></b> <br></li>
                              </ul>
                              <?php
                                break;

                        }?>





                    </span>

                    <span class="pull-right">
                      <?php switch ($value->bid_base) {
                        case '3':
                          ?>
                          <a href="claimpage.php?bid=<?php echo $value->bidid;?>" class="btn bg-purple">Claim Now</a>
                          <?php
                          break;

                        default:
                        ?>
                        <a href="bidpage.php?bid=<?php echo $value->bidid;?>" class="btn bg-purple">Join Now</a>

                        <?php
                          break;
                      }?>

                    </span>
                  </div>

              </div>

              <div class="panel-footer panel-footer-transparent">

              </div>
            </div>


      </div>

      <?php
      }

    public function FEgetAllClaim()
    {
      $sql = 'SELECT *,img_thumbnail as img_header,
      3 as bid_base,
      1 as bid_type,
      id as bidid,
      title as name,
      gold_amount as min_bid,
      (select count(*) FROM '.self::tb_vouc.' vc where vc.instantclaim_id=cl.id AND cust_id IS NOT NULL) as participant,
      (select count(*) FROM '.self::tb_vouc.' vc where vc.instantclaim_id=cl.id ) as max_participant,
      ((select count(*) FROM '.self::tb_vouc.' vc where vc.instantclaim_id=cl.id AND cust_id IS NOT NULL)/(select count(*) FROM '.self::tb_vouc.' vc where vc.instantclaim_id=cl.id ))*100 as percent
       FROM '.self::tb_claim." cl where active = 1 AND publish = 1 order by percent desc";
      $row = self::$db->fetch_all($sql);
      return $row;



    }




    // const tb_claim = 'aa_instantclaim';
    // const tb_vouc = 'aa_voucher';

    public function FEgetAllConversion($id)
    {
        $sql = 'SELECT *,1 as disable FROM '.self::tb_cr." where active = 1  AND diamond_amount != 0 order by diamond_amount,prio";
        $row = self::$db->fetch_all($sql);
        if ($id) {
            $rewardata=$this->FEgetRewardData($id);
            if ($rewardata->diamond!=0) {
                foreach ($row as $key => $value) {
                    $row[$key]->disable=0;
                    if ($rewardata->diamond<$value->diamond_amount) {
                        $row[$key]->disable=1;
                    }
                }
            }
        }
        return $row;
    }


    public function FEgetAllDailyReward($id)
    {
        $dt = Carbon::now()->subDay();
        $sql = 'SELECT *,0 as done,0 as date_check FROM '.self::tb_dr." where active = 1 order by day_num";
        $row = self::$db->fetch_all($sql);
        for ($i=0; $i <count($row) ; $i++) {
            $dt=$dt->addDay();
            $dz=explode(" ", $dt);
            $day=$dz[0];
            $row[$i]->date_check=$day;
        }


        if ($row&&$id) {
            // $sql4 = 'SELECT * FROM '.self::tb_drtran." where active = 1 AND customer_id='".$id."' AND date(date_created)<'".$row[0]->date_check."' order by date_created desc";
          // $row4 = self::$db->fetch_all($sql4);
          // echo $totalrow=count($row);
          // echo $currentrow=count($row4);
          // pre($row4);
          //need repair after present z4q
            $loop=[];
            $dt = Carbon::now()->addDay();
            for ($i=0; $i <count($row) ; $i++) {
                $dt=$dt->subDay();
                $dz=explode(" ", $dt);
                $day=$dz[0];
                $loop[]=array('date'=>$day,'done'=>0);
            }

            foreach ($loop as $key => $value) {
                $sql = 'SELECT * FROM '.self::tb_drtran." where active = 1 AND customer_id='".$id."' AND date(date_created)='".$value['date']."' ";
                $row2 = self::$db->first($sql);
                if ($row2) {
                    $loop[$key]['done']=1;
                }
            }
            $temploop=$loop;
            array_shift($temploop);
            $countday=0;
            foreach ($temploop as $key => $value) {
                if ($value['done']==1) {
                    $countday++;
                } else {
                    break;
                }
            }
            $dt = Carbon::now()->addDay();
            for ($i=$countday; $i >=0 ; $i--) {
                $dt=$dt->subDay();
                $dz=explode(" ", $dt);
                $day=$dz[0];
                $row[$i]->date_check=$day;
            }
            $dt = Carbon::now();
            for ($i=$countday+1; $i <count($row) ; $i++) {
                $dt=$dt->addDay();
                $dz=explode(" ", $dt);
                $day=$dz[0];
                $row[$i]->date_check=$day;
            }
            for ($i=0; $i <$countday; $i++) {
                $row[$i]->done=1;
            }
            $dt = Carbon::now();
            $dz=explode(" ", $dt);
            $day=$dz[0];
            $sql3 = 'SELECT * FROM '.self::tb_drtran." where active = 1 AND customer_id='".$id."' AND date(date_created)='".$day."' ";
            $row3 = self::$db->first($sql3);
            if ($row3) {
                $row[$i]->done=1;
                $row[$i]->date_check=$day;
            }
        }

        foreach ($row as $key => $value) {
            if ($value->gold_check == 1 && $value->spin_check == 1) {
                $row[$key]->type = 1;
            } elseif ($value->gold_check == 1 && $value->spin_check == 0) {
                $row[$key]->type = 2;
            } else {
                $row[$key]->type = 3;
            }
        }


        return $row;
    }

    public function FEgetConversion($id, $uid)
    {
        $sql = 'SELECT * FROM '.self::tb_cr." where active = 1 AND id ='$id' ";
        $row = self::$db->first($sql);
        if ($row) {
            $diamond=$row->diamond_amount;
            $diamond =  - $diamond;
            $gold=$row->gold_amount;
            $data = array(
                'customer_id' => $uid,
                'quote_id' => '',
                'amount' => $diamond,
                'amount_used' => $diamond,
                'amount_gold' => $gold,
                'amount_gold_used' =>0,
                'title' => 'PotBoy Conversion - '.$row->name,
                'desc' => abs($diamond)." diamonds to ".$gold.' Golds',
                'code' => 'admin_add-aEEmIYncALynhaQQ',
                'action' => 'admin_add',
                'status' => 'complete',
                'params' => '',
                'is_expiration_email_sent' => 0,
                'email_message' => '',
                'apply_at' => '',
                'is_applied' => 1,
                'is_expired' => 0,
                'expires_at' => '',
                'updated_at' => 'now()',
                'created_at' => 'now()',
                'store_id' => '',
                'order_id' => '',
                'admin_user_id' => '1',
                );
            self::$db->insert(self::tb_rewardtrans, $data);
            $sql2 = 'SELECT * FROM '.self::tb_rewardcus." where customer_id ='$uid' ";
            $row2 = self::$db->first($sql2);
            $tgold=$gold+$row2->total_golds;
            $tdiamond=$diamond+$row2->total_points;
            $data2 = array(


                  'available_points' => $tdiamond,
                  'total_points' => $tdiamond,
                  'available_golds' => $tgold,
                  'total_golds' => $tgold
                  );
            self::$db->update(self::tb_rewardcus, $data2, 'customer_id='.$uid);

            return "Successfully Claim";
        } else {
            return "Please Retry Again Later";
        }
    }

    public function FEgetDailyReward($id, $uid)
    {
        $sql = 'SELECT * FROM '.self::tb_dr." where active = 1 AND day_num ='$id' ";
        $row = self::$db->first($sql);
        if ($row) {
            $gold=$row->gold_check?$row->gold_amount:0;
            $spin=$row->spin_check?$row->spin_amount:0;

            if ($gold) {
                $data = array(
                    'customer_id' => $uid,
                    'quote_id' => '',
                    'amount' => 0,
                    'amount_used' => 0,
                    'amount_gold' => $gold,
                    'amount_gold_used' =>0,
                    'title' => 'PotBoy Daily Reward - Day '.$id,
                    'desc' => $gold.' Golds',
                    'code' => 'admin_add-aEEmIYncALynhaQQ',
                    'action' => 'admin_add',
                    'status' => 'complete',
                    'params' => '',
                    'is_expiration_email_sent' => 0,
                    'email_message' => '',
                    'apply_at' => '',
                    'is_applied' => 1,
                    'is_expired' => 0,
                    'expires_at' => '',
                    'updated_at' => 'now()',
                    'created_at' => 'now()',
                    'store_id' => '',
                    'order_id' => '',
                    'admin_user_id' => '1',
                    );
                self::$db->insert(self::tb_rewardtrans, $data);
                $sql2 = 'SELECT * FROM '.self::tb_rewardcus." where customer_id ='$uid' ";
                $row2 = self::$db->first($sql2);
                $tgold=$gold+$row2->total_golds;
                $data2 = array(
                      'available_golds' => $tgold,
                      'total_golds' => $tgold
                      );
                self::$db->update(self::tb_rewardcus, $data2, 'customer_id='.$uid);
            }

            if ($spin) {
                $data = array(
                    'customer_id' => $uid,
                    'amount' => $spin,
                    'title' => 'PotBoy Daily Reward - Day '.$id,
                    'desc' => $spin.' Spin',
                    'code' => 'admin_add-aEEmIYncALynhaQQ',
                    'action' => 'admin_add',
                    'status' => 'complete',
                    'params' => '',
                    'is_expiration_email_sent' => 0,
                    'email_message' => '',
                    'apply_at' => '',
                    'is_applied' => 1,
                    'is_expired' => 0,
                    'expires_at' => '',
                    'updated_at' => 'now()',
                    'created_at' => 'now()',
                    'store_id' => '',
                    'order_id' => '',
                    'admin_user_id' => '1',
                    );
                self::$db->insert(self::tb_rewardSpintrans, $data);
                $sql2 = 'SELECT * FROM '.self::tb_rewardcus." where customer_id ='$uid' ";
                $row2 = self::$db->first($sql2);
                $tspin=$spin+$row2->total_spin;
                $data2 = array(
                      'total_spin' => $tspin,
                      );
                self::$db->update(self::tb_rewardcus, $data2, 'customer_id='.$uid);
            }

            $data = array(
                  'customer_id' => $uid,
                  'date_updated' => 'now()',
                  'date_created' => 'now()',
                  'active' => 1,
                  );
            self::$db->insert(self::tb_drtran, $data);
            return "Successfully Claim";
        } else {
            return "Please Retry Again Later";
        }
    }


    public function FEgetAnnouncement()
    {
        $sql = 'SELECT * FROM '.self::tb_an." where publish = 1 AND active = 1 order by prio,date_updated";
        $row = self::$db->fetch_all($sql);
        $text="";
        foreach ($row as $key => $value) {
            $text.=$value->content."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        return $text;
    }

    public function FEgetHomeSlider()
    {
        $sql = 'SELECT * FROM '.self::tb_hs." where publish = 1 AND active = 1 order by prio,date_updated";
        $row = self::$db->fetch_all($sql);
        return $row;
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






    public function EarliestDateLead()
    {
        $sql = 'SELECT date(MIN(created)) as mindate FROM '.self::lTable." where created!='0000-00-00 00:00:00'";
        $row = self::$db->first($sql);
        if ($row) {
            return $row->mindate;
        }
    }




    public function CheckSiteByProjectfirst($project_id)
    {
        $sql = 'SELECT * FROM '.self::siteTable." where project_id='$project_id' AND active = 1 ORDER by sort DESC";
        $row = self::$db->first($sql);
        return $row;
    }

    public function CheckSiteByProject($project_id)
    {
        $sql = 'SELECT * FROM '.self::siteTable." where project_id='$project_id' AND active = 1 ORDER by sort";
        $row = self::$db->fetch_all($sql);
        return $row;
    }

    public function CheckHomeSliderByProjectfirst($project_id)
    {
        $sql = 'SELECT * FROM '.self::homeTable." where project_id='$project_id' AND active = 1 ORDER by sort DESC";
        $row = self::$db->first($sql);
        return $row;
    }

    public function CheckHomeSliderByProject($project_id)
    {
        $sql = 'SELECT * FROM '.self::homeTable." where project_id='$project_id' AND active = 1 ORDER by sort";
        $row = self::$db->fetch_all($sql);
        return $row;
    }



    public function AddLogHistory($oldspid, $spid, $table, $data, $user)
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

    public function CustgetLeads($id)
    {
        $sql = 'SELECT * FROM '.self::clrTable." where cus_id = '$id' AND active = 1";
        $row = self::$db->first($sql);
        return $row;
    }

    public function LeadsgetCust($id)
    {
        $sql = 'SELECT * FROM '.self::clrTable." where lead_id = '$id' AND active = 1";
        $row = self::$db->first($sql);
        return $row;
    }

    public function UpdateLeadsUser($leid, $spid, $user)
    {
        $pieces = explode(",", $leid);

        foreach ($pieces as $key => $value) {
            $row = self::$db->first('SELECT * FROM '.self::leTable." WHERE true AND id='" . $value . "' order by created DESC");
            $data = array(
                      'oldspid' => $row->spid,
                      'spid' => $spid,
                      'updated' => 'now()',
                      );
            self::$db->update(self::leTable, $data, 'id='.$value);
        }
        $this->AddLogHistory($row->spid, $spid, 'leads', $leid, $user);
    }






    public function getAllMemberType($type, $code, $sorting)
    {
        $a = '';
        $wh = '';
        if ($type != '') {
            $a .= "AND member_type LIKE '%$type%'";
        }

        if ($code != '') {
            $a .= "AND member_code LIKE '%$code%'";
        }

        $s = '';
        if ($sorting != '' && $sorting != '0') {
            $s .= "ORDER BY $sorting";
        }

        $sql = "SELECT * FROM ".self::memTypeTable." WHERE TRUE $a AND active='1' $s";
        $row = self::$db->fetch_all($sql);
        $a = ObjtoArr($row);

        return $a;
    }


    public function getMyLeadsClosingRatio($type, $id)
    {
        switch ($type) {
                  case 'thismonth':
                      $startdate = date('Y').'-'.date('m').'-01 00:00:00';
                      $enddate = date('Y-m-t', strtotime($startdate));
                      $enddate = $enddate.' 23:59:59';
                  break;
                  case 'bymonth':
                      $pieces = explode('/', $_GET['bymonth']);
                      $startdate = $pieces[1].'-'.$pieces[0].'-01 00:00:00';
                      $enddate = date('Y-m-t', strtotime($startdate));
                      $enddate = $enddate.' 23:59:59';
                  break;
                  case 'byyear':
                      $startdate = $_GET['byyear'].'-01-01 00:00:00';
                      $enddate = $_GET['byyear'].'-12-31 23:59:59';
                  break;
                  case 'bystart':
                  $pieces = explode('/', $_GET['bystart']);
                  $startdate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 00:00:00';
                  $pieces = explode('/', $_GET['byend']);
                  $enddate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 23:59:59';
                  break;
                  }

        $sqla = 'SELECT *,COALESCE(respond, NOW()) as responded FROM '.self::leTable." where spid='$id' AND active='1' AND (created BETWEEN '$startdate' AND '$enddate') ORDER BY created DESC";
        $rowa = self::$db->fetch_all($sqla);
        $leadsid=array();
        foreach ($rowa as $key => $value) {
            $leadsid[]=$value->id;
        }
        if (!empty($leadsid)) {
            $lid=array_unique($leadsid);
            $clid=count($lid);
            $sql1 = 'SELECT * FROM '.self::cloTable."  WHERE leid IN ( ".implode(',', $lid).") AND active = 1 AND (created BETWEEN '$startdate' AND '$enddate')";
            $rows1 = self::$db->fetch_all($sql1);
            $totalclosed=count($rows1);
            $a=($totalclosed/$clid)*100;
            return array(
      'close'=>count($rows1),
      'total'=>$clid,
      'percent'=> number_format($a, 2)."%"
    );
        } else {
            return array(
      'close'=>'0',
      'total'=>'0',
      'percent'=> '0 %'
    );
        }
    }


    public function getProgressStage($project_id)
    {
        $sql = 'SELECT * FROM '.self::pbilTable." where project_id = '$project_id' AND active = 1";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getResponsebyID($type, $id)
    {
        switch ($type) {
                  case 'thismonth':
                      $startdate = date('Y').'-'.date('m').'-01 00:00:00';
                      $enddate = date('Y-m-t', strtotime($startdate));
                      $enddate = $enddate.' 23:59:59';
                  break;
                  case 'bymonth':
                      $pieces = explode('/', $_GET['bymonth']);
                      $startdate = $pieces[1].'-'.$pieces[0].'-01 00:00:00';
                      $enddate = date('Y-m-t', strtotime($startdate));
                      $enddate = $enddate.' 23:59:59';
                  break;
                  case 'byyear':
                      $startdate = $_GET['byyear'].'-01-01 00:00:00';
                      $enddate = $_GET['byyear'].'-12-31 23:59:59';
                  break;
                  case 'bystart':
                  $pieces = explode('/', $_GET['bystart']);
                  $startdate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 00:00:00';
                  $pieces = explode('/', $_GET['byend']);
                  $enddate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 23:59:59';
                  break;
                  }

        $sql = 'SELECT *,COALESCE(respond, NOW()) as responded FROM '.self::leTable." where spid='$id' AND (created BETWEEN '$startdate' AND '$enddate')";
        $row = self::$db->fetch_all($sql);
        $total = 0;
        $totalsecond = 0;
        foreach ($row as $key => $value) {
            $total++;
            $timeFirst  = strtotime($value->created);
            $timeSecond = strtotime($value->responded);
            $differenceInSeconds = $timeSecond - $timeFirst;
            $totalsecond += $differenceInSeconds;
        }
        if ($total) {
            return $this->secondsToTime($totalsecond/$total);
        } else {
            return '-';
        }
    }


    public function secondsToTime($seconds)
    {
        $seconds = (int) $seconds;
        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
    }

    public function getClosesalebyID($type, $id)
    {
        switch ($type) {
                case 'thismonth':
                    $startdate = date('Y').'-'.date('m').'-01 00:00:00';
                    $enddate = date('Y-m-t', strtotime($startdate));
                    $enddate = $enddate.' 23:59:59';
                break;
                case 'bymonth':
                    $pieces = explode('/', $_GET['bymonth']);
                    $startdate = $pieces[1].'-'.$pieces[0].'-01 00:00:00';
                    $enddate = date('Y-m-t', strtotime($startdate));
                    $enddate = $enddate.' 23:59:59';
                break;
                case 'byyear':
                    $startdate = $_GET['byyear'].'-01-01 00:00:00';
                    $enddate = $_GET['byyear'].'-12-31 23:59:59';
                break;

                case 'bystart':
                $pieces = explode('/', $_GET['bystart']);
                $startdate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 00:00:00';
                $pieces = explode('/', $_GET['byend']);
                $enddate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 23:59:59';
                break;
                }
        $sql = 'SELECT * FROM '.self::cloTable." where saleperson='$id' AND (created BETWEEN '$startdate' AND '$enddate')";
        $row = self::$db->fetch_all($sql);
        $total = 0;
        foreach ($row as $key => $value) {
            $total += $value->amount;
        }
        return $total;
    }


    public function getLeadSourcebyID($type, $user)
    {
        switch ($type) {
                case 'thismonth':
                    $startdate = date('Y').'-'.date('m').'-01 00:00:00';
                    $enddate = date('Y-m-t', strtotime($startdate));
                    $enddate = $enddate.' 23:59:59';
                break;
                case 'bymonth':
                    $pieces = explode('/', $_GET['bymonth']);
                    $startdate = $pieces[1].'-'.$pieces[0].'-01 00:00:00';
                    $enddate = date('Y-m-t', strtotime($startdate));
                    $enddate = $enddate.' 23:59:59';
                break;
                case 'byyear':
                    $startdate = $_GET['byyear'].'-01-01 00:00:00';
                    $enddate = $_GET['byyear'].'-12-31 23:59:59';
                break;

                case 'bystart':
                $pieces = explode('/', $_GET['bystart']);
                $startdate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 00:00:00';
                $pieces = explode('/', $_GET['byend']);
                $enddate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 23:59:59';
                break;
                }
        $w='';
        if ($user->isSale()) {
            $w="AND spid='$user->uid'";
        }
        $sql = 'SELECT *,COALESCE(respond, NOW()) as responded FROM '.self::leTable." where TRUE $w AND active='1' AND (created BETWEEN '$startdate' AND '$enddate')  ORDER BY created DESC";
        $row = self::$db->fetch_all($sql);
        $so=array();
        foreach ($row as $key => $value) {
            $source=$this->getSource2($value->source);
            $so[]=$source->id;
        }
        $parent=$this->getSourceParent(0);
        $se=array();
        foreach ($parent as $key => $value) {
            $se[$value]=0;
        }

        if (!empty($so)) {
            $a=array_count_values($so);
            foreach ($a as $key => $value) {
                $se[$key]=$value;
            }
        }
        return $se;
    }


    public function getLeadStatusbyID($type, $user)
    {
        switch ($type) {
                case 'thismonth':
                    $startdate = date('Y').'-'.date('m').'-01 00:00:00';
                    $enddate = date('Y-m-t', strtotime($startdate));
                    $enddate = $enddate.' 23:59:59';
                break;
                case 'bymonth':
                    $pieces = explode('/', $_GET['bymonth']);
                    $startdate = $pieces[1].'-'.$pieces[0].'-01 00:00:00';
                    $enddate = date('Y-m-t', strtotime($startdate));
                    $enddate = $enddate.' 23:59:59';
                break;
                case 'byyear':
                    $startdate = $_GET['byyear'].'-01-01 00:00:00';
                    $enddate = $_GET['byyear'].'-12-31 23:59:59';
                break;

                case 'bystart':
                $pieces = explode('/', $_GET['bystart']);
                $startdate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 00:00:00';
                $pieces = explode('/', $_GET['byend']);
                $enddate = $pieces[2].'-'.$pieces[1].'-'.$pieces[0].' 23:59:59';
                break;
                }
        $w='';
        if ($user->isSale()) {
            $w="AND spid='$user->uid'";
        }
        $sql = 'SELECT *,COALESCE(respond, NOW()) as responded FROM '.self::leTable." where TRUE $w AND active='1' AND (created BETWEEN '$startdate' AND '$enddate')  ORDER BY created DESC";
        $row = self::$db->fetch_all($sql);
        $so=array();
        foreach ($row as $key => $value) {
            $source=$this->getStatus2($value->status);
            $so[]=$source->id;
        }
        $parent=$this->getAllStatus();

        $se=array();
        foreach ($parent as $key => $value) {
            $se[$value->id]=0;
        }
        if (!empty($so)) {
            $a=array_count_values($so);
            foreach ($a as $key => $value) {
                $se[$key]=$value;
            }
        }
        return $se;
    }
    public function getMyCloseSale($id)
    {
        $sql = 'SELECT * FROM '.self::cloTable." where leid='$id'";
        $row = self::$db->first($sql);

        return $row;
    }
    public function getMyCloseSaleCheck($id)
    {
        $sql = 'SELECT * FROM '.self::cloTable." where leid='$id'";
        $row = self::$db->first($sql);
        if ($row) {
            return 1;
        } else {
            return 0;
        }
    }

    public function ApproveMembership($pd)
    {
        $uid = $pd['id'];
        $data = array(
            'membership' =>$pd['m'],
            'updated'=>'NOW()'
            );
        self::$db->update(self::cusTable, $data, 'id='.$uid);
        $json['type'] = 'success';
        $json['title'] = 'Success';
        $json['message'] = 'Successfully Edit the Lead Enquiry.';
        return json_encode($json);
    }


    public function DeleteCustomersUser($pd)
    {
        $uid = $pd['cid'];
        $data = array(
              'active' => '0',
              );
        self::$db->update(self::cusTable, $data, 'id='.$uid);
        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Lead Enquiry.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => 'Error Updating Data');

            return json_encode($a);
        }
    }
    public function DeleteLeadsUser($pd)
    {
        $uid = $pd['lid'];
        $data = array(
'active' => '0',
);
        self::$db->update(self::lTable, $data, 'id='.$uid);
        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Lead Enquiry.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => 'Error Updating Data');

            return json_encode($a);
        }
    }
    public function DeleteCustomersRemark($pd)
    {
        $uid = $pd['rid'];
        $data = array(
'active' => '0',
);
        self::$db->update(self::remcusTable, $data, 'id='.$uid);
        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Lead Enquiry.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => 'Error Updating Data');

            return json_encode($a);
        }
    }
    public function DeleteLeadsRemark($pd)
    {
        $uid = $pd['rid'];
        $data = array(
'active' => '0',
);
        self::$db->update(self::remleadTable, $data, 'id='.$uid);
        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Lead Enquiry.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => 'Error Updating Data');

            return json_encode($a);
        }
    }
    public function ClosesaleLeadsEnquiry($pd)
    {
        $error= '';
        if (strlen($pd['project']) <= 0) {
            $error .= "Please enter The Close sale Project\n";
        }
        if (strlen($pd['saleperson']) <= 0) {
            $error .= "Please Select Sale Person\n";
        }
        if ($pd['amount1'] > 0 && $pd['nounit1']=='') {
            $error .= "Please Enter the Unit Number 1\n";
        }
        if ($pd['amount2'] > 0 && $pd['nounit2']=='') {
            $error .= "Please Enter the Unit Number 2\n";
        }
        if ($pd['amount3'] > 0 && $pd['nounit3']=='') {
            $error .= "Please Enter the Unit Number 3\n";
        }

        if ($pd['amount4'] > 0 && $pd['nounit4']=='') {
            $error .= "Please Enter the Unit Number 4\n";
        }
        if ($pd['amount5'] > 0 && $pd['nounit5']=='') {
            $error .= "Please Enter the Unit Number 5\n";
        }
        if (strlen($pd['amount1']) <= 0) {
            $error .= "Please Enter the Amount of Sale Unit 1\n";
        }

        if (strlen($pd['amount2']) <= 0) {
            $error .= "Please Enter the Amount of Sale Unit 2\n";
        }

        if (strlen($pd['amount3']) <= 0) {
            $error .= "Please Enter the Amount of Sale Unit 3\n";
        }

        if (strlen($pd['amount4']) <= 0) {
            $error .= "Please Enter the Amount of Sale Unit 4\n";
        }

        if (strlen($pd['amount5']) <= 0) {
            $error .= "Please Enter the Amount of Sale Unit 5\n";
        }


        if ($error == '') {
            $project = sanitize($pd['project']);
            $saleperson = sanitize($pd['saleperson']);
            $amount = $pd['amount1']+$pd['amount2']+$pd['amount3']+$pd['amount4']+$pd['amount5'];
            $arramount=$pd['amount1'].",".$pd['amount2'].",".$pd['amount3'].",".$pd['amount4'].",".$pd['amount5'];
            $nounit=$pd['nounit1'].",".$pd['nounit2'].",".$pd['nounit3'].",".$pd['nounit4'].",".$pd['nounit5'];
            $remark = $pd['remark'];
            $uid = $pd['leid'];
            $exist = $this->getMyCloseSaleCheck($uid);
            $data = array(
                          'project' => $project,
                          'saleperson' => $saleperson,
                          'amount' => $amount,
                          'arramount' => $arramount,
                          'remark' => $remark,
                          'nounit' => $nounit,
                          'created' => 'now()',
                          'updated' => 'now()',
                          );
            if ($exist) {
                self::$db->update(self::cloTable, $data, 'leid='.$uid);
            } else {
                $data['leid'] = $uid;
                self::$db->insert(self::cloTable, $data);
            }
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $l = $exist ? 'Updated' : ' Insert New ';
                $json['message'] = 'Successfully '.$l.' the Lead Enquiry.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }
    public function EditRespondLeadsEnquiry($pd)
    {
        $error = '';
        if (strlen($pd['enquiry']) <= 0) {
            $error .= "Please enter The Enquiry\n";
        }
        if (strlen($pd['status']) <= 0) {
            $error .= "Please Select the Status\n";
        }
        if (strlen($pd['source']) <= 0) {
            $error .= "Please Select the Source\n";
        }
        if ($error == '') {
            $enquiry = sanitize($pd['enquiry']);
            $status = sanitize($pd['status']);
            $otherstatus = sanitize($pd['otherstatus']);
            $source = sanitize($pd['source']);
            $app = 0;
            if (strlen($pd['appoinment']) > 0) {
                $appoinment = sanitize($pd['appoinment']);
                $appoinment=str_replace('/', '-', $appoinment);
                $appoinment=date('Y-m-d H:i:s', strtotime($appoinment));
                $app = 1;
            }
            $uid = $pd['leid'];
            $ll = $this->getMyEN($uid);
            $respon = 0;
            if ($ll->respond == null) {
                $respon = 1;
            }
            $data = array(
                          'enquiry' => $enquiry,
                          'status' => $status,
                          'otherstatus' => $otherstatus,
                          'source' => $source,
                          'source' => $source,
                          'updated' => 'now()',
                          );
            if ($app) {
                $data['appoinment'] = $appoinment;
            }
            if ($respon) {
                $data['respond'] = 'NOW()';
            }
            self::$db->update(self::leTable, $data, 'id='.$uid);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Edit the Lead Enquiry.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }
    public function AddCustomersRemark($pd)
    {
        $error = '';
        if (strlen($pd['remark']) <= 0) {
            $error .= "Please enter Remark\n";
        }
        if ($error == '') {
            $remark = sanitize($pd['remark']);
            $cid = sanitize($pd['cid']);
            $data = array(
'remark' => $remark,
'cid' => $cid,
'created' => 'now()',
);
            self::$db->insert(self::remcusTable, $data);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Add the Remark.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }
    public function AddLeadsRemark($pd)
    {
        $error = '';
        if (strlen($pd['remark']) <= 0) {
            $error .= "Please enter Remark\n";
        }
        if ($error == '') {
            $remark = sanitize($pd['remark']);
            $lid = sanitize($pd['lid']);
            $data = array(
'remark' => $remark,
'lid' => $lid,
'created' => 'now()',
);
            $uid = $pd['lid'];
            self::$db->insert(self::remleadTable, $data);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Add the Remark.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }
    public function EditCustomersRemark($pd)
    {
        $error = '';
        if (strlen($pd['remark']) <= 0) {
            $error .= "Please enter Remark\n";
        }
        if ($error == '') {
            $remark = sanitize($pd['remark']);
            $id = sanitize($pd['rid']);
            $data = array(
'remark' => $remark,
'created' => 'now()',
);
            self::$db->update(self::remcusTable, $data, 'id='.$id);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Add the Remark.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }

    public function EditLeadsRemark($pd)
    {
        $error = '';
        if (strlen($pd['remark']) <= 0) {
            $error .= "Please enter Remark\n";
        }
        if ($error == '') {
            $remark = sanitize($pd['remark']);
            $id = sanitize($pd['rid']);
            $data = array(
'remark' => $remark,
'created' => 'now()',
);
            self::$db->update(self::remleadTable, $data, 'id='.$id);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Add the Remark.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }
    public function PushtoLeads2($a)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND email='" . $a['email'] . "' OR contact_m='" . $a['contact_m'] . "' AND email!=NULL AND contact_m!=NULL";
        $row = self::$db->first($sql);
        if (!$row) {
            $data = array(
                'name' => $a['name'],
                'salutationtype' => $a['salutationtype'],
                'email' => $a['email'],
                'icpassport' => $a['icpassport'],
                'age' => $a['age'],
                'contact_m' => $a['contact_m'],
                'contact_o' => $a['contact_o'],
                'contact_h' => $a['contact_h'],
                'address' => $a['address'],
                'postcode' => $a['postcode'],
                'country' => $a['country'],
                'occupation' => $a['occupation'],
                'hot' => $a['hot'],
                'created' => $a['created'],
                'updated' => $a['created'],
                );
                //pre($data);
                $leadsid=self::$db->insert(self::lTable, $data);
        } else {
            $leadsid=$row->id;
        }



        echo $sql = 'SELECT * FROM '.self::prTable." WHERE true AND name='" . $a['interest'] . "' AND active='1'";
        $row = self::$db->first($sql);
        if ($row) {
            $int=$row->id;
        } else {
            $data = array(
        'idpresale' => '0',
        'name' => $a['interest'],
        'first' => '1',
        );

            $int=self::$db->insert(self::prTable, $data);
        }


        switch ($a['spid']) {
  case '12':
    $oldid=26;
    break;

    case '37':
      $oldid=28;
      break;

    case '38':
      $oldid=29;
      break;
      case '39':
        $oldid=30;
        break;

        case '40':
          $oldid=31;
          break;

          case '41':
            $oldid=32;
            break;
            case '42':
              $oldid=33;
              break;
              case '45':
                $oldid=26;
                break;
                case '46':
                  $oldid=33;
                  break;

                  case '48':
                    $oldid=36;
                    break;
  default:
    $oldid=26;
    break;
}

        $spid=$oldid;
        $data2 = array(
          'leadsid' => $leadsid,
          'enquiry' => $a['enquiry'],
          'spid' => $spid,
          'position' => 1,
          'manual' => 1,
          'status' => $a['status'],
          'source' => $a['source'],
          'interest' => '['.$int.']',
          'appoinment' => $a['appoinment'],
          'created' => $a['created'],
          'updated' => $a['created'],
          );
        $int=self::$db->insert(self::leTable, $data2);
    }

    public function importmyleads($r, $user)
    {
        foreach ($r as $key => $value) {
            if ($value[0]==''||$value[1]==''||$value[5]=='') {
                echo "";
            } else {
                $name=$value[0];
                $email=$value[1];
                $gender=$value[2]=='M'?1:0;
                $icpassport=$value[3];
                $age=$value[4];
                $contact_m=$value[5];
                $contact_o=$value[6];
                $contact_h=$value[7];
                $contact_f=$value[8];
                $address=$value[9];
                $postcode=$value[10];
                $city=$value[11];
                $state=$value[12];
                $country=$value[13];
                $occupation=$value[14];
                $piority=0;
                $source=9;
                $enquiry=$value[15];
                $interest=$value[16];
                $saleperson=$user;
                $this->PushtoLeads($name, $email, $gender, $icpassport, $age, $contact_m, $contact_o, $contact_h, $contact_f, $address, $postcode, $city, $state, $country, $occupation, $piority, $source, $enquiry, $interest, $saleperson);
            }
        }
    }

    public function importmyteams($r)
    {
        foreach ($r as $key => $value) {
            if ($value[0]==''||$value[1]==''||$value[5]=='') {
                echo "";
            } else {
                $name=$value[0];
                $email=$value[1];
                $gender=$value[2]=='M'?1:0;
                $icpassport=$value[3];
                $age=$value[4];
                $contact_m=$value[5];
                $contact_o=$value[6];
                $contact_h=$value[7];
                $contact_f=$value[8];
                $address=$value[9];
                $postcode=$value[10];
                $city=$value[11];
                $state=$value[12];
                $country=$value[13];
                $occupation=$value[14];
                $piority=0;
                $source=9;
                $enquiry=$value[15];
                $interest=$value[16];
                $saleperson=0;
                $this->PushtoLeads($name, $email, $gender, $icpassport, $age, $contact_m, $contact_o, $contact_h, $contact_f, $address, $postcode, $city, $state, $country, $occupation, $piority, $source, $enquiry, $interest, $saleperson);
            }
        }
    }
    public function PushtoLeads($name, $email, $gender, $icpassport, $age, $contact_m, $contact_o, $contact_h, $contact_f, $address, $postcode, $city, $state, $country, $occupation, $piority, $source, $enquiry, $interest, $saleperson)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND email='" . $email . "' OR contact_m='" . $contact_m . "'";
        $row = self::$db->first($sql);

        if ($row) {
            $leadsid=$row->id;
            $sql = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid='" . $leadsid . "' order by created DESC";
            $row2 = self::$db->first($sql);
            $saleperson=$row2->spid;
        } else {
            $data = array(
                            'name' => $name,
                            'email' => $email,
                            'gender' => $gender,
                            'icpassport' => $icpassport,
                            'age' => $age,
                            'contact_m' => $contact_m,
                            'contact_o' => $contact_o,
                            'contact_h' => $contact_h,
                            'contact_f' => $contact_f,
                            'address' => $address,
                            'postcode' => $postcode,
                            'city' => $city,
                            'state' => $state,
                            'country' => $country,
                            'occupation' => $occupation,
                            'hot' => $piority,
                            'updated' => 'now()',
                            );
            $leadsid=self::$db->insert(self::lTable, $data);
        }
        if ($saleperson!=0) {
            if ($saleperson=='36') {
                $spid='36';
                $position='1';
            } else {
                $a=Users::getUserbyID($saleperson);
                $b=$this->getCurrentLead();
                if (is_object($a)) {
                    $spid=$saleperson;
                    $position=1;
                } else {
                    $spid=$b[0];
                    $position=$b[1];
                }
                $manual=1;
            # code...
            }
        } else {
            $b=$this->getCurrentLead();
            $spid =$b[0];
            $position = $b[1];
        }


        $sql = 'SELECT * FROM '.self::prTable." WHERE true AND name='" . $interest . "' AND active='1'";
        $row = self::$db->first($sql);
        if ($row) {
            $int=$row->id;
        } else {
            $data = array(
        'idpresale' => '0',
        'name' => $interest,
        'first' => '1',
        );
            $int=self::$db->insert(self::prTable, $data);
        }


        $saledata = Users::getUserbyID($spid);
        $email=$saledata->email;
        $name=$saledata->fullname;
        $emailnoreply='noreply@titijaya.com.my';
        $subject="Titijaya CRM : New Leads Assigned to you";
        $content="<font face=\"arial\">Dear $name,<br><br> A new Leads is assigned to you. <br><br>Please <a href='http://crm.titijaya.com.my'>Click here to View</a><br><br><br>Regards,<br>Titijaya CRM</font>";

        $headers = "From: $name<$emailnoreply>\r\n";
        $headers .= "Reply-To: $emailnoreply\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        if (mail($email, $subject, $content, $headers)) {
            echo 'Your message has been sent.<br>';
        } else {
            echo 'There was a problem sending the email.<br>';
        }

        $data = array(
      'leadsid' => $leadsid,
      'enquiry' => $enquiry,
      'spid' => $spid,
      'position' => $position,
      'source' => $source,
      'interest' => '['.$int.']',
      'updated' => 'now()',
      );


        if (self::$db->insert(self::leTable, $data)) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Project.';

            return ($json);
        } else {
            $a = array('type' => 'error', 'error' => 'Error Inserting Leads enquiry Data');

            return ($a);
        }
    }


    public function EditHomesliderprogress($pd)
    {
        $error = '';
        if (strlen($pd['title']) <= 0) {
            $error .= "Please enter Home Slider Title\n";
        }
        if (strlen($pd['imglink']) <= 0) {
            $error .= "Please Upload Home Slider Image\n";
        }


        if ($error == '') {
            $title = sanitize($pd['title']);
            $imglink = sanitize($pd['imglink']);
            $data = array(
'title' => $title,
'img_name' => $imglink,
'updated' => 'now()',
);
            self::$db->update(self::homeTable, $data, 'id='.$pd['id']);

            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Project.';
            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => $error);
            return json_encode($a);
        }
    }

    public function EditSiteprogress($pd)
    {
        $error = '';
        if (strlen($pd['title']) <= 0) {
            $error .= "Please enter Project Progress Title\n";
        }
        if (strlen($pd['imglink']) <= 0) {
            $error .= "Please Upload Progress Image\n";
        }
        if (strlen($pd['date_upload']) <= 0) {
            $error .= "Please enter Project Progress Date\n";
        }

        if ($error == '') {
            $title = sanitize($pd['title']);
            $imglink = sanitize($pd['imglink']);
            $date = sanitize($pd['date_upload']);
            $date=str_replace('/', '-', $date);
            $date=date('Y-m-d H:i:s', strtotime($date));
            $data = array(
'title' => $title,
'img_name' => $imglink,
'date_upload' => $date,
'updated' => 'now()',
);
            self::$db->update(self::siteTable, $data, 'id='.$pd['id']);

            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Project.';
            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => $error);
            return json_encode($a);
        }
    }


    public function AddHomesliderprogress($pd)
    {
        $error = '';
        if (strlen($pd['title']) <= 0) {
            $error .= "Please enter Project Progress Title\n";
        }
        if (strlen($pd['imglink']) <= 0) {
            $error .= "Please Upload Progress Image\n";
        }


        if ($error == '') {
            $title = sanitize($pd['title']);
            $imglink = sanitize($pd['imglink']);
            $project = sanitize($pd['project']);
            $aa=$this->CheckHomeSliderByProjectfirst($project);
            if ($aa) {
                $sort=$aa->sort+1;
            } else {
                $sort=1;
            }
            $data = array(
'title' => $title,
'img_name' => $imglink,
'project_id' => $project,
'sort' => $sort,
'date_created' => 'now()',
'updated' => 'now()',
);
            self::$db->insert(self::homeTable, $data);

            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Project.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => $error);
            return json_encode($a);
        }
    }

    public function AddSiteprogress($pd)
    {
        $error = '';
        if (strlen($pd['title']) <= 0) {
            $error .= "Please enter Project Progress Title\n";
        }
        if (strlen($pd['imglink']) <= 0) {
            $error .= "Please Upload Progress Image\n";
        }
        if (strlen($pd['date_upload']) <= 0) {
            $error .= "Please enter Project Progress Date\n";
        }

        if ($error == '') {
            $title = sanitize($pd['title']);
            $imglink = sanitize($pd['imglink']);
            $project = sanitize($pd['project']);
            $date = sanitize($pd['date_upload']);
            $date=str_replace('/', '-', $date);
            $date=date('Y-m-d H:i:s', strtotime($date));
            $aa=$this->CheckSiteByProjectfirst($project);
            if ($aa) {
                $sort=$aa->sort+1;
            } else {
                $sort=1;
            }
            $data = array(
'title' => $title,
'img_name' => $imglink,
'project_id' => $project,
'sort' => $sort,
'date_upload' => $date,
'date_created' => 'now()',
'updated' => 'now()',
);
            self::$db->insert(self::siteTable, $data);

            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Project.';

            return json_encode($json);
        } else {
            $a = array('type' => 'error', 'error' => $error);
            return json_encode($a);
        }
    }



    public function AddLeadsUser($pd)
    {
        $error = '';
        if (strlen($pd['name']) <= 0) {
            $error .= "Please enter Leads name\n";
        }
        if (strlen($pd['email']) <= 0) {
            $error .= "Please enter Leads Email\n";
        }
        if (strlen($pd['contact_m']) <= 0) {
            $error .= "Please enter Mobile Number\n";
        }
        // if (strlen($pd['address']) <= 1) {
        //     $error .= "Please enter Address\n";
        // }
        // if (strlen($pd['country']) <= 1) {
        //     $error .= "Please enter Leads Address Country \n";
        // }
        if (strlen($pd['enquiry']) <= 0) {
            $error .= "Please enter Leads Enquiry\n";
        }
        if (strlen($pd['project']) <= 0) {
            $error .= "Please enter Project Enquiry\n";
        }
        if ($error == '') {
            $name = sanitize($pd['name']);
            $email = sanitize($pd['email']);
            $gender = sanitize($pd['gender']);
            $icpassport = sanitize($pd['icpassport']);
            $age = sanitize($pd['age']);
            $contact_m = sanitize($pd['contact_m']);
            $contact_o = sanitize($pd['contact_o']);
            $contact_h = sanitize($pd['contact_h']);
            $contact_f = sanitize($pd['contact_f']);
            $address = sanitize($pd['address']);
            $postcode = sanitize($pd['postcode']);
            $city = sanitize($pd['city']);
            $state = sanitize($pd['state']);
            $country = sanitize($pd['country']);
            $occupation = sanitize($pd['occupation']);
            $saleperson = sanitize($pd['saleperson']);
            $enquiry = sanitize($pd['enquiry']);
            $project = sanitize($pd['project']);
            $data = array(
'name' => $name,
'email' => $email,
'gender' => $gender,
'icpassport' => $icpassport,
'age' => $age,
'contact_m' => $contact_m,
'contact_o' => $contact_o,
'contact_h' => $contact_h,
'contact_f' => $contact_f,
'address' => $address,
'postcode' => $postcode,
'city' => $city,
'state' => $state,
'country' => $country,
'occupation' => $occupation,
'firstspid' => $saleperson,
'updated' => 'now()',
);
            $lid = self::$db->insert(self::lTable, $data);
            if (self::$db->affected()) {
                $data = array(
'leadsid' => $lid,
'enquiry' => $enquiry,
'manual' => '1',
'spid' => $saleperson,
'interest' => '['.$project.']',
'updated' => 'now()',
);
                if (self::$db->insert(self::leTable, $data)) {
                    $json['type'] = 'success';
                    $json['title'] = 'Success';
                    $json['message'] = 'Successfully Edit the Project.';

                    return json_encode($json);
                } else {
                    $a = array('type' => 'error', 'error' => 'Error Inserting Leads enquiry Data');

                    return json_encode($a);
                }
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }



    public function EditLeadsUser($pd)
    {
        $error = '';
        if (strlen($pd['name']) <= 0) {
            $error .= "Please enter Project name\n";
        }
        if (strlen($pd['email']) <= 0) {
            $error .= "Please enter Leads Email\n";
        }
        if (strlen($pd['contact_m']) <= 0) {
            $error .= "Please enter Mobile Number\n";
        }
        //
        // if (strlen($pd['icpassport']) <= 0) {
        //     $error .= "Please enter Leads Ic / Passport\n";
        // }
        // if (strlen($pd['age']) <= 0) {
        //     $error .= "Please enter Leads Age\n";
        // }
        //
        // if (strlen($pd['address']) <= 2) {
        //     $error .= "Please enter Address\n";
        // }
        // if (strlen($pd['country']) <= 1) {
        //     $error .= "Please enter Leads Address Country \n";
        // }
        if ($error == '') {
            $name = sanitize($pd['name']);
            $email = sanitize($pd['email']);
            $gender = sanitize($pd['gender']);
            $icpassport = sanitize($pd['icpassport']);
            $age = sanitize($pd['age']);
            $contact_m = sanitize($pd['contact_m']);
            $contact_o = sanitize($pd['contact_o']);
            $contact_h = sanitize($pd['contact_h']);
            $contact_f = sanitize($pd['contact_f']);
            $address = sanitize($pd['address']);
            $postcode = sanitize($pd['postcode']);
            $city = sanitize($pd['city']);
            $state = sanitize($pd['state']);
            $country = sanitize($pd['country']);
            $occupation = sanitize($pd['occupation']);
            $data = array(
'name' => $name,
'email' => $email,
'gender' => $gender,
'icpassport' => $icpassport,
'age' => $age,
'contact_m' => $contact_m,
'contact_o' => $contact_o,
'contact_h' => $contact_h,
'contact_f' => $contact_f,
'address' => $address,
'postcode' => $postcode,
'city' => $city,
'state' => $state,
'country' => $country,
'occupation' => $occupation,
'updated' => 'now()',
);
            $uid = $pd['lid'];

            $sql = 'SELECT * FROM '.self::clrTable." where lead_id='$uid' AND active =1";
            $row = self::$db->first($sql);
            if ($row) {
                if ($row->cus_id!=$pd['link']&&$pd['link']!=0) {
                    self::$db->update(self::clrTable, array('cus_id' => $pd['link'],'active' => '1'), 'id='.$row->id);
                } elseif ($pd['link']==0) {
                    self::$db->update(self::clrTable, array('active' =>'0'), 'id='.$row->id);
                }
            } elseif ($pd['link']!=0) {
                $lid = self::$db->insert(self::clrTable, array('cus_id' => $pd['link'],'lead_id' =>$uid));
                self::$db->update(self::clrTable, array('cus_id' => $pd['link']), 'id='.$row->id);
            }
            self::$db->update(self::lTable, $data, 'id='.$uid);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Edit the Project.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }
    public function EditCustomers($pd)
    {
        $error = '';
        if (strlen($pd['name']) <= 0) {
            $error .= "Please enter Customer name\n";
        }
        if (strlen($pd['email']) <= 0) {
            $error .= "Please enter Customer Email\n";
        }
        if (strlen($pd['gender']) <= 0) {
            $error .= "Please enter Customer Gender\n";
        }
        if (strlen($pd['icpassport']) <= 0) {
            $error .= "Please enter Customer Ic / Passport\n";
        }
        if (strlen($pd['contact_m']) <= 0) {
            $error .= "Please enter Customer Mobile Number\n";
        }
        if (strlen($pd['country']) <= 1) {
            $error .= "Please enter Customer Address Country \n";
        }
        if (strlen($pd['membership']) <= 0) {
            $error .= "Please enter Customer Membership \n";
        }

        if (strlen($pd['bumistatus']) <= 0) {
            $error .= "Please enter Customer Bumi Status\n";
        }
        if ($error == '') {
            $salutationtype = sanitize($pd['salution']);
            $name = sanitize($pd['name']);
            $email = sanitize($pd['email']);
            $gender = sanitize($pd['gender']);
            $icpassport = sanitize($pd['icpassport']);
            $race = sanitize($pd['race']);
            $contact_m = sanitize($pd['contact_m']);
            $contact_o = sanitize($pd['contact_o']);
            $contact_h = sanitize($pd['contact_h']);
            $contact_f = sanitize($pd['contact_f']);
            $address = sanitize($pd['address']);
            $postcode = sanitize($pd['postcode']);
            $city = sanitize($pd['city']);
            $state = sanitize($pd['state']);
            $country = sanitize($pd['country']);
            $occupation = sanitize($pd['occupation']);
            $bumistatus = sanitize($pd['bumistatus']);
            $membership = sanitize($pd['membership']);
            $data = array(
'name' => $name,
'email' => $email,
'gender' => $gender,
'icpassport' => $icpassport,
'race' => $race,
'contact_m' => $contact_m,
'contact_o' => $contact_o,
'contact_h' => $contact_h,
'contact_f' => $contact_f,
'address' => $address,
'postcode' => $postcode,
'city' => $city,
'state' => $state,
'country' => $country,
'occupation' => $occupation,
'bumistatus' => $bumistatus,
'membership' => $membership,
'updated' => 'now()',
);
            $uid = $pd['cid'];

            $sql = 'SELECT * FROM '.self::clrTable." where cus_id='$uid' AND active =1";
            $row = self::$db->first($sql);
            if ($row) {
                if ($row->cus_id!=$pd['link']&&$pd['link']!=0) {
                    self::$db->update(self::clrTable, array('lead_id' => $pd['link'],'active' => '1'), 'id='.$row->id);
                } elseif ($pd['link']==0) {
                    self::$db->update(self::clrTable, array('active' =>'0'), 'id='.$row->id);
                }
            } elseif ($pd['link']!=0) {
                $lid = self::$db->insert(self::clrTable, array('lead_id' => $pd['link'],'cus_id' =>$uid));
                self::$db->update(self::clrTable, array('lead_id' => $pd['link']), 'id='.$row->id);
            }


            self::$db->update(self::cusTable, $data, 'id='.$uid);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Edit the Customer.';

                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('type' => 'error', 'error' => $error);

            return json_encode($a);
        }
    }


    public function getProjectFromPresale($id)
    {
        $sql = 'SELECT * FROM '.self::prTable." where idpresale='$id'";
        $row = self::$db->first($sql);
        return $row;
    }


    public function getCusFromleads($id)
    {
        $sql = 'SELECT * FROM '.self::clrTable." where lead_id='$id' AND active =1";
        $row = self::$db->first($sql);
        if ($row) {
            $cusid=$row->cus_id;
            $sql = 'SELECT * FROM '.self::cusTable." where id='$cusid' AND active =1";
            $row = self::$db->first($sql);
            return ($row);
        } else {
            return $row;
        }
    }

    public function getLeadsFromCus($id)
    {
        $sql = 'SELECT * FROM '.self::clrTable." where cus_id='$id' AND active =1";
        $row = self::$db->first($sql);
        if ($row) {
            $cusid=$row->lead_id;
            $sql = 'SELECT * FROM '.self::lTable." where id='$cusid' AND active =1";
            $row = self::$db->first($sql);
            return ($row);
        } else {
            return $row;
        }
    }



    public function getLeadsENbyLeadsID($leadsid)
    {
        $aid = array();
        $sql = 'SELECT id FROM '.self::leTable." WHERE true AND leadsid in (" . $leadsid . ") order by created DESC";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $aid[]=$value->id;
        }
        return $aid;
    }

    public function getLeadsENbyLeadsIDsingle($leadsid)
    {
        $sql = 'SELECT * FROM '.self::leTable." WHERE true AND id in (" . $leadsid . ") order by created DESC";
        $row = self::$db->first($sql);
        return $row;
    }

    public function getLeadsENbyLeadsIDUSer($leadsid)
    {
        $aid = array();
        $sql = 'SELECT id FROM '.self::leTable." WHERE true AND spid in (" . $leadsid . ") order by created DESC";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $aid[]=$value->id;
        }
        return $aid;
    }



    public function getLeadsbyID($leadsid)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id in (" . $leadsid . ") order by created DESC";
        $row = self::$db->fetch_all($sql);
        return $row;
    }


    public function getLeadsbyID2($leadsid)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id in (" . $leadsid . ") order by created DESC";
        $row = self::$db->first($sql);
        return $row;
    }

    public function getLeadsENbyLeadsIDNI($leadsid)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id = '".$leadsid."' order by created DESC";
        $row = self::$db->first($sql);
        $sql2 = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid = '".$leadsid."' AND  status='20' order by created DESC";
        $row2 = self::$db->first($sql2);
        return array($row,$row2);
    }

    public function getLeadsENbyLeadsIDNA($leadsid)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id = '".$leadsid."' order by created DESC";
        $row = self::$db->first($sql);
        $sql2 = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid = '".$leadsid."' AND  status='18' order by created DESC";
        $row2 = self::$db->first($sql2);
        return array($row,$row2);
    }

    public function getLeadsENbyLeadsIDI($leadsid)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id = '".$leadsid."' order by created DESC";
        $row = self::$db->first($sql);
        $sql2 = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid = '".$leadsid."' AND  status='19' order by created DESC";
        $row2 = self::$db->first($sql2);
        return array($row,$row2);
    }

    public function getLeadsENbyLeadsIDO($leadsid)
    {
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id = '".$leadsid."' order by created DESC";
        $row = self::$db->first($sql);
        $sql2 = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid = '".$leadsid."' AND  status='21' order by created DESC";
        $row2 = self::$db->first($sql2);
        return array($row,$row2);
    }

    public function getLeadsENbyLeadsIDCL($leadsid)
    {
        $sql2 = 'SELECT * FROM '.self::leTable." WHERE true AND id = '".$leadsid."' order by created DESC";
        $row2 = self::$db->first($sql2);
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id = '".$row2->leadsid."' order by created DESC";
        $row = self::$db->first($sql);
        $sql3 = 'SELECT * FROM '.self::cloTable." WHERE true AND leid = '".$leadsid."' order by created DESC";
        $row3 = self::$db->fetch_all($sql3);

        return array($row,$row2,$row3);
    }

    public function getLeadsbyIDUser($leadsid)
    {
        $aid = array();
        $sql = 'SELECT leadsid FROM '.self::leTable." WHERE true AND spid in (" . $leadsid . ") order by created DESC";
        $row = self::$db->fetch_all($sql);
        $a=array();
        foreach ($row as $key => $value) {
            $a[]=$value->leadsid;
        }
        $row2=array();
        if ($a) {
            $a=array_unique($a);
            $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id in (" . (implode(",", $a)) . ") order by created DESC";
            $row2 = self::$db->fetch_all($sql);
        }

        return $row2;
    }






    public function sync($page = 1)
    {
        $data = file_get_contents("http://presales.titijaya.com.my/api/listcustomer.php?limit=2&p=$page");
        $arr_data = json_decode($data);
        //pre($arr_data);
        foreach ($arr_data as $key => $row) {
            $presale_id = $row->id;
            $check_id = $this->checkPurchaseById($presale_id);
            if (empty($check_id)) {
                $id = $row->id;
                $presaleproject_id = $row->project_id;
                $projectdata=$this->getProjectFromPresale($row->project_id);
                if (empty($projectdata)) {
                    $project_id=0;
                } else {
                    $project_id = $projectdata->id;
                }
                $unit_id = $row->unit_id;
                $presaleuser_id = $row->user_id;
                $payment_id = $row->payment_id;
                $sales_no = $row->sales_no;
                $purchaser_nric_1 = $row->purchaser_nric_1;
                $purchaser_nric_2 = $row->purchaser_nric_2;
                $purchaser_nric_3 = $row->purchaser_nric_3;
                $selling_price = $row->selling_price;
                $sales_date = $row->sales_date;
                $spa_date = $row->spa_date;
                $contact_person_1 = $row->contact_person_1;
                $hp_no_1 = $row->hp_no_1;
                $contact_person_2 = $row->contact_person_2;
                $hp_no_2 = $row->hp_no_2;
                $source_finance = $row->source_finance;
                $source_purchase = $row->source_purchase;
                $lawyer = $row->lawyer;
                $payment_amount = $row->payment_amount;
                $payment_status = $row->payment_status;
                $payment_date = $row->payment_date;
                $created = $row->created;
                $block = $row->block;
                $floor = $row->floor;
                $status = $row->sales_status;
                $unit = $row->unit;

                //$classObj = getInstance();
                $userdata=Users::presaleId($presaleuser_id);

                //$userdata=Users::presaleId($presaleuser_id);
                if (empty($userdata)) {
                    $user_id='0';
                } else {
                    $user_id=$userdata->id;
                }
                $data = array(
                  'presale_id' => $id,
                  'project_id' => $project_id,
                  'presaleproject_id' => $presaleproject_id,
                  'unit_id' => $unit_id,
                  'user_id' => $user_id,
                  'presaleuser_id' => $presaleuser_id,
                  'payment_id' => $payment_id,
                  'sales_no' => $sales_no,
                  'purchaser_nric_1' => $purchaser_nric_1,
                  'purchaser_nric_2' => $purchaser_nric_2,
                  'purchaser_nric_3' => $purchaser_nric_3,
                  'selling_price' => $selling_price,
                  'sales_date' => $sales_date,
                  'spa_date' => $spa_date,
                  'contact_person_1' => $contact_person_1,
                  'hp_no_1' => $hp_no_1,
                  'contact_person_2' => $contact_person_2,
                  'hp_no_2' => $hp_no_2,
                  'source_finance' => $source_finance,
                  'source_purchase' => $source_purchase,
                  'lawyer' => $lawyer,
                  'payment_amount' => $payment_amount,
                  'payment_status' => $payment_status,
                  'payment_date' => $payment_date,
                  'data_datecreated' => $created,
                  'p_block' => $block,
                  'p_unit' => $unit,
                  'p_floor' => $floor,
                  'purchase_status' => $status,
                );

                $purchase_id=self::$db->insert(self::purTable, $data);
                //echo 'insert -> '.$purchase_id.'<br>';
                $address1 = $row->address1;
                $address2 = $row->address2;
                $city = $row->city;
                $postcode = $row->postcode;
                $state = $row->state;
                $country = $row->country;
                $office_no = $row->office_no;
                $fax_no = $row->fax_no;
                $house_no = $row->house_no;
                $email_address = $row->email_address;
                $purchaser_title_1 = $this->checkData('salutationtype', $row->purchaser_title_1);
                $purchaser_name_1 = $row->purchaser_name_1;
                $purchaser_nric_1 = $row->purchaser_nric_1;
                $purchaser_race_1 = $row->purchaser_race_1;
                $purchaser_marital_1 = $row->purchaser_marital_1;
                $purchaser_gender_1 = $row->purchaser_gender_1;
                $purchaser_nationality_1 = $row->purchaser_nationality_1;
                $purchaser_occupation_1 = $row->purchaser_occupation_1;
                $purchaser_bumi_1 = $row->purchaser_bumi_1;
                if ($purchaser_gender_1 == 'M') {
                    $purchaser_gender_1 = 0;
                } else {
                    $purchaser_gender_1 = 1;
                }
                $data_c1 = array(
                  'salutationtype' => $purchaser_title_1,
                  'name' => $purchaser_name_1,
                  'icpassport' => $purchaser_nric_1,
                  'race' => $purchaser_race_1,
                  'gender' => $purchaser_gender_1,
                  'occupation' => $purchaser_occupation_1,
                  'bumistatus' => $purchaser_bumi_1,
                  'address' => $address1.$address2,
                  'city' => $city,
                  'postcode' => $postcode,
                  'state' => $state,
                  'country' => $country,
                  'contact_m' => $hp_no_1,
                  'contact_o' => $office_no,
                  'contact_f' => $fax_no,
                  'contact_h' => $house_no,
                  'email' => $email_address,
                  'created' => 'now()',
                  );
                $p1=Listing::getCustomerbyIC($purchaser_nric_1);
                if (!empty($p1)) {
                    self::$db->update(self::cusTable, $data_c1, 'id='.$p1->id);
                } else {
                    self::$db->insert(self::cusTable, $data_c1);
                }
                $data_cuspur1 = array(
                  'cus_ic' => $purchaser_nric_1,
                  'purchase_id' => $purchase_id,
                  );
                self::$db->insert(self::cuspurTable, $data_cuspur1);
                $purchaser_nric_2 = $row->purchaser_nric_2;
                if ($purchaser_nric_2 != '') {
                    $purchaser_title_2 = $this->checkData('salutationtype', $row->purchaser_title_2);
                    $purchaser_name_2 = $row->purchaser_name_2;
                    $purchaser_race_2 = $row->purchaser_race_2;
                    $purchaser_marital_2 = $row->purchaser_marital_2;
                    $purchaser_gender_2 = $row->purchaser_gender_2;
                    $purchaser_nationality_2 = $row->purchaser_nationality_2;
                    $purchaser_occupation_2 = $row->purchaser_occupation_2;
                    $purchaser_bumi_2 = $row->purchaser_bumi_2;
                    if ($purchaser_gender_2 == 'M') {
                        $purchaser_gender_2 = 0;
                    } else {
                        $purchaser_gender_2 = 1;
                    }
                    $data_c2 = array(
                      'salutationtype' => $purchaser_title_2,
                      'name' => $purchaser_name_2,
                      'icpassport' => $purchaser_nric_2,
                      'race' => $purchaser_race_2,
                      'gender' => $purchaser_gender_2,
                      'occupation' => $purchaser_occupation_2,
                      'bumistatus' => $purchaser_bumi_2,
                      'address' => $address1.$address2,
                      'city' => $city,
                      'postcode' => $postcode,
                      'state' => $state,
                      'country' => $country,
                      'contact_m' => $hp_no_1,
                      'contact_o' => $office_no,
                      'contact_f' => $fax_no,
                      'contact_h' => $house_no,
                      'email' => $email_address,
                      'created' => 'now()',
                      );
                    $p2=Listing::getCustomerbyIC($purchaser_nric_2);
                    if (!empty($p2)) {
                        self::$db->update(self::cusTable, $data_c2, 'id='.$p2->id);
                    } else {
                        self::$db->insert(self::cusTable, $data_c2);
                    }
                    $data_cuspur2 = array(
                      'cus_ic' => $purchaser_nric_2,
                      'purchase_id' => $purchase_id,
                      );
                    self::$db->insert(self::cuspurTable, $data_cuspur2);
                }
                $purchaser_nric_3 = $row->purchaser_nric_3;
                if ($purchaser_nric_3 != '') {
                    $purchaser_title_3 = $this->checkData('salutationtype', $row->purchaser_title_3);
                    $purchaser_name_3 = $row->purchaser_name_3;
                    $purchaser_race_3 = $row->purchaser_race_3;
                    $purchaser_marital_3 = $row->purchaser_marital_3;
                    $purchaser_gender_3 = $row->purchaser_gender_3;
                    $purchaser_nationality_3 = $row->purchaser_nationality_3;
                    $purchaser_occupation_3 = $row->purchaser_occupation_3;
                    $purchaser_bumi_3 = $row->purchaser_bumi_3;
                    if ($purchaser_gender_3 == 'M') {
                        $purchaser_gender_3 = 0;
                    } else {
                        $purchaser_gender_3 = 1;
                    }
                    $data_c3 = array(
                      'salutationtype' => $purchaser_title_3,
                      'name' => $purchaser_name_3,
                      'icpassport' => $purchaser_nric_3,
                      'race' => $purchaser_race_3,
                      'gender' => $purchaser_gender_3,
                      'occupation' => $purchaser_occupation_3,
                      'bumistatus' => $purchaser_bumi_3,
                      'address' => $address1.$address2,
                      'city' => $city,
                      'postcode' => $postcode,
                      'state' => $state,
                      'country' => $country,
                      'contact_m' => $hp_no_1,
                      'contact_o' => $office_no,
                      'contact_f' => $fax_no,
                      'contact_h' => $house_no,
                      'email' => $email_address,
                      'created' => 'now()',
                      );
                    $p3=Listing::getCustomerbyIC($purchaser_nric_3);
                    if (!empty($p3)) {
                        self::$db->update(self::cusTable, $data_c3, 'id='.$p3->id);
                    } else {
                        self::$db->insert(self::cusTable, $data_c3);
                    }


                    $data_cuspur3 = array(
                      'cus_ic' => $purchaser_nric_3,
                      'purchase_id' => $purchase_id,
                      );
                    self::$db->insert(self::cuspurTable, $data_cuspur3);
                }
            } else {
                continue;
            }
        }
    }
    public function checkPurchaseById($id)
    {
        $sql = 'SELECT * FROM '.self::purTable." where presale_id='$id'";
        $row = self::$db->first($sql);

        return $row;
    }
    public function getCusValidPuchaseByIC($ic)
    {
        $sql = 'SELECT * FROM '.self::cuspurTable." WHERE cus_ic = '$ic' ";
        $cuspur = self::$db->fetch_all($sql);
        $purchase_id = array();
        foreach ($cuspur as $key => $row) {
            $purchase_id[] = $row->purchase_id;
        }
        $out = array();
        foreach ($purchase_id as $key => $row) {
            $sql = 'SELECT * FROM '.self::purTable." WHERE id = '$row' AND active = 1 AND purchase_status='S' ";
            $pur = self::$db->first($sql);
            if (!empty($pur)) {
                $out[] = $pur;
            }
        }
        $p=0;
        $s=0;
        foreach ($out as $key => $value) {
            if ($value->purchase_status=='S') {
                $s+=1;
            }
            if ($value->purchase_status=='P') {
                $p+=1;
            }
        }
        if ($s>0||$p>0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getPuchaseByIC($ic)
    {
        $sql = 'SELECT * FROM '.self::cuspurTable." WHERE cus_ic = '$ic' ";
        $cuspur = self::$db->fetch_all($sql);
        $purchase_id = array();
        foreach ($cuspur as $key => $row) {
            $purchase_id[] = $row->purchase_id;
        }
        $out = array();
        foreach ($purchase_id as $key => $row) {
            $sql = 'SELECT * FROM '.self::purTable." WHERE id = '$row' AND active = 1 AND purchase_status='S' ";
            $pur = self::$db->first($sql);
            if (!empty($pur)) {
                $out[] = $pur;
            }
        }
        return $out;
    }

    public function getAllSalePos()
    {
        $allsalewithpos = array();
        foreach (Users::getAllSale() as $key => $value) {
            $allsalewithpos[] = array('id' => $value->id, 'pos' => $value->leads);
        }
        $task1 = array();
        $task2 = array();
        foreach ($allsalewithpos as $key => $value) {
            for ($i = 1; $i <= $value['pos']; ++$i) {
                $task1[$value['id']][] = $i;
                $task2[] = array($value['id'], $i);
            }
        }

        return array($task1, $task2);
    }

    public function getCurrentLead()
    {
        $tasks = $this->getAllSalePos();
        $spcount = count($tasks[1]);
        $sql = 'SELECT * FROM '.self::leTable." WHERE true AND manual='0' ORDER BY id DESC";
        $row = self::$db->first($sql);
        if (empty($row)) {
            $spid = $tasks[1][$spcount - 1][0];
            $pos = $tasks[1][$spcount - 1][1];
        } else {
            $spid = ($row->spid);
            $pos = ($row->position);
        }

        $havesp = 0;
        foreach ($tasks[0] as $key => $value) {
            if ($key == $spid) {
                $havesp = $spid;
            }
        }

        if ($havesp) {
            if (in_array($pos, $tasks[0][$spid])) {
                foreach ($tasks[1] as $key => $value) {
                    if ($value[0] == $spid && $value[1] == $pos) {
                        if ($key == $spcount - 1) {
                            $place = 0;
                        } else {
                            $place = $key + 1;
                        }
                        $afterthis = $tasks[1][$place];
                    }
                }
            } else {
                $pos = getClosestSmallest($pos, $tasks[0][$spid]);
                if (in_array($pos, $tasks[0][$spid])) {
                    foreach ($tasks[1] as $key => $value) {
                        if ($value[0] == $spid && $value[1] == $pos) {
                            if ($key == $spcount - 1) {
                                $place = 0;
                            } else {
                                $place = $key + 1;
                            }
                        }
                        $afterthis = $tasks[1][$place];
                    }
                }
            }
        } else {
            $spid = getClosestSmallest($spid, $tasks[0]);

            if (in_array($pos, $tasks[0][$spid])) {
                foreach ($tasks[1] as $key => $value) {
                    if ($value[0] == $spid && $value[1] == $pos) {
                        if ($key == $spcount - 1) {
                            $place = 0;
                        } else {
                            $place = $key + 1;
                        }
                        $afterthis = $tasks[1][$place];
                    }
                }
            } else {
                $pos = getClosestSmallest($pos, $tasks[0][$spid]);
                if (in_array($pos, $tasks[0][$spid])) {
                    foreach ($tasks[1] as $key => $value) {
                        if ($value[0] == $spid && $value[1] == $pos) {
                            if ($key == $spcount - 1) {
                                $place = 0;
                            } else {
                                $place = $key + 1;
                            }
                        }
                        $afterthis = $tasks[1][$place];
                    }
                }
            }
        }

        return $afterthis;
    }

    public function getMyLEN($id)
    {
        $sql = 'SELECT *'
."\n FROM ".self::leTable." WHERE id = '$id'";
        $row = self::$db->fetch_all($sql);

        return $row[0];
    }

    public function getMyEN($id)
    {
        $sql = 'SELECT *'
."\n FROM ".self::leTable." WHERE id = '$id'";

        return self::$db->first($sql);
    }

    public function SyncProjectFromPreSale()
    {
        $uri = 'http://presales.titijaya.com.my/api/getproject.php';
        $response = Request::get($uri)->send();
        $fromps = json_decode($response->body);
        $ll = array();
        foreach ($fromps as $key => $value) {
            $ll[] = $value->id;
        }
        $sql = 'SELECT idpresale FROM '.self::prTable.'  where idpresale!=0';
        $alldbpresale = self::$db->fetch_all($sql);
        $ll2 = array();
        foreach ($alldbpresale as $key => $value) {
            $ll2[] = $value->idpresale;
        }
        $addarray = array_diff($ll, $ll2);
        $frPS = array();
        foreach ($addarray as $key => $value) {
            foreach ($fromps as $key2 => $value2) {
                if ($value == $value2->id) {
                    $frPS[$value] = $value2;
                }
            }
        }
//pre($frPS);

foreach ($frPS as $key => $value) {
    $data = array(
'idpresale' => $value->id,
'name' => $value->title,
'first' => '1',
);
    self::$db->insert(self::prTable, $data);
}
    }

    public function getProjects($id)
    {
        $sql = 'SELECT * FROM '.self::prTable."  where id='$id'";
        $row = self::$db->fetch_all($sql);

        return $row[0];
    }

    public function getProjectsSitebyID($id)
    {
        $sql = 'SELECT * FROM '.self::siteTable."  where id='$id'";
        $row = self::$db->first($sql);
        return $row;
    }

    public function getProjectsHomeSliderbyID($id)
    {
        $sql = 'SELECT * FROM '.self::homeTable."  where id='$id'";
        $row = self::$db->first($sql);
        return $row;
    }

    public function getAllProjects()
    {
        $sql = 'SELECT * FROM '.self::prTable."  where parent='0' AND active='1'";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getLocationLeads()
    {
        $totalplace = array();
        foreach (self::getAllProjects() as $key => $value) {
            $totalplace[] = $value->location;
        }
        $totalplace = array_unique($totalplace);
        $totalplace2 = array();
        foreach ($totalplace as $key => $value) {
            $z = self::getPosLoc($value);
            $totalplace2[$value]['area'] = $z->area;
        }

        return $totalplace2;
    }

    public function getProtypeLeads()
    {
        $totalplace = array();
        foreach (self::getAllData('projecttype') as $key => $value) {
            $totalplace[$value->id]['type'] = $value->data;
        }

        return $totalplace;
    }

    public function getStatusLeads()
    {
        $totalplace = array();
        foreach (self::getAllData('status') as $key => $value) {
            $totalplace[$value->id]['type'] = $value->data;
        }

        return $totalplace;
    }

    public function getLeadRemark($id)
    {
        $sql = 'SELECT * FROM '.self::remleadTable." where lid='".$id."' AND active='1' order by created DESC";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getCusRemark($id)
    {
        $sql = 'SELECT * FROM '.self::remcusTable." where cid='".$id."' AND active='1' order by created DESC";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getPosLoc($id)
    {
        $sql = 'SELECT * FROM '.self::posTable." where id='".$id."'";
        $row = self::$db->first($sql);

        return $row;
    }

    public function getSources($id)
    {
        $sql = 'SELECT * FROM '.self::sorTable."  where id='$id'";
        $row = self::$db->fetch_all($sql);

        return $row[0];
    }

    public function getSubSources($id)
    {
        $sql = 'SELECT * FROM '.self::sorTable."  where parent='$id'";
        $row = self::$db->fetch_all($sql);

        $aaa = ObjtoArr($row);

        return $aaa;
    }

    public function getPosCOdde()
    {
        $sql = 'SELECT * FROM '.self::posTable.' where area=post_office';
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getdata($type, $data)
    {
        $data2 = implode(',', $data);
        $sql = 'SELECT * FROM '.self::dTable." where name='".$type."' AND id IN (".$data2.');';
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getAllData($type)
    {
        $sql = 'SELECT * FROM '.self::dTable." where name='".$type."'";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function checkData($type, $data)
    {
        $sql = 'SELECT * FROM '.self::dTable." where name='".$type."' AND data ='".$data."' ";
        $row = self::$db->first($sql);
        if (empty($row)) {
            return self::$db->insert(self::dTable, array('name' => $type, 'data' => $data));
        } else {
            return $row->id;
        }
    }

    public function getSubProjects($id)
    {
        $sql = 'SELECT * FROM '.self::prTable."  where parent='$id'";
        $row = self::$db->fetch_all($sql);

        $aaa = ObjtoArr($row);

        return $aaa;
    }

    public function getState($st)
    {
        $sql = 'SELECT * FROM '.self::staTable." where state_code='".$st."'";
        $row = self::$db->fetch_all($sql);
        $aaa = ObjtoArr($row);

        return $aaa[0];
    }

    public function getArea($id)
    {
        $sql = 'SELECT * FROM '.self::posTable." where id='".$id."'";
        $row = self::$db->fetch_all($sql);
        $aaa = ObjtoArr($row);

        return $aaa[0];
    }

    public function getAllState()
    {
        $sql = 'SELECT * FROM '.self::staTable.' order by state_code ASC';
        $row = self::$db->fetch_all($sql);
        $aaa = ObjtoArr($row);

        return $aaa;
    }

    public function getAllArea($state)
    {
        $except = '';
        $a = array('kementerian', 'jabatan', 'badan', 'bahagian', 'biro', 'suruhanjaya', 'prime minister', 'pengarah', 'lembaga', 'ketua', 'mahkamah', 'amanah raya berhad', 'peti surat', 'akauntan', 'beg berkunci', 'pejabat', 'penasihat', 'yayasan', 'unit', 'majlis', 'jemaah', 'pendaftar', 'pusat');
        foreach ($a as $key => $value) {
            $except .= "AND `area` not LIKE '%".$value."%'";
        }

        $sql1 = 'SELECT id,area,post_office FROM '.self::posTable." where state_code='".$state."' $except order by id ASC";
        $row1 = self::$db->fetch_all($sql1);
        $a1 = ObjtoArr($row1);

        foreach ($a1 as $key => $value) {
            if ($value['area'] != $value['post_office']) {
                $a1[$key]['area'] = ucwords($value['area'].' ('.ucwords($value['post_office']).')');
            } else {
                $a1[$key]['area'] = ucwords($value['area']);
            }
        }

        return $a1;
    }



    public function getCompleteFollowup($user, $limit = false)
    {
        $limit=(int) ($limit/2);
        $aa = '';
        $bb = '';

        if ($user->isSale()) {
            $aa = "AND le.spid = '$user->uid' ";
            $bb = "AND saleperson = '$user->uid' ";
        }
        $sql = 'SELECT l.*,le.*,le.leadsid as leadsidz FROM '.self::lTable.' l join '.self::leTable." le on l.id=le.leadsid  WHERE true $aa AND l.active=1 AND le.active=1 GROUP BY l.id order by l.id DESC";
        $rowz = self::$db->fetch_all($sql);


        $a = array();
        $a['cni']=0;
        $a['ni']=array();
        foreach ($rowz as $key => $value) {
            $sql = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid='".$value->leadsid."' AND active='1' ORDER BY created DESC";
            $row = self::$db->first($sql);

            if ($row->status == 20) {
                $a['ni'][]=$value->leadsid;
                $a['cni']+=1;
            }
        }


        $sql2 = 'SELECT * FROM '.self::cloTable." where true $bb ";
        $row2 = self::$db->fetch_all($sql2);

        $a['cl']=array();
        $a['ccl']=0;
        foreach ($row2 as $key => $value) {
            $a['cl'][]=$value->leid;
            $a['ccl']+=1;
        }
        if (is_array($a)) {
            $b=array_unique($a['ni']);
            rsort($b);
            $a['ni']=$b;
            $b=array_unique($a['cl']);
            rsort($b);
            $a['cl']=$b;
        }
        if ($a && $limit) {
            $a['ni'] = array_slice($a['ni'], 0, $limit);
            $a['cl'] = array_slice($a['cl'], 0, $limit);
        }
        return $a;
    }

    public function getTodo($user, $limit = false)
    {
        $aa = '';
        $bb = '';

        if ($user->isSale()) {
            $aa = "AND le.spid = '$user->uid' ";
            $bb = "AND saleperson = '$user->uid' ";
        }
        $sql = 'SELECT l.*,le.*,le.leadsid as leadsidz FROM '.self::lTable.' l join '.self::leTable." le on l.id=le.leadsid  WHERE true $aa AND l.active=1 AND le.active=1 GROUP BY l.id order by l.id DESC";
        $rowz = self::$db->fetch_all($sql);

        $a = array();
        $a['na']=array();
        $a['i']=array();
        $a['o']=array();
        $a['cna']=array();
        $a['ci']=array();
        $a['co']=array();


        $sql2 = 'SELECT * FROM '.self::cloTable." where true $bb ";
        $row2 = self::$db->fetch_all($sql2);
        $cl=array();
        foreach ($row2 as $key => $value) {
            $cl[]=$value->leid;
        }
        $ina="";
        if (!empty($cl)) {
            $ina=" AND leadsid NOT IN ('".implode("','", $cl)."')";
        }

        foreach ($rowz as $key => $value) {
            $sql = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid='".$value->leadsid."' AND active='1' $ina  ORDER BY created DESC";
            $row = self::$db->first($sql);
            if ($row) {
                if ($row->status == 18) {
                    $a['na'][]=$value->leadsid;
                } elseif ($row->status == 19) {
                    $a['i'][]=$value->leadsid;
                } elseif ($row->status == 21) {
                    $a['o'][]=$value->leadsid;
                }
            }
        }
        if (is_array($a)) {
            $b=array_unique($a['na']);
            rsort($b);
            $a['na']=$b;
            $b=array_unique($a['i']);
            rsort($b);
            $a['i']=$b;
            $b=array_unique($a['o']);
            rsort($b);
            $a['o']=$b;

            $a['cna'] =count($a['na']);
            $a['ci'] = count($a['i']);
            $a['co'] = count($a['o']);
        }

        if ($a && $limit) {
            $a['na'] = array_slice($a['na'], 0, $limit);
            $a['i'] = array_slice($a['i'], 0, $limit);
            $a['o'] = array_slice($a['o'], 0, $limit);
        }


        return $a;
    }

    public function getFollowup($user, $limit = false)
    {
        $a = '';
        if ($user->isSale()) {
            $a = "AND le.spid = '$user->uid' ";
        }
        $sql = 'SELECT l.*,le.*,le.leadsid as leadsidz FROM '.self::lTable.' l join '.self::leTable." le on l.id=le.leadsid  WHERE true $a AND l.active=1 AND le.active=1 GROUP BY l.id order by l.id DESC";
        $rowz = self::$db->fetch_all($sql);
        $a = array();
        foreach ($rowz as $key => $value) {
            $sql = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid='".$value->leadsid."' AND active='1' ORDER BY created DESC";
            $row = self::$db->first($sql);
            if ($row->respond == null) {
                $a[] = $value->leadsid;
            }
        }
        if ($a && $limit) {
            $a = array_slice($a, 0, $limit);
        }

        return $a;
    }

    public function getLatestLeadsbyID($id)
    {
        $sql = 'SELECT * FROM '.self::leTable." WHERE true AND leadsid='".$id."' AND active='1' ORDER BY created DESC";
        $row = self::$db->first($sql);
        $sql = 'SELECT * FROM '.self::lTable." WHERE true AND id='".$row->leadsid."' AND active='1' ORDER BY created DESC";
        $row2 = self::$db->first($sql);
        $sql = 'SELECT count(id) as totalen FROM '.self::leTable." WHERE true AND leadsid='".$row->leadsid."' AND active='1' ORDER BY created DESC";
        $row3 = self::$db->first($sql);
        $row = (array) $row;
        $row2 = (array) $row2;
        $row3 = (array) $row3;

        return array_merge($row2, $row, $row3);
    }

    public function getAllProjectType()
    {
        $sql = 'SELECT id,data as name FROM '.self::dTable." where name='projecttype' AND active='1' order by name ASC";
        $row = self::$db->fetch_all($sql);
        $aaa = ObjtoArr($row);

        return $aaa;
    }
    public function getMyLeads($id)
    {
        $sqlz = 'SELECT le.*,cl.* FROM '.self::leTable.' le join '.self::cloTable." cl on le.id=cl.leid where le.leadsid='$id' AND le.active='1' AND cl.active='1' ORDER BY le.created DESC";
        $rowz = self::$db->first($sqlz);
        if (!empty($rowz)) {
            $sql1 = 'SELECT * FROM '.self::leTable.' WHERE leadsid="'.$id.'" AND id>"'.$rowz->leid.'"  AND active="1"  ORDER BY created DESC';
            $sql2 = 'SELECT * FROM '.self::leTable.' WHERE leadsid="'.$id.'" AND id<="'.$rowz->leid.'" AND active="1" ORDER BY created DESC';
            $rows1 = self::$db->fetch_all($sql1);
            $rows2 = self::$db->fetch_all($sql2);
        } else {
            $sql1 = 'SELECT * FROM '.self::leTable.' WHERE leadsid='.$id.' ORDER BY created DESC';
            $rows1 = self::$db->fetch_all($sql1);
            $rows2 = array();
        }
        $sql = 'SELECT * FROM '.self::lTable.' WHERE id='.$id.'';
        $row = self::$db->fetch_all($sql);
        $aaa = ObjtoArr($row);
        $z = $aaa[0];
        $a = array();
        foreach ($rows1 as $key) {
            $a[] = $key->id;
        }
        $b = array();
        foreach ($rows2 as $key) {
            $b[] = $key->id;
        }
        $z['en'] = $a;
        $z['enhistory'] = $b;

        return $z;
    }

    public function getMyLeads2($id)
    {
        $sql = 'SELECT * FROM '.self::lTable." where id='$id'";
        $row = self::$db->fetch_all($sql);
//        pre($row);
foreach ($row as $key) {
    if ($key->id == $id) {
        $data = $key->name;
    }
}

        return $data;
    }

    public function getMyLeadsRemark($id)
    {
        $sql = 'SELECT * FROM '.self::remleadTable." where id='$id'";
        $row = self::$db->first($sql);

        return $row;
    }

    public function getMyCustomersRemark($id)
    {
        $sql = 'SELECT * FROM '.self::remcusTable." where id='$id'";
        $row = self::$db->first($sql);

        return $row;
    }

    public function getCustomerbyID($id)
    {
        $sql = 'SELECT * FROM '.self::cusTable." where id='$id'";
        $row = self::$db->first($sql);

        return $row;
    }

    public function getCustomerbyIC($id)
    {
        $sql = 'SELECT * FROM '.self::cusTable." where icpassport='$id'";
        $row = self::$db->first($sql);
        return $row;
    }
    public function getAllCustomer()
    {
        $sql = 'SELECT * FROM '.self::cusTable.' where active=1 ';
        $row = self::$db->fetch_all($sql);
        $a=array();
        foreach ($row as $key => $value) {
            $aa=$this->getCusValidPuchaseByIC($value->icpassport);
            if ($aa==1) {
                $a[]=$value;
            }
        }

        return $a;
    }

    public function getAllMemberTypetoArr()
    {
        $sql = 'SELECT * FROM '.self::memTypeTable.' WHERE active=1 ORDER by max_purchase ASC ';
        $row = self::$db->fetch_all($sql);
        $arrayName = array();
        $arrayName[]=array('id' =>0 ,'min' =>0 ,'max' =>0,'member_type'=>'No Membership');
        foreach ($row as $key => $value) {
            $arrayName[]=array('id' =>$value->id ,'min' =>$value->min_purchase ,'max' =>$value->max_purchase,'member_type'=>$value->member_type);
        }
        return $arrayName;
    }
    public function getAllCustomerMembership()
    {
        $mem=$this->getAllMemberTypetoArr();
        $a=$this->getAllCustomer();
        $arrayName=array();
        foreach ($a as $key => $value) {
            $cusic=$value->icpassport;
            $cusmmbr=$value->membership;
            $aa=$this->getPuchaseByIC($cusic);
            $totalpurchase=0;
            $totalpurchasecount=0;
            foreach ($aa as $key2 => $value2) {
                $cal=$this->getDivCustomerbyPurchaseID($value2->id);
                $totalpurchase+=($value2->selling_price/$cal);
                $totalpurchasecount+=1;
            }
            $ac=0;
            $acmax=0;
            $cmax=count($mem)-1;
            foreach ($mem as $key2 => $value2) {
                if ($value2['id']==$cusmmbr) {
                    $k=$key2;
                }
                if ($totalpurchase<=$value2['max']&&$totalpurchase>=$value2['min']) {
                    $ac=$key2;
                }
                if ($totalpurchase>$mem[$cmax]['max']) {
                    $acmax=1;
                }
            }
            if ($acmax) {
                $ac=$cmax;
            }
            if ($k<$ac) {
                $kk=$mem[$k];
                $kac=$mem[$ac];
                $arrayName[] = array('id' =>$value->id,'name' =>$value->name ,'email' =>$value->email,'purchase' =>$totalpurchase ,'purchasecount' =>$totalpurchasecount ,'now'=>$kk['member_type'],'acc'=>$kac['member_type'],'acctrans'=>$kac['id']);
            }
        }
        return ($arrayName);
    }
    public function getDivCustomerbyPurchaseID($id)
    {
        $sql = 'SELECT *, count(purchase_id) as cal FROM '.self::cuspurTable.' WHERE active=1 AND purchase_id="'.$id.'" GROUP BY purchase_id  ORDER by id ASC ';
        $row = self::$db->first($sql);
        if (!empty($row)) {
            $cal=$row->cal;
        } else {
            $cal=1;
        }
        return $cal;
    }

    public function getAllLeadsLatest($user, $limit = false)
    {
        $w='';
        if ($user->isSale()) {
            $w=' AND le.spid ="'.$user->uid.'"';
        }
        $sql = 'SELECT l.id as id,l.name as leadsname,le.interest as interest ,l.contact_m as mobile,l.email as leadsemail,le.source as source,le.spid as spid , le.created as created'
        ."\n FROM ".self::lTable.' l RIGHT JOIN '.self::leTable." le ON l.id=le.leadsid WHERE TRUE AND l.active=1 AND le.created > NOW() - INTERVAL 1 WEEK $w group by le.leadsid ORDER BY le.created DESC";
        $row = self::$db->fetch_all($sql);
        $a=count($row);
        $sql2 = 'SELECT l.id as id,l.name as leadsname,le.interest as interest ,l.contact_m as mobile,l.email as leadsemail,le.source as source,le.spid as spid , le.created as created'
        ."\n FROM ".self::lTable.' l RIGHT JOIN '.self::leTable." le ON l.id=le.leadsid WHERE TRUE AND le.manual='1' AND le.created > NOW() - INTERVAL 1 WEEK $w AND l.active=1 group by le.leadsid ORDER BY le.created DESC";
        $row2 = self::$db->fetch_all($sql2);
        $b=count($row2);
        if ($limit) {
            array_splice($row, $limit);
            array_splice($row2, $limit);
        }
        return array($row,$row2,$a,$b);
    }


    public function getAllCustomerLatest($limit = false)
    {
        $a = '';
        if ($limit) {
            $a = 'LIMIT '.$limit;
        }
        $sql = 'SELECT * FROM '.self::cusTable." WHERE active='1'  ORDER BY id DESC $a";
        $row = self::$db->fetch_all($sql);


        return $row;
    }

    public function getCusComingBday($limit = false)
    {
        $a = '';
        if ($limit) {
            $a = 'LIMIT '.$limit;
        }
        $sql = 'SELECT *,SUBSTR(icpassport,3,4) as lala,SUBSTR(icpassport,1,6) as bday_date
FROM '.self::cusTable." where SUBSTR(icpassport,3,4) >= date_format(now(),'%m%d') AND SUBSTR(icpassport,3,4)<='1231' order by lala ASC $a";
        $row = self::$db->fetch_all($sql);

        return $row;
    }



    public function getAllCustomertoLeads($id)
    {
        $sql = 'SELECT * FROM '.self::clrTable." where active=1 AND lead_id != '".$id."' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);
        $arrayc=array();
        foreach ($row as $key => $value) {
            $arrayc[]=$value->cus_id;
        }
        $aa="";
        if (!empty($arrayc)) {
            $aa.=" AND a.id  NOT IN (".implode(",", $arrayc).") ";
        }
        $sql = 'SELECT a.*,b.data as sal_data,a.icpassport as bday_date '
."\n FROM ".self::cusTable.' a LEFT JOIN '.self::dTable." b ON a.salutationtype = b.id WHERE TRUE  AND a.active='1' $aa ";
        $row = self::$db->fetch_all($sql);
        $array=array();
        foreach ($row as $key => $value) {
            $data=array('id'=>$value->id,'name'=>$value->sal_data." ".$value->name);
            $array[]=$data;
        }
        return $array;
    }


    public function getAllLeadstoCustomer($id)
    {
        $sql = 'SELECT * FROM '.self::clrTable." where active=1 AND cus_id != '".$id."' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);
        $arrayc=array();
        foreach ($row as $key => $value) {
            $arrayc[]=$value->lead_id;
        }
        $aa="";
        if (!empty($arrayc)) {
            $aa.=" AND a.id  NOT IN (".implode(",", $arrayc).") ";
        }
        $sql = 'SELECT a.*,b.data as sal_data '
."\n FROM ".self::lTable.' a LEFT JOIN '.self::dTable." b ON a.salutationtype = b.id WHERE TRUE  AND a.active='1' $aa ";
        $row = self::$db->fetch_all($sql);
        $array=array();
        foreach ($row as $key => $value) {
            $data=array('id'=>$value->id,'name'=>$value->sal_data." ".$value->name);
            $array[]=$data;
        }
        return $array;
    }

    public function getAllCustomerSearch($name, $email, $contactnumber, $sorting)
    {
        $a = '';
        $wh = '';
        if ($name != '') {
            $a .= "AND a.name LIKE '%$name%'";
        }

        if ($email != '') {
            $a .= "AND a.email LIKE '%$email%'";
        }

        if ($contactnumber != '') {
            $a .= "AND a.contact_m LIKE '%$contactnumber%'";
        }

        $s = '';
        if ($sorting != '' && $sorting != '0') {
            $s .= "ORDER BY a.$sorting";
        }

        $sql = 'SELECT a.*,b.data as sal_data,a.icpassport as bday_date '
."\n FROM ".self::cusTable.' a LEFT JOIN '.self::dTable." b ON a.salutationtype = b.id WHERE TRUE $a AND a.active='1' $s";
        $row = self::$db->fetch_all($sql);
        $a = ObjtoArr($row);
        $ab=array();
        foreach ($a as $key => $value) {
            $aa=$this->getCusValidPuchaseByIC($value['icpassport']);
            if ($aa==1) {
                $ab[]=$value;
            }
        }

        return $ab;
    }

    public function getAllLeadsSearch($name, $email, $contactnumber, $sorting, $admin, $uid, $min, $max, $resp, $start_date, $end_date, $apptype, $leadsource, $leadstatus, $location, $project, $saleperson)
    {
        $a = '';
        $wh = '';
        if ($name != '') {
            $a .= "AND name LIKE '%$name%'";
        }

        if ($email != '') {
            $a .= "AND email LIKE '%$email%'";
        }

        if ($contactnumber != '') {
            $a .= "AND contact_m LIKE '%$contactnumber%'";
        }

        if ($start_date) {
            $pieces = explode('/', $start_date);
            $date = $pieces[2].'-'.$pieces[1].'-'.$pieces[0];
            $a .= "AND date(le.created) >= '$date' ";
        }
        if ($end_date) {
            $pieces = explode('/', $end_date);
            $date = $pieces[2].'-'.$pieces[1].'-'.$pieces[0];
            $a .= "AND date(le.created) <= '$date' ";
        }
        if (!$admin) {
            $a .= "AND le.spid = '$uid' ";
            $wh .= "AND spid='$uid'";
        }

        $s = '';
        if ($sorting=="created DESC" ||"created ASC") {
            $s .= "ORDER BY le.$sorting";
        } elseif ($sorting != '' && $sorting != '0') {
            $s .= "ORDER BY l.$sorting";
        }




      //echo"<br>".
       $sql = 'SELECT *,count(*) as en,count(*) as readed ,count(*) as readedid , l.id as lid'
."\n FROM ".self::lTable.' l RIGHT JOIN '.self::leTable." le ON l.id=le.leadsid WHERE TRUE $a AND l.active=1 group by l.id $s";
        $row = self::$db->fetch_all($sql);
        $a = ObjtoArr($row);
        foreach ($a as $key => $value) {
            $sql2 = 'SELECT * FROM '.self::leTable." WHERE leadsid='$value[leadsid]' $wh ORDER by id DESC";
            $row2 = self::$db->first($sql2);
            $a[$key]['readed'] =$this->getLeadResponse($value['leadsid']);

            if ($resp) {
                if ($a[$key]['readed']!=$resp) {
                    unset($a[$key]);
                    continue;
                }
            }
            $a[$key]['readedid'] = $row2->id;
            $search = array('min' => $min, 'max' => $max, 'apptype' => $apptype, 'leadsource' => $leadsource, 'leadstatus' => $leadstatus, 'location' => $location, 'project' =>$project, 'saleperson' => $saleperson);

            $a[$key]['detail'] = self::getLeadetail($value['id'], $search);
        }

//pre($a);

if (!empty($a)) {
    foreach ($a as $key => $value) {
        if (empty($value['detail'])) {
            unset($a[$key]);
        }
    }
}

        if ($project != '' || $project != null) {
            if ($a) {
                foreach ($a as $key => $value) {
                    $ac=$value['interest'];
                    $ac=str_replace("[", "", $ac);
                    $ac=str_replace("]", "", $ac);
                    $b=$this->ProjectisParent($ac);
                    $bid=$b->id;
                    if (!in_array($bid, $project, true)) {
                        unset($a[$key]);
                    }
                }
            }
        }
        $json = array_values($a);

        return $json;
    }

    public function SearchLeads($data, $search)
    {
        if ($search['min'] == 0 && $search['max'] == 0) {
            return $data;
        } else {
            if ($search['min'] <= $search['max']) {
                $minmaxval = self::minmaxfiltter($data, $search['min'], $search['max']);

                return $minmaxval;
            } else {
                return array();
            }
        }
    }
    public function getLeadResponse($id)
    {
        $b = self::getAllLeadsEN($id);
        $a=array();
        foreach ($b as $key => $value) {
            $value->respond!=null? $a[]=1:$a[]=0;
        }

        if ($a) {
            $c=array_unique($a);
        //pre($c);
        if (count($c)==1) {
            return $c[0]==1? 1 : 0;
        } else {
            return '2';
        }
        } else {
            return '0';
        }
    }



    public function getLeadetail($id, $search)
    {
        $b = self::getLeadsEN($id);
        $c = self::getLeadsEN2($b[0]->leadsid, $search);
        $pp = array();
        foreach ($c as $key => $value) {
            $bb = json_decode($value->interest);
            foreach ($bb as $key => $value) {
                $pp[] = $value;
            }
        }
        $result = array_unique($pp);
        $ppp = array();
        foreach ($result as $key => $value) {
            $row = self::getInterest($value);
            $ppp[] = $row[0]->id;
        }
        $result2 = array_unique($ppp);

        $pppp = array();
        foreach ($result2 as $key => $value) {
            $row = self::getInterest($value, $search);
            if (!empty($row)) {
                $pppp[] = $row[0];
            }
        }

        return $pppp;
    }


    public function getAllLeadsEN($id)
    {
        $sql = 'SELECT * FROM '.self::leTable." where leadsid='".$id."' AND active=1 ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);
        return $row;
    }

    public function getLeadsEN($id)
    {
        $sql = 'SELECT * FROM '.self::leTable." where id='".$id."' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);

        return $row;
    }



    public function getSourcelist($id)
    {
        $total = array();
        $sql = 'SELECT * FROM '.self::sorTable." where parent='".$id."' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);
        if (!empty($row)) {
            foreach ($row as $key => $value) {
                $total[] = $value->id;
            }
        }
        $total[] = $id;

        return $total;
    }

    public function getSourceParent($id)
    {
        $total = array();
        $sql = 'SELECT * FROM '.self::sorTable." where parent='".$id."' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);
        if (!empty($row)) {
            foreach ($row as $key => $value) {
                $total[] = $value->id;
            }
        }
        return $total;
    }

    public function getLeadsEN2($id, $search)
    {
        $leadsource = $search['leadsource'];
        $leadstatus = $search['leadstatus'];
        $saleperson = $search['saleperson'];
        $project = $search['project'];
        $loc = $search['location'];

//pre($search);
// $location=$search['location'];
$where = '';
// $mmin=0;
// if($min!=''||$min!=NULL)
// $mmin=1;
//
// $mmax=0;
// if($max!=''||$max!=NULL)
// $mmax=1;
//
// if($mmin==1&&$mmax==1&&$mmin<=$mmax)
// $where.=" AND pricemin>='".$min."'";

if ($leadsource != '' || $leadsource != null) {
    $a = array();
    foreach ($leadsource as $key => $value) {
        $a = array_merge($a, self::getSourcelist($value));
    }

    if (!empty($a)) {
        $result = array_unique($a);
        $where .= ' AND ( ';
        foreach ($result as $key => $value) {
            $aaaa = '';
            if ($key != 0) {
                $aaaa = 'OR';
            }

            $where .= ' '.$aaaa." `source`='".$value."' ";
        }
        $where .= ' )';
    }
}

        if ($loc != '' || $loc != null) {
            $t=$this->getlocpro($loc);
            if (is_array($t)&&!empty($t)) {
                $where .= ' AND ( ';
                foreach ($t as $key => $value) {
                    $aaaa = '';
                    if ($key != 0) {
                        $aaaa = 'OR';
                    }
        //$where .= ' '.$aaaa." `interest` LIKE '%".$value."%' ";
        $where .= ' '.$aaaa." (`interest` LIKE '%,".$value.",%' OR `interest` LIKE '%,".$value."%' OR `interest` LIKE '%".$value.",%'OR `interest` LIKE '%[".$value."]%')  ";
                }
                $where .= ' )';
            }
        }


        if ($leadstatus != '' || $leadstatus != null) {
            $where .= ' AND ( ';
            foreach ($leadstatus as $key => $value) {
                //echo  $value." => ";
$aaaa = '';
                if ($key != 0) {
                    $aaaa = 'OR';
                }

                $where .= ' '.$aaaa." `status`='".$value."' ";
            }
            $where .= ' )';
        }

        if ($saleperson != '' || $saleperson != null) {
            $where .= ' AND ( ';
            foreach ($saleperson as $key => $value) {
                $aaaa = '';
                if ($key != 0) {
                    $aaaa = 'OR';
                }

                $where .= ' '.$aaaa." `spid`='".$value."' ";
            }
            $where .= ' )';
        }

        if ($project != '' || $project != null) {
            //pre($project);
//     $where .= ' AND ( ';
//     foreach ($saleperson as $key => $value) {
//         $aaaa = '';
//         if ($key != 0) {
//             $aaaa = 'OR';
//         }
//
//         $where .= ' '.$aaaa." `interest`='[".$value."]' ";
//     }
//     $where .= ' )';
        }

        $sql = 'SELECT * FROM '.self::leTable." where leadsid='".$id."' ".$where.' ORDER BY id ASC';
        $row = self::$db->fetch_all($sql);









        return $row;
    }
    public function getlocpro($loc)
    {
        $arrayName = array();
        foreach ($loc as $key => $value) {
            $sql = 'SELECT * FROM '.self::prTable."  where location='$value' AND active=1";
            $row = self::$db->fetch_all($sql);
            foreach ($row as $key2 => $value2) {
                $arrayName[] = ($value2->id);
            }
        }
        return $arrayName;
    }

    public function getprojectsearch($loc)
    {
        $arrayName = array();
        foreach ($loc as $key => $value) {
            $sql = '  SELECT * FROM '.self::prTable."  where location='$value' AND active=1";
            $row = self::$db->fetch_all($sql);
            foreach ($row as $key2 => $value2) {
                $arrayName[] = ($value2->id);
            }
        }
        return $arrayName;
    }


    public function getAllProjectSearch($name, $subname, $sorting)
    {
        $aname = '';
        $asubname = '';

        $wh = '';
        if ($name != '') {
            $aname .= "AND name LIKE '%$name%'";
        }

        $s = '';
        if ($sorting != '' && $sorting != '0') {
            $s .= "ORDER BY l.$sorting";
        }

        $sql = '  SELECT id,name,parent,first FROM '.self::prTable."  where parent=0 AND active=1 $aname order by first";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $row[$key]->name = ucwords(strtolower($row[$key]->name));
        }

        $a = ObjtoArr($row);

        foreach ($a as $key => $value) {
            //pre();
            $sql2 = ' SELECT id,name FROM '.self::prTable."  where parent='$value[id]'  AND active='1'";
            $row2 = self::$db->fetch_all($sql2);
            $sub = '';
            $subarray = array();
            if (!empty($row2)) {
                foreach ($row2 as $key2 => $value) {
                    $sub .= $value->name.'|';
                    $subarray[] = trim($value->name);
                }
            }

            $a[$key]['sub'] = $sub;
            $a[$key]['subarray'] = $subarray;
        }

        if ($subname == '') {
            return $a;
        } else {
            $finalarray = array();

            foreach ($a as $key => $value) {
                if (!empty($value['subarray'])) {
                    foreach ($value['subarray'] as $key2 => $value2) {
                        if (strpos($value2, $subname) !== false) {
                            $finalarray[] = $key;
                        }
                    }
                }
            }
            $last = array();
            if (!empty($finalarray)) {
                $finalarray1 = array_unique($finalarray);
                foreach ($finalarray1 as $key) {
                    $last[] = $a[$key];
                }
            }

            return $last;
        }
    }

    public function getAllSourceSearch($name, $subname, $sorting)
    {
        $aname = '';
        $asubname = '';

        $wh = '';
        if ($name != '') {
            $aname .= "AND name LIKE '%$name%'";
        }

        $s = '';
        if ($sorting != '' && $sorting != '0') {
            $s .= "ORDER BY l.$sorting";
        }

// $sql = "SELECT *,name as newname FROM " . self::prTable . " WHERE active=1 AND parent=0 AND first=0 ORDER BY sorting DESC";
// $row = self::$db->fetch_all($sql);

$sql = '  SELECT id,name,parent,first FROM '.self::sorTable."  where parent=0 AND active=1 $aname order by first";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $row[$key]->name = ucwords(strtolower($row[$key]->name));
        }
//    $sql = "SELECT *"
// . "\n FROM " . self::prTable. " WHERE TRUE $a group by id $s";
//     $row = self::$db->fetch_all($sql);
$a = ObjtoArr($row);

        foreach ($a as $key => $value) {
            //pre();
$sql2 = ' SELECT id,name FROM '.self::sorTable."  where parent='$value[id]'  AND active='1'";
            $row2 = self::$db->fetch_all($sql2);
            $sub = '';
            $subarray = array();
            if (!empty($row2)) {
                foreach ($row2 as $key2 => $value) {
                    $sub .= $value->name.'|';
                    $subarray[] = trim($value->name);
                }
            }
//  echo "<br>string<br>";
//$row[$key]->name=ucwords(strtolower($row[$key]->name));

$a[$key]['sub'] = $sub;
            $a[$key]['subarray'] = $subarray;
        }

        if ($subname == '') {
            return $a;
        } else {
            $finalarray = array();

            foreach ($a as $key => $value) {
                if (!empty($value['subarray'])) {
                    foreach ($value['subarray'] as $key2 => $value2) {
                        if (strpos($value2, $subname) !== false) {
                            $finalarray[] = $key;
                        }
                    }
                }
            }
            $last = array();
            if (!empty($finalarray)) {
                $finalarray1 = array_unique($finalarray);
                foreach ($finalarray1 as $key) {
                    $last[] = $a[$key];
                }
            }

            return $last;
        }
    }

    public function getAddress($type)
    {
        switch ($type) {
case 'p':
$typesearch = 'postcode';
break;

default:
$typesearch = 'postcode';
break;
}

        $sql = 'SELECT p.id,p.postcode,p.post_office, s.state_code, s.state_name
FROM '.self::posTable.' p
LEFT JOIN '.self::staTable." s
ON p.state_code=s.state_code
group by postcode
ORDER BY p.$typesearch";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getInterest($id, $search = false)
    {
        $where = '';
        if ($search) {
            $min = $search['min'];
            $max = $search['max'];
            $apptype = $search['apptype'];
            $leadstatus = $search['leadstatus'];
            $location = $search['location'];

            $mmin = 0;
            if ($min != '' || $min != null) {
                $mmin = 1;
            }

            $mmax = 0;
            if ($max != '' || $max != null) {
                $mmax = 1;
            }

            if ($mmin == 1 && $mmax == 1 && $mmin <= $mmax && $min != 0 && $max != 0) {
                //$where.=" AND pricemin>=".$min." AND pricemax<=".$max." ";
$where .= 'AND (pricemin BETWEEN '.$min.' AND '.$max.') AND (pricemax BETWEEN '.$min.' AND '.$max.')';
            }

            if ($apptype != '' || $apptype != null) {
                $where .= ' AND ( ';
                foreach ($apptype as $key => $value) {
                    $aaaa = '';
                    if ($key != 0) {
                        $aaaa = 'OR';
                    }

                    $where .= ' '.$aaaa." (`type` LIKE '%,".$value.",%' OR `type` LIKE '%,".$value."%' OR `type` LIKE '%".$value.",%') ";
                }
                $where .= ' )';
            }
        }
//echo "                                ".
$sql = 'SELECT * FROM '.self::prTable." where id='".$id."' ".$where.' ORDER BY id ASC';
        $row = self::$db->fetch_all($sql);
        if (!empty($row)) {
            if ($row[0]->parent != 0) {
                $row = self::getInterest($row[0]->parent);
            }
        }

        return $row;
    }

    public function getSource($id)
    {
        $sql = 'SELECT * FROM '.self::sorTable." where id='".$id."' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);

        if ($row[0]->parent != 0) {
            $row = self::getSource($row[0]->parent);
        }

        return $row;
    }


    public function getProject($id)
    {
        $sql = 'SELECT * FROM '.self::prTable." where id='".$id."' ORDER BY id ASC";
        $row = self::$db->first($sql);

        if ($row->parent != 0) {
            $row = self::getProject($row->parent);
        }

        return $row;
    }






    public function getSource2($id)
    {
        //echo "<br>".
        $sql = 'SELECT * FROM '.self::sorTable." where id='".$id."' ORDER BY id ASC";
        $row = self::$db->first($sql);
        //pre($row);

        if ($row->parent != 0) {
            $row = self::getSource($row->parent);
        }

        return $row;
    }



    public function getAllSource()
    {
        $sql = 'SELECT * FROM '.self::sorTable." where parent='0' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getStatus($id)
    {
        $sql = 'SELECT * FROM '.self::dTable." where id='".$id."' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getStatus2($id)
    {
        $sql = 'SELECT * FROM '.self::dTable." where id='".$id."' ORDER BY id ASC";

        return self::$db->first($sql);
    }
    public function getAllStatus()
    {
        $sql = 'SELECT * FROM '.self::dTable." where name='status' ORDER BY id ASC";
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function getCountry()
    {
        $sql = 'SELECT * FROM '.self::conTable.' ORDER BY id ASC';
        $row = self::$db->fetch_all($sql);

        return $row;
    }

    public function colorstatus($id)
    {
        $sql = 'SELECT * FROM '.self::sTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            if ($key->id == $id) {
                $data = "<td  align=\"center\"  data-title=\"Status\">
<p class=\"wrap\" id=\"style2\">

<button disabled style=\"background-color:$key->style;\">
$key->name
</button></p>
</td>";
            }
        }

        return $data;
    }

    public function getstatusid($id)
    {
        $sql = 'SELECT * FROM '.self::sTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            if ($key->id == $id) {
                $data = $key->name;
            }
        }

        return $data;
    }

    public function getstatusradio($name, $id = false)
    {
        $sql = 'SELECT * FROM '.self::sTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        $data = '';
        foreach ($row as $key) {
            $icon = self::getfasingle($key->icon);
            if ($key->id == $id) {
                $data .= '<label title="'.$key->name.'" class="btn btn-circle active" style=" background-color:'.$key->style.';"><input type="radio" id="q156" name="'.$name.'" value="'.$key->id.'" checked />'.$icon.'</label>';
            } else {
                $data .= '<label title="'.$key->name.'" class="btn btn-circle" style=" background-color:'.$key->style.';"><input type="radio" id="q156" name="'.$name.'" value="'.$key->id.'" />'.$icon.'</label>';
            }
        }

//

return $data;
    }

/**
 * Content::getCompanyList().
 *
 * @return
 */
public function getpaymentDetailListuser($user)
{
    $range = date('Y/m/d', strtotime('-6 months'));

    if (isset($_REQUEST['search'])) {
        $daterange = explode('-', $_REQUEST['daterange']);
        $start = preg_replace('/\s+/', '', $daterange[0]);
        $end = preg_replace('/\s+/', '', $daterange[1]);
        $dates = preg_split('/\//', $start);
        $StartDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
        $dates = preg_split('/\//', $end);
        $EndDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
        $where = "WHERE AppliedDate BETWEEN '$StartDate' AND '$EndDate' AND active ='1'";
        if (isset($_REQUEST['Company']) && $_REQUEST['Company'] != '' && $_REQUEST['Company'] != 0) {
            $Company = $_REQUEST['Company'];
            $where .= " AND Company='$Company'";
        }
        if (isset($_REQUEST['Beneficiary']) && $_REQUEST['Beneficiary'] != '' && $_REQUEST['Beneficiary'] != 0) {
            $Beneficiary = $_REQUEST['Beneficiary'];
            $where .= " AND Beneficiary='$Beneficiary'";
        }
        if (isset($_REQUEST['Status']) && $_REQUEST['Status'] != '' && $_REQUEST['Status'] != 0) {
            $Status = $_REQUEST['Status'];
            $where .= " AND Status='$Status'";
        }
        if (isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '') {
            $keyword = $_REQUEST['keyword'];
            $where .= " AND Project LIKE '%$keyword%' OR Purpose LIKE '%$keyword%'";
        }
        $sql = 'SELECT * FROM '.self::pTable." $where AND userid='".$user."' AND created >= '".$range."'";
    } elseif (isset($_GET['Status']) && $_GET['Status'] != '' && $_GET['Status'] != 0) {
        $Status = $_REQUEST['Status'];
        $sql = 'SELECT * FROM '.self::pTable." WHERE Status='$Status' AND userid='".$user."' AND created >= '".$range."'";
    } else {
        $sql = 'SELECT * FROM '.self::pTable." WHERE userid='".$user."' AND created >= '".$range."'";
    }

    $row = self::$db->fetch_all($sql);

    return ($row) ? $row : 0;
}

    public function getpaymentReadyDetailListuser($user)
    {
        $range = date('Y/m/d', strtotime('-6 months'));

        if (isset($_REQUEST['search'])) {
            $daterange = explode('-', $_REQUEST['daterange']);
            $start = preg_replace('/\s+/', '', $daterange[0]);
            $end = preg_replace('/\s+/', '', $daterange[1]);
            $dates = preg_split('/\//', $start);
            $StartDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
            $dates = preg_split('/\//', $end);
            $EndDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
            $where = "WHERE AppliedDate BETWEEN '$StartDate' AND '$EndDate' AND active ='1'";
            if (isset($_REQUEST['Company']) && $_REQUEST['Company'] != '' && $_REQUEST['Company'] != 0) {
                $Company = $_REQUEST['Company'];
                $where .= " AND Company='$Company'";
            }
            if (isset($_REQUEST['Beneficiary']) && $_REQUEST['Beneficiary'] != '' && $_REQUEST['Beneficiary'] != 0) {
                $Beneficiary = $_REQUEST['Beneficiary'];
                $where .= " AND Beneficiary='$Beneficiary'";
            }

            if (isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '') {
                $keyword = $_REQUEST['keyword'];
                $where .= " AND Project LIKE '%$keyword%' OR Purpose LIKE '%$keyword%'";
            }
            $sql = 'SELECT * FROM '.self::pTable." $where AND userid='".$user."' AND Status=6 AND created >= '".$range."'";
        } else {
            $sql = 'SELECT * FROM '.self::pTable." WHERE userid='".$user."' AND Status=6 AND created >= '".$range."'";
        }

        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function statusDashboard($user)
    {
        $sql = 'SELECT status,count(status) as total FROM '.self::pTable." WHERE userid='".$user."' group by status";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function statusDashboardAll()
    {
        $sql = 'SELECT status,count(status) as total FROM '.self::pTable.'  group by status';
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getpaymentDetailList($user)
    {
        $sql = 'SELECT * FROM '.self::pTable." WHERE userid='".$user."'";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getpaymentDetailbyCompany($company)
    {
        $sql = 'SELECT * FROM '.self::pTable." WHERE Company='".$company."'";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getpaymentDetailALL()
    {
        if (isset($_REQUEST['search'])) {
            $daterange = explode('-', $_REQUEST['daterange']);
            $start = preg_replace('/\s+/', '', $daterange[0]);
            $end = preg_replace('/\s+/', '', $daterange[1]);
            $dates = preg_split('/\//', $start);
            $StartDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
            $dates = preg_split('/\//', $end);
            $EndDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
            $where = "WHERE AppliedDate BETWEEN '$StartDate' AND '$EndDate' AND active ='1'";
            if (isset($_REQUEST['Company']) && $_REQUEST['Company'] != '' && $_REQUEST['Company'] != 0) {
                $Company = $_REQUEST['Company'];
                $where .= " AND Company='$Company'";
            }
            if (isset($_REQUEST['Beneficiary']) && $_REQUEST['Beneficiary'] != '' && $_REQUEST['Beneficiary'] != 0) {
                $Beneficiary = $_REQUEST['Beneficiary'];
                $where .= " AND Beneficiary='$Beneficiary'";
            }
            if (isset($_REQUEST['Status']) && $_REQUEST['Status'] != '' && $_REQUEST['Status'] != 0) {
                $Status = $_REQUEST['Status'];
                $where .= " AND Status='$Status'";
            }
            if (isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '') {
                $keyword = $_REQUEST['keyword'];
                $where .= " AND Project LIKE '%$keyword%' OR Purpose LIKE '%$keyword%'";
            }
            $sql = 'SELECT * FROM '.self::pTable." $where AND Status <> 6";
        } elseif (isset($_GET['Status']) && $_GET['Status'] != '' && $_GET['Status'] != 0) {
            $Status = $_REQUEST['Status'];
            $sql = 'SELECT * FROM '.self::pTable." WHERE Status='$Status' AND Status <> 6";
        } else {
            $sql = 'SELECT * FROM '.self::pTable.' WHERE  Status <> 6';
        }

        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getpaymentReadyDetailALL()
    {
        if (isset($_REQUEST['search'])) {
            $daterange = explode('-', $_REQUEST['daterange']);
            $start = preg_replace('/\s+/', '', $daterange[0]);
            $end = preg_replace('/\s+/', '', $daterange[1]);
            $dates = preg_split('/\//', $start);
            $StartDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
            $dates = preg_split('/\//', $end);
            $EndDate = $dates[2].'-'.$dates[1].'-'.$dates[0];
            $where = "WHERE AppliedDate BETWEEN '$StartDate' AND '$EndDate' AND active ='1'";
            if (isset($_REQUEST['Company']) && $_REQUEST['Company'] != '' && $_REQUEST['Company'] != 0) {
                $Company = $_REQUEST['Company'];
                $where .= " AND Company='$Company'";
            }
            if (isset($_REQUEST['Beneficiary']) && $_REQUEST['Beneficiary'] != '' && $_REQUEST['Beneficiary'] != 0) {
                $Beneficiary = $_REQUEST['Beneficiary'];
                $where .= " AND Beneficiary='$Beneficiary'";
            }

            if (isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '') {
                $keyword = $_REQUEST['keyword'];
                $where .= " AND Project LIKE '%$keyword%' OR Purpose LIKE '%$keyword%'";
            }
            $sql = 'SELECT * FROM '.self::pTable." $where AND Status=6";
        } else {
            $sql = 'SELECT * FROM '.self::pTable.' WHERE  Status=6';
        }

        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

/**
 * Content::getCompanyList().
 *
 * @return
 */
public function getFAList()
{
    $sql = 'SELECT * FROM '.self::fTable;
    $row = self::$db->fetch_all($sql);

    return ($row) ? $row : 0;
}

    public function getfasingle($id)
    {
        $sql = 'SELECT * FROM '.self::fTable." Where id=$id";
        $row = self::$db->first($sql);
        $a = "<i class='fa $row->name' style='color:white'></i>";

        return $a;

// return ($row) ? $row : 0;
    }

    public function modifySubCategory($adds, $dels, $proid)
    {
        if ($adds) {
            foreach ($adds as $add) {
                $data = array(
'parent' => $proid,
'first' => 0,
);
                self::$db->update(self::prTable, $data, 'id='.$add);
            }
        }

        if ($dels) {
            foreach ($dels as $del) {
                $data = array(
'parent' => 0,
'first' => 1,
);
                self::$db->update(self::prTable, $data, 'id='.$del);
            }
        }

        return array('status' => 'ok', 'data' => "$proid");
    }

    public function getFAListselect($name, $id = false)
    {
        $da = '<select class="largeselect fadr form-control" required name="'.$name.'" id="'.$name.'">';
        $da .= '  <option value="null">-Select-</option>';
        $row = self::getFAList();
        foreach ($row as $key) {
            if ($key->id == $id) {
                $da .= '  <option class="fadr" value="'.$key->id.'" selected>'.$key->en.'</option>';
            } else {
                $da .= '  <option class="fadr" value="'.$key->id.'">'.$key->en.'</option>';
            }
        }
        $da .= '</select>';

        return $da;
    }

    public function getCompanyList()
    {
        $sql = 'SELECT * FROM '.self::cTable.' WHERE active=1 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getProjectParentANDfirstList($id)
    {
        $sql = 'SELECT *,name as newname FROM '.self::prTable.' WHERE active=1 AND parent='.$id.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $row[$key]->newname = strtolower(str_replace(' ', '', $row[$key]->newname));
            $row[$key]->newname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[$key]->newname);
        }
        $row2['projectid'] = $id;
        $row2['datas'] = $row;

        return ($row2) ? $row2 : 0;
    }

    public function getProjectParentID($id)
    {
        $sql = 'SELECT id FROM '.self::prTable.' WHERE active=1 AND parent='.$id.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        $ret = array();
        foreach ($row as $key => $value) {
            $ret[] = $value->id;
        }

        return ($ret) ? $ret : array();
    }

    public function getProjectParent($id)
    {
        $sql = 'SELECT *,name as newname FROM '.self::prTable.' WHERE active=1 AND parent='.$id.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $row[$key]->newname = strtolower(str_replace(' ', '', $row[$key]->newname));
            $row[$key]->newname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[$key]->newname);
        }

        return ($row) ? $row : 0;
    }


    public function ProjectisParent($id)
    {
        $sql = 'SELECT * FROM '.self::prTable.' WHERE active=1 AND id="'.$id.'" ORDER BY sorting DESC';
        $row = self::$db->first($sql);
        if ($row->parent!=0) {
            $sql = 'SELECT * FROM '.self::prTable.' WHERE active=1 AND id="'.$row->id.'" ORDER BY sorting DESC';
            $row2 = self::$db->first($sql);
            if ($row2->parent!=0) {
                $sql = 'SELECT * FROM '.self::prTable.' WHERE active=1 AND id="'.$row2->id.'" ORDER BY sorting DESC';
                $row3 = self::$db->first($sql);
                return $row3;
            } else {
                return ($row2) ? $row2 : 0;
            }
        }
        return ($row) ? $row : 0;
    }
    public function ProjectisParent2()
    {
        $sql = 'SELECT * FROM '.self::prTable.' WHERE active=1 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        $a=array();

        foreach ($row as $key => $value) {
            echo "string $value->id";
            $z=$this->ProjectisParent($value->id);
            pre($z);
        }


        //return ($row) ? $row : 0;
    }



    public function getEditCat($id)
    {
        $sql = 'SELECT *,name as newname FROM '.self::prTable." WHERE active=1 AND id='".$id."' ORDER BY sorting DESC";
        $row = self::$db->first($sql);
        $row->newname = strtolower(str_replace(' ', '', $row->newname));
        $row->newname = preg_replace('/[^A-Za-z0-9\-]/', '', $row->newname);

        $sql2 = 'SELECT *,name as newname FROM '.self::prTable." WHERE active=1 AND (parent='".$id."' OR first='1') ORDER BY sorting DESC";
        $row2 = self::$db->fetch_all($sql2);
        foreach ($row2 as $key => $value) {
            $row2[$key]->newname = strtolower(str_replace(' ', '', $row2[$key]->newname));
            $row2[$key]->newname = preg_replace('/[^A-Za-z0-9\-]/', '', $row2[$key]->newname);
        }
        if (!empty($row2)) {
            $allnouse = $row2;
        } else {
            $allnouse = null;
        }

        $lala = array(
'projectname' => $row->name,
'first' => $row->first,
'parent' => $row->parent,
'id' => $row->id,
'allnouse' => $allnouse,

);

        return ($lala) ? $lala : 0;
    }

    public function getProjectList()
    {
        $sql = 'SELECT *,name as newname FROM '.self::prTable.' WHERE active=1 AND parent=0 AND first=0 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $row[$key]->newname = strtolower(str_replace(' ', '', $row[$key]->newname));
            $row[$key]->newname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[$key]->newname);
        }

        return ($row) ? $row : 0;
    }

    public function getProjectListbyID($id)
    {
        $sql = 'SELECT * FROM '.self::prTable." WHERE active=1 AND id='".$id."' ORDER BY sorting DESC";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getPR($id)
    {
        $sql = 'SELECT * FROM '.self::pTable." WHERE id='".$id."' ";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getPRid($id)
    {
        $sql = 'SELECT * FROM '.self::pTable." WHERE id='".$id."' ";
        $row = self::$db->first($sql);

        return ($row) ? $row : 0;
    }

    public function getPRuser($id)
    {
        $sql = 'SELECT * FROM '.self::pTable." WHERE userid='".$id."' ";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getcompanybyid($id)
    {
        $sql = 'SELECT * FROM '.self::cTable." WHERE id='".$id."' ";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getcompanybyid2($id)
    {
        $sql = 'SELECT * FROM '.self::cTable." WHERE id='".$id."' ";
        $row = self::$db->first($sql);

        return ($row) ? $row : 0;
    }

    public function getBF($id)
    {
        $sql = 'SELECT * FROM '.self::bTable." WHERE id='".$id."' ";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getCompanynamebyid($id)
    {
        $sql = 'SELECT * FROM '.self::cTable." WHERE id='".$id."' ";
        $row = self::$db->fetch_all($sql);
        echo $row[0]->name;
    }

    public function getCompanynamebyid2($id)
    {
        $sql = 'SELECT * FROM '.self::cTable." WHERE id='".$id."' ";
        $row = self::$db->fetch_all($sql);

        return $row[0]->name;
    }

    public function getCompanynicknamebyid2($id)
    {
        $sql = 'SELECT * FROM '.self::cTable." WHERE id='".$id."' ";
        $row = self::$db->fetch_all($sql);

        return $row[0]->nickname;
    }

    public function getbnamebyid($id)
    {
        $sql = 'SELECT * FROM '.self::bTable." WHERE id='".$id."' ";
        $row = self::$db->fetch_all($sql);
        echo $row[0]->name;
    }

    public function getprojectname($id)
    {
        $un = unserialize($id);
        $text = '<ul>';
        foreach ($un as $key => $value) {
            $sql = 'SELECT * FROM '.self::prTable." WHERE id='".$key."' ";
            $row = self::$db->first($sql);
            $text .= '<li>'.styleword($row->name).'('.styleword($value).')</li>';
        }

        $text .= '</ul>';

        return $text;
    }

    public function getprojectpreview($id)
    {
        $un = unserialize($id);
        $text = '';
        foreach ($un as $key => $value) {
            $sql = 'SELECT * FROM '.self::prTable." WHERE id='".$key."' ";
            $row = self::$db->fetch_all($sql);
            $text .= $row[0]->name.'<br>('.$value.')<br>';
        }

        return $text;
    }
    public function getprojectname2($id)
    {
        $un = unserialize($id);
        $text = '';
        foreach ($un as $key) {
            $sql = 'SELECT * FROM '.self::prTable." WHERE id='".$key."' ";
            $row = self::$db->fetch_all($sql);
            $text .= $row[0]->name.',';
        }

        return $text;
    }
    public function getprojectname3($id)
    {
        $un = unserialize($id);
        $text = '';
        $i = 1;
        foreach ($un as $key) {
            $sql = 'SELECT * FROM '.self::prTable." WHERE id='".$key."' ";
            $row = self::$db->fetch_all($sql);
            $text .= $i.'. '.$row[0]->name.'<br>';
            ++$i;
        }

        return $text;
    }

    public function getCompanydropdown()
    {
        $dr = '<select required name="companylist" id="companylist">';
        $dr .= '  <option value="null">-Select-</option>';
        $sql = 'SELECT * FROM '.self::cTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            $dr .= '  <option value="'.$key->id.'">'.styleword($key->name).'</option>';
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getCompanydropdowngo($id = false)
    {
        $dr = '<select required name="companylist" id="companylist" onChange="getState(this.value);">';
        $dr .= '  <option value="null">-Select-</option>';
        $sql = 'SELECT * FROM '.self::cTable.' where active=1 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            if ($key->id == $id) {
                $dr .= '  <option value="'.$key->id.'" selected>'.styleword($key->name).'</option>';
            } else {
                $dr .= '  <option value="'.$key->id.'">'.styleword($key->name).'</option>';
            }
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getStatusdropdown()
    {
        $dr = '<select  name="statuslist" id="statuslist">';
        $dr .= '  <option value="null">-Select-</option>';
        $sql = 'SELECT * FROM '.self::sTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            $dr .= '  <option value="'.$key->id.'">'.$key->name.'</option>';
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getCompanydropdownforce($select = false)
    {
        $dr = '<select onChange="window.document.location.href=this.options[this.selectedIndex].value;" name="companylist" id="companylist">';
        $dr .= '  <option value="null">-Select-</option>';
        $sql = 'SELECT * FROM '.self::cTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            $link = phpself()."?company=$key->id";
            if ($key->id == $select) {
                $dr .= '  <option value="'.$link.'" selected>'.$key->name.'</option>';
            } else {
                $dr .= '  <option value="'.$link.'">'.$key->name.'</option>';
            }
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getCompanydropdownchecked($id)
    {
        $dr = '<select required name="companylist" id="companylist">';
        $dr .= '  <option value="0">-Select-</option>';
        $sql = 'SELECT * FROM '.self::cTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            if ($key->id == $id) {
                $dr .= '  <option value="'.$key->id.'" selected>'.styleword($key->name).'</option>';
            } else {
                $dr .= '  <option value="'.$key->id.'">'.styleword($key->name).'</option>';
            }
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getBeneficiarydropdownchecked($id)
    {
        $dr = '<select required name="bflist" id="bflist">';
        $dr .= '  <option value="null">-Select-</option>';
        $sql = 'SELECT * FROM '.self::bTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            if ($key->id == $id) {
                $dr .= '  <option value="'.$key->id.'" selected>'.$key->name.'</option>';
            } else {
                $dr .= '  <option value="'.$key->id.'">'.$key->name.'</option>';
            }
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getStatusdropdownchecked($id)
    {
        $dr = '<select required name="statuslist" id="statuslist">';
        $dr .= '  <option value="null">-Select-</option>';
        $sql = 'SELECT * FROM '.self::sTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            if ($key->id == $id) {
                $dr .= '  <option value="'.$key->id.'" selected>'.$key->name.'</option>';
            } else {
                $dr .= '  <option value="'.$key->id.'">'.$key->name.'</option>';
            }
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getStatusdropdowncheckedS($id)
    {
        $dr = '<select required name="statuslist" id="statuslist">';
        $dr .= '  <option value="null">-Select-</option>';
        $sql = 'SELECT * FROM '.self::sTable.' WHERE id <> 6 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            if ($key->id == $id) {
                $dr .= '  <option value="'.$key->id.'" selected>'.$key->name.'</option>';
            } else {
                $dr .= '  <option value="'.$key->id.'">'.$key->name.'</option>';
            }
        }
        $dr .= '</select>';
        echo $dr;
    }

    public function getBeneficiaryList()
    {
        $sql = 'SELECT * FROM '.self::bTable.' WHERE active=1 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getPaymentStatusList()
    {
        $sql = 'SELECT * FROM '.self::sTable.' WHERE active=1 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getPaymentTypeList()
    {
        $sql = 'SELECT * FROM '.self::ptTable.' WHERE active=1 ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getPaymentTypeListbyID($id)
    {
        $sql = 'SELECT * FROM '.self::ptTable." WHERE id='$id' ORDER BY sorting DESC";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getBeneficiaryListbyID($id)
    {
        $sql = 'SELECT * FROM '.self::bTable." WHERE id='$id' ORDER BY sorting DESC";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getComListbyID($id)
    {
        $sql = 'SELECT * FROM '.self::cTable." WHERE id='$id' ORDER BY sorting DESC";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getStatusList()
    {
        $sql = 'SELECT * FROM '.self::sTable.' ORDER BY sorting DESC';
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function getStatusListid($id)
    {
        $sql = 'SELECT * FROM '.self::sTable." WHERE id='$id' ORDER BY sorting DESC";
        $row = self::$db->first($sql);

        return ($row) ? $row : 0;
    }

    public function getStatusListbyID($id)
    {
        $sql = 'SELECT * FROM '.self::sTable." WHERE id='$id' ORDER BY sorting DESC";
        $row = self::$db->fetch_all($sql);

        return ($row) ? $row : 0;
    }

    public function BeneficiarySearch($type, $name)
    {
        $data = array();
        $sql = 'SELECT * FROM '.self::bTable.'  where UPPER('.$type.") LIKE '".strtoupper($name)."%' ORDER BY sorting DESC";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            $name = $key->name.'|'.$key->contactperson.'|'.$key->contactnumber.'|'.$key->regno.'|'.$key->gstno.'|'.$key->accno.'|'.$key->bankname.'|'.$key->bankaddress.'|'.$key->email;
            array_push($data, $name);
        }
        echo json_encode($data);
    }

    public function CompanySearch($type, $name)
    {
        $data = array();
        $sql = 'SELECT * FROM '.self::cTable.'  where UPPER('.$type.") LIKE '".strtoupper($name)."%' ORDER BY sorting DESC";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key) {
            $name = $key->name.'|'.$key->regno.'|'.$key->gstno;
            array_push($data, $name);
        }
        echo json_encode($data);
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

    public function isNumber($number)
    {
        if (is_numeric($number)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function addNewMemberType()
    {
        Filter::checkPost('member_type', 'Membership Type');
        Filter::checkPost('member_code', 'Membership Code');
        Filter::checkPost('min_purchase', 'Minimum Purchase');
        Filter::checkPost('max_purchase', 'Maximum Purchase');

        if (!$this->isNumber($_POST['min_purchase'])) {
            Filter::$msgs['min_purchase'] = 'Minimum Purchase : only numbers allowed';
        }

        if (!$this->isNumber($_POST['max_purchase'])) {
            Filter::$msgs['max_purchase'] = 'Maximum Purchase : only numbers allowed';
        }

        if ($_POST['min_purchase'] > $_POST['max_purchase']) {
            Filter::$msgs['range'] = 'Minimum & Maximum : Invalid range';
        }

        if (empty(Filter::$msgs)) {
            $data = array(
              'member_type' => strtolower(sanitize($_POST['member_type'])),
              'member_code' => strtolower(sanitize($_POST['member_code'])),
              'min_purchase' => strtolower(sanitize($_POST['min_purchase'])),
              'max_purchase' => strtolower(sanitize($_POST['max_purchase']))
            );
            self::$db->insert(self::memTypeTable, $data);

            if (self::$db->affected()) {
                $json['type'] = 'OK';
                $json['title'] = 'Success';
                $json['message'] = 'New membership type successfully added';

                return json_encode($json);
            } else {
                $json['type'] = 'error';
                $json['title'] = 'Error';
                $json['message'] = 'There was an error during the process. Please contact the administrator...';

                return json_encode($json);
            }
        } else {
            $json['type'] = 'ERROR';
            $json['title'] = 'Please correct the following fields:';
            $json['message'] = Filter::msgSingleStatus();

            return json_encode($json);
        }

        return json_encode($json);
    }


    public function editMemberType()
    {
        $id = $_POST['id'];
        Filter::checkPost('member_type', 'Membership Type');
        Filter::checkPost('member_code', 'Membership Code');
        Filter::checkPost('min_purchase', 'Minimum Purchase');
        Filter::checkPost('max_purchase', 'Maximum Purchase');

        if (!$this->isNumber($_POST['min_purchase'])) {
            Filter::$msgs['min_purchase'] = 'Minimum Purchase : only numbers allowed';
        }

        if (!$this->isNumber($_POST['max_purchase'])) {
            Filter::$msgs['max_purchase'] = 'Maximum Purchase : only numbers allowed';
        }

        if ($_POST['min_purchase'] > $_POST['max_purchase']) {
            Filter::$msgs['range'] = 'Minimum & Maximum : Invalid range';
        }

        if (empty(Filter::$msgs)) {
            $data = array(
                'member_type' => (sanitize($_POST['member_type'])),
                'member_code' => (sanitize($_POST['member_code'])),
                'min_purchase' => (sanitize($_POST['min_purchase'])),
                'max_purchase' => (sanitize($_POST['max_purchase'])),
                'updated'=>'now()'
        );

            self::$db->update(self::memTypeTable, $data, "id=" .$id);


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

    public function deleteMemberType($id)
    {
        //$res = self::$db->delete(self::uTable,'id='.$id);
    $data = array(
        'active' => '0'
    );
        $res = self::$db->update(self::memTypeTable, $data, "id='" .$id. "'");


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

    public function addNewCustomers()
    {
        Filter::checkPost('name', 'Name');
        Filter::checkPost('email', 'Email');
        if (!$this->isValidEmail($_POST['email'])) {
            Filter::$msgs['email'] = 'Entered Email Address Is Not Valid.';
        }
        Filter::checkPost('contact_m', 'Mobile Number');
        Filter::checkPost('icpassport', 'IC / Passport');
        Filter::checkPost('race', 'Race');
        Filter::checkPost('address', 'Address');
        Filter::checkPost('occupation', 'Occupation');
        Filter::checkPost('bumistatus', 'Bumi Status');
        if (empty(Filter::$msgs)) {
            $data = array(
'salutationtype' => strtolower(sanitize($_POST['salutationtype'])),
'name' => strtolower(sanitize($_POST['name'])),
'email' => strtolower(sanitize($_POST['email'])),
'gender' => strtolower(sanitize($_POST['gender'])),
'icpassport' => strtolower(sanitize($_POST['icpassport'])),
'race' => strtolower(sanitize($_POST['race'])),
'contact_m' => strtolower(sanitize($_POST['contact_m'])),
'contact_o' => strtolower(sanitize($_POST['contact_o'])),
'contact_h' => strtolower(sanitize($_POST['contact_h'])),
'contact_f' => strtolower(sanitize($_POST['contact_f'])),
'address' => strtolower(sanitize($_POST['address'])),
'postcode' => strtolower(sanitize($_POST['postcode'])),
'city' => strtolower(sanitize($_POST['city'])),
'state' => strtolower(sanitize($_POST['state'])),
'country' => strtolower(sanitize($_POST['country'])),
'occupation' => strtolower(sanitize($_POST['occupation'])),
'bumistatus' => strtolower(sanitize($_POST['bumistatus'])),
'created' => 'NOW()',
);
            self::$db->insert(self::cusTable, $data);

            if (self::$db->affected()) {
                $json['type'] = 'OK';
                $json['title'] = 'Success';
                $json['message'] = 'the Customer have successfully registered.';

                return json_encode($json);
            } else {
                $json['type'] = 'error';
                $json['title'] = 'Error';
                $json['message'] = 'There was an error during Customer registration process. Please contact the administrator...';

                return json_encode($json);
            }
        } else {
            $json['type'] = 'ERROR';
            $json['title'] = 'Please complete the following fields:';
            $json['message'] = Filter::msgSingleStatus();

            return json_encode($json);
        }

        return json_encode($json);
    }

    public function addNewProjects()
    {
        $data = array(
      'name' => $_POST['name'],
      'first' => '1',
      );
        $a=self::$db->insert(self::prTable, $data);
        if ($a) {
            $json['type'] = 'OK';
            $json['title'] = 'Success';
            $json['message'] = 'the Project have successfully registered.';
            $json['id'] = $a;
        } else {
            $json['type'] = 'error';
            $json['title'] = 'Error';
            $json['message'] = 'There was an error during Project registration process. Please contact the administrator...';
        }
        return json_encode($json);
    }
    public function addNewLeads()
    {
        Filter::checkPost('name', 'name');
        Filter::checkPost('email', 'email');
        Filter::checkPost('Enquiry', 'Enquiry');
        Filter::checkPost('contact_m', 'contact_m');

        $json['type'] = 'OK';
        $json['title'] = 'Success';
        $json['message'] = 'the User have successfully registered.';

        return json_encode($json);
    }
/**
 * List::addpayment().
 *
 * @return
 */
public function addpayment()
{
    Filter::checkPost('Company', 'Select the Company');
    Filter::checkPost('beneficiaryname', 'Beneficiary\'s name');
    Filter::checkPost('regno', 'Beneficiary\'s Registeration number');
    Filter::checkPost('gstno', 'Beneficiary\'s GST Number');
    Filter::checkPost('bankname', 'Beneficiary\'s Bank Name');
    Filter::checkPost('bankaddress', 'Beneficiary\'s Bank Address');
    Filter::checkPost('bemail', 'Beneficiary\'s Email Address');
    Filter::checkPost('accno', 'Beneficiary\'s Account Number');

    if (isset($_POST['otherprojectdetail'])) {
        $po = strtolower(sanitize($_POST['otherprojectdetail']));
    } else {
        $po = '';
    }

    $projectArray = array();
    foreach ($_REQUEST['Project'] as $test) {
        $pro = 'project'.$test;
        $projectArray[$test] = $_REQUEST[$pro];
    }

    $pserial = serialize($projectArray);
    $indateserial = serialize($_POST['InvoiceDate']);
    $inserial = serialize($_POST['InvoiceNo']);
    $purserial = serialize($_POST['Purpose']);
    $amserial = serialize($_POST['Amount']);

    $beneficiaryname = strtolower(sanitize($_POST['beneficiaryname']));
    $regno = strtolower(sanitize($_POST['regno']));
    $gstno = strtolower(sanitize($_POST['gstno']));
    $bankname = strtolower(sanitize($_POST['bankname']));
    $bankaddress = strtolower(sanitize($_POST['bankaddress']));
    $accno = strtolower(sanitize($_POST['accno']));
    $bemail = strtolower(sanitize($_POST['bemail']));

    $checkB = self::getBeneficiaryList();
    $Beneficiary = null;
    $Beneficiaryfind = 0;
    foreach ($checkB as $struct) {
        if ($beneficiaryname == strtolower($struct->name)) {
            $Beneficiary = $struct->id;
            $Beneficiaryfind = 1;
            break;
        }
    }

//remark
$remarkcheck = strtolower(sanitize($_POST['Remark']));
    if ($remarkcheck == '' || empty($remarkcheck)) {
        $remark = 'none';
    } else {
        $remark = $remarkcheck;
    }

    if (empty(Filter::$msgs)) {
        if ($Beneficiaryfind == 0) {
            $datab = array(
'name' => $beneficiaryname,
'regno' => $regno,
'gstno' => $gstno,
'accno' => $accno,
'bankname' => $bankname,
'bankaddress' => $bankaddress,
'email' => $bemail,
'sorting' => 0,
'created' => 'NOW()',
'updated' => 'NOW()',
);
            self::$db->insert(self::bTable, $datab);
            $Beneficiary = self::$db->insertid();
        }
        $prday = countEntries(self::pTable, 'AppliedDate', date('Y-m-d')) + 1;

        $data = array(
'prday' => $prday,
'Company' => strtolower(sanitize($_POST['Company'])),
'PaymentMode' => strtolower(sanitize($_POST['PaymentMode'])),
'Beneficiary' => $Beneficiary,
'Project' => $pserial,
'ProjectOther' => $po,
'Invoicedate' => $indateserial,
'InvoiceNo' => $inserial,
'CertNo' => strtolower(sanitize($_POST['CertNo'])),
'Purpose' => $purserial,
'Amount' => $amserial,
'Remark' => $remark,
'userid' => strtolower(sanitize($_POST['userid'])),
'AppliedDate' => strtolower(sanitize($_POST['AppliedDate'])),
'created' => 'NOW()',
'updated' => 'NOW()',
);

        self::$db->insert(self::pTable, $data);

        $prdetail = self::getPRid(self::$db->insertid());

        $userdetail = Users::getUserbyID($prdetail->userid);

        $beneficiary = self::getBeneficiaryListbyID($prdetail->Beneficiary);

        $companyname = self::getCompanynamebyid2($prdetail->Company);

// echo "<pre>";
// print_r($prdetail);
// echo "</pre>";

$prdayid = pridret($prdetail->AppliedDate, $prdetail->prday, 'PR', 3);

        $mail = $userdetail->email;
        $bname = $beneficiary[0]->name;

        $fullname = $userdetail->fullname;

        $mailto = "Dear $fullname,\n
Your payment requisition for $bname from $companyname is submitted.
\nYou may keep track of the status of your payment requisition by login to Payment Requisition Portal.
\nPayment Requisition No. : $prdayid
\n\n\n
Regards,
\n
Titijaya
";
        $from = "From: Titijaya Payment Requisition Portal<pr@titijaya.com.my>\r\nReturn-path: pr@titijaya.com.my";
        $subject = "$prdayid : Payment Requisition Submitted";
//mail("admin@ourtech.my", $subject, $to, $from);
$mailstat = mail($mail, $subject, $mailto, $from);

        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Your Payment Requisition have successfully submited \nReference number : '.$prdayid;

            return json_encode($json);
        } else {
            $json['type'] = 'error';
            $json['title'] = 'Error';
            $json['message'] = 'There was an error during Adding process. Please contact the administrator...';

            return json_encode($json);
        }
    } else {
        $a = Filter::$msgs;
        $b = 'Please Complete the following field:<br>';
        foreach ($a as $key => $value) {
            $b .= $value.'<br>';
        }

        $json['type'] = 'error';
        $json['title'] = 'Please complete the following fields:';
        $json['message'] = $b;

        return json_encode($json);
    }
}

    public function lol()
    {
        if ($status == 4) {
            $datapayment = self::getPRid($value);
            $user = $datapayment->userid;
            $data = Users::getUserbyID($user);
            $email[] = $data->email;
        }

        $mail = array_unique($email);
        foreach ($mail as $useremail) {
            $statusecho = self::getstatusid($status);
            $userdata = Users::getUserbyemail($useremail);

            $detail = self::getPRuser($userdata->id);

            $pridd = array();
            foreach ($detail as $key) {
                $pridd[] = pr2(8, $key->id, 'PR');
            }

            $lala2 = '';
            foreach ($pridd as $key) {
                $lala2 .= $key.'  '.$statusecho."\n";
            }

            $to = 'Your Payment Requisition '.$pridd[0]." status updated to below:\n".$lala2;

            $fromemail = $_SESSION['email'];
            $from = "From: Titijaya Payment Requisition Portal<$fromemail>\r\nReturn-path: $fromemail";
            $subject = 'PR #'.$pridd[0].' Status Update';
//mail("admin@ourtech.my", $subject, $to, $from);
mail($useremail, $subject, $to, $from);
        }
    }

    public function changeStatusnew($id, $value)
    {
        $data = array(
'Status' => $value,
'updated' => 'NOW()',
);

        self::$db->update(self::pTable, $data, 'id='.$id);

        if ($value == 6) {
            $datapayment = self::getPRid($id);
            $bf = self::getBeneficiaryListbyID($datapayment->Beneficiary);
            $to = $bf[0]->email;
            $cp = $bf[0]->contactperson;

            $message = "Dear $cp,<br>Your payment for invoice(s) below are ready,<br><br>";

            $message .= '
<table border=1 cellspacing=0 cellpadding=5>
<tr>
<td>Invoice Date</td>
<td>Invoice Number</td>
<td>Amount</td>
</tr>
';

            $uninvoicedate = unserialize($datapayment->Invoicedate);
            $uninvoice = unserialize($datapayment->InvoiceNo);
            $unpurpose = unserialize($datapayment->Purpose);
            $unamount = unserialize($datapayment->Amount);
            $i = 0;
            foreach ($uninvoicedate as $key => $value) {
                if ($value == '' || empty($value)) {
                    break;
                }
                ++$i;
            }
            $totalamount = 0;
            for ($j = 0; $j < $i; ++$j) {
                $totalamount += $unamount[$j];
                $message .= '<tr>';

                $message .= '<td>'.$uninvoicedate[$j].'</td>';
                $message .= '<td>'.$uninvoice[$j].'</td>';
                $message .= '<td>'.$unamount[$j].'</td>';

                $message .= '</tr>';
            }

            $message .= '<tr><td colspan="2">Total Amount</td><td>'.$totalamount.'</td></tr>';

            $message .= '</table><br>Regards,<br> Titijaya Berhad';
            $from = 'pr@titijaya.com.my';
            $headers = "From: $from\r\n";
            $headers .= "Content-type: text/html\r\n";
            $subject = 'Payment Ready';
            mail($to, $subject, $message, $headers);
        }
    }

    public function changeStatus()
    {
        $pr = $_POST['pr'];
        $status = $_POST['Status'];
        $email = array();
        foreach ($pr as $key => $value) {
            $data = array(
'Status' => sanitize($status),
'id' => sanitize($value),
'updated' => 'NOW()',
);

            self::$db->update(self::pTable, $data, 'id='.$value);

            if ($status == 6) {
                $datapayment = self::getPRid($value);

//$bmail=self::getBeneficiaryListbyID($datapayment->Beneficiary)[0]->email;
$bf = self::getBeneficiaryListbyID($datapayment->Beneficiary);

                $to = $bf[0]->email;

                $message = '



Dear Person in Charge,<br>Your payment for invoice(s) below are ready,<br><br>';

                $message .= '
<table border=1 cellspacing=0 cellpadding=5>
<tr>
<td>Invoice Date</td>
<td>Invoice Number</td>
<td>Amount</td>
</tr>
';

                $uninvoicedate = unserialize($datapayment->Invoicedate);
                $uninvoice = unserialize($datapayment->InvoiceNo);
                $unpurpose = unserialize($datapayment->Purpose);
                $unamount = unserialize($datapayment->Amount);
                $i = 0;
                foreach ($uninvoicedate as $key => $value) {
                    if ($value == '' || empty($value)) {
                        break;
                    }
                    ++$i;
                }
                $totalamount = 0;
                for ($j = 0; $j < $i; ++$j) {
                    $totalamount += $unamount[$j];
                    $message .= '<tr>';

                    $message .= '<td>'.$uninvoicedate[$j].'</td>';
                    $message .= '<td>'.$uninvoice[$j].'</td>';
                    $message .= '<td>'.$unamount[$j].'</td>';

                    $message .= '</tr>';
                }

                $message .= '<tr><td colspan="2">Total Amount</td><td>'.$totalamount.'</td></tr>';

                $message .= '</table><br>Regards,<br> Titijaya Berhad';
                $from = 'pr@titijaya.com.my';
                $headers = "From: $from\r\n";
                $headers .= "Content-type: text/html\r\n";
                $subject = 'Payment Ready';
                mail($to, $subject, $message, $headers);
            }
        }
    }



    public function editprojecttoParent($pd)
    {
        $data = array(
            'first' => '0',
            'updated' => 'now()',
            );
        self::$db->update(self::prTable, $data, 'id='.$pd['pid']);

        if (self::$db->affected()) {
            $json['type'] = 'success';
            $json['title'] = 'Success';
            $json['message'] = 'Successfully Edit the Project.';

            return json_encode($json);
        } else {
            $a = array('error' => 'Error Updating Data');

            return json_encode($a);
        }
    }
    public function editProject($pd)
    {
        $error = '';
        if (strlen($pd['name']) <= 0) {
            $error .= "Please enter Project name\n";
        }

        if (strlen($pd['login']) <= 0) {
            $error .= "Please enter Project Login\n";
        }

        if (strlen($pd['passcode']) <= 0) {
            $error .= "Please enter Project Passcode\n";
        }

        if (strlen($pd['min']) <= 0) {
            $error .= "Please enter minimum Price\n";
        }

        if (strlen($pd['max']) <= 0) {
            $error .= "Please enter maximum Price\n";
        }

        if (strlen($pd['state']) <= 2) {
            $error .= "Please enter Project Location State\n";
        }

        if (strlen($pd['areaselected']) <= 2) {
            $error .= "Please enter Project Location Area \n";
        }

        if (strlen($pd['pt']) <= 0) {
            $error .= "Please enter Project type\n";
        }

        if ($error == '') {
            $tt = json_encode(explode(',', $pd['pt']));
            $tt = preg_replace('(")', '', $tt);
            $tt = preg_replace("(')", '', $tt);

            $data = array(
'id' => sanitize($pd['pid']),
'name' => sanitize($pd['name']),
'login' => sanitize($pd['login']),
'passcode' => sanitize($pd['passcode']),
'pricemin' => sanitize($pd['min']),
'pricemax' => sanitize($pd['max']),
'state' => sanitize($pd['state']),
'updated' => 'now()',
'location' => sanitize($pd['areaselected']),
'type' => $tt,
);

            self::$db->update(self::prTable, $data, 'id='.$data['id']);

            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Edit the Project.';

                return json_encode($json);
            } else {
                $a = array('error' => 'Error Updating Data');

                return json_encode($a);
            }
        } else {
            $a = array('error' => $error);

            return json_encode($a);
        }
    }




    public function editSource($pd)
    {
        $error = '';
        if (strlen($pd['name']) <= 0) {
            $error .= "Please enter Project name\n";
        }
        if ($error == '') {
            $data = array(
'id' => sanitize($pd['pid']),
'name' => sanitize($pd['name']),
);
            self::$db->update(self::sorTable, $data, 'id='.$data['id']);
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Edit the Project.';

                return json_encode($json);
            } else {
                $a = array('error' => 'Error Updating Data');
                return json_encode($a);
            }
        } else {
            $a = array('error' => $error);

            return json_encode($a);
        }
    }




    public function ExportCus($pd)
    {
        if (isset($pd['status'])) {
            $ws="";
            $ws2="";
            if (!empty($pd['status'])) {
                $pieces = explode(",", $pd['status']);
                foreach ($pieces as $key => $value) {
                    $pieces[$key]="'$value'";
                }
                $comma_separated = implode(",", $pieces);
                $ws=" AND purchase_status IN (".$comma_separated.") ";
            } else {
                $ws="";
            }
        }

        if (isset($pd['project'])) {
            $ws2="";
            if (!empty($pd['project'])) {
                $pieces = explode(",", $pd['project']);
                $search_id = array();
                foreach ($pieces as $key => $value) {
                    $search_id[] = $value;
                    $sql = "SELECT * FROM ".self::prTable." WHERE parent = '$value' AND active='1' ";
                    $row = self::$db->fetch_all($sql);
                    foreach ($row as $key2 => $row2) {
                        $search_id[] = $row2->id;
                    }
                }
                foreach ($search_id as $key => $value) {
                    $search_id[$key]="'$value'";
                }
                $comma_separated = implode(",", $search_id);
                $ws2=" AND c.project_id IN (".$comma_separated.") ";
            } else {
                $ws2="";
            }
        }

        $sql = 'SELECT a.*,b.*,c.* FROM '.self::cusTable." a left join ".self::cuspurTable." b on a.icpassport=b.cus_ic left join ".self::purTable." c on b.purchase_id=c.id WHERE true $ws $ws2 group by c.unit_id,c.purchase_status order by a.created desc";
        $row = self::$db->fetch_all($sql);


        $objPHPExcel = new \PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                             ->setLastModifiedBy("Maarten Balliauw")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Test result file");
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Mobile Number')
            ->setCellValue('C1', 'Email Address');
        $a=2;
        foreach ($row as $key => $value) {
            $aa=$value->contact_m;
            $aa=str_replace("+", "", $aa);
            $aa=str_replace("-", "", $aa);
            $aa=str_replace(" ", "", $aa);
            if (substr($aa, 0, 1)==6) {
                $aa=substr($aa, 1);
            }
            if (substr($aa, 0, 2)=='00') {
                $aa=substr($aa, 1);
            }
            $aa="6".$aa;

            $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A'.$a, ucwords(strtolower($value->name)))
              ->setCellValue('B'.$a, $aa)
              ->setCellValue('C'.$a, strtolower($value->email));
            $a+=1;
        }
        $objPHPExcel->getActiveSheet()->setTitle('Customer CRM');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="CRMEXPORT.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        die;
    }

    public function repairPhone()
    {
        $sql = 'SELECT * FROM '.self::lTable."";
        $row = self::$db->fetch_all($sql);
        foreach ($row as $key => $value) {
            $ab=$value->name;
            $ab=ucwords(strtolower($ab));
            $aa=$value->contact_m;
            $aa=str_replace("+", "", $aa);
            $aa=str_replace("-", "", $aa);
            $aa=str_replace(" ", "", $aa);
            if (substr($aa, 0, 1)==6) {
                $aa=substr($aa, 1);
            }
            if (substr($aa, 0, 2)=='00') {
                $aa=substr($aa, 1);
            }
            $aa="6".$aa;

            $data = array(
        'name'=>$ab,
'contact_m' => $aa,
);
     //pre($data);
      self::$db->update(self::lTable, $data, 'id='.$value->id);
        }
    }


    public function editSubProject($pd)
    {
        $error = '';
        if (strlen($pd['pt']) <= 0) {
            $error .= "Please enter Project type\n";
        }
        if ($error == '') {
            $project_id=sanitize($pd['pid']);

            $existproject=$this->getProjectParentID($project_id);
            $frompage = (explode(',', $pd['pt']));
            $delete=array_diff($existproject, $frompage);
            $insert=array_diff($frompage, $existproject);
            $errorinsert=0;
            if (!empty($insert)) {
                foreach ($insert as $key => $value) {
                    $data = array(
              'parent' => $project_id,
              'updated' => 'now()',
              );
                    self::$db->update(self::prTable, $data, 'id='.$value);
                    if (!self::$db->affected()) {
                        $errorinsert=1;
                    }
                }
            }
            $errordelete=0;
            if (!empty($delete)) {
                foreach ($delete as $key => $value) {
                    $data = array(
                'parent' => '0',
                'updated' => 'now()',
                );
                    self::$db->update(self::prTable, $data, 'id='.$value);
                    if (!self::$db->affected()) {
                        $errordelete=1;
                    }
                }
            }
            if ($errorinsert!=1&&$errordelete!=1) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'Successfully Edit the PR infomation.';
                return json_encode($json);
            } else {
                $a = array('type' => 'error', 'error' => 'Error Updating Data');
                return json_encode($a);
            }
        }
    }



    public function Editpayment()
    {
        if (!Filter::$id) {
            Filter::checkPost('Company', 'Select Company');
            Filter::checkPost('PaymentMode', 'Select Payment Mode');
            Filter::checkPost('Beneficiary', 'Select Beneficiary');
            Filter::checkPost('Project', 'Enter Project name');
            Filter::checkPost('InvoiceNo', 'Enter InvoiceNo ');
            Filter::checkPost('CertNo', 'Enter CertNo ');
            Filter::checkPost('Purpose', 'Enter Purpose');
            Filter::checkPost('Amount', 'Enter Amount');
            Filter::checkPost('Remark', 'Enter Remark');
        }

        if (isset($_POST['ProjectOther'])) {
            $po = strtolower(sanitize($_POST['ProjectOther']));
        } else {
            $po = '';
        }

        $projectArray = array();
        foreach ($_REQUEST['Project'] as $test) {
            $pro = 'project'.$test;
            $projectArray[$test] = $_REQUEST[$pro];
        }

        $pserial = serialize($projectArray);
        $indateserial = serialize($_POST['InvoiceDate']);
        $inserial = serialize($_POST['InvoiceNo']);
        $purserial = serialize($_POST['Purpose']);
        $amserial = serialize($_POST['Amount']);

// printr($_REQUEST);
if (empty(Filter::$msgs)) {
    $data = array(
'Company' => sanitize($_POST['Company']),
'PaymentMode' => sanitize($_POST['PaymentMode']),
'Beneficiary' => sanitize($_POST['Beneficiary']),
'Project' => $pserial,
'ProjectOther' => $po,
'Invoicedate' => $indateserial,
'InvoiceNo' => $inserial,

'Purpose' => $purserial,
'Amount' => $amserial,

'CertNo' => sanitize($_POST['CertNo']),

'Remark' => sanitize($_POST['Remark']),
);

    (Filter::$id) ? self::$db->update(self::pTable, $data, 'id='.Filter::$id) : $last_id = self::$db->insert(self::pTable, $data);

    if (self::$db->affected()) {
        $json['type'] = 'success';
        $json['title'] = 'Success';
        $json['message'] = 'Successfully Edit the PR infomation.';

        return json_encode($json);
    }
}
    }

    public function deleteList($table, $id)
    {
        $data = array('active' => 0);

        switch ($table) {
case 'beneficiary':
$res = self::$db->update(self::bTable, $data, 'id='.$id);
break;

case 'company':
$res = self::$db->update(self::cTable, $data, 'id='.$id);
break;

case 'paymentstatus':
$res = self::$db->update(self::sTable, $data, 'id='.$id);
break;

case 'paymenttype':
$res = self::$db->update(self::ptTable, $data, 'id='.$id);
break;

case 'project':
$res = self::$db->update(self::prTable, $data, 'id='.$id);
break;

}

        $title = 'Deleted';
        if ($res) :
return "Successfully Deleted the $table"; else :
return "Failed to Deleted the $table";
        endif;
    }

    public function AddList()
    {
        $type = $_POST['type'];

        switch ($type) {
case 'beneficiary':
Filter::checkPost('name', "Enter $type name");
Filter::checkPost('regno', 'Enter regno');

Filter::checkPost('cperson', 'Enter cperson');
Filter::checkPost('cnumber', 'Enter cnumber');
Filter::checkPost('gstno', 'Enter gstno');
Filter::checkPost('accno', 'Enter accno');
Filter::checkPost('bankname', 'Enter bankname');
Filter::checkPost('bankaddress', 'Enter bankaddress');
Filter::checkPost('email', 'Enter Email Address');
break;

case 'company':
Filter::checkPost('name', "Enter $type name");
Filter::checkPost('nickname', "Enter $type nickname");

Filter::checkPost('regno', 'Enter regno');
Filter::checkPost('gstno', 'Enter gstno');
break;

case 'paymentstatus':
Filter::checkPost('name', "Enter $type name");
Filter::checkPost('style', 'Enter Style');
break;

case 'paymenttype':
Filter::checkPost('name', "Enter $type name");

break;

case 'project':
Filter::checkPost('name', "Enter $type name");

break;

}

        if (empty(Filter::$msgs)) {
            switch ($type) {
case 'beneficiary':

$data = array(
'name' => sanitize($_POST['name']),
'contactperson' => sanitize($_POST['cperson']),
'contactnumber' => sanitize($_POST['cnumber']),

'regno' => sanitize($_POST['regno']),
'gstno' => sanitize($_POST['gstno']),
'accno' => sanitize($_POST['accno']),
'bankname' => sanitize($_POST['bankname']),
'bankaddress' => sanitize($_POST['bankaddress']),
'email' => sanitize($_POST['email']),
);
break;

case 'company':

$projectobject = json_decode(stripslashes($_REQUEST['project']));
$project = $projectobject->Projectnew;
$pserial = serialize($project);

$data = array(
'name' => sanitize($_POST['name']),
'nickname' => sanitize($_POST['nickname']),
'regno' => sanitize($_POST['regno']),
'gstno' => sanitize($_POST['gstno']),
'handle' => $pserial,
);
break;

case 'paymentstatus':

$data = array(
'name' => sanitize($_POST['name']),
'style' => sanitize($_POST['style']),
'icon' => sanitize($_POST['icon']),
);
break;

case 'paymenttype':

$data = array(
'name' => sanitize($_POST['name']),
);
break;

case 'project':

$data = array(
'name' => sanitize($_POST['name']),
);
break;

}

            switch ($type) {
case 'beneficiary':
self::$db->insert(self::bTable, $data);
break;

case 'company':
self::$db->insert(self::cTable, $data);
break;

case 'paymentstatus':
self::$db->insert(self::sTable, $data);
break;

case 'paymenttype':
self::$db->insert(self::ptTable, $data);
break;

case 'project':
self::$db->insert(self::prTable, $data);
break;

}
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'The '.$type.' have successfully Added.';
                echo $jsonPretty->prettify($json);
            }
        }
    }

    public function EditList()
    {
        $type = $_POST['type'];

        if (!Filter::$id) {
            switch ($type) {
case 'beneficiary':
Filter::checkPost('name', "Enter $type name");

Filter::checkPost('cperson', 'Enter Contact Person Name');
Filter::checkPost('cnumber', 'Enter Contact Person Number');

Filter::checkPost('regno', 'Enter regno');
Filter::checkPost('gstno', 'Enter gstno');
Filter::checkPost('accno', 'Enter accno');
Filter::checkPost('bankname', 'Enter bankname');
Filter::checkPost('bankaddress', 'Enter bankaddress');
Filter::checkPost('email', 'Enter Email Address');
break;

}
        }

        if (empty(Filter::$msgs)) {
            switch ($type) {

case 'beneficiary':
$data = array(
'name' => sanitize($_POST['name']),

'contactperson' => sanitize($_POST['cperson']),
'contactnumber' => sanitize($_POST['cnumber']),

'regno' => sanitize($_POST['regno']),
'gstno' => sanitize($_POST['gstno']),
'accno' => sanitize($_POST['accno']),
'bankname' => sanitize($_POST['bankname']),
'bankaddress' => sanitize($_POST['bankaddress']),
'email' => sanitize($_POST['email']),
);
break;

case 'company':

$projectobject = json_decode(stripslashes($_REQUEST['project']));
$project = $projectobject->Projectnew;
$pserial = serialize($project);

$data = array(
'name' => sanitize($_POST['name']),
'nickname' => sanitize($_POST['nickname']),
'regno' => sanitize($_POST['regno']),
'gstno' => sanitize($_POST['gstno']),
'handle' => $pserial,
);
break;

case 'paymentstatus':

$data = array(
'name' => sanitize($_POST['name']),
'style' => sanitize($_POST['style']),
'icon' => sanitize($_POST['icon']),

);
break;

case 'paymenttype':

$data = array(
'name' => sanitize($_POST['name']),

);

case 'project':

$data = array(
'name' => sanitize($_POST['name']),

);
break;

}

            switch ($type) {
case 'beneficiary':
(Filter::$id) ? self::$db->update(self::bTable, $data, 'id='.Filter::$id) : $last_id = self::$db->insert(self::pTable, $data);
break;
case 'company':
(Filter::$id) ? self::$db->update(self::cTable, $data, 'id='.Filter::$id) : $last_id = self::$db->insert(self::pTable, $data);
break;
case 'paymentstatus':
(Filter::$id) ? self::$db->update(self::sTable, $data, 'id='.Filter::$id) : $last_id = self::$db->insert(self::pTable, $data);
break;

case 'paymenttype':
(Filter::$id) ? self::$db->update(self::ptTable, $data, 'id='.Filter::$id) : $last_id = self::$db->insert(self::pTable, $data);
break;

case 'project':
(Filter::$id) ? self::$db->update(self::prTable, $data, 'id='.Filter::$id) : $last_id = self::$db->insert(self::pTable, $data);
break;

}
            if (self::$db->affected()) {
                $json['type'] = 'success';
                $json['title'] = 'Success';
                $json['message'] = 'The '.$type.' have successfully Edited.';
                echo $jsonPretty->prettify($json);
            }
        }
    }
}
