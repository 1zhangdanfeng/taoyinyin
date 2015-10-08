<?php
namespace Manage\Model;
use Think\Model;
class UserModel extends Model {
	function __contruct()
	{
		Model::__contruct();
	}

	function getCount()
	{
		return M('user')->count();
	}

	function status($from, $to)
	{
		$where = array(
			'regtime' => array('BETWEEN', "{$from},{$to}")
		);
		$user = M('user')->field('school,count(school) as cnt')->where($where)->group('school')->select();
		$school = M('school')->getField('scid, name');
		$map = array();
		$map['school'] = array();
		$map['count'] = 0;
		foreach($user as $row)
		{
			$map['school'][$school[$row['school']]] = $row['cnt'];
			$map['count'] += $row['cnt'];
		}
		return $map;
	}

}