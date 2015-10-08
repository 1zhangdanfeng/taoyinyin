<?php
namespace Home\Controller;
use Home\Controller;
class SignController extends FrontController {
	function __construct()
	{
		FrontController::__construct();
	}
	
	public function index()
	{
		$this->login();	
	}

	public function test()
	{
		$uname = $_POST['uname'];
		$row = M('user')->where(array('uname' => $uname))->find();
		dump($row);
	}

	public function login()
	{
		if (IS_POST) {
			$uname = I('post.uname', '', 'number_int');
			$upass = I('post.upass');
			$remember = I('post.remember');
			if (empty($uname) || empty($upass)) {
				$this->error('用户名或密码不能为空');
			}
			if (!($row = D('user')->login($uname, $upass))) {
				$this->error("用户名或密码错误");
			}else{
				unset($row['passwd']);
				$row = array(
					'uid' => $row['uid'],
					'uname' => $row['uname'],
					'invite' => $row['invite'],
					'school' => $row['school']
				);
				session('user', $row);
				if ($remember) {
					$cookie = $this->encrypt($row);
					cookie('tyy_auth', $cookie, array(
						'httponly' => TRUE,
						'expire' => 3600 * 24 * 7
					));
				}
				redirect(U('/home/print'));
			}

		}
		$this->display('sign/login');
	}

	public function register()
	{
		if (IS_POST) {
			$uname = session('mobile');
			$upass = I('post.upass');
			if (empty($uname)) {
				$this->error('请先发送验证短信');
			}
			if (empty($upass)) {
				$this->error('密码不能为空');
			}
			$chkcode = I('post.mbchk');
			
			if ($upass != I('post.repass')) {
				$this->error('重复密码错误');
			}
			$rand = session('mbcode');
			if (empty($rand) || $rand != $chkcode) {
				$this->error('手机验证码错误');
			}else{
				session('mbcode', null);
			}
			$school = I('post.school');
			$scid = M('school')->where(array('name' => $school))->getField('scid');
			if (!$scid) {
				$scid = 0;
			}
			$invite = $this->randStr(8);
			$re = M('user')->data(array(
				'uname' => $uname,
				'passwd' => md5($upass),
				'school' => $scid,
				'regtime' => time(),
				'regip' => get_client_ip(),
				'point' => 100,
				'invite' => $invite
			))->add();
			if ($re) {
				$row = array(
					'uid' => $re,
					'uname' => $uname,
					'invite' => $invite,
					'school' => $scid
				);
				session('user', $row);
				D('user')->history($re, '注册用户赠送积分', 100);
				$seco = cookie('tyy_invite');
				if ($seco) {
					$this->__invite_add($seco);
				}
				redirect(U('/home/print'));
			}else{
				$this->error('注册失败');
			}
		}
		$this->display('sign/register');
	}

	public function forget()
	{
		if (IS_POST) {
			$uname = session('mobile');
			$upass = I('post.upass');
			$mbcode = session('mbcode');
			if (empty($upass)) {
				$this->error('密码不能为空');
			}
			if ($upass != I('post.repass')) {
				$this->error('两次填写的密码不相同');
			}
			if (empty($mbcode) || $mbcode != I('post.mbchk')) {
				$this->error('手机验证码不正确');
			}else{
				session('mbcode', null);
			}
			$map = D('user')->getUser($uname, 'uname');
			$map['passwd'] = md5($upass);
			D('user')->edit($map);
			$this->error('修改密码成功，请牢记现在的密码', U('login'), '成功', 200, true);
		}
		$this->display('sign/forget');
	}

	private function __invite_add($code)
	{
		$uid = D('user')->getInviteUser($code);
		if (empty($uid)) {
			return ;
		}
		D('user')->editPoint($uid, 20);
		D('user')->history($uid, '邀请朋友注册获得积分', 20);
	}

	public function fcode()
	{
		$uname = I('post.uname', '', 'number_int');
		$captcha = I('post.captcha');
		if(!D('user')->isexists($uname)){
			$data = array(
				'suc' => 0,
				'info' => '不存在这个手机号'
			);
			$this->ajaxReturn($data);
		}
		if (!$this->checkCaptcha($captcha)) {
			$data = array(
				'suc' => 0,
				'info' => '验证码错误'
			);
			$this->ajaxReturn($data);
		}
		$rand = $this->randStr(5, true);
		if ($uname && $this->__sendcode($uname, $rand)) {
			session('mobile', $uname);
			session('mbcode', $rand);
			$data = array(
				'suc' => 1,
				'info' => '发送成功'
			);
		}else{
			$data = array(
				'suc' => 0,
				'info' => '失败，请检查你填写的手机号是否正确'
			);
		}
		$this->ajaxReturn($data);
	}

	public function sendcode()
	{
		$uname = I('post.uname', '', 'number_int');
		$captcha = I('post.captcha');
		if(D('user')->isexists($uname)){
			$data = array(
				'suc' => 0,
				'info' => '手机号已经注册过啦'
			);
			$this->ajaxReturn($data);
		}
		if (!$this->checkCaptcha($captcha)) {
			$data = array(
				'suc' => 0,
				'info' => '验证码错误'
			);
			$this->ajaxReturn($data);
		}
		$rand = $this->randStr(5, true);
		if ($uname && $this->__sendcode($uname, $rand)) {
			session('mobile', $uname);
			session('mbcode', $rand);
			$data = array(
				'suc' => 1,
				'info' => '发送成功'
			);
		}else{
			$data = array(
				'suc' => 0,
				'info' => '失败，请检查你填写的手机号是否正确'
			);
		}
		$this->ajaxReturn($data);
	}

	public function captcha()
	{
	    $config = array(
	      'fontSize'    =>    30,    
	      'length'      =>    4,     
	      'useNoise'    =>    false, 
	      'useCurve'    =>    false,
	      'codeSet'     =>    'abcdefghjkmnpqrstwxyABCDEFGHJKMNPQRSTWXY23456789',
	      'bg'          =>    array(200, 200, 200)
	    );
	    $Verify = new \Think\Verify($config);
	    $Verify->entry();
	}

	private function checkCaptcha($code)
	{
		$verify = new \Think\Verify();
    	return $verify->check($code);
	}

	public function logout()
	{
		session('user', null);
		cookie('tyy_auth', null);
		redirect(U('/home'));
	}

	public function invite()
	{
		$code = I('get.code');
		cookie('tyy_invite', (string)$code);
		redirect(U('register'));
	}

	private function __sendcode($phone, $rand)
	{
		$username = 'cf_lkyddx';
		$password = 'tyy1qaz2ws3e4';
		return file_get_contents("http://106.ihuyi.cn/webservice/sms.php?method=Submit&account={$username}&password={$password}&mobile={$phone}&content=Hi，淘印印等你好久了！你的验证码是【{$rand}】。记住不要告诉别人，不是本人操作，记得搜索淘印印~");
	}
  

}