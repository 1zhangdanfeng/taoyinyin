<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	protected $wwwsite;
	
	function __construct()
	{
		Controller::__construct();
		
		S(array('type'=>'File','expire'=>60));
		session(array('name'=>'auth_session', 'expire'=>3600));

		$this->InitGlobalCache();

		$this->wwwsite = C('WWW_SITE');
		$this->assign('www', $this->wwwsite);
		$this->assign('static', $this->wwwsite . 'Public/front/');
		$this->assign('upload', $this->wwwsite . 'attachment/');
		$this->form = I('server.HTTP_REFERER', '', 'magic_quotes');

		$user = session('user');
		$this->getUser();
		$this->assign('islogin', $user['uid']);
	}

	protected function error($content, $jmp = 'javascript:history.back(-1)', $title = '出现错误', $status = 200, $suc = false)
	{
		$data = array(
			'title' => $title,
			'content' => $content,
			'status' => $status,
			'jmp' => $jmp,
			'suc' => $suc
		);
		$this->assign($data);
		$this->display('/error');
		exit;
	}

	protected function InitGlobalCache()
	{
		$cache = S('option');
		if (empty($cache) || !is_array($cache)) {
			$cache = array();
			$option = M('option')->select();
			foreach ($option as $row) {
				if ($row['osort'] == 'obj') 
				{
					$cache[$row['okey']] = unserialize($row['oval']);
				}
				else if($row['osort'] == 'int')
				{
					$cache[$row['okey']] = intval($row['oval']);
				}else{
					$cache[$row['okey']] = $row['oval'];
				}
			}
			S('option', $cache);
		}
		$this->cache = $cache;
	}

	protected function check_verify($code, $id = ''){
	    $verify = new \Think\Verify();
	    return $verify->check($code, $id);
	}

	protected function randStr($length = 6, $number = false)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		if ($number) {
			$chars = '0123456789';
		}
		$randStr = '';
		for ($i = 0; $i < $length; $i++) {
			$randStr .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $randStr;
	}

	/*加密解密函数*/
	protected function encrypt($arr){
		$str = json_encode($arr);
		$en = \Think\Crypt\Driver\Xxtea::encrypt($str, C("AUTH_KEY"));
		return base64_encode($en);
	}

	protected function decrypt($str_en){
		$de = base64_decode($str_en);
		$re = \Think\Crypt\Driver\Xxtea::decrypt($de, C("AUTH_KEY"));
		return json_decode($re, TRUE);
	}

	private function getUser()
	{
		if ( empty( $user ) ){
			$cookie = cookie('tyy_auth');
			if (empty($cookie)) {
				return ;
			}
			$user = $this->decrypt($cookie);
			if (empty($cookie) || empty($user) || empty($user['uid'])) {
				return ;
			}else{
				session('user', $user);
			}
		}
	}
}