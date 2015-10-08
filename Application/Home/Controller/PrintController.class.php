<?php
namespace Home\Controller;
use Home\Controller;
class PrintController extends UserController {
	function __construct()
	{
		UserController::__construct();
	}

	public function index()
	{
		$this->display('user/print');
	}

	public function pay()
	{
		$oid = I('post.oid', '', 'int');
		$rcode = I('post.rcode');
		$shopid = I('post.shopid', '', 'int');
		$msg = I('post.message');
		if ($oid > 0 && $rcode && $shopid > 0) {
			$row = M('order')->where(array(
				'rid' => $oid,
				'rcode' => $rcode
			))->find();
			if (empty($row)) {
				$this->error('参数错误，请重试');
			}
			if ($row['status'] > 0) {
				$this->error('你已经付过款啦');
			}
			$row['message'] = $msg;
			$row['order_sid'] = $shopid;
			$row['status'] = 1;

			$u = M('user')->find($this->user['uid']);
			if ($u['point'] - $row['point'] < 0) {
				$this->error('金币不足，不能购买');
			}
			$row['order_mobile'] = $u['uname'];
			$row['recvname'] = $u['truename'];
			M('order')->save($row);
			D('user')->editPoint($this->user['uid'], -$row['point']);
			D('user')->history($this->user['uid'], "打印订单{$row['rcode']}消耗积分", -$row['point']);
			redirect(U('/home/info/order'));
		}else{
			$this->error('参数错误，请重试');
		}
	}

	public function share()
	{
		if (IS_POST) 
		{
			$upfile = I('post.upfile', array(), 'intval');
			foreach ($upfile as  $f) {
				D('attachment')->share($f, $this->user['uid']);
			}
			$this->error('分享成功了', U('/home/wen/mywen'), '分享成功', 200, true);
		}
		$this->error('没有上传肿么分享呢');
	}

	public function submit()
	{
		$oid = I('get.oid', 0, 'int');
		if($oid > 0){
			$row = D('order')->getOrder($oid, 'rid', $this->user['uid']);
			if ($row['status'] != 0) {
				$this->error('这个订单已经付款完成啦');
			}
			$rcode = $row['rcode'];
			$money = $row['order_money'];
			$point = $row['point'];
		}elseif(IS_POST){
			$number = I('post.number', array(), 'intval');
			$upfile = I('post.upfile', array(), 'intval');
			$item = array();
			$money = 0.00;
			$point = 0;
			if (empty($upfile) || empty($number)) {
				$this->error('没有选择要打印的文件');
			}
			foreach ($upfile as $key => $val) {
				if ($val <= 0) {
					continue;
				}
				$where['share']  = array('eq', 1);
				$where['uid']  = array('eq', $this->user['uid']);
				$where['_logic'] = 'or';
				$map['_complex'] = $where;
				$map['tid']  = array('eq', intval($val));
				$row = M('attachment')->where($map)->find();
				$n = intval($number[$key]);
				if ($n <= 0 || empty($row)) {
					continue;
				}
				$point += $this->cache['per_point'] * $row['pages'] * $n;	
				$money += floatval($this->cache['page_money']) * $row['pages'] * $n;
				$item[] = array(
					'tid' => intval($val),
					'file_num' => $n,
					'paper_size' => 'A4',
					'paper_color' => 0,
					'is_double' => 1
				);
			}
			if (empty($item)) {
				$this->error('没有需要打印的文件，请重试');
			}
			$data = array(
				'order_uid' => $this->user['uid'],
				'time' => time(),
				'order_money' => $money,
				'point' => $point
			);
			$oid = M('order')->data($data)->add();
			if ($oid) {
				$rcode = 'Tyy' . date('ymd') . str_pad($oid, 7, '0', STR_PAD_LEFT);
				M('order')->where(array(
					'rid' => $oid
				))->save(array(
					'rcode' => $rcode
				));
			}else{
				$this->error('订单创建失败，请重试');
			}

			foreach ($item as $val) {
				$val['oid'] = $oid;
				M('order_attach')->data($val)->add();
			}
		}else{
			$this->error('参数错误');
		}

		$this->assign('schoolname', D('user')->schoolName($this->user['school']));
		$this->assign('order_id', $oid);
		$this->assign('rcode', $rcode);
		$this->assign('money', $money);
		$this->assign('point', $point);
		$this->display('user/submit');
	}

	public function shop()
	{
		$school = I('get.school');
		$ajax = array();
		if (empty($school)) {
			$school = M('user')->where(array('uid' => $this->user['uid']))
				->join('__SCHOOL__ ON __SCHOOL__.scid = __USER__.school')
				->getField('scid');
			$ajax['items'] = M('shop')
					->where(array('school' => $school))
					->getField('sid,shopname,address,detail,used');
		}else{
			$ajax['items'] = M('school')->where(array('name' => $school))
			->join('__SHOP__ ON __SCHOOL__.scid = __SHOP__.school')
			->getField('sid,shopname,address,detail,used');
		}
		foreach ($ajax['items'] as $key => $val) {
			if ($val['used'] <= 0) {
				unset($ajax['items'][$key]);
			}
		}		
		$this->ajaxReturn($ajax);
	}

	private function filter_exp(&$value){
	    if (in_array(strtolower($value),array('exp','or'))){
	        $value .= ' ';
	    }
	}

	public function upload()
	{
		$upload = new \Think\Upload();// 实例化上传类
		$upload->key 	   =	 'Filedata';
	    $upload->maxSize   =     1024 * 1024 * 15 ;// 设置附件上传大小
	    $upload->exts      =     array('pdf');// 设置附件上传类型
	    $upload->rootPath  =     dirname(THINK_PATH) . '/' . C('ATTACH_FOLDER'); // 设置附件上传根目录
	    $upload->autoSub   =	 true;
	    $upload->subName   =     date('Ym') . '/' . date('d'); // 设置附件上传（子）目录
	    $upload->saveName  =	 uniqid($this->randStr(3), TRUE);
	    $hash = isset($_FILES['Filedata']['tmp_name']) && $_FILES['Filedata']['error'] == 0 ? md5_file($_FILES['Filedata']['tmp_name']) : '';
	    $attid = D('attachment')->isexists($hash);
	    if ($hash && $attid > 0) {
	    	$data = D('attachment')->getAttachment($attid);
	    }
	    if ($attid > 0 && empty($data)) {
	    	D('attachment')->delete($hash);
	    }
	    if (is_array($data)) {
	    	unset($data['tid']);
	    	unset($data['uniqid']);
	    	$data['name'] = $_FILES['Filedata']['name'];
	    	$data['time'] = time();
	    	$data['isshow'] = 1;
	    	$data['school'] = $this->user['school'];
	    	$data['share'] = 0;
	    	$data['uid'] = $this->user['uid'];
	    	$data['aid'] = D('attachment')->saveFile($data);
	    	$data['suc'] = 1;
	    }else{
		    // 上传文件
		    $info   =   $upload->upload();
		    if(!$info) {// 上传错误提示错误信息
		    	$data = array();
		        $data['suc'] = 0;
		        $data['info'] = $upload->getError();
		    }else{// 上传成功
		    	$data = array_pop($info);
		    	$pages = $this->addadv($data);
		    	if ($pages < 0) {
		    		$data = array(
		    			'suc' => 0,
		    			'info' => '转换格式失败，请重新上传'
		    		);
		    		$this->ajaxReturn($data);
		    		return ;
		    	}else{
		    		$data['pages'] = $pages;
		    	}
		    	$data['aid'] = $this->saveFile($data);
		    	$data['suc'] = 1;
		    	D('attachment')->addMd5($data['aid'], $data['md5']);
		    }
		}
	    $this->ajaxReturn($data);
	}

	private function addadv(&$info)
	{
		$bin = C('ADV_BIN');
		$bin = escapeshellcmd($bin);
		$advfile = C('ADV_FILE');
		$advfile = escapeshellarg($advfile);
		$in = C('ATTACH_FOLDER') . $info['savepath'] . $info['savename'];
		$out = C('ATTACH_FOLDER') . $info['savepath'] . 'adv.' . $info['savename'];
		$info['adv'] = $out;
		//exit("python {$bin} -a \"bin/yemei.pdf\" -b \"bin/yejiao.pdf\" -i {$in} -o {$out}");
		$page = shell_exec("python bin/addadv2.py -a \"bin/yemei.pdf\" -b \"bin/yejiao.pdf\" -i {$in} -o {$out}");
		return (int)$page % 2 === 0 ? $page : ($page + 1);
	}

	private function saveFile($info)
	{
		$file = C('ATTACH_FOLDER') . $info['savepath'] . $info['savename'];
		$data = array(
			'loc' => $file,
			'name' => htmlspecialchars($info['name']),
			'uid' => $this->user['uid'],
			'advfile' => $info['adv'],
			'pages' => $info['pages'],
			'size' => filesize($file),
			'time' => time(),
			'school' => $this->user['school']
		);
		return D('attachment')->saveFile($data);
	}

}