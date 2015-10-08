<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
  protected $_validate=array(
  );	

  function schoolName($id)
  {
    $map = array(
      'scid' => $id
    );
    return M('school')->where($map)->getField('name');
  }
  
  function isexists($uname)
  {
    $map = array();
    $map['uname'] = $uname;
    return M('user')->where($map)->count() > 0;
  }
	
  function getUser($val, $field = 'uid')
  {
    $map = array();
    $map[$field] = $val;
    return M('user')->where($map)->find();
  }

  function editPoint($uid, $point)
  {
    $map = array();
    $map['uid'] = $uid;
    $func = $point > 0 ? 'setInc' : 'setDec';
    M('user')->where($map)->$func('point', abs($point));
  }

  function login($uname, $upass)
  {
    $row = $this->getUser($uname, 'uname');
    if ($row['passwd'] == md5($upass)) {
      return $row;
    }else{
      return false;
    }
  }

  function history($uid, $content, $num)
  {
    $data = array(
      'uid' => $uid,
      'time' => time(),
      'content' => $content,
      'number' => intval($num)
    );
    M('point_history')->data($data)->add();
  }

  function getInviteUser($code)
  {
    $u = array(
      'invite' => $code
    );
    return M('user')->where($u)->getField('uid');
  }

  function edit($data)
  {
    M('user')->save($data);
  }
	
}





?>