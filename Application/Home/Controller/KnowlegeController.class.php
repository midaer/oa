<?php
namespace Home\Controller;
use Think\Controller;
class KnowlegeController extends Controller {
    
    public function add(){
        if(IS_POST){
            $model = D('Home/Knowlege');
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->success('添加成功', U('manual'), 1);
                    exit;
                }
                else{
                    $this->error('添加失败',  U('manual'), 1);
                }
            }
            $this->error(implode('', $model->getError()));
        }
        else 
        {
             $model = M('knowlege');
             $data = getTree($model->select());
             $this->assign('data', $data);
             $this->display();
        }
    }
    
    public function lst(){
        $model = D('Home/Knowlege');
        $data = $model->search();
        $this->assign('data', $data['data']);
        $this->assign('count', $data['count']);
        $this->assign('predata', $data['predata']);
        //展示模版
        $this -> display();
    }
    
    public function manual(){
        $model = M('knowlege');
        $data = getNavCatData($model->select());
        $this->assign('data', $data);
        $this -> display();
    }
    
    public function del(){
        $model = D('Home/Knowlege');
        if($model->delete(I('get.id', 0)) !== FALSE)
    	{
            $this->success('删除成功！', U('manual'));
            exit;
    	}
    	else 
            $this->error('删除失败！');

    }
    public function edit()
    {
    	$id = I('get.id');
    	if(IS_POST)
    	{
            $model = D('Home/Knowlege');
            if($model->create(I('post.'), 2))
            {
                if($model->save() !== FALSE)
                {
                    $this->success('修改成功！', U('lst'));
                    exit;
                }
                else{
                    $this->error('修改失败？');
                }
            }
            $this->error($model->getError());
    	}
        else{
            $model = M('knowlege');
            $data = getTree($model->select());
            $Knodata = $model->find($id);
            $children = getChildren($model->select(),$id);
            //传递数据
            $this->assign('data', $data);
            $this->assign('Knodata', $Knodata);
            $this->assign('children', $children);
            $this->display();
        }
    	
    }
    
    public function aa(){
        
        dump($data);
    }

}