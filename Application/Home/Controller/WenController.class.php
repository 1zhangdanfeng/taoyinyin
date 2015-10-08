<?php
namespace Home\Controller;
use Home\Controller;
class WenController extends UserController {
	function __construct()
	{
		UserController::__construct();
	}

	public function search()
	{
		$map = array();
		$s = I('get.word');
		$p = I('get.p', 1, 'int');
		$school = I('get.school');
		$map['school'] = M('school')->where(array('name' => $school))->getField('scid');
		if (empty($map['school']) || empty($school)) {
			unset($map['school']);
		}
		$map['name'] = array('LIKE', "%{$s}%");
		$map['share'] = 1;
		$mod = M('attachment')->where($map)->order('time desc');
		$att = $mod->page($p.',30')->select();
		$count      = $mod->count();

		$Page = new \Think\Page($count,30);
		$pagenav = $Page->show();

		$this->assign('count', count($att));
		$this->assign('pagenav', $pagenav);
		$this->assign('att', $att);
		$this->display('wen/search');
	}

	public function index()
	{
		$this->display('wen/wen');
	}

	public function share()
	{
		$id = I('post.id', '', 'int');
		$info = array('suc' => 0);
		if (D('attachment')->isshare($id)) {
			$this->ajaxReturn($info);
		}
		$info['suc'] = D('attachment')->share($id, $this->user['uid']);
		$this->ajaxReturn($info);
	}

	public function mywen()
	{
		$p = I('get.p', 1, 'int');
		$attach = M('attachment')->where(array(
			'uid' => $this->user['uid'],
			'isshow' => 1
		))->order('time desc')->page($p.',10')->select();

		$count = M('attachment')->where(array(
			'uid' => $this->user['uid'],
			'isshow' => 1
		))->count();

		$Page = new \Think\Page($count, 10);
		$pagenav = $Page->show();

		$this->assign('pagenav', $pagenav);
		$this->assign('attachment', $attach);
		$this->display('user/mywen');
	}

	public function del()
	{
		$id = I('post.id', '', 'int');
		M('attachment')->where(array(
			'uid' => $this->user['uid'],
			'tid' => $id
		))->save(array(
			'isshow' => 0
		));
		exit('1');
	}

}

?>