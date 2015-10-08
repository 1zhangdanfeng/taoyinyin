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
<div class="main-box print">

  <div class="row">
      <div class="large-12">
        <ul class="breadcrumbs">
          <li><i class="fi-home"></i> <a href="#">客户中心</a></li>
          <li><a href="#">开始打印</a></li>
        </ul>
    </div>
  </div>
  
  <div class="row panel school">
    <div>
      <div class="large-6 left">
        <input type="button" class="button tiny secondary" id="school-name" onblur="if(this.value==''){this.value='请选择大学'}" onfocus="if(this.value=='请选择大学'){this.value=''}" value="<?php echo ($schoolname); ?>" />
      </div>
      <div class="large-6 right money">
        ￥<?php echo ($money); ?>元 <small><?php echo ($point); ?>金币</small>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="message">
      <form method="post" id="order" action="<?php echo U('pay'); ?>">
        <div class="large-12">
            <textarea name="message" placeholder="给打印店的留言"></textarea>
        </div>
        <input type="hidden" name="shopid">
        <input type="hidden" name="oid" value="<?php echo ($order_id); ?>">
        <input type="hidden" name="rcode" value="<?php echo ($rcode); ?>">
      </form>
    </div>
  </div>

  <div class="row panel shop">

    <dl class="accordion" id="shop-list" data-accordion>
      
    </dl>

  </div>

</div>
</div>

</div>

<div class="clearfix"></div>

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
<script type="text/javascript" src="<?php echo ($static); ?>js/school.js"></script>
<script type="text/javascript">
  afterclose = function(school){
    $.ajax({
      'url': '<?php echo U('shop'); ?>',
      'data': {
        'school': school
      },
      'dataType': 'json',
      'success': function(data){
        var shops = data.items;
        $("#shop-list").html('');
        for(var k in shops){
          var template = '<dd class="accordion-navigation">\
            <a href="#panel'+k+'"><i class="fi-print"></i> '+shops[k]['shopname']+'</a>\
            <div id="panel'+k+'" class="content">\
              <div class="tabs-content">\
                <div class="large-10 columns">\
                  <p>地址：'+shops[k]['address']+'</p>\
                  <p>'+shops[k]['detail']+'</p>\
                </div>\
                <div class="large-2 columns">\
                  <a name="'+shops[k]['sid']+'" class="button tiny right prt-btn">打印</a>\
                </div>\
              </div>\
            </div>\
          </dd>';
          $("#shop-list").append(template);
        }
        $('.prt-btn').click(function(){
          var sid = this.name;
          $("[name='shopid']").val(sid);
          $("#order").submit();
        })
      }
    })
  };
  afterclose('<?php echo ($schoolname); ?>');
  $(document).ready(function(){
    $('#school-name').bind('click', function(){
      pop();
    });
  });
</script>
  </body>
</html>