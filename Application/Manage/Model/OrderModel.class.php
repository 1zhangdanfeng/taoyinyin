<?php
namespace Manage\Model;
use Think\Model;
class OrderModel extends Model {
	function __contruct()
	{
		Model::__contruct();
	}

	function getShops($ids)
	{
		$where = array();
		$where['sid'] = array('IN', $ids);
		return M('shop')->where($where)->getField('sid,shopname');
	}

	function getOrder($id)
	{
		return M('order')->find($id);
	}

	function getSchools($id)
	{
		return M('school')->getField('scid,name');
	}

	function orderPages($oid)
	{
		$oid = intval($oid);

	    $s = M()->cache(true)->table('__ORDER_ATTACH__ oa,__ATTACHMENT__ att')
	    ->field('sum(pages * file_num) as pnum')
	    ->WHERE("oa.tid = att.tid AND oa.oid='{$oid}'")->find();

	    return $s['pnum'];
	}

	function status($from, $to)
	{
		$map = array();
		$map['time'] = array('BETWEEN', "{$from},{$to}");
		$status = M('order')->where($map)->select();
		$ret = array();
		$ret['count'] = count($status);
		$ret['s0'] = $ret['s1'] = $ret['s2'] = $ret['s3'] = 0;
		$ret['pages'] = array();
		$shop = M('shop')->getField('sid,shopname');
		foreach ($status as $key => $row) {
		    $ret["s{$row['status']}"]++;
		    if ($row['status'] == 2) {
		    	if ($row['order_sid'] <= 0) {
		    		continue;
		    	}
		    	if (!empty($ret['pages'][$row['order_sid']])) {
		    		$ret['pages'][$row['order_sid']]['page'] += $this->orderPages($row['rid']);
		    	}else{
		    		$ret['pages'][$row['order_sid']] = array(
		    			'name' => $shop[$row['order_sid']], 
		    			'page' => (int)$this->orderPages($row['rid'])
		    		);
		    	}
		    }
		}
		//dump($ret);exit;
		return $ret;
	}
}