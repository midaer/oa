<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>知识手册</title>
<script src="/Public/Admin/js/jquery.js"></script>
<script>
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
   
</style>
</head>
<body>
    <ul>
      <?php if(is_array($data)): foreach($data as $k=>$v): ?><li><?php echo ($v['name']); ?>
        <ul>
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