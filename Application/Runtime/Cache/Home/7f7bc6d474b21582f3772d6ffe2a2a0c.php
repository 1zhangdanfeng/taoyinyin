<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>淘印印 | 在线打印</title>
    <link rel="stylesheet" href="<?php echo ($static); ?>css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/self.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/user.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>font/foundation-icons.css">
    <script src="<?php echo ($static); ?>js/vendor/modernizr.js"></script>
  </head>
  <body>
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">淘印印</a></h1>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
    <ul class="right">
      <?php if(empty($islogin) || $islogin <= 0): ?>
      <li class="active"><a href="<?php echo U('/home/sign/register'); ?>">立即注册</a></li>
      <li><a href="<?php echo U('/home/sign/login'); ?>">用户登录</a></li>
      <?php else: ?>
      <li class="active"><a href="<?php echo U('/home/print'); ?>">立即打印</a></li>
      <li class="has-dropdown">
        <a href="#">个人中心</a>
        <ul class="dropdown">
          <li><a href="<?php echo U('/home/info/order'); ?>">我的打印</a></li>
          <li class="active"><a href="<?php echo U('/home/info/billing'); ?>">我的积分</a></li>
          <li><a href="<?php echo U('/home/info'); ?>">个人资料</a></li>
          <li><a href="<?php echo U('/home/sign/logout'); ?>">退出登录</a></li>
        </ul>
      </li>
      <?php endif; ?>
    </ul>
    <ul class="left">
      <li class="divider"></li>
      <li><a href="<?php echo ($www); ?>">主页</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo U('/home/wen'); ?>">文库</a></li>
      <li class="divider"></li>
      
    </ul>
  </section>
</nav>

<div class="collapse user order">
<div class="small-2 large-1 columns" style="padding-left:0;">
  <div class="icon-bar vertical five-up main-side" id="float_banner">
    <a class="item" href="<?php echo U('/home/info'); ?>">
      <img src="<?php echo ($static); ?>img/svg/fi-home.svg" >
      <label>个人中心</label>
    </a>
    <a class="item" href="<?php echo U('/home/info/order'); ?>">
      <img src="<?php echo ($static); ?>img/svg/fi-bookmark.svg" >
      <label>历史订单</label>
    </a>
    <a class="item" href="<?php echo U('/home/info/billing'); ?>">
      <img src="<?php echo ($static); ?>img/svg/fi-like.svg" >
      <label>我的积分</label>
    </a>
    <a class="item" href="<?php echo U('/home/wen/mywen'); ?>">
      <img src="<?php echo ($static); ?>img/svg/fi-mail.svg">
      <label>个人文库</label>
    </a>
    <a class="item" href="<?php echo U('/home/help'); ?>">
      <img src="<?php echo ($static); ?>img/svg/fi-info.svg" >
      <label>帮助大厅</label>
    </a>
  </div>
</div>

<div class="small-10 large-11 columns">
  <div class="main-box">

    <div class="row">
        <div class="large-12">
          <ul class="breadcrumbs">
            <li><i class="fi-home"></i> <a href="#">客户中心</a></li>
            <li><a href="#">历史订单</a></li>
          </ul>
      </div>
    </div>

    <div class="row order-list">
      <div class="large-12 small-12">
        <section class="panel">
          <div class="panel-body">

          <table class="otb">
            <thead>
              <tr>
                <th width="20%">订单号</th>
                <th width="20%">时间</th>
                <th width="15%">价格</th>
                <th width="22%">状态</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
            <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($row['rcode']); ?></td>
                <td><?php echo totime($row['time']); ?></td>
                <td><?php echo ($row['point']); ?>金币</td>
                <?php switch($row['status']){ case 0: $status = 'alert';$word='未付款';break; case 1: $status = 'regular';$word='待打印';break; case 2: $status = 'success';$word='待取货';break; default: $status = 'secondary';$word='已完成';break; } ?>
                <td><span class="label <?php echo ($status); ?>"><?php echo ($word); ?></span></td>
                <td>
                <a href="#" name="<?php echo ($row['rid']); ?>" class="button secondary tiny see-detail">查看详情</a>
                <a href="<?php echo U('cancel', "id={$row['rid']}"); ?>" name="<?php echo ($row['rid']); ?>" class="button secondary tiny">取消订单</a>
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table>
          <?php echo ($page); ?>
          </div>
        </section>
      </div>
    </div>

  </div>
</div>

</div>

<div id="myModal" class="reveal-modal tmod" data-reveal>
  <h3> 订单详情 </h3>
  
  <div class="title">订单号: <span id="md-rcode"></span> <span id="md-continue"></span></div>
  <div class="row collapse">
    <div class="large-4 columns">
      <div class="well">
        <h6>下单时间：<small id="md-time"></small></h6>
      </div>
    </div>
    <div class="large-4 columns">
      <div class="well">
        <h6>订单总价：<small id="md-point"></small></h6>
      </div>
    </div>
    <div class="large-4 columns">
    </div>
  </div>
  <div class="row collapse">
    <div class="large-12 columns">
      <div class="well">
        <h6>取货地点：<small id="md-shop"></small></h6>
      </div>
    </div>
  </div>

  <table class="otb">
    <thead>
      <tr>
        <th width="5%">#</th>
        <th >文件名</th>
        <th width="12%">纸张大小</th>
        <th width="12%">页面属性</th>
        <th width="12%">纸张颜色</th>
        <th width="12%">打印份数</th>
        <th width="10%">下载</th>
      </tr>
    </thead>
    <tbody id="md-list">
      
    </tbody>
  </table>

  <a class="close-reveal-modal">&#215;</a>
</div>

<form method="post" id="plist" style="display:none;" action="<?php echo U('/home/print/pay'); ?>"></form>

<div class="clearfix"></div>
  <div class="zurb-footer-bottom">
    <div class="row">
      <div class="medium-4 medium-4 push-8 columns">
        <ul class="home-social">
            <li><a href="#" class="twitter"></a></li>
            <li><a href="#" class="facebook"></a></li>
            <li><a href="#" class="mail"></a></li>
          </ul>
       </div>
       <div class="medium-8 medium-8 pull-4 columns">
          <ul class="zurb-links">
            <li><a href="<?php echo U('/Shop/Login'); ?>">商户入口</a></li>
            <li><a href="#">微信</a></li>
            <li><a href="#">新闻<span class="show-for-medium-up"> &amp; 事件</span></a></li>
            <li><a href="#">联系我们</a></li>
            <li><a href="http://wpa.qq.com/msgrd?v=3&uin=3060906695&site=qq&menu=yes">客服QQ：3060906695</a></li>
         </ul>
         <p class="copyright">© 2014 Taoyinyin, Inc. All rights reserved.</p>
         <?php echo htmlspecialchars_decode($cache['stat_code']); ?>
      </div>
    </div>
  </div>
  <script src="<?php echo ($static); ?>js/vendor/jquery.js"></script>
  <script src="<?php echo ($static); ?>js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
<script>
  $(document).ready(function(){
    $(".see-detail").click(function(){
      $.ajax({
        'url': '<?php echo U('detail'); ?>',
        'dataType': 'json',
        'type': 'get',
        'data': {
          'id': this.name
        },
        'success': function(data){
          $("#myModal #md-rcode").html(data.rcode);
          $("#myModal #md-time").html(data.time);
          $("#myModal #md-point").html(data.point + '金币');
          $("#myModal #md-shop").html(data.shopname);
          $("#myModal #md-list").html('');
          var att = data.attach;
          if (data['status'] == '0') {
            $("#md-continue").html('<a href="#" id="md-cntbtn" class="button tiny right">继续订单</a>');
            var s = data;
            $("#md-cntbtn").click(function(){
              location.href = '<?php echo U('/home/print/submit'); ?>?oid=' + s.rid;
            })
          };
          for(var k in att){
            var ye = att[k]['is_double'] == 1 ? '双页' : '单页';
            var color = att[k]['paper_color'] == 0 ? '黑白' : '彩色';
            var html = '<tr><td>'+k+'</td><td>'+att[k]['name']+'</td><td>'+att[k]['paper_size']+'</td><td>'+ye+'</td><td>'+color+'</td><td>'+att[k]['file_num']+'</td><td><a href="<?php echo U('home/attachment/download'); ?>?id='+att[k]['tid']+'" target="_blank">下载</a></td></tr>';
            $("#myModal #md-list").append(html);
          }
          $('#myModal').foundation('reveal', 'open');
        }
      })
    })
  })
</script>
  </body>
</html>