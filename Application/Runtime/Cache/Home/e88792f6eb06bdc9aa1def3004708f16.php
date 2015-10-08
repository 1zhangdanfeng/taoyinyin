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

<div class="collapse user print-main">
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

<div class="small-10 large-11 columns" id="upload-page">
<div class="main-box print">

  <div class="row">
      <div class="large-12">
        <ul class="breadcrumbs">
          <li><i class="fi-home"></i> <a href="#">客户中心</a></li>
          <li><a href="#">开始打印</a></li>
        </ul>
    </div>
  </div>
  
  <div class="panel row uploadbtn">
    <a class="button tiny left" id="file_upload">点我上传</a>
    <span class="letf intro"> (目前只支持上传pdf文档，最大10M哦)</span>
    <a id="submit" class="button tiny right disabled" onclick="if(!$(this).hasClass('disabled')){fsub.submit()};">提交订单</a>
    <a id="share" class="button tiny right secondary disabled" onclick="if(!$(this).hasClass('disabled')){$('#fsub').attr('action', '<?php echo U('share'); ?>').submit();};">仅仅分享</a>
  </div>
  <div class="row panel">
    <form method="post" action="<?php echo U('submit'); ?>" id="fsub">
      <div class="collapse" id="queue">
        
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
<script src="<?php echo ($static); ?>js/jquery.uploadifive.js" type="text/javascript"></script>
<script type="text/javascript">
  <?php $timestamp = time();?>
  $(function() {
    $('#file_upload').uploadifive({
      'auto'             : true,
      'buttonText'       : '点我上传',
      'buttonClass'      : 'button tiny left',
      'fileType'         : 'application/pdf',
      'formData'         : {
                           },
      'queueID'          : 'queue',
      'uploadScript'     : '<?php echo U('upload'); ?>',
      'itemTemplate'     : '<div class="large-12 uploadbar uploadifive-queue-item">\
      <div class="title">\
        <span class="img left"><i class="filetype icon-pdf"></i></span>\
        <span class="left name filename"></span>\
        <span class="right delete close"><i class="fi-x"></i></span>\
        <span class="label left sucinfo"></span>\
        <span class="left yenum"></span>\
        <div class="clearfix"></div>\
      </div>\
      <div class="info collapse">\
        <div class="large-2 columns">\
            <select disabled>\
              <option value="0">单面</option>\
              <option value="1" selected>双面</option>\
            </select>\
        </div>\
        <div class="large-2 columns">\
          <select disabled>\
              <option value="a3">A3</option>\
              <option value="a4" selected>A4</option>\
              <option value="a5">A5</option>\
            </select>\
        </div>\
        <div class="large-2 columns fen">\
          <label class="left name">份数：&nbsp;&nbsp;</label>\
          <input type="number" name="number[]" class="number left" value="1">\
        </div>\
        <div class="clearfix"></div>\
      </div>\
      <div class="progress">\
        <div class="meter progress-bar"></div>\
      </div><input type="hidden" name="upfile[]"></div>',
      'onUploadComplete' : function(file, data) {
        var fo = JSON.parse(data);
        console.log(file);
        var ch = $(file.queueItem[0]).find("span.sucinfo");
        var pg = $(file.queueItem[0]).find("span.yenum");
        if (fo['suc'] != 1) {
          ch.html("上传失败，" + fo.info).addClass('alert').show();
        }else{
          ch.html("上传成功").addClass("success").show();
          pg.html("页数：" + fo.pages);
          $(file.queueItem[0]).find("input[name='upfile[]']").val(fo.aid);
        }
      },
      'onQueueComplete' : function(ups){
        $("#submit").removeClass("disabled");
        $("#share").removeClass("disabled");
      },
      'onProgress' : function(file, e){
        var ch = $(file.queueItem[0]).find("span.sucinfo");
        if (e.loaded >= e.total) {
            ch.html("正在转换格式……").show();
        }
      },
      'onAddQueueItem' : function(file) {
        if (!$("#submit").hasClass('disabled')) {
          $("#submit").addClass("disabled");
          $("#share").addClass("disabled");
        };
      }
    });
  });
</script>

  </body>
</html>