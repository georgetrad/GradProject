$(function(){    
    $('#logout_button').click(function (){
        logOut();
    });
});

function logOut(){
    $.post('../../views/scripts/_global_ajax.php', {phpCase:'logOut'}, function(data){
        var result = JSON.parse(data);
        var success = result.success;
        var type = result.userType;        
                
    });
}
