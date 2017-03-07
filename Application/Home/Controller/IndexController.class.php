<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    
    public function index(){
        $this -> display();
    }

    public function home(){
        //展示模版
        $this -> display();
    }
}