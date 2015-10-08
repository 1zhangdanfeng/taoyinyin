<?php
namespace Shop\Controller;
use Shop\Controller;
class AttachmentController extends BaseController {
	function __construct()
	{
		BaseController::__construct();
        set_time_limit(0);
	}

	public function download()
	{
		$aid = I('get.id', 0, 'int');
		$oid = I('get.order', 0, 'int');
		$map = array();
		$map['oid'] = $oid;
		$map['tid'] = $aid;
		if (M('order_attach')->where($map)->count() <= 0) {
			header('HTTP/1.1 404 Not Found');
			exit;
		}
		$file = M('attachment')->find($aid);
		if (empty($file)) {
			header('HTTP/1.1 404 Not Found');
			exit;
		}else{
			M('order')->save(array(
				'rid' => $oid,
				'finish_time' => time()
			));
		}
		$file['advfile'] = realpath($file['advfile']);
		if (is_file($file['advfile'])) {
			header('Content-type: application/pdf');
			header('Content-Encoding: none');
			header('Content-Transfer-Encoding: binary');
			header('Content-length: ' . filesize($file['advfile']));
			header('Content-disposition: attachment;filename="'.$file['name'].'"');
			readfile($file['advfile']);
		}else{
			header('HTTP/1.1 404 Not Found');
		}
	}


}

?>