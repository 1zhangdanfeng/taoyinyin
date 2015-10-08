<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>淘印印 | 在线打印</title>
    <link rel="stylesheet" href="<?php echo ($static); ?>css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/self.css">
    <link rel="stylesheet" href="<?php echo ($static); ?>css/index_2.css"/>
  </head>
  <body class="index">
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
    
<section class="index_print">
    <img src="<?php echo ($static); ?>img/index_02.jpg"/>
    <div class="index_logo"></div>
</section>


<button class="start_print" onclick="location.href='<?php echo U('/home/print'); ?>';">立即免费打印</button>
<section class="avail_info">
    <div class="step_intro">
        <div class="step_bar">
            <img src="<?php echo ($static); ?>img/step_bar.png"/>
        </div>
        <div class="step_detail step1">
            <h3>Step1</h3>

            <p class="step_describe">用户登陆后，在线提交需要打印的文件。或去<span class="font_red">文库</span>选择所需文件打印。</p>

            <p class="add_text">
                *暂时仅支持PDF格式
            </p>
        </div>
        <div class="step_detail step2">
            <h3>Step2</h3>

            <p class="step_describe">在线编辑、确认。设置打印格式，属性。</p>

            <div class="add_img">
                <img src="<?php echo ($static); ?>img/step_2.jpg"/>
            </div>
        </div>
        <div class="step_detail step3">
            <h3>Step3</h3>
            <p class="step_describe">在线提交文件到打印店。</p>

            <div class="add_img">
                <img src="<?php echo ($static); ?>img/step_3.png"/>
            </div>
        </div>
        <div class="step_detail step4">
            <h3>Step4</h3>

            <p class="step_describe">按照约定的时间，线下领取打印的资料。</p>

            <div class="add_img">
                <img src="<?php echo ($static); ?>img/step_4.png"/>
            </div>
        </div>
    </div>
</section>

<section class="star">
    <img src="<?php echo ($static); ?>img/star_bg.jpg"/>
    <div class="star_logo"></div>
    <div class="eng_slogan">Run to future.Never stop.</div>

</section>

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
<script type="text/javascript" src="<?php echo ($static); ?>js/index_2.js"></script>
  </body>
</html>