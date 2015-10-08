<?php
namespace Home\Model;
use Think\Model;
class WenModel extends Model{
  protected $_validate=array(
  );

  function share($tid, $uid)
  {
  	$where = array();
  	$map = array();
  	$where['tid'] = $tid;
  	$where['uid'] = $uid;
  	$map['share'] = 1;
  	$map['uniqid'] = $this->__uniqid();
  	return M('attachment')->where($where)->save($map);
  }

  function isshare($id)
  {
  	$map = array();
  	$map['tid'] = $id;
  	$map['share'] = 1;
  	return M('attachment')->where($map)->count() > 0;
  }

  private function __uniqid()
  {
  	do{
		$rand = randStr();
		$count = M('attachment')->where(array('uniqid' => $rand))->count();
	}while($count > 0);
	return $rand;
  }

}