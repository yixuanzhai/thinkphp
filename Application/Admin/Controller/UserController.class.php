<?php
namespace Admin\Controller;
use Think\Controller;


class UserController extends Controller{

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

    public function deleteUser($username){
        if(session('adminUser')) {
            $Admin = M('Admin');
            $Admin->where('username="'.$username.'"')->delete();
            $this->redirect('/admin/user');
        }
        else {
            $this->redirect('/admin/login');
        }
    }

    public function updateUserInfo(){
        if(session('adminUser')) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            //server side validation
            if(!trim($username)) {
                return show(0,'Please enter your username!');
            }

            if(!trim($password)) {
                return show(0,'Please enter your password!');
            }

            //update password
            $Admin = M('Admin');
            $data['password'] = getMD5Password($password);
            $Admin->where('username="'.$username.'"')->save($data);
            return show(1,'user update successfully!');
        }
        else {
            $this->redirect('/admin/login');
        }
    }

    public function addUser(){
        if(session('adminUser')) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            //server side validation
            if(!trim($username)) {
                return show(0,'Please enter your username!');
            }

            if(!trim($password)) {
                return show(0,'Please enter your password!');
            }
            if(!trim($email)) {
                return show(0,'Please enter your email address!');
            }

            //prepare data
            $Admin = M('Admin');
            $data['username'] = $username;
            $data['password'] = getMD5Password($password);
            $data['email'] = $email;
            $data['registration_date'] = date('Y-m-d');

            //insert into table
            $Admin->add($data);
            return show(1,'user created successfully!');
        }
        else {
            $this->redirect('/admin/login');
        }
    }

    
}