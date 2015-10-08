<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>淘印印 | 在线打印</title>
    <link rel="stylesheet" href="<?php echo ($static); ?>css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/self.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>css/wen.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ($static); ?>font/foundation-icons.css">
    <script src="<?php echo ($static); ?>js/vendor/modernizr.js"></script>
    <script src="<?php echo ($static); ?>js/school.js"></script>
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
<h3>校园文库</h3>
<div class="panel">
  <form method="get">
    <div class="row">
      <div class="large-12 columns">
        <div class="row collapse">
          <div class="small-4 columns">
            <input type="text" name="school" class="button tiny success school postfix" id="school-name" value="西安电子科技大学" />
          </div>
          <div class="small-7 columns">
            <input type="text" name="word" placeholder="搜索文档">
          </div>
          <div class="small-1 columns">
            <button type="submit" class="button postfix">Go</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="panel" style="border-top:0;">
  <?php $__FOR_START_313496373__=0;$__FOR_END_313496373__=$count;for($i=$__FOR_START_313496373__;$i < $__FOR_END_313496373__;$i+=3){ ?><div class="columns oneline">
    <div class="large-4 small-4 columns">
      <h6><span title="doc" class="ic ic-ppt"> </span> <a href="#" name="<?php echo ($att[$i]['tid']); ?>" class="print"><?php echo ($att[$i]['name']); ?></a> <small><?php echo totime($att[$i]['time']); ?> </small></h6>
      <p class="intro">简介：<?php echo ($att[$i]['intro']); ?></p>
    </div>
    <?php if($att[$i + 1]): ?>
    <div class="large-4 small-4 columns left">
      <h6><span title="doc" class="ic ic-ppt"> </span> <a href="#" name="<?php echo ($att[$i+1]['tid']); ?>" class="print"><?php echo ($att[$i+1]['name']); ?></a> <small><?php echo totime($att[$i+1]['time']); ?> </small></h6>
      <p class="intro">简介：<?php echo ($att[$i+1]['intro']); ?></p>
    </div>
    <?php endif; if($att[$i + 2]): ?>
    <div class="large-4 small-4 columns left">
      <h6><span title="doc" class="ic ic-ppt"> </span> <a href="#" name="<?php echo ($att[$i+2]['tid']); ?>" class="print"><?php echo ($att[$i+2]['name']); ?></a> <small><?php echo totime($att[$i+2]['time']); ?> </small></h6>
      <p class="intro">简介：<?php echo ($att[$i+2]['intro']); ?></p>
    </div>
    <?php endif; ?>
  </div><?php } ?>
  <div class="clearfix"></div>
</div>

</div>

<div class="clearfix" style="height: 500px;"></div>

<div id="choose-box-wrapper">
  <div id="choose-box">
    <div id="choose-box-title">
      <span>选择学校</span>
    </div>
    <div id="choose-a-province"></div>
    <div id="choose-a-school"></div>
    <div id="choose-box-bottom">
      <input type="botton" onclick="hide()" value="关闭" />
    </div>
  </div>
</div>

<form method="post" id="plist" style="display:none;" action="<?php echo U('/home/print/submit'); ?>"></form>

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
<script type="text/javascript">
  $(document).ready(function(){
    $('#school-name').bind('click', function(){
      pop();
    });
    $(".wen .print").click(function(){
      if (confirm("是否打印此文档")) {
        var f = $('#plist');
        f.append('<input type="hidden" name="upfile[]" value="'+this.name+'">');
        f.append('<input type="hidden" name="number[]" value="1">');
        f.submit();
      }
    })
  });
</script>
  </body>
</html>