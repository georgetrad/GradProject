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
        
    function changePassword(oldPassword, newPassword){
        var target = document.getElementById('spinner');
        var spinner = new Spinner(options);
        
        $.post('models/functions/_global_ajax.php',{case:'changePassword',
                oldPassword: oldPassword, newPassword: newPassword },
            function(data){
                spinner.spin(target);
                var result = JSON.parse(data);
                var success = result.success;
                if (success === true){
                    $('#wrong_old').hide();
                    $('#change_success').show();                    
                    setTimeout(function() {
                        window.location.replace('models/functions/log_out.php');                        
                    }, 2000);                                        
                }
                else if(success === false){                          
                    $('#wrong_old').show();                    
                    spinner.stop(target);        
                    return false;
                }
                spinner.stop(target);
        });        
    }
    
    // On Page Load //
    $(function(){
        $('input').focus(function (){
            $(this).attr("placeholder", "");
            $(this).css("direction", "ltr"); 
        });
        $('#change').click(function (){        
            var oldPassword = $('#old_password').val();
            var newPassword = $('#new_password').val();
            var confirmPassword = $('#confirm_password').val();
            if(oldPassword === '' || newPassword === ''){                
                $('#wrong').show();
                return false;
            }        
            else if (newPassword.length < 3){                
                $('#wrong').hide();
                $('#doesnt_match').hide();
                $('#short_password').show();                
            }
            else if (newPassword !== confirmPassword){                
                $('#wrong').hide();
                $('#wrong_old').hide();
                $('#short_password').hide();
                $('#doesnt_match').show();
            }
            else{
                $('#wrong').hide();    
                $('#short_password').hide();
                $('#doesnt_match').hide();                
                changePassword(oldPassword, newPassword);
            }
        });
        $("#old_password").keypress(function(key) {
            if (key.which === 13)
            $('#change').click();
        });
        $("#new_password").keypress(function(key) {
            if (key.which === 13)
            $('#change').click();
        });
        $("#confirm_password").keypress(function(key) {
            if (key.which === 13)
            $('#change').click();
        });
    });    
</script>

