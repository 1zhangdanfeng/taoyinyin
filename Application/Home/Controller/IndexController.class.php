<?php
namespace Home\Controller;
use Home\Controller;
class IndexController extends FrontController {
	function __contruct()
	{
		FrontController::__construct();
	}

    public function index()
    {
    	$this->display('/index');
    }
    
    
}