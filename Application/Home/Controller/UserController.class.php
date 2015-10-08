<?php
namespace Home\Controller;
use Home\Controller;
class UserController extends BaseController {
	protected $user = NULL;
	function __construct()
	{
		BaseController::__construct();
		$this->CheckLogin();
	}

	/*检查是否登录*/
	private function CheckLogin()
	{
		$user = session('user');
		if ( empty( $user ) ){
			redirect(U('/Home/Sign/Login'));
		}
		$this->user = $user;
	}
	
	/*退出*/
	public function logout(){
	  session('user', null);
	  redirect(U('/Home/Sign/Login'));
	}


}