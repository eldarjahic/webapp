var UserService = {
    init: function() {
        var token = localStorage.getItem("user_token");
        if (token) {
            window.location.replace("index.html");
        }
        $('#login-form').validate({
            submitHandler: function(form) {
                var entity = Object.fromEntries((new FormData(form)).entries());
                UserService.login(entity);
            }
        });
    },
    login: function(entity) {
        $.ajax({
            url: 'rest/login',
            type: 'POST',
            data: JSON.stringify(entity),
            contentType: "application/json",
            dataType: "json",
            success: function(result) {
                console.log(result);
                localStorage.setItem("user_token", result.token);
                window.location.replace("index.html");
            },

        });
    },

    logout: function() {
        localStorage.clear();
        window.location.reload();
    },

    checkIsLoggedIn: function() {
        var token = localStorage.getItem("user_token");
        if (token) {
            $('#sign-in-button').addClass("hide");
            $('#sign-up-button').addClass("hide");
            $('#sign-out-button').removeClass("hide");
        } else {
            $('#sign-in-button').removeClass("hide");
            $('#sign-up-button').removeClass("hide");
            $('#sign-out-button').addClass("hide");
        }
    }
}