// On Load //
$(function(){    
    $('#wrong').hide();
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

    if(username === '' || password === ''){
        $('#wrong').show();
        return;
    }
    
    $.post('views/scripts/_global_ajax.php', {phpCase:'logIn', username: username, password: password }, function(data){        
        var result = JSON.parse(data);
        var success = result.success;
        var type = result.userLevel;        
        
        if (type === '-1'){            
            window.location.replace('views/scripts/dean/home.php');
            return true;
        }
        else if(type === '0'){                        
            window.location.replace('views/scripts/teacher/home.php');
            return true;
        }
        else if(success === false){
            $('#invalid_login').html('معلومات تسجيل الدخول غير صحيحة'); 
//            $('#wrong').show();
//            alert('Invalid Username/Password combination.');
//            $('#password').val('');
            return false;
        }
    });    
}