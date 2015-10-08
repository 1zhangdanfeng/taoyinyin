<?php
namespace Shop\Controller;
use Shop\Controller;
class StatusController extends BaseController {
	function __construct()
	{
		BaseController::__construct();
	}

	public function index()
	{
		if (IS_POST) {
			$from = I('post.from');
			$to = I('post.to');
			$this->assign('from', $from);
			$this->assign('to', $to);
			
			$from = strtotime($from);
			$to = strtotime($to);
			if ($from && $to && $to - $from > 0) {
				$status = D('order')->status($from, $to);
			}else{
				$this->error('日期错误，起始日期不能比终止日期大');
			}

		}

		$this->assign("status", $status);
		$this->display(T('default/status/index'));
	}

}