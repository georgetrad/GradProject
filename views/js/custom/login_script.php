<script>
    var options = {            
            lines: 13, // The number of lines to draw
            length: 6, // The length of each line
            width: 2, // The line thickness
            radius: 6, // The radius of the inner circle
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
            left: '53%' // Left position relative to parent
        };
    // On Page Load //
    $(function(){
        $('input').focus(function (){
            $(this).attr("placeholder", "");
            $(this).css("direction", "ltr"); 
        });
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
        $("#password").keypress(function(key) {
            if (key.which === 13)
            $('#login_button').click();
        });
    });
    /**
     * @author George Trad
     * This function gets the username and password that the users inputs
     * and creates a JQuery post request with the required information,
     * then it redirects the user to a specific page.
     * @param {String} username The username of the user.
     * @param {String} password The user's password.
     * @returns {boolean} true if logging in succeed, false if not
     */
    function logIn(username, password){
        var target = document.getElementById('spinner');
        var spinner = new Spinner(options);
        
        $.post('models/functions/_global_ajax.php', {case:'login', username: username, password: password }, function(data){
            spinner.spin(target);
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
            else if(type === '1'){                        
                window.location.replace('views/scripts/student/home.php');                
                return true;
            }
            else if(success === false){                        
                $('#wrong').css({'display': 'block'});
                $('#invalid_login').html('<?php echo INVALID_CRED;?>');
                $('#password').val('');
                spinner.stop(target);
                return false;
            }
            spinner.stop(target);
        });        
    }
</script>
