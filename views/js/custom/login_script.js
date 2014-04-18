// On Load //
$(function(){    
    $('#login_button').click(function (){
        login();
    });
});

function login(){
    var username = $('#username').val();
    var password = $('#password').val();

    $.post('../../views/scripts/_global_ajax.php', {phpCase:'login', username: username, password: password }, function(data){        
        var result = JSON.parse(data);
        var success = result.success;
        var type = result.userType;
        var id = result.userId;
        
        if (type === 'A'){
            window.location.replace("././dean/home.php");
        }
        else if(type === 'U'){
            window.location.replace("././teacher/home.php");
        }
        else if(success === false){
            alert('Invalid Username/Password combination.');
            $('#password').val('');
        }
    });    
}