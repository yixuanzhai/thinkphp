<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Users</title>
    <!-- Bootstrap core CSS -->
    <link href="/thinkphp/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/thinkphp/Public/css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/thinkphp/index.php/Admin/Index">CMSAdmin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/thinkphp/index.php/Admin/Index">Dashboard</a></li>
                <li class="active"><a href="/thinkphp/index.php/Admin/Page">Pages</a></li>
                <li><a href="#">Posts</a></li>
                <li><a href="/thinkphp/index.php/Admin/User">Users</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Welcome, <?php echo ($_SESSION['adminUser']['username']); ?></a></li>
                <li><a href="/thinkphp/index.php/Admin/Login/Logout">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Pages
                    <small>Manage Site Pages</small>
                </h1>
            </div>
            <div class="col-md-2">
                <div class="dropdown create">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Create Content
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#" data-toggle="modal" data-target="#addPage">Add Page</a></li>
                        <li><a href="#">Add Post</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#addUser">Add User</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Dashboard</a></li>
            <li class="active">Pages</li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="/thinkphp/index.php/Admin/Index" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
                    </a>
                    <a href="/thinkphp/index.php/Admin/Page" class="list-group-item"><span class="glyphicon glyphicon-list-alt"
                                                                       aria-hidden="true"></span> Pages <span
                            class="badge"><?php echo ($pageCount); ?></span></a>
                    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil"
                                                                       aria-hidden="true"></span> Posts <span
                            class="badge">33</span></a>
                    <a href="/thinkphp/index.php/Admin/User" class="list-group-item"><span
                            class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge"><?php echo ($userCount); ?></span></a>
                </div>

                <div class="well">
                    <h4>Disk Space Used</h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                             aria-valuemax="100" style="width: 60%;">
                            60%
                        </div>
                    </div>
                    <h4>Bandwidth Used </h4>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                             aria-valuemax="100" style="width: 40%;">
                            40%
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Website Overview -->
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title">Pages</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" type="text" id="filter" placeholder="Filter Pages..." onkeyup="index.filter()">
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Title</th>
                                <th>Published</th>
                                <th>Created On</th>
                                <th>Created By</th>
                                <th></th>
                            </tr>
                            <tbody class="searchable">
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo['title']); ?></td>
                                    <td><?php if(($vo['published'] == 1) ): ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                        <?php else: ?><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><?php endif; ?></td>
                                    <td><?php echo (date('Y-m-d',strtotime($vo['created_on']))); ?></td>
                                    <td><?php echo ($vo['username']); ?></td>
                                    <td id=<?php echo ($vo['title']); ?>><a type="button" class="btn btn-default"
                                                                data-toggle="modal" data-target="#editPage"
                                                                onclick="index.loadPage(this.parentNode.id)">Edit</a>
                                        <input type="button" class="btn btn-danger" value="Delete"
                                               onclick="index.deletePage(this.parentNode.id)"/></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<footer id="footer">
    <p>Copyright CMSAdmin, &copy; 2017</p>
</footer>

<!-- Modals -->

<!-- Add Page -->
<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Page</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" class="form-control" id="pageTitle" placeholder="Page Title">
                    </div>
                    <div class="form-group">
                        <label>Page Body</label>
                        <textarea name="editor1" class="form-control" id="editor1" placeholder="Page Body"></textarea>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="pagePublished" > Published
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <input type="text" class="form-control" id="pageDescription" placeholder="Add Meta Description...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="index.CKupdate();index.addPage();">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Page -->
<div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Edit Page</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" class="form-control" id="pageTitle_edit" placeholder="Page Title" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label>Page Body</label>
                        <textarea name="editor2" class="form-control" id="editor2" placeholder="Page Body"></textarea>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="pagePublished_edit" > Published
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <input type="text" class="form-control" id="pageDescription_edit" placeholder="Add Meta Description...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="index.CKupdate();index.editPage();">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add User -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username_add" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email_add" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password1_add" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="password2_add" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="index.addUser()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
</script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/thinkphp/Public/js/jquery.js"></script>
<script src="/thinkphp/Public/js/bootstrap.min.js"></script>
<script src="/thinkphp/Public/js/admin/index.js"></script>
<script src="/thinkphp/Public/js/dialog/layer.js"></script>
<script src="/thinkphp/Public/js/dialog.js"></script>
</body>
</html>