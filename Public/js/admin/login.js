var login = {
    check : function() {

        // get data from input
        var username = $('input[name = "myusername"]').val();
        var password = $('input[name = "mypassword"]').val();

        //check if any of them is empty
        if (!username)
            dialog.error("Please enter your username!")
        if (!password)
            dialog.error("Please enter your password!")

        //construct AJAX request data
        var url = '/thinkphp/index.php/admin/login/login';
        var data = {'username' : username, 'password' : password};

        //execute AJAX request
        $.post(url, data, function(data){
            if(data.status == 0)
                return dialog.error(data.message);
            if(data.status == 1)
                return dialog.success(data.message, '/thinkphp/index.php/admin/index')
        }, 'JSON');
    }
}