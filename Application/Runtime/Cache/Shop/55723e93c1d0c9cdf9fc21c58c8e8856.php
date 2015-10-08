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
<style type="text/css">
.tyy-0{color:red;}.tyy-1{color:green;}
</style>
<form class="form-inline definewidth m20" method="post">
    <select name="query" class="selector">  
        <option value="onum">订单号</option>
        <option value="mobile">电话</option>  
    </select>
    =
    <input type="text" name="value" class="abc input-default" placeholder="支持模糊查询" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<form id="main-form" method="post" action="<?php echo U('status'); ?>">
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
    	<th width="3%"></th>
        <th width="12%">订单号</th>
        <th width="12%">提交时间</th>
        <th width="10%">手机号</th>
        <th width="7%">收件人</th>
        <th width="13%">订单状态</th>
        <th>用户留言</th>
        <th width="6%">总页数</th>
        <th width="12%">操作</th>
    </tr>
    </thead>
    <tbody id="main-table">
        <?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$od): $mod = ($i % 2 );++$i;?><tr>
         	<td><input type="checkbox" class="ids" name="order_id[]" value="<?php echo ($od["rid"]); ?>" /></td>
         	<td><?php echo ($od["rcode"]); ?></td>
            <td><?php echo ($od["time"]); ?></td>
            <td><?php echo ($od["order_mobile"]); ?></td>
            <td><?php echo ($od["recvname"]); ?></td>
            <?php $status = array('','');$n = 2; if($od['status'] <= 1){$status[0] = 'selected';$n = 0;} else {$status[1] = 'selected'; $n = 1;} ?>
            <td>
            	<select disabled class="tyy-<?php echo ($n); ?>" name="<?php echo ($od["rid"]); ?>">  
 					<option value="0" class="tyy-0" <?php echo ($status[0]); ?>>未打印</option>  
                    <option value ="1" class="tyy-1" <?php echo ($status[1]); ?>>已打印</option> 
				</select> 
            </td>
            <td><?php echo ($od["message"]); ?></td>
            <td><?php echo ($od["pages"]); ?></td>
            <td>
                <?php $url = U('edit', array('id' => $od['rid'])); ?>
                <a href="<?php echo ($url); ?>">详情</a> / <a href="<?php echo U('confirm', "id={$od['rid']}"); ?>">确认订单</a>         
            </td>
         </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
    </table>
    <div class="definewidth">
    	<div class="inline pull-left page">
    	</div>
		<div class="inline pull-right page">
     		<?php echo ($page); ?>
    	</div>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    if (<?php echo ($sound); ?>) {
        $("body").append('<EMBED src="<?php echo ($www); ?>Public/sound/msg.wav" autostart="true" loop="false" width="0" height="0">');
    };
    setTimeout(function(){
        location.reload();
    }, 60000);
})
</script>
</body>
</html>