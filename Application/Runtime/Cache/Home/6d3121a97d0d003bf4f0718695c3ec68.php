<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Public/Admin/css/base.css" />
    <link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
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
            //给确定按钮绑定一个点击事件
            $('.input-group-addon').on('click',function(){
                    //事件的处理程序
                    $('form').submit();
            });
        });
    </script>
</head>
<body>
    
<div class=”container-fluid”>
    
        <div class="title"><h2>知识列表</h2></div>
        
        <div class="dropdown pull-left">
            <button class="btn btn-default" data-toggle="dropdown">
              选择 <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <?php if(is_array($predata)): foreach($predata as $k1=>$vo1): ?><li><a href="/index.php/Home/Knowlege/lst/id/<?php echo ($vo1['id']); ?>"><?php echo ($vo1['name']); ?></a></li>
              <li class="divider"></li><?php endforeach; endif; ?>
            </ul>
        </div>
        
        <form class="form-horizontal" action="/index.php/Home/Knowlege/lst.html" method="post">
            <div class="input-group">       
                 <input type="text" name="searchs" class="form-control">
                 <span class="input-group-addon" style="cursor:pointer;"> <span class="glyphicon glyphicon-search"></span> </span>
            </div>
        </form>
        
        <div class="table-operate ue-clear">
            <a href="/index.php/Home/Knowlege/add" class="add">添加</a>
            <a href="javascript:;" class="del">删除</a>
            <a href="javascript:;" class="edit">编辑</a>
            <a href="javascript:;" class="check">审核</a>         
        </div>
        
        
        
        
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-condensed">
                <thead>
                    <tr>
                        <th class="name">标题</th>
                        <th class="content">内容</th>
                        <th class=" operate">操作</th>
                    </tr>
                </thead>
                <tbody>    
                <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr
                   <?php if( $vo['level'] == 0 ): ?>class="danger"
                   <?php elseif( $vo['level'] == 1 ): ?>
                   class="warning"<?php endif; ?> 
                 >
                    <td class="name"><?php echo (str_repeat('->',$vo['level'])); echo ($vo['name']); ?></td>   
                    <td class="content">
                       <?php if( $vo['level'] == 0 ): ?>**********************我是你的领导哦**********************
                       <?php elseif( $vo['level'] == 1 ): ?>
                       <?php echo (msubstr($vo["content"],0,100)); endif; ?>
                    </td>
                    <td class=" operate"> 
                        <a href="/index.php/Home/Knowlege/edit/id/<?php echo ($vo['id']); ?>" title="编辑">编辑</a> |
	                <a href="/index.php/Home/Knowlege/del/id/<?php echo ($vo['id']); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
                    </td>
                </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        
        
        
        <div class="pagination ue-clear">
            <div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
        </div>
        
</div>
</body>
</html>