<?php
namespace Shop\Model;
use Think\Model;
class OrderModel extends Model{
  protected $_validate=array(
  );
  
  function getOrder($val, $field = 'rid', $uid = false)
  {
  	$map = array();
  	$map[$field] = $val;
  	if ($uid) {
  		$map['order_uid'] = $uid;	
  	}
  	return M('order')->where($map)->find();
  }

  function orderPages($oid)
  {
    $oid = intval($oid);

    $s = M()->table('__ORDER_ATTACH__ oa,__ATTACHMENT__ att')
    ->field('sum(pages * file_num) as pnum')
    ->WHERE("oa.tid = att.tid AND oa.oid='{$oid}'")->find();

    return $s['pnum'];
  }

  function status($from, $to)
  {
    $sid = session('shop.sid');

    $map = array();
    $map['time'] = array('BETWEEN', "{$from},{$to}");
    $map['order_sid'] = $sid;
    $status = M('order')->where($map)->select();
    $ret = array();
    $ret['count'] = count($status);
    $ret['s0'] = $ret['s1'] = $ret['s2'] = $ret['s3'] = 0;
    $ret['pages'] = 0;
    foreach ($status as $key => $row) {
        $ret["s{$row['status']}"]++;
        if ($row['status'] == 2) {
          $ret['pages'] += ($this->orderPages($row['rid']));
        }
    }


    return $ret;
  }
  
	
}