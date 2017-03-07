<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/Public/Admin/css/base.css" />
        <link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
        <title>移动办公自动化系统</title>
        <style type='text/css'>
            select {
                background: rgba(0, 0, 0, 0) url("/Public/Admin/images/inputbg.png") repeat-x scroll 0 0;
                border: 1px solid #c5d6e0;
                height: 28px;
                outline: medium none;
                padding: 0 8px;
                width: 240px;
            }
            .main p input {
                float:none;
            }
        </style>
    </head>

    <body>
        <div class="title"><h2>修改知识</h2></div>
        <form action="/index.php/Home/Knowlege/edit/id/228" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo ($Knodata['id']); ?>" />
            <div class="main">
                <p class="short-input ue-clear">    
                    <label>上级分类：</label>
                    <select name="parent_id">
                        <option value="0">顶级分类</option>
                        <?php if(is_array($data)): foreach($data as $k=>$vo): if($vo['id'] == $Knodata['id'] || in_array($vo['id'], $children)) continue ; ?> 
                            <option <?php if( $vo['id'] == $Knodata['parent_id'] ): ?>selected="selected"<?php endif; ?> value="<?php echo ($vo['id']); ?>"><?php echo (str_repeat('->',$vo['level'])); echo ($vo['name']); ?></option><?php endforeach; endif; ?>				
                    </select>
                </p>
                <p class="short-input ue-clear">
                    <label>标题：</label>
                    <input name="name" type="text" value="<?php echo ($Knodata['name']); ?>" />
                </p>
                <p class="short-input ue-clear">
                    <label>内容：</label>
                    <textarea name="content" style="font-family:Microsoft YaHei !important; font-size:14px;" ><?php echo ($Knodata['content']); ?></textarea>
                </p>
            </div>
            <div class="btn ue-clear">
                <a href="javascript:;" class="confirm" id='btnSubmit'>确定</a>
                <a href="javascript:;" class="clear" id='btnReset'>清空内容</a>
            </div>
        </form>
    </body>
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#btnSubmit').on('click',function(){
                $('form').submit();
            });
	
            $('#btnReset').on('click',function(){
                $('form')[0].reset();
            });
        });	

        $(".select-title").on("click",function(){
            $(".select-list").toggle();
            return false;
        });
        $(".select-list").on("click","li",function(){
            var txt = $(this).text();
            $(".select-title").find("span").text(txt);
        });
        showRemind('input[type=text], textarea','placeholder');
    </script>
</html>