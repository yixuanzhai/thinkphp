var index = {
    deleteUser: function (username) {
        var message = "Delete user " + username + "?";
        var url = '/thinkphp/index.php/Admin/User/DeleteUser/username/' + username;
        dialog.confirm(message, url);
    },

    loadUserInfo: function (username) {
        $("#username").val(username);
    },

    updateUserInfo: function () {

        //prevent the modal from closing
        $("form").submit(function (event) {
            event.preventDefault();
        });

        //get data from input fields
        var username = $("#username").val();
        var password1 = $("#password1").val();
        var password2 = $("#password2").val();

        $("#password1").val("");
        $("#password2").val("");
        //password validation
        if (password1 != password2) {
            return dialog.error("Passwords don't match!");
        }
        if (password1.length < 4) {
            return dialog.error("Password length must be at least 4!");
        }

        //close modal after validation process complete
        $(function () {
            $('#editUser').modal('toggle');
        });

        //construct AJAX request data
        var url = '/thinkphp/index.php/admin/user/updateUserInfo';
        var data = {'username': username, 'password': password1};

        $.post(url, data, function (data) {
            if (data.status == 0)
                return dialog.error(data.message);
            if (data.status == 1)
                return dialog.success(data.message, '/thinkphp/index.php/admin/user');
        }, 'JSON');
    },

    filter: function () {
        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })
    },

    addUser : function () {
        //prevent the modal from closing
        $("form").submit(function (event) {
            event.preventDefault();
        });

        //get data from input fields
        var username = $("#username_add").val();
        var email = $("#email_add").val();
        var password1 = $("#password1_add").val();
        var password2 = $("#password2_add").val();

        $("#password1_add").val("");
        $("#password2_add").val("");

        //validation
        if(!username){
            return dialog.error("Please enter your username!");
        }
        if(!email){
            return dialog.error("please enter email address!");
        }
        if (password1 != password2) {
            return dialog.error("Passwords don't match!");
        }
        if (password1.length < 4) {
            return dialog.error("Password length must be at least 4!");
        }

        //close modal after validation process complete
        $(function () {
            $('#editUser').modal('toggle');
        });

        //prepare ajax params
        var url = '/thinkphp/index.php/admin/user/addUser';
        var data = {'username': username,'email' : email, 'password': password1};

        $.post(url, data, function (data) {
            if (data.status == 0)
                return dialog.error(data.message);
            if (data.status == 1)
                return dialog.success(data.message, '/thinkphp/index.php/admin/user');
        }, 'JSON');
    },

    addPage : function () {
        //get data from input
        var pageTitle = $("#pageTitle").val();
        var pageContent = CKEDITOR.instances.editor1.getData();
        var pagePublished;
        if($("#pagePublished").is(':checked')){
            pagePublished = 1;
        }
        else{
            pagePublished = 0;
        }
        var pageDescription = $("#pageDescription").val();

        //prepare ajax params
        var url = '/thinkphp/index.php/admin/page/addPage';
        var data = {'pageTitle': pageTitle,'pageContent' : pageContent, 'pagePublished': pagePublished, 'pageDescription': pageDescription};

        $.post(url, data, function (data) {
            return dialog.success(data.message, '');
        }, 'JSON');

    },

    CKupdate : function () {
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
    },

    deletePage : function (pageTitle) {
        var message = "Delete page " + pageTitle + "?";
        var url = '/thinkphp/index.php/Admin/Page/DeletePage/PageTitle/' + pageTitle;
        dialog.confirm(message, url);
    },

    loadPage: function (title) {
        //prepare ajax data
        var url = '/thinkphp/index.php/Admin/Page/LoadPage';
        var data = {'title' : title};

        $.post(url, data, function (data) {
            $('#pageTitle_edit').val(data.title);
            CKEDITOR.instances.editor2.setData(data.content);
            if(data.published == 1)
                $('#pagePublished_edit').prop('checked', true);
            else
                $('#pagePublished_edit').prop('checked', false);
            $('#pageDescription_edit').val(data.description);
        }, 'JSON');
    },

    editPage : function () {
        var title = $('#pageTitle_edit').val();
        var content = CKEDITOR.instances.editor2.getData();
        var published;
        if($("#pagePublished_edit").is(':checked')){
            published = 1;
        }
        else{
            published = 0;
        }
        var description = $("#pageDescription_edit").val();

        //prepare ajax params
        var url = '/thinkphp/index.php/admin/Page/editPage';
        var data = {'title': title,'content' : content, 'published': published, 'description': description};

        $.post(url, data, function (data) {
            return dialog.success(data.message, '');
        }, 'JSON');
    },
}
