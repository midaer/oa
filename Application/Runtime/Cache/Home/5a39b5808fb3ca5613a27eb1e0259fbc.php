<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/Public/Admin/css/base.css" />
        <link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
        <link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
        <title>移动办公自动化系统</title>
        <style type='text/css'>
            table tr .id{ width:63px; text-align: center;}
            table tr .name{ width:118px; padding-left:17px;}
            table tr .nickname{ width:63px; padding-left:17px;}
            table tr .dept_id{ width:63px; padding-left:13px;}
            table tr .sex{ width:63px; padding-left:13px;}
            table tr .birthday{ width:80px; padding-left:13px;}
            table tr .tel{ width:113px; padding-left:13px;}
            table tr .email{ width:160px; padding-left:13px;}
            table tr .addtime{ width:160px; padding-left:13px;}
            table tr .operate{ padding-left:13px;}
        </style>
    </head>

    <body>
        <div class="title"><h2>知识管理</h2></div>
        <div class="table-operate ue-clear">
            <a href="/index.php/Home/Kno/add" class="add">添加</a>
            <a href="javascript:;" class="del">删除</a>
            <a href="javascript:;" class="edit">编辑</a>
            <a href="javascript:;" class="check">审核</a>
        </div>
        <div class="table-box">
            <table>
                <thead>
                    <tr>
                        <th class="name">标题</th>
                        <th class="content">内容</th>
                        <th class="operate">操作</th>
                    </tr>
                </thead>
                <tbody>    
                <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
                    <td class="name"><?php echo (str_repeat('->',$vo['level'])); echo ($vo['name']); ?></td>   
                    <td class="content">
                       <?php if( $vo['level'] == 0 ): ?>**********************顶级大类**********************
                       <?php elseif( $vo['level'] == 1 ): ?>
                       ----------------------二级大类----------------------
                       <?php else: ?>
                       <?php echo ($vo["content"]); endif; ?>
                    </td>
                    <td class="operate"> 
                        <a href="/index.php/Home/Kno/edit/id/<?php echo ($vo['id']); ?>" title="编辑">编辑</a> |
	                <a href="/index.php/Home/Kno/del/id/<?php echo ($vo['id']); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
                    </td>
                </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination ue-clear">
            <div class="pagin-list">
                <?php echo ($page); ?>
            </div>
            <div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
        </div>
    </body>
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
    <script type="text/javascript">
        $(".select-title").on("click",function(){
            $(".select-list").hide();
            $(this).siblings($(".select-list")).show();
            return false;
        })
        $(".select-list").on("click","li",function(){
            var txt = $(this).text();
            $(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
        })

        $("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

        showRemind('input[type=text], textarea','placeholder');
    </script>
</html>