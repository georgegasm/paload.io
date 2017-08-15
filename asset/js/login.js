$(function(){
    $("#submit").click(function(e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        validateLogin(username,password);
    });
});

function displayLoginFailed()
{
    swal({
      title: "Login Failed!",
      text: "Incorrect Username and Password combination",
      type: "error",
      confirmButtonText: "Okay"
    });
}

function validateLogin(username,password)
{
    $.ajax({
        method: "POST",
        url: "login/validateLogin",
        data: { 
            username: username, 
            password: password 
        }
    }).done(function( response ) {
        if(response === "0")
        {
            displayLoginFailed();
            return;
        }
        window.location = "dashboard";
    });
}