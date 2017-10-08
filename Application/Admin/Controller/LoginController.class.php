<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
    public function index(){
        if(session('adminUser')){
            $this->redirect('/admin/index');
        }
        $this->display();
    }

    public function login(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        //server side validation
        if(!trim($username)) {
            return show(0,'Please enter your username!');
        }

        if(!trim($password)) {
            return show(0,'Please enter your password!');
        }

        //get data from database
        $ret = D('Admin')->getAdminByUsername($username);

        //validation
        if(!$ret){
            return show(0,'user does not exist!');
        }

        if($ret['password'] != getMD5Password($password)){
            return show(0,'wrong password!');
        }

        //save current time as last login time
        $lastLogin = date('Y-m-d H:i:s', time());
        D('Admin')->updateLastLoginTime($username, $lastLogin);

        //store current user object in session variable
        session('adminUser', $ret);
        return show(1, 'login successfully!');

    }

    public function logout(){
        session('adminUser', null);
        $this->redirect('/admin/login');
    }
}