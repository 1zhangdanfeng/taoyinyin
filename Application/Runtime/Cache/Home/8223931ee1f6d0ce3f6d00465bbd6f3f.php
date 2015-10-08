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

  <section class="register-box" data-stars-type="form">
    <h4>用户注册</h4>
    <form method="post" name="regform">
      <div data-alert class="row alert alert-box hide" id="error">
        
      </div>
      <div class="row collapse">
        <div class="small-3 large-3 columns">
          <span class="prefix">手机号</span>
        </div>
        <div class="small-9 large-9 columns">
          <input type="text" name="uname" placeholder="输入你的手机号" >
        </div>
      </div>
      <div class="row collapse">
      <div class="small-3 large-3 columns">
        <span class="prefix">验证码</span>
      </div>
      <div class="small-5 large-5 columns">
        <input type="text" name="captcha" placeholder="输入验证码">
      </div>
      <div class="small-4 large-4 columns">
        <img onclick="this.src='<?php echo U('/home/sign/captcha'); ?>?' + Math.random();" src="<?php echo U('/home/sign/captcha'); ?>" style="height:37px;cursor:pointer">
      </div>
    </div>
      <div class="row collapse">
        <div class="small-3 large-3 columns">
          <span class="prefix">手机验证</span>
        </div>
        <div class="small-4 large-5 columns">
          <input type="text" name="mbchk" placeholder="接收到的验证码">
        </div>
        <div class="small-5 large-4 columns">
          <a href="#" class="button tiny secondary regbtn sendcode" id="sendmbcode">发送短信</a>
        </div>
      </div>
      <div class="row collapse">
        <div class="small-3 large-3 columns">
          <span class="prefix">密码</span>
        </div>
        <div class="small-9 large-9 columns">
          <input type="password" name="upass" placeholder="输入至少6位密码">
        </div>
      </div>
      <div class="row collapse">
        <div class="small-3 large-3 columns">
          <span class="prefix">重复密码</span>
        </div>
        <div class="small-9 large-9 columns">
          <input type="password" name="repass" placeholder="确认密码">
        </div>
      </div>
      <div class="row collapse">
        <div class="small-3 large-3 columns">
          <span class="prefix">学校</span>
        </div>
        <div class="small-9 large-9 columns">
          <input name="school" style="border-left:1px #ccc solid;" class="button tiny secondary regbtn sendcode" onclick="pop()" id="school-name" onblur="if(this.value==''){this.value='请选择大学'}" onfocus="if(this.value=='请选择大学'){this.value=''}" value="陕西师范大学" />
        </div>
      </div>
      <div class="row collapse">
        <div class="small-9 large-9 columns"></div>
        <div class="small-3 large-3 columns">
          <button type="submit" class="button tiny regbtn">提交</button>
        </div>
      </div>
    </form>
  </section>

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
<script type="text/javascript" src="<?php echo ($static); ?>js/validate.js"></script>
<script>
  $(document).ready(function(){
    var valid = new FormValidator('regform', [{
      name: 'upass',
      display: '密码',
      rules: 'required|min_length[6]'
    },{
      name: 'repass',
      display: '重复密码',
      rules: 'required|matches[upass]'
    },{
      name: 'uname',
      display: '手机号',
      rules: 'required|callback_phonenum'
    },{
      name: 'mbchk',
      display: '手机验证码',
      rules: 'required|numeric|exact_length[5]'
    }], function(errors, event) {
      if (errors.length > 0) {
          alert(errors[0].message);
      }
    });
    valid.registerCallback('phonenum', function(value) {
        if (/^1\d{10}$/.test(value)) {
            return true;
        }
        return false;
    }).setMessage('phonenum', '手机号码格式错误');
    $("#sendmbcode").click(function(){
      $("#error").html('').addClass("hide");
      var uname = $("[name='uname']").val();
      var captcha = $("[name='captcha']").val();
      if (!uname || !(/^1\d{10}$/.test(uname))) {
        alert('手机号格式错误');
        return;
      };
      if (!captcha) {
        alert('图片验证码没有填写');
        return;
      };
      $("#sendmbcode").addClass('disabled');
      $.ajax({
        'url': '<?php echo U('/home/sign/sendcode'); ?>',
        'dataType': 'json',
        'type': 'post',
        'data': {
          'uname': uname,
          'captcha': captcha
        },
        'success': function(data){
          if (data.suc == 1) {
            $("#sendmbcode").html('短信已发送');
          }else{
            $("#error").html(data.info).removeClass("hide");
          }
        }
      })
    })
  })
</script>
  </body>
</html>