<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo ($www); ?>Public/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($www); ?>Public/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($www); ?>Public/Css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($www); ?>Public/Css/taoyy.css" />
    <script type="text/javascript" src="<?php echo ($www); ?>Public/Js/jquery-1.9.1.min.js"></script>

    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }
/*        #delete {
            float: right;
        }*/
    </style>
</head>
<body>
<form method="post" class="definewidth m20">
<table class="table table-bordered table-hover ">
    <tr>
        <td width="10%" class="tableleft">订单号</td>
		<td ><?php echo ($order["rcode"]); ?></td>
    </tr>
     <tr>
        <td class="tableleft">提交时间</td>
		<td ><?php echo ($order["time"]); ?></td>
    </tr>
    <tr>
        <td class="tableleft">用户名</td>
        <td ><?php echo ($user["uname"]); ?></td>
    </tr> 
    <tr>
        <td class="tableleft">收件人</td>
        <td ><input type="text" name="recvname" value="<?php echo ($user["truename"]); ?>" /></td>
    </tr>  
    <tr>
        <td class="tableleft">订单手机号</td>
        <td ><input type="text" name="mobile" value="<?php echo ($order["order_mobile"]); ?>" /></td>
    </tr> 
    <tr>
        <td class="tableleft">用户留言</td>
        <td ><?php echo ($order["message"]); ?></td>
    </tr> 
    <tr>
        <td class="tableleft">商家名称</td>
        <td ><?php echo ($order["shopname"]); ?></td>
    </tr> 
    <tr>
        <td class="tableleft">金额</td>
        <td ><input type="text" name="money" style="width: 10%;" value="<?php echo ($order["order_money"]); ?>" /></td>
    </tr> 
    <tr>
        <td class="tableleft">份数</td>
        <td ><input type="text" name="amount" style="width: 10%;" value="<?php echo ($order["amount"]); ?>" /></td>
    </tr> 
    <tr>
        <td class="tableleft">文档下载</td>
        <td >
        <?php if(is_array($attachment)): $i = 0; $__LIST__ = $attachment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><a href="<?php echo U('/Shop/Attachment/Download', array('id' => $row['tid'], 'order' => $order['rid'])); ?>"><?php echo ($row['name']); ?></a> 打印<?php echo ($row['file_num']); ?>份 共<?php echo ($row['pages']); ?>页<br/><?php endforeach; endif; else: echo "" ;endif; ?>
        </td>
    </tr>  
    <tr>
        <?php $status = array('','','','');$status[$order['status']] = 'checked'; ?>
        <td class="tableleft">订单状态</td>
        <td >
        	<input type="radio" name="status" disabled value="0" <?php echo ($status[0]); ?> /> 已提交&nbsp;&nbsp;
            <input type="radio" name="status" disabled value="1" <?php echo ($status[1]); ?> /> 已支付&nbsp;&nbsp;
        	<input type="radio" name="status" disabled value="2" <?php echo ($status[2]); ?> /> 已完成&nbsp;&nbsp;
      		<input type="radio" name="status" disabled value="3" <?php echo ($status[3]); ?> /> 用户已取消
        </td>
    </tr>
    <?php if($order[status] > 1): ?><tr>
        <td class="tableleft">完成时间</td>
        <td ><?php echo ($order["finish_time"]); ?></td>
        </tr><?php endif; ?>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>
    $(function () {       
		$('#backid').click(function(){
				window.location.href="<?php echo ($default_page); ?>";
		 });
		$('#delete').click(function(){
			if(confirm("确定要删除吗？")){
				$("#form1").attr("action","");
				$("#form1").submit();
				var url = "index.html";	
				window.location.href=url;	
			}
		});
    });
</script>