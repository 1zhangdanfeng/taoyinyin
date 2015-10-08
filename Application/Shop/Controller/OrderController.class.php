<?php
namespace Shop\Controller;
use Shop\Controller;
class OrderController extends BaseController {
	function __construct()
	{
		BaseController::__construct();
        $this->default_page = U('lists');
	}

	function test()
	{
	}

    public function lists()
    {
        $page = I('get.p', 1, 'int');
        $limit = I('get.each', 15, 'int');
        $page_obj = new \Think\Page(1, $limit);
    	if (IS_POST && I('post.query') && I('post.value')) {
            $query = I('post.query');
            $value = I('post.value');
            switch($query){
                case 'onum':
                    $qme = M('order')->where(array('rcode' => $value));
                    break;
                case 'mobile':
                    $where = array(
                        'order_mobile' => array('LIKE', "%{$value}%")
                    );
                    $count = M('order')->where($where)->count();
                    $page_obj = new \Think\Page($count, $limit);
                    $qme = M('order')->where($where)->limit(($page - 1) * $limit, $limit);
                    break;
                default:
                    redirect(U('lists'));
                    return ;
            }
        }else{
            $count = M('order')->where(array('order_sid' => $this->myadmin['sid']))->count();
            $page_obj = new \Think\Page($count, $limit);
            $qme = M('order')->limit(($page - 1) * $limit, $limit);
        }
        $result = $qme
            ->join('__SHOP__ ON __ORDER__.order_sid = __SHOP__.sid')
            ->where(array('order_sid' => $this->myadmin['sid']))
            ->order('time desc')
            ->select();

        $non = session('last_order_num');
        $lon = count($result);
        if ($lon > $non) {
            session('last_order_num', $lon);
            $sound = 1;
        }else{
            $sound = 0;
        }

        foreach ($result as $key => $row) {
            $result[$key]['time'] = $this->date($row['time']);
            $result[$key]['pages'] = $num = D('order')->orderPages($result[$key]['rid']);
        }

        $this->assign('sound', $sound);
        $this->assign('page', $page_obj->show());
        $this->assign('orders', $result);
        $this->display(T('default/order/index'));
    }

    public function edit()
    {
        $id = I('get.id', 0, 'int');
        $order = M('order')
            ->join('__SHOP__ ON __SHOP__.sid = __ORDER__.order_sid')
            ->find($id);
        if ($order['sid'] != $this->myadmin['sid']) {
            $this->error('不能查看他人的订单');
        }        
        if (IS_POST) {
            $recvname = I('post.recvname');
            $mobile = I('post.mobile', '', 'number_int');
            $address = I('post.address');
            $money = I('post.money', 0, 'int');
            $amount = I('post.amount', 1, 'int');
            $status = I('post.status', -1, 'int');
            if (empty($recvname)) {
                $this->error('收件人不能为空');
            }
            if (empty($mobile)) {
                $this->error('手机号码格式错误');
            }
            if (empty($address)) {
                $this->error('地址不能为空');
            }
            if ($mount < 0) {
                $this->error('金额不能是负数');
            }
            if ($amount <= 0) {
                $this->error('数量不能为0或负数');
            }
            $data = array(
                'rid' => $id,
                'recvname' => $recvname,
                'order_mobile' => $mobile,
                'order_address' => $address,
                'order_money' => $money,
                'amount' => $amount
            );
            if ($status < 0 || $status > 3) {
                $this->error('订单状态错误');
            }else if($status >= 2){
                $data['finish_time'] = time();
            }
            M('order')->save($data);
        }

        $attachment = M('order_attach')->where(array(
            'oid' => $id,
        ))->join('__ATTACHMENT__ ON __ATTACHMENT__.tid = __ORDER_ATTACH__.tid')
        ->select();

        
        $order['time'] = $this->date($order['time']);
        $order['finish_time'] = $this->date($order['finish_time']);

        //用户
        $user = M('user')->find($order['order_uid']);
        
        $this->assign('order', $order);
        $this->assign('user', $user);
        $this->assign('attachment', $attachment);
        $this->display(T('default/order/edit'));
    }

    public function confirm()
    {
        $id = I('get.id', '', 'int');
        M('order')->where(array(
            'rid' => $id,
            'order_sid' => $this->myadmin['sid']
        ))->save(array(
            'status' => 2
        ));
        $order = D('order')->getOrder($id);
        $this->__send_msg($order['rcode'], $this->myadmin['shopname'], $order['order_mobile']);
        redirect(U('lists'));
    }

    public function status()
    {
        $data = array();
        $status = I('post.status', -1, 'int');
        $rids = (array)I('post.order_id');
        $rids = array_map('intval', $rids);
        $ajax = I('post.ajax', 0, 'int');
        if ($status >= 0 && $status < 4) {
            foreach ($rids as $k => $rid) {
                $sid = M('order')->where(array('rid' => $rid))->getField('order_sid');
                if (intval($sid) != intval($this->myadmin['sid'])) {
                    unset($rids[$k]);
                }
            }
            $where = array();
            $where['rid'] = array('IN', implode(',', $rids));
            $edit = array(
                'status' => $status
            );
            M('order')->where($where)->save($edit);
            $data['status'] = 1;
            $data['info'] = '修改成功';
        }else{
            $data['status'] = -1;
            $data['info'] = '参数错误';
        }
        if ($ajax) {
            $this->ajaxReturn($data);
        }else{
            redirect($this->form);
        }
    }

    private function __send_msg($rcode, $shopname, $phone)
    {
        $name = $this->cache['smsg_user'];
        $pass = $this->cache['smsg_pwd'];
        $msg = "同学你好，你的打印订单【{$rcode}】已经处理好了~赶快到【{$shopname}】取哦~，叫大家来使用淘印印哦~谢谢支持喽！";
        file_get_contents("http://106.ihuyi.cn/webservice/sms.php?method=Submit&account={$name}&password={$pass}&mobile={$phone}&content={$msg}");
    }
}