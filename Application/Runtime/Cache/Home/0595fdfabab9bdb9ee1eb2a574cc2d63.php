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
  <div class="main-box">
    <div class="row">

<form method="post">
  <div class="row">
    <div class="large-4 columns">
      <label> 用户名
        <input type="text" value="<?php echo ($uinfo['uname']); ?>" disabled />
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label> 你的名字
        <input type="text" name="truename" placeholder="你的姓名将作为默认收货人姓名" value="<?php echo ($uinfo['truename']); ?>" />
      </label>
    </div>
    <div class="large-4 columns">
      <label> 邮箱
        <input type="text" name="email" placeholder="联系邮箱" value="<?php echo ($uinfo['email']); ?>" />
      </label>
    </div>
    <div class="large-4 columns">
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label> 修改密码
        <input type="password" name="upass" placeholder="不修改密码则留空" />
      </label>
    </div>
    <div class="large-8 columns">
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label> 年级
        <select name="grade">
        <?php $__FOR_START_1483460920__=2009;$__FOR_END_1483460920__=2015;for($i=$__FOR_START_1483460920__;$i < $__FOR_END_1483460920__;$i+=1){ if(($uinfo['grade']) == $i): ?><option value="<?php echo ($i); ?>" selected><?php echo ($i); ?>级</option>
            <?php else: ?>
            <option value="<?php echo ($i); ?>"><?php echo ($i); ?>级</option><?php endif; } ?>
        </select>
      </label>
    </div>
    <div class="large-4 columns">
      <label> 专业
          <input type="text" name="major" value="<?php echo ($uinfo['major']); ?>" placeholder="如：通信工程" />
      </label>
    </div>
    <div class="large-4 columns">
      
    </div>
  </div>
  <div class="row">
    <div class="large-6 columns">
      <label>性别</label>
      <?php if(($uinfo['sex']) == "m"): ?><input type="radio" name="sex" value="m" checked><label for="pokemonRed">男</label>
      <input type="radio" name="sex" value="f"><label for="pokemonBlue">女</label>
      <?php else: ?>
      <input type="radio" name="sex" value="m"><label for="pokemonRed">男</label>
      <input type="radio" name="sex" value="f" checked><label for="pokemonBlue">女</label><?php endif; ?>
    </div>
    <div class="large-6 columns">
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label> 个人说明
        <textarea rows="5" name="intro" placeholder="一个很无聊的程序员"><?php echo ($uinfo['intro']); ?></textarea>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-2 columns">
      <label>
        <input type="submit" class="button tiny" value="保存">
      </label>
    </div>
  </div>
</form>

    </div>
  </div>
</div>

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