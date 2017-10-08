<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017-10-08
 * Time: 11:34 AM
 */

namespace Admin\Controller;
use Think\Controller;


class PageController extends Controller{

    public function index(){
        if(session('adminUser')) {
            //get data from database
            $Page = M('Page');
            $Admin = M('Admin');

            $list = $Page->order('created_on DESC')->select();
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


    public function addPage(){
        if(session('adminUser')) {
            $username = $_SESSION['adminUser']['username'];
            $pageTitle = $_POST['pageTitle'];
            $pageContent = $_POST['pageContent'];
            $pagePublished = $_POST['pagePublished'];
            $pageDescription = $_POST['pageDescription'];

            //find user id from admin table using username
            $Admin = M('Admin');
            $userid = $Admin->where('username="'.$username.'"')->getField('u_id');

            //prepare data
            $Page = M('Page');
            $data['created_by'] = $userid;
            $data['username'] = $username;
            $data['title'] = $pageTitle;
            $data['content'] = $pageContent;
            $data['published'] = $pagePublished;
            $data['description'] = $pageDescription;
            $data['created_on'] = date('Y-m-d');

            //insert into table
            $Page->add($data);

            return show(1,'user created successfully!');
        }
        else {
            $this->redirect('/admin/login');
        }
    }


    public function deletePage($PageTitle){
        if(session('adminUser')) {
            $Page = M('Page');
            $Page->where('title="'.$PageTitle.'"')->delete();
            $this->redirect('/admin/page');
        }
        else {
            $this->redirect('/admin/login');
        }
    }

    public function loadPage(){
        if(session('adminUser')) {
            $title = $_POST['title'];
            $Page = M('Page');
            $result = $Page->where('title="'.$title.'"')->find();

            $this->ajaxreturn($result, 'JSON');
        }
        else {
            $this->redirect('/admin/login');
        }
    }

    public function editPage(){
        if(session('adminUser')) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $published = $_POST['published'];
            $description = $_POST['description'];
            $Page = M('Page');

            $data['content'] = $content;
            $data['published'] = $published;
            $data['description'] = $description;

            $Page->where('title="'.$title.'"')->save($data);

            return show(1, 'update successfully!');
        }
        else {
            $this->redirect('/admin/login');
        }
    }

}