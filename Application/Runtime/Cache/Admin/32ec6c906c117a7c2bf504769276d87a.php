<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/thinkphp/Public/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/thinkphp/Public/css/style.css" rel="stylesheet" media="screen">
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CMSAdmin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
    </div>
</nav>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
            </div>
        </div>
    </div>
</header>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form id="login" method="post" class="well">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="myusername" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="mypassword" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default btn-block" onclick="login.check()">Login</button>
                </form>
            </div>
        </div>
    </div>
</section>

<footer id="footer">
    <p>Copyright CMSAdmin, &copy; 2017</p>
</footer>

<script src='/thinkphp/Public/js/jquery.js'></script>
<script src='/thinkphp/Public/js/dialog/layer.js'></script>
<script src='/thinkphp/Public/js/dialog.js'></script>
<script src="/thinkphp/Public/js/admin/login.js"></script>
</body>
</html>