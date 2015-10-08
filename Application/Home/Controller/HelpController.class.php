<?php
namespace Home\Controller;
use Home\Controller;
class HelpController extends UserController {
	function __construct()
	{
		UserController::__construct();
	}

	public function index()
	{
		$this->display('user/help');
	}

}