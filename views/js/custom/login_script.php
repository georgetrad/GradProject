<script>
// On Page Load //
$(function(){    
    $('#login_button').click(function (){        
        var username = $('#username').val();
        var password = $('#password').val();      

        if(username === '' || password === ''){
            $('#wrong').css({'display': 'block'});
            return false;
        }        
        else{
            logIn(username, password);
        }
    });
    $('.fileLink').click(function(){
//        spin();
//        var target = document.getElementById('spin');
//        var spinner = new Spinner(opts).spin(target);
        $.post( "views/scripts/dean/importGeneralFile.php", { file:$(this).text(), cmd: "import" },function( data ) {
            $( ".result" ).html( data );
        });
    });
});

$(function spin(){
    var opts = {
  lines: 13, // The number of lines to draw
  length: 20, // The length of each line
  width: 10, // The line thickness
  radius: 30, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#000', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '50%', // Top position relative to parent
  left: '50%' // Left position relative to parent
};
    
});

/**
 * @author George Trad
 * This function gets the username and password that the users inputs
 * and creates a JQuery post request with the required information,
 * then it redirects the user to a specific page.
 * @returns {boolean} true if logging in succeed, false if not
 */
function logIn(username, password){    
    $.post('models/functions/log_in.php', {username: username, password: password }, function(data){        
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
            $('#wrong').css({'display': 'block'});
            $('#invalid_login').html('<?php echo INVALID_CRED;?>');
            $('#password').val('');
            return false;
        }        
    });   
}
</script>
