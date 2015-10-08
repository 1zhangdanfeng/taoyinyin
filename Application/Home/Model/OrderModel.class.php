<?php
namespace Home\Model;
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
  
	
}





?>