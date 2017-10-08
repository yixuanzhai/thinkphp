var dialog = {

    error : function (message) {
        layer.open({
            content: message,
            icon: 2,
            title: 'error',
        });
    },

    success : function (message, url) {
        layer.open({
            content: message,
            icon: 1,
            yes: function () {
                location.href=url;
            },
        });
    },

    confirm : function (message, url) {
        layer.open({
            content: message,
            icon: 3,
            btn: ['Yes','No'],
            yes: function () {
                location.href=url;
            },
        });
    },
    toconfirm : function (message) {
        layer.open({
            content: message,
            icon: 3,
            btn: ['Ok'],
        });
    },
}