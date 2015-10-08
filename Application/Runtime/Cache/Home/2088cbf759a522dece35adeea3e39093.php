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

<div class="collapse user">
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
<div class="main-box billing">

  <div class="row">
    <div class="large-12">
        <ul class="breadcrumbs">
          <li><i class="fi-home"></i> <a href="#">客户中心</a></li>
          <li><a href="#">我的积分</a></li>
        </ul>
    </div>
  </div>
  
  <div class="row">
    <div class="large-12 panel">
      <fieldset>
      <legend>当前积分</legend>
        <div class="row collapse">
          <div class="large-4 columns">
            当前金币：<?php echo ($info['point']); ?>
          </div>
          <div class="large-4 columns">
            已用金币：<?php echo ($sum); ?>
          </div>
          <div class="large-4 columns">
            <a class="button tiny success" data-reveal-id="invite" >赚取金币</a>
          </div>
        </div>
      </fieldset>
      <table class="otb">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th width="30%">时间</th>
              <th>说明</th>
              <th width="20%">金币变化</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($history)): $i = 0; $__LIST__ = $history;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($i); ?></td>
              <td><?php echo totime($row['time']); ?></td>
              <td><?php echo ($row['content']); ?></td>
              <td><?php echo ($row['number']); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
        <ul class="stack-for-small round secondary button-group right">
          <li><a href="<?php echo U('billing', 'p=' . ($page - 1)); ?>" class="button secondary tiny">上一页</a></li>
          <li><a href="<?php echo U('billing', 'p=' . ($page + 1)); ?>" class="button secondary tiny">下一页</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
  </div>

</div>
</div>

</div>

<div id="invite" class="reveal-modal medium" data-reveal>
  <h2>邀请注册</h2>
  <p class="lead">邀请好友注册可以获得积分</p>
  <div><input type="text" class="expend disabled" value="<?php echo ($invite); ?>"></div>
  <a class="close-reveal-modal">&#215;</a>
</div>

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
  </body>
</html>