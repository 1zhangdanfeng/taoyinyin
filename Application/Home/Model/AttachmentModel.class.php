<?php
namespace Home\Model;
use Think\Model;
class AttachmentModel extends Model{
  protected $_validate=array(
  );	
  
  function saveFile($data)
  {
    $id = M('attachment')->data($data)->add();
    return $id;
  }

  function getAttachment($id)
  {
  	return M('attachment')->find($id);
  }

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

  function addMd5($tid, $md5)
  {
  	$map = array();
  	$map['attid'] = $tid;
  	$map['hash'] = $md5;
  	M('fmd5')->data($map)->add();
  }

  function isexists($md5)
  {
  	$map = array(
  		'hash' => $md5
  	);
  	$attid = M('fmd5')->where($map)->getField('attid');
  	return $attid;
  }

  function delete($md5)
  {
    $map = array();
    $map['hash'] = $md5;
    M('fmd5')->where($map)->delete();
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