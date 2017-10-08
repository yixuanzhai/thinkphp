<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
        if(session('adminUser')) {
            //get data from database
            $Admin = M('Admin');
            $Page = M('Page');

            $list = $Admin->order('last_login DESC')->select();
            $userCount = $Admin->count();
            $pageCount = $Page->count();

            $array['list'] = $list;
            $array['userCount'] = $userCount;
            $array['pageCount'] = $pageCount;

            $this->assign($array);
            $this->display();
        }
        else {
            $this->redirect('/admin/login');
        }
    }

}