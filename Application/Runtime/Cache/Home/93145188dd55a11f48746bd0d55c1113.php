<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="<?php echo ($static); ?>css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/self.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/wen.css">
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
    
<div class="row wen">
<div class="panel">

<?php if($suc): ?><pre>
 ad88888ba   88        88    ,ad8888ba,     ,ad8888ba,   88888888888   ad88888ba    ad88888ba   
d8"     "8b  88        88   d8"'    `"8b   d8"'    `"8b  88           d8"     "8b  d8"     "8b  
Y8,          88        88  d8'            d8'            88           Y8,          Y8,          
`Y8aaaaa,    88        88  88             88             88aaaaa      `Y8aaaaa,    `Y8aaaaa,    
  `"""""8b,  88        88  88             88             88"""""        `"""""8b,    `"""""8b,  
        `8b  88        88  Y8,            Y8,            88                   `8b          `8b  
Y8a     a8P  Y8a.    .a8P   Y8a.    .a8P   Y8a.    .a8P  88           Y8a     a8P  Y8a     a8P  
 "Y88888P"    `"Y8888Y"'     `"Y8888Y"'     `"Y8888Y"'   88888888888   "Y88888P"    "Y88888P"   
                                                                                                
</pre>
<br/>
<div data-alert class="alert-box success radius">
  <span><?php echo ($content); ?></span><br/>
  <span><a style="" href="<?php echo ($jmp); ?>">点击跳转</a></span>
  <a href="#" class="close">&times;</a>
</div>

<?php else: ?>
<pre>
88888888888  88888888ba   88888888ba     ,ad8888ba,    88888888ba   
88           88      "8b  88      "8b   d8"'    `"8b   88      "8b  
88           88      ,8P  88      ,8P  d8'        `8b  88      ,8P  
88aaaaa      88aaaaaa8P'  88aaaaaa8P'  88          88  88aaaaaa8P'  
88"""""      88""""88'    88""""88'    88          88  88""""88'    
88           88    `8b    88    `8b    Y8,        ,8P  88    `8b    
88           88     `8b   88     `8b    Y8a.    .a8P   88     `8b   
88888888888  88      `8b  88      `8b    `"Y8888Y"'    88      `8b  
</pre>
<br/>
<div data-alert class="alert-box warning radius">
  <span><?php echo ($content); ?></span><br/>
  <span><a style="" href="<?php echo ($jmp); ?>">点击返回</a></span>
  <a href="#" class="close">&times;</a>
</div><?php endif; ?>

</div>

</div>

<div class="clearfix" style="height: 300px;"></div>

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