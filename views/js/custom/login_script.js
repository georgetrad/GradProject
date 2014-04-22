// On Load //
$(function(){    
    $('#login_button').click(function (){
        logIn();
    });
});

/**
 * @author George Trad
 * This function gets the username and password the users inputs
 * and creates a JQuery post request with the required information,
 * then it redirects the user to a specific page.
 * @returns {boolean} true if logging in succeed, false if not
 */
function logIn(){
    var username = $('#username').val();
    var password = $('#password').val();

    $.post('views/scripts/_global_ajax.php', {phpCase:'logIn', username: username, password: password }, function(data){        
        var result = JSON.parse(data);
        var success = result.success;
        var type = result.userType;        
        
        if (type === 'A'){            
            window.location.replace("views/scripts/dean/home.php");
            return true;
        }
        else if(type === 'U'){
            return true;
            window.location.replace("views/scripts/teacher/home.php");
        }
        else if(success === false){
            alert('Invalid Username/Password combination.');
            $('#password').val('');
            return false;
        }
    });    
}