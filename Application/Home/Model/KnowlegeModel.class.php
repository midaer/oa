<?php
namespace Home\Model;
use Think\Model;
//声明模型并且继承父类模型
class KnowlegeModel extends Model{

    //开启批量验证
    protected $patchValidate = true;
    protected $insertFields = array('name','parent_id','content');
    protected $updateFields = array('id','name','parent_id','content');
//    protected $_validate = array(
//        array('name', 'require', '分类名称不能为空！', 1, 'regex', 3),
//        array('name', '1,30', '分类名称的值最长不能超过 30 个字符！', 1, 'length', 3),
//        array('parent_id', 'number', '上级分类的ID，0：代表顶级必须是一个整数！', 2, 'regex', 3),
//    );
    //字段映射定义
//    protected $_map             =   array(
//        //映射规则
//        //键是表单中的name值 = 值是数据表中的字段名
//        'abc'		=>		'name',
//        'wasd'		=>		'sort'
//    );
    public function _before_insert(&$data, $option)
    {
        $data['content'] = '<pre/>'.$data['content'];
    }
    public function _before_update(&$data, $option)
    {
        if(empty($data['content'])){
            unset($data['content']);
        }
        else{
            $data['content'] = '<pre/>'.$data['content'];
        }  
    }
    public function _before_delete($option)
    {     
        // 先找出所有的子分类
        $children = getChildren($this->select(),$option['where']['id']);
        $info = $this->find($option['where']['id']);
        if($info['parent_id'] == 0)
            $this->error('顶级分类禁止删除');
        // 如果有子分类都删除掉
        if($children)
        {
            $children = implode(',', $children);
            // 思考：为什么这里不能直接用DELETE而是要自己拼SQL执行？
            // $this->delete($children);  -->  错误  --> 死循环
            // 在调用delete方法里TP会先调用_before_delete钩子函数这样就死循环了
            $this->execute("DELETE FROM oa_knowlege WHERE id IN($children)");
        }
    }
    
    public function search(){
        /********************* 搜索 *********************/
        $where = array();
        if($search = I('post.searchs')){
            $where['name'] = array('like', "%$search%");
            $where['content'] = array('like', "%$search%");
            $data['count'] = $this->where($where)->count();
            $data['data'] = $this->where($where)->select();
        }
        else{
            $id = I('get.id',125);
            $data['data'] = getTree($this->select(),$id);
            $i = 0;
            foreach ($data['data'] as $key => $value) {
                $i +=1;
            }
            $data['count'] = $i;
        }
        //顶级分类  用于下拉框搜索
        $data['predata'] = $this->where('parent_id = 0')->select();
        return $data;      
    }

	
}