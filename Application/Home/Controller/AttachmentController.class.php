<?php
namespace Home\Controller;
use Home\Controller;
class AttachmentController extends UserController {
	function __construct()
	{
		UserController::__construct();
        set_time_limit(0);
	}

	public function download()
	{
		$aid = I('get.id', 0, 'int');
		$file = M('attachment')->where(array(
			'uid' => $this->user['uid']
		))->find($aid);
		$file['loc'] = realpath($file['loc']);
		if (is_file($file['loc'])) {
			header('Content-type: application/octet-stream');
			header('Content-Encoding: none');
			header('Content-Transfer-Encoding: binary');
			header('Content-length: ' . filesize($file['loc']));
			header('Content-disposition: attachment;filename="'.$file['name'].'"');
			readfile($file['loc']);
		}else{
			header('HTTP/1.1 404 Not Found');
		}
	}


}

?>