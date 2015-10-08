<?php
namespace Home\Controller;
use Home\Controller;
class InfoController extends UserController {
	function __construct()
	{
		UserController::__construct();
	}

	public function cancel()
	{
		$id = I('get.id', '', 'int');
		$map = array();
		$map['rid'] = $id;
		$map['status'] = array('IN', '0');
		$od = M('order')->where($map)->find();
		if ($od) {
			M('order')->where($map)->delete();
			redirect(U('/home/info/order'));
		}else{
			$this->error('不能取消已经付款的订单~');
		}
	}

	public function index()
	{
		$u = M('user')->find($this->user['uid']);
		if (IS_POST) {
			$u['truename'] = I('post.truename');
			$u['email'] = I('post.email', '', 'email');
			if (I('post.upass')) {
				$u['passwd'] = md5(I('post.upass'));
			}
			$u['grade'] = I('post.grade', '', 'int');
			$u['major'] = I('post.major');
			$u['sex'] = I('post.sex') == 'f' ? 'f' : 'm'; 
			$u['intro'] = I('post.intro');
			M('user')->save($u);
		}
		$this->assign('major', C('SCHOOL_MAJOR'));
		$this->assign('uinfo', $u);
		$this->display('user/info');
	}

	public function billing()
	{
		$p = I('get.p', 1, 'int');
		$info = M('user')->find($this->user['uid']);
		$qm = M('point_history')->where(array(
			'uid' => $this->user['uid']
		))->order('time desc')->page($p.',5');

		$history = $qm->select();
		$sum = $qm->where(array(
			'uid' => $this->user['uid'],
			'number' => array('LT', 0)
		))->sum('number');

		$this->assign('invite', U('/home/sign/invite', "code={$this->user['invite']}", true, true));
		$this->assign('page', $p);
		$this->assign('sum', abs($sum));
		$this->assign('info', $info);
		$this->assign('history', $history);
		$this->display('user/billing');
	}

	public function order()
	{
		$p = I('get.p', 1, 'int');
		$mod = M('order')->where(array(
			'order_uid' => $this->user['uid']
		))->order('time desc');
		$order = $mod->page($p.',8')->select();
		$count      = $mod->where(array(
			'order_uid' => $this->user['uid']
		))->count();

		$Page = new \Think\Page($count, 8);
		$pagenav = $Page->show();

		$this->assign('order', $order);
		$this->assign('page', $pagenav);
		$this->display('user/order');
	}

	public function detail()
	{
		$id = I('get.id', '', 'int');
		$ord = M('order')->where(array(
			'rid' => $id,
			'order_uid' => $this->user['uid']
		))->find();
		$ord['attach'] = M('order_attach')->where(array(
			'oid' => $ord['rid'],
		))->join('__ATTACHMENT__ ON __ATTACHMENT__.tid = __ORDER_ATTACH__.tid')
		->select();
		foreach ($ord['attach'] as $key => $value) {
			unset($ord['attach'][$key]['loc']);
			unset($ord['attach'][$key]['advfile']);
		}
		$ord['time'] = totime($ord['time']);
		if ($ord['order_sid'] != 0) {
			$shop = M('shop')->where(array('sid' => $ord['order_sid']))->getField('shopname');
		}else{
			$shop = '尚未选择打印店';
		}
		$ord['shopname'] = $shop;
		$this->ajaxReturn($ord);
	}

}