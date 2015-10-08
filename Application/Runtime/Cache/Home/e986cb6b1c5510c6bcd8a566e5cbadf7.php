<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>淘印印 | 在线打印</title>
    <link rel="stylesheet" href="<?php echo ($static); ?>css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/self.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/sign.css">
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

<section class="register-box">
  <h4>用户登录</h4>
  <form method="post">
    <div class="row collapse">
      <div class="small-3 large-3 columns">
        <span class="prefix">手机号</span>
      </div>
      <div class="small-9 large-9 columns">
        <input type="text" name="uname" placeholder="使用手机号登录">
      </div>
    </div>
    <div class="row collapse">
      <div class="small-3 large-3 columns">
        <span class="prefix">密码</span>
      </div>
      <div class="small-9 large-9 columns">
        <input type="password" name="upass" placeholder="输入你的密码">
      </div>
    </div>
    <div class="row collapse">
      <div class="small-2 large-2 columns right">
        <div class="switch tiny right">
          <input id="exampleCheckboxSwitch" name="remember" type="checkbox">
          <label for="exampleCheckboxSwitch"></label>
        </div> 
      </div>
      <div class="small-10 large-10 columns right text-right">
        是否保存密码？
      </div>
    </div>
    <div class="row collapse" style="margin-top: 10px;">
      <div class="small-9 large-9 columns ">
        <a class="button tiny right alert" href="<?php echo U('forget'); ?>" style="margin-right:10px;">忘记密码</a>
      </div>
      <div class="small-3 large-3 columns">
        <button type="submit" class="button tiny regbtn">提交</button>
      </div>
    </div>
  </form>
</section>
<div class="clearfix" style="min-height: 120px;"></div>
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