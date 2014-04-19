// On Load //
$(function(){    
    $('#login_button').click(function (){
        logIn();
    });
});

function logIn(){
    var username = $('#username').val();
    var password = $('#password').val();

    $.post('../../views/scripts/_global_ajax.php', {phpCase:'logIn', username: username, password: password }, function(data){        
        var result = JSON.parse(data);
        var success = result.success;
        var type = result.userType;        
        
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