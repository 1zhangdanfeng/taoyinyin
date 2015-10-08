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
<script type="text/javascript" src="<?php echo ($www); ?>Public/DatePicker/jquery.DatePicker.js"></script>
<style>
    input.abc {
        margin-bottom: 0; 
    }
    table .tableleft {
        width: 15%;
    }
</style>
<body>
<form method="post" class="definewidth m20">
    <input type="text" name="from" id="datefrom" class="abc input-default">
    到
    <input type="text" name="to" id="dateto" class="abc input-default"> 
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<?php if(IS_POST): ?><table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft">总订单数</td>
        <td ><?php echo ($status["count"]); ?></td>
    </tr>
    <tr>
        <td class="tableleft">未付款数量</td>
        <td ><?php echo ($status["s0"]); ?></td>
    </tr>
    <tr>
        <td class="tableleft">未打印数量</td>
        <td ><?php echo ($status["s1"]); ?></td>
    </tr>
    <tr>
        <td class="tableleft">已完成数量</td>
        <td ><?php echo ($status["s2"]); ?></td>
    </tr>
</table>
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td class="tableleft">打印店统计</td>
        <td ></td>
    </tr>
    <?php $sum = 0; foreach($status['pages'] as $shop): ?>
    <tr>
        <td class="tableleft"><?php echo ($shop["name"]); ?></td>
        <td ><?php echo ($shop["page"]); ?></td>
    </tr>
    <?php $sum += $shop['page']; endforeach; ?>
    <tr>
        <td class="tableleft">总计</td>
        <td ><?php echo ($sum); ?></td>
    </tr>
</table><?php endif; ?>
<script>
function GetDateStr(AddDayCount) {
    var dd = new Date();
    dd.setDate(dd.getDate()+AddDayCount);//获取AddDayCount天后的日期
    var y = dd.getFullYear();
    var m = dd.getMonth()+1;//获取当前月份的日期
    var d = dd.getDate(); //3f289a8ed91953ff5d6181594e4fec2d
    return y+"-"+m+"-"+d;
}

$(document).ready(function(){
    <?php if(isset($from) && isset($to)): ?>var lastweek = '<?php echo ($from); ?>';
    var now = '<?php echo ($to); ?>';
    <?php else: ?>
    var lastweek = GetDateStr(-7);
    var now = GetDateStr(0);<?php endif; ?>
    $('#datefrom').datePicker({ followOffset : [0, 24], defaultDate: lastweek}).val(lastweek);
    $('#dateto').datePicker({ followOffset : [0, 24], defaultDate: now}).val(now);
})
</script>
</body>
</html>