$(function(){    
    $('#logout_button').click(function (){
        logOut();
    });
});

function logOut(){
    $.post('../../views/scripts/_global_ajax.php', {phpCase:'logOut'});
}
