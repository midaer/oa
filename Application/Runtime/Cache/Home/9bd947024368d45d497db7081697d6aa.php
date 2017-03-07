<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>知识手册</title>
	<!--屏幕和设备的屏幕一致，初始缩放为1:1，禁止用户缩放-->
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<!--引入外部的bootstrap中的css文件-->
	<link rel="stylesheet" href="/Public/Admin/bootstrap/css/bootstrap.min.css">
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="/Public/Admin/bootstrap/js/jquery.min.js"></script>
	<!--再引入bootstrap.min.js文件-->
	<script src="/Public/Admin/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$("ul").hide();
			$("body>ul").show();

			$("li").each(function(){
				if($(this)[0].childNodes.length > 1 && $("ul",this).size() > 0)
				{
					$($(this)[0].childNodes[0]).wrap("<a href='#'></a>");

				}
			});

			$("li > a").click(function(){
				$(this).next().toggle();
				$(this).css({"text-decoration":"underline"});
				return false;
			});
			$("ul:first").dblclick(function(){
				$("ul").show();
			});
		});
	</script>
        <style type="text/css">
            body{
                background-color: #F1F8FC;
            }
        </style>
</head>
<body>
    <ul class="list-unstyled text-muted  ">
      <?php if(is_array($data)): foreach($data as $k=>$v): ?><li class="text-muted "><?php echo ($v['name']); ?> 
          <ul class="bg-info">
            <?php if(is_array($v['children'])): foreach($v['children'] as $k1=>$v1): ?><li><?php echo ($v1['name']); ?>
            <ul>
                <?php if(is_array($v1['children'])): foreach($v1['children'] as $k2=>$v2): ?><li>[<?php echo ($v2['name']); ?>] <?php echo ($v2['content']); ?></li><?php endforeach; endif; ?>
            </ul>
          </li><?php endforeach; endif; ?>
        </ul>    
      </li><?php endforeach; endif; ?>
    </ul>
</body>
</html>