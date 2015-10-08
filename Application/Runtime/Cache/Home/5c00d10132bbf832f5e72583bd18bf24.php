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

<div class="collapse user mywen">
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

  <div class="small-10 large-11 columns title">
    <div class="main-box">
      <div class="panel">
        <div>
          <div class="left">
            <h3>我的文库</h3>
          </div>
          <div class="right upbtn">
              <a href="<?php echo U('/home/print'); ?>" class="button tiny radius secondary">上传</a>
              <a href="#" id="print" class="button tiny radius">打印</a>
          </div>
        </div>
        <table class="otb">
          <thead>
          <tr>
            <th width="3%"></th>
            <th>文件名</th>
            <th width="15%">大小</th>
            <th width="10%">页数</th>
            <th width="15%">时间</th>
          </tr>
          </thead>
          <tbody class="otb-tb">
            <?php if(is_array($attachment)): $i = 0; $__LIST__ = $attachment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$att): $mod = ($i % 2 );++$i;?><tr>
              <td>
                <span node-type="chk" class="chk" name="<?php echo ($att['tid']); ?>" onselectstart="return false" onselect="document.selection.empty()">
                    <span class="chk-ico">&nbsp;&nbsp;</span>
                </span>
              </td>
              <td>
                <div class="left"> <?php echo ($att['name']); ?></div>
                <div class="right">
                  <a href="#" title="删除文档" name="<?php echo ($att['tid']); ?>" class="btn-del"><i class="ico-del"></i></a>
                  <a href="#" title="技术今天出差了，这个按钮点不了>.<"><i class="ico-rename"></i></a>
                  <a href="#" title="分享文档" name="<?php echo ($att['tid']); ?>" class="share"><i class="ico-share"></i></a>
                  <a title="下载文档" href="<?php echo U('/home/attachment/download/', "id={$att['tid']}"); ?>"><i class="ico-download"></i></a>
                </div>
              </td>
              <td><?php echo format_bytes($att['size']); ?></td>
              <td><?php echo ($att['pages']); ?>页</td>
              <td><?php echo totime($att['time']); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
        <?php echo ($pagenav); ?>
      </div>
    </div>
  </div>

</div>

<div class="clearfix"></div>

<div id="shareMod" class="reveal-modal small" data-reveal>
  <h2>分享文档</h2>
  <p class="lead">将文档分享到文库获取积分</p>
  <div><a href="#" class="button tiny secondary" id="share-btn">分享文档</a></div>
  <div id="sharecode"></div>
  <input type="hidden" id="wenid">
  <a class="close-reveal-modal">&#215;</a>
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
<script>
  $(document).ready(function(){
    $("#print").click(function(){
      var files = [];
      $("span.chk.chked").each(function(){
        files.push($(this).attr('name'));
      })
      var f = $('#plist');
      for (var k in files){
        f.append('<input type="hidden" name="upfile[]" value="'+files[k]+'">');
        f.append('<input type="hidden" name="number[]" value="1">');
      }
      f.submit();
    })
    $(".btn-del").click(function(){
      if (confirm('确认删除文档？')) {
        $.ajax({
          'url': '<?php echo U('del'); ?>',
          'type': 'post',
          'data': {
            'id': this.name
          },
          'success': function(data){
            if (data) {
              location.reload();
            };
          }
        })
      };
    });
    $("#share-btn").click(function(){
      $.ajax({
        'url': '<?php echo U('share'); ?>',
        'type': 'post',
        'dataType': 'json',
        'data': {
          'id': $("#wenid").val()
        },
        'success': function(data){
          if (data.suc > 0) {
            $("#sharecode").html('<div data-alert class="alert-box success">\
  文档已成功分享\
</div>');
          }else{
            $("#sharecode").html('<div data-alert class="alert-box warning">\
  这个文档已经分享过啦\
</div>');
          }
        }
      })
    })
    $('.share').click(function(){
      $("#wenid").val(this.name);
      $("#sharecode").html('');
      $('#shareMod').foundation('reveal', 'open');
    })
    $("span.chk").click(function(){
      var b = $(this).hasClass("chked");
      if (b) {
        $(this).removeClass("chked");
        $(this.parentNode.parentNode).removeClass("selected");
      }else{
        $(this).addClass("chked");
        $(this.parentNode.parentNode).addClass("selected");
      }
    });
  });
</script>

  </body>
</html>